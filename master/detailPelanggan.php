<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dataPelanggan = query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";    
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
                    <h3 class="text-dark mt-5 mb-4">Detail Pelanggan</h3>
                    <div class="col-lg-10">
                        <form action="" method="post">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?=$dataPelanggan[0]['id_pelanggan']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?=$dataPelanggan[0]['nama']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?=$dataPelanggan[0]['no_telepon']?>" disabled>
                                </div>                                
                            </div>   
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="no_mobil" id="no_mobil" value="<?=$dataPelanggan[0]['no_mobil']?>" class="form-control text-uppercase" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="merk" id="merk" value="<?=$dataPelanggan[0]['merk']?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <textarea name="alamat" id="alamat" cols="100&" rows="4" class="form-control" disabled><?=$dataPelanggan[0]['alamat']?></textarea>
                                    </div>
                                </div>                             
                            </div>
                                <div class="row">
                                    <div class="col-lg-10"></div>                                   
                                    <div class="col-lg-2">                                
                                        <div class="text-center">
                                            <a href="showPelanggan.php" class="btn btn-sm btn-outline-danger">Kembali</a>
                                        </div>
                                    </div>
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