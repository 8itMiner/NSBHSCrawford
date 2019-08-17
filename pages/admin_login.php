<?php
	if (!isset($_REQUEST["dest_dir"])) {
		header("Location: admin_portal");
	}
	
	$dest_dir = $_REQUEST["dest_dir"];
	
	
	// Determine if user has already been logged in before, if they have take them to the data entry portal
	if (isset($_COOKIE["logged_in"])) {
		header("Location: data_entry?file=".$_COOKIE["logged_in"]);
	}
	
	// Handle login requests
	if (isset($_POST["password"])) {
		// Handle the passwords
		$sha = hash('sha256', $_POST["password"]);
		
		// Read the passwords json file
		$f = fopen('../priv/passwords.json', 'r');
    	$jsonRaw = fread($f, filesize('../priv/passwords.json'));
    	$password_json = json_decode($jsonRaw, true);
    	fclose($f);
    	
    	$dest_dirL = strtolower($dest_dir);

    	if ($password_json[$dest_dirL] == $sha || $password_json["master"] == $sha) {
			setcookie('logged_in',$dest_dirL, 0 , "/");    		
    		header("Location: data_entry?file=".$dest_dirL);
    	}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/crawford_logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Sign in to admin portal for <?php echo strtoupper($dest_dir) ?>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" method="post">
						<input type='hidden' id='hiddenField' name='dest_dir' value='<?php echo($dest_dir);?>'
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt2" href="#">
							
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="../js/main.js"></script>

</body>
</html>
