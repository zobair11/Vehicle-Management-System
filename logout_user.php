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

// if (!empty($_COOKIE))
// {
//     foreach ($_COOKIE as $name => $value)
//     {
//         setcookie($name, $value, time() -1);
//     }
// }


$CustomFunction = new CustomFunction();
if( isset($_SESSION['logged_user_normal']) && $_SESSION['logged_user_normal'] != '' ) {

  unset($_SESSION['logged_user_normal']);

 $CustomFunction->redirect('login.php');
  exit();
} 
elseif( isset($_SESSION['logged_user_admin']) && $_SESSION['logged_user_admin'] != '' ) {

  unset($_SESSION['logged_user_admin']);

 $CustomFunction->redirect('login.php');
  exit();
} 
else {
 $CustomFunction->redirect('login.php');
  exit();
}
