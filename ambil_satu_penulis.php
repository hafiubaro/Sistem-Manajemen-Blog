<?php
header('Content-Type: application/json');
include 'koneksi.php';

$stmt = $conn->prepare("SELECT id, nama_depan, nama_belakang, user_name, foto FROM penulis WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

echo json_encode($row ? ["status" => "sukses", "data" => $row] : ["status" => "gagal", "pesan" => "Penulis tidak ditemukan."]);
?>