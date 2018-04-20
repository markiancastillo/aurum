<?php
	include('controllers/view_leave_controller.php');
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
					<h1 class="text-center">Edit Leave Values</h1>
					<br />
					<div class="col-lg-8 col-lg-offset-2">
						<form class="form-horizontal" method="POST">
							<div class="form-group">	
								<label class="control-label col-lg-4" style="display: none">Record ID</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" value="<?php echo $lcID; ?>" disabled="true" style="display: none"/>
								</div>
							</div>
							<div class="form-group">	
								<label class="control-label col-lg-4">Account</label>
								<div class="col-lg-8">
									<input type="text" id="inpName" name="inpName" class="form-control" value="<?php echo $accountName; ?>" disabled="true"/>
								</div>
							</div>
							<div class="form-group">	
								<label class="control-label col-lg-4">Leave Count</label>
								<div class="col-lg-8">
									<input type="number" id="inpAmount" name="inpAmount" class="form-control" min="0" max="50" step="1" value="<?php echo $lcAmount; ?>"/>
								</div>
							</div>
							<div class="form-group">	
								<label class="control-label col-lg-4">Leave Type</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" value="<?php echo $ltypeName; ?>" disabled="true"/>
								</div>
							</div>
							<div class="col-lg-4">
								<a href='manage_leave.php' class="btn btn-block btn-default">
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
</body>
</html>