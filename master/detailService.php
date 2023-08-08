<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php'); 
    if(isset($_GET['id'])){
        $kode = $_GET['id'];
        $service = query("SELECT *, pelanggan.nama as nama_pelanggan, pelanggan.no_telepon as no_pelanggan, montir.nama as nama_montir, montir.no_telepon as no_montir
                            FROM service 
                            INNER JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan
                            INNER JOIN montir ON service.id_montir =  montir.id_montir
                            WHERE kd_service = '$kode'");
        
        $spareparts = query("SELECT * FROM transaksi 
                            INNER JOIN sparepart ON transaksi.id_sparepart = sparepart.id_sparepart
                            WHERE kd_service = '$kode'");
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";    
    }
    if(isset($_POST['saveInvoice'])){
        if(saveInvoice($_POST) > 0){
            echo "<script>alert('Pembayaran berhasil, Anda akan dialihkan ke cetak invoice!!'); document.location.href = 'cetakInvoice.php?kode=".$_POST['kd_service']."&kembali=".$_POST['kembali']."';</script>";
        }else{
            echo "<script>alert('Pembayan gagal!!'); document.location.href = 'detailService.php?id=".$_POST['kd_service']."';</script>";
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
                        <div class="row mt-5 mb-3">
                            <div class="col-lg-3">
                                <h3 class="text-dark">Detail Service</h3>
                            </div>
                            <div class="col-lg-5"></div>
                            <div class="col-lg-4">
                                <input type="text" name="" id="" class="form-control" value="<?=$service[0]['tgl_service']?>" disabled>
                            </div>
                        </div>
                        <form action="" method="post">
                            <label for="">Data Pelanggan</label>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control"  value="<?=$service[0]['id_pelanggan']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control" value="<?=$service[0]['nama_pelanggan']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control" value="<?=$service[0]['no_pelanggan']?>" disabled>
                                </div>                                
                            </div>   
                            <label for="">Data Montir</label>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control"  value="<?=$service[0]['id_montir']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control" value="<?=$service[0]['nama_montir']?>" disabled>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control" value="<?=$service[0]['no_montir']?>" disabled>
                                </div>                                
                            </div>   
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="no_mobil" id="no_mobil" value="<?=$service[0]['no_mobil']?>" class="form-control text-uppercase" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="merk" id="merk" value="<?=$service[0]['merk']?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <textarea name="alamat" id="alamat" cols="100&" rows="4" class="form-control" disabled><?=$service[0]['keluhan']?></textarea>
                                    </div>
                                </div>                             
                            </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <select class="form-control" readonly>
                                            <option selected>List Sparepart Diganti</option>
                                            <?php foreach($spareparts as $sparepart) :?>
                                                <option value=""><?=$sparepart['nama']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>                                   
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-4">
                                        <?php if($service[0]['status'] == 0) :?>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-success" data-toggle="modal"  data-target="#ModalPembayaran">Bayar</a>
                                            <a href="cetakSuratTugas.php?kode=<?=$service[0]['kd_service']?>" target="_blank" class="btn btn-sm btn-outline-info">Cetak Surat Tugas</a>
                                        <?php endif;?>
                                        <a href="showService.php" class="btn btn-sm btn-outline-danger">Kembali</a>
                                    </div>                                   
                                </div>
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

	<!-- Awal Modal Pembayaran -->
	<div class="modal fade" id="ModalPembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Menu Pembayaran</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
                    <form action="" method="POST">
                        <label for="">Data Pelanggan</label>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <input type="hidden" class="form-control" name="kd_service"  value="<?=$service[0]['kd_service']?>" required readonly>
                                    <input type="text" class="form-control" name="nama_pelanggan" value="<?=$service[0]['nama_pelanggan']?>" required readonly>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control" name="no_pelanggan" value="<?=$service[0]['no_pelanggan']?>" required readonly>
                                </div>                                
                                <div class="mb-3 col-lg-4">
                                    <input type="hidden" name="id_pelanggan" class="form-control"  value="<?=$service[0]['id_pelanggan']?>" required readonly>
                                    <input type="text" class="form-control" name="no_mobil"  value="<?=$service[0]['no_mobil']?>" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <input type="text" class="form-control"  value="<?=$service[0]['merk']?>" required readonly>                                    
                                </div>
                                <div class="col-lg-8 mb-3">
                                    <textarea name="alamat" id="alamat" cols="100&" rows="2" class="form-control" required readonly><?=$service[0]['keluhan']?></textarea>
                                </div>
                            </div>
                            <label for="">Data Montir</label>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control" value="<?=$service[0]['nama_montir']?>" required readonly>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control" value="<?=$service[0]['no_montir']?>" required readonly>
                                </div>                                
                                <div class="mb-3 col-lg-4">
                                    <input type="hidden" class="form-control"  value="<?=$service[0]['id_montir']?>" required readonly>
                                </div>
                            </div> 
                            <label for="">Sparepart Diganti</label>
                            <?php 
                                $totalBayar = 0;
                                $jasaService = 300000;
                                $totalBarang = 0;    
                            ?>
                            <?php foreach($spareparts as $sparepart) :?>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <input type="text" class="form-control" value="<?=$sparepart['nama']?>" required readonly>
                                </div>
                                <div class="mb-3 col-lg-2">
                                    <input type="number" class="form-control" value="<?=$sparepart['jumlah']?>" required readonly>
                                </div>                                
                                <div class="mb-3 col-lg-4">
                                    <?php 
                                        $totalBarang = $sparepart['harga']*$sparepart['jumlah'];
                                        $totalBayar +=$totalBarang;
                                    ?>
                                    <input type="number" class="form-control"  value="<?=$totalBarang?>" required readonly>
                                </div>
                            </div> 
                            <?php endforeach;?>
                            <div class="row">
                                <div class="mb-3 col-lg-3">
                                    <label for="" class="mb-0">Biaya Jasa</label>
                                    <?php $totalBayar += $jasaService?>
                                    <input type="number" class="form-control" name="biaya_servis" id="biaya_servis" value="<?=$jasaService?>" required readonly>
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="" class="mb-0">Total Bayar</label>
                                    <input type="number" class="form-control" name="total_bayar" id="total_bayar" value="<?=$totalBayar?>" required readonly>
                                </div>                                
                                <div class="mb-3 col-lg-3">
                                    <label for="" class="mb-0">Uang Bayar</label>
                                    <input type="number" class="form-control" name="uang_bayar" id="uang_bayar"  placeholder="Masukan Nominal" required>
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="" class="mb-0">Kembali</label>
                                    <input type="number" class="form-control" name="kembali" id="kembali"  placeholder="otomatis" required readonly>
                                </div>
                            </div> 
                        <div class="modal-footer">
                            <button type="button" id="saveInvoice" name="saveInvoice" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Pembayaran -->
<script type="text/javascript">
    var totalBayar = $('#total_bayar').val();
    $('#uang_bayar').change(function(){
        var uangBayar = $('#uang_bayar').val();
        if(uangBayar < totalBayar){
            alert('Uang anda kurang!!');
        }else{
            kembali = uangBayar - totalBayar;
            $('#kembali').val(kembali);
            $('#saveInvoice').attr('type', 'submit');            
        }
    })
</script>

</body>
</html>