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
                            <form class="form-horizontal" method="POST">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#addHolModal">
                                        <span class='glyphicon glyphicon-plus'></span> Add New
                                    </button>
                                </div>
                                <br /><br />
                                <table id="listTable" name="listTable" class="table table-hover">
                                    <thead>
                                        <th class="text-center">Holiday</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Bonus Rate</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php
                                        if($rowCount == 0)
                                        {
                                            echo "
                                            <tr>
                                                <td colspan='3' class='text-center'><h3>There are no records to display.</h3></td>
                                            </tr>
                                            ";
                                        }
                                        else 
                                        {
                                            echo $list_holiday;
                                        } 
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
<!-- for adding new records -->
                        <div id="addHolModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add a New Holiday</h4>
                                    </div>
                                    <form class="form-horizontal" method="POST" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3">Name of Holiday</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="holidayName" name="holidayName" class="form-control" maxlength="50" required="true" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3">Date</label>
                                                <div class="col-lg-9">
                                                    <input type="date" id="holidayDate" name="holidayDate" class="form-control" required="true" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3">Holiday Rate</label>
                                                <div class="col-lg-9">
                                                    <input type="number" id="holidayRate" name="holidayRate" class="form-control" min="0.1" step=".01" value="1" required="true" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" id="btnAddHol" name="btnAddHol">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
</body>
</html>