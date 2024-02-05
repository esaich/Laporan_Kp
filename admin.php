<?php include 'header.php' ?>


<!-- uji jika tombol di klik -->
<?php 


if (isset($_POST['bsimpan'])) {
    $tgl = date(('Y-m-d'));

    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);


    $simpan = mysqli_query($koneksi, "INSERT INTO tamu VALUES ('' ,'$tgl', '$nama', '$alamat', '$tujuan', '$nope') ");

    // uji jika data berhasil di simpan
    if ($simpan) {
        echo "<script> alert('Data berhasil disimpan, Terimaksih'); document.location='?' </script>";
    }else {
        echo "<script> alert('Data gagal disimpan'); document.location='?' </script>";
    }


}

?>


        <!-- head -->
        <div class="head text-center mt-3">
            <img src="img/bnn.jpg" width="100" alt="">
            <h2 class="text-white">Sistem Informasi Buku Tamu</h2>
        </div>
        <!-- head -->

        <!-- awal row -->
        <div class="row mt-2">
            <!-- col lg 7 -->
            <div class="col-lg-7 mb-3">
                <div class="card shadow bg-gradient-light">
                    <!-- card body -->
                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method="post" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No.Hp Pengunjung" required>
                                </div>


                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">By Said Hamzah <?= date('Y') ?></a>
                            </div>
                            
                        
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!--end  col lg 7 -->


             <!-- col lg 5 -->
             <div class="col-lg-5 mb-3 text-gray-900">
                <!-- card -->
                <div class="card shadow ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4  mb-4">Statistik Pengunjung</h1>
                        </div>

                        <?php 
                        // deklarasi tanggal 

                        // menampilkan tanggal sekarang
                        $tgl_sekarang = date("Y-m-d");

                        // menampilkan tanggal kemarin
                        $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                        // mendapatkan 6 hari sebelum tanggal sekarang
                        $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)) );

                        // bulan ini
                        $bulan_ini= date('m');

                        $sekarang = date('Y-m-d h:i:s');
                        
                        // persiapan query tampilkan jumlah data pengunjung

                        $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE tanggal like '%$tgl_sekarang%' "));

                        $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE tanggal like '%$kemarin%' "));
                        
                        $seminggu = mysqli_fetch_array(mysqli_query($koneksi, 
                        "SELECT count(*) 
                        FROM tamu WHERE tanggal
                        BETWEEN '$seminggu' AND '$sekarang' "));

                        $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE month(tanggal) = '$bulan_ini' "));

                        $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu "));
                        
                        ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Hari Ini</td>
                                    <td><?= $tgl_sekarang[0];  ?></td>
                                </tr>
                                <tr>
                                    <td>Kemarin</td>
                                    <td><?= $kemarin[0];  ?></td>
                                </tr>
                                <tr>
                                    <td>Seminggu</td>
                                    <td><?= $seminggu[0];  ?></td>
                                </tr>
                                <tr>
                                    <td>Bulan Ini</td>
                                    <td><?= $sebulan[0]; ?></td>
                                </tr>
                                <tr>
                                    <td>Keseluruhan</td>
                                    <td><?= $keseluruhan[0]; ?></td>
                                </tr>
                            </table>
                        
                    </div>
                    <!-- card body -->
                </div>
                <!-- card -->
            </div>
            <!-- end col 5 -->


        </div>
        <!-- end row -->


        <!-- card table-->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung hari ini [<?= date('d-m-Y') ?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href="rekapitulasi.php" class="btn btn-success mb-3"> <i class="fa fa-table"></i> Rekapitulasi Pengunjung </a>

                            <a href="logout.php" class="btn btn-danger mb-3"> <i class="fa fa-sign-out-alt"></i> Logout </a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>No Hp</th>
                                            <th>Update Data Tamu</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>No Hp</th>
                                            <th>Update Data Tamu</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM tamu order by id desc");
                                        $no =1;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                        
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td><?= $data['tujuan'] ?></td>
                                            <td><?= $data['nope'] ?></td>
                                            <td> <a href="update.php?id=<?= $data['id']; ?>"> Update </a> </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        <!-- end card -->

       
        <?php include 'footer.php' ?>
