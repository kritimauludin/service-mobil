<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 

    if(isset($_POST['saveData'])){
        if(addNewPelanggan($_POST) > 0){
            echo "<script>alert('Data berhasil disimpan!!'); document.location.href = 'showPelanggan.php';</script>";
        }else{
            echo "<script>alert('Data gagal disimpan!!'); document.location.href = 'showPelanggan.php';</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../library/header.php'); ?>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include_once('../library/sidebar.php') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php include_once('../library/topbar.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h3 class="text-dark mt-5 mb-4">Tambah Pelanggan</h3>
                    <div class="col-lg-10">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="mb-3 col-lg-12">
                                            <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" placeholder="Input Id Pelanggan">  <!-- kriti-->
                                        </div>
                                        <div class="mt-2 mb-3 col-lg-12">
                                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan" required>
                                        </div>
                                        <div class="mb-3 col-lg-12">
                                            <input type="number" class="form-control" name="no_telepon" id="no_telepon" placeholder="No Telepon Pelanggan " required>
                                        </div>                                
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="mb-3">
                                        <textarea name="alamat" id="alamat" cols="100&" rows="4" class="form-control" placeholder="Alamat Pelanggan" required></textarea>
                                    </div>
                                </div>                           
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <input type="text" name="no_mobil" id="no_mobil" placeholder="Plat Nomer Mobil" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="text" name="merk" id="merk" placeholder="Merk Mobil" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">                                
                                    <div class="text-center">
                                        <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Kirim</button>
                                        <a href="showPelanggan.php" class="btn btn-sm btn-outline-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<!-- Footer -->
    <?php include_once('../library/footer.php') ?>
<!-- End of Footer -->
</body>
</html>