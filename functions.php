<?php
$conn = mysqli_connect('localhost', 'root', '', 'mashgallery');
function login($data) {
  global
  $conn;
  $email = trim(mysqli_real_escape_string($conn, $data["email"]));
  $password = trim(mysqli_real_escape_string($conn, $data["password"]));
  $query = mysqli_query($conn, "select * from users where email = '$email'");
  $datadb = mysqli_fetch_array($query);
  if($datadb){
  if ($email === $datadb["email"] && $password === $datadb["password"]) {
    return 1;
  } else {
    return 0;
  }
}
}
function registrasi($data) {
  global
  $conn;
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $email = trim(mysqli_real_escape_string($conn, $data["email"]));
  $username = trim(mysqli_real_escape_string($conn, $data["username"]));
  $password = trim(mysqli_real_escape_string($conn, $data["password"]));
  $alamat = trim(mysqli_real_escape_string($conn, $data["alamat"]));
  $query = mysqli_query($conn, "insert into users(nama,username,email,password,alamat) values('$nama','$username','$email','$password','$alamat')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function tambahalbum($data) {
  global
  $conn;
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $query = mysqli_query($conn, "insert into album(id_user,nama,deskripsi) values('$id_user','$nama','$deskripsi')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function tambahfoto($data) {
  global
  $conn;
  $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $judul = trim(mysqli_real_escape_string($conn, $data["judul"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $path = upload();
  if (!$path) {
    return false;
  }
  $query = mysqli_query($conn, "insert into foto(id_album,id_user,judul,deskripsi,path) values('$id_album','$id_user','$judul','$deskripsi','$path')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function upload() {
  global $conn;
  $namaG = $_FILES['path']['name'];
  $errorG = $_FILES['path']['error'];
  $tmpG = $_FILES['path']['tmp_name'];
  $sizeG = $_FILES['path']['size'];

  if ($errorG === 4) {
    echo "<div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Kamu belum memasukkan gambar</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>";
    return false;
  }


  $validasiG = ['img',
    'jpg',
    'jpeg',
    'png'];
  $ekstensiG = explode('.', $namaG);
  $ekstensiG = strtolower(end($ekstensiG));

  $newnamaG = uniqid();
  $newnamaG .= '.';
  $newnamaG .= $ekstensiG;

  if (!in_array($ekstensiG, $validasiG)) {
    echo "
    <div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>File yang kamu pilih bukan gambar</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>
    ";
    return false;
  }
  move_uploaded_file($tmpG, './upload/'.$newnamaG);
  return $newnamaG;

  if ($sizeG > 2000000) {
    echo "
    <div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Ukuran gambar terlalu besar, maximal 2MB</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>
    ";
    return false;
  }


}

function editakun($data){
  global
  $conn;
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $username = trim(mysqli_real_escape_string($conn, $data["username"]));
  $email = trim(mysqli_real_escape_string($conn, $data["email"]));
  $password = trim(mysqli_real_escape_string($conn, $data["password"]));
  $alamat = trim(mysqli_real_escape_string($conn, $data["alamat"]));
  $query = mysqli_query($conn, "update users set id_user = '$id_user', nama = '$nama', username = '$username', email = '$email', password = '$password', alamat = '$alamat' where id_user = '$id_user'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function like($data){
  global $conn;
  $id_foto = $data["id_foto"];
  $id_user = $data["id_user"];
  $query = mysqli_query($conn, "insert into likefoto(id_foto, id_user) values('$id_foto', '$id_user')");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function komen($data){
  global $conn;
  $id_foto = $data["id_foto"];
  $id_user = $data["id_user"];
  $isi = $data["isi_komentar"];
  $query = mysqli_query($conn, "insert into komentarfoto(id_foto, id_user, isi_komentar) values('$id_foto', '$id_user', '$isi')");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function deleteAlbum($data){
  global $conn;
  $id_album = $data["id_album"];
  $query = mysqli_query($conn, "delete from album where id_album = '$id_album'");
    $check = mysqli_affected_rows($conn);
    return $check;
  }
  
  function editAlbum($data) {
    global
    $conn;
    $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
    $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
    $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
    $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
    $query = mysqli_query($conn, "update album set id_user = '$id_user', nama = '$nama', deskripsi = '$deskripsi' where id_album = '$id_album'");
    $check = mysqli_affected_rows($conn);
    return $check;
  }

  function deleteFoto($data){
  global $conn;
$id_foto = $data["id_foto"];
$query = mysqli_query($conn, "delete from foto where id_foto = '$id_foto'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function editFoto($data){
  global
  $conn;
  $id_foto = trim(mysqli_real_escape_string($conn, $data["id_foto"]));
  $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $judul = trim(mysqli_real_escape_string($conn, $data["judul"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $path = oldupload($data["id_foto"]);
  $query = mysqli_query($conn, "update foto set id_album = '$id_album', id_user = '$id_user', judul = '$judul', deskripsi = '$deskripsi', path = '$path' where id_foto = '$id_foto'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function oldupload($data) {
  global $conn;
  $namaG = $_FILES['path']['name'];
  $errorG = $_FILES['path']['error'];
  $tmpG = $_FILES['path']['tmp_name'];
  $sizeG = $_FILES['path']['size'];

  if ($errorG === 4) {
    return mysqli_fetch_array(mysqli_query($conn, "select path from foto where id_foto = '$data'"))["path"];
  }


  $validasiG = ['img',
    'jpg',
    'jpeg',
    'png'];
  $ekstensiG = explode('.', $namaG);
  $ekstensiG = strtolower(end($ekstensiG));

  $newnamaG = uniqid();
  $newnamaG .= '.';
  $newnamaG .= $ekstensiG;

  if (!in_array($ekstensiG, $validasiG)) {
    echo "
    <div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>File yang kamu pilih bukan gambar</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>
    ";
    return false;
  }
  move_uploaded_file($tmpG, './upload/'.$newnamaG);
  return $newnamaG;

  if ($sizeG > 2000000) {
    echo "
    <div id='popupOverlay' 
    class='overlay-container show'> 
   <div class='popup-box'> 
       <h2>Ukuran gambar terlalu besar, maximal 2MB</h2>
       <button class='btn-close-popup' 
               onclick='togglePopupRe()'>OK</button> 
   </div> 
</div>
    ";
    return false;
  }
}

function deleteKomentar($data){
  global $conn;
$id_komentar = $data["id_komentar"];
$query = mysqli_query($conn, "delete from komentarfoto where id_komentar = '$id_komentar'");
  $check = mysqli_affected_rows($conn);
  return $check;
}






?>