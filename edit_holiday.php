<?php
	include('controllers/edit_holiday_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
	<section class="wrapper">  
		<div class="row">
			<h1 class="text-center">Edit Holiday</h1>
			<hr />
			<div class="col-lg-12">
				<form class="form-horizontal">
					<div class="form-group">	
						<label class="control-label col-lg-4">Holiday Name</label>
						<div class="col-lg-3">
							<input type="text" id="updatedholidayName" name="updatedholidayName" class="form-control" required="true" value="<?php echo $holidayName; ?>"/>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Holiday Date</label>
						<div class="col-lg-3">
							<input type="date" id="updatedholidayDate" name="updatedholidayDate" class="form-control" required="true" value="<?php echo $holidayDate; ?>"/>
						</div>
					
				</form>
			</div>
			<form class="col-lg-12" method="POST">
				<div class="col-lg-12">
					<div class="col-lg-6">
						<div class="col-lg-5">
							<a href='manage_holidays.php' class="btn btn-block btn-default">
								<span class="glyphicon glyphicon-chevron-left"></span> 
					 			 Back to List
							</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="col-lg-7">
							<button class="btn btn-block btn-success" id="btnUpdate" name="btnUpdate" onclick="return confirm('Confirm update of holiday?')">
								<span class='glyphicon glyphicon-ok'></span> Update</button>
							</button>
						</div>
						
					</div>
				</div>	
			</form>
		</div>
	</section>
</section>
</body>
</html>