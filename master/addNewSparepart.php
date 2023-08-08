<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 

    $query  = mysqli_query($connect, "SELECT max(id_sparepart) AS max_id FROM sparepart");
    $queryResults = mysqli_fetch_array($query);
    $newId = $queryResults['max_id']+1;

    if(isset($_POST['saveData'])){
        if(addNewSparepart($_POST) > 0){
            echo "<script>alert('Data berhasil disimpan!!'); document.location.href = 'showSparepart.php';</script>";
        }else{
            echo "<script>alert('Data gagal disimpan!!'); document.location.href = 'showSparepart.php';</script>";
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
                    <h3 class="text-dark mt-5 mb-4">Tambah Sparepart</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="id_sparepart" id="id_sparepart" value="<?=$newId?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama_sparepart" id="nama_sparepart" placeholder="Nama Sparepart" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga Satuan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10"></div>
                            <div class="text-center ml-5">
                                <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Kirim</button>
                                <a href="showSparepart.php" class="btn btn-sm btn-outline-danger">Batal</a>
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