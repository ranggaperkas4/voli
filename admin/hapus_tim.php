<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'] ?? null;

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

if ($id) {
    // 1. Cari semua id_jadwal dari tim ini
    $jadwal_result = mysqli_query($conn, "SELECT id_jadwal FROM jadwal WHERE tim_1 = $id OR tim_2 = $id");
    
    while ($jadwal = mysqli_fetch_assoc($jadwal_result)) {
        $id_jadwal = $jadwal['id_jadwal'];

        // 2. Hapus skor dulu
        mysqli_query($conn, "DELETE FROM skor WHERE id_jadwal = $id_jadwal");
        
        // 3. Hapus jadwal terkait
        mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = $id_jadwal");
    }

    // 4. Baru hapus tim
    $hapus = mysqli_query($conn, "DELETE FROM tim WHERE id_tim = $id");

    if ($hapus) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil',
            'text' => 'Tim berhasil dihapus.'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal',
            'text' => 'Gagal menghapus tim.'
        ];
    }
}

header('Location:' . $basePath . 'index.php?page=kelola_tim');
exit;
