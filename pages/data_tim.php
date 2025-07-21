<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
  <h3 class="mb-4">Data Tim</h3>
  
  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Tim</th>
            <th>Fakultas</th>
            <th>Pelatih</th>
            <th>Kapten</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $result = mysqli_query($conn, "SELECT * FROM tim ORDER BY nama_tim ASC");

          if (!$result || mysqli_num_rows($result) === 0) {
              echo '<tr><td colspan="5" class="text-center text-muted">Belum ada tim terdaftar.</td></tr>';
          } else {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $no++ . '</td>';
                  echo '<td>' . htmlspecialchars($row['nama_tim']) . '</td>';
                  echo '<td>' . htmlspecialchars($row['fakultas']) . '</td>';
                  echo '<td>' . htmlspecialchars($row['pelatih']) . '</td>';
                  echo '<td>' . htmlspecialchars($row['kapten']) . '</td>';
                  echo '</tr>';
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
