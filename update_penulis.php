<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id = $_POST['id'];
$sql = "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?";
$params = [$_POST['nama_depan'], $_POST['nama_belakang'], $_POST['user_name']];
$types = "sss";

if (!empty($_POST['password'])) {
    $sql .= ", password=?";
    $params[] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $types .= "s";
}
if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads_penulis/' . $foto);
    $sql .= ", foto=?";
    $params[] = $foto;
    $types .= "s";
}

$sql .= " WHERE id=?";
$params[] = $id;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

try {
    echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Penulis diperbarui!"] : ["status" => "gagal", "pesan" => "Gagal memperbarui."]);
} catch (Exception $e) {
    echo json_encode(["status" => "gagal", "pesan" => "Username sudah ada."]);
}
?>