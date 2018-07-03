<?php

///////////// Notes /////////////
//________________________________________
// Database Connection & Query Veriables.
// sql1 - runs Check Avaiability Query.
// sql2 - runs insert booking data.
// sql3 - runs update booking data.
// 
//////////// Diagrams //////////
//________________________________
//
//

ob_start();
session_start();

//Call the second DB Connection.
include('connection/connection.php');

// Lets check only three veriable for checking Car Avaiability.
$carnumber = $_POST['carnumber'];
$bookingtime = $_POST['bookingtime'];
$returntime = $_POST['returntime'];

//Check Avaiability by query
$sql1 = "SELECT car_number FROM bookings WHERE car_number='$carnumber' AND 
                ((booking_time BETWEEN '$bookingtime' and '$returntime') OR 
                (return_time BETWEEN '$bookingtime' and '$returntime'))";

$result = $conn->query($sql1);

//Show conflict message.
if ($result->num_rows > 0) {
    
    // Send Error to Ajax.
   echo "Error!";
    
} else {

//echo '<div class="alert alert-success">
//<strong>'.$carnumber.'</strong> - is avaialable on below selected time.
//</div>';
//
//
// OK, no conflicts, lets submit the data.
    
    //deside which veriables to take from locations
    if ($_POST["destination"] === "other") {
        $destination = $_POST['other_destination'];
    } else {
        $destination = $_POST["destination"];
    }

    if ($_POST["pickup"] === "other") {
        $pickup = $_POST['other_pickup'];
    } else {
        $pickup = $_POST["pickup"];
    }

    $carnumber = $_POST['carnumber'];
    $bookingtime = $_POST['bookingtime'];
    $returntime = $_POST['returntime'];
    //$job_type = $_POST['job_type'];
    
    $job_type = 'General';

//Create job number
    $today = date("Y-m-d H:i:s");
    $Date = strtotime($bookingtime);
    $DateFormatted = date("dHi", $Date);



//Pick the User ID
    if (isset($_SESSION['logged_user_normal'])) {

        $u_id = $_SESSION['logged_user_normal'];
    } else {
        $u_id = $_SESSION['logged_user_admin'];
    }

    $job_number = $destination[0] . $DateFormatted;


//check if its a new booking or just update - 1 -> new Booking | 2 -> booking update
    $isupdate = $_POST['isupdate'];

//Now submit data if it's new booking
    if ($isupdate == '1') {
        $sql2 = "INSERT INTO bookings (job_number, user_id, `destination`, car_number, pickup, booking_time, return_time, job_type, submission_time,is_cancelled) 
               		       VALUES('$job_number', '$u_id', '$destination','$carnumber','$pickup','$bookingtime','$returntime','$job_type', now(), '0')";

        if ($conn->query($sql2) === TRUE) {

//echo "Booking Has Been Submitted Successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

//Now edit data if it's old booking
    } else {
//get the row id of bookings table from ajax-> hidden input in booking.php
        $rowID = $_POST['rowID'];

        $sql3 = "UPDATE bookings SET destination='$destination', car_number='$carnumber', pickup = '$pickup', booking_time ='$bookingtime', return_time = '$returntime', job_type='$job_type', update_time=now() WHERE id = '$rowID' ";
        if ($conn->query($sql3) === TRUE) {
            # code...
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
    }
    $conn->close();
// End submiting data. 
}
?>
