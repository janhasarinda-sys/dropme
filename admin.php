<?php
// Simple page to view booking requests: http://localhost/dropmetours/admin.php
require __DIR__ . '/config.php';
session_start();
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

if (isset($_GET['logout'])) { session_destroy(); header('Location: admin.php'); exit; }
if (isset($_POST['password'])) {
    if (hash_equals($ADMIN_PASSWORD, $_POST['password'])) { $_SESSION['dm_admin'] = true; session_regenerate_id(true); }
    else $error = 'Wrong password';
}
$logged = !empty($_SESSION['dm_admin']);
$rows = [];
if ($logged && file_exists(__DIR__ . '/data/bookings.csv')) {
    $fh = fopen(__DIR__ . '/data/bookings.csv', 'r');
    while (($r = fgetcsv($fh)) !== false) $rows[] = $r;
    fclose($fh);
}
$head = $rows ? array_shift($rows) : [];
$rows = array_reverse($rows);
?><!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Bookings | DropMe Tours Admin</title>
<style>
body{font-family:system-ui,sans-serif;margin:0;background:#eef4fb;color:#1d2433}
header{background:#0b2a5b;color:#fff;padding:14px 20px;display:flex;justify-content:space-between;align-items:center}
header a{color:#f6b400}
main{padding:20px;overflow-x:auto}
table{border-collapse:collapse;background:#fff;width:100%;font-size:14px}
th,td{padding:8px 10px;border:1px solid #dbe3ef;text-align:left;vertical-align:top}
th{background:#f6b400;color:#0b2a5b;white-space:nowrap}
form{max-width:320px;margin:80px auto;background:#fff;padding:30px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.1)}
input,button{width:100%;padding:10px;margin-top:10px;font:inherit;box-sizing:border-box}
button{background:#0b2a5b;color:#fff;border:0;border-radius:6px;cursor:pointer}
.err{color:#d03333}
</style></head><body>
<header><b>DropMe Tours – Booking Requests</b><?php if ($logged): ?><a href="?logout=1">Logout</a><?php endif; ?></header>
<?php if (!$logged): ?>
<form method="post"><h3>Admin login</h3><?php if (!empty($error)) echo '<p class="err">'.e($error).'</p>'; ?>
<input type="password" name="password" placeholder="Password" autofocus required><button>Login</button></form>
<?php else: ?>
<main>
<p><?= count($rows) ?> request(s). File: <code>data/bookings.csv</code> (opens in Excel)</p>
<?php if ($rows): ?>
<table><tr><?php foreach ($head as $h) echo '<th>'.e(ucfirst(str_replace('_',' ',$h))).'</th>'; ?></tr>
<?php foreach ($rows as $r): ?><tr><?php foreach ($r as $c) echo '<td>'.nl2br(e(ltrim($c, "'"))).'</td>'; ?></tr><?php endforeach; ?>
</table>
<?php endif; ?>
</main>
<?php endif; ?>
</body></html>
