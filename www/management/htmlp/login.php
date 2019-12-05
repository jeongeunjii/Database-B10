<!-- <!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta
name="viewport" content="width=device-width, initial-scale=1.0"> <meta
http-equiv="X-UA-Compatible" content="ie=edge"> <title>Document</title> </head>
<body> </form> </body> </html> -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>10Jo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="../php/login.php">
					<span class="login100-form-title p-b-26">
						10Jo Management
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="password">
						<span class="focus-input100" data-placeholder="이름"></span>
					</div>


					<div class="wrap-input100 validate-input">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="id">
						<span class="focus-input100" data-placeholder="사번"></span>
					</div>

					<div id="login_error">
						<?php
							if ($_SESSION['WRID'] == "error") {
						?>
								존재하지 않는 직원입니다.
						<?php
							} else if ($_SESSION['WRPW'] == "error") {
						?>
								사번이 틀렸습니다.
						<?php
							}
						?>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" >
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/animsition/js/animsition.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>

	<script src="vendor/countdowntime/countdowntime.js"></script>

	<script src="js/main.js"></script>

        <!-- <main>
            <form method="post" action="../php/login.php">
                <input type="text" name="id" placeholder="사번"/>
                <input type="text" name="password" placeholder="이름"/>
                <input type="submit" value="login"/>
            </form>
        </main> -->
</body>
</html>