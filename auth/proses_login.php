<?php
include __DIR__ . '/../koneksi.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Cek user berdasarkan username
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'] ?? 'user';

    if ($_SESSION['role'] === 'panitia') {
        header("Location: index.php?page=admin&pesan=berhasil");
        exit();
    }
} else {
    header("Location: index.php?page=login&pesan=gagal");
    exit();
}
