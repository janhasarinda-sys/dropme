<?php
// One tour: route on the map, the stops, and an enquiry button. Opened as tour.php?t=classic-sri-lanka
require_once __DIR__ . '/config.php';
$slugWanted = $_GET['t'] ?? '';
$tour = null;
foreach ($TOURS as $x) { if ($x['slug'] === $slugWanted) { $tour = $x; break; } }
if (!$tour) { header('Location: tours.php'); exit; }

$page = 'tours'; $title = $tour['title']; $useMap = true;
require __DIR__ . '/includes/header.php';
$places = count(array_unique(array_column($tour['points'], 'key')));
$others = array_filter($TOURS, fn($x) => $x['type'] === $tour['type'] && $x['slug'] !== $tour['slug']);
?>

<section class="banner banner-tour" style="background-image:url('<?= e($tour['img']) ?>')">
  <div class="container banner-in">
    <p class="crumbs"><a href="tours.php">Tours</a> / <?= $tour['type'] === 'round' ? 'Round tour' : 'Day tour' ?></p>
    <h1><?= e($tour['title']) ?></h1>
    <ul class="t-meta">
      <li><b><?= e($tour['days']) ?></b><span>Duration</span></li>
      <li><b><?= $places ?></b><span>Places on the route</span></li>
      <li><b>Private</b><span>Your own vehicle & driver</span></li>
    </ul>
  </div>
</section>

<section class="section">
  <div class="container t-layout">
    <div class="t-info reveal">
      <h2>The trip</h2>
      <p class="t-lead"><?= e($tour['text']) ?></p>

      <h3 class="t-sub">Where we stop</h3>
      <ol class="timeline">
        <?php foreach ($tour['stops'] as $i => $s): ?>
        <li><span class="tl-n"><?= $i + 1 ?></span><span class="tl-t"><?= e($s) ?></span></li>
        <?php endforeach; ?>
      </ol>

      <h3 class="t-sub">Included</h3>
      <ul class="ticks">
        <li>Private air-conditioned vehicle</li>
        <li>English-speaking licensed driver</li>
        <li>Pickup from the airport or your hotel</li>
        <li>Hotels booked on the route if you want</li>
      </ul>
      <p class="t-note">Every tour can be changed: add a day, skip a stop, or start from your hotel.</p>
      <div class="tour-btns">
        <a href="<?= e(book_link('Tour Package', $tour['title'])) ?>" class="pill pill-yellow">Enquire about this tour</a>
        <a href="<?= e($wa . '?text=' . rawurlencode('Hello DropMe Tours, I am interested in the "' . $tour['title'] . '" tour.')) ?>" class="pill pill-wa" target="_blank" rel="noopener">Ask on WhatsApp</a>
      </div>
    </div>
    <div class="t-map">
      <?php route_explorer([$tour], 'tourmap', true); ?>
    </div>
  </div>
</section>

<?php if ($others): ?>
<section class="section mist">
  <div class="container">
    <div class="head reveal">
      <h2>More <?= $tour['type'] === 'round' ? 'round' : 'day' ?> tours</h2>
    </div>
    <div class="tiles">
      <?php foreach (array_slice(array_values($others), 0, 4) as $o) tour_tile($o); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
