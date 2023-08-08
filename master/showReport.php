<?php 

session_start();

if(!$_SESSION['login']){
    header("location:../index.php");
    exit;
}else if($_SESSION['akun']['role'] != 'superadmin'){
    header("location:showDashboard.php");
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
                    <h3 class="text-dark mt-5 mb-5">Klil untuk memilih report yang ingin anda cetak</h3>
                    <div class="row justify-content-center">
                        <a href="../report/reportDataMontir.php" target="_blank" class="btn btn-primary m-3">Report Data Montir</a>
                        <a href="../report/reportDataSparepart.php" target="_blank" class="btn btn-primary m-3">Report Data Sparepart</a>
                        <a href="../report/reportDataService.php" target="_blank" class="btn btn-primary m-3">Report Data Service</a>
                        <a href="../report/reportDataPelanggan.php" target="_blank" class="btn btn-primary m-3">Report Data Pelanggan</a>
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