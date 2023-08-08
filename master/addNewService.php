<?php 
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    include_once('../library/modul.php');

    if(isset($_POST['saveData'])){
        if(addNewTransaction($_POST) > 0){
            echo "<script>alert('Data berhasil disimpan!!'); document.location.href = 'showService.php';</script>";
        }else{
            echo "<script>alert('Data gagal disimpan!!'); document.location.href = 'showService.php';</script>";
        }
    }

    $spareparts = query("SELECT * FROM sparepart");

    $SQL		= "SELECT max(kd_service) AS kode FROM service";
    $HasilSQL 	= mysqli_query($connect, $SQL);
    $DataSQL 	= mysqli_fetch_array($HasilSQL);
    $KodeBaru	= $DataSQL['kode'];

    $NoUrut		= (int) substr($KodeBaru, 8, 7);
    $NoUrut++;

    $Char		= "kd";
    $KodeBaru	= $Char . sprintf("%07s", $NoUrut);

    $TampilDataPelanggan = query("SELECT * FROM pelanggan");
    $TampilDataMontir = query("SELECT * FROM montir");


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
                            <div class="col-lg-6">
                                <h3 class="text-dark">Tambah Transaksi Service</h3>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <input type="text" name="tgl_service" id="tgl_service" class="form-control mb-2" value="<?=date("Y-m-d")?>" readonly required>
                            </div>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="kd_service" name="kd_service" value="<?=$KodeBaru?>">
                            <label for="">Data Pelanggan</label>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control mb-2" name="id_pelanggan" id="id_pelanggan"  placeholder="Pilih Pelanggan" readonly required>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="#"  class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#ModalPelanggan">Cari</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control mb-2" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan (auto)" readonly required>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control mb-2" name="no_pelanggan" id="no_pelanggan" placeholder="No Telpon Pelanggan (auto)" readonly required>
                                </div>                                
                            </div>   
                            <label for="">Data Montir</label>  
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control mb-2" name="id_montir" id="id_montir"  placeholder="Pilih Montir" readonly required>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="#" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#ModalMontir">Cari</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="text" class="form-control mb-2" name="nama_montir" id="nama_montir" placeholder="Nama Montir (auto)" readonly required>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <input type="number" class="form-control mb-2" name="no_montir" id="no_montir" placeholder="No Telpon Montir (auto)" readonly required>
                                </div>                                
                            </div>   
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="no_mobil" id="no_mobil" class="form-control mb-2 text-uppercase"  placeholder="No Mobil (auto)" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">                                            
                                            <div class="mb-3">
                                                <input type="text" name="merk" id="merk" class="form-control mb-2" placeholder="Merk (auto)" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <textarea name="keluhan" id="keluhan" cols="100&" rows="4" class="form-control mb-2" placeholder="Keluhan" required></textarea>
                                    </div>
                                </div>                             
                            </div>
                            <div class="row">
                                    <div class="col-lg-1">
                                        <div class="mt-1 ml-5">
                                            <a href="javascript:void(0);" id="add-field-sparepart" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <select class="form-control mb-2" id="id_sparepart[]" name="id_sparepart[]" required>
                                            <option selected>Pilih Sparepart</option>
                                            <?php foreach($spareparts as $sparepart) :?>
                                                <option value="<?=$sparepart['id_sparepart']?>"><?=$sparepart['nama']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>                                   
                                    <div class="col-lg-2">
                                        <input type="number" name="jumlah[]" id="jumlah[]" class="form-control mb-2" placeholder="Jumlah" required>
                                    </div>
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-2">
                                        <button name="saveData" type="submit" class="btn btn-sm btn-outline-info">Kirim</button>
                                        <a href="showService.php" class="btn btn-sm btn-outline-danger">Kembali</a>
                                    </div>                                   
                            </div>
                                <div class="field-sparepart">
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

	<!-- Awal Modal Pelanggan -->
	<div class="modal fade" id="ModalPelanggan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Pelanggan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpPelanggan" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Id</th>
								<th>Nama</th>
								<th>No Telpon</th>                                
								<th>No Mobil</th>
								<th>Merk</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataPelanggan as $Baris) : ?>
							<tr class="PilihDataPelanggan" data-id="<?= $Baris['id_pelanggan']; ?>"
								class="PilihDataPelanggan" data-nama="<?= $Baris['nama']; ?>"
								class="PilihDataPelanggan" data-no_telepon="<?= $Baris['no_telepon']; ?>"
								class="PilihDataPelanggan" data-no_mobil="<?= $Baris['no_mobil']; ?>"
								class="PilihDataPelanggan" data-merk="<?= $Baris['merk']; ?>"
                                >
								<td><?= $Baris['id_pelanggan']; ?></td>
								<td><?= $Baris['nama']; ?></td>
								<td><?= $Baris['no_telepon']; ?></td>
								<td><?= $Baris['no_mobil']; ?></td>
								<td><?= $Baris['merk']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Pelanggan -->
	<!-- Awal Modal montir -->
	<div class="modal fade" id="ModalMontir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Montir</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpMontir" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Id</th>
								<th>Nama</th>
								<th>No Telpon</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMontir as $Baris) : ?>
							<tr class="PilihDataMontir" data-id="<?= $Baris['id_montir']; ?>"
								class="PilihDataMontir" data-nama="<?= $Baris['nama']; ?>"
								class="PilihDataMontir" data-no_telepon="<?= $Baris['no_telepon']; ?>">
								<td><?= $Baris['id_montir']; ?></td>
								<td><?= $Baris['nama']; ?></td>
								<td><?= $Baris['no_telepon']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal montir -->

    <script type="text/javascript">
            var addButton = $('#add-field-sparepart');
            var field  = $('.field-sparepart');            
            var fieldHtml = `<div class="row"><div class="col-lg-1"></div><div class="col-lg-5"><select class="form-control mb-2" id="id_sparepart[]" name="id_sparepart[]" required><option selected>Pilih Sparepart</option><?php foreach($spareparts as $sparepart) : ?><option value="<?=$sparepart['id_sparepart']?>"/><?=$sparepart["nama"]?></option><?php endforeach;?></select></div><div class="col-lg-2"><input type="number" name="jumlah[]" id="jumlah[]" class="form-control mb-2" placeholder="Jumlah" required></div></div></div>`;
            
            $(addButton).click(function(){
                $(field).append(fieldHtml);
            });

            // Modal pelanggan
            $(document).on('click', '.PilihDataPelanggan', function (e) {
                document.getElementById("id_pelanggan").value = $(this).attr('data-id');
                document.getElementById("nama_pelanggan").value = $(this).attr('data-nama');
                document.getElementById("no_pelanggan").value = $(this).attr('data-no_telepon');
                document.getElementById("no_mobil").value = $(this).attr('data-no_mobil');
            document.getElementById("merk").value = $(this).attr('data-merk');
            $('#ModalPelanggan').modal('hide');
            });
        
            // Modal Montir
            $(document).on('click', '.PilihDataMontir', function (e) {
                document.getElementById("id_montir").value = $(this).attr('data-id');
                document.getElementById("nama_montir").value = $(this).attr('data-nama');
                document.getElementById("no_montir").value = $(this).attr('data-no_telepon');
                $('#ModalMontir').modal('hide');
            });


    </script>
</body>
</html>