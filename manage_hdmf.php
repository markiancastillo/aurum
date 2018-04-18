<?php
	include('controllers/manage_hdmf_controller.php');
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
							<h1 class="text-center">Manage HDMF Contribution</h1>
							<hr />
							<div class="col-lg-10 col-lg-offset-1">
								<?php
									if(isset($_GET['u']))
									{
										$msgDisplay = "<div class='alert alert-success alert-dismissable fade in'>
												<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												Successfully updated HDMF amount.
											</div>";
	
										echo $msgDisplay;
									}
								?>
							</div>
							<div class="col-lg-8 col-lg-offset-2">
								<form class="form-horizontal" method="POST">
									<div class="form-group">
										<label class="control-label col-lg-3">Contribution Amount (Php)</label>
										<div class="col-lg-9">
											<input type="number" id="inpHDMF" name="inpHDMF" class="form-control" min=1 step=".01" value="<?php echo $hdmfAmt; ?>" required="true" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-4 col-lg-offset-8">
											<button type="submit" id="btnSave" name="btnSave" class="btn btn-primary btn-block pull-right">
												<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
											</button>
										</div>
									</div>
								</form>
							</div>

</body>
</html>