<?php
session_start();
require 'functions.php';
if (isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$success = false;
$error = false;
if (isset($_POST["submit"])) {
  if (registrasi($_POST) > 0) {
    $success = true;
  } else {
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | REGIS</title>
  <link rel="stylesheet" href="css/registrasi.css">
</head>
<body>
  <main>
    <div class="regis">
      <h2>REGISTRASI</h2>
      <?php if ($success == true) {
        echo "<p class='login'>Berhasil registrasi, silahkan login</p>";
      } elseif ($error == true) {
        echo "<p class='login'>Gagal registrasi, silahkan ulangi</p>";
      }
      ?>
      <form method="post">
        <label for="nama" class="nama">Nama: </label>
        <input type="text" name="nama" id="nama" placeholder="Isi Nama" required>
        <label for="username" class="username">Username: </label>
        <input type="text" name="username" id="username" placeholder="Isi Username" required>
        <label for="email" class="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Isi Email" required>
        <label for="password" class="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Isi Password" required>
        <label for="alamat" class="alamat">Alamat: </label>
        <input type="text" name="alamat" id="alamat" placeholder="Isi Alamat" required>
        <button type="submit" name="submit" class="submit">Registrasi</button>
      </form>
      <a href="login.php" class="login">Login akun</a>
    </div>
  </main>
</body>
</html>