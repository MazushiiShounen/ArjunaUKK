<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id_album = $_GET["id_album"];
$data = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM album where id_album = '$id_album'");
$fetch = mysqli_fetch_array($query);
if (isset($_POST["edit"])) {
  if (editAlbum($_POST) > 0) {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Album berhasil diedit</h2>
       <button class='btn-close-popup' 
               onclick='togglePopup()'>OK</button> 
   </div> 
</div>";
  } else {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Album gagal diedit</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>";
  }
}
if (isset($_POST["delete"])) {
    if (deleteAlbum($_POST) > 0) {
      echo "<div id='popupOverlay' 
      class='overlay-container show'> 
     <div class='popup-box'> 
         <h2>Album berhasil dihapus</h2>
         <button class='btn-close-popup' 
                 onclick='togglePopup()'>OK</button> 
     </div> 
  </div>";
  
    } else {
      echo "<div id='popupOverlay' 
      class='overlay-container show'> 
     <div class='popup-box'> 
         <h2>Album gagal dihapus</h2>
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
  <link rel="stylesheet" href="css/udalbum.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/popup.css">
</head>
<body>
  <main>
    <div class="side">
      <div class="menu">
      <ul>
        <li><a href="daftarfoto.php?id_album=<?= $id_album; ?>">Daftar Foto</a></li>
              <li><a href="#" style="background-color: silver; opacity: 0.6;">Aksi Album</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="albums.php">Kembali</a>
       </div>
    </div>
    <div class="udalbum">
    <form action="" method="POST">
    <input type="hidden" name="id_album" value="<?= $id_album ?>">
        <input type="hidden" value="<?= $fetch['id_user']; ?>" name="id_user">
        <label for="nama">Nama Album: </label>
        <input type="text" value="<?= $fetch['nama']; ?>" name="nama" id="nama" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="<?= $fetch['deskripsi']; ?>" name="desk" id="desk" required><br><br>
        <button type="submit" class="add" name="edit">Edit Album</button>
        <input type="hidden" name="id_album" value="<?= $id_album ?>">
        <button type="submit" class="add" name="delete">Hapus Album</button>
      </form>
    </div>
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
  </main>
</body>
</html>