<?php
  include "koneksi/koneksi.php";
  session_start();
  if($_SESSION['logged_in'] == TRUE && $_SESSION['login_as'] == "admin"){
    header("location: admin/index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Tryout Akbar SMP Muhammadiyah 06 Dau - Login Admin</title>
  <link rel="stylesheet" href="assets/css/vendor.bundle.css">
  <link rel="stylesheet" href="assets/css/app.bundle.css">
  <link rel="stylesheet" href="assets/css/theme-a.css">
</head>
<body id="auth_wrapper" >
  <div id="login_wrapper">
    <div class="logo">
      <!-- <img src="assets/img/logo/logo-icon%402x.png" alt="logo" class="logo-img"> -->
      <img src="assets/img/logo/logo-sch.png" alt="logo" class="logo-img">
    </div>
    <div id="login_content">
      <h1 class="login-title">
        Masuk Sebagai Admin SMP Muhammadiyah 06 Dau
      </h1>
      <?php
        if($_GET['login'] == "false"){
          echo "<div class='alert alert-warning'><center>Mohon maaf, Username dan Password anda salah!</center></div>";
        }
      ?>
      <div class="login-body">
        <form action="login_process.php" method="POST">
          <input type="hidden" name="login_as" value="admin">
          <div class="form-group label-floating is-empty">
            <label class="control-label">username</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group label-floating is-empty">
            <label class="control-label">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <input type="submit" class="btn btn-info btn-block m-t-40" value="Masuk">
        </form>
      </div>
      </div>
    </div>
  </div>
  <script src="assets/js/vendor.bundle.js"></script>
  <script src="assets/js/app.bundle.js"></script>
</body>
</html>
