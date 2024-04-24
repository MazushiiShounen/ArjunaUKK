<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: dashboard.html");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM users where id_user = '$getdata'");
$data = mysqli_fetch_array($query);
if (isset($_POST["submit"])) {
  if (editakun($_POST) > 0) {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Akun berhasil diedit</h2>
       <button class='btn-close-popup' 
               onclick='togglePopup()'>OK</button> 
   </div> 
</div>";
    
  } else {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Akun gagal diedit</h2>
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
  <link rel="stylesheet" href="css/editakun.css">
  <link rel="stylesheet" href="css/popup.css">
  <style>
    * {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    }
    
    form {
    max-width: 300px;
    margin: 10px auto;
    padding: 10px 20px;
    background-color: rgba(4, 29, 23, 0.5);
    border-radius: 8px;
    }
    
    h1 {
    margin: 0 0 30px 0;
    text-align: center;
    }
    
    input[type="text"],
    input[type="password"],
    input[type="date"],
    input[type="datetime"],
    input[type="email"],
    input[type="number"],
    input[type="search"],
    input[type="tel"],
    input[type="time"],
    input[type="url"],
    textarea,
    select {
    background: rgba(255,255,255,0.1);
    border: none;
    font-size: 16px;
    height: auto;
    margin: 0;
    outline: 0;
    padding: 5px;
    width: 100%;
    background-color: #e8eeef;
    color: #8a97a0;
    box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
    margin-bottom: 15px;
    }
      
    button {
    padding: 19px 39px 18px 39px;
    color: #FFF;
    background-color: #be43dd;
    font-size: 18px;
    text-align: center;
    font-style: normal;
    border-radius: 5px;
    width: 100%;
    border-width: 1px 1px 3px;
    box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
    margin-bottom: 10px;
    }
    
    
    label {
    display: block;
    margin-bottom: 8px;
    }
  </style>
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
        <li><a href="tambahalbum.php">Tambah Album</a></li>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Setelan Akun</a></li>
      </ul>
      </div>
       <div class="logout">
         <a href="logout.php">Logout</a>
       </div>
    </div>
  <div class="editakun">
      <form action="" method="POST">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="nama">Nama: </label>
        <input type="text" value="<?= $data['nama']; ?>" name="nama" id="nama" required><br>
        <label for="username">Username: </label>
        <input type="text" value="<?= $data['username']; ?>" name="username" id="username" required><br>
        <label for="email">Email: </label>
        <input type="email" value="<?= $data['email']; ?>" name="email" id="email" required><br>
        <label for="password">Password: </label>
        <input type="text" value="<?= $data['password']; ?>" name="password" id="password" required><br>
        <label for="alamat">Alamat: </label>
        <input type="text" value="<?= $data['alamat']; ?>" name="alamat" id="alamat" required>
        <label for="created_at">Akun dibuat: </label>
        <input type="text" value="<?= $data['created_at']; ?>" name="created_at" id="created_at" disabled>
        <label for="updated_at">Akun diubah (terakhir kali): </label>
        <input type="text" value="<?= $data['updated_at']; ?>" name="updated_at" id="updated_at" disabled>
        <button type="submit" name="submit">Ubah</button>
      </form>
    </div>
  </main>
  <script> 
        function togglePopup() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
            window.location.href = "editakun.php";
        }
        function togglePopupRe() { 
            const overlay = document.getElementById('popupOverlay'); 
            overlay.classList.toggle('show'); 
        } 
    </script>
</body>
</html>