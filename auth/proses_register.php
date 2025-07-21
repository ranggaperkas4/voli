<?php
include __DIR__ . '/../koneksi.php';

// Deteksi prefix path
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
$basePath = $isAdminFolder ? '../' : '';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Cek apakah username sudah ada
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: " . $basePath . "index.php?page=register&pesan=gagal");
    exit();
}


// Simpan user baru
$query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

if ($query) {
    header("Location: " . $basePath . "index.php?page=register&pesan=berhasil");
} else {
    header("Location: " . $basePath . "index.php?page=register&pesan=gagal");
}
exit();
