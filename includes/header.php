<?php
// Shared top of every page. Set $page (nav key) and $title before including.
require_once __DIR__ . '/../config.php';
if (!function_exists('e')) { function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); } }
$tel = preg_replace('/\s+/', '', $SITE['phone']);
$wa  = 'https://wa.me/' . $SITE['whatsapp'];
$page  = $page ?? '';
$title = $title ?? 'Tours, Vehicle Hire & Rent a Car in Sri Lanka';
$useMap = $useMap ?? false;
$NAV = [
    'home'    => ['index.php',   'Home'],
    'tours'   => ['tours.php',   'Tours'],
    'hire'    => ['hire.php',    'Vehicle Hire'],
    'rent'    => ['rent.php',    'Rent a Car'],
    'gallery' => ['gallery.php', 'Gallery'],
    'about'   => ['about.php',   'About Us'],
    'contact' => ['contact.php', 'Contact'],
];

// Link that opens the booking form with service/item pre-selected
function book_link($service = '', $item = '') {
    $q = array_filter(['service' => $service, 'item' => $item]);
    return 'contact.php' . ($q ? '?' . http_build_query($q) : '') . '#book';
}

function tour_link($t) { return 'tour.php?t=' . urlencode($t['slug']); }

// Interactive route map: tabs for each tour, map, and a side panel with the stops.
// $tours = list of tours to show; $single = true hides the tabs (tour page)
function route_explorer($tours, $id = 'explorer', $single = false) {
    $tours = array_values(array_filter($tours, fn($t) => !empty($t['points'])));
    if (!$tours) return; ?>
    <div class="explorer<?= $single ? ' explorer-single' : '' ?>" id="<?= e($id) ?>">
      <script type="application/json" class="ex-data"><?= tours_map_json($tours) ?></script>
      <?php if (!$single): ?>
      <div class="ex-tabs" role="tablist" aria-label="Choose a tour">
        <?php foreach ($tours as $i => $t): ?>
        <button type="button" role="tab" class="ex-tab" data-i="<?= $i ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
          <span class="ex-tab-t"><?= e($t['title']) ?></span><span class="ex-tab-d"><?= e($t['days']) ?></span>
        </button>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <div class="ex-grid">
        <div class="ex-map-wrap">
          <div class="ex-map" role="region" aria-label="Map of the tour route"></div>
          <div class="ex-map-tools">
            <button type="button" class="ex-play pill pill-yellow">▶ Play the route</button>
            <span class="ex-dist"></span>
          </div>
        </div>
        <aside class="ex-panel" aria-live="polite">
          <?php if (!$single): ?>
          <img class="ex-img" src="<?= e($tours[0]['img']) ?>" alt="" width="1280" height="853">
          <p class="ex-days"><?= e($tours[0]['days']) ?></p>
          <h3 class="ex-title"><?= e($tours[0]['title']) ?></h3>
          <?php else: ?>
          <h3 class="ex-title-s">Where we go</h3>
          <?php endif; ?>
          <ol class="ex-stops"></ol>
          <?php if (!$single): ?>
          <div class="ex-actions">
            <a class="pill pill-navy ex-view" href="<?= e(tour_link($tours[0])) ?>">Tour details</a>
            <a class="pill pill-yellow ex-book" href="<?= e(book_link('Tour Package', $tours[0]['title'])) ?>">Enquire</a>
          </div>
          <?php endif; ?>
        </aside>
      </div>
    </div>
<?php }

// Photo card with the title over the image (home page)
function tour_tile($t, $big = false) { ?>
      <a class="tile reveal<?= $big ? ' tile-big' : '' ?>" href="<?= e(tour_link($t)) ?>">
        <img src="<?= e($t['img']) ?>" alt="" loading="lazy" width="1280" height="853">
        <span class="tile-days"><?= e($t['days']) ?></span>
        <span class="tile-text">
          <span class="tile-title"><?= e($t['title']) ?></span>
          <span class="tile-more">View tour</span>
        </span>
      </a>
<?php }

