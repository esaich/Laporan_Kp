<?php include 'header.php' ?>
<?php include 'koneksi.php' ?>
<?php 
$id = $_GET["id"];
$mhs = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tamu WHERE id = $id "));





// queri data mahasiswa berdasarkan id
// $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tamu WHERE id = $id "));
//  var_dump($data);
function ubah($data){
    global $koneksi;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $tujuan = htmlspecialchars($data['tujuan']);
    $nope = htmlspecialchars($data['nope']);

    $query = "UPDATE tamu SET nama = '$nama ',  alamat = '$alamat ',  tujuan = '$tujuan ',  nope = '$nope' WHERE id='$id'";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);


}


if (isset($_POST['bsimpan'])) {
    



    
    // cek apakah data berhasi di tambahkan?
    if (ubah($_POST) > 0) {
        echo "<script> alert('Data berhasil disimpan, Terimaksih'); document.location.href = 'admin.php'; </script>";
    }else {
        echo "<script> alert('Data gagal disimpan'); document.location.href = 'admin.php'; </script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Update data Tamu</h1>
                            </div>
                            <form class="user" method="post" action="">
                                <input type="hidden" name="id" value="<?= $mhs['id']; ?>" >
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" id="nama" value="<?= $mhs['nama']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat Pengunjung" id="alamat" value="<?= $mhs['alamat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" id="tujuan" value="<?= $mhs['tujuan']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No.Hp Pengunjung" id="nope" value="<?= $mhs['nope']; ?>" required>
                                </div>


                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Update Data</button>
                               
                            </form>
            
                            
                        
                    </div>


</body>
</html>

<?php include 'footer.php' ?>