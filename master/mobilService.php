<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 
    
    $services = query("SELECT kd_service, pelanggan.no_mobil, pelanggan.nama as nama_pelanggan, montir.nama as nama_montir 
                        FROM service 
                            INNER JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan
                            INNER JOIN montir ON service.id_montir =  montir.id_montir where status=0"); //govanda
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
                    <h3 class="text-dark mt-5 mb-4">Data Mobil Sedang Service</h3>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                            </div>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Mobil</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Nama Montir</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($services as $service) : ?>
                                        <tr>
                                            <th scope="row"><?=$i++?></th>
                                            <td class="text-uppercase"><?=$service['no_mobil'];?></td>
                                            <td><?=$service['nama_pelanggan'];?></td>
                                            <td><?=$service['nama_montir'];?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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