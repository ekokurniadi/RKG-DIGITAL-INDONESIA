<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap"> -->
	<title>FORM ORDER PEMBACAAN GAMBAR</title>
	<style>
		table {
			border-collapse: collapse;
			border: 0px;
		}

		div.box {
			margin-top: 10px;
			margin-left: auto;
			margin-right: auto;
			width: 90%;
			height: 10px;
			background-color: #737373;
			border-radius: 30px;
			padding: 3px 3px 3px 8px;
			font-size: 9pt;
			color: white;
			font-weight: bold;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		div.box3 {
			width: 30%;
			height: 100px;
			border: 1px solid #737373;
			border-radius: 10px;
			margin-left: 30px;
			margin-top: 10px;
		}

		div.box2 {
			margin-top: 20px;
			margin-left: 30px;
			margin-right: auto;
			width: 30%;
			height: 10px;
			background-color: #737373;
			border-radius: 30px;
			padding: 3px 3px 3px 8px;
			font-size: 9pt;
			color: white;
			font-weight: bold;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

		}

		body {
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif !important;
		}

		div.form {
			margin-left: 40px;
			margin-top: 10px
		}

		table.table-pemeriksaan tr td#box-radius {
			border: 1px solid #737373;
			border-radius: 30px;
			/* padding: 180px; */
			vertical-align: text-top;
		}


		table.table-pemeriksaan {
			vertical-align: text-top;
			font-size: 9pt;
		}

		div.wrapper {
			display: table;
			width: 100%;
		}
	</style>
</head>

