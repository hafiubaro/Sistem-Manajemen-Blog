<?php
header('Content-Type: application/json');
include 'koneksi.php';

$stmt = $conn->prepare("DELETE FROM kategori_artikel WHERE id = ?");
$stmt->bind_param("i", $_POST['id']);

try {
    echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Kategori dihapus!"] : ["status" => "gagal", "pesan" => "Gagal menghapus kategori."]);
} catch (Exception $e) {
    echo json_encode(["status" => "gagal", "pesan" => "Gagal: Kategori masih digunakan oleh artikel."]);
}
?>