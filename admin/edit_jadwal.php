<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../includes/navbar.php';

$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
$basePath = $isAdminFolder ? '../' : '';

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// PROSES UPDATE JADWAL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_jadwal']);
    $tim1 = intval($_POST['tim_1']);
    $tim2 = intval($_POST['tim_2']);
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tempat = mysqli_real_escape_string($conn, $_POST['tempat']);

    // Cek Tim Tidak Boleh Sama
    if ($tim1 === $tim2) {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Tim tidak valid!',
                text: 'Tim 1 dan Tim 2 tidak boleh sama.',
                confirmButtonText: 'Kembali'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit;
    }

    $query = "UPDATE jadwal SET 
                tim_1 = $tim1,
                tim_2 = $tim2,
                tanggal_pertandingan = '$tanggal',
                jam = '$jam',
                tempat = '$tempat'
              WHERE id_jadwal = $id";

    if (mysqli_query($conn, $query)) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Jadwal pertandingan berhasil diperbarui.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '" . $basePath . "index.php?page=jadwal';
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat memperbarui jadwal.',
                confirmButtonText: 'Kembali'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }

// TAMPILKAN FORM EDIT
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM jadwal WHERE id_jadwal = $id";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Data tidak ditemukan!',
                text: 'Jadwal dengan ID tersebut tidak tersedia.',
                confirmButtonText: 'Kembali'
            }).then(() => {
                window.location.href = '" . $basePath . "index.php?page=jadwal';
            });
        </script>";
        exit;
    }

    $data = mysqli_fetch_assoc($result);
    $tim = mysqli_query($conn, "SELECT * FROM tim");
    ?>

    <!-- Form Edit Jadwal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <div class="container py-5">
        <h3 class="mb-4">Edit Jadwal Pertandingan</h3>
        <form method="POST" action="">
            <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal'] ?>">
            
            <div class="mb-3">
                <label for="tim_1" class="form-label">Tim 1</label>
                <select name="tim_1" id="tim_1" class="form-select" required>
                    <?php while ($t = mysqli_fetch_assoc($tim)): ?>
                        <option value="<?= $t['id_tim'] ?>" <?= $t['id_tim'] == $data['tim_1'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['nama_tim']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <?php mysqli_data_seek($tim, 0); ?>
            <div class="mb-3">
                <label for="tim_2" class="form-label">Tim 2</label>
                <select name="tim_2" id="tim_2" class="form-select" required>
                    <?php while ($t = mysqli_fetch_assoc($tim)): ?>
                        <option value="<?= $t['id_tim'] ?>" <?= $t['id_tim'] == $data['tim_2'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t['nama_tim']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal_pertandingan'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" id="jam" class="form-control" value="<?= $data['jam'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="tempat" class="form-label">Tempat</label>
                <input type="text" name="tempat" id="tempat" class="form-control" value="<?= htmlspecialchars($data['tempat']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= $basePath ?>index.php?page=jadwal" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <?php
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Metode tidak diizinkan.',
            confirmButtonText: 'Kembali'
        }).then(() => {
            window.location.href = '" . $basePath . "index.php?page=jadwal';
        });
    </script>";
}
?>
