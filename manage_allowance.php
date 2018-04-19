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
					<h1 class="text-center">Manage Allowance</h1>
					<br />
					<div class="form-group">
						<div class="input-group col-lg-8 col-lg-offset-2">
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
							<input type="text" name="keySearch" id="keySearch" class="form-control" placeholder="Enter a keyword...">
						</div>
					</div>
					<div class="col-lg-10 col-lg-offset-1">
					<?php
						if(isset($_GET['update']))
						{
							echo "<div class='alert alert-success alert-dismissable fade in'>
								<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Successfully updated the allowance value/s.
								</div>
							";
						}
					?>
					</div>
					<br>
					<table class="table table-hover">
						<thead>
							<th class="text-center">Employee</th>
							<th class="text-center">Mobile Allowance</th>
							<th class="text-center">Medical Allowance</th>
							<th class="text-center">ECOLA</th>
						</thead>
						<tbody id="listTable" name="listTable">
							<tr>
								<?php
									echo $all_list;
								?>
							</tr>
						</tbody>
					</table>

<script>
$(document).ready(function(){
	$("#keySearch").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#listTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
</script>
</body>
</html>