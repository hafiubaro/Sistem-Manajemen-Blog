<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id = $_POST['id'];
$foto = $conn->query("SELECT foto FROM penulis WHERE id=$id")->fetch_assoc()['foto'] ?? '';

try {
    if ($conn->query("DELETE FROM penulis WHERE id=$id")) {
        if ($foto && $foto != 'default.png' && file_exists("uploads_penulis/$foto")) unlink("uploads_penulis/$foto");
        echo json_encode(["status" => "sukses", "pesan" => "Penulis dihapus!"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "gagal", "pesan" => "Penulis memiliki artikel, tidak bisa dihapus."]);
}
?>