<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

$tim_1 = $_POST['tim_1'];
$tim_2 = $_POST['tim_2'];
$tanggal = $_POST['tanggal_pertandingan'];
$jam = $_POST['jam'];
$tempat = $_POST['tempat'];

// Cek validasi tim tidak sama
if ($tim_1 == $tim_2) {
  $_SESSION['alert'] = [
    'icon' => 'error',
    'title' => 'Gagal',
    'text' => 'Tim 1 dan Tim 2 tidak boleh sama.'
  ];
  header('Location: ../index.php?page=input_jadwal');
  exit;
}

$query = mysqli_query($conn, "INSERT INTO jadwal (tim_1, tim_2, tanggal_pertandingan, jam, tempat)
  VALUES ('$tim_1', '$tim_2', '$tanggal', '$jam', '$tempat')");

if ($query) {
  $_SESSION['alert'] = [
    'icon' => 'success',
    'title' => 'Berhasil',
    'text' => 'Jadwal berhasil ditambahkan.'
  ];
} else {
  $_SESSION['alert'] = [
    'icon' => 'error',
    'title' => 'Gagal',
    'text' => 'Gagal menyimpan jadwal.'
  ];
}

header('Location:' . $basePath . 'index.php?page=input_jadwal');
exit;
