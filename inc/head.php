<?php 
$page_id = "gen";

require_once('initial.php');
$database = new Database();
$CustomFunction = new CustomFunction();

//exclude global veriables in drivers page.
if (basename($_SERVER['PHP_SELF']) === "manage_jobs.php"){
     
}
 else {
include 'inc/globalveriables.php';    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<title>VMS</title>

<!-- Bootstrap -->
<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.min.css"/>
<link href="css/flat-ui.min.css" rel="stylesheet">

<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
      
<script src="js/jquery-1.11.3.min.js"></script> 

<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
  
<style type="text/css">
  #map {
        height: 400px;
        width: 100%;
       }
</style>
 
<!--  Bootstrap toggle button scripts-->
 
 
<script>
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
        
        </script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>
<div id="wrap"><!-- WRAPPER START -->
    
    <div class="se-pre-con"></div>
