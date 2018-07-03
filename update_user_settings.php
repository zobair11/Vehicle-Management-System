<?php
include('inc/head.php');
$CustomFunction->userAdmin();
$page_id= "settings";
include('inc/navigation.php');
?>
<div id="wrap">
<div id="wrapper">


    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="txtHint"></div>
                                        <div class="alert alert-danger display-error" style="display: none">
                                        </div>
             
                <?php
                if (isset($_SESSION['logged_user_normal'])) {
                $u_id = $_SESSION['logged_user_normal'];
            }
            else{
                $u_id = $_SESSION['logged_user_admin'];
            }
                $customFunction = new customFunction();
                $connection = $database->connect;

                $allData = mysqli_query($connection, "SELECT * FROM user_info WHERE user_id='$u_id'");
                $fetchAllData = mysqli_fetch_array($allData);

                $fname = $customFunction->inputvalid($fetchAllData['first_name']);
                $lname = $customFunction->inputvalid($fetchAllData['last_name']);
                $email = $customFunction->inputvalid($fetchAllData['email']);
                $user_name = $customFunction->inputvalid($fetchAllData['user_name']);
                $password = $customFunction->inputvalid($fetchAllData['password']);

                if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {

                    $new_fname = $customFunction->inputvalid($_POST['fname']);
                    $new_lname = $customFunction->inputvalid($_POST['lname']);
                    $new_email = $customFunction->inputvalid($_POST['email']);
                    $new_user_name = $customFunction->inputvalid($_POST['uname']);
                    $new_password = $customFunction->inputvalid($_POST['newpass']);
                    $old_password = $customFunction->inputvalid($_POST['oldpass']);




                    $errors = array();

                    $query = mysqli_query($connection, "SELECT user_id FROM user_info WHERE user_id = '$u_id' ");
                    $num_row = mysqli_num_rows($query);

                    if (isset($new_fname, $new_lname, $email, $user_name, $password)) {


                        $old_password = $customFunction->inputvalid($_POST['oldpass']);

                        $new_password = $customFunction->inputvalid($_POST['newpass']);

                        if (!empty($new_password)) {
                            if (empty($old_password)) {
                                $errors[] = 'Enter Old Password';
                            }
                            if ($old_password != $password) {
                                $errors[] = 'Enter Correct Previous Password';
                            }


                            if (!empty($errors)) {
                                echo "<div class='alert alert-danger'>";
                                foreach ($errors as $error) {
                                    echo $error;
                                    echo '<br/>';
                                }
                                echo '</div>';
                            } else {

                                $column_name = array('password');


                                $column_value = array($new_password);



                                $query = $customFunction->updateData('user_info', $column_name, $column_value, 'user_id', $u_id);

                                if ($query) {
                                    echo "<div class='alert alert-success'>Your Password has updated</div>";
                                    $customFunction->redirect('index.php', 3);
                                } else {
                                    echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                    echo mysqli_error($connection);
                                }
                            }
                        }

                        if (!empty($new_fname) && $fname  !=$new_fname) {
                            $column_name = array('first_name');


                            $column_value = array($new_fname);



                            $query = $customFunction->updateData('user_info', $column_name, $column_value, 'user_id', $u_id);

                            if ($query) {
                                echo "<div class='alert alert-success'>Your First Name has updated</div>";
                                $customFunction->redirect('index.php', 3);
                            } else {
                                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                echo mysqli_error($connection);
                            }
                        }



                        if (!empty($new_lname) && $lname != $new_lname) {
                            $column_name = array('last_name');


                            $column_value = array($new_lname);

                            $query = $customFunction->updateData('user_info', $column_name, $column_value, 'user_id', $u_id);

                            if ($query) {
                                echo "<div class='alert alert-success'>Your Last Name has updated</div>";
                                $customFunction->redirect('index.php', 3);
                            } else {
                                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                echo mysqli_error($connection);
                            }
                        }
                    }
                }
                ?>
                <div class="panel-body">
                <form role="form" class="contact-form" data-toggle="validator" class="shake" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?user_id=$u_id"; ?>" >
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h4 style="color:#af4a13;">Edit Profile</h4>
                            </div>
                            <div class="panel-body">

                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  value="<?php echo $fname; ?>" name="fname">
                                </div>
                            </div>

                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" value="<?php echo $lname; ?>" name="lname">
                                </div>
                            </div>

                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" readonly="" value="<?php echo $user_name; ?>" name="uname">
                                </div>
                            </div>


                            <div class="form-group" style="padding: 2%">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" value="<?php echo $email; ?>" readonly="" name="email">
                                </div>
                            </div>


                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="oldpass">
                        </div>
                    </div>


                    <div class="form-group" style="padding: 2%">
                        <label class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="newpass">
                        </div>
                    </div>
                </div>




                    <div class="panel-footer" >
                        
                            <input type="submit" name="submit" value="Update" class="btn btn-success btn-block">

                    </div>
                </div>
            </form> 
        </div>               
    </div>           
</div> 


<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>

