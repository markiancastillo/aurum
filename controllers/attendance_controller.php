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
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                 {
                   $sql_getAttendance = "INSERT INTO attendances (accountID,attendanceIn,attendanceOut,attendanceDate) 
                       values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
                       $stmt_getAttendance = sqlsrv_query($con, $sql_getAttendance);
                    if(!isset($stmt_getAttendance))
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
                 }
                $txtEvent = "User uploaded a CSV file with the filename: " . $_FILES["file"]["name"] . ".";
                logEvent($con, $accID, $txtEvent);
                 fclose($file); 
             }
        }
    }


   ?>


