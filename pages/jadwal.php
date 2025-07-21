<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
$basePath = $isAdminFolder ? '../' : '';
?>

<!-- Style -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="container py-5">
  <h3 class="mb-4">Jadwal Pertandingan</h3>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Tim 1</th>
            <th class="text-center">VS</th>
            <th>Tim 2</th>
            <th>Tempat</th>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'panitia'): ?>
              <th>Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = "
            SELECT j.*, 
                   t1.nama_tim AS tim1, 
                   t2.nama_tim AS tim2 
            FROM jadwal j
            JOIN tim t1 ON j.tim_1 = t1.id_tim
            JOIN tim t2 ON j.tim_2 = t2.id_tim
            ORDER BY j.tanggal_pertandingan ASC, j.jam ASC
          ";
          $result = mysqli_query($conn, $query);

          if (!$result) {
              echo '<tr><td colspan="8" class="text-danger text-center">Query error: ' . mysqli_error($conn) . '</td></tr>';
          } elseif (mysqli_num_rows($result) === 0) {
              echo '<tr><td colspan="8" class="text-muted text-center">Belum ada jadwal pertandingan.</td></tr>';
          } else {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $no++ . '</td>';
                  echo '<td>' . date('d M Y', strtotime($row['tanggal_pertandingan'])) . '</td>';
                  echo '<td>' . date('H:i', strtotime($row['jam'])) . '</td>';
                  echo '<td>' . htmlspecialchars($row['tim1']) . '</td>';
                  echo '<td class="text-center fw-bold">VS</td>';
                  echo '<td>' . htmlspecialchars($row['tim2']) . '</td>';
                  echo '<td>' . htmlspecialchars($row['tempat']) . '</td>';

                  if (isset($_SESSION['role']) && $_SESSION['role'] === 'panitia') {
                      echo '<td>
                              <a href="admin/edit_jadwal.php?id=' . $row['id_jadwal'] . '" class="btn btn-warning btn-sm">Edit</a>
                              <button 
                                class="btn btn-danger btn-sm btn-hapus"
                                data-id="' . $row['id_jadwal'] . '"
                                data-tim1="' . htmlspecialchars($row['tim1']) . '"
                                data-tim2="' . htmlspecialchars($row['tim2']) . '"
                              >
                                Hapus
                              </button>
                            </td>';
                  }

                  echo '</tr>';
              }
          }
          ?>
        </tbody>
      </table>

      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        document.querySelectorAll('.btn-hapus').forEach(button => {
          button.addEventListener('click', function (e) {
            e.preventDefault();

            const id = this.dataset.id;
            const tim1 = this.dataset.tim1;
            const tim2 = this.dataset.tim2;

            Swal.fire({
              title: `Hapus jadwal ${tim1} vs ${tim2}?`,
              text: "Tindakan ini tidak dapat dibatalkan!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#6c757d',
              confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'admin/proses_hapus_jadwal.php?id=' + id;
              }
            });
          });
        });
      </script>

      <?php if (isset($_GET['status']) && $_GET['status'] === 'hapus_sukses') : ?>
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Jadwal berhasil dihapus.',
            timer: 2000,
            showConfirmButton: false
          });
        </script>
      <?php endif; ?>
    </div>
  </div>
</div>