<body>


	<table width="100%">
		<tr>
			<th style="background-image: url('<?= base_url() ?>uploads/shape.PNG');width:100%;height:250px; fit-content:fill;position:absolute;top:0;left:0; background-position: top center;background-repeat:no-repeat"></th>
		</tr>
	</table>
	<!-- <table style="margin-top: -90px;width:95%">
		<tr>
			<th>
				<img src="<?= base_url() ?>uploads/unimus.png" alt="" width="200px" style="vertical-align:top;margin-top:-50px">
			</th>
			<th style="width:50%;border-top:5px solid green;text-align:left;vertical-align:text-top">
				<p>&nbsp;</p>
				<p style="font-size: 9pt;font-weight:normal;color:grey;">Lantai LG, Jl. Kedungmundu Raya, No. 22 Kota Semarang - 50273 <br>
					(024)77601005 / +62 823 1400 664
					<br>
					Senin - Jumat, Pukul 08:00 - 16:00 WIB <br>
					radiologi.rsgmunimus@gmail.com <br>
					<em style="color:green">www.rsgmunimus.com</em>
				</p>
			</th>
			<th style="width:25%;border-top:5px solid green;text-align:right;vertical-align:text-top">
				<p>&nbsp;</p>
				<p style="font-size: 25pt;letter-spacing:2px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight:bold;color:black">
					Formulir
				</p>
				<p style="font-size: 25pt;letter-spacing:2px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight:bold;color:green">
					Radiologi
				</p>
			</th>
		</tr>
	</table> -->
	<hr style="margin-top: -40px;color:black;height:2px;margin-left:30px;margin-right:30px;width:90%" >
	<table width="100%" style="margin-top: -50px">
	    <tr>
	        <th><h3 style="font-weight:bold">FORMULIR RADIOLOGI</h3></th>
	    </tr>
	</table>
	
	<table style="margin-top: 0px;margin-right:50;margin-left:50">

		<tr>
			<td width="15%">
				Nama
			</td>
			<td width="5%">
				:
			</td>
			<td width="50%"><?= $nama_pasien ?></td>
			<td rowspan="5" width="0.2px" style="background-color: #737373;text-align:center;margin-left:-50px important"></td>
			<td rowspan="5"></td>
			<td width="25%" style="background-color:#737373;color:white;border-top-left-radius: 50% !important;">
				No. RM*
			</td>
			<td width="5%" style="background-color:#737373;color:white;">
				:
			</td>
			<td width="40%" style="border:1px solid #737373">
				<?= $no_rekam_medis ?>
			</td>
		</tr>
		<tr>
			<td width="15%">
				TTL
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?=$tempat_lahir?>, <?= tgl_indo($tanggal_lahir_pasien) ?></td>
			<td width="25%">
				Dokter Pengirim
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?= $dokter_pengirim ?></td>
		</tr>
		<tr>
			<td width="15%">
				Umur
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?= $umur ?> Tahun</td>
			<td width="25%">
				Alamat
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?= $alamat ?></td>
		</tr>
		<tr>
			<td width="15%">
				JK
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?= $jenis_kelamin ?></td>
			<td width="25%">
				Telepon
			</td>
			<td width="5%">
				:
			</td>
			<td width="40%"><?= $tlp ?></td>
		</tr>
		<tr>
			<td colspan="8">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" width="0.2pt" style="background-color: #737373;text-align:center;margin-left:-50px important"></td>
		</tr>
	</table>
	<p style="margin-left:40px;font-size:9pt">Teman sejawat Yth. </p>
	<div class="box">
		PEMERIKSAAN
	</div>
	<div class="form">
		<table class="table-pemeriksaan">
			<tr>
				<td>
					<!-- <input type="radio" name="" id="" value="1" <?= $pemeriksaan == 1 ? 'checked="checked"' : "" ?>> -->
					<?= $pemeriksaan == 1 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">3D CBCT</label>
				</td>
				<td width="200px"></td>
				<td>
					<?= $pemeriksaan == 2 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td colspan="5">
					<label for="">ANALISIS BONE DENSITY ALVEOLAR (HU)</label>
				</td>

			</tr>
			<tr>
				<td>
					<?= $pemeriksaan == 3 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">PANORAMIK</label>
				</td>
				<td width="200px"></td>
				<td>
				<?= $pemeriksaan == 4 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">PERIAPIKAL</label>
				</td>
				<td width="180px" colspan="4" rowspan="3" id="box-radius">
					<div class="box-radius">
						catatan : <?= $catatan ?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
				<?= $pemeriksaan == 5 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">TMJ</label>
				</td>
				<td width="200px"></td>
				<td>
				<?= $pemeriksaan == 6 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">BITE-WING</label>
				</td>
			</tr>
			<tr>
				<td>
				<?= $pemeriksaan == 7 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">CHEPALOMETRI </label>
					<br>
					<?php
					$st = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
					$st1 = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
					$st2 = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";

					$detail = $this->db->query("SELECT detail from detail_pemeriksaan where no_order='$id_order'") ?>
					<?php if ($detail->num_rows() > 0) {
						foreach ($detail->result() as $row) {
							if ($row->detail == "PA") {
								$st = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
							}
							if ($row->detail == "Lateral") {
								$st1 = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
							}
							if ($row->detail == "Waters") {
								$st2 = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
							}
						}
					} ?>
					<!-- <input type="checkbox" name="" id="" <?= $st ?>> -->
					<?= $st ?>
					<label for="">PA</label>
					<!-- <input type="checkbox" name="" id="" <?= $st1 ?>> -->
					<?= $st1 ?>
					<label for="">Lateral</label>
					<!-- <input type="checkbox" name="" id="" <?= $st2 ?>> -->
					<?= $st2 ?>
					<label for="">Waters</label>
				</td>
				<td width="200px"></td>
				<td>
				<?= $pemeriksaan == 8 ? "<img src=" . base_url('uploads/dot.png') . " width='15' height='15'>" : "<img src=" . base_url('uploads/un-dot.png') . " width='15' height='15'>" ?>
				</td>
				<td>
					<label for="">OCCLUSAL</label>
				</td>
			</tr>
		</table>
	</div>

	<div class="box">
		REGIO
	</div>
	<br>
	<div class="form-group row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table width="90%" style="margin-left: auto;margin-right:auto">
					<tr>
						<?php
						$kiri = $this->db->query("SELECT * from regio_kiri_atas order by id DESC")->result() ?>


						<?php foreach ($kiri as $ka) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $ka->id && $rows->lokasi == 1) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";;
									}
								}
							}
							?>
							<td style="border-bottom: 2px solid #737373;">
								<?php echo $ka->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
						<td width="20px" rowspan="2" align="center">
							<div style="background-color: #737373;width:2px">&nbsp;</div>
						</td>
						<?php
						$kanan = $this->db->query("SELECT * from regio_kanan_atas order by id ASC")->result() ?>

						<?php foreach ($kanan as $kn) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $kn->id && $rows->lokasi == 2) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";

									}
								}
							}
							?>
							<td style="border-bottom: 2px solid #737373;">
								<?php echo $kn->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<?php
						$kiri = $this->db->query("SELECT * from regio_kiri_bawah order by id DESC")->result() ?>
						<?php foreach ($kiri as $ka) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $ka->id && $rows->lokasi == 3) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td>
								<?php echo $ka->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
						<!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
						<?php
						$kanan = $this->db->query("SELECT * from regio_kanan_bawah order by id ASC")->result() ?>
						<?php foreach ($kanan as $kn) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $kn->id && $rows->lokasi == 4) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td>
								<?php echo $kn->angka ?>
							<?=$state?>
							</td>
						<?php endforeach; ?>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<br>
	<br>
	<!-- Romawi -->
	<div class="form-group row">
		<div class="col-md-12">
			<div class="table-responsive d-flex justify-content-center">
				<table width="80%" style="margin-left: auto;margin-right:auto">
					<tr>
						<?php
						$kiri = $this->db->query("SELECT * from regio_romawi_kiri_atas order by id DESC")->result() ?>


						<?php foreach ($kiri as $ka) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $ka->id && $rows->lokasi == 5) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td style="border-bottom: 2px solid #737373;">
								<?php echo $ka->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
						<td width="20px" rowspan="2" align="center">
							<div style="background-color: #737373;width:2px">&nbsp;</div>
						</td>
						<?php
						$kanan = $this->db->query("SELECT * from regio_romawi_kanan_atas order by id ASC")->result() ?>

						<?php foreach ($kanan as $kn) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $kn->id && $rows->lokasi == 6) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td style="border-bottom: 2px solid #737373;">
								<?php echo $kn->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<?php
						$kiri = $this->db->query("SELECT * from regio_romawi_kiri_bawah order by id DESC")->result() ?>
						<?php foreach ($kiri as $ka) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $ka->id && $rows->lokasi == 7) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td>
								<?php echo $ka->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
						<!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
						<?php
						$kanan = $this->db->query("SELECT * from regio_romawi_kanan_bawah order by id ASC")->result() ?>
						<?php foreach ($kanan as $kn) : ?>
							<?php $state = "<img src=" . base_url('uploads/unchecked-checkbox.png') . " width='10' height='10'>";
							$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
							if ($cekKiriAtas->num_rows() > 0) {
								foreach ($cekKiriAtas->result() as $rows) {
									if ($rows->angka == $kn->id && $rows->lokasi == 8) {
										$state = "<img src=" . base_url('uploads/checked-checkbox.png') . " width='10' height='10'>";
									}
								}
							}
							?>
							<td>
								<?php echo $kn->angka ?>
								<?=$state?>
							</td>
						<?php endforeach; ?>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="wrapper" style="display: table;font-size:10pt;margin-top:25px">
		<div style="position:absolute;left:0px;z-index:9999">
			<div class="box2">
				INDIKASI PEMERIKSAAN
			</div>
			<div class="box3" style="height: 150px;width:300px;padding:2px 2px 2px 2px">
				<?= $indikasi_pemeriksaan ?>
			</div>
		</div>
		<!-- kedua -->
		<div style="margin-top:-200px;margin-left:400px;text-align:center;">
			<div style="width: 70%;margin-top:15px;margin-left:25px">
				Semarang, <?= tgl_indo(date('Y-m-d')) ?>
			</div>
			<div class="box3" style="width: 70%;text-align:center;margin-top:5px;border:none">
				<p>Dokter Pemeriksa</p>
				<br>
				<br>
				<br> <br>
				<br>

				( &nbsp; <?= $dokter_pemeriksa ?> &nbsp;)
			</div>
		</div>
	</div>
	<table width="100%" style="position:absolute;bottom:0;margin-top:0px">
		<tr>
			<th style="background-image: url('<?= base_url() ?>uploads/shape-2.PNG');width:100%;height:220px; fit-content:cover;position:absolute;top:0;bottom:0;left:0; background-position: bottom center;background-repeat:no-repeat;"></th>
		</tr>
	</table>
</body>

</html>
