<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kompetisi Voli Kampus</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-4">
<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
  case 'login':
    include 'auth/login.php';
    break;
  case 'logout':
    include 'auth/logout.php';
    break;
  case 'plogin':
    include 'auth/proses_login.php';
    break;
  case 'pregister':
    include 'auth/proses_register.php';
    break;
  case 'register':
    include 'auth/register.php';
    break;
  case 'data_tim':
    include 'pages/data_tim.php';
    break;
  case 'jadwal':
    include 'pages/jadwal.php';
    break;
  case 'klasemen':
    include 'pages/klasemen.php';
    break;
  case 'tentang':
    include 'pages/tentang.php';
    break;
  case 'admin':
    include 'admin/dashboard.php';
    break;
  case 'kelola_tim':
    include 'admin/kelola_tim.php';
    break;
  case 'home':
  default:
    include 'pages/home.php';
    break;
  case 'proses_tambah_tim':
    include 'admin/proses_tambah_tim.php';
    break;
    case 'edit_tim':
    include 'admin/edit_tim.php';
    break;
  case 'proses_edit_tim':
    include 'admin/proses_edit_tim.php';
    break;
  case 'hapus_tim':
    include 'admin/hapus_tim.php';
    break;
  case 'input_jadwal':
    include 'admin/input_jadwal.php';
    break;
  case 'proses_input_jadwal':
    include 'admin/proses_input_jadwal.php';
    break;
  case 'input_skor':
    include 'admin/input_skor.php';
    break;
  case 'proses_input_skor':
    include 'admin/proses_input_skor.php';
    break;
  case 'edit_jadwal':
    include 'admin/edit_jadwal.php';
    break;
  case 'proses_edit_jadwal':
    include 'admin/proses_edit_jadwal.php';
    break;
  case 'hapus_jadwal':
    include 'admin/proses_hapus_jadwal.php';
    break;
  case 'paper':
    include 'pages/paper.php';
    break;
}
?>
</div>

<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'logout') : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Logout Berhasil',
      text: 'Anda telah keluar dari sistem.',
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php endif; ?>

</body>
</html>
