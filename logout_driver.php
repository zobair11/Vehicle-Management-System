<?php
require_once('initial.php');

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}



$CustomFunction = new CustomFunction();
if( isset($_SESSION['logged_user_driver_general']) && $_SESSION['logged_user_driver_general'] != '' ) {

  unset($_SESSION['logged_user_driver_general']);

 $CustomFunction->redirect('login.php');
  exit();
} 

elseif( isset($_SESSION['logged_user_driver_shuttle']) && $_SESSION['logged_user_driver_shuttle'] != '' ) {

  unset($_SESSION['logged_user_driver_shuttle']);

 $CustomFunction->redirect('login.php');
  exit();
} 

else {
 $CustomFunction->redirect('login.php');
  exit();
}
