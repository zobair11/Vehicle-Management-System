<?php
include('inc/head.php');
$page_id = "manage_booking";
include('inc/navigation.php');
$customFunction->userAdmin();
?>

<div id="warp">
    <div id="wrapper">

        <div id="page-wrapper">

            <div class="row">
                
                <div class="col-md-12" >

                    <section>
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12">

                                    <?php
                                    $connection = $database->connect;
                                    //checking from session
                                    if (isset($_SESSION['logged_user_normal'])) {
                                        $u_id = $_SESSION['logged_user_normal'];
                                    } elseif(isset($_SESSION['logged_user_admin']))  {
                                        $u_id = $_SESSION['logged_user_admin'];
                                    }

                                    //checking from cookie

                                    elseif (isset($_COOKIE['logged_user_normal'])) {
                                        $u_id = $_COOKIE['logged_user_normal'];
                                    } elseif(isset($_COOKIE['logged_user_admin']))  {
                                        $u_id = $_COOKIE['logged_user_admin'];
                                    }
                                    //echo $u_id;


                                    $allData = mysqli_query($connection, "SELECT * FROM bookings WHERE  user_id ='$u_id' AND is_cancelled = '0' ");
                                    $num_rows = $customFunction->numRows($allData);
                                     if($num_rows>0){ ?>
                                         <h3>Your Bookings (<?php echo $num_rows; ?>)</h3>

                                    <?php }
                                     else{ ?>
                                       <h3><div class="alert alert-info">You have no bookings yet</div></h3> 
                                    
                                    <?php }
                                    ?>

                                    

                                    <?php
                                    for ($i = 1; $i <= $num_rows; $i++) {

                                        while ($bookings = mysqli_fetch_array($allData)) {
                                            $rowID = $bookings['id'];
                                            $car_no = $bookings['car_number'];
                                            $job_number = $bookings['job_number'];
                                            $destination = $bookings['destination'];
                                            $pickup = $bookings['pickup'];
                                            $bookingTime = $bookings['booking_time'];
                                            $returnTime = $bookings['return_time'];
                                            $passengers = $bookings['passenger'];
                                            $type = $bookings['job_type'];
                                            ?>
                                            <!-- For each loop start. Booking will be loaded based on status if it's = 0 -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 style="color:#af4a13;">

                                                        <?php
                                                        echo $destination . '&nbsp|&nbsp';
                                                        $bookingtime2 = strtotime($bookingTime);
                                                        echo date("jS F Y , H:i", $bookingtime2);
                                                        ?>

                                                    </h4>
                                                </div>
                                                <div class="panel-body">

                                                    <table class="table table-striped table-dark" width="100" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <th style="min-width: 100px;" scope="row">Booking ID:</th>
                                                                <td style="min-width: 200px;"><?php echo $job_number; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="min-width: 100px;" scope="row">Booked Car:</th>
                                                                <td style="min-width: 200px;"><?php echo $car_no; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="min-width: 100px;" scope="row">Destination:</th>
                                                                <td style="min-width: 200px;"><?php echo $destination; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="min-width: 100px;" scope="row">Pick-Up From</th>
                                                                <td style="min-width: 200px;"><?php echo $pickup; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                
                                                <div class="panel-footer">
                                                    <?php echo "<a class='btn btn-primary btn-md' href='booking.php?id=$rowID'>Edit</a> &nbsp <a class='btn btn-primary btn-md' href='delete_booking.php?id=$rowID'>Cancel Booking</a>"; ?>
                                                </div>
                                                
                                            </div>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                    ?>

                                    <!-- For each loop end-->

                                </div>

                            </div>
                            
                        </div>
                </div>

            </div>               
        </div>      
    </div> 
</div>

<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>
