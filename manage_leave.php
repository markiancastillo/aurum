<?php
	include('controllers/manage_leave_controller.php');
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
                        <div class="col-lg-10 col-lg-offset-1">
                            <h1 class="text-center">Manage Leaves</h1>
                            <?php
							if(isset($_GET['update']))
							{
								echo "<div class='alert alert-success alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Successfully updated.
									</div>";
							}
							?>
                            <div class="form-group">
								<div class="input-group col-lg-8 col-lg-offset-2">
									<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
									<input type="text" name="keySearch" id="keySearch" class="form-control" placeholder="Enter a keyword...">
								</div>
							</div>
                            <form class="form-horizontal" method="POST">
                                <br /><br />
                                <table class="table table-hover">
                                    <thead>
                                        <th class="text-center">Account</th>
                                        <th class="text-center">Leave Type</th>
                                        <th class="text-center">Leaves Remaining</th>
                                    </thead>
                                    <tbody id="listTable" name="listTable">
                                        <tr>
                                        <?php
                                            echo $list_leave;
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