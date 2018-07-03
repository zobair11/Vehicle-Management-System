<?php 

    include('inc/head.php');
    $CustomFunction->isLoginAdmin();
    $page_id = "add_user";
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
                        $connection = $database->connect;

                        if( isset($_POST['add']) && $_POST['add'] == 'Add User' ) {

                            $fname  = $customFunction->inputvalid($_POST['fname']);
                            $lname   = $customFunction->inputvalid($_POST['lname']);
                            $email   = $customFunction->inputvalid($_POST['email']);
                            $uname = $customFunction->inputvalid($_POST['uname']);
                            $password   = $customFunction->inputvalid($_POST['password']);
                            $role   = $customFunction->inputvalid($_POST['role']);

                            //$hash_password = hash('md5', $pass);
                            
                            $errors = array();

                            $check  = mysqli_query($connection, "SELECT email, user_name FROM user_info WHERE user_name = '$uname' OR email = '$email' ");
                            $num_row = mysqli_num_rows($check);
                                echo mysqli_error($connection);
                           
                            if( isset($fname, $lname, $email, $uname, $password, $role) ) {
                                if( empty($fname) && empty($lname) && empty($email) && empty($uname) && empty($password)) {
                                    $errors[] = 'All fields are required'; 
                                } else {
                                    if( empty($fname) ) {
                                        $errors[] = 'First Name is required';
                                    } elseif ( empty($lname) ) {
                                        $errors[] = 'Last Name is required';
                                    } 
                                    elseif ( empty($email) ) {
                                        $errors[] = 'Email is required';
                                    }
                                    elseif ( empty($uname) ) {
                                        $errors[] = 'Username is required';
                                    }
                                    elseif ( empty($password) ) {
                                        $errors[] = 'Password is required';
                                    }
                                    elseif ($num_row>0) {
                                         $errors[] = 'User Name or Email already exists';
                                    }
                                    elseif($role=="Select Role"){
                                        $errors[] = 'Please Select Role';
                                    } 
                                }

                                if( !empty($errors) ) {
                                    echo "<div class='alert alert-danger'>";
                                    foreach ($errors as $error) {
                                        echo $error;
                                    }
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success">';
                                    echo '<strong>User added</strong>';
                                    mysqli_query($connection,  "INSERT INTO user_info (first_name,last_name,user_name,email,password,role) 
                                            VALUES('$fname','$lname','$uname','$email','$password','$role')");

                                    
                                }
                            }
                        }
                        
                        ?>

                 
                    <div class="panel-body">
                        <form role="form" class="contact-form" data-toogle="validator" class="shake" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 style="color:#af4a13;">Add User</h4>
                                </div>
                                <div class="panel-body">

                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="fname">
                                        </div>
                                </div>

                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Last Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="lname">
                                        </div>
                                </div>



                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">User Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="uname">
                                        </div>
                                </div>

                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="email">
                                        </div>
                                </div>


                               <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Role</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="role">
                                            <option disabled="" selected="">Select Role</option>
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
                                     <label class="col-sm-3 control-label">Password</label>
                                     <div class="col-sm-6">
                                    <input class="form-control" placeholder="Password" name="password" type="password" >
                                </div>
                            </div>
                        </div>                            
                                <div class="panel-footer" >
                                       
                                          <input type="submit" name="add" value="Add User" class="btn btn-success btn-block">
                                </div>
                            </div>
                         
                        </form>
                    </div>

                </div>               
            </div>           
        </div> 
   
    <?php include('inc/end.php');
      include('inc/footer.php');?>