<?php
session_start();
require "functions.php";
if (isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$error = false;
if (isset($_POST["submit"])) {
  if (login($_POST) > 0) {
    $data = $_POST["email"];
    $query = mysqli_query($conn, "select * from users where email = '$data'");
    $send = mysqli_fetch_array($query);
    $_SESSION["login"] = $send["id_user"];
    header("Location: index.php");
    exit;
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
  <title>MASH | LOGIN</title>
  <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
  <main>
    <div class="login">
      <h2 class="text1">LOGIN</h2>
      <?php if ($error == true) : ?>
      <?= "<p class='registrasi'>Email/password salah</p>"; ?>
      <?php endif; ?>
      <form method="post">
        <label for="email">
          Email: </label>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <label for="password">
          Password: </label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit" class="submit" name="submit">Masuk</button>
      </label>
    </form>
    <a href="registrasi.php" class="registrasi">Registrasi sekarang</a>
  </div>
</main>
</body>
</html>