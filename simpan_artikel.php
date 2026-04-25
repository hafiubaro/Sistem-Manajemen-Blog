<?php
header('Content-Type: application/json');
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$bulan = [1=>'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$now = new DateTime();
$hari_tanggal = $hari[$now->format('w')] . ", " . $now->format('j') . " " . $bulan[(int)$now->format('n')] . " " . $now->format('Y') . " | " . $now->format('H:i');

$gambar = '';
if (!empty($_FILES['gambar']['name'])) {
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $gambar = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads_artikel/' . $gambar);
}

$stmt = $conn->prepare("INSERT INTO artikel (id_penulis, id_kategori, judul, isi, gambar, hari_tanggal) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissss", $_POST['id_penulis'], $_POST['id_kategori'], $_POST['judul'], $_POST['isi'], $gambar, $hari_tanggal);

echo json_encode($stmt->execute() ? ["status" => "sukses", "pesan" => "Artikel disimpan!"] : ["status" => "gagal", "pesan" => "Gagal menyimpan artikel."]);
?>