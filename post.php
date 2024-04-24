<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id = $_GET["id"];
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM foto where id_foto = '$id'");
$data = mysqli_fetch_array($query);
$count = mysqli_query($conn, "SELECT COUNT(*) AS count FROM likefoto where id_foto = '$id'");
$like = mysqli_fetch_array($count);
$querychecklike = mysqli_query($conn, "SELECT * FROM likefoto where id_user = '$getdata' and id_foto = '$id'");
$checklike = mysqli_fetch_array($querychecklike);
if (isset($_POST["like"])) {
  if (like($_POST) > 0) {
    header("Location: post.php?id=".$data["id_foto"]);
  }
}
if (isset($_POST["komentar"])) {
  if (komen($_POST) > 0) {
    header("Location: post.php?id=".$data["id_foto"]);
  }
}
if (isset($_POST["delete"])) {
  if (deleteKomentar($_POST) > 0) {
    header("Location: post.php?id=".$data["id_foto"]);
  }
}
$komentar = mysqli_query($conn, "select * from komentarfoto inner join users on komentarfoto.id_user = users.id_user where id_foto = '$id'");
$fetch = mysqli_fetch_array($komentar);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | GALLERY</title>
  <style>
    body{
      background-image: url(img/bg.jpg);
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
<body>



  <main>
    <center>
    <img src="upload/<?= $data["path"]; ?>" alt="" width="500" height="300"><br>
    <h2>Judul: <?= $data["judul"]; ?></h2>
    </center>
    <h4>Dibuat: <?= $data["created_at"]; ?></h4>
    <h4>Diedit: <?= $data["updated_at"]; ?></h4>
    <form action="" method="post">
      <input type="hidden" name="id_foto" value="<?= $data["id_foto"]; ?>">
      <input type="hidden" name="id_user" value="<?= $getdata ?>">
      <?php if(!mysqli_num_rows($querychecklike)) :?>
        <button type="submit" name="like" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  color: #be43dd;
  text-align: center;
  font-size: 12pt;
  margin: 5px;
  border-radius: 10px;
  text-decoration: none;
  ">Like (<?= $like["count"]; ?>)</button>
        <?php else: ?>
          <button type="submit" name="like" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: silvers;
  color: black;
  text-align: center;
  font-size: 12pt;
  margin: 5px;
  border-radius: 10px;
  text-decoration: none;
  " disabled>Di Like (<?= $like["count"]; ?>)</button>
      <?php endif; ?>
    </form>
    <br><br>
    <h3>Deskripsi:</h3>
    <p><?= $data["deskripsi"]; ?></p>

    <br><br><br><br>
    
    <h3>Komentar:</h3>
    <form action="" method="post">
      <input type="hidden" name="id_foto" value="<?= $data["id_foto"]; ?>">
      <input type="hidden" name="id_user" value="<?= $getdata?>">
    <input type="text" style="padding: 0px 25px; width: 20rem; height: 5rem;" name="isi_komentar" placeholder="Ketik komentar" required>
    <br>
    <button type="submit" name="komentar" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  color: #be43dd;
  text-align: center;
  font-size: 12pt;
  margin: 5px;
  border-radius: 10px;
  text-decoration: none;
  ">Kirim</button>
    </form>
    <br><br>
    <?php if(mysqli_num_rows($komentar)){
      $a = $fetch["id_komentar"];
       foreach($komentar as $komen){
        echo "<h4>Dari: ".$komen['nama']."</h4>".
        "<p>".$komen['isi_komentar']."</p><br>".
        "<form action='' method='post'>
        <input type='hidden' value='$a' name='id_komentar'>
        <button type='submit' name='delete' style='display:flex;
        justify-content: center;
        align-items: center;
        background-color: black;
        color: #be43dd;
        text-align: center;
        font-size: 12pt;
        margin: 5px;
        border-radius: 10px;
        text-decoration: none;
        '>Hapus</button>
      </form>"
        ;
       }
    }else{
      echo "<h4>`` Belum ada komentar ``</h4>";
    } ?>
    <br><br>
    <a href="index.php" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  width: 120px;
  height: 50px;
  color: #be43dd;
  text-align: center;
  font-size: 12pt;
  margin: 20px;
  border-radius: 10px;
  text-decoration: none;
  ">Kembali</a>
  </main>
</body>
</html>