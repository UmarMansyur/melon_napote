<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <title>Registrasi | Kampong Melon</title>
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="Silantur, Sistem Informasi Penjualan Harga Telur - Pro Js Universitas Madura" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:title" content="Silantur" />
  <meta property="og:type" content="eCommerce" />
  <meta property="og:url" content="https://silantur.tangmenu.com" />
  <meta property="og:image" content="" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="../assets/imgs/theme/favicon.svg" />
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/main17e6.css?v=5.2" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 mt-15 bg-white border py-4 px-4" style="border-radius: 10px;">
        <div class="heading_s1 text-center">
          <img src="../assets/imgs/theme/Capture.PNG" width="150px" alt="logo">
          <h5 class="mb-5 mt-2">Registrasi</h5>
          <p class="font-sm text-center">Daftar dan Nikmati Fitur Sistem Informasi Penjualan Melon Napote</p>
        </div>
        <form class="mt-30" method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="username" name="username" required autofocus>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6">
              <label for="Password" class=" form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-sm-6">
              <label for="konfirmasi" class="form-label">Korfirmasi Password</label>
              <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" required>

            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="setuju" required>
            <label class="form-check-label" for="setuju">Saya setuju dengan syarat & kebijakan </label>
          </div>
          <div class="d-grid mb-2">
            <button type="submit" class="btn btn-green btn-sm d-grid" name="register">DAFTAR</button>
            <p class="mt-3 font-sm">Sudah punya akun ? <a href="./login.php">Login</a></p>
          </div>
        </form>
        <?php
        include '../config/connection.php';
        if (isset($_POST['register'])) {
          $username = mysqli_real_escape_string($connection, $_POST['username']);
          $email = mysqli_real_escape_string($connection, $_POST['email']);
          $password = mysqli_real_escape_string($connection, $_POST['password']);
          $konfirmasi = mysqli_real_escape_string($connection, $_POST['konfirmasi']);
          $today = date("Y-m-d H:i:s");
          if ($password == $konfirmasi) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            try {
              $connection->query("INSERT INTO tb_pengguna VALUES (NULL, '$username', '$email', '$password', 'user', NULL, '$today', '$today');");
              echo "
                <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Data Berhasil disimpan',
                  showConfirmButton: false,
                }).then(function(){
                  window.location.href = './login.php';
                })        
                </script>
              ";
            } catch (\Throwable $th) {
              echo "
                <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Server Gagal Merespon',
                  showConfirmButton: false,
                }).then(function(){
                  window.location.href.reaload();
                })        
                </script>";
            }
          } else {
            echo "
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Password tidak sesuai',
        showConfirmButton: false,
      }).then(function(){
        window.location.reload()';
      })        
      </script>
    ";
          }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="container wow animate__animated animate__fadeInUp" data-wow-delay="0">
    <div class="row justify-content-center mt-3">
      <div class="col-xl-4 col-lg-6 col-md-6 text-center mb-2">
        <p class="font-sm">&copy; 2022, <strong class="text-brand">Kampong Melon</strong> - Pro Js Universitas Madura
          <br />Zainal Fatah
        </p>
      </div>
    </div>
  </div>
</body>

</html>