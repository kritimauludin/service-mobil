<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Data Sparepart Service APP</title>
</head>
<body>

<div style="text-align: center;">
	<h2 style="margin: 0px;">Service APP</h2>
</div>
<hr>

<p style="margin-top: 5px;" >Report Data Sparepart(<?=date('d-m-Y')?>)</p>
<div>
<?php
include_once("../library/modul.php");

?>
</div>

<div style="justify-content: center;">
<table id="TabelTampilData" style="table-layout: auto; width: 100%; border-collapse: collapse; margin-top: 10px; margin-left: 100px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:180px;">Nama Sparepart</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width:185px;">Harga</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$SQL	= mysqli_query($connect, "SELECT * FROM sparepart");
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;

		if ($Baris > 0 ) {
			while ($Data = mysqli_fetch_array($SQL)) {
			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=285px;">'.$Data["nama"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=185px;">'.$Data["harga"].'</td>
				</tr>';
			}
		}
	?>
	</tbody>
</table>
<div>
</div>
</div>

</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
require_once('../library/vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf -> setDefaultFont('times');
$html2pdf -> WriteHTML($html);
$html2pdf -> Output('Data Sparepart.pdf');
?>