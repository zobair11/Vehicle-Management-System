<?php
include('inc/head.php');
$CustomFunction->isLoginGeneralDriver();

?>

<body>
    <div id="wrap">
<!--        <input type="submit" id="wrap" onclick="checkNewJob();" value="Check" class="btn btn-success">-->


        <?php
        include('inc/navigation.php');
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#today">Today's Bookings</a></li>
                        <li><a data-toggle="tab" href="#fromtomorrow">Future Bookings</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="today" class="tab-pane fade in active">
                            
                            <section>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <h3>General Bookings</h3>
                        <?php
                        $connection = $database->connect;

                        $allData = mysqli_query($connection, "SELECT
bookings.id,
user_info.user_name,
bookings.job_number,
bookings.car_number,
bookings.destination,
bookings.pickup,
bookings.booking_time,
bookings.return_time,
bookings.job_start_time,
bookings.job_finish_time,
bookings.passenger,
bookings.job_type,
bookings.job_status
FROM
bookings
INNER JOIN user_info ON user_info.user_id = bookings.user_id
WHERE
bookings.job_type != 'shuttle' AND(
bookings.job_start_time IS NULL OR
bookings.job_finish_time IS NULL) AND
DATE(booking_time) = CURDATE()
");
                        $num_rows = $customFunction->numRows($allData);
                        if ($num_rows==0) { ?>
                            <h3><div class="alert alert-info">There is no job for today yet</div></h3> 
                       <?php } 
                        else{
                        for ($i = 0; $i < $num_rows; $i++) {
                            while ($fetchAllData = mysqli_fetch_array($allData)) {
                                $id = $customFunction->inputvalid($fetchAllData['id']);
                                $car_no = $customFunction->inputvalid($fetchAllData['car_number']);
                                $pickup = $customFunction->inputvalid($fetchAllData['pickup']);
                                $booking_time = $customFunction->inputvalid($fetchAllData['booking_time']);
                                $return_time = $customFunction->inputvalid($fetchAllData['return_time']);
                                $destination = $customFunction->inputvalid($fetchAllData['destination']);
                                $user = $customFunction->inputvalid($fetchAllData['user_name']);
                                $job_number = $customFunction->inputvalid($fetchAllData['job_number']);
                                $job_status = $customFunction->inputvalid($fetchAllData['job_status']);

                                $start_time = $customFunction->inputvalid($fetchAllData['job_start_time']);
                                $finish_time = $customFunction->inputvalid($fetchAllData['job_finish_time']);

                                if ($job_status != '1') {
                                    ?>

                                    <form>

                                        <div class="panel panel-primary" id="job">
                                            <div class="panel-heading">
                                                <?php if ($start_time == '') { ?>
                                                    <div class="col-lg-3 col-xs-4 col-md-4">

                                                        <button id="sub" type="button" onclick="submitDatetimeStart();" value="<?php echo $id; ?>" class="btn btn-warning">Start Job</button> 
                                                        <button style="display:none;" type="button" class="btn btn-success">Finish Job</button> 
                                                    </div>
                                                <?php } elseif ($start_time != '' && $finish_time == '') {
                                                    ?>
                                                    <div class="col-lg-3 col-xs-4 col-md-4">

                                                        <button style="display: none;" type="button" class="btn btn-warning">Start Job</button> 
                                                        <button style="" type="button" id="sub2" onclick="submitDatetimeEnd();" value="<?php echo $id; ?>" class="btn btn-success">Finish Job</button> 
                                                    </div>
                                                    <?php
                                                }

                                                if ($start_time == NULL) {
                                                    echo '<p style="text-align: right; font-size: 20px;">Pending</p>';
                                                } else {
                                                    echo '<p style="text-align: right; font-size: 20px;">Job Started at: ' . $start_time . '</p>';
                                                }
                                                ?>

                                            </div>

                                            <div class="panel-body">



                                                <p>Job ID:<span class="label label-primary"><?php echo $job_number; ?></span> | Passenger: <?php echo $user ?>|
                                                    Destination: <?php echo $destination; ?>| Pickup From: <?php echo $pickup; ?> | Booked Car: <span class="label label-primary"><?php echo $car_no; ?></span> | Pickup Time: <?php
                                                    $bookingtime2 = strtotime($booking_time);
                                                    echo date("jS F Y , H:i", $bookingtime2);
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                <?php }
                                

                                }
                            } 
                         } ?>

                    </div>




                </div>


            </div>

        </section>
                            
                        </div>
                        <div id="fromtomorrow" class="tab-pane fade">
                            
                            <div class="col-lg-6">
                        <h3>Upcoming Jobs</h3>
                        <?php
                        $connection = $database->connect;

                        $allData2 = mysqli_query($connection, "SELECT
bookings.id,
user_info.user_name,
bookings.job_number,
bookings.car_number,
bookings.destination,
bookings.pickup,
bookings.booking_time,
bookings.return_time,
bookings.job_start_time,
bookings.job_finish_time,
bookings.passenger,
bookings.job_type,
bookings.job_status
FROM
bookings
INNER JOIN user_info ON user_info.user_id = bookings.user_id
WHERE
bookings.job_type != 'shuttle' AND(
bookings.job_start_time IS NULL OR
bookings.job_finish_time IS NULL) AND
DATE(booking_time) > DATE(NOW())
");
                        $num_rows = $customFunction->numRows($allData2);
                        if ($num_rows==0) { ?>
                            <h3><div class="alert alert-info">There is no future job yet</div></h3> 
                       <?php } 
                        else{
                        for ($i = 0; $i < $num_rows; $i++) {
                            while ($fetchAllData = mysqli_fetch_array($allData2)) {
                                $id = $customFunction->inputvalid($fetchAllData['id']);
                                $car_no = $customFunction->inputvalid($fetchAllData['car_number']);
                                $pickup = $customFunction->inputvalid($fetchAllData['pickup']);
                                $booking_time = $customFunction->inputvalid($fetchAllData['booking_time']);
                                $return_time = $customFunction->inputvalid($fetchAllData['return_time']);
                                $destination = $customFunction->inputvalid($fetchAllData['destination']);
                                $user = $customFunction->inputvalid($fetchAllData['user_name']);
                                $job_number = $customFunction->inputvalid($fetchAllData['job_number']);
                                $job_status = $customFunction->inputvalid($fetchAllData['job_status']);

                                $start_time = $customFunction->inputvalid($fetchAllData['job_start_time']);
                                $finish_time = $customFunction->inputvalid($fetchAllData['job_finish_time']);

                                if ($job_status != '1') {
                                    ?>

                                    <form>

                                        <div class="panel panel-primary" id="job">
                                            <div class="panel-heading">
                                                <?php if ($start_time == '') { ?>
                                                    <div class="col-lg-3 col-xs-4 col-md-4">

                                                        <button id="sub" type="button" onclick="submitDatetimeStart();" value="<?php echo $id; ?>" class="btn btn-warning">Start Job</button> 
                                                        <button style="display:none;" type="button" class="btn btn-success">Finish Job</button> 
                                                    </div>
                                                <?php } elseif ($start_time != '' && $finish_time == '') {
                                                    ?>
                                                    <div class="col-lg-3 col-xs-4 col-md-4">

                                                        <button style="display: none;" type="button" class="btn btn-warning">Start Job</button> 
                                                        <button style="" type="button" id="sub2" onclick="submitDatetimeEnd();" value="<?php echo $id; ?>" class="btn btn-success">Finish Job</button> 
                                                    </div>
                                                    <?php
                                                }

                                                if (empty($start_time)) {
                                                    echo '<p style="text-align: right; font-size: 20px;">Pending</p>';
                                                } else {
                                                    echo '<p style="text-align: right; font-size: 20px;">Job Started at: ' . $start_time . '</p>';
                                                }
                                                ?>



                                            </div>

                                            <div class="panel-body">



                                                <p>Job ID:<span class="label label-primary"><?php echo $job_number; ?></span> | Passenger: <?php echo $user ?>|
                                                    Destination: <?php echo $destination; ?>| Pickup From: <?php echo $pickup; ?> | Booked Car: <span class="label label-primary"><?php echo $car_no; ?></span> | Pickup Time: <?php
                                                    $bookingtime2 = strtotime($booking_time);
                                                    echo date("jS F Y , H:i", $bookingtime2);
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                <?php }
                               


                           } 
                         }
                    } ?>

                    </div>
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


    <script type="text/javascript">
        function submitDatetimeStart() {
            var bookingRowID = document.getElementById("sub").value;
            var dataString = 'id=' + bookingRowID;
            if (bookingRowID == '') {
                alert("Booking Row ID Didn't Found!");
            } else {
                // AJAX code to submit form.
                $.ajax({
                    type: "POST",
                    url: "update_jobStartTime.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //alert('Data Updated.');
                        location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }
                });
            }
            return false;
        }

        function submitDatetimeEnd() {
            var bookingRowID = document.getElementById("sub2").value;
            var dataString = 'id=' + bookingRowID;
            if (bookingRowID == '') {
                alert("Booking Row ID Didn't Found!");
            } else {
                // AJAX code to submit form.
                $.ajax({
                    type: "POST",
                    url: "update_jobEndTime.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //alert('Data Updated.');
                        location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }
                });
            }
            return false;
        }




        function submitDatetimeEnd2() {
            var bookingRowID = document.getElementById("sub4").value;
            var dataString = 'id=' + bookingRowID;
            if (bookingRowID == '') {
                alert("Booking Row ID Didn't Found!");
            } else {
                // AJAX code to submit form.
                $.ajax({
                    type: "POST",
                    url: "update_jobEndTime.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //alert('Data Updated.');
                        location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }
                });
            }
            return false;
        }


        function submitDatetimeStart2() {
            var bookingRowID = document.getElementById("sub3").value;
            var dataString = 'id=' + bookingRowID;
            if (bookingRowID == '') {
                alert("Booking Row ID Didn't Found!");
            } else {
                // AJAX code to submit form.
                $.ajax({
                    type: "POST",
                    url: "update_jobStartTime.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //alert('Data Updated.');
                        location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }
                });
            }
            return false;
        }


        //var timeout = setTimeout("location.reload(true);",60000);


    </script>

    <script src="js/bootstrap-notify.js" type="text/javascript"></script>

    <script type="text/javascript">

        setInterval("checkNewJob()", 10000);

        function checkNewJob() {

            $.ajax({
                type: 'POST',
                url: 'check_new_job.php',
                data: "",
                success: function (data) {

                    if (!!data) {
                        // Say the job announcement
                        var audio = new Audio('ding.mp3');
                        audio.play();

                        // Make a delay on the announcement
                        setTimeout(function () {
                            var msg = new SpeechSynthesisUtterance();
                            var voices = window.speechSynthesis.getVoices();
                            msg.voice = voices[11]; // Note: some voices don't support altering params
                            msg.voiceURI = 'native';
                            msg.volume = 1; // 0 to 1
                            msg.rate = 1; // 0.1 to 10
                            msg.pitch = 1; //0 to 2
                            //msg.text = 'New Job Has Been Submitted, The Job Number is:' + data;
                            msg.text = data;
                            msg.lang = 'en-UK';

                            //msg.onend = function(e) {
                            //console.log('Finished in ' + event.elapsedTime + ' seconds.');
                            //};

                            speechSynthesis.speak(msg);

                            //Speech End
                            setInterval("location.reload();", 10000);
                            //alert(data);

                        }, 1000);

                    }

                }
                // Success END
            });
        }
    </script>
    <?php include('ajax/ajax_check_new_job.php'); ?>
    <?php
    //include('inc/footer.php');
    include('inc/end.php');
    ?>