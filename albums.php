<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from album where id_user = '$getdata'");
$foto = mysqli_query($conn, "select * from foto where id_user = '$getdata' order by id_foto desc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | GALLERY</title>
  <link rel="stylesheet" href="css/albumsstyle.css">
</head>
<body>
  <main>
    <div class="side">
      <div class="user">
        <h3>Selamat Datang</h3>
      </div>
      <div class="menu">
      <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Daftar Album Saya</a></li>
        <li><a href="tambahalbum.php">Tambah Album</a></li>
        <li><a href="editakun.php">Setelan Akun</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="logout.php">Logout</a>
       </div>
    </div>
    <div class="images">
    <?php if (mysqli_num_rows($query)) : ?>
      <?php foreach ($query as $data) :?>
      <div class="image">
      <a href="daftarfoto.php?id_album=<?= $data["id_album"]; ?>"><img src="
      <?php if(mysqli_num_rows($foto)){
        $b = mysqli_fetch_array($foto);
        echo "upload/".$b['path'];
      }
      ?>
      " width="100%" height="100%">
      <h5 class="judul"><?= $data["nama"]; ?><br>Dibuat: <?= $data["created_at"]; ?></h5>
      </a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h2>Tidak ada album yang dibuat</h2>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>