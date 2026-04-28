<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id            = (int)($_POST['id'] ?? 0);
$nama_depan    = trim($_POST['nama_depan']    ?? '');
$nama_belakang = trim($_POST['nama_belakang'] ?? '');
$user_name     = trim($_POST['user_name']     ?? '');
$password_raw  = $_POST['password'] ?? '';

if ($id <= 0 || !$nama_depan || !$nama_belakang || !$user_name) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
    exit;
}

// Ambil data lama
$stmtOld = $conn->prepare("SELECT foto FROM penulis WHERE id = ?");
$stmtOld->bind_param('i', $id);
$stmtOld->execute();
$old = $stmtOld->get_result()->fetch_assoc();
if (!$old) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
    exit;
}

$foto = $old['foto'];

// Handle foto baru (opsional)
if (!empty($_FILES['foto']['name'])) {
    $finfo   = new finfo(FILEINFO_MIME_TYPE);
    $mime    = $finfo->file($_FILES['foto']['tmp_name']);
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan.']);
        exit;
    }
    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file melebihi 2 MB.']);
        exit;
    }
    // Hapus foto lama jika bukan default
    if ($old['foto'] !== 'default.png' && file_exists('uploads_penulis/' . $old['foto'])) {
        unlink('uploads_penulis/' . $old['foto']);
    }
    $ext  = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $foto = uniqid('penulis_') . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads_penulis/' . $foto);
}

// Build query tergantung apakah password diubah
if (!empty($password_raw)) {
    $password = password_hash($password_raw, PASSWORD_BCRYPT);
    $stmt = $conn->prepare(
        "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, password=?, foto=? WHERE id=?"
    );
    $stmt->bind_param('sssssi', $nama_depan, $nama_belakang, $user_name, $password, $foto, $id);
} else {
    $stmt = $conn->prepare(
        "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, foto=? WHERE id=?"
    );
    $stmt->bind_param('ssssi', $nama_depan, $nama_belakang, $user_name, $foto, $id);
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Data penulis berhasil diperbarui.']);
} else {
    if ($conn->errno === 1062) {
        echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui: ' . $stmt->error]);
    }
}
