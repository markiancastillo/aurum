 <?php
    $pageTitle = "Attendance";
    include('function.php');
    include(loadHeader());

   if(isset($_POST["Import"])){

        echo $filename=$_FILES["file"]["tmp_name"];
         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");
             while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
             {

               $sql_insertAttendance = "INSERT INTO attendances ('accountID','attendanceIn','attendanceOut','attendanceDate') 
                    values('$getData[0]','$getData[1]','$getData[2]','$getData[3]')";
                var_dump($sql_insertAttendance);
                    exit();
            
               $result = sqlsrv_query($con, $sql_insertAttendance);
                if(!$result )
                {
                    echo "<script type=\"text/javascript\">
                            alert(\"Invalid File:Please Upload CSV File.\");
                            window.location = \"attendance.php\"
                        </script>";     
                }

             }
             fclose($file);
           
             echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"index.php\"
                    </script>"; 
            
         }
    }

    function get_all_records($con){
   

    $sql_getAttendance = "SELECT accountID, attendanceIn, attendanceOut, attendanceDate FROM attendances";
    $stmt_getAttendance = sqlsrv_query($con, $sql_getAttendance);
    if (sqlsrv_num_rows($stmt_getAttendance) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
     <thead>
     <tr>
                        <th>Account ID</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Date</th>
                        </tr></thead><tbody>";

     while($row = sqlsrv_fetch_array($stmt_getAttendance)) {


         echo "<tr><td>" . $row['accountID']."</td>
                   <td>" . $row['attendanceIn']."</td>
                   <td>" . $row['attendanceOut']."</td>
                   <td>" . $row['attendanceDate']."</td></tr>";
         
     }
  
     echo "</tbody></table></div>";
     
    } else {
         echo "you have no records";
    }
}
?>
