 <?php
    $pageTitle = "Attendance";
    include('function.php');
    include(loadHeader());

    #determine if the user is an HR
    #deny access if they are not
    $access = determineAccess();
    if(strcasecmp($access, "disabled") == 0)
    {
        header('location: index.php');
    }
    else
    {
        $msgDisplay = "";
        $msgSuccess = "<div class='alert alert-success alert-dismissable fade in'>
                        <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            Successfully uploaded the file!
                        </div>";
        $errDuplicate = "<div class='alert alert-danger alert-dismissable fade in'>
                        <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            The file contains one or more duplicate records!
                        </div>";
        $errUpload = "<div class='alert alert-success alert-dismissable fade in'>
                        <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            Something went wrong when uploading your file.
                        </div>";

        if(isset($_POST["Import"]))
        {
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain' );
            if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes))
            {
            
            $filename=$_FILES["file"]["tmp_name"]; 

            if (file_exists($filename)) {
                echo "The file $filename exists";
            } else {
                echo "The file $filename does not exist";
            }

          
             if($_FILES["file"]["size"] > 0)
             {
                $file1 = fopen($filename, "r");
                while (($getData1 = fgetcsv($file1, 10000, ",")) !== FALSE)
                {
                    $sql_tempAtt = "INSERT INTO temp_att (accountID,attendanceIn,attendanceOut,attendanceDate) 
                                    VALUES ('".$getData1[0]."','".$getData1[1]."','".$getData1[2]."','".$getData1[3]."')";
                    $stmt_tempAtt = sqlsrv_query($con, $sql_tempAtt);

/*                  if(!isset($stmt_tempAtt))
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"attendance.php\"
                              </script>";       
                    }
                    else {
                          echo "<script type=\"text/javascript\">
                            alert(\"CSV File has been successfully Imported.\");
                            window.location = \"attendance.php\"
                        </script>";
                    }
*/
                 }

                $sql_check = "SELECT COUNT(a.attendanceDate) AS 'dupCount' FROM attendances a 
                               INNER JOIN temp_att t ON a.attendanceDate = t.attendanceDate";
                $stmt_check = sqlsrv_query($con, $sql_check);

                while($rowC = sqlsrv_fetch_array($stmt_check))
                {
                    $dupCount = $rowC['dupCount'];
                }

                if($dupCount > 0)
                {
                    #one or more duplicate records exist.
                    #do not upload
                    $msgDisplay = $errDuplicate;
                    deleteTmp($con);
                }
                else
                {
                    #records are valid
                    $file = fopen($filename, "r");
                    while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                        $sql_attendance = "INSERT INTO attendances (accountID,attendanceIn,attendanceOut,attendanceDate) 
                                            VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
                        $stmt_attendance = sqlsrv_query($con, $sql_attendance);
                    }

                    if($stmt_attendance === false)
                    {
                        #display an error
                        $msgDisplay = $errUpload;
                        deleteTmp($con);
                    }
                    else
                    {
                        #display success
                        $msgDisplay = $msgSuccess;
                        deleteTmp($con);

                        logEvent($con, $accID, $txtEvent);
                        $txtEvent = "User uploaded a CSV file with the filename: " . $_FILES["file"]["name"] . ".";
                    }
                    fclose($file); 
                }
            }
        }
    }
}
?>