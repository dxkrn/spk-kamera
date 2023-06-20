<?php

include('koneksi.php');

error_reporting(0);

session_start();

if (isset($_POST['submitDaftar'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $repassword = md5($_POST['re_password']);

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($selectdb, $sql);
  if ($result->num_rows > 0) {
    echo "<script>alert('Username atau Email telah terdaftar. Silahkan coba lagi!')</script>";
  } else {
    if ($password != $repassword) {
      echo "<script>alert('Password Anda tidak cocok. Silahkan coba lagi!')</script>";
    } else {
      $insertUserQuery = "INSERT INTO users (email, password)
                      VALUES ('$email','$password')";

      $addUser = mysqli_query($selectdb, $insertUserQuery);
      if ($addUser) {
        header('refresh:0; url=index');
        echo "<script>alert('Yeay, Akun berhasil terdaftar.')</script>";
      } else {
        echo "<script>alert('Yahh :( Akun gagal terdaftar.')</script>";
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets2-path="../assets2/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Daftar - Rooda</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets2/img/favicon/icon_favicon.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets2/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets2/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets2/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets2/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets2/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets2/vendor/js/helpers.js"></script>

  <script src="assets2/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <!-- <img src="assets2/img/logo/logo_rooda.png"> -->
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Selamat Datang Di SPK Kamera!</h4>
            <p class="mb-4">Silahkan daftar dengan menggunakan Email</p>

            <form class="mb-3" method="POST">
              <!-- <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input required type="text" class="form-control" name="username" placeholder=" Username" autofocus />
              </div> -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input required type="email" class="form-control" name="email" placeholder="Email Anda" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input required type="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Re-Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input required type="password" class="form-control" name="re_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100" type="submit" name="submitDaftar">Daftar</button>
            </form>
            <p class="text-center">
              <span>Sudah punya akun?</span>
              <a href="login">
                <span>Masuk</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->



  <!-- Core JS -->
  <!-- build:js assets2/vendor/js/core.js -->
  <script src="../assets2/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets2/vendor/libs/popper/popper.js"></script>
  <script src="../assets2/vendor/js/bootstrap.js"></script>
  <script src="../assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets2/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../assets2/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>