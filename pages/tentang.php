<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tentang | VoliKampus</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/tentang.css">
</head>
<body>

<!-- Konten -->
<div class="container tentang-container pt-5">
  <div class="tentang-box text-center">
    <h1 class="mb-4 text-primary">Tentang Pembuat</h1>
    <img src="assets/img/rangga.jpg" alt="Foto Pembuat" class="foto-profil mb-4">

    <table class="table table-borderless text-start mx-auto" style="max-width: 500px;">
      <tbody>
        <tr><th width="30%">Nama</th><td>: Rangga Perkasa</td></tr>
        <tr><th>NPM</th><td>: 2306700003</td></tr>
        <tr><th>Email</th><td>: ranggaperkas4@gmail.com</td></tr>
        <tr><th>Universitas</th><td>: Universitas Mandiri</td></tr>
      </tbody>
    </table>

    <!-- Tombol Lihat Paper -->
    <div class="mt-3">
      <a href="index.php?page=paper" class="btn btn-outline-primary shadow-sm rounded-pill">
        <i class="bi bi-file-earmark-text"></i> Lihat Paper
      </a>
    </div>

    <p class="mt-4 text-muted small">&copy; <?= date("Y") ?> VoliKampus. Dibuat oleh Rangga Perkasa.</p>
  </div>
</div>

</body>
</html>
