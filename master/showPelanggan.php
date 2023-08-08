<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 
    
    $pelanggans = query("SELECT * FROM pelanggan");    
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
                    <h3 class="text-dark mt-5 mb-4">Data Pelanggan</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <a href="addNewPelanggan.php" class="btn btn-sm btn-info"><i class="fas fa-fw fa-plus"></i></a>
                            </div>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>                                        
                                        <th scope="col">Id Pelanggan</th> <!-- kriti-->
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($pelanggans as $pelanggan ) : ?>
                                        <tr>
                                            <th scope="row"><?=$i++?></th>
                                            <td><?=$pelanggan['id_pelanggan'];?></td>
                                            <td><?=$pelanggan['nama'];?></td>
                                            <td><?=$pelanggan['no_telepon'];?></td>
                                            <td>
                                                <a href="deletePelanggan.php?id=<?=$pelanggan['id_pelanggan']?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                                <a href="updatePelanggan.php?id=<?=$pelanggan['id_pelanggan']?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-pen"></i></a>
                                                <a href="detailPelanggan.php?id=<?=$pelanggan['id_pelanggan']?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i></a>
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