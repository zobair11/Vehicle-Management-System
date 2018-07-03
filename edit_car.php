<?php 
include('inc/head.php');
$CustomFunction->isLoginAdmin();
    $page_id = "edit_car";
        include('inc/navigation.php');
    ?>
    <div id="wrap">
            <div id="wrapper">
    
        
                    <div id="page-wrapper">
                        <div class="row">
                            <div class="col-md-12" 
                                    >
                                    <section>
                                        <div class="container">
                                            <div class="row">

                                                <div class="col-lg-12">

                                                    <div id="txtHint"></div>
    <div class="alert alert-danger display-error" style="display: none"></div>
            
                    <?php
                    $car_id = (int) $_GET['id'];
                    
                    $connection  = $database->connect;




                    $allData = mysqli_query($connection,"SELECT * FROM cars WHERE id='$car_id'");
                    $fetchAllData = mysqli_fetch_array($allData);

                    $car_no  = $customFunction->inputvalid($fetchAllData['car_number']);
                    $type        = $customFunction->inputvalid($fetchAllData['type']);    
                    $reg_no     = $customFunction->inputvalid($fetchAllData['registration_number']);
                    $status  = $customFunction->inputvalid($fetchAllData['status']);
                   
                    
     

                        if( isset($_POST['submit']) && $_POST['submit'] == 'Edit Car' ) {    
                            
                            $new_car_no   = $customFunction->inputvalid($_POST['carno']);
                            $new_type    = $customFunction->inputvalid($_POST['type']);
                            $new_reg_no = $customFunction->inputvalid($_POST['regno']);
                            $new_status =  $customFunction-> inputvalid($_POST['status']);
                            
                            
                            $errors = array();

                            $query = mysqli_query($connection, "SELECT car_number, registration_number FROM cars WHERE (car_number = '$new_car_no' AND car_number!='$car_no') OR registration_number = '$new_reg_no' AND registration_number!='$reg_no' ");
                            $num_row = mysqli_num_rows($query);

                            if( isset($new_car_no, $new_type, $new_reg_no, $new_status) ) {
                                if( empty($car_no) && empty($reg_no)) {
                                    $errors[] = 'All fields are required'; 
                                } else {
                                    if( empty($new_car_no) ) {
                                        $errors[] = 'Car number is required';
                                    } elseif ( empty($new_reg_no) ) {
                                        $errors[] = 'Registration number is required';
                                    }
                                    
                                    elseif ($num_row>0) {
                                         $errors[] = 'Car Number or Registration number already exist';
                                    }
                                }

                                if(!empty($errors)) {
                                    echo "<div class='alert alert-danger'>";
                                    foreach ($errors as $error) {
                                        echo $error;
                                        echo '<br/>';
                                    }
                                    echo '</div>';
                                } else {


                                    $column_name = array('car_number', 'type', 'registration_number','status');

                                    
                                    $column_value = array($new_car_no, $new_type, $new_reg_no,$new_status);

                                    
                                    
                                    $query = $customFunction->updateData('cars', $column_name, $column_value, 'id', $car_id);             

                                    if( $query ) {    
                                        echo "<div class='alert alert-success'>Car updated</div>";
                                       //echo $new_type;
                                       //echo $new_status;
                                         $customFunction->redirect('manage_cars.php', 3);
                                        }                              
                                                          
                                    else {
                                        echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                        echo mysqli_error($connection);
                                    }
                                }
                            }
                    }

                    ?>
                        <form role="form" method="POST" class="contact-form" data-toggle="validator" class="shake" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$car_id"; ?>" >
                             <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 style="color:#af4a13;">Edit Car</h4>
                                                </div>
                                                <div class="panel-body">
                                    
                                    <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Car Number</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="carno" value="<?php echo $car_no ;  ?>"">
                                        </div>
                                      </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Type</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="type">
                                             <option disabled="" selected="">Select Type</option>
                                             <?php if ($type=='general') { ?>
                                               <option selected="" value="general">General</option>
                                                <option value="shuttle">Shuttle</option>
                                                <option value="Self" >Self</option>';
                                           <?php  } elseif ($type=='shuttle') { ?>
                                               <option value="general">General</option>
                                                <option selected="" value="shuttle">Shuttle</option>
                                                <option value="Self" >Self</option>';
                                         <?php  } else{  ?>
                                                <option value="general">General</option>
                                                <option value="shuttle">Shuttle</option>
                                                <option selected="" value="Self" >Self</option>';
                                   <?php      } ?>
                                               
                                        </select>
                                        </div>
                                    </div>

                                     <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="status">
                                            <option disabled="" >Select Status</option>
                                            <?php if ($status == '1') { ?>
                                            <option selected="" value="1">Active</option>
                                           <option value="0">Inactive</option>
                                          <?php   } else
                                          { ?>
                                                <option value="1">Active</option>
                                           <option selected="" value="0">Inactive</option>
                                         <?php }
                                          ?>
                                          
                                             
                                        </select>
                                        </div>
                                    </div>

                                      <div class="form-group" style="padding: 2%">
                                        <label class="col-sm-3 control-label">Registration Number</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="regno" value="<?php echo $reg_no  ?>"">
                                        </div>
                                      </div>

                                     </div>
                             
                                    <div class="panel-footer" >
                                       
                                          <input type="submit" name="submit" value="Edit Car" class="btn btn-success btn-block">

                                    
                                    </div>
                                </div>
                    
                        </form> 
                </div>               
            </div>           
        </div> 
    </div>


  <?php include('inc/footer.php');
  include('inc/end.php');?>