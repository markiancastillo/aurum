<?php
	include('controllers/manage_allowance_controller.php');
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
							<h1 class="text-center">Manage Allowance Values</h1>
							<br />
							<form method="POST" class="form-horizontal col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label class="control-label col-lg-4">Mobile Allowance</label>
									<div class="col-lg-8">
										<input type="number" id="inpMob" name="inpMob" class="form-control" min="1" max="99999" step=".01" value='<?php echo $allowanceMobile; ?>' required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4">Medical Allowance</label>
									<div class="col-lg-8">
										<input type="number" id="inpMed" name="inpMed" class="form-control" min="1" max="999999" step=".01" value='<?php echo $allowanceMed; ?>' required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4">ECOLA</label>
									<div class="col-lg-8">
										<input type="number" id="inpEco" name="inpEco" class="form-control" min="1" max="99999" step=".01" value='<?php echo $allowanceEcola; ?>' required="true" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-4 col-lg-offset-8">
										<button type="submit" id="btnSave" name="btnSave" class="btn btn-primary btn-block">Save Changes</button>
									</div>
								</div>
							</form>
						</div>
</body>
</html>