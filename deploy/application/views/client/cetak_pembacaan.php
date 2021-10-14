<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hasil Pembacaan Gambar</title>
	<style>
		table.headers tr th {
			border: 0;
			border-collapse: separate;
			vertical-align: text-top;
			text-align: left;
			font-family: "Arial";
		}

		table.data {

			margin-left: auto;
			margin-right: auto;
			/* border: none; */
			border-collapse: separate;
			margin-top: 10px;
		}

		table.data tr th {
			font-size: 10pt;
			text-align: left;
			font-weight: normal;
			font-family: "Arial";
		}

		table.radiograf tr th {
			border-collapse: collapse;
			font-size: 10pt;
			text-align: left;
			font-weight: normal;
			font-family: "Arial"
		}
	</style>
	<style>
		@media print {
			/* @page {
				sheet-size: 330mm 210mm;
				margin-left: 0.8cm;
				margin-right: 0.8cm;
				margin-bottom: 1cm;
				margin-top: 1cm;
			} */

			.text-center {
				text-align: center;
			}

			.bold {
				font-weight: bold;
			}

			.table {
				width: 100%;
				max-width: 100%;
				border-collapse: collapse;
				/*border-collapse: separate;*/
			}

			.table-bordered tr td {
				border: 0.01em solid black;
				padding-left: 10px;
				padding-right: 3px;
			}

			body {
				font-family: "Arial";
				font-size: 10pt;
			}
		}
	</style>
</head>

<body>
	<table width="100%" style="margin-top:-10;margin-left:-10px">
		<tr>
			<th style="background-image: url('<?= base_url() ?>uploads/shape.PNG');width:100%;height:250px; fit-content:fill;position:absolute;top:0;left:0; background-position: top center;background-repeat:no-repeat"></th>
		</tr>
	</table>
	<div style="margin-top: -30px;margin-left:auto;margin-right:auto;width:90%;background-color:dimgray;padding:5px 0px 5px auto;text-align:center;color:white;font-weight:bold">
		LEMBAR INTERPRETASI HASIL FOTO RONTGEN
	</div>
	<table class="data" style="width: 70% !important;">
		<tr>
			<th width="150px">
				<p> &nbsp;&nbsp;Kepada Yth. : T.S.</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="250px" style="text-align: left;">
				<p>drg.</p>
			</th>
			<th width="20px"></th>
			<th width="100px">
				<p>Tanggal</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="200px" style="text-align: left;">
				<p><?= formatTanggal(substr($created_at, 0, 10)) ?></p>
			</th>
		</tr>
		<tr>
			<th width="150px">
				<p> &nbsp;&nbsp;No. Pendaftaran</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="250px" style="text-align: left;">
				<p><?= $id_order ?></p>
			</th>
			<th width="20px"></th>
			<th width="100px">
				<p>Umur</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="200px" style="text-align: left;">
				<p><?= $umur ?> Tahun</p>
			</th>
		</tr>
		<tr>
			<th width="150px">
				<p> &nbsp;&nbsp;Nama Pasien</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="250px" style="text-align: left;">
				<p><?= $nama_pasien ?></p>
			</th>
			<th width="20px"></th>
			<th width="100px">
				<p>Jenis Kelamin</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="200px" style="text-align: left;">
				<p><?= $jenis_kelamin ?></p>
			</th>
		</tr>
		<tr>
			<th width="150px">
				<p> &nbsp;&nbsp;Diagnosa Klinis</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="250px" style="text-align: left;">
				<p><?= $suspek ?></p>
			</th>
			<th width="20px"></th>
			<th width="100px">
				<p>Alamat</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="200px" style="text-align: left;">
				<p><?= $alamat_pasien ?></p>
			</th>
		</tr>
	</table>
	<div style="margin-top: 10px;margin-left:auto;margin-right:auto;width:90%;background-color:black;padding:2px 0px 2px auto;text-align:center;color:white;font-weight:bold">

	</div>
	<br>
	<table class="radiograf" style="margin-left:40px">
		<tr>
			<th colspan="2" style="text-align: left;">
				<p>Jenis Radiograf :</p>
			</th>
		</tr>
		<tr>
			<th colspan="2" style="text-align: left;">
				<p>Interpretasi, </p>
			</th>
		</tr>
	</table>

	<br>
	<table class="table table-bordered" border="1" width="100%" style="margin-left:40px;margin-right:40px">
		<tr>
			<th>REGIO</th>
			<th>KETERANGAN</th>
			<th>RADIODIAGNOSIS KHUSUS</th>
		</tr>
		<?php foreach ($this->db->order_by('lokasi','ASC')->get_where('detail_regio_angka', array('id_order' => $id_order))->result() as $rows) : ?>
			<tr>
				<td width="10%" align="center">
					<p><?= $rows->lokasi ?><?= $rows->angka ?></p>
				</td>
				<td>
					<p><?= $rows->keterangan ?></p>
				</td>
				<td>
					<p><?= $rows->radiodiagnosis_khusus ?></p>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<br>
	<table class="radiograf" style="margin-left:40px;margin-right:40px">
		<tr>
			<th style="text-align: left;">
				<p>Radiodiagnosis Umum</p>
			</th>
			<th style="text-align: left;" width="200px">: <?= $suspek ?></th>
		</tr>
	</table>
	<br>
	<br>

	<table class="radiograf" width="100%"  style="margin-left:40px;margin-right:40px">
		<tr>
			<th colspan="2" style="text-align: left;">
				<p>Terima kasih atas kepercayaan sejawat.</p>
			</th>
		</tr>
		<tr>
			<th colspan="2">Salam, </th>
		</tr>
		<tr>
			<th colspan="2">
				<br><br><br><br><br><br>
			</th>
		</tr>
		<tr>
			<th colspan="2">
				<p><?= $pembaca_nama ?></p>
			</th>
		</tr>
	</table>
	<table width="100%" style="position:absolute;bottom:0;margin-top:100px">
		<tr>
			<th style="background-image: url('<?= base_url() ?>uploads/shape-2.PNG');width:100%;height:300px; fit-content:cover;position:absolute;top:0;bottom:0;left:0; background-position: bottom center;background-repeat:no-repeat;"></th>
		</tr>
	</table>
</body>

</html>
