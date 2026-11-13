<?php $page = 'gallery'; $title = 'Gallery'; require __DIR__ . '/includes/header.php'; ?>

<?php page_banner('Gallery', 'Places we take our guests, and the vehicles we take them in.', 'images/tours/leopard.jpg'); ?>

<section class="section">
  <div class="container">
    <ul class="gallery">
      <?php foreach ($GALLERY as $i => [$src, $cap]): ?>
      <li>
        <button type="button" class="g-item" data-index="<?= $i ?>" aria-label="Open photo: <?= e($cap) ?>">
          <img src="<?= e($src) ?>" alt="<?= e($cap) ?>" loading="lazy">
          <span class="g-cap"><?= e($cap) ?></span>
        </button>
      </li>
      <?php endforeach; ?>
    </ul>

    <p class="g-credits">Photos from Wikimedia Commons:
      <?php foreach ($CREDITS as $n => [$what, $who, $lic, $url]): ?><a href="<?= e($url) ?>" target="_blank" rel="noopener"><?= e($what) ?></a> by <?= e($who) ?> (<?= e($lic) ?>)<?= $n < count($CREDITS) - 1 ? '; ' : '.' ?><?php endforeach; ?>
      Other photos are public domain (CC0).</p>
  </div>
</section>

<dialog class="lightbox" id="lightbox" aria-label="Photo viewer">
  <button type="button" class="lb-close" aria-label="Close">×</button>
  <button type="button" class="lb-prev" aria-label="Previous photo">‹</button>
  <figure>
    <img src="" alt="">
    <figcaption></figcaption>
  </figure>
  <button type="button" class="lb-next" aria-label="Next photo">›</button>
</dialog>

<script>window.GALLERY = <?= json_encode(array_map(fn($g) => ['src' => $g[0], 'cap' => $g[1]], $GALLERY)) ?>;</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
