<?php $page = 'about'; $title = 'About us'; require __DIR__ . '/includes/header.php'; ?>

<?php page_banner('About Us', 'A travel company from Wadduwa, on Sri Lanka\'s west coast.', 'images/tours/kandy.jpg'); ?>

<section class="section">
  <div class="container about-in">
    <div>
      <h2>Travel smart, safe and better</h2>
      <p style="margin-top:18px">DropMe Tours (Pvt) Ltd started in <?= (int)$SITE['since'] ?>. Most of our work is simple: picking people up from the airport, driving them to their hotel, and taking them around the island while they're here.</p>
      <p>We also hire out vans and coaches with drivers, and rent cars to people who would rather drive themselves.</p>
      <p>Our drivers are licensed and speak English, and our vehicles are air conditioned. We agree the price with you before you travel.</p>
      <p style="margin-top:28px"><a href="contact.php" class="pill pill-navy">Get in touch</a></p>
    </div>
    <img src="images/logo.jpg" alt="DropMe Tours logo" width="640" height="641" style="border-radius:50%;width:100%;max-width:440px;justify-self:center">
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
