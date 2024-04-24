<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
$id_foto = $_GET["id_foto"];
$query = mysqli_query($conn, "select * from foto where id_foto = '$id_foto'");
$fetch = mysqli_fetch_array($query);
if (isset($_POST["edit"])) {
    if (editFoto($_POST) > 0) {
      echo "<div id='popupOverlay' 
      class='overlay-container show'> 
     <div class='popup-box'> 
         <h2>Foto berhasil diedit</h2>
         <button class='btn-close-popup' 
                 onclick='togglePopup()'>OK</button> 
     </div> 
  </div>";
    } else{
      echo "<div id='popupOverlay' 
      class='overlay-container show'> 
     <div class='popup-box'> 
         <h2>Kamu belum mengubah gambar</h2>
         <button class='btn-close-popup' 
                 onclick='togglePopupRe()'>OK</button> 
     </div> 
  </div>";
    }
  }
  if (isset($_POST["delete"])) {
      if (deleteFoto($_POST) > 0) {
        echo "<div id='popupOverlay' 
        class='overlay-container show'> 
       <div class='popup-box'> 
           <h2>Foto berhasil dihapus</h2>
           <button class='btn-close-popup' 
                   onclick='togglePopup()'>OK</button> 
       </div> 
    </div>";
    
      } else {
        echo "<div id='popupOverlay' 
        class='overlay-container show'> 
       <div class='popup-box'> 
           <h2>Foto gagal dihapus</h2>
           <button class='btn-close-popup' 
                   onclick='togglePopupRe()'>OK</button> 
       </div> 
    </div>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MASH | GALLERY</title>
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/popup.css">
  <style>
    body{
      background-image: url(img/bg.jpg);
      background-repeat: no-repeat;
      background-size: cover;
    }
    form{
      color: white;
    }
  </style>
</head>
<body>
  <main>
    <br><br><br><br>
  <div class="tambahfoto">
  <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_foto" value="<?= $id_foto ?>">
        <input type="hidden" value="<?= $fetch["id_album"]; ?>" name="id_album">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="judul">Judul Foto: </label>
        <input type="text" value="<?= $fetch["judul"]; ?>" name="judul" id="judul" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="<?= $fetch["deskripsi"]; ?>" name="desk" id="desk" required><br>
        <label for="path">Gambar: </label>
        <input type="file" name="path" id="path" style="color: transparent;"><label for="path"><?= $fetch["path"]; ?></label><br>
        <button class="add" type="submit" name="edit">Edit Foto</button>
        <input type="hidden" name="id_foto" value="<?= $id_foto ?>">
        <button type="submit" class="add" name="delete">Hapus Foto</button>
      </form>
    </div>
    <a href="albums.php" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  width: 120px;
  height: 50px;
  color: #be43dd;
  text-align: center;
  font-size: 12pt;
  margin-top: 50px;
  margin-left: 50px;
  border-radius: 10px;
  text-decoration: none;
  ">Kembali</a>
  </main>

  <script> 
        function togglePopup() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
            window.location.href = "albums.php";
        }
        function togglePopupRe() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
        } 
    </script>
</body>
</html>