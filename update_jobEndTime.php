<?php  
$id = $_POST['id'];
require_once('initial.php');
$database = new Database();
$CustomFunction = new CustomFunction();
$CustomFunction->isLoginDriver();
$connection  = $database->connect;

	mysqli_query($connection, "UPDATE bookings SET job_finish_time=now() WHERE id='$id'");
        
?>
