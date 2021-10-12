<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Order Pembacaan</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Order Pembacaan</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Order Pembacaan </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form method="post" action="<?= $action ?>" class="form-horizontal" enctype="multipart/form-data" id="form_">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Id Order <?php echo form_error('id_order') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" readonly class="form-control" name="id_order" id="id_order" placeholder="Id Order" value="<?php echo $id_order; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">No Rekam Medis <?php echo form_error('no_rekam_medis') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" placeholder="No Rekam Medis" value="<?php echo $no_rekam_medis; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Dokter Pengirim <?php echo form_error('dokter_pengirim') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="dokter_pengirim" id="dokter_pengirim" placeholder="Dokter Pengirim" value="<?php echo $dokter_pengirim; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
						<div class="col-sm-12 col-md-10">
							<textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Lampiran(Foto/Video) <?php echo form_error('foto') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
						</div>
						<?php if ($button == "Update" or $button == "Read") { ?>
							<label class="col-sm-12 col-md-2 col-form-label">Preview <?php echo form_error('foto') ?></label>
							<?php
							$file_parts = pathinfo($foto);
							if ($file_parts) {

								if ($file_parts['extension'] == "jpg" || $file_parts['extension'] == "png" || $file_parts['extension'] == "PNG" || $file_parts['extension'] == "JPEG" || $file_parts['extension'] == "jpeg") { ?>
									<div class="col-md-12 col-md-10">
										<img src="<?= base_url('uploads/user_image/' . $foto) ?>" width="50%" alt="">
									</div>
								<?php  } else { ?>
									<div class="col-md-12 col-md-10">
										<video src="<?= base_url('uploads/user_image/' . $foto) ?>" width="50%" controls>
										</video>
									</div>
								<?php  } ?>
							<?php } ?>
						<?php } ?>
					</div>

					<div class="form-group row">
						<input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-info btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="DATA PASIEN">
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Nama Pasien <?php echo form_error('nama_pasien') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Nama Pasien" value="<?=$nama_pasien?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tempat Lahir <?php echo form_error('tanggal_lahir_pasien') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tanggal Lahir" value="<?=$tempat_lahir?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir <?php echo form_error('tanggal_lahir_pasien') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="date" class="form-control" name="tanggal_lahir_pasien" id="tanggal_lahir_pasien" placeholder="Tanggal Lahir" value="<?=$tanggal_lahir_pasien?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Umur <?php echo form_error('umur') ?></label>

						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="umur" id="umur" placeholder="Umur" readonly value="<?=$umur?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="radio" required class="form" name="jenis_kelamin" id="jk" placeholder="No. Telp" value="Laki-Laki" <?=$jenis_kelamin == "Laki-Laki" ? "checked" : ""?>>
							<label for="">Laki-Laki </label>
							<input type="radio" required class="form" name="jenis_kelamin" id="jk" placeholder="No. Telp" value="Perempuan" <?=$jenis_kelamin == "Perempuan" ? "checked" : ""?>>
							<label for="">Perempuan </label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat_pasien') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="alamat_pasien" id="alamat_pasien" placeholder="Alamat" value="<?=$alamat_pasien?>" />
						</div>
					</div>



					<div class="form-group row">
						<input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-success btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="PEMERIKSAAN">
					</div>

					<div class="form-group row">
						<div class="col-md-12 col-sm-12 ">
							<div class="table-responsive">

								<table style="vertical-align: text-top;border-collapse:collapse;padding:0px 2px 0px 2px;font-size:9pt" width="100%">
									<tr>
										<td width="50%">
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="1" <?= $pemeriksaan == 1 ? "checked" : "" ?>>
											<label for="">
												<p>3D CBCT</p>
											</label>
										</td>
										<td width="50%"><input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="2" <?= $pemeriksaan == 2 ? "checked" : "" ?>>
											<label for="">
												<p>ANALISIS BONE DENSITY ALVEOLAR (HU)</p>
											</label>
										</td>
									</tr>
									<tr>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="3" <?= $pemeriksaan == 3 ? "checked" : "" ?>>
											<label for="">
												<p>PANORAMIK</p>
											</label>
										</td>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="4" <?= $pemeriksaan == 4 ? "checked" : "" ?>>
											<label for="">
												<p>PERIAPIKAL</p>
											</label>
										</td>
									</tr>
									<tr>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="5" <?= $pemeriksaan == 5 ? "checked" : "" ?>>
											<label for="">
												<p>TMJ</p>
											</label>
										</td>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="6" <?= $pemeriksaan == 6 ? "checked" : "" ?>>
											<label for="">
												<p>BITE-WING</p>
											</label>
										</td>
									</tr>
									<tr>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="7" <?= $pemeriksaan == 7 ? "checked" : "" ?>>
											<label for="">
												<p>CHEPALOMETRI</p>
											</label>
										</td>
										<td>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="8" <?= $pemeriksaan == 8 ? "checked" : "" ?>>
											<label for="">
												<p>OCCLUSAL</p>
											</label>
										</td>
									</tr>
									<tr>
										<?php
										$st = "";
										$st1 = "";
										$st2 = "";

										$detail = $this->db->query("SELECT detail from detail_pemeriksaan where no_order='$id_order'") ?>
										<?php if ($detail->num_rows() > 0) {
											foreach ($detail->result() as $row) {
												if ($row->detail == "PA") {
													$st = "checked";
												}
												if ($row->detail == "Lateral") {
													$st1 = "checked";
												}
												if ($row->detail == "Waters") {
													$st2 = "checked";
												}
											}
										} ?>
										<td colspan="2">&nbsp;
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="PA" <?= $st ?>>
											<label for="">
												<p>PA</p>
											</label>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="Lateral" <?= $st1 ?>>
											<label for="">
												<p>Lateral</p>
											</label>
											<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="Waters" <?= $st2 ?>>
											<label for="">
												<p>Waters</p>
											</label>
										</td>

									</tr>
									<tr>
										<td colspan="2"><input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="catatan" value="<?= $catatan ?>" id="catatan" placeholder="Catatan"></td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-success btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="REGIO">
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table width="100%">
									<tr>
										<?php
										$kiri = $this->db->query("SELECT * from regio_kiri_atas order by id DESC")->result() ?>


										<?php foreach ($kiri as $ka) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $ka->id && $rows->lokasi == 1) {
														$state = 'checked';
													}
												}
											}
											?>
											<td style="border-bottom: 2px solid green;">
												<?php echo $ka->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="kiri_atas[]">
											</td>
										<?php endforeach; ?>
										<td width="20px" rowspan="2" align="center">
											<div style="background-color: green;width:2px">&nbsp;</div>
										</td>
										<?php
										$kanan = $this->db->query("SELECT * from regio_kanan_atas order by id ASC")->result() ?>

										<?php foreach ($kanan as $kn) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $kn->id && $rows->lokasi == 2) {
														$state = 'checked';
													}
												}
											}
											?>
											<td style="border-bottom: 2px solid green;">
												<?php echo $kn->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="kanan_atas[]">
											</td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<?php
										$kiri = $this->db->query("SELECT * from regio_kiri_bawah order by id DESC")->result() ?>
										<?php foreach ($kiri as $ka) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $ka->id && $rows->lokasi == 4) {
														$state = 'checked';
													}
												}
											}
											?>
											<td>
												<?php echo $ka->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="kiri_bawah[]">
											</td>
										<?php endforeach; ?>
										<!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
										<?php
										$kanan = $this->db->query("SELECT * from regio_kanan_bawah order by id ASC")->result() ?>
										<?php foreach ($kanan as $kn) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $kn->id && $rows->lokasi == 3) {
														$state = 'checked';
													}
												}
											}
											?>
											<td>
												<?php echo $kn->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="kanan_bawah[]">
											</td>
										<?php endforeach; ?>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-12 d-block">
						<hr style="border: 1px solid gray">
					</div>
					<!-- Romawi -->
					<div class="form-group row">
						<div class="col-md-12">
							<div class="table-responsive d-flex justify-content-center">
								<table width="90%">
									<tr>
										<?php
										$kiri = $this->db->query("SELECT * from regio_romawi_kiri_atas order by id DESC")->result() ?>


										<?php foreach ($kiri as $ka) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $ka->id && $rows->lokasi == 5) {
														$state = 'checked';
													}
												}
											}
											?>
											<td style="border-bottom: 2px solid green;">
												<?php echo $ka->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="romawi_kiri_atas[]">
											</td>
										<?php endforeach; ?>
										<td width="20px" rowspan="2" align="center">
											<div style="background-color: green;width:2px">&nbsp;</div>
										</td>
										<?php
										$kanan = $this->db->query("SELECT * from regio_romawi_kanan_atas order by id ASC")->result() ?>

										<?php foreach ($kanan as $kn) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $kn->id && $rows->lokasi == 6) {
														$state = 'checked';
													}
												}
											}
											?>
											<td style="border-bottom: 2px solid green;">
												<?php echo $kn->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="romawi_kanan_atas[]">
											</td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<?php
										$kiri = $this->db->query("SELECT * from regio_romawi_kiri_bawah order by id DESC")->result() ?>
										<?php foreach ($kiri as $ka) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $ka->id && $rows->lokasi == 8) {
														$state = 'checked';
													}
												}
											}
											?>
											<td>
												<?php echo $ka->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="romawi_kiri_bawah[]">
											</td>
										<?php endforeach; ?>
										<!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
										<?php
										$kanan = $this->db->query("SELECT * from regio_romawi_kanan_bawah order by id ASC")->result() ?>
										<?php foreach ($kanan as $kn) : ?>
											<?php $state = "";
											$cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
											if ($cekKiriAtas->num_rows() > 0) {
												foreach ($cekKiriAtas->result() as $rows) {
													if ($rows->angka == $kn->id && $rows->lokasi == 7) {
														$state = 'checked';
													}
												}
											}
											?>
											<td>
												<?php echo $kn->angka ?>
												<input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="romawi_kanan_bawah[]">
											</td>
										<?php endforeach; ?>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Dokter Pemeriksa <?php echo form_error('dokter_pemeriksa') ?></label>
						<div class="col-sm-12 col-md-10">
							<input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="dokter_pemeriksa" id="dokter_pemeriksa" placeholder="Dokter Pemeriksa" value="<?php echo $dokter_pemeriksa; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Indikasi Pemeriksaan <?php echo form_error('indikasi_pemeriksaan') ?></label>
						<div class="col-sm-12 col-md-10">
							<textarea class="form-control" rows="3" name="indikasi_pemeriksaan" id="indikasi_pemeriksaan" placeholder="Indikasi Pemeriksaan"><?php echo $indikasi_pemeriksaan; ?></textarea>
						</div>
					</div>


					<div class="text-left">
						<input <?= $button == 'Read' ? 'readonly' : "" ?> type="hidden" name="id" value="<?php echo $id; ?>" />
						<?php if ($button != "Read") : ?>
							<button type="submit" id="btnSubmit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<?php endif; ?>
						<a href="<?php echo site_url('order_pembacaan') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#tanggal_lahir_pasien').on('change', function() {
			var tanggal_lahir = document.getElementById('tanggal_lahir_pasien').value;
			var today = new Date();
			var birthday = new Date(tanggal_lahir)
			var year = 0;
			if (today.getMonth() < birthday.getMonth()) {
				year = 1;
			} else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
				year = 1;
			}
			var age = parseFloat(today.getFullYear()) - parseFloat(birthday.getFullYear()) - parseFloat(year);
			if (age < 0) {
				age = 0;
			}
			if(isNaN(age)){
				nilai = 0;
			}else{
				nilai = age;
			}
			$('#umur').val(nilai);
		})
	});
</script>

<script>
	$(':checkbox[readonly]').click(function() {
		return false;
	});
	$(':radio[readonly]').click(function() {
		return false;
	});
</script>
