<?php
	include('controllers/view_record_controller.php');
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
							<h1 class="text-center">Record Details</h1>
							<br><br>
							
							<form class="form-horizontal col-lg-8 col-lg-offset-2" method="POST" enctype="multipart/form-data">
								<div class="form-group">				
									<label class="control-label col-lg-3">Service Type ID</label>
									<div class="col-lg-8">
										<input type="text" id="stID" name="stID" class="form-control" disabled= "true" value="<?php echo $stypeID; ?>">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">Start Date</label>
									<div class="col-lg-8">
										<input type="date" id="sDate" name="sDate" class="form-control" value="<?php echo $sDate; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">End Date</label>
									<div class="col-lg-8">
										<input type="date" id="eDate" name="eDate" class="form-control" value="<?php echo $eDate; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">Start Time</label>
									<div class="col-lg-8">
										<input type="time" id="sTime" name="sTime" class="form-control" value="<?php echo $sTime; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">End Time</label>
									<div class="col-lg-8">
										<input type="time" id="eTime" name="eTime" class="form-control" value="<?php echo $sTime; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-3">
										<a href="list_record.php" class="btn btn-default btn-block">
											<span class="glyphicon glyphicon-chevron-left"></span>
											 Back
										</a>
									</div>
									<div class="col-lg-4 col-lg-offset-4">
										<button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary btn-block pull-right">Update</button>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>