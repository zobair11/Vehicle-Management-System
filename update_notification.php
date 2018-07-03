<?php

$job_number = $_POST['job_number'];

//echo $job_number;
require_once('initial.php');
$database = new Database();
$CustomFunction = new CustomFunction();
$CustomFunction->isLoginDriver();
$connection  = $database->connect;
mysqli_query($connection, "UPDATE notifications SET status='1' WHERE job_number= '$job_number'");
        
?>
