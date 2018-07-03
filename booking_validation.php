<?php

$errorMSG = "";
//#####################-- DESTINATION VALIDATION --##############################
//First check if the destination is "other"
if ($_POST["destination"] == "other") {

    //Check "other_destination feild"
    if (empty($_POST['other_destination'])) {
        $errorMSG .= "<li>Destination is required</<li>";
    } else {
        $destination = $_POST['other_destination'];
    }

// End of Check "other_destination feild"
}
//so, it's not "other"
else {
    //lets process original "destination" veriable
    if (empty($_POST['destination']) || ($_POST["destination"]) == "Select Destination") {
        $errorMSG .= "<li>Destination is required</<li>";
    } else {
        $destination = $_POST["destination"];
    } //End cheking original "destination" veriable
} // end of ELSE

//#####################-- PICKUP LOCATION VALIDATION --##############################
//First check if the pickup location is "other"
if ($_POST["pickup"] == "other") {

    //Check "other_destination feild"
    if (empty($_POST['other_pickup'])) {
        $errorMSG .= "<li>Pick-up location is required.</<li>";
    } else {
        $pickup = $_POST['other_pickup'];
    }

// End of Check "other_pickup feild"
}

//so, it's not "other"
else {
    //lets process original "destination" veriable
    if (empty($pickup = $_POST["pickup"]) || ($pickup = $_POST["pickup"]) == "Select PickUp Location") {
        $errorMSG .= "<li>Pick-up location is required</<li>";
    } else {
        $pickup = $_POST["pickup"];
    } //End cheking original "pickup" veriable
} // end of ELSE
//#########################################################################################################

if (empty($_POST["carnumber"]) || ($_POST["carnumber"]) == "Select Car") {
    $errorMSG .= "<li>Car number is required</<li>";
} else {
    $carnumber = $_POST['carnumber'];
}

//if (empty($_POST["job_type"])) {
//    $errorMSG .= "<li>Booking Type is Required</<li>";
//} else {
//    $job_type = $_POST['job_type'];
//}



if (empty($_POST["bookingtime"])) {
    $errorMSG .= "<li>Booking time is required</<li>";
} else {
    $bookingtime = $_POST['bookingtime'];
}


if (empty($_POST["returntime"])) {
    $errorMSG .= "<li>Return time is required</<li>";
} else {
    $returntime = $_POST['returntime'];
}
//
//
//
//
////$today = date("Y-m-d H:i:s");
//
//
////$bookingtime2 = strtotime($bookingtime);
////$bookingtime3 = date("dHi", $bookingtime2);
////$job_number = $destination[0] . $bookingtime3;
//
//
if (empty($errorMSG)) {

    //$msg = "Destination: ".$destination.", Car Number: ".$carnumber.", Booking Time: ".$bookingtime.", Return Time:".$returntime.", Pick Up: ".$pickup;
    $msg = "";
    echo json_encode(['code' => 200, 'msg' => $msg]);

    exit;
}

echo json_encode(['code' => 404, 'msg' => $errorMSG]);
//
//
////$sql = "INSERT INTO bookings (job_number, user_id, destination, car_number, pickup, booking_time, return_time, passenger, job_type) 
////               		       VALUES('$job_number', '$u_id', '$destination','$carnumber','$pick','$booktime','$returntime','$passenger', '$btype')";
////
////if ($conn->query($sql) === TRUE) {
////    echo "New record created successfully";
////} else {
////    echo "Error: " . $sql . "<br>" . $conn->error;
////}
////
////$conn->close();
?>
