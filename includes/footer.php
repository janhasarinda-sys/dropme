</main>

<footer class="footer">
  <div class="container footer-in">
    <div class="f-brand">
      <img src="images/logo.jpg" alt="" width="90" height="90">
      <p class="f-name"><?= e($SITE['name']) ?></p>
      <p><?= e($SITE['tagline']) ?></p>
    </div>
    <div>
      <h2>Contact</h2>
      <p><a href="tel:<?= e($tel) ?>"><?= e($SITE['phone']) ?></a></p>
      <p><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></p>
      <p><a href="<?= e($SITE['map_link']) ?>" target="_blank" rel="noopener"><?= e($SITE['address']) ?></a></p>
      <p>Open every day, 24 hours</p>
    </div>
    <div>
      <h2>Explore</h2>
      <nav aria-label="Footer">
        <?php foreach ($NAV as [$href, $label]): ?><a href="<?= $href ?>"><?= e($label) ?></a><?php endforeach; ?>
      </nav>
    </div>
  </div>
  <div class="container f-bottom">
    <p>© <?= date('Y') ?> <?= e($SITE['name']) ?></p>
  </div>
</footer>

<a href="<?= e($wa) ?>" class="wa-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.2-.4.2-.4.7-1.3a.5.5 0 0 0 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .1-1.2c0-.1-.2-.2-.5-.3Z"/></svg>
</a>

<script>window.WA_NUMBER = <?= json_encode($SITE['whatsapp']) ?>;</script>
<script src="js/main.js?v=2"></script>
<?php if (!empty($useMap)): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script src="js/map.js?v=2"></script>
<?php endif; ?>
</body>
</html>
