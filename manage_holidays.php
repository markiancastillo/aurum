<?php
include('controllers/manage_holidays_controller.php');
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
                            <h1 class="text-center">Manage Holidays</h1>
                            <br>
                            <form class="form-horizontal" method="POST">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Add holiday</label>
                                        <div class="col-xs-4">
                                            <input type="text" id="holidayName" name="holidayName" class="form-control" required="true" />
                                            

                                        </div>
                                        <label class="control-label col-lg-1">Date</label>
                                        <div class="col-xs-3">
                                            <input type="date" id="holidayDate" name="holidayDate" class="form-control" required="true" />
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="submit" id="btnAdd" name="btnAdd" class="btn btn-primary btn-block pull-right">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <br />
                               
                                <br />
                                <table id="listTable" name="listTable" class="table table-hover">
                                    <thead>
                                        
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Holiday</th>
                                        <th class="text-center">Date</th>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <?php
                                        if($rowCount <= 0)
                                        {
                                            echo "
                                            <tr>
                                            <td colspan='5' class='text-center'><h3>There are no holidays to display.</h3></td>
                                            </tr>
                                            ";
                                        }
                                        else 
                                        {
                                            echo $holiday;
                                        } 
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        
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