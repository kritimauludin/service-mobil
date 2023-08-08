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
                            INNER JOIN montir ON service.id_montir =  montir.id_montir");
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
                    <h3 class="text-dark mt-5 mb-4">Data Service</h3>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <a href="addNewService.php" class="btn btn-sm btn-info"><i class="fas fa-fw fa-plus"></i></a>
                            </div>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Mobil</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Nama Montir</th>
                                        <th scope="col">Aksi</th>
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
                                            <td>
                                                <a href="deleteService.php?kode=<?=$service['kd_service']?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="updateService.php?id=<?=$service['kd_service']?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-pen"></i></a>                                                
                                                <a href="detailService.php?id=<?=$service['kd_service']?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i></a>
                                            </td>
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