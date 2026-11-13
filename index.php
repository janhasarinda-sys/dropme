<?php $page = 'home'; $title = 'Tours, Vehicle Hire & Rent a Car in Sri Lanka'; $useMap = true; require __DIR__ . '/includes/header.php';
$featRound = array_values(array_filter($TOURS, fn($t) => $t['type'] === 'round' && !empty($t['featured'])));
$featDay   = array_values(array_filter($TOURS, fn($t) => $t['type'] === 'day' && !empty($t['featured'])));
?>

<section class="hero">
  <div>
    <h1>DropMe Tours</h1>
    <p class="sub">Your way around Sri Lanka, since <?= (int)$SITE['since'] ?></p>
    <div class="hero-btns">
      <a href="tours.php" class="pill pill-yellow">See our tours</a>
      <a href="<?= book_link() ?>" class="pill pill-line">Plan my trip</a>
    </div>
  </div>
</section>

<section class="facts-strip">
  <ul class="container">
    <li><b>Since <?= (int)$SITE['since'] ?></b><span>Based in Wadduwa</span></li>
    <li><b>24 hours</b><span>Airport pickups any time</span></li>
    <li><b>English-speaking</b><span>Licensed drivers</span></li>
    <li><b>Island-wide</b><span>Tours, hire and rental</span></li>
  </ul>
</section>

<section class="section">
  <div class="container welcome">
    <div>
      <h2>Sri Lanka at your own pace</h2>
      <p>We're a small travel company on the west coast, between Colombo and Bentota. We meet you at the airport, drive you to the places you want to see, and bring you back safely.</p>
      <p>Choose one of our tours, or tell us what you like and we'll plan the route, the stops and the hotels around you.</p>
      <a href="about.php" class="pill pill-navy">About us</a>
    </div>
    <div class="photo-pair">
      <img src="images/tours/ella.jpg" alt="Nine Arch Bridge near Ella" width="1280" height="853" loading="lazy">
      <img src="images/tours/sigiriya.jpg" alt="Sigiriya rock" width="1280" height="960" loading="lazy">
    </div>
  </div>
</section>

<section class="section mist">
  <div class="container">
    <div class="head">
      <h2>Round tours</h2>
      <p>Several days on the road with your own driver, from the ancient cities to the tea country and the beaches.</p>
    </div>
    <div class="tiles round">
      <?php foreach (array_slice($featRound, 0, 5) as $i => $t) tour_tile($t, $i === 0); ?>
    </div>
    <p class="more"><a href="tours.php" class="pill pill-navy">All round tours</a></p>
  </div>
</section>

<section class="section map-section">
  <div class="container">
    <div class="head reveal">
      <p class="eyebrow">Round tours on the map</p>
      <h2>Where we're going</h2>
      <p>Choose a round tour and watch the route light up, from the airport to the hills, the safaris and the beaches.</p>
    </div>
    <?php route_explorer($featRound, 'home-explorer'); ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="head">
      <h2>Day tours</h2>
      <p>We pick you up in the morning and bring you back the same evening.</p>
    </div>
    <div class="tiles">
      <?php foreach (array_slice($featDay, 0, 4) as $t) tour_tile($t); ?>
    </div>
    <p class="more"><a href="tours.php#day-tours" class="pill pill-navy">All day tours</a></p>
  </div>
</section>

<section class="custom">
  <div class="container custom-in">
    <h2>Want a tour made just for you?</h2>
    <p>Tell us your dates, your budget and what you'd love to see. We'll plan the whole trip.</p>
    <a href="<?= e(book_link('Tour Package', 'Custom tour')) ?>" class="pill pill-yellow">Plan my trip</a>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="head">
      <h2>Our vehicles</h2>
      <p>Book a vehicle with a driver, or rent a car and drive yourself.</p>
    </div>
    <div class="fleet">
      <?php foreach ($VEHICLES as $v) vehicle_card($v); ?>
    </div>
    <p class="more"><a href="rent.php" class="pill pill-navy">Rent a car</a></p>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
