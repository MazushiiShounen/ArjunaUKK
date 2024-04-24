<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from foto inner join users on foto.id_user = users.id_user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | GALLERY</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main>
    <div class="side">
      <div class="user">
        <h3>Selamat Datang</h3>
      </div>
      <div class="menu">
      <ul>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Beranda</a></li>
        <li><a href="albums.php">Daftar Album Saya</a></li>
        <li><a href="tambahalbum.php">Tambah Album</a></li>
        <li><a href="editakun.php">Setelan Akun</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="logout.php">Logout</a>
       </div>
    </div>
    <h2>Postingan pengguna lain:</h2>
    <div class="posts">
      <?php if (mysqli_num_rows($query)) : ?>
      <?php foreach ($query as $data) :?>
      <div class="post">
      <a href="post.php?id=<?= $data['id_foto']; ?>"><img src="upload/<?= $data['path']; ?>" width="100%" height="100%">
            <h5 class="author">By. <?= $data["nama"]; ?> <br> Dibuat pada: <?= $data["created_at"]; ?> <br> Diperbarui pada: <?= $data["updated_at"]; ?></h5>
      <h3 class="judul"><?= $data["judul"]; ?></h3>
      </a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h2 class="notif">Tidak ada postingan orang lain</h2>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>