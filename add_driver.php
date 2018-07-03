<?php 

    include('inc/head.php');
    $CustomFunction->isLoginAdmin();
    $page_id = "add_driver";
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

                        if( isset($_POST['add']) && $_POST['add'] == 'Add Driver' ) {

                            $driver_name  = $customFunction->inputvalid($_POST['driver_name']);
                            
                            $phone_number = $customFunction->inputvalid($_POST['phone_number']);
                            $address   = $customFunction->inputvalid($_POST['address']);
                            $identity_number   = $customFunction->inputvalid($_POST['identity_number']);

                            //$hash_password = hash('md5', $pass);
                            
                            $errors = array();

                            $check  = mysqli_query($connection, "SELECT * FROM drivers WHERE identity_number = '$identity_number' ");
                            $num_row = mysqli_num_rows($check);
                           
                            if( isset($driver_name, $phone_number, $address, $identity_number) ) {
                                    if( empty($driver_name) ) {
                                        $errors[] = 'Please enter driver name';
                                    } elseif ( empty($phone_number) ) {
                                        $errors[] = 'Phone Number is required';
                                    } 
                                    elseif ( empty($address) ) {
                                        $errors[] = 'Address is required';
                                    }
                                    elseif ( empty($identity_number) ) {
                                        $errors[] = 'Identity number is required';
                                    }
                                    elseif ($num_row>0) {
                                         $errors[] = 'Identity number already exists';
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
                                    echo '<strong>Driver added</strong>';
                                    mysqli_query($connection,  "INSERT INTO drivers (driver_name,phone_number,address,identity_number) 
                                            VALUES('$driver_name','$phone_number','$address','$identity_number')");

                                    
                                }
                            }
                        
                        
                        ?>

                 
                    <div class="panel-body">
                        <form role="form" class="contact-form" data-toogle="validator" class="shake" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 style="color:#af4a13;">Add Driver</h4>
                                </div>
                                <div class="panel-body">

                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Driver Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="driver_name">
                                        </div>
                                </div>

                        
                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Phone Number</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="phone_number">
                                        </div>
                                </div>

                                <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="address">
                                        </div>
                                </div>


                                <div class="form-group" style="padding: 2%">
                                     <label class="col-sm-3 control-label">Identity Number</label>
                                     <div class="col-sm-6">
                                    <input class="form-control" placeholder="Password" name="identity_number" type="text" >
                                </div>
                            </div>
                        </div>                            
                                <div class="panel-footer" >
                                       
                                          <input type="submit" name="add" value="Add Driver" class="btn btn-success btn-block">
                                </div>
                            </div>
                         
                        </form>
                    </div>

                </div>               
            </div>           
        </div> 
   
    <?php include('inc/end.php');
      include('inc/footer.php');?>