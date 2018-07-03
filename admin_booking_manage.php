<?php 
include('inc/head.php');
$CustomFunction->isLoginAdmin();
$page_id="admin_booking";
include('inc/navigation.php');
?>
<div id="warp">
<div id="wrapper">    
        <div id="page-wrapper">
            <div class="row">
                    <div class="col-md-12" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php
                                    $connection = $database->connect;
                                    //$u_id =$_SESSION['logged_user_admin'] ;
                                 
                                    $allData= mysqli_query($connection,  "SELECT * FROM bookings"); 
                                     $num_rows = $customFunction->numRows($allData);
                                ?>
                                 <?php if ($num_rows==0) { ?>
                              <h3><div class="alert alert-info">There is no bookings yet</div></h3> 
                              <?php  } else { ?>
                                All Bookings (<?php echo $num_rows; ?>)

                            </div>
                            <!-- /.panel-heading -->
                           
                           <div class="container">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="panel-body" >
                                      <div class="table-responsive" >                       
                                          <table class="table table-striped table-bordered table-hover" >
                                              <thead>
                                                  <tr>
                                                  	<th>Serial No</th>
                                                      <th>Car Number</th>                     
                                                      <th>Destination</th>
                                                      <th>Pickup</th>
                                                      <th>Booking Time</th>
                                                      <th>Return Time</th>
                                                      <th>Booking type</th>
                                                      <th>Passenger</th>
                                                    
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>

              
                                                      <?php
                                                     for ($i=1; $i <=$num_rows ; $i++){
                                                             
                                                          while ($bookings =mysqli_fetch_array($allData)) {
                                                          	$b_id = $bookings['id'];
                                                              $car_no           = $bookings['car_number'];
                                                              $destination       =$bookings['destination'];
                                                              $pickup        =$bookings['pickup'];
                                                              $bookingTime         =$bookings['booking_time'];
                                                              $returnTime = $bookings['return_time'];
                                                              $passengers           =$bookings['passenger'];
                                                              $type         =$bookings['job_type'];
                                                              
                                                      ?>
                                                  <tr>
                      
                                                      <td> 
                                                         <?php echo $i++; ?></td>
                                                      <td><?php echo $car_no; ?></td>
                                                      <td><?php echo $destination; ?></td>
                                                      
                                                      <td><?php echo $pickup; ?></td>
                                                      <td><?php 
                                                            $bookingtime2 = strtotime($bookingTime);
                                                            echo date("jS F Y , H:i", $bookingtime2);

                                                            ?></td>            
                                                      <td><?php 
                                                            $returntime2 = strtotime($returnTime);
                                                            echo date("jS F Y , H:i", $returntime2);

                                                            ?></td>
                                                       <td><?php echo     $type   ?></td>
                                                      <td><?php echo $passengers ?></td>
                                                      <td><?php echo "<a href='booking.php?id=$b_id'>Edit</a> | <a href='delete_booking.php?id=$b_id'>Cancel Booking</a>"; ?></td>

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
                            <?php } ?>
                         </div>   
                    </div>               
                </div>      
        </div> 
  </div>
  </div>
 <?php include('inc/footer.php');
 include('inc/end.php');
 ?>