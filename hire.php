<?php $page = 'hire'; $title = 'Vehicle hire with driver'; require __DIR__ . '/includes/header.php'; ?>

<?php page_banner('Vehicle Hire', 'A car, van or coach with an experienced driver, for a few hours or a few weeks.', 'images/tours/galle.jpg'); ?>

<section class="section">
  <div class="container">
    <div class="head">
      <h2>Choose your vehicle</h2>
      <p>Fuel, the driver's room and highway tolls can be included in the price if you ask.</p>
    </div>
    <div class="fleet">
      <?php foreach ($VEHICLES as $v) vehicle_card($v); ?>
    </div>
  </div>
</section>

<section class="section mist">
  <div class="container">
    <div class="head"><h2>What people hire us for</h2></div>
    <ul class="points">
      <li><b>Airport transfers</b><span>Pickup and drop at Bandaranaike Airport, day or night.</span></li>
      <li><b>Weddings and events</b><span>Cars and vans for families, decorated cars on request.</span></li>
      <li><b>Staff transport</b><span>Daily runs or monthly contracts for companies.</span></li>
      <li><b>Long trips</b><span>Multi-day journeys anywhere on the island.</span></li>
    </ul>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
