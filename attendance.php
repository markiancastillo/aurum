<?php
  include('controllers/attendance_controller.php');

?>
<!DOCTYPE html>
<head>
</head>
<body>
 <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                    
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Upload Attendance</legend>
                        <form class="form-horizontal" method="post" name="upload_csv" enctype="multipart/form-data">
 
                        <!-- File Button -->
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
 
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                     </form>
                    </fieldset>
                   </div>
                </div>
            </div>
        </section>
    </section>
</body>
</html>