 <?php
    $pageTitle = "Attendance";
    include('function.php');
    include(loadHeader());


    if(isset($_POST["Import"])){


            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain' );
            if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes))
            {
            
            $filename=$_FILES["file"]["tmp_name"];      
             if($_FILES["file"]["size"] > 0)
             {
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                 {
                   $sql_getAttendance = "INSERT into attendance (accountID,attendanceIn,attendanceOut,attendanceDate) 
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
                
                 fclose($file); 
             }
        }
    }


   ?>


