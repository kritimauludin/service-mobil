<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Data Service Service APP</title>
</head>
<body>

<div style="text-align: center;">
	<h2 style="margin: 0px;">Service APP</h2>
</div>
<hr>

<p style="margin-top: 5px;" >Report Data Service (<?=date('d-m-Y')?>)</p>
<div>
<?php
include_once("../library/modul.php");

$query = "SELECT kd_service, pelanggan.nama as nama_pelanggan, no_mobil, montir.nama as nama_montir, total_biaya as biaya
                    FROM service 
                    INNER JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan
                    INNER JOIN montir ON service.id_montir =  montir.id_montir";



?>
</div>

<div style="justify-content: center;">
<table id="TabelTampilData" style="table-layout: auto; width: 100%; border-collapse: collapse; margin-top: 10px; margin-left: 10px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:130px;">Nama Pelanggan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:130px;">Nama Montir</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:130px;">Nomer Mobil</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:300px;">Sparepart Digunakan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:250px;">Biaya</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$SQL	= mysqli_query($connect, $query);
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;
        $total  = 0;

		if ($Baris > 0 ) {
			while ($Data = mysqli_fetch_array($SQL)) {
            $kode = $Data['kd_service'];            
            $spareparts = query("SELECT sparepart.nama FROM transaksi 
                INNER JOIN sparepart ON transaksi.id_sparepart = sparepart.id_sparepart
                WHERE kd_service = '$kode'");
            $Data['sparepart'] = '';
            foreach($spareparts as $sparepart){
                $Data['sparepart'] .='-'.$sparepart['nama'].'<br>';
            }

            $total += $Data['biaya'];
			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=130px;">'.$Data["nama_pelanggan"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=130px;">'.$Data["nama_montir"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=130px;">'.$Data["no_mobil"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=300px;">'.$Data["sparepart"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=250px;">Rp '.$Data["biaya"].'</td>
				</tr>';
			}
		}
	?>
	</tbody>
</table>
<div>
<table class="TabelTandaTangan" style="text-align: center; font-size:15px; margin-left: 850px;">
	<?php

	echo '<tr>
			<th><p> Total : Rp '.$total.'</p></th>
		  </tr>
		  <tr>
		  	<td>
				<p>______________________</p>
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