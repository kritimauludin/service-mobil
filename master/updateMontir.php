<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $data = query("SELECT * FROM montir where id_montir = '$id'");
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
    }

    if(isset($_POST['saveData'])){
        if(updateMontir($_POST) > 0){
            echo "<script>alert('Perubahan berhasil disimpan!!'); document.location.href = 'showMontir.php';</script>";
        }else{
            echo "<script>alert('Perubahan gagal disimpan!!'); document.location.href = 'showMontir.php';</script>";
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
                    <h3 class="text-dark mt-5 mb-4">Edit Montir</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="id_montir" id="id_montir" value="<?=$id?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama_montir" id="nama_montir" value="<?=$data[0]['nama']?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?=$data[0]['no_telepon']?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10"></div>
                            <div class="text-center ml-5">
                                <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Ubah</button>
                                <a href="showMontir.php" class="btn btn-sm btn-outline-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<!-- Footer -->
    <?php include_once('../library/footer.php') ?>
<!-- End of Footer -->
</body>
</html>