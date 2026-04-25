<?php
header('Content-Type: application/json');
include 'koneksi.php';

$stmt = $conn->prepare("SELECT * FROM kategori_artikel WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

echo json_encode($row ? ["status" => "sukses", "data" => $row] : ["status" => "gagal", "pesan" => "Data tidak ditemukan."]);
?>