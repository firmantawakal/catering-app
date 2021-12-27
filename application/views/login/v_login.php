<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Catering App</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/core/core.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo_1/style.css">
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/fav.ico" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style>
		/* background-image: url(../../../assets/images/login-back.jpg); */
		.page-content {
			background-image: url('<?php echo base_url() ?>assets/images/login-back.jpeg');
			background-color: #70baff;
			height: 100%;
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</head>

<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
								<div class="col-md-12 pl-md-0">
									<div class="auth-form-wrapper px-4 py-4">
										<div id="login-form">
											<img class="mx-auto  d-block" src="<?php echo base_url() . 'assets/images/main-logo.png' ?>" style="max-width: 150px;" />
                    						<h5 class="text-muted font-weight-normal mb-2 mt-2">Silahkan Login</h5>
											<div id="message">
											</div>
											<form class="forms-sample" method="post" autocomplete="off" action="<?php echo site_url('login/aksi_login') ?>">
												<div class="form-group">
													<label for="exampleInputEmail1">Username</label>
													<input type="text" class="form-control" name="login-username" id="exampleInputEmail1" placeholder="Username" required>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<div class="input-group date datepicker">
														<input type="password" placeholder="Password" class="form-control pwd" name="login-password" required><span class="input-group-addon reveal"><i data-feather="sun"></i></span>
														<input type="hidden" class="form-control" name="permission" id="permission">
													</div>
												</div>
												<div class="g-recaptcha" style="transform: scale(0.85); -webkit-transform: scale(0.85); transform-origin: 0 0; -webkit-transform-origin: 0 0;" data-sitekey="6LfC7q8dAAAAAIaKaSb6h4fsEUzC09sn2yhJa5Ul"></div>
												<div class="mt-3">
													<button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white btn-block">Login</button>
												</div>
												<div class="d-flex mt-1">
													<div class="ml-auto">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://absensi.dumaikota.go.id/assets/vendors/core/core.js" type="5ea265e1d4203589bd6f3f27-text/javascript"></script>

	<script src="https://absensi.dumaikota.go.id/assets/vendors/feather-icons/feather.min.js" type="5ea265e1d4203589bd6f3f27-text/javascript"></script>
	<script src="https://absensi.dumaikota.go.id/assets/js/template.js" type="5ea265e1d4203589bd6f3f27-text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js" type="5ea265e1d4203589bd6f3f27-text/javascript"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">



	<script type="5ea265e1d4203589bd6f3f27-text/javascript">
		// show or hide password
		$(".reveal").on('click', function() {
			var $pwd = $(".pwd");
			if ($pwd.attr('type') === 'password') {
				$pwd.attr('type', 'text');
			} else {
				$pwd.attr('type', 'password');
			}
		});

		$(document).ready(function() {
			function getCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
				}
				return null;
			}

			function setCookie(name, value, days) {
				var expires = "";
				if (days) {
					var date = new Date();
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					expires = "; expires=" + date.toUTCString();
				}
				document.cookie = name + "=" + (value || "") + expires + "; path=/";
			}

			function generateUUID() {
				var d = new Date().getTime();
				var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
					var r = (d + Math.random() * 16) % 16 | 0;
					d = Math.floor(d / 16);
					return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
				});
				return uuid;
			};

			var idDeviceCookies = getCookie('id_device_cookies');
			if (idDeviceCookies == null) {
				setCookie('id_device_cookies', generateUUID(), 1000);
			};
		});
	</script>

	<script type="5ea265e1d4203589bd6f3f27-text/javascript">
		$(document).ready(function() {
			var x = document.getElementById("demo");

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition, showError);
			} else {
				x.innerHTML = "Geolocation is not supported by this browser.";
			}

			function showPosition(position) {
				x.innerHTML = '<iframe width="100%" height="250px" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBIKL4_UhAFEs4fxihEqrOdj22JC3GfEgo&q=' + position.coords.latitude + ', ' + position.coords.longitude + '"></iframe>';
			}

			function showError(error) {
				switch (error.code) {
					case error.PERMISSION_DENIED:
						document.getElementById("permission").value = 'denied';
						let elem = document.getElementById('login-form');
						// elem.style.visibility = 'hidden';

						let elem2 = document.getElementById('location-notification');
						// elem2.style.visibility = 'visible';
						Swal.fire(
							'Warning! <br> lokasi anda tidak aktif',
							'Mohon untuk mengaktifkan fitur GPS/lokasi. Terimakasih',
							'warning'
						);
						break;
					case error.POSITION_UNAVAILABLE:
						Swal.fire(
							'Warning!',
							'Lokasi tidak tersedia',
							'warning'
						);
						break;
					case error.TIMEOUT:
						Swal.fire(
							'Warning!',
							'Waktu sesi lokasi habis',
							'warning'
						);
						break;
					case error.UNKNOWN_ERROR:
						Swal.fire(
							'Warning!',
							'Lokasi tidak diketahui',
							'warning'
						);
						break;
				}
			}


		});
	</script>
	<script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="5ea265e1d4203589bd6f3f27-|49" defer=""></script>
</body>

</html>