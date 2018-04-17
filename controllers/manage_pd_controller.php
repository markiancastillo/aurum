<?php
	$pageTitle = "Manage Positions & Departments";
	include('function.php');
	include(loadHeader());

	$posID = $_SESSION['posID'];

	if($posID == 1 || $posID == 6 || $posID == 8)
	{
		#grant access if user's position is either:
		#1 - managing partner
		#6 - executive assistant
		#8 - HR assistant
		
		$sql_pos = "SELECT positionName FROM positions";
		$stmt_pos = sqlsrv_query($con, $sql_pos);
	
		$list_pos = "";
		while($row = sqlsrv_fetch_array($stmt_pos))
		{
			$positionName = htmlspecialchars($row['positionName'], ENT_QUOTES, 'UTF-8');
	
			$list_pos .= "
				<tr>
					<td class='text-center'>$positionName</td>
				</tr>
			";
		}
	
		$sql_dept = "SELECT departmentName FROM departments";
		$stmt_dept = sqlsrv_query($con, $sql_dept);
	
		$list_dept = "";
		while($row = sqlsrv_fetch_array($stmt_dept))
		{
			$departmentName = htmlspecialchars($row['departmentName'], ENT_QUOTES, 'UTF-8');
	
			$list_dept .= "
				<tr>
					<td class='text-center'>$departmentName</td>
				</tr>
			";
		}
	
		$msgDisplay1 = "";
		$msgDisplay2 = "";
		$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Please submit a valid entry.
					</div>";
	
		if(isset($_POST['btnAddPos']))
		{
			#check that the input is valid
			$inpPosition = trim($_POST['inpPosition']);
	
			if($inpPosition != null || !empty($inpPosition))
			{
				#input is not null; insert into db
				$sql_ins = "INSERT INTO positions (positionName) VALUES (?)";
				$params_ins = array($inpPosition);
				$stmt_ins = sqlsrv_query($con, $sql_ins, $params_ins);

				$txtEvent = "Added a new position: " . $inpPosition . ".";
				logEvent($con, $accID, $txtEvent);
	
				header('location: manage_pd.php?pos=success');
			}
			else
			{
				#input is null; display an error
				$msgDisplay1 = $msgError;
			}
		}
	
		if(isset($_POST['btnAddDept']))
		{
			#check that the input is valid
			$inpDepartment = trim($_POST['inpDepartment']);
	
			if($inpDepartment != null || !empty($inpDepartment))
			{
				#input is not null; insert into db
				$sql_ins = "INSERT INTO departments (departmentName) VALUES (?)";
				$params_ins = array($inpDepartment);
				$stmt_ins = sqlsrv_query($con, $sql_ins, $params_ins);
		
				$txtEvent = "Added a new department: " . $inpDepartment . ".";
				logEvent($con, $accID, $txtEvent);

				header('location: manage_pd.php?dep=success');
			}
			else
			{
				#input is null; display an error
				$msgDisplay2 = $msgError;
			}
		}
	}
	else
	{
		header('location: index.php');
	}
?>