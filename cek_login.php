<!-- aktifkan session -->
<?php 
session_start();

// pangggil koneksi database
include "koneksi.php";

@$pass = md5($_POST['password']);
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);


$login = mysqli_query($koneksi, "SELECT * FROM user where username = '$username' and password = '$password' and status = 'aktif' ");

$data = mysqli_fetch_array($login);


// jika username dan password ditemkan

if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['nama_pengguna'] = $data['nama_pengguna'];


    header('location:admin.php');

}else {
    echo " <script>
        alert('Maaf Login gagal');
        document.location='index.php';
     </script> ";
}




?>