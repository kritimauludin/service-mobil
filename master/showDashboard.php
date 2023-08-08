<?php 

session_start();

if(!$_SESSION['login']){
    header("location:../index.php");
    exit;
}

include_once('../library/modul.php'); 

$totalAdmin = count(query("SELECT * FROM login WHERE role = 'admin'"));
$totalMontir = count(query("SELECT * FROM montir"));
$totalService = count(query("SELECT * FROM service"));
$carInService = count(query("SELECT * FROM service WHERE status = 0"));

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
                <div class="container">
                    <h3 class="text-dark mt-5 mb-5">Selamat datang kembali, <?=$_SESSION['akun']['username']?></h3>
                    <div class="row justify-content-center">
                        <?php if($_SESSION['akun']['role'] == 'superadmin'): ?>
                        <div class="col-lg-3">
                            <div class="card text-center p-3">
                                <h5>Jumlah Admin</h5>
                                <h1><?=$totalAdmin?></h1>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="col-lg-3">
                            <div class="card text-center p-3">
                                <h5>Jumlah Montir</h5>
                                <h1><?=$totalMontir?></h1>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card text-center p-3">
                                <h5>Total Service</h5>
                                <h1><?=$totalService?></h1>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <a href="mobilService.php"> <!--govanda-->
                            <div class="card text-center p-3">
                                <h5>Mobil Sedang Service</h5>
                                <h1><?=$carInService?></h1>
                            </div>
                            </a>
                        </div>
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