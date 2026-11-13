<?php $page = 'contact'; $title = 'Contact and booking'; require __DIR__ . '/includes/header.php';
$services = ['Tour Package', 'Vehicle Hire (with driver)', 'Rent a Car (self drive)', 'Airport Transfer'];
$selService = in_array($_GET['service'] ?? '', $services, true) ? $_GET['service'] : '';
$selItem = mb_substr((string)($_GET['item'] ?? ''), 0, 200);
?>

<?php page_banner('Contact Us', 'The quickest way to reach us is WhatsApp. For a price, send the form below.', 'images/tours/madu.jpg'); ?>

<section class="section">
  <div class="container contact-in">
    <div>
      <h2>Get in touch</h2>
      <dl class="contact-list">
        <div><dt>Phone and WhatsApp</dt><dd><a href="tel:<?= e($tel) ?>"><?= e($SITE['phone']) ?></a></dd></div>
        <div><dt>Email</dt><dd><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></dd></div>
        <div><dt>Office</dt><dd><a href="<?= e($SITE['map_link']) ?>" target="_blank" rel="noopener"><?= e($SITE['address']) ?></a></dd></div>
        <div><dt>Hours</dt><dd>Every day, 24 hours</dd></div>
      </dl>
    </div>
    <div class="map">
      <iframe src="<?= e($SITE['map_embed']) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map of Wadduwa"></iframe>
    </div>
  </div>
</section>

<section class="section mist" id="book">
  <div class="container">
    <div class="head"><h2>Send an enquiry</h2></div>
    <p class="req">Fields marked * are required.</p>
    <form class="book-form" id="bookForm" novalidate>
      <div class="form-grid">
        <label>Your name *<input name="name" required autocomplete="name"></label>
        <label>Phone or WhatsApp *<input name="phone" type="tel" required autocomplete="tel"></label>
        <label>Email<input name="email" type="email" autocomplete="email"></label>
        <label>What do you need? *
          <select name="service" required>
            <option value="">Choose one</option>
            <?php foreach ($services as $s): ?><option<?= $s === $selService ? ' selected' : '' ?>><?= e($s) ?></option><?php endforeach; ?>
          </select>
        </label>
        <label class="full">Tour, vehicle or route<input name="item" value="<?= e($selItem) ?>" placeholder="For example: Kandy day tour, or a van to the airport"></label>
        <label>Pickup date *<input name="date_from" type="date" required></label>
        <label>Return date<input name="date_to" type="date"></label>
        <label>Pickup place<input name="pickup" placeholder="Hotel, airport or town"></label>
        <label>Number of people<input name="pax" type="number" min="1" max="60" value="2"></label>
        <label class="full">Anything else<textarea name="message" rows="4" placeholder="Places you'd like to see, luggage, child seats..."></textarea></label>
      </div>
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
      <div class="form-btns">
        <button type="submit" class="pill pill-yellow">Send enquiry</button>
        <button type="button" class="pill pill-wa" id="waBtn">Send on WhatsApp instead</button>
      </div>
      <p class="form-msg" id="formMsg" role="status"></p>
    </form>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
