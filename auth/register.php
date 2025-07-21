<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register | Kompetisi Voli</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/auth-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }
    .form-wrapper {
      max-width: 950px;
      width: 100%;
    }
    .shadow-box {
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }
  </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="row form-wrapper shadow-box bg-white rounded overflow-hidden">

    <!-- Form Register -->
    <div class="col-md-6 p-5">
      <h1 class="brand mb-4 text-primary">VoliKampus</h1>
      <h2 class="mb-1">Registrasi Akun</h2>
      <p class="text-muted mb-4">Daftarkan akun Anda untuk bergabung</p>

      <div class="d-flex mb-3">
        <a href="index.php?page=login" class="btn btn-outline-secondary me-2">Sign In</a>
        <button class="btn btn-outline-primary active">Signup</button>
      </div>

      <form action="index.php?page=pregister" method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
            <input type="password" id="password" name="password" class="form-control" minlength="8" required>
            <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
              <i class="fa-solid fa-eye" id="toggleIcon"></i>
            </span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
      </form>
    </div>

    <!-- Ilustrasi -->
    <div class="col-md-6 bg-light d-none d-md-flex align-items-center justify-content-center">
      <img src="assets/img/safe.svg" alt="Ilustrasi Register" class="img-fluid" style="max-height: 350px;">
    </div>
  </div>
</div>

<!-- SweetAlert Notifikasi -->
<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil') : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Registrasi Berhasil',
      text: 'Silakan login untuk melanjutkan.',
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') : ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Registrasi Gagal',
      text: 'Username sudah digunakan!',
      confirmButtonColor: '#d33'
    });
  </script>
<?php endif; ?>

<!-- Script Toggle Show Password -->
<script>
  function togglePassword() {
    const passInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passInput.type === "password") {
      passInput.type = "text";
      toggleIcon.classList.remove("fa-eye");
      toggleIcon.classList.add("fa-eye-slash");
    } else {
      passInput.type = "password";
      toggleIcon.classList.remove("fa-eye-slash");
      toggleIcon.classList.add("fa-eye");
    }
  }
</script>

</body>
</html>
