<?php 
$server = "localhost";
$user = "root";
$password = "";
$database = "buku-tamu";

$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

?>