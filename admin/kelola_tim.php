<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';

// Cek koneksi DB
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}             
            // Deteksi apakah sedang di folder admin
            $isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

            // Prefix path relatif jika dari folder admin
            $basePath = $isAdminFolder ? '../' : '';
?>


<!-- Style & Script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['alert'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: '<?= $_SESSION['alert']['icon'] ?>',
        title: '<?= $_SESSION['alert']['title'] ?>',
        text: '<?= $_SESSION['alert']['text'] ?>',
        confirmButtonColor: '#3085d6'
      }).then(() => {
        document.body.style.overflowY = 'auto';
        document.documentElement.style.overflowY = 'auto';
      });
    });
  </script>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<style>
  html.swal2-shown,
  body.swal2-shown {
    overflow-y: auto !important;
  }
  .swal2-container {
    z-index: 99999 !important;
  }
</style>

<div class="container py-5">
  <h3 class="mb-4">Tambah Tim Baru</h3>

  <!-- Form Tambah -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">Form Tambah Tim</div>
    <div class="card-body">
      <form action="<?= $basePath?>index.php?page=proses_tambah_tim" method="POST">
        <div class="mb-3">
          <label for="nama_tim" class="form-label">Nama Tim</label>
          <input type="text" name="nama_tim" id="nama_tim" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="fakultas" class="form-label">Fakultas</label>
          <input type="text" name="fakultas" id="fakultas" class="form-control">
        </div>
        <div class="mb-3">
          <label for="pelatih" class="form-label">Pelatih</label>
          <input type="text" name="pelatih" id="pelatih" class="form-control">
        </div>
        <div class="mb-3">
          <label for="kapten" class="form-label">Kapten</label>
          <input type="text" name="kapten" id="kapten" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Tambah Tim</button>
      </form>
    </div>
  </div>

  <!-- Daftar Tim -->
  <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Daftar Tim</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Tim</th>
            <th>Fakultas</th>
            <th>Pelatih</th>
            <th>Kapten</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $result = mysqli_query($conn, "SELECT * FROM tim ORDER BY nama_tim ASC");

          if (!$result) {
              echo '<tr><td colspan="6" class="text-danger text-center">Query error: ' . mysqli_error($conn) . '</td></tr>';
          } elseif (mysqli_num_rows($result) === 0) {
              echo '<tr><td colspan="6" class="text-muted text-center">Belum ada tim terdaftar.</td></tr>';
          } else {
              while ($row = mysqli_fetch_assoc($result)) :
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama_tim']) ?></td>
              <td><?= htmlspecialchars($row['fakultas']) ?></td>
              <td><?= htmlspecialchars($row['pelatih']) ?></td>
              <td><?= htmlspecialchars($row['kapten']) ?></td>
              <td>
                <a href="<?= $basePath?>index.php?page=edit_tim&id=<?= $row['id_tim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= $basePath?>index.php?page=hapus_tim&id=<?= $row['id_tim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tim ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile;
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

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

