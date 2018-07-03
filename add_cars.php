<?php 
include('inc/head.php');
$CustomFunction->isLoginAdmin();
$page_id = "add_cars";
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

                        if( isset($_POST['add']) && $_POST['add'] == 'Add Car' ) {

                            $car_no  = $customFunction->inputvalid($_POST['carno']);
                            $type   = $customFunction->inputvalid($_POST['type']);
                            $reg_no   = $customFunction->inputvalid($_POST['regno']);
                            $status  = $customFunction->inputvalid($_POST['status']);
                           

                            //$hash_password = hash('md5', $pass);
                            
                            $errors = array();

                            $check  = mysqli_query($connection, "SELECT car_number, registration_number FROM cars WHERE car_number = '$car_no' OR registration_number = '$reg_no' ");
                            $num_row = mysqli_num_rows($check);
                                echo mysqli_error($connection);
                           
                            if( isset($car_no, $type, $reg_no, $status) ) {
                                if( empty($car_no) && empty($reg_no) && $type="Select Type" && $status="Select Status") {
                                    $errors[] = 'All fields are required'; 
                                } else {
                                    if( empty($car_no) ) {
                                        $errors[] = 'Car number is required';
                                    } elseif ( empty($reg_no) ) {
                                        $errors[] = 'Registration number is required';
                                    } 
                                    
                                    elseif ($num_row>0) {
                                         $errors[] = 'Car Number or Registration number already exist';
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
                                    echo '<strong>Car added</strong>';
                                    mysqli_query($connection,  "INSERT INTO cars (car_number,type,registration_number,status) 
                                            VALUES('$car_no','$type','$reg_no','$status')");
                                    $customFunction->redirect('manage_cars.php',3);
                                    //echo $type;
                                }
                            }
                        }
                        
                        ?>
                        </div>
                    
                        <form role="form" method="POST" class="contact-form" data-toggle="validator" class="shake" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 style="color:#af4a13;">Add Car</h4>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Car Number</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="carno" >
                                        </div>
                                    </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Type</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="type">
                                            <option disabled="" selected="">Select Type</option>
                                           <option value="general">General</option>
                                           <option value="shuttle">Shuttle</option>
                                           <option value="Self" >Self</option>  
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="status">
                                            <option disabled="" selected="">Select Status</option>
                                           <option value="1">Active</option>
                                           <option value="0">Inactive</option>
                                             
                                        </select>
                                        </div>
                                    </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Registration Number</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="regno" >
                                        </div>
                                      </div>
                                </div>
                                     
                             
                                    <div class="panel-footer" >
                                       
                                          <input type="submit" name="add" value="Add Car" class="btn btn-success btn-block">

                                    
                                    </div>
                                </div>
                        </form> 



                </div>               
            </div>           
        </div> 
  </div>

  <?php include('inc/footer.php');?>
  <?php include('inc/end.php'); ?>




