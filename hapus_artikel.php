<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id = $_POST['id'];
$gambar = $conn->query("SELECT gambar FROM artikel WHERE id=$id")->fetch_assoc()['gambar'] ?? '';

if ($conn->query("DELETE FROM artikel WHERE id=$id")) {
    if ($gambar && file_exists("uploads_artikel/$gambar")) unlink("uploads_artikel/$gambar");
    echo json_encode(["status" => "sukses", "pesan" => "Artikel dihapus!"]);
} else {
    echo json_encode(["status" => "gagal", "pesan" => "Gagal menghapus artikel."]);
}
?>