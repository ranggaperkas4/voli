<?php
$host = "localhost";
$user = "root";
$pass = ""; // atau sesuaikan
$db   = "voli_kampus"; // ganti sesuai nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
