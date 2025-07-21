<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Deteksi apakah sedang di folder admin
$isAdminFolder = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;

// Prefix path relatif jika dari folder admin
$basePath = $isAdminFolder ? '../' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jadwal = intval($_POST['id_jadwal']);
    $skor1 = intval($_POST['skor_tim1']);
    $skor2 = intval($_POST['skor_tim2']);

    // Cek apakah skor untuk jadwal ini sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM skor WHERE id_jadwal = $id_jadwal");

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Gagal',
            'text' => 'Skor untuk pertandingan ini sudah ada.'
        ];
    } else {
        $query = mysqli_query($conn, "INSERT INTO skor (id_jadwal, skor_tim1, skor_tim2) VALUES ($id_jadwal, $skor1, $skor2)");

        if ($query) {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Skor berhasil disimpan.'
            ];
        } else {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Gagal menyimpan skor: ' . mysqli_error($conn)
            ];
        }
    }

    header("Location: " . $basePath . "index.php?page=input_skor");
    exit;
} else {
    http_response_code(405);
    echo "Metode tidak diizinkan.";
}
