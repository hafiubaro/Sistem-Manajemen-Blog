<?php
header('Content-Type: application/json');
include 'koneksi.php';

$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
$foto = 'default.png';

if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads_penulis/' . $foto);
}

$stmt = $conn->prepare("INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['user_name'], $pass, $foto);

try {
    echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Penulis disimpan!"] : ["status" => "gagal", "pesan" => "Gagal menyimpan penulis."]);
} catch (Exception $e) {
    echo json_encode(["status" => "gagal", "pesan" => "Username mungkin sudah digunakan."]);
}
?>