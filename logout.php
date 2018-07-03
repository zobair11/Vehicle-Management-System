<?php
require_once('initial.php');

$CustomFunction = new CustomFunction();
if( isset($_SESSION['logged_user_admin']) && $_SESSION['logged_user_admin'] != '' ) {

  unset($_SESSION['logged_user_admin']);

 $CustomFunction->redirect('login.php');
  exit();
} 
else {
 $CustomFunction->redirect('login.php');
  exit();
}






