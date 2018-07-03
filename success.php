<?php include('inc/head.php');
$CustomFunction->userAdmin();
$page_id = 'success'; 
?>

<?php include('inc/navigation.php'); ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <div style="margin: 0 auto" class="wrapper">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve">
                        <path class="checkmark" fill="none" stroke-width="8" stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4
                              C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/>
                    </svg>

                </div>

            </div>

        </div>


    </div>



</section>

<section>
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="alert alert-success">
                    <strong>Success!</strong> Your booking has been submitted.
                </div>


                <!-- Only last booking of this user will be displayed here -->
                <table class="table table-striped table-dark" width="100" border="0">
                    <?php
                    require_once('connection.php');
                    $connection = $database->connect;

                    $allData = mysqli_query($connection, "SELECT * FROM bookings ORDER BY id DESC LIMIT 1");

                    $fetchAllData = mysqli_fetch_array($allData);

                    $carnumber = $customFunction->inputvalid($fetchAllData['car_number']);
                    $destination = $customFunction->inputvalid($fetchAllData['destination']);
                    $pickup = $customFunction->inputvalid($fetchAllData['pickup']);
                    $booktime = $customFunction->inputvalid($fetchAllData['booking_time']);
                    $returntime = $customFunction->inputvalid($fetchAllData['return_time']);
                    $type = $customFunction->inputvalid($fetchAllData['job_type']);
                    $passengers = $customFunction->inputvalid($fetchAllData['passenger']);
                    
                    //echo $isupdate;
                    //echo $rowID = $_POST['rowID'];
                    ?>
                    <tbody>
                        <tr>
                            <th style="min-width: 100px;" scope="row">Booked Car:</th>
                            <td style="min-width: 200px;"><?php echo $carnumber; ?></td>
                        </tr>
                        <tr>
                            <th style="min-width: 100px;" scope="row">Destination:</th>
                            <td style="min-width: 200px;"><?php echo $destination; ?></td>
                        </tr>

                        <tr>
                            <th style="min-width: 100px;" scope="row">Pick Up From:</th>
                            <td style="min-width: 200px;"><?php echo $pickup; ?></td>
                        </tr>

                        <tr>
                            <th style="min-width: 100px;" scope="row">Booking Time:</th>
                            <td style="min-width: 200px;"><?php
                    $booktime2 = strtotime($booktime);
                    echo date("jS F Y , H:i", $booktime2);
                    ?></td>
                        </tr>

                        <tr>
                            <th style="min-width: 100px;" scope="row">Return Time:</th>
                            <td style="min-width: 200px;"><?php
                            
                               $returntime2 = strtotime($returntime);
                                echo date("jS F Y , H:i", $returntime2);
                            
                                
                    ?></td>
                        </tr>
                        <tr>
                            <th style="min-width: 100px;" scope="row">Booking Type:</th>
                            <td style="min-width: 200px;"><?php echo $type; ?></td>
                        </tr>
                        <tr>
                            <th style="min-width: 100px;" scope="row">Number of passengers:</th>
                            <td style="min-width: 200px;"><?php echo $passengers; ?></td>
                        </tr>
                        </tr>
                    </tbody>
                </table>

                <a href="index.php" class="btn btn-success btn-block">OK</a>

            </div>
        </div>
    </div>
</section>

</div>

<?php //include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>