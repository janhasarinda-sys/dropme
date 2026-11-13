// Mobile menu
const menuBtn = document.querySelector('.menu-btn');
const nav = document.querySelector('.nav');
menuBtn.addEventListener('click', () => {
  const open = nav.classList.toggle('open');
  menuBtn.setAttribute('aria-expanded', open);
});

// Header turns solid when the page scrolls
const header = document.querySelector('.header');
const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 60);
onScroll();
window.addEventListener('scroll', onScroll, { passive: true });

// Fade sections in as they scroll into view
const revealEls = document.querySelectorAll('.reveal, .section .head, .tiles .tile, .vehicle, .points li');
if ('IntersectionObserver' in window && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
  document.documentElement.classList.add('js-reveal');
  const io = new IntersectionObserver(entries => {
    entries.forEach(en => { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
  }, { rootMargin: '0px 0px -8% 0px' });
  revealEls.forEach((el, i) => { el.style.transitionDelay = (i % 4) * 70 + 'ms'; io.observe(el); });
}

// Gallery photo viewer (gallery page only)
const lb = document.getElementById('lightbox');
if (lb && window.GALLERY) {
  const img = lb.querySelector('img'), cap = lb.querySelector('figcaption');
  let cur = 0;
  const show = i => {
    cur = (i + GALLERY.length) % GALLERY.length;
    img.src = GALLERY[cur].src; img.alt = GALLERY[cur].cap; cap.textContent = GALLERY[cur].cap;
  };
  document.querySelectorAll('.g-item').forEach(b => b.addEventListener('click', () => { show(+b.dataset.index); lb.showModal(); }));
  lb.querySelector('.lb-prev').addEventListener('click', () => show(cur - 1));
  lb.querySelector('.lb-next').addEventListener('click', () => show(cur + 1));
  lb.querySelector('.lb-close').addEventListener('click', () => lb.close());
  lb.addEventListener('click', e => { if (e.target === lb) lb.close(); });
  lb.addEventListener('keydown', e => {
    if (e.key === 'ArrowLeft') show(cur - 1);
    if (e.key === 'ArrowRight') show(cur + 1);
  });
}

// Booking form (contact page only)
const form = document.getElementById('bookForm');
if (form) {
  const today = new Date().toISOString().split('T')[0];
  form.date_from.min = today;
  form.date_to.min = today;
  form.date_from.addEventListener('change', () => { form.date_to.min = form.date_from.value || today; });

  const msg = document.getElementById('formMsg');
  const showMsg = (text, ok) => { msg.textContent = text; msg.className = 'form-msg ' + (ok ? 'ok' : 'err'); };

  const validate = () => {
    let ok = true;
    form.querySelectorAll('[required]').forEach(el => {
      const bad = !el.value.trim();
      el.classList.toggle('invalid', bad);
      if (bad) ok = false;
    });
    if (form.email.value && !form.email.checkValidity()) { form.email.classList.add('invalid'); ok = false; }
    if (!ok) showMsg('Fill in the fields marked in red, then send again.', false);
    return ok;
  };

  const waText = () => {
    const f = form;
    return [
      'Hello DropMe Tours, I would like to book:',
      'Name: ' + f.name.value,
      'Phone: ' + f.phone.value,
      f.email.value && 'Email: ' + f.email.value,
      'Service: ' + f.service.value,
      f.item.value && 'Tour/Vehicle: ' + f.item.value,
      'Pickup date: ' + f.date_from.value,
      f.date_to.value && 'Return date: ' + f.date_to.value,
      f.pickup.value && 'Pickup location: ' + f.pickup.value,
      'Passengers: ' + f.pax.value,
      f.message.value && 'Message: ' + f.message.value,
    ].filter(Boolean).join('\n');
  };

  document.getElementById('waBtn').addEventListener('click', () => {
    if (!validate()) return;
    window.open('https://wa.me/' + window.WA_NUMBER + '?text=' + encodeURIComponent(waText()), '_blank');
  });

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (!validate()) return;
    const btn = form.querySelector('button[type=submit]');
    btn.disabled = true; btn.textContent = 'Sending...';
    try {
      const res = await fetch('book.php', { method: 'POST', body: new FormData(form) });
      const data = await res.json();
      if (data.ok) {
        showMsg('Enquiry sent. We\'ll contact you on the phone number you gave.', true);
        form.reset();
      } else {
        showMsg(data.error || 'Something went wrong. Please call or WhatsApp us.', false);
      }
    } catch (err) {
      showMsg('Could not send. Please call or WhatsApp us.', false);
    }
    btn.disabled = false; btn.textContent = 'Send enquiry';
  });
}
