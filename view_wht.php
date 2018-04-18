<?php
	include('controllers/view_wht_controller.php');
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
			<div class="row mt">
				<div class="form-panel">
					<fieldset>
						<div class="col-lg-12">
							<h1 class="text-center">Edit record details</h1>
							<br />
							<form class="form-horizontal col-lg-8 col-lg-offset-2" method="POST">
								<div class="form-group">
									<label class="control-label col-lg-4">Range (Lower)</label>
									<div class="col-lg-8">
										<input type="number" id="inpLower" name="inpLower" class="form-control" min="1" step=".01" max="999999.99" value="<?php echo $whtMinValue ?>" required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4">Range (Upper)</label>
									<div class="col-lg-8">
										<input type="number" id="inpUpper" name="inpUpper" class="form-control" min="1" step=".01" max="999999.99" value="<?php echo $whtMaxValue ?>"required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4">Percentage Over</label>
									<div class="col-lg-8">
										<input type="number" id="inpOver" name="inpOver" class="form-control" min="0.01" step=".01" max="1" value="<?php echo $whtPercentageOver ?>" required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4">Base Tax</label>
									<div class="col-lg-8">
										<input type="number" id="inpBase" name="inpBase" class="form-control" min="1" step=".01" max="999999.99" value="<?php echo $whtBaseTax ?>" required="true" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-4">
										<a href="manage_wht.php" class="btn btn-default btn-block">
											<span class="glyphicon glyphicon-chevron-left"></span> Back to List
										</a>
									</div>
									<div class="col-lg-4 col-lg-offset-4">
										<button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary btn-block">Update Record</button>
									</div>
								</div>
							</form>
						</div>
</body>
</html>