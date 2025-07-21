<?php
// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : ''; ?>

<link rel="stylesheet" href="assets/css/style.css">
<div class="container">
  <section class="featured-section">
    <h2>Selamat Datang di Dashboard Admin VoliKampus</h2>
    <p>Kelola data tim, jadwal pertandingan, skor, dan klasemen dengan mudah.</p>

    <div class="featured-grid">
      
      <!-- Card 1: Kelola Tim -->
      <div class="destination-card">
        <img src="assets/img/tim.png" alt="Kelola Tim">
        <div class="card-content">
          <h3>Kelola Tim</h3>
          <p>Tambah, edit, dan hapus data tim peserta turnamen voli kampus.</p>
          <a href="<?= $basePath?>index.php?page=kelola_tim" class="btn">Kelola Tim</a>
        </div>
      </div>

      <!-- Card 2: Input Jadwal -->
      <div class="destination-card">
        <img src="assets/img/jadwal.png" alt="Input Jadwal">
        <div class="card-content">
          <h3>Input Jadwal</h3>
          <p>Atur jadwal pertandingan dengan waktu dan lokasi yang tepat.</p>
          <a href="<?= $basePath?>index.php?page=input_jadwal" class="btn">Input Jadwal</a>
        </div>
      </div>

      <!-- Card 3: Input Skor -->
      <div class="destination-card">
        <img src="assets/img/skor.png" alt="Input Skor">
        <div class="card-content">
          <h3>Input Skor</h3>
          <p>Masukkan hasil pertandingan dan perbarui klasemen secara otomatis.</p>
          <a href="<?= $basePath?>index.php?page=input_skor" class="btn">Input Skor</a>
        </div>
      </div>

    </div>
  </section>
</div>
<!-- SweetAlert Notifikasi -->
<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') : ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Login Gagal',
      text: 'Username atau password salah!',
      confirmButtonColor: '#d33'
    });
  </script>
<?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil') : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Login Berhasil',
      text: 'Selamat datang kembali!',
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php endif; ?>