// Full tour card with route (tours page)
function tour_card($t) { ?>
      <article class="tour reveal" id="<?= e($t['slug']) ?>">
        <a href="<?= e(tour_link($t)) ?>" class="tour-img"><img src="<?= e($t['img']) ?>" alt="<?= e($t['title']) ?>" loading="lazy" width="1280" height="853"></a>
        <div class="tour-body">
          <p class="tour-days"><?= e($t['days']) ?><?php if ($t['points']): ?> · <?= count(array_unique(array_column($t['points'], 'key'))) ?> places on the map<?php endif; ?></p>
          <h3><a href="<?= e(tour_link($t)) ?>"><?= e($t['title']) ?></a></h3>
          <p><?= e($t['text']) ?></p>
          <?php if (!empty($t['stops'])): ?>
          <ol class="route"><?php foreach ($t['stops'] as $s): ?><li><?= e($s) ?></li><?php endforeach; ?></ol>
          <?php endif; ?>
          <div class="tour-btns">
            <a href="<?= e(tour_link($t)) ?>" class="pill pill-navy">See route on map</a>
            <a href="<?= e(book_link('Tour Package', $t['title'])) ?>" class="pill pill-yellow">Enquire</a>
          </div>
        </div>
      </article>
<?php }

// Vehicle card
function vehicle_card($v, $service = 'Vehicle Hire (with driver)', $btn = 'Book this vehicle') { ?>
      <article class="vehicle">
        <img src="<?= e($v['img']) ?>" alt="<?= e($v['models']) ?>" loading="lazy" width="960" height="640">
        <div class="vehicle-body">
          <h3><?= e($v['type']) ?></h3>
          <p class="v-models"><?= e($v['models']) ?></p>
          <p class="v-facts"><?= e($v['seats']) ?> passengers, <?= e($v['bags']) ?> bags<?= $v['ac'] ? ', air conditioned' : '' ?></p>
          <p class="v-rate"><?= $v['rate'] !== '' ? e($v['rate']) : 'Call us for the rate' ?></p>
          <a href="<?= e(book_link($service, $v['type'].' ('.$v['models'].')')) ?>" class="pill pill-navy"><?= e($btn) ?></a>
        </div>
      </article>
<?php }

// Photo banner at the top of inner pages
function page_banner($heading, $text = '', $img = 'images/hero-bg.jpg') { ?>
<section class="banner" style="background-image:url('<?= e($img) ?>')">
  <div class="container banner-in">
    <h1><?= e($heading) ?></h1>
    <?php if ($text): ?><p><?= e($text) ?></p><?php endif; ?>
  </div>
</section>
<?php }

function slug($s) { return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($s)), '-'); }
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> | DropMe Tours</title>
<meta name="description" content="DropMe Tours, Wadduwa: tours around Sri Lanka, airport pickups, vehicles with a driver, and self-drive car rental. Call <?= e($SITE['phone']) ?>.">
<meta name="theme-color" content="#0c2145">
<link rel="icon" href="images/logo.jpg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
<?php if (!empty($useMap)): ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<?php endif; ?>
<link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>

<header class="header" id="top">
  <div class="container header-top">
    <a class="h-wa" href="<?= e($wa) ?>" target="_blank" rel="noopener">WhatsApp <?= e($SITE['phone']) ?></a>
    <a href="index.php" class="brand" aria-label="DropMe Tours home">
      <img src="images/logo.jpg" alt="DropMe Tours" width="84" height="84">
    </a>
    <a href="<?= book_link() ?>" class="pill pill-line h-book">Enquire now</a>
    <button class="menu-btn" aria-expanded="false" aria-controls="site-nav">Menu</button>
  </div>
  <nav class="nav" id="site-nav">
    <?php foreach ($NAV as $key => [$href, $label]): ?>
      <a href="<?= $href ?>"<?= $key === $page ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
    <?php endforeach; ?>
  </nav>
</header>
<main>
