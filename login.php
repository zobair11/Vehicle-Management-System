<?php
require_once('initial.php');
$database = new Database();
$CustomFunction = new CustomFunction();

if ( (isset($_SESSION['logged_user_admin']))  || (isset($_COOKIE['logged_user_admin']))) {
    $CustomFunction->redirect('index.php');

    exit();
}

if ( (isset($_SESSION['logged_user_normal'])) || (isset($_COOKIE['logged_user_normal']))) {
    $CustomFunction->redirect('index.php');

    exit();
}

if ( (isset($_SESSION['logged_user_driver_general'])) || (isset($_COOKIE['logged_user_general_driver']))) {
    $CustomFunction->redirect('manage_general_jobs.php');

    exit();
}

if ( (isset($_SESSION['logged_user_driver_shuttle'])) || (isset($_COOKIE['logged_user_shuttle_driver']))) {
    $CustomFunction->redirect('manage_shuttle_jobs.php');

    exit();
}

//Process Login Form
if (isset($_POST['login']) && $_POST['login'] == 'Log In') {

    $uname = $customFunction->inputvalid($_POST['user_name']);
    $pass = $customFunction->inputvalid($_POST['password']);
    //$hash_password = hash('md5', $pass);

    $errors = array();

    $check = mysqli_query($connection, "SELECT * FROM user_info WHERE user_name = '$uname' AND password = '$pass' ");
    $num_row = mysqli_num_rows($check);
    echo mysqli_error($connection);

    if (isset($uname, $pass)) {
        if (empty($uname) && empty($pass)) {
            $errors[] = 'All fields are required';
        } else {
            if (empty($uname)) {
                $errors[] = 'User Name is required';
            } elseif (empty($pass)) {
                $errors[] = 'Password required';
            } elseif ($num_row == 0) {
                $errors[] = 'Your username or password is incorrect';
            }
        }

        if (!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo $error;
            }
            echo '</div>';
        } else {
            echo '<div class="alert alert-success">';
            echo '<strong>Successfully Logged.</strong>';
            $row = mysqli_fetch_array($check);
            $role = $row['role'];
            if ($role == '2') {
                $u_id = $row['user_id'];
                $u_mail = $row['email'];
                $u_role = $row['role'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $_SESSION['logged_user_admin'] = $u_id;
                $_SESSION['uname_admin']       = $uname;
                $_SESSION['firstName']       = $first_name;
                $_SESSION['lastName']       = $last_name;
                 if(isset($_POST['remember_me'])){

                  /* $cookie_name = "rememberAdmin";
                    $cookie_value = true;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                      */

                    //storing values in cookie if isset
                    $_COOKIE['remember']       = $_POST['remember_me'];
                    //$_COOKIE['uname_admin']    = $u_id;
                    //$_COOKIE['firstName']      = $first_name;
                    //$_COOKIE['lastName']       = $last_name;
              
                    $admin_id = "logged_user_admin";
                    $admin_id_value = $u_id;

                    $admin_user_name        = "uname_admin";
                    $admin_user_name_value  = $uname;

                    $admin_first_name       = "firstName";
                    $admin_first_name_value = $first_name;

                    $admin_last_name        = "lastName";
                    $admin_last_name_value  = $last_name;

                    setcookie($admin_id, $admin_id_value, time() + (86400 * 30), "/");
                    setcookie($admin_user_name, $admin_user_name_value, time() + (86400 * 30), "/");
                    setcookie($admin_first_name, $admin_first_name_value, time() + (86400 * 30), "/");
                    setcookie($admin_last_name, $admin_last_name_value, time() + (86400 * 30), "/");
                     // 86400 = 1 day
                }

                echo '</div>';
                $CustomFunction->redirect('index.php');
            } elseif ($role == '1') {
                $u_id = $row['user_id'];
                $u_mail = $row['email'];
                $u_role = $row['role'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $_SESSION['logged_user_normal'] = $u_id;
                $_SESSION['uname_user'] = $uname;
                $_SESSION['firstName'] = $first_name;
                $_SESSION['lastName'] = $last_name;

                  if(isset($_POST['remember_me'])){

                  //storing cookie value if isset
                     $_COOKIE['remember']       = $_POST['remember_me'];
                    //$_COOKIE['uname_user']      = $u_id;
                    //$_COOKIE['firstName']       = $first_name;
                    //$_COOKIE['lastName']        = $last_name;
              
                    $normal_user_id         = "logged_user_normal";
                    $normal_user_id_value   = $u_id;

                    $normal_user_name       = "uname_user";
                    $normal_user_name_value = $uname;

                    $normal_user_first_name         = "firstName";
                    $normal_user_first_name_value   = $first_name;

                    $nomal_user_last_name           = "lastName";
                    $normal_user_last_name_value    = $last_name;


                    setcookie($normal_user_id, $normal_user_id_value, time() + (86400 * 30), "/");
                    setcookie($normal_user_name, $normal_user_name_value, time() + (86400 * 30), "/");
                    setcookie($normal_user_first_name, $normal_user_first_name_value, time() + (86400 * 30), "/" );
                    setcookie($nomal_user_last_name, $normal_user_last_name_value,  time() + (86400 * 30), "/");
                     // 86400 = 1 day
                }


                echo '</div>';
                $CustomFunction->redirect('index.php');
            } elseif ($role == '3') {
                $u_id = $row['user_id'];
                $u_mail = $row['email'];
                $u_role = $row['role'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $_SESSION['logged_user_driver_general'] = $u_id;
                $_SESSION['uname_driver']       = $uname;
                $_SESSION['firstName']       = $first_name;
                $_SESSION['lastName']       = $last_name;
                if(isset($_POST['remember_me'])){

                    //storing cookie value if isset
                    $_COOKIE['remember']       = $_POST['remember_me'];
                    //$_COOKIE['uname_user']      = $u_id;
                    //$_COOKIE['firstName']       = $first_name;
                    //$_COOKIE['lastName']        = $last_name;
              
                    $general_driver_user_id         = "logged_user_driver_general";
                    $general_driver_user_id_value   = $u_id;

                    setcookie($general_driver_user_id, $general_driver_user_id_value, time() + (86400 * 30), "/");
                    
                     // 86400 = 1 day
                }
                echo '</div>';
                $CustomFunction->redirect('manage_general_job.php');
            }

            elseif ($role == '4') {
                $u_id = $row['user_id'];
                $u_mail = $row['email'];
                $u_role = $row['role'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $_SESSION['logged_user_driver_shuttle'] = $u_id;
                $_SESSION['uname_driver']       = $uname;
                $_SESSION['firstName']       = $first_name;
                $_SESSION['lastName']       = $last_name;
                if(isset($_POST['remember_me'])){

                    //storing cookie value if isset
                    $_COOKIE['remember']       = $_POST['remember_me'];
                    //$_COOKIE['uname_user']      = $u_id;
                    //$_COOKIE['firstName']       = $first_name;
                    //$_COOKIE['lastName']        = $last_name;
              
                    $shuttle_driver_user_id         = "logged_user_driver_shuttle";
                    $shuttle_driver_user_id_value   = $u_id;

                    setcookie($shuttle_driver_user_id, $shuttle_driver_user_id_value, time() + (86400 * 30), "/");
                    
                     // 86400 = 1 day
                }
                echo '</div>';
                $CustomFunction->redirect('manage_shuttle_job.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Custom Login CSS FILE -->
        <link href="css/login.css" rel="stylesheet" type="text/css"/>

        <title>VMS Login</title>
        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script>
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
        
        </script>
        
    </head>
    <body >
        <div id="wrapper">
            
 <div class="se-pre-con"></div>

            <div id="page-wrapper">
               
                <!-- VMS LOGO -->
                <div class="row">
                    <div class="col-lg-3 col-lg-offset-5">
                        <img class="img-responsive" style="margin: 0 auto; max-width: 200px;" src="images/vms-logo.png" alt="VMS Logo">
                    </div>                
                </div>      

                <!-- LOGIN FORM -->
                <div class="container">

                    <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <h2 class="form-signin-heading text-muted">Log In</h2>
                        <input class="form-control" placeholder="User Name" name="user_name" type="text" autofocus value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        <div class="checkbox">
                         <label style="color: #FFFFFF; font-size: 16px;">
                            <input id="toggle-one" type="checkbox" name="remember_me">
                            Remember me
                        </label>
                        </div>
                        <input type="submit" name="login" value="Log In" class="btn btn-lg btn-default btn-block">

                    </form>


                </div>


            </div> 
        </div>
    </body>
</html>
<?php include('inc/end.php'); ?>