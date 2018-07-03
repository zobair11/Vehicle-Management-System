<?php
include('inc/head.php');
$customFunction->userAdmin();
include('inc/navigation.php');
$page_id = "booking";

//getting max future booking
//$connection = $database->connect;
//$sql = mysqli_query($connection, "SELECT max_booking_no FROM settings ");
//$data = mysqli_fetch_array($sql);
//$max = $customFunction->inputvalid($data['max_booking_no']);
if (isset($user_id_normal)) {
    $u_id = $user_id_normal;
} else {
    $u_id = $user_id_admin;
}
//echo $u_id;
//checking future bookings

$sql2 = mysqli_query($connection, "SELECT user_id FROM bookings WHERE user_id='$u_id' AND job_status IS NULL AND is_cancelled = '0' ");
$num_rows = $customFunction->numRows($sql2);

if ($num_rows == $max_booking_no && (empty($_GET['id']))) {
    ?>
    <h3><div class="alert alert-info">You have already <?php echo $max_booking_no; ?> future bookings.</div></h3>
    <?php
} else {
    ?>

    <div id="warp">
        <div id="wrapper">

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-md-12" 
                         >

                        <section>
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-12">

                                        <form role="form" id="contactForm" class="contact-form" data-toggle="validator" class="shake">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 style="color:#af4a13;">Book Your Car</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                    if (!empty($_GET['id'])) {
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
                                                        $job_type = $customFunction->inputvalid($fetchAllData['job_type']);
                                                    }
                                                    ?>


                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Destination</label>
                                                        <div class="col-sm-6">

                                                            <select class="form-control" id="destination" name="destination">
                                                                <option disabled="" selected="" value="">Select Destination</option>
                                                                <?php
                                                                $location = mysqli_query($connection, "SELECT locations FROM locations");
                                                                if (empty($_GET['id'])) {
                                                                    while ($row = mysqli_fetch_array($location)) {
                                                                        echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                    }
                                                                } else {
                                                                    while ($row = mysqli_fetch_array($location)) {
                                                                        if ($row['locations'] == $destination) {
                                                                            //echo $destination;
                                                                            echo "<option selected='' value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                        } else {
                                                                            echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                        }
                                                                    }
                                                                }
                                                                ?>    
                                                                <!-- This is for other destination -->  
                                                                <option id="other_destination" value="other">Others</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div id="other_destination_div" class="form-group" style="padding: 2% ; display: none;" >
                                                        <label class="col-sm-3 control-label">Custom Destination</label>
                                                        <div class="col-sm-6">
                                                            <input value="" type="text"  class="form-control" name="input_other_destination" id="input_other_destination">
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Car number</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" id="carnumber" name="carnumber">
                                                                <option disabled="" selected="" value="">Select Car</option>

                                                                <?php
                                                                $cars = mysqli_query($connection, "SELECT car_number FROM cars where status = 1");
                                                                if (empty($_GET['id'])) {
                                                                    //Load cars which's status is 1 means active  
                                                                    while ($row = mysqli_fetch_array($cars)) {

                                                                        echo "<option value=\"{$row['car_number']}\">" . $row['car_number'] . " </option>";
                                                                    }
                                                                } else {
                                                                    while ($row = mysqli_fetch_array($cars)) {
                                                                        if ($row['car_number'] == $carNumber) {
                                                                            echo "<option selected='' value=\"{$row['car_number']}\">" . $row['car_number'] . " </option>";
                                                                        } else
                                                                            echo "<option value=\"{$row['car_number']}\">" . $row['car_number'] . " </option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                    </div>

<!--                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Need a Driver?</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                            <div class="btn-group radio-group">
                               <label class="btn btn-primary">Yes, Please. <input type="radio" value="Driver" name="job_type"></label>
                               <label class="btn btn-primary not-active">Self Drive.<input type="radio" value="Self Drive" name="job_type"></label>
                            </div>
                         </div>
                                            
                                                        </div>
                                                    </div>-->


                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Booking Time</label>
                                                        <div class="col-sm-6">
                                                            <input id="bookingtime" value="<?php
                                                            if (!empty($_GET['id'])) {
                                                                echo $bookingTime;
                                                            }
                                                            ?>" type="text" readonly="true" class="form-control" name="bookingtime">
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Return Time</label>
                                                        <div class="col-sm-6">
                                                            <input  id="returntime"  value="<?php
                                                            if (!empty($_GET['id'])) {
                                                                echo $returnTime;
                                                            }
                                                            ?>" type="text" readonly="true" class="form-control" name="returnTime">
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="padding: 2%">
                                                        <label class="col-sm-3 control-label">Pickup Location</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" id="pickup" name="pickup">
                                                                <option disabled="" selected="" value="">Select PickUp Location</option>


                                                                <?php
                                                                $location = mysqli_query($connection, "SELECT locations FROM locations");
                                                                if (empty($_GET['id'])) {
                                                                    while ($row = mysqli_fetch_array($location)) {

                                                                        echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                    }
                                                                } else {
                                                                    while ($row = mysqli_fetch_array($location)) {
                                                                        if ($row['locations'] == $pickupFrom) {
                                                                            //echo $destination;

                                                                            echo "<option selected='' value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                        } else {
                                                                            echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                                                        }
                                                                    }
                                                                }
                                                                ?> 
                                                                <!-- This is for other pickups -->


                                                                <option value="other">Others</option>

                                                            </select>


                                                        </div>
                                                    </div>

                                                    <!-- Custom Pickup Location -->

                                                    <div id="other_pickup_div" class="form-group" style="padding: 2% ; display: none;" >
                                                        <label class="col-sm-3 control-label">Custom Pickup</label>
                                                        <div class="col-sm-6">
                                                            <input value="" type="text"  class="form-control" name="input_other_pickup" id="input_other_pickup">
                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="panel-footer">

                                                    <!-- send a identifier value to form submission for if else condition -->

                                                    <input id="isupdate" hidden="" value="<?php
                                                    if (empty($_GET['id'])) {
                                                        echo "1";
                                                    } else {
                                                        echo "2";
                                                    }
                                                    ?>">

                                                    <!-- Send a row id of respective bookings -->
                                                    <input id="rowID" hidden="" value="<?php echo $_GET['id']; ?>">

                                                    <button type="submit" id="submit" class="btn3d btn btn-primary btn-lg btn-block d-block"><i class="fa fa-check"></i>
                                                        <?php if (empty($_GET['id'])) { ?> Submit <?php } else { ?> Update <?php } ?>
                                                    </button>
                                                </div>

                                            </div>
                                            <?php // } 
                                            ?>

                                            <!--<div class="form-group" style="padding: 2%">
                                                <label class="col-sm-3 control-label">Booking Type</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="type">
                                                        <option disabled="" selected="">Select Booking Type</option>
                                                        <option value="Self">Self</option>
                                                        <option value="General">General</option>
                                    
                                                    </select>
                                                </div>
                                            </div>-->

                                            <!--<div class="form-group" style="padding: 2%">
                                                <label class="col-sm-3 control-label">Number of passengers</label>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" class="col-sm-12" name="passengers">
                                                </div>
                                            </div>-->

                                        </form>
                                            
                                        <!-- Show validation error msg.-->
                                        <div id="txtHint"></div>
                                        <div class="alert alert-danger display-error" style="display: none"></div>

                                    </div>

                                </div>

                            </div>
                    </div>

                </div>               
            </div>      
        </div> 
    </div>

<?php } ?>

<script type="text/javascript">

    $("#pickup").change(function () {
        if ($("#pickup").val() == 'other')
            $("#other_pickup_div").show();
        else
            $("#other_pickup_div").hide();
    });


    $("#destination").change(function () {
        if ($("#destination").val() == 'other')
            $("#other_destination_div").show();
        else
            $("#other_destination_div").hide();
    });

</script>

<?php include('ajax/ajax_check_availability.php'); ?>

<?php //include('inc/footer.php');  ?>
<?php include('inc/end.php'); ?>