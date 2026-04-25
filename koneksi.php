<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_uts"; // Sesuaikan dengan nama databasemu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["status" => "gagal", "pesan" => "Koneksi database gagal!"]);
    exit();
}
?>