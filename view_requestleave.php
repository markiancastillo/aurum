<?php
	include('controllers/view_requestleave_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="form-panel">
			<div class="container">
				<div class="row">
			<h1 class="text-center">Request Leave #<?php echo $_REQUEST['id']; ?> Details</h1>
			<br />
			<div class="col-lg-5 col-lg-offset-1">
				<form class="form-horizontal">
					<div class="form-group">	
						<label class="control-label col-lg-4">Leave File Date</label>
						<div class="col-lg-8">
							<?php echo $leaveFileDate; ?>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Requestor</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $displayName; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Duration</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveFrom . ' to ' . $leaveTo; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Type of Leave</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $ltypeName; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Remaining Leaves</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $lcDisplay; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Reason</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveReason; ?></p>
						</div>
					</div>
				</form>
			</div>
			<form class="col-lg-12" method="POST">
				<div class="col-lg-12">
					<div class="col-lg-6">
						<div class="col-lg-5">
							<a href='requestto_admin.php' class="btn btn-block btn-default">
								<span class="glyphicon glyphicon-chevron-left"></span> 
					 			 Back to List
							</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="col-lg-7">
							<button class="btn btn-block btn-success" id="btnApprove" name="btnApprove" onclick="return confirm('Confirm approval of leave request #<?php echo $_REQUEST['id']; ?>?');">
								<span class='glyphicon glyphicon-ok'></span> Approve</button>
							</button>
						</div>
						<div class="col-lg-5">
							<button class="btn btn-block btn-danger" data-toggle="modal" data-target="#disapproveModal">
												<span class='glyphicon glyphicon-remove'></span> Disapprove
											</button>
							<div id="disapproveModal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Disapprove Request</h4>
												</div>
												<form class="form-horizontal" method="POST" role="form">
													<div class="modal-body">
														<div class="form-group">	
															<label class="control-label col-lg-3">Disapproval Note</label>
															<div class="col-lg-9">
																<textarea class="form-control" rows="3" id="inpNote" name="inpNote" placeholder="Reason for disapproval" required="true"></textarea>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-danger" id="btnDeny" name="btnDeny">
															<span class='glyphicon glyphicon-remove'></span> Disapprove
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>	
						</div>
					</div>
				</div>	
			</form>
		</div>
	</section>
</section>
</body>
</html>