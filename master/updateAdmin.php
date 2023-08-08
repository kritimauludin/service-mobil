<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }else if($_SESSION['akun']['role'] != 'superadmin'){
        header("location:showDashboard.php");
    }
    
    include_once('../library/modul.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $data = query("SELECT * FROM login where id = '$id'");
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
    }

    if(isset($_POST['saveData'])){
        if(updateDataAdmin($_POST) > 0){
            echo "<script>alert('Perubahan berhasil disimpan!!'); document.location.href = 'showAdmin.php';</script>";
        }else{
            echo "<script>alert('Perubahan gagal disimpan!!'); document.location.href = 'showAdmin.php';</script>";
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
                    <h3 class="text-dark mt-5 mb-4">Ubah Data Admin</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="<?=$data[0]['id']?>">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?=$data[0]['username']?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Isi Jika ingin merubah password lama">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="text-center ml-5">
                                <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Ubah</button>
                                <a href="showAdmin.php" class="btn btn-sm btn-outline-danger">Batal</a>
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