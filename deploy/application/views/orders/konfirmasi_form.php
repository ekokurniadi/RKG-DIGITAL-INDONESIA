<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Konfirmasi Pembayaran</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Konfirmasi Pembayaran </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form action="<?php echo $action; ?>" method="post" class="form-horizontal">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Kode Order </label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="kode_order" id="kode_order" placeholder="kode_order" value="<?php echo $kode_order; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Nama Client </label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Total tagihan Client </label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" name="total" id="total" placeholder="total" value="<?php echo number_format($total, 0, ',', '.'); ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Bukti Pembayaran </label>
						<div class="col-md-12 col-md-10">
							<img src="<?= base_url('uploads/user_image/' . $bukti_pembayaran) ?>" width="100%" alt="">
						</div>
					</div>


					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Status</label>
						<div class="col-sm-12 col-md-10">
							<select name="status_pembayaran" id="status_pembayaran" class="form-control">
								<?php
								$status = "Pilih status";
								if ($status_pembayaran == 0) {
									$status = "Belum dibayar";
								} elseif ($status_pembayaran == 1) {
									$status = "Menunggu konfirmasi";
								} elseif ($status_pembayaran == 2) {
									$status = "Tolak";
								} else {
									$status = "Valid";
								}
								?>
								<option value="<?= $status_pembayaran ?>"><?=$status?></option>
								<option value="2">Tolak</option>
								<option value="3">Valid</option>
							</select>
						</div>
					</div>


					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
						<a href="<?php echo site_url('konfirmasi_pembayaran') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>
			</div>
		</div>
	</div>
</div>
