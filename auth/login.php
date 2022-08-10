<?php
session_start();
if(!empty($_SESSION['id']))
  echo "<script>window.location.href='index.php?page=dashboard'</script>";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login | Kampong Melon</title>
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
  <div class="container mt-5">
    <div class="row justify-content-center mt-30">
      <div class="col-lg-4 mt-30 bg-white border py-4 px-4" style="border-radius: 10px;">
        <div class="heading_s1 text-center">
          <!-- <img src="../assets/imgs/theme/Capture.PNG" width="150px" alt="logo"> -->
          <h5 class="mb-5 text-center">Masuk</h5>
          <p class="text-center font-sm">Belum punya akun ? <a href="./register.php">Daftar</a></p>
        </div>
        <form class="mt-30" action="" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Ingat saya</label>
            <a class="float-end" href="">Lupa Kata Sandi ?</a>
          </div>
          <div class="d-grid mb-2">
            <button type="submit" class="btn btn-green btn-sm d-grid" name="masuk">MASUK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
include '../config/connection.php';
if (isset($_POST['masuk'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  try {
    $data = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_pengguna WHERE email = '$email'"));
      if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id_pengguna'];
        $_SESSION['nama'] = $data['username'];
        $_SESSION['type'] = $data['type'];
        echo " <script>
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            showConfirmButton: true,
          }).then(function(){
            window.location.href = '../admin/index.php';
          });
          </script>";
      } else {
        echo " <script>
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Password dan username tidak sesuai',
            showConfirmButton: true,
          }).then(function(){
            window.location.href = '../admin/index.php';
          });
          </script>";
      }
  } catch (\Throwable $th) {
    echo " <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        showConfirmButton: false,
      }).then(function(){
        window.location.reload();
      });
      </script>";
  }
}
?>
  <div class="container wow animate__animated animate__fadeInUp">
    <div class="row justify-content-center mt-3 mb-30">
      <div class="col-xl-4 col-lg-6 col-md-6 text-center mb-2">
        <p class="font-sm">&copy; 2022, <strong class="text-brand">Kampong Melon</strong> - Pro Js Universitas Madura <br />Zainal fatah</p>
      </div>
    </div>
  </div>
</body>

</html>