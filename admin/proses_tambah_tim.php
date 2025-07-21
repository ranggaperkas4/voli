<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
$basePath = $isAdminFolder ? '../' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_tim = $_POST['nama_tim'];
  $fakultas = $_POST['fakultas'];
  $pelatih = $_POST['pelatih'];
  $kapten = $_POST['kapten'];

  $cekStmt = $conn->prepare("SELECT id_tim FROM tim WHERE nama_tim = ?");
  $cekStmt->bind_param("s", $nama_tim);
  $cekStmt->execute();
  $cekStmt->store_result();

  if ($cekStmt->num_rows > 0) {
    $_SESSION['alert'] = [
      'icon' => 'warning',
      'title' => 'Nama Tim Duplikat',
      'text' => 'Nama tim sudah terdaftar.'
    ];
    $cekStmt->close();
    header('Location: ' . $basePath . 'index.php?page=kelola_tim');
    exit;
  }
  $cekStmt->close();

  $stmt = $conn->prepare("INSERT INTO tim (nama_tim, fakultas, pelatih, kapten) VALUES (?, ?, ?, ?)");
  if ($stmt) {
    $stmt->bind_param("ssss", $nama_tim, $fakultas, $pelatih, $kapten);
    if ($stmt->execute()) {
      $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Berhasil',
        'text' => 'Tim baru berhasil ditambahkan.'
      ];
    } else {
      $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal',
        'text' => 'Gagal menambahkan tim ke database.'
      ];
    }
    $stmt->close();
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Error',
      'text' => 'Prepare statement gagal.'
    ];
  }

  header('Location: ' . $basePath . 'index.php?page=kelola_tim');
  exit;
}
