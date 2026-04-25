<?php
header('Content-Type: application/json');
include 'koneksi.php';

$stmt = $conn->prepare("UPDATE kategori_artikel SET nama_kategori=?, keterangan=? WHERE id=?");
$stmt->bind_param("ssi", $_POST['nama_kategori'], $_POST['keterangan'], $_POST['id']);

echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Kategori diperbarui!"] : ["status" => "gagal", "pesan" => "Gagal memperbarui data."]);
?>