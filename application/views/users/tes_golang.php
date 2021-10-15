	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/style.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<div class="main-container" style="min-height:100%">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Administrator</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Administrator</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-dark h4"><i class="icon-copy dw dw-newspaper"></i> Administrator</h4>
						<?php echo anchor(site_url('users/create_administrator'), '<i class="icon-copy dw dw-add-file-1"></i> Add New', 'class="btn btn-primary"'); ?>
					</div>
					<div class="pb-20">
						<div class="table-responsive">
							<input type="text" id="tes">
							<table class="data-table table stripe hover nowrap" id="example1" style="min-width:100%;">
								<thead style="text-align: left;">
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Age</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody style="text-align: left;"></tbody>
							</table>
							<script>
								$(document).ready(function() {
									dataTable = $('#example1').DataTable({
										"processing": true,
										"serverSide": true,
										"scrollX": false,
										"language": {
											"infoFiltered": "",
											"processing": "<td style='text-align:center;width:100%;display:block;'><i class='fa fa-spinner fa-spin' style='font-size:80px'></i> </td>",
										},
										"order": [],
										"lengthMenu": [
											[10, 25, 50, 75, 100],
											[10, 25, 50, 75, 100]
										],
										"ajax": {
											url: "http://localhost:8080/api/v1/users",
											type: "POST",
											dataType: "JSON",
											processData: false, // avoid being transformed into a query string,
											contentType: 'application/json',
											cache: false,
											dataSrc: "data",
											data: function(d) {
												d.filter = $('#tes').val();
												return JSON.stringify(d);
											},
										},
										"columns": [
											{"data": "no"},
											{"data": "name"},
											{"data": "age"},
											{"data": "link"},
										]
									});

									dataTable.on('draw.dt', function() {
										var info = dataTable.page.info();
										dataTable.column(0, {
											search: 'applied',
											order: 'applied',
											page: 'applied'
										}).nodes().each(function(cell, i) {
											cell.innerHTML = i + 1 + info.start + ".";
										});
									});
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
