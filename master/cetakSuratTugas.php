<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Data Service Service APP</title>
</head>
<body>

<?php
include_once("../library/modul.php");

if(isset($_GET['kode'])){
	$kode = $_GET['kode'];
	$query = "SELECT kd_service, pelanggan.nama as nama_pelanggan, no_mobil, montir.nama as nama_montir, merk, keluhan
							FROM service 
							INNER JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan
							INNER JOIN montir ON service.id_montir =  montir.id_montir
							WHERE kd_service = '$kode'";
	
	$dataMontir = query($query);
}else{
	echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
	exit;
} 


?>

<div style="text-align: center;">
	<h2 style="margin: 0px;">Surat Tugas Pengerjaan Service</h2>
</div>
<hr>

<h2 style="margin-top: 5px;" >Kepada : <?=$dataMontir[0]['nama_montir']?></h2>
<div>

</div>

<div style="justify-content: center;">
<table id="TabelTampilData" style="table-layout: auto; width: 100%; border-collapse: collapse; margin-top: 10px; margin-left: 10px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Nama Pelanggan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Nomer Mobil</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Merk</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:300px;">Sparepart Digunakan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:300px;">Keluhan</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$SQL	= mysqli_query($connect, $query);
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;

		if ($Baris > 0 ) {
			while ($Data = mysqli_fetch_array($SQL)) {
            $kode = $Data['kd_service'];            
            $spareparts = query("SELECT * FROM transaksi 
                INNER JOIN sparepart ON transaksi.id_sparepart = sparepart.id_sparepart
                WHERE kd_service = '$kode'");
            $Data['sparepart'] = '';
            foreach($spareparts as $sparepart){
                $Data['sparepart'] .='-'.$sparepart['nama'].' ('.$sparepart['jumlah'].' pcs)<br>';
            }
			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data["nama_pelanggan"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data["no_mobil"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data["merk"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">'.$Data["sparepart"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">'.$Data["keluhan"].'</td>
				</tr>';
			}
		}
	?>
	</tbody>
</table>
<div>
<table class="TabelTandaTangan" style="text-align: center; font-size=15px; margin-left: 850px;">
	<?php
	$HariIni = date('Y-m-d');

	echo '<tr>
			<th><p> Bogor, ' .date("d F Y", strtotime($HariIni)). '</p></th>
		  </tr>
		  <tr>
		  	<td>
				<p><b>Mengetahui,</b></p>
					<br>
					<br>
					<br>
					<br>
				<p>(Nama Mekanik)</p>
			</td>
		</tr>';
	?>
</table>
</div>
</div>

</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
require_once('../library/vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new HTML2PDF('L','A4','en');
$html2pdf -> setDefaultFont('times');
$html2pdf -> WriteHTML($html);
$html2pdf -> Output('Data Pelanggan.pdf');
?>