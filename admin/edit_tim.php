<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';
$id_tim = $_GET['id'] ?? null;
if (!$id_tim) {
  header("Location:" . $basePath ."index.php?page=kelola_tim");
  exit;
}

$query = mysqli_query($conn, "SELECT * FROM tim WHERE id_tim = '$id_tim'");
$data = mysqli_fetch_assoc($query);

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

if (!$data) {
  $_SESSION['alert'] = [
    'icon' => 'error',
    'title' => 'Data Tidak Ditemukan',
    'text' => 'Tim dengan ID tersebut tidak ditemukan.'
  ];
  header("Location:" . $basePath . " index.php?page=kelola_tim");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tim</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container py-5">
  <h3 class="mb-4">Edit Tim: <?= htmlspecialchars($data['nama_tim']) ?></h3>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="<?= $basePath?>index.php?page=proses_edit_tim" method="POST">
        <input type="hidden" name="id_tim" value="<?= $data['id_tim'] ?>">

        <div class="mb-3">
          <label class="form-label">Nama Tim</label>
          <input type="text" name="nama_tim" class="form-control" value="<?= htmlspecialchars($data['nama_tim']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Fakultas</label>
          <input type="text" name="fakultas" class="form-control" value="<?= htmlspecialchars($data['fakultas']) ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Pelatih</label>
          <input type="text" name="pelatih" class="form-control" value="<?= htmlspecialchars($data['pelatih']) ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Kapten</label>
          <input type="text" name="kapten" class="form-control" value="<?= htmlspecialchars($data['kapten']) ?>">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
         <a href="<?= $basePath?>index.php?page=kelola_tim" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
