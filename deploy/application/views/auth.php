<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>RKG DIGITAL INDONESIA</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/<?php echo base_url() ?>assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/<?php echo base_url() ?>assets/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/<?php echo base_url() ?>assets/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/style.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>



<body class="login-page">

	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?php echo base_url() ?>assets/vendors/images/login-page-img.png" alt="">
					<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-dark">LOGIN TO<br> RKG DIGITAL INDONESIA</h2>
						</div>

						<form method="POST" action="#" class="needs-validation" novalidate="" id="clientForm">
							<form accept-charset="UTF-8" role="form" class="form-signin">
								<div class="input-group custom">
									<input type="text" class="form-control form-control-lg" name="username" required placeholder="Username">
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
								<div class="input-group custom">
									<input type="password" class="form-control form-control-lg" name="password" id="password" required placeholder="**********">
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>
								</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" onclick="Toggle()" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">Show Password</label>
										</div>
									</div>
									<div class="col-6">

									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										</div>
										
									</div>
								</div>
							</form>

					</div>
				</div>
			</div>
		</div>

	</div>


	<div style="margin-top: 8px" id="message">
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
		?>
			<script>
				Swal.fire({
					icon: '<?php echo $_SESSION['tipe'] ?>',
					title: 'Notification',
					text: '<?php echo $_SESSION['pesan'] ?>',

				})
			</script>
		<?php
		}
		$_SESSION['pesan'] = '';

		?>
	</div>


	<!-- js -->
	<script src="<?= base_url() ?>assets/rk.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url() ?>assets/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?php echo base_url() ?>assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>

</body>

</html>
