<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Cek login & role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'panitia') {
    header("Location: ../index.php");
    exit;
}

// Validasi ID jadwal
if (!isset($_GET['id'])) {
    echo "ID jadwal tidak ditemukan.";
    exit;
}

$id_jadwal = intval($_GET['id']);

// Cek apakah jadwal ada
$cek = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = $id_jadwal");
if (mysqli_num_rows($cek) === 0) {
    echo "Jadwal tidak ditemukan.";
    exit;
}

// Proses hapus
$hapus = mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = $id_jadwal");

if ($hapus) {
    // Redirect kembali ke halaman jadwal dengan pesan sukses
    header("Location: ../index.php?page=jadwal&status=hapus_sukses");
    exit;
} else {
    echo "Gagal menghapus jadwal: " . mysqli_error($conn);
}
?>
