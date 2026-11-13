// DropMe Tours – interactive tour route maps (Leaflet + OpenStreetMap)
(function () {
  if (!window.L) return;
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const esc = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

  // Distance in km between two points
  const km = (a, b) => {
    const R = 6371, r = Math.PI / 180;
    const dLat = (b.lat - a.lat) * r, dLng = (b.lng - a.lng) * r;
    const h = Math.sin(dLat / 2) ** 2 + Math.cos(a.lat * r) * Math.cos(b.lat * r) * Math.sin(dLng / 2) ** 2;
    return 2 * R * Math.asin(Math.sqrt(h));
  };

  // Gentle curve between two stops so the route reads like a journey
  const curve = (a, b, steps = 24) => {
    const mx = (a.lat + b.lat) / 2, my = (a.lng + b.lng) / 2;
    const dx = b.lat - a.lat, dy = b.lng - a.lng;
    const cx = mx - dy * 0.18, cy = my + dx * 0.18;
    const pts = [];
    for (let i = 0; i <= steps; i++) {
      const t = i / steps, u = 1 - t;
      pts.push([u * u * a.lat + 2 * u * t * cx + t * t * b.lat, u * u * a.lng + 2 * u * t * cy + t * t * b.lng]);
    }
    return pts;
  };

  document.querySelectorAll('.explorer').forEach(initExplorer);

  function initExplorer(root) {
    const tours = JSON.parse(root.querySelector('.ex-data').textContent);
    const single = root.classList.contains('explorer-single');
    const mapEl = root.querySelector('.ex-map');
    const list = root.querySelector('.ex-stops');
    const playBtn = root.querySelector('.ex-play');
    const distEl = root.querySelector('.ex-dist');

    const map = L.map(mapEl, { scrollWheelZoom: false, zoomSnap: 0.25, attributionControl: true })
      .setView([7.6, 80.7], 7.5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18, minZoom: 6,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    map.setMaxBounds([[4.5, 77.5], [10.8, 83.8]]);
    let drawn = false;
    // Scroll-zoom only after the visitor clicks the map (so the page still scrolls)
    map.on('click', () => map.scrollWheelZoom.enable());
    mapEl.addEventListener('mouseleave', () => map.scrollWheelZoom.disable());

    const layer = L.layerGroup().addTo(map);
    let markers = {}, segments = [], current = 0, playing = null, visible = false, pendingDraw = true;

    function pinIcon(label, cls) {
      return L.divIcon({ className: 'ex-pin-wrap', html: `<span class="ex-pin ${cls}">${label}</span>`, iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -16] });
    }

    function draw(i) {
      stop();
      current = i;
      const t = tours[i];
      layer.clearLayers(); markers = {}; segments = [];
      const pts = t.points;

      // Number each stop; a place visited twice (e.g. airport at start and end) shares one pin
      const order = {};
      pts.forEach((p, n) => { (order[p.key] = order[p.key] || []).push(n + 1); });

      // Route line, segment by segment
      let all = [], total = 0;
      for (let n = 0; n < pts.length - 1; n++) {
        if (pts[n].key === pts[n + 1].key) continue;
        const c = curve(pts[n], pts[n + 1]);
        segments.push({ from: n, to: n + 1, pts: c });
        all = all.concat(n === 0 ? c : c.slice(1));
        total += km(pts[n], pts[n + 1]);
      }
      L.polyline(all, { color: '#f7b500', weight: 9, opacity: 0.18, interactive: false }).addTo(layer);
      const line = L.polyline(all, { color: '#f7b500', weight: 3.5, opacity: 1, className: 'ex-route', interactive: false }).addTo(layer);

      // Pins
      const lastKey = pts[pts.length - 1].key;
      Object.keys(order).forEach(key => {
        const p = pts[order[key][0] - 1];
        const nums = order[key];
        const cls = key === pts[0].key ? 'is-start' : (key === lastKey ? 'is-end' : '');
        const m = L.marker([p.lat, p.lng], { icon: pinIcon(nums[0], cls), riseOnHover: true, keyboard: true, title: p.name })
          .bindPopup(`<b>${esc(p.name)}</b><br><span>${esc(p.note || '')}</span><br><small>Stop ${nums.join(' & ')}</small>`)
          .addTo(layer);
        m.on('mouseover', () => highlight(key, true));
        m.on('mouseout', () => highlight(key, false));
        markers[key] = m;
      });

      // Side list
      list.innerHTML = pts.map((p, n) =>
        `<li data-key="${esc(p.key)}"><button type="button"><span class="ex-n">${n + 1}</span><span><b>${esc(p.name)}</b><small>${esc(p.note || '')}</small></span></button></li>`
      ).join('');
      list.querySelectorAll('li').forEach(li => {
        const key = li.dataset.key;
        li.addEventListener('mouseenter', () => highlight(key, true));
        li.addEventListener('mouseleave', () => highlight(key, false));
        li.querySelector('button').addEventListener('click', () => {
          stop();
          map.flyTo(markers[key].getLatLng(), 10, { duration: reduceMotion ? 0 : 0.8 });
          markers[key].openPopup();
        });
      });

      if (distEl) distEl.textContent = total ? `About ${Math.round(total * 1.35 / 10) * 10} km on the road` : '';

      // Panel text (tabbed explorer)
      if (!single) {
        root.querySelectorAll('.ex-tab').forEach((b, n) => b.setAttribute('aria-selected', n === i ? 'true' : 'false'));
        const img = root.querySelector('.ex-img');
        if (img.getAttribute('src') !== t.img) { img.classList.add('fade'); img.onload = () => img.classList.remove('fade'); img.src = t.img; }
        root.querySelector('.ex-days').textContent = t.days;
        root.querySelector('.ex-title').textContent = t.title;
        root.querySelector('.ex-view').href = 'tour.php?t=' + encodeURIComponent(t.slug);
        root.querySelector('.ex-book').href = 'contact.php?service=Tour+Package&item=' + encodeURIComponent(t.title) + '#book';
      }

      // Leave room at the bottom for the Play button
      map.fitBounds(L.latLngBounds(pts.map(p => [p.lat, p.lng])), { animate: !reduceMotion && drawn, maxZoom: 9, paddingTopLeft: [40, 40], paddingBottomRight: [30, 80] });
      drawn = true;

      // Draw-on animation for the route line
      const el = line.getElement();
      if (el && !reduceMotion) {
        const len = el.getTotalLength();
        el.style.transition = 'none';
        el.style.strokeDasharray = len;
        el.style.strokeDashoffset = len;
        el.getBoundingClientRect();
        el.style.transition = 'stroke-dashoffset 2.2s ease-in-out';
        el.style.strokeDashoffset = 0;
        setTimeout(() => { el.style.strokeDasharray = ''; el.style.transition = ''; }, 2300);
      }
    }

    function highlight(key, on) {
      const m = markers[key];
      if (m && m.getElement()) m.getElement().classList.toggle('hot', on);
      list.querySelectorAll(`li[data-key="${CSS.escape(key)}"]`).forEach(li => li.classList.toggle('hot', on));
    }

    // Play: a car drives the route, stopping at each place
    function stop() {
      if (playing) { cancelAnimationFrame(playing.raf); clearTimeout(playing.wait); if (playing.car) layer.removeLayer(playing.car); playing = null; }
      if (playBtn) playBtn.textContent = '▶ Play the route';
      list.querySelectorAll('li.now').forEach(li => li.classList.remove('now'));
    }

    function play() {
      if (playing) { stop(); return; }
      const t = tours[current];
      if (!segments.length) return;
      playBtn.textContent = '■ Stop';
      const car = L.marker(segments[0].pts[0], {
        icon: L.divIcon({ className: 'ex-pin-wrap', html: '<span class="ex-car">🚐</span>', iconSize: [36, 36], iconAnchor: [18, 18] }),
        interactive: false, zIndexOffset: 1000
      }).addTo(layer);
      playing = { car };
      let s = 0;
      const arrive = idx => {
        const p = t.points[idx];
        list.querySelectorAll('li.now').forEach(li => li.classList.remove('now'));
        const li = list.children[idx];
        if (li) {
          li.classList.add('now');
          // Scroll only the side panel, never the page
          const panel = root.querySelector('.ex-panel');
          const pr = panel.getBoundingClientRect(), lr = li.getBoundingClientRect();
          if (lr.top < pr.top || lr.bottom > pr.bottom) panel.scrollTo({ top: panel.scrollTop + lr.top - pr.top - pr.height / 2 + lr.height / 2, behavior: reduceMotion ? 'auto' : 'smooth' });
        }
        markers[p.key].openPopup();
      };
      arrive(segments[0].from);
      const runSeg = () => {
        if (!playing) return;
        if (s >= segments.length) { playing.wait = setTimeout(stop, 1800); return; }
        const seg = segments[s];
        const dur = reduceMotion ? 0 : Math.max(900, km(t.points[seg.from], t.points[seg.to]) * 18);
        const t0 = performance.now();
        const step = now => {
          if (!playing) return;
          const k = dur ? Math.min(1, (now - t0) / dur) : 1;
          const f = k * (seg.pts.length - 1), a = Math.floor(f), b = Math.min(a + 1, seg.pts.length - 1), r = f - a;
          car.setLatLng([seg.pts[a][0] + (seg.pts[b][0] - seg.pts[a][0]) * r, seg.pts[a][1] + (seg.pts[b][1] - seg.pts[a][1]) * r]);
          if (k < 1) { playing.raf = requestAnimationFrame(step); return; }
          arrive(seg.to);
          s++;
          playing.wait = setTimeout(runSeg, reduceMotion ? 1200 : 700);
        };
        playing.raf = requestAnimationFrame(step);
      };
      playing.wait = setTimeout(runSeg, 600);
    }

    if (playBtn) playBtn.addEventListener('click', play);
    root.querySelectorAll('.ex-tab').forEach(b => b.addEventListener('click', () => draw(+b.dataset.i)));

    // Keyboard: arrow keys move between tabs
    const tabs = [...root.querySelectorAll('.ex-tab')];
    tabs.forEach((b, n) => b.addEventListener('keydown', e => {
      const d = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
      if (!d) return;
      e.preventDefault();
      const next = tabs[(n + d + tabs.length) % tabs.length];
      next.focus(); next.click();
    }));

    // Start the line animation only when the map scrolls into view
    new IntersectionObserver(entries => {
      entries.forEach(en => {
        if (en.isIntersecting && pendingDraw) { pendingDraw = false; map.invalidateSize(); draw(current); }
      });
    }, { threshold: 0.3 }).observe(mapEl);
  }
})();
