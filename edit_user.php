<?php 
require_once('inc/head.php');
$CustomFunction->isLoginAdmin();
    $page_id = "edit_user";
         include('inc/navigation.php');?>
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
                    $u_id = (int) $_GET['user_id'];
                    $connection  = $database->connect;




                    $allData = mysqli_query($connection,"SELECT * FROM user_info WHERE user_id='$u_id'");
                    $fetchAllData = mysqli_fetch_array($allData);

                    $fname  = $customFunction->inputvalid($fetchAllData['first_name']);
                    $lname        = $customFunction->inputvalid($fetchAllData['last_name']);    
                    $uname     = $customFunction->inputvalid($fetchAllData['user_name']);
                    $email  = $customFunction->inputvalid($fetchAllData['email']);
                    $role         = $customFunction->inputvalid($fetchAllData['role']);
                    $pass      = $customFunction->inputvalid($fetchAllData['password']);
                  
     

                    
                        if( isset($_POST['submit']) && $_POST['submit'] == 'Edit User' ) {    
                            
                            $new_fname   = $customFunction->inputvalid($_POST['fname']);
                            $new_lname    = $customFunction->inputvalid($_POST['lname']);
                            $new_uname   = $customFunction->inputvalid($_POST['uname']);    
                            $new_email    = $customFunction->inputvalid($_POST['email']);
                            $new_role    = $customFunction->inputvalid($_POST['role']);
                            $new_pass    = $customFunction->inputvalid($_POST['pass']);

                            
                            
                            $errors = array();

                            $query = mysqli_query($connection, "SELECT user_id FROM user_info WHERE user_id = '$u_id' ");
                            $num_row = mysqli_num_rows($query);

                            if( isset($new_fname, $new_lname, $new_uname, $pass )) {

                                if( empty($new_fname) ) {
                                    $errors[] = 'Enter first name';
                                } 
                                

                                if( empty($new_lname) ) {
                                    $errors[] = 'Enter last name';
                                } 

                                if( empty($new_uname) ) {
                                    $errors[] = 'Enter username';
                                } 
                                if (empty($email)) {
                                    $errors[] = 'Enter email';
                                }
                                if (empty($pass)) {
                                    $errors[] = 'Enter password';
                                }

                                if(!empty($errors)) {
                                    echo "<div class='alert alert-danger'>";
                                    foreach ($errors as $error) {
                                        echo $error;
                                        echo '<br/>';
                                    }
                                    echo '</div>';
                                } else {


                                    $column_name = array('first_name', 'last_name', 'user_name', 'email', 'role','password');

                                    
                                    $column_value = array($new_fname, $new_lname, $new_uname, $new_email, $new_role,$new_pass);

                                    
                                    
                                    $query = $customFunction->updateData('user_info', $column_name, $column_value, 'user_id', $u_id);             

                                    if( $query ) {    
                                        echo "<div class='alert alert-success'>User updated</div>";
                                            $customFunction->redirect('manage_user.php', 3);
                                        }                              
                                                          
                                    else {
                                        echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                        echo mysqli_error($connection);
                                    }
                                }
                            }
                    }

                    ?>
                    <div class="panel-body">
                        <form role="form" class="contact-form" data-toogle="validator" class="shake" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?user_id=$u_id"; ?>" >

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 style="color:#af4a13;">Edit User</h4>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="fname" value="<?php echo $fname  ?>"">
                                        </div>
                                    </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Last Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="lname" value="<?php echo $lname  ?>"">
                                        </div>
                                      </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">User Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="uname" value="<?php echo $uname  ?>"">
                                        </div>
                                      </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-6">
                                          <input type="email" class="form-control" name="email" value="<?php echo $email  ?>"">
                                        </div>
                                      </div>

                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Role</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="role">
                                             <option disabled="">Select Role</option>
                                            <?php 
                                           $role = mysqli_query($connection,"SELECT * FROM user_role" );
                                          
                                           
                                            while ($row = mysqli_fetch_array($role)) {
                                                
                                            echo "<option value=\"{$row['id']}\">" . $row['user_role'] . " </option>";

                                            }

                                             ?>
                                               
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Reset Password</label>
                                        <div class="col-sm-6">
                                          <input type="password" class="form-control" name="pass" value="<?php echo $pass  ?>"">
                                        </div>
                                      </div>


                                </div>
                             
                                    <div class="panel-footer" >
                                        
                                          <input type="submit" name="submit" value="Edit User" class="btn btn-success btn-block">

                                        </div>
                                    </div>
                        </form> 
                </div>               
            </div>           
        </div> 
</div>
    <?php include('inc/footer.php');
    include('inc/end.php');
    ?>
