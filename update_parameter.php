<?php
include('inc/head.php');
$CustomFunction->isLoginAdmin();
$page_id= "settings";
include('inc/navigation.php');
?>
<div id="wrap">
<div id="wrapper">


    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="txtHint"></div>
                                        <div class="alert alert-danger display-error" style="display: none">
                                        </div>

                                        <?php 
                                         $connection = $database->connect;
                                         //fetching data from settings table
                                         $data = mysqli_query($connection, "SELECT * FROM settings ");
                                         $fetchData = mysqli_fetch_array($data);
                                         $maxBookingNo = $customFunction->inputvalid($fetchData['max_booking_no']);
                                         $daysLimits = $customFunction->inputvalid($fetchData['days_limits']);
                                         $minutes_steps = $customFunction->inputvalid($fetchData['minutes_steps']);
                                       

                                        if (isset($_POST['submit']) && $_POST['submit'] == 'Update'){
                                            $new_maxBookingNo = $customFunction->inputvalid($_POST['maxBook']);
                                            $new_daysLimits = $customFunction->inputvalid($_POST['limit']);
                                            $new_minutes_steps = $customFunction->inputvalid($_POST['step']);
                                            
                                             $errors = array();
                                         

                                            if (isset($new_maxBookingNo, $new_daysLimits, $new_minutes_steps)){
                                                if (empty($new_maxBookingNo)) {
                                                    $errors[] = 'Enter Maximum Furure Booking';
                                                }
                                                if (empty($new_daysLimits)) {
                                                    $errors[] = 'Enter New Day Limit';
                                                }
                                                if (empty($new_minutes_steps)) {
                                                    $errors[] = 'Enter Minute Steps for calender control';
                                                }


                                                if (!empty($errors)) {
                                                    echo "<div class='alert alert-danger'>";
                                                    foreach ($errors as $error) {
                                                    echo $error;
                                                    echo '<br/>';
                                                }
                                                echo '</div>';
                                        }
                                        else{
                                            echo "<div class='alert alert-success'>Parameter updated</div>";
 
                                          mysqli_query($connection,  "UPDATE settings SET max_booking_no= '$new_maxBookingNo', days_limits='$new_daysLimits', minutes_steps = '$new_minutes_steps' WHERE id='1' "); 

                                           $customFunction->redirect('user_settings.php', 3);                  
                                    
                                }
                            }
                                           
                        }
                                             ?>  
             
                
                <div class="panel-body">
                <form role="form" class="contact-form" data-toggle="validator" class="shake" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h4 style="color:#af4a13;">Update parameter</h4>
                            </div>
                            <div class="panel-body">

                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Max Booking Number</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  value="<?php echo $maxBookingNo; ?>" name="maxBook">
                                </div>
                            </div>

                              <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Steps</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" max="60" min="1" value="<?php echo $minutes_steps; ?>" name="step">
                                </div>
                            </div>


                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Day Limit</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" value="<?php echo $daysLimits; ?>" name="limit">
                                </div>
                            </div>

                            

                    <div class="panel-footer" >           
                            <input type="submit" name="submit" value="Update" class="btn btn-success btn-block">

                    </div>
                </div>
            </form> 
        </div>               
    </div>           
</div> 


<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>

