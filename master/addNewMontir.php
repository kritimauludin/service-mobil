<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 

    $query  = mysqli_query($connect, "SELECT max(id_montir) AS max_id FROM montir");
    $queryResults = mysqli_fetch_array($query);
    $newId = $queryResults['max_id']+1;

    if(isset($_POST['saveData'])){
        if(addNewMontir($_POST) > 0){
            echo "<script>alert('Data berhasil disimpan!!'); document.location.href = 'showMontir.php';</script>";
        }else{
            echo "<script>alert('Data gagal disimpan!!'); document.location.href = 'showMontir.php';</script>";
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
                    <h3 class="text-dark mt-5 mb-4">Tambah Montir</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="id_montir" id="id_montir" value="<?=$newId?>" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama_montir" id="nama_montir" placeholder="Nama Montir" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon" placeholder="No Telepon Montir " required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10"></div>
                            <div class="text-center ml-5">
                                <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Kirim</button>
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