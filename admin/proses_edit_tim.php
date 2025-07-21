<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_tim = $_POST['id_tim'];
  $nama_tim = $_POST['nama_tim'];
  $fakultas = $_POST['fakultas'];
  $pelatih = $_POST['pelatih'];
  $kapten = $_POST['kapten'];

  $query = "UPDATE tim SET 
              nama_tim = '$nama_tim',
              fakultas = '$fakultas',
              pelatih = '$pelatih',
              kapten = '$kapten'
            WHERE id_tim = '$id_tim'";

  if (mysqli_query($conn, $query)) {
    $_SESSION['alert'] = [
      'icon' => 'success',
      'title' => 'Berhasil',
      'text' => 'Data tim berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Gagal',
      'text' => 'Terjadi kesalahan saat mengubah data.'
    ];
  }

  header('Location:' . $basePath . ' index.php?page=kelola_tim');
  exit;
}
