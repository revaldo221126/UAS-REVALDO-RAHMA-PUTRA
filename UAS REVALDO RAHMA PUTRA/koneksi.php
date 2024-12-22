<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ekstrakurikuler_db";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
