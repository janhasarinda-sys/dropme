<?php $page = 'rent'; $title = 'Rent a car (self drive)'; require __DIR__ . '/includes/header.php'; ?>

<?php page_banner('Rent a Car', 'Drive yourself. Daily, weekly or monthly, with insurance and delivery.', 'images/tours/sigiriya.jpg'); ?>

<section class="section">
  <div class="container">
    <div class="fleet two">
      <?php foreach ($VEHICLES as $v) if ($v['self']) vehicle_card($v, 'Rent a Car (self drive)', 'Rent this car'); ?>
    </div>
  </div>
</section>

<section class="section mist">
  <div class="container two-col">
    <div>
      <h2>Included</h2>
      <ul>
        <li>Comprehensive insurance</li>
        <li>Free delivery and collection around Wadduwa, Kalutara and Panadura</li>
        <li>Help on the phone 24 hours a day</li>
      </ul>
    </div>
    <div>
      <h2>What you need</h2>
      <ul>
        <li>A valid driving licence: Sri Lankan, or an International Driving Permit</li>
        <li>Your NIC or passport</li>
        <li>A refundable deposit</li>
      </ul>
      <a href="<?= e(book_link('Rent a Car (self drive)')) ?>" class="pill pill-yellow">Ask for a rental price</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
