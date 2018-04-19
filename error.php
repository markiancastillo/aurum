<?php
	include('controllers/error_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="text-center">Something Went Wrong</h1>
					<h3 class="text-center">The page you requested cannot be found or does not exist.</h3>
					<br>
					<div class="col-lg-2 col-lg-offset-5">
						<form method="POST">
							<!--<button type="submit" class="btn btn-block btn-default" id="btnHome" name="btnHome">
								<span class='glyphicon glyphicon-home'></span> Back to Home
							</button>-->
							<a href="index.php" class="btn btn-block btn-default">
								<span class='glyphicon glyphicon-home'></span> Back to Home
							</a>
						</form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>