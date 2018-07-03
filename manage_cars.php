<?php 
include('inc/head.php');
$CustomFunction->isLoginAdmin();
         $page_id = "manage_cars";
          include('inc/navigation.php');
          ?>
    <div class="row">
                    <div class="col-md-12" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php
                                    $connection = $database->connect;
                                    
                                 
                                    $allData= mysqli_query($connection,  "SELECT * FROM cars "); 
                                     $num_rows = $customFunction->numRows($allData);
                                ?>
                                Total User (<?php echo $num_rows; ?>)

                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body" >
                                <div class="table-responsive" >                            
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th>Serial No</th>                     
                                                <th>Car No</th>
                                                <th>Type</th>
                                                <th>Registration No</th>
                                                 <th>Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

        
                                                <?php
                                               for ($i=1; $i <=$num_rows ; $i++){
                                                       
                                                    while ($user =mysqli_fetch_array($allData)) {
                                                        $serial       = (int)$user['id'];
                                                        $carno       =$user['car_number'];
                                                        $type        =$user['type'];
                                                        $reg_no       =$user['registration_number'];
                                                        $status = $user['status'];
                                                        
                                                ?>
                                            <tr>
                
                                                
                                                <td><?php echo $serial; ?></td>
                                                <td><?php echo $carno; ?></td>
                                                
                                                <td><?php echo $type; ?></td>
                                                <td><?php echo    $reg_no ; ?></td>
                                                <td><?php echo $status; ?></td>            
                                                
                                                <td><?php echo "<a href='edit_car.php?id=$serial'>Edit</a> | <a href='delete_car.php?id=$serial'>Delete</a>"; ?></td>

                                            </tr>  
                                                   <?php 
                                 }
                                 ?>
                                              <?php   
                            }
                        ?>
            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>   
                    </div>               
                </div> 
  <?php include('inc/footer.php');
  include('inc/end.php');?>



