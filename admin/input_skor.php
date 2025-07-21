<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

$jadwal = mysqli_query($conn, "SELECT j.id_jadwal, t1.nama_tim AS tim1, t2.nama_tim AS tim2, j.tanggal_pertandingan
  FROM jadwal j
  JOIN tim t1 ON j.tim_1 = t1.id_tim
  JOIN tim t2 ON j.tim_2 = t2.id_tim
  ORDER BY j.tanggal_pertandingan ASC");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['alert'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      Swal.fire({
        icon: '<?= $_SESSION['alert']['icon'] ?>',
        title: '<?= $_SESSION['alert']['title'] ?>',
        text: '<?= $_SESSION['alert']['text'] ?>',
        confirmButtonColor: '#3085d6'
      });
    });
  </script>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<div class="container py-5">
  <h3 class="mb-4">Input Skor Pertandingan</h3>
  <div class="card shadow-sm">
    <div class="card-header bg-info text-white">Tambah Skor</div>
    <div class="card-body">
      <form action="<?= $basePath?>index.php?page=proses_input_skor" method="POST">
        <div class="mb-3">
          <label class="form-label">Pilih Pertandingan</label>
          <select name="id_jadwal" class="form-select" required>
            <option value="">-- Pilih Pertandingan --</option>
            <?php while ($row = mysqli_fetch_assoc($jadwal)) : ?>
              <option value="<?= $row['id_jadwal'] ?>">
                <?= htmlspecialchars($row['tim1']) ?> vs <?= htmlspecialchars($row['tim2']) ?> (<?= $row['tanggal_pertandingan'] ?>)
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Skor Tim 1</label>
            <input type="number" name="skor_tim1" class="form-control" required min="0">
          </div>
          <div class="col-md-6">
            <label class="form-label">Skor Tim 2</label>
            <input type="number" name="skor_tim2" class="form-control" required min="0">
          </div>
        </div>

        <button type="submit" class="btn btn-info text-white">Simpan Skor</button>
        <a href="<?= $basePath?>index.php?page=admin" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
