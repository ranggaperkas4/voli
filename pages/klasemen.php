<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="container py-5">
  <h3 class="mb-4">Klasemen Tim Voli</h3>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Tim</th>
            <th>Fakultas</th>
            <th>Main</th>
            <th>Menang</th>
            <th>Kalah</th>
            <th>Skor</th>
            <th>Poin</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = "SELECT * FROM view_klasemen ORDER BY poin DESC, total_skor DESC";
          $result = mysqli_query($conn, $query);

          if (!$result) {
              echo '<tr><td colspan="8" class="text-danger text-center">Query error: ' . mysqli_error($conn) . '</td></tr>';
          } elseif (mysqli_num_rows($result) === 0) {
              echo '<tr><td colspan="8" class="text-center text-muted">Belum ada data klasemen.</td></tr>';
          } else {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $no++ . '</td>';
                  echo '<td>' . htmlspecialchars($row['nama_tim']) . '</td>';
                  echo '<td>' . htmlspecialchars($row['fakultas']) . '</td>';
                  echo '<td>' . $row['main'] . '</td>';
                  echo '<td>' . $row['menang'] . '</td>';
                  echo '<td>' . $row['kalah'] . '</td>';
                  echo '<td>' . $row['total_skor'] . '</td>';
                  echo '<td class="fw-bold">' . $row['poin'] . '</td>';
                  echo '</tr>';
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
