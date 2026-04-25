<?php
header('Content-Type: application/json');
include 'koneksi.php';

$stmt = $conn->prepare("INSERT INTO kategori_artikel (nama_kategori, keterangan) VALUES (?, ?)");
$stmt->bind_param("ss", $_POST['nama_kategori'], $_POST['keterangan']);

echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Kategori berhasil disimpan!"] : ["status" => "gagal", "pesan" => "Gagal menyimpan data."]);
?>