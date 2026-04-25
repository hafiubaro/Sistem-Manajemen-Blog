<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id = $_POST['id'];
$sql = "UPDATE artikel SET id_penulis=?, id_kategori=?, judul=?, isi=?";
$params = [$_POST['id_penulis'], $_POST['id_kategori'], $_POST['judul'], $_POST['isi']];
$types = "iiss";

if (!empty($_FILES['gambar']['name'])) {
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $gambar = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads_artikel/' . $gambar);
    $sql .= ", gambar=?";
    $params[] = $gambar;
    $types .= "s";
}

$sql .= " WHERE id=?";
$params[] = $id;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Artikel diperbarui!"] : ["status" => "gagal", "pesan" => "Gagal update artikel."]);
?>