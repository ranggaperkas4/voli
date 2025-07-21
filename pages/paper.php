<?php include __DIR__ . '/../includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Paper Kuliah - VoliKampus</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 80px;
    }
    .pdf-container {
      height: 90vh;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3 class="mb-4 text-primary">PENGARUH SUMBER INFORMASI TERHADAP TINGKAT PENGETAHUAN
MAHASISWA TENTANG KOMPETISI BOLA VOLI DI TINGKAT UNIVERSITAS </h3>

    <div class="pdf-container">
   <iframe 
  src="assets/pdfjs/web/viewer.html?file=../../files/paper_kuliah.pdf" 
  width="100%" 
  height="700px">
</iframe>
    </div>

    <p class="mt-3">
      <a href="index.php" class="btn btn-secondary">&larr; Kembali ke Beranda</a>
    </p>
  </div>
</body>
</html>
