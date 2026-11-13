<?php
// Receives booking requests from the form, saves them to data/bookings.csv
// and tries to email them (email only works if PHP mail/SMTP is configured).
require __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Invalid request']);
    exit;
}
if (!empty($_POST['website'])) { // spam honeypot
    echo json_encode(['ok' => true]);
    exit;
}

$fields = ['name','phone','email','service','item','date_from','date_to','pickup','pax','message'];
$d = [];
foreach ($fields as $f) {
    $v = trim((string)($_POST[$f] ?? ''));
    $v = str_replace(["\r", "\0"], '', $v);
    $d[$f] = mb_substr($v, 0, $f === 'message' ? 2000 : 200);
}

if ($d['name'] === '' || $d['phone'] === '' || $d['service'] === '' || $d['date_from'] === '') {
    echo json_encode(['ok' => false, 'error' => 'Please fill in the required fields.']);
    exit;
}
if ($d['email'] !== '' && !filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'error' => 'Please enter a valid email address.']);
    exit;
}

$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755, true);
$file = $dir . '/bookings.csv';
$new  = !file_exists($file);
$fh = fopen($file, 'a');
if (!$fh) {
    echo json_encode(['ok' => false, 'error' => 'Could not save. Please call or WhatsApp us.']);
    exit;
}
flock($fh, LOCK_EX);
if ($new) fputcsv($fh, array_merge(['received'], $fields));
// prevent CSV formula injection when opened in Excel
$row = array_map(fn($v) => preg_match('/^[=+\-@]/', $v) ? "'" . $v : $v, $d);
fputcsv($fh, array_merge([date('Y-m-d H:i:s')], array_values($row)));
flock($fh, LOCK_UN);
fclose($fh);

// Email notification (silently skipped if mail is not configured on this server)
$body = "New booking request\n\n";
foreach ($d as $k => $v) $body .= str_pad(ucfirst(str_replace('_', ' ', $k)) . ':', 14) . $v . "\n";
$headers = "From: DropMe Website <no-reply@dropmetours.lk>\r\n";
if ($d['email'] !== '') $headers .= "Reply-To: " . $d['email'] . "\r\n";
@mail($SITE['email'], 'New booking: ' . $d['service'] . ' - ' . $d['name'], $body, $headers);

echo json_encode(['ok' => true]);
