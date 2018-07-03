<?php
include('inc/head.php');
$customFunction->userAdmin();
include('inc/navigation.php');
$page_id = "available";
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
									<h2 style="text-align: center;">Check Availibility</h2>
								</div>
								<form role="form" method="POST" class="contact-form" data-toggle="validator" class="shake" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
								<div class="col-lg-12">
									<label>Select Date</label>
									<input type="text" name="date" id="date">
								</div>
								<div class="col-lg-12">
									
									<!-- table starts here !-->

									<div class="table-responsive">
									 <table class="table table-striped table-bordered table-hover" border="2px solid green" >
									 	<thead align= "justify">
									 		<tr>
									 			<th colspan="25" style="text-align: center;">Time(hours)</th>
									 		</tr>
									 	</thead>

									 	<thead>
									 		<tr>
									 			<th>Vehicles</th>
									 			<?php  for ($header=0; $header <24 ; $header++) {  ?>
									 				<th><?php echo $header;
									 				//printing all hours ?></th>
									 		<?php	} ?>

									 		</tr>
									 	</thead>


									 	<tbody>
									 		
									 		<?php 
									 		$connection  = $database->connect;
									 		$sql= mysqli_query($connection,  "SELECT car_number FROM cars WHERE status='1' ");
									 		$num_rows = $customFunction->numRows($sql);
									 		
									 		?>
									 		<tr>
									 		<?php
									 		for ($i=0; $i <$num_rows ; $i++) {
									 		 while ( $allData = mysqli_fetch_array($sql)) {
									 			$car_name = $customFunction->inputvalid($allData['car_number']);

									 		 ?> 
									 				<td><?php echo $car_name 
									 				// printing all car name;  

									 				?></td>
									 				
									 				<?php

									 				 if( isset($_POST['check']) && $_POST['check'] == 'Check Availibility' ) {


									 			
									 			$date = $_POST['date'];
									 			$date2 = strtotime($date);
									 			$date3 = date('Y-m-d',$date2);
									 			$avail = mysqli_query($connection, "SELECT * FROM bookings WHERE date(booking_time)='$date' AND (job_status ='0' OR job_status IS NULL) ");

									 			$avail2 = mysqli_query($connection, "SELECT * FROM bookings WHERE (job_status ='0' OR job_status IS NULL) ");
									 			

									 			while($data  = mysqli_fetch_array($avail)){
									 			$book  = $data['booking_time'];
									 			$book2 = strtotime($book);
									 			$book3 = date('Y-m-d',$book2);
									 			$return = $data['return_time'];
									 			$car   = $data['car_number'];
									 			$return2 = strtotime($return);
									 			$return3 = date('Y-m-d',$return2);
									 			$car = $data['car_number'];
									 			$rtime = date('H',$return2); //taking the hour value
									 			$rtime;
									 			$btime = date('H',$book2);
									 			
									 			if($car_name==$car && $book3==$return3)
									 			{
									 				//booking nd return in same day
									 				$lower = $btime;
									 				$upper = $rtime;

									 				 
									 				 for($i=0;$i<$lower;$i++) { ?>
									 				 <td></td>
									 			
									 				<?php
									 			} for ($i=$lower-1; $i <$upper ; $i++) { ?>
									 				<td style="background-color: red"></td>
									 			<?php } ?>

									 			
									 			
									 			<?php
									 			
									 			} 



									 		
									 		} ?>
									 		


									 	<?php	
									 	//booktime and return time is not in same day

									 	while($data2  = mysqli_fetch_array($avail2)){
									 			
									 			$book  = $data2['booking_time'];
									 			$book2 = strtotime($book);
									 			 $book3 = date('Y-m-d',$book2);
									 			$return = $data2['return_time'];
									 			$car   = $data2['car_number'];
									 			$return2 = strtotime($return);
									 			$return3 = date('Y-m-d',$return2);
									 			
									 			//booktime not on the given date
									 			if ($car_name== $car && (($date3 > $book3)&&( $date3== $return3))) {
									 				$rtime = date('H',$return2);
									 				$upper = $rtime;
									 				for ($i=0; $i <=$upper ; $i++) { ?>
									 					<td style="background-color: red"></td>
									 			<?php	}
									 			

									 		}
									 		//date is between booking time and return time
									 		elseif ($car_name==$car && ($date3>$book3) && ($date3<$return3)) {
									 		for ($i=0; $i <24 ; $i++) { ?>
									 		 	<td style="background-color: red"></td>
									 	<?php	 } 
									 		
									 		//booking time is in given date but not return time
									 			
									 		}
									 		elseif ($car_name == $car && ($date3==$book3) &&($date3<$return3)) {
									 			$btime  = date('H',$book2);
									 			$lower = $btime;
									 			$upper ='23';
									 			for($i=0;$i<$lower;$i++) { ?>
									 				 <td></td>
									 				<?php
									 			}
									 			for ($i=$lower-1; $i <$upper ; $i++) { ?>
									 				<td style="background-color: red"></td>
									 		<?php	}
									 		}
									 			}

									 }


									 		  ?>
									 				

									 				</td>
									 			</tr>
									 				<?php } ?>
									 	<?php	}
									 		?>
									 	
		
									 	</tbody>

									 </table>
									</div>
									
									 <div class="col-lg-12">
									 	<input type="submit" name="check" value="Check Availibility" class="btn btn-primary btn-block">
									 </form>
									 	
									 </div>

									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

 
<?php

 include('inc/footer.php'); ?>
<?php include('inc/end.php'); ?>