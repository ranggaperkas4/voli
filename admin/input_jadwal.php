<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

// Ambil daftar tim
$tim = mysqli_query($conn, "SELECT id_tim, nama_tim FROM tim ORDER BY nama_tim ASC");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['alert'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: '<?= $_SESSION['alert']['icon'] ?>',
        title: '<?= $_SESSION['alert']['title'] ?>',
        text: '<?= $_SESSION['alert']['text'] ?>',
        confirmButtonColor: '#0d6efd' // biru primary
      });
    });
  </script>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<div class="container py-5">
  <h3 class="mb-4 text-primary">Input Jadwal Pertandingan</h3>

  <div class="card shadow-sm border-primary">
    <div class="card-header bg-primary text-white">
      Tambah Jadwal Baru
    </div>
    <div class="card-body">
      <form action="<?= $basePath?>index.php?page=proses_input_jadwal" method="POST">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Tim 1</label>
            <select name="tim_1" class="form-select" required>
              <option value="">-- Pilih Tim 1 --</option>
              <?php while ($row = mysqli_fetch_assoc($tim)) : ?>
                <option value="<?= $row['id_tim'] ?>"><?= htmlspecialchars($row['nama_tim']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tim 2</label>
            <select name="tim_2" class="form-select" required>
              <option value="">-- Pilih Tim 2 --</option>
              <?php
              mysqli_data_seek($tim, 0);
              while ($row = mysqli_fetch_assoc($tim)) :
              ?>
                <option value="<?= $row['id_tim'] ?>"><?= htmlspecialchars($row['nama_tim']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Tanggal Pertandingan</label>
            <input type="date" name="tanggal_pertandingan" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Jam Pertandingan</label>
            <input type="time" name="jam" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Tempat</label>
          <input type="text" name="tempat" class="form-control" placeholder="Contoh: Lapangan A">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
        <a href="<?= $basePath?>index.php?page=admin" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
