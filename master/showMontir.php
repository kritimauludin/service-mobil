<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 
    
    $montirs = query("SELECT * FROM montir");    
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
                    <h3 class="text-dark mt-5 mb-4">Data Montir</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <a href="addNewMontir.php" class="btn btn-sm btn-info"><i class="fas fa-fw fa-plus"></i></a>
                            </div>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($montirs as $montir ) : ?>
                                        <tr>
                                            <th scope="row"><?=$i++?></th>
                                            <td><?=$montir['nama'];?></td>
                                            <td><?=$montir['no_telepon'];?></td>
                                            <td>
                                                <a href="deleteMontir.php?id=<?=$montir['id_montir']?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="updateMontir.php?id=<?=$montir['id_montir']?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-pen"></i></a>
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