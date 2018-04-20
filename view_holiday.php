<?php
	include('controllers/view_holiday_controller.php');
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
                <div class="form-panel">
                    <fieldset>
					<h1 class="text-center">Edit Holiday</h1>
					<br />
					<?php
						if(isset($_GET['update']))
						{
							echo "<div class='alert alert-success alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Successfully updated.
								</div>";
						}
					?>
					<div class="col-lg-8 col-lg-offset-2">
						<form class="form-horizontal" method="POST">
							<div class="form-group">	
								<label class="control-label col-lg-4">Holiday Name</label>
								<div class="col-lg-8">
									<input type="text" id="inpName" name="inpName" class="form-control" value="<?php echo $holidayName; ?>"/>
								</div>
							</div>
							<div class="form-group">	
								<label class="control-label col-lg-4">Date</label>
								<div class="col-lg-8">
									<input type="date" id="inpDate" name="inpDate" class="form-control" min="2018-01-01" value="<?php echo date('dd/mm/YYYY',strtotime($row['holidayDate'])) ?>"/>
								</div>
							</div>
							<div class="form-group">	
								<label class="control-label col-lg-4">Rate</label>
								<div class="col-lg-8">
									<input type="number" id="inpRate" name="inpRate" class="form-control" min="0.1" step=".01" required="true" value="<?php echo $holidayRate; ?>"/>
								</div>
							</div>
							<div class="col-lg-4">
								<a href='manage_holidays.php' class="btn btn-block btn-default">
									<span class="glyphicon glyphicon-chevron-left"></span> Back to List
								</a>
							</div>
							<div class="col-lg-4 col-lg-offset-4">
								<button class="btn btn-block btn-success" id="btnSave" name="btnSave">
									<span class='glyphicon glyphicon-ok'></span> Save Changes
								</button>
							</div>
						</form>
					</div>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>