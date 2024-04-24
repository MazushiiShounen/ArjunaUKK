<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id_album = $_GET["id_album"];
$data = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM foto where id_album = '$id_album'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | GALLERY</title>
  <link rel="stylesheet" href="css/daftarfoto.css">
</head>
<body>
  <main>
        <div class="side">
      <div class="menu">
      <ul>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Daftar Foto</a></li>
              <li><a href="udalbum.php?id_album=<?= $id_album; ?>">Aksi Album</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="albums.php">Kembali</a>
       </div>
    </div>
    <div class="images">
      <div class="garis">
      <?php if (mysqli_num_rows($query)) : ?>
        <?php foreach ($query as $foto) :?>
      <div class="image">
      <a href="udfoto.php?id_foto=<?= $foto["id_foto"];
      ?>"><img src="upload/<?= $foto["path"];
      ?>" width="100%" height="100%">
      <h3 class="judul"><?= $foto["judul"];
      ?></h3>
      </a>
      </div>
      <?php endforeach; ?>
      <?php else:?>
        <h3>Belum ada gambar yang kamu upload di album ini</h3>
      <?php endif; ?>
      </div>
          <a href="tambahfoto.php?id_album=<?= $id_album; ?>" class="tambah">Tambah Foto</a>
    </div>

  </main>
</body>
</html>