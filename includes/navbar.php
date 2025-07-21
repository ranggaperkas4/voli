<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';
?>
<link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">

<nav class="custom-navbar">
  <div class="navbar-left">
    <h3 class="navbar-logo">VoliKampus</h3>
  </div>
  <div class="navbar-right">
    <a href="<?= $basePath ?>index.php">Beranda</a>
    <a href="<?= $basePath ?>index.php?page=jadwal">Jadwal</a>
    <a href="<?= $basePath ?>index.php?page=klasemen">Klasemen</a>
    <a href="<?= $basePath ?>index.php?page=tentang">Tentang</a>

    <?php if (isset($_SESSION['role'])): ?>
      <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="<?= $basePath ?>index.php?page=admin">Panel Admin</a>
        <a href="<?= $basePath ?>index.php?page=kelola_tim">Kelola Tim</a>
      <?php elseif ($_SESSION['role'] === 'panitia'): ?>
        <a href="<?= $basePath ?>index.php?page=admin">Panel Panitia</a>
      <?php endif; ?>
      <a href="<?= $basePath ?>index.php?page=logout" class="logout-btn">Logout</a>
    <?php else: ?>
      <a href="<?= $basePath ?>index.php?page=login">Login</a>
    <?php endif; ?>
  </div>
</nav>
