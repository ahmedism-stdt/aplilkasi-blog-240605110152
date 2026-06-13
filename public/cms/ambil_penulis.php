<?php
header('Content-Type: application/json');
require 'koneksi.php';

$result = $conn->query("SELECT * FROM penulis ORDER BY id ASC");
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
