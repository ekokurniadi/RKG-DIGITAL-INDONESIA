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
			@page {
				sheet-size: 330mm 210mm;
				margin-left: 0.8cm;
				margin-right: 0.8cm;
				margin-bottom: 1cm;
				margin-top: 1cm;
			}

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
	<table class="headers">
		<tr>
			<th rowspan="4">
				<img src="<?= base_url() ?>uploads/rsgm.png" alt="" width="120px" style="vertical-align:top;">
			</th>
			<th>
				<h3>INSTALASI RADIOLOGI KEDOKTERAN GIGI</h3>
			</th>
		</tr>
		<tr>
			<th>
				<h3>RUMAH SAKIT GIGI DAN MULUT (RSGM)</h3>
			</th>
		</tr>
		<tr>
			<th>
				<h3>FAKULTAS KEDOKTERAN GIGI UNIVERSITAS PADJAJARAN</h3>
			</th>
		</tr>
		<tr>
			<th>
				<h6>Jl. Sekeloa Selatan No. 1 Bandung Telp/Fax. 022 2532683</h6>
			</th>
		</tr>
	</table>
	<div style="margin-top: 40px;margin-left:auto;margin-right:auto;width:100%;background-color:dimgray;padding:5px 0px 5px auto;text-align:center;color:white;font-weight:bold">
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
				<p><?= $nama ?></p>
			</th>
			<th width="20px"></th>
			<th width="100px">
				<p>Jenis Kelamin</p>
			</th>
			<th>
				<p>:</p>
			</th>
			<th width="200px" style="text-align: left;">
				<p><?= $jk ?></p>
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
				<p><?= $alamat ?></p>
			</th>
		</tr>
	</table>
	<div style="margin-top: 10px;margin-left:auto;margin-right:auto;width:100%;background-color:black;padding:2px 0px 2px auto;text-align:center;color:white;font-weight:bold">

	</div>
	<br>
	<table class="radiograf">
		<tr>
			<th colspan="2" style="text-align: left;">
				<p>Jenis Radiograf :</p>
			</th>
		</tr>
		<tr>
			<th style="text-align: left;">
				<p>Intra Oral</p>
			</th>
			<th style="text-align: left;" width="200px">: <?= $intra_oral ?></th>
		</tr>
		<tr>
			<th style="text-align: left;">
				<p>Elemen Gigi</p>
			</th>
			<th style="text-align: left;" width="200px">: <?= $elemen_gigi ?></th>
		</tr>
		<tr>
			<th colspan="2" style="text-align: left;">
				<p>Interpretasi, </p>
			</th>
		</tr>
	</table>

	<br>
	<table class="table table-bordered" border=1>
		<?php foreach ($this->db->get_where('detail_pembacaan', array('id_order' => $id_order))->result() as $rows) : ?>
			<tr>
				<td width="30%">
					<p><?= $rows->elemen ?></p>
				</td>
				<td>
					<p><?= $rows->keterangan ?></p>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<br>
	<table class="radiograf">
		<tr>
			<th style="text-align: left;">
				<p>Suspek Radiodiagnosis</p>
			</th>
			<th style="text-align: left;" width="200px">: <?= $suspek ?></th>
		</tr>
	</table>
	<br>
	<br>

	<table class="radiograf" >
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
</body>

</html>
