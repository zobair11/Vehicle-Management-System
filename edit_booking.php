<?php
include('inc/head.php');
$CustomFunction->userAdmin();
$page_id = "edit_booking";
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
                $b_id = (int) $_GET['id'];
                $customFunction = new customFunction();
                $connection = $database->connect;

                $allData = mysqli_query($connection, "SELECT * FROM bookings WHERE id='$b_id'");
                $fetchAllData = mysqli_fetch_array($allData);

                $destination = $customFunction->inputvalid($fetchAllData['destination']);
                $carNumber = $customFunction->inputvalid($fetchAllData['car_number']);
                $bookingTime = $customFunction->inputvalid($fetchAllData['booking_time']);
                $returnTime = $customFunction->inputvalid($fetchAllData['return_time']);
                $pickupFrom = $customFunction->inputvalid($fetchAllData['pickup']);
                $passengers = $customFunction->inputvalid($fetchAllData['passenger']);
                $type = $customFunction->inputvalid($fetchAllData['job_type']);

                if (isset($_POST['submit']) && $_POST['submit'] == 'Edit Book') {

                    $new_destination = $customFunction->inputvalid($_POST['destination']);
                    $new_carNumber = $customFunction->inputvalid($_POST['carnumber']);
                    $new_bookingTime = $customFunction->inputvalid($_POST['booktime']);
                    $new_returnTime = $customFunction->inputvalid($_POST['returntime']);
                    $new_pickupFrom = $customFunction->inputvalid($_POST['location']);
                    $new_passengers = $customFunction->inputvalid($_POST['passengers']);
                    $new_type = $customFunction->inputvalid($_POST['type']);



                    $errors = array();

                    $query = mysqli_query($connection, "SELECT id FROM bookings WHERE id = '$b_id' ");
                    $num_row = mysqli_num_rows($query);
                    $check = mysqli_query($connection, "SELECT * FROM bookings WHERE car_number='$new_carNumber' AND 
                            ((booking_time BETWEEN '$new_bookingTime' and '$new_returnTime') OR 
                            (return_time BETWEEN '$new_bookingTime' and '$new_returnTime')) ");

                    $num_rows_al = $customFunction->numRows($check);

                    if (isset($new_bookingTime, $new_returnTime, $new_passengers)) {

                        if (empty($new_bookingTime)) {
                            $errors[] = 'Enter your booking time';
                        }
                        if ($num_rows_al > 0) {
                            $errors[] = 'Already reserved';
                        }

                        if (empty($new_returnTime)) {
                            $errors[] = 'Enter your return time';
                        }

                        if (empty($new_passengers)) {
                            $errors[] = 'Enter number of passengers';
                        } elseif ($new_passengers < 1 || $new_passengers > 5) {
                            $errors[] = 'Please enter passengers between 1 to 5';
                        }

                        if (!empty($errors)) {
                            echo "<div class='alert alert-danger'>";
                            foreach ($errors as $error) {
                                echo $error;
                                echo '<br/>';
                            }
                            echo '</div>';
                        } else {


                            $column_name = array('car_number', 'destination', 'pickup', 'booking_time', 'return_time', 'passenger', 'job_type');


                            $column_value = array($new_carNumber, $new_destination, $new_pickupFrom, $new_bookingTime, $new_returnTime, $new_passengers, $new_type);



                            $query = $customFunction->updateData('bookings', $column_name, $column_value, 'id', $b_id);

                            if ($query) {

                                echo "<div class='alert alert-success'>Booking updated</div>";
                                $customFunction->redirect('manage_booking.php', 3);
                            } else {
                                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                echo mysqli_error($connection);
                            }
                        }
                    }
                }
                ?>
                <form role="form" class="shake" class="contact-form" data-toggle="validator" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$b_id"; ?>" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 style="color:#af4a13;">Edit Booking</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Destination</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="destination">
                                            <option  disabled=""> Select Destination</option>


                                            <?php
                                            $connection = $database->connect;


                                            $location = mysqli_query($connection, "SELECT locations FROM locations");
                                            while ($row = mysqli_fetch_array($location)) {
                                                if ($row['locations']==$destination) {
                                                    //echo $destination;
                                                   echo '<option selected="" value='. $row['locations'] . '>' . $row['locations']. ' </option>';
                                                }
                                                else{
                                                   echo "<option value=" . $row['locations'] . ">" . $row['locations'] . "</option>";
                                               }
                                                
                                            }
                                            ?>      
                                        </select>

                                    </div>
                            </div>




                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Car number</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="carnumber">
                                <option disabled="" selected="">Select Car</option>

                                    <?php
                                    

                                    $connection = $database->connect;


                                    $cars = mysqli_query($connection, "SELECT car_number FROM cars");
                                    while ($row = mysqli_fetch_array($cars)) {
                                        if ($row['car_number']== $carNumber) {
                                           echo '<option selected="" value=' . $row['car_number'] . '>' . $row['car_number'] . '</option>';
                                        }
                                        echo "<option value=" . $row['car_number'] . ">" . $row['car_number'] . "</option>";
                                    }
                                    ?>      
                            </select>

                        </div>
                    </div>

                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Booking Time</label>
                        <div class="col-sm-6">
                            <input id="bookingtime" value="<?php echo $bookingTime; ?>" type="text" readonly="true" class="form-control" name="bookingtime">

                        </div>
                    </div>


                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Return Time</label>
                        <div class="col-sm-6">
                            <input  id="returntime" value="<?php echo $returnTime; ?>" type="text" readonly="true" class="form-control" name="returntime">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Pickup Location</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="pickup">
                                <option disabled="" selected="">Select Pick Up Location</option>


                                    <?php
                                   


                                    $connection = $database->connect;


                                    $location = mysqli_query($connection, "SELECT locations FROM locations");
                                    while ($row = mysqli_fetch_array($location)) {
                                        if ($row['locations']==$pickupFrom) {
                                                    //echo $destination;
                                                   echo '<option selected="" value='. $row['locations'] . '>' . $row['locations']. ' </option>';
                                                }
                                                else{
                                                   echo "<option value=" . $row['locations'] . ">" . $row['locations'] . "</option>";
                                               }
                                    }
                                    ?>      
                            </select>

                        </div>
                    </div>

                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Number of passengers</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="passengers" value="<?php echo $passengers ?>"">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Booking Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="type">
                                <option disabled="" selected="">Select Type</option>
                                <option value="Self">Self</option>
                                <option value="General">General</option>

                            </select>
                        </div>
                    </div>
                </div>



                    <div class="panel-footer" >
                        
                            <input type="submit" name="submit" value="Edit Book" class="btn btn-success btn-block">

                        </div>
                    </div>
                </div>
            </form> 
        </div>               
    </div>           
</div> 

<?php include('inc/footer.php'); ?>
<?php include('inc/end.php'); ?>

