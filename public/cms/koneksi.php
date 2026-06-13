<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_blog';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    $publicPages = ['beranda.php', 'detail_artikel.php'];
    $scriptName = basename($_SERVER['SCRIPT_NAME'] ?? '');

    if (in_array($scriptName, $publicPages, true)) {
        http_response_code(500);
        $message = htmlspecialchars($conn->connect_error, ENT_QUOTES, 'UTF-8');
        echo "<!DOCTYPE html>
<html lang=\"id\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <title>Koneksi Database Gagal</title>
  <style>
    body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Arial, sans-serif; background: #f4f6f8; color: #1f2937; }
    .box { max-width: 560px; margin: 20px; padding: 28px; border-radius: 8px; background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 1px 4px rgba(15,23,42,.08); }
    h1 { margin: 0 0 10px; font-size: 24px; color: #991b1b; }
    p { margin: 0 0 10px; line-height: 1.6; }
    code { display: block; margin-top: 14px; padding: 12px; border-radius: 6px; background: #fef2f2; color: #7f1d1d; white-space: pre-wrap; }
  </style>
</head>
<body>
  <div class=\"box\">
    <h1>Koneksi Database Gagal</h1>
    <p>Pastikan MySQL/Laragon/XAMPP sudah aktif dan database <strong>db_blog</strong> tersedia.</p>
    <code>{$message}</code>
  </div>
</body>
</html>";
        exit;
    }

    die(json_encode([
        'status'  => 'error',
        'message' => 'Koneksi gagal: ' . $conn->connect_error
    ]));
}

$conn->set_charset('utf8mb4');
