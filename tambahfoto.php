<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from album where id_user = '$getdata'");
$id_album = $_GET["id_album"];
if (isset($_POST["submit"])) {
  if (tambahfoto($_POST) > 0) {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Foto berhasil ditambahkan</h2>
       <button class='btn-close-popup' 
               onclick='togglePopup()'>OK</button> 
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
        <input type="hidden" value="<?= $id_album; ?>" name="id_album">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="judul">Judul Foto: </label>
        <input type="text" value="" name="judul" id="judul" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="" name="desk" id="desk" required><br>
        <label for="path">Gambar: </label>
        <input type="file" value="" name="path" id="path"><br>
        <button type="submit" name="submit">Tambahkan</button>
      </form>
    </div>
    <a href="daftarfoto.php?id_album=<?= $id_album; ?>" style="display:flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  width: 120px;
  height: 50px;
  color: #be43dd;
  text-align: center;
  font-size: 12pt;
  margin-top: 140px;
  margin-left: 50px;
  border-radius: 10px;
  text-decoration: none;
  ">Kembali</a>
  </main>

  <script> 
        function togglePopup() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
            window.location.href = "daftarfoto.php?id_album=<?= $id_album; ?>";
        }
        function togglePopupRe() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
        } 
    </script>
</body>
</html>