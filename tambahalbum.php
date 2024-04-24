<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$getdata = $_SESSION["login"];
if (isset($_POST["submit"])) {
  if (tambahalbum($_POST) > 0) {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Foto berhasil ditambahkan</h2>
       <button class='btn-close-popup' 
               onclick='togglePopup()'>OK</button> 
   </div> 
</div>";
    
  } else {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Foto gagal ditambahkan</h2>
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
  <link rel="stylesheet" href="css/styleaddalbum.css">
  <link rel="stylesheet" href="css/popup.css">
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
        <li><a href="albums.php">Daftar Album Saya</a></li>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Tambah Album</a></li>
        <li><a href="editakun.php">Setelan Akun</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="logout.php">Logout</a>
       </div>
    </div>
  <div class="tambahfoto">
      <form action="" method="POST">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="nama">Nama Album: </label>
        <input type="text" value="" name="nama" id="nama" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="" name="desk" id="desk" required><br>
        <button type="submit" name="submit">Tambahkan</button>
      </form>
    </div>
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