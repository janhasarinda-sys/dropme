<?php $page = 'tours'; $title = 'Tours around Sri Lanka'; $useMap = true; require __DIR__ . '/includes/header.php';
$round = array_filter($TOURS, fn($t) => $t['type'] === 'round');
$day   = array_filter($TOURS, fn($t) => $t['type'] === 'day');
?>

<?php page_banner('Our Tours', 'Every tour can be changed: add a day, skip a stop, or start from your hotel.', 'images/tours/ella.jpg'); ?>

<section class="section mist" id="route-map">
  <div class="container">
    <div class="head reveal">
      <p class="eyebrow">Round tour route map</p>
      <h2>See where we're going</h2>
      <p>Pick a round tour to see its route across Sri Lanka. Press play to follow the trip stop by stop.</p>
    </div>
    <?php route_explorer($round, 'tours-explorer'); ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="tour-group" id="round-tours">
      <div class="head">
        <h2>Round tours</h2>
        <p>Several days with your own driver. We book hotels on the way if you want.</p>
      </div>
      <div class="tour-list">
        <?php foreach ($round as $t) tour_card($t); ?>
      </div>
    </div>
    <div class="tour-group" id="day-tours">
      <div class="head">
        <h2>Day tours</h2>
        <p>Pickup in the morning, back the same day. Long drives start early.</p>
      </div>
      <div class="tour-list">
        <?php foreach ($day as $t) tour_card($t); ?>
      </div>
    </div>
  </div>
</section>

<section class="section mist">
  <div class="container">
    <div class="head"><h2>Every tour includes</h2></div>
    <ul class="points">
      <li><b>Your own vehicle</b><span>Private and air conditioned, sized for your group.</span></li>
      <li><b>An English-speaking driver</b><span>Licensed, and knows the stops worth making.</span></li>
      <li><b>Pickup where you are</b><span>The airport, your hotel, or anywhere on the west coast.</span></li>
      <li><b>Hotels if you want</b><span>Tell us your budget and we'll book on the route.</span></li>
    </ul>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
