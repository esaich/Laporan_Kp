<?php 

// session start
session_start();

// hilangkan session yang sudah di set

unset($_SESSION['id_user']);
unset($_SESSION['passsword']);
unset($_SESSION['nama_pengguna']);
unset($_SESSION['username']);


session_destroy();
echo "<script>
        alert('anda telah keluar dari halaman administrator');
        document.location='index.php';
     </script>";





?>