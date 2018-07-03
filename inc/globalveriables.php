 <?php 
            $connection = $database->connect;
            //checking if data is in session or cookie for admin and user

            if (isset($_SESSION['logged_user_admin'])) {
                $user_id_admin = $_SESSION['logged_user_admin'];
                $username       = $_SESSION['firstName'].' '.$_SESSION['lastName'];
            } elseif(isset($_COOKIE['logged_user_admin'])) {
                $user_id_admin = $_COOKIE['logged_user_admin'];
                $username       = $_COOKIE['firstName'].' '.$_COOKIE['lastName'];
            }
               elseif(isset($_SESSION['logged_user_normal'])){
            		 $user_id_normal = $_SESSION['logged_user_normal'];
                	$username       = $_SESSION['firstName'].' '.$_SESSION['lastName'];
            }
   
            elseif(isset($_COOKIE['logged_user_normal'])) {
                $user_id_normal = $_COOKIE['logged_user_normal'];
                $username       = $_COOKIE['firstName'].' '.$_COOKIE['lastName'];
            }
         
            
//Load day limits on booking from database and store it in a veriable.
$sql1 = mysqli_query($connection, "SELECT * FROM settings");
$fetchData 		= mysqli_fetch_array($sql1);
$day_limits 	=$customFunction->inputvalid($fetchData['days_limits']);
$max_booking_no = $customFunction->inputvalid($fetchData['max_booking_no']);
$minutes_steps      =  $customFunction->inputvalid($fetchData['minutes_steps']);
