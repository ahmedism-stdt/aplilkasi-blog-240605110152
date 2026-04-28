<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id          = (int)($_POST['id']          ?? 0);
$judul       = trim($_POST['judul']        ?? '');
$id_penulis  = (int)($_POST['id_penulis']  ?? 0);
$id_kategori = (int)($_POST['id_kategori'] ?? 0);
$isi         = trim($_POST['isi']          ?? '');

if ($id <= 0 || !$judul || !$id_penulis || !$id_kategori || !$isi) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
    exit;
}

// Ambil gambar lama
$stmtOld = $conn->prepare("SELECT gambar FROM artikel WHERE id = ?");
$stmtOld->bind_param('i', $id);
$stmtOld->execute();
$old = $stmtOld->get_result()->fetch_assoc();
if (!$old) {
    echo json_encode(['status' => 'error', 'message' => 'Artikel tidak ditemukan.']);
    exit;
}

$gambar = $old['gambar'];

// Handle gambar baru (opsional)
if (!empty($_FILES['gambar']['name'])) {
    $finfo   = new finfo(FILEINFO_MIME_TYPE);
    $mime    = $finfo->file($_FILES['gambar']['tmp_name']);
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan.']);
        exit;
    }
    if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file melebihi 2 MB.']);
        exit;
    }
    // Hapus gambar lama
    if (file_exists('uploads_artikel/' . $old['gambar'])) {
        unlink('uploads_artikel/' . $old['gambar']);
    }
    $ext    = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $gambar = uniqid('artikel_') . '.' . $ext;
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads_artikel/' . $gambar);
}

$stmt = $conn->prepare(
    "UPDATE artikel SET id_penulis=?, id_kategori=?, judul=?, isi=?, gambar=? WHERE id=?"
);
$stmt->bind_param('iisssi', $id_penulis, $id_kategori, $judul, $isi, $gambar, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil diperbarui.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui: ' . $stmt->error]);
}
