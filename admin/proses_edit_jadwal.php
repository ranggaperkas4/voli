<?php
session_start();
include __DIR__ . '/../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'panitia') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jadwal = intval($_POST['id_jadwal']);
    $tim_1 = intval($_POST['tim_1']);
    $tim_2 = intval($_POST['tim_2']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $jam = mysqli_real_escape_string($conn, $_POST['jam']);
    $tempat = mysqli_real_escape_string($conn, $_POST['tempat']);

    $query = "UPDATE jadwal SET 
                tim_1 = $tim_1,
                tim_2 = $tim_2,
                tanggal_pertandingan = '$tanggal',
                jam = '$jam',
                tempat = '$tempat'
              WHERE id_jadwal = $id_jadwal";

    if (mysqli_query($conn, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Jadwal berhasil diupdate!',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '../index.php?page=jadwal';
        });
        </script>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengupdate jadwal!',
            text: '" . mysqli_error($conn) . "',
            confirmButtonText: 'OK'
        }).then(() => {
            history.back();
        });
        </script>";
    }
}
?>
