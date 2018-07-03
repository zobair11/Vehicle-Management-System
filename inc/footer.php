</div><!-- END OF WRAPPER. DON'T DELETE-->
<footer>
    <div id="footer">
        <div style="max-width: 90%" class="container">
            <div class="row">

                <?php
                if ($page_id === 'driver') {
                    
                } elseif ($page_id === 'booking') {
                    
                } elseif ($page_id === 'success') {
                    
                } else {
                    echo '<button style="margin: 10px 0 5px;" id="example" type="button" class="btn btn-warning btn-lg btn-block d-block" data-container="body" data-toggle="popover" data-placement="top">
                Pick Me Now!
            </button>';
                }
                ?>
            </div>
            <div id="content">
                <div style="min-width: 200px;">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="post">
                        <div class="form-group">
                            <label for="email">Destination:</label>
                            <select class="form-control" name="destination" id="destination">

                                <?php
                                $location = mysqli_query($connection, "SELECT locations FROM locations");
                                while ($row = mysqli_fetch_array($location)) {

                                    echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                }
                                ?>      
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Pick Me From</label>

                        </div>
                        <div class="checkbox">
                            <select class="form-control" id="pickmefrom" name="pickmefrom">

                                <?php
                                $location = mysqli_query($connection, "SELECT locations FROM locations");
                                while ($row = mysqli_fetch_array($location)) {

                                    echo "<option value=\"{$row['locations']}\">" . $row['locations'] . " </option>";
                                }
                                ?>      
                            </select>
                        </div>
                        <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block d-block">Submit</button>

                        <input type="button" onclick="hide()" type="submit" name="cancel" value="Cancel" id="hiding" class="btn btn-danger btn-lg btn-block d-block">

                        <?php
                        include_once('initial.php');
                        $connection = $database->connect;

                        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
                            $u_id = $_SESSION['logged_user_normal'];
                            $destination = $_POST['destination'];
                            $pickup = $_POST['pickmefrom'];
                            $today = date("Y-m-d H:i:s");
                            $job_number = $destination[0] . rand(100, 999);
                            //$allData= mysqli_query($connection, "SELECT user_name FROM user_info WHERE '$u_id'=user_id");
                            //$user_name = mysqli_fetch_array($allData);

                            mysqli_query($connection, "INSERT INTO bookings (user_id, job_number, destination,pickup,booking_time,job_type) VALUES('$u_id','$job_number','$destination','$pickup','$today','shuttle')");
                            //echo '<strong>Successfully Booked</strong>';

// Submit new job notification
                            $speech = "A New Job Has Been Submitted for Shuttle. by" . $username . "." . " " . "Destination is:" . $destination . "." . " " . "Please pick the client from:" . $pickup . "." . " " . "Thank You!";
                            mysqli_query($connection, "INSERT INTO notifications (job_number, status, timestamp) VALUES('$speech', '0', now())");

                            $CustomFunction->redirect('success.php');
                        }
                        ?>


                    </form>
                </div>
            </div>
        </div>
    </div
</footer>




