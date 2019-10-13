<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo base_url(); ?>">
	<title><?php echo $this->db->get('settings')->row()->system_vendor; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo $this->db->get('settings')->row()->logo; ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="include/login0202/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="include/login0202/css/util.css">
	<link rel="stylesheet" type="text/css" href="include/login0202/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('include/login0202/images/back01.jpg');">
			<div class="wrap-login100">
				<form action="auth/login" method="POST"  class="login100-form validate-form">
					<span class="login100-form-logo">
						<img src="<?php echo $this->db->get('settings')->row()->logo; ?>">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						<?php echo $this->db->get('settings')->row()->system_vendor; ?>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="identity" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="include/login0202/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/vendor/bootstrap/js/popper.js"></script>
	<script src="include/login0202/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/vendor/daterangepicker/moment.min.js"></script>
	<script src="include/login0202/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="include/login0202/js/main.js"></script>

</body>
</html>