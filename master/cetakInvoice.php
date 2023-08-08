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
	$query = "SELECT kd_service, pelanggan.nama as nama_pelanggan, no_mobil, montir.nama as nama_montir, merk, keluhan, total_biaya
							FROM service 
							INNER JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan
							INNER JOIN montir ON service.id_montir =  montir.id_montir
							WHERE kd_service = '$kode'";
	
	$Data = query($query);
}else{
	echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
	exit;
} 


?>

<div style="text-align: center;">
	<h2 style="margin: 0px;">Invoice Service Mobil</h2>
</div>
<hr>
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
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:300px;">Keluhan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:300px;">Montir</th>
		</tr>
	</thead>
	<tbody>
	<?php
			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">1</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data[0]["nama_pelanggan"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data[0]["no_mobil"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Data[0]["merk"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">'.$Data[0]["keluhan"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">'.$Data[0]["nama_montir"].'</td>
				</tr>';
	?>
	</tbody>
</table>


<table id="TabelTampilData" style="table-layout: auto; width: 50%; border-collapse: collapse; margin-top: 50px; margin-left: 10px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Nama Sparepart</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Jumlah</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:110px;">Harga</th>
		</tr>
	</thead>
	<tbody>
	<?php        
        $querySparepart = "SELECT * FROM transaksi 
                INNER JOIN sparepart ON transaksi.id_sparepart = sparepart.id_sparepart
                WHERE kd_service = '$kode'";
		$SQL	= mysqli_query($connect, $querySparepart);
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;

		if ($Baris > 0 ) {
			while ($Sparepart = mysqli_fetch_array($SQL)) {
			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Sparepart["nama"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Sparepart["jumlah"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">'.$Sparepart["harga"].'</td>
				</tr>';
			}
            echo '<tr>
                <td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=50px;">Biaya Service : </td>
                <td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">300000</td>
                <td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=110px;">Total Biaya : '.$Data[0]["total_biaya"].'</td>
                <td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">Kembali : '.$_GET["kembali"].'</td>
            </tr>';
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
				<p>(____________________)</p>
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