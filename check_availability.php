<?php
require_once('initial.php');
$database = new Database();
$CustomFunction = new CustomFunction();
$customFunction->userAdmin();
if (!empty($_GET['q'])) {
    $date = $_GET['q'];
} else {
    echo "Invalid Date.";
}
//$date = '2018-01-08';
//echo $date;
;
?>
<style>
    .cross {
	color: red;
        font-weight: 900;
}
</style>

<div style="background-color:#ffffff;" class="table-responsive">
    <table class="table table-striped table-bordered table-hover" border="1" >
        <thead align= "justify">
            <tr>
                <th colspan="25" style="text-align: center;">Time(hours)</th>
            </tr>
        </thead>

        <thead>
            <tr>
                <th style="position: absolute; background-color:#ffffff; ">Vehicles</th>
                <?php for ($header = 0; $header < 24; $header++) { ?>
                    <th><?php
                        echo $header;
                        //printing all hours 
                        ?></th>
                <?php } ?>

            </tr>
        </thead>


        <tbody>

            <?php
            $connection = $database->connect;
            $sql = mysqli_query($connection, "SELECT car_number FROM cars WHERE status='1' ");
            $num_rows = $customFunction->numRows($sql);
            ?>
            <tr>
                <?php
                for ($i = 0; $i < $num_rows; $i++) {
                    while ($allData = mysqli_fetch_array($sql)) {
                        $car_name = $customFunction->inputvalid($allData['car_number']);
                        ?> 
                        <td style="position: absolute; background-color:#ffffff; "><?php echo $car_name // printing all car name;  
                        ?></td>

                        <?php
                        $date2 = strtotime($date);
                        $date3 = date('Y-m-d', $date2);
                        $avail = mysqli_query($connection, "SELECT * FROM bookings WHERE date(booking_time)='$date' AND (job_status ='0' OR job_status IS NULL) ");

                        $avail2 = mysqli_query($connection, "SELECT * FROM bookings WHERE (job_status ='0' OR job_status IS NULL) ");

                        $avail3 = mysqli_query($connection,"SELECT car_number FROM cars WHERE status='1' AND car_number NOT IN (SELECT car_number FROM bookings WHERE date(return_time)='$date' OR date(booking_time)='$date' OR (date(booking_time)<'$date' AND date(return_time)>'$date' ))");

                        while ($data = mysqli_fetch_array($avail)) {
                            $book = $data['booking_time'];
                            $book2 = strtotime($book);
                            $book3 = date('Y-m-d', $book2);
                            $return = $data['return_time'];
                            $car = $data['car_number'];
                            $return2 = strtotime($return);
                            $return3 = date('Y-m-d', $return2);
                            $car = $data['car_number'];
                            $rtime = date('H', $return2); //taking the hour value
                            $rtime;
                            $btime = date('H', $book2);

                            if ($car_name == $car && $book3 == $return3) {
                                //booking nd return in same day
                                $lower = $btime;
                                $upper = $rtime;


                                for ($i = 0; $i < $lower; $i++) {
                                    ?>
                                    <td>-</td>

                <?php } for ($i = $lower - 1; $i < $upper; $i++) {
                    ?>
                                    <td><p class="cross">X</p></td>
                                <?php } 
                                for ($i=$upper+1; $i <24 ; $i++) { ?>
                                    <td>-</td>
                              <?php  }
                                    ?>



                <?php
            }
        }
        ?>

        <?php
        //booktime and return time is not in same day

        while ($data2 = mysqli_fetch_array($avail2)) {

            $book = $data2['booking_time'];
            $book2 = strtotime($book);
            $book3 = date('Y-m-d', $book2);
            $return = $data2['return_time'];
            $car = $data2['car_number'];
            $return2 = strtotime($return);
            $return3 = date('Y-m-d', $return2);

            //booktime not on the given date but return time
            if ($car_name == $car && (($date3 > $book3) && ( $date3 == $return3))) {
                $rtime = date('H', $return2);
                $upper = $rtime;
                for ($i = 0; $i < $upper+1; $i++) {
                    ?>
                                    <td><p class="cross">X</p></td>
                                    <?php
                                }
                                for ($i=$upper+1; $i <24 ; $i++) { ?>
                                    <td>-</td>
                             <?php   }
                            }
                            //date is between booking time and return time
                            elseif ($car_name == $car && ($date3 > $book3) && ($date3 < $return3)) {
                                for ($i = 0; $i < 24; $i++) {
                                    ?>
                                  <td><p class="cross">X</p></td>
                                    <?php
                                }

                                //booking time is in given date but not return time
                            } elseif ($car_name == $car && ($date3 == $book3) && ($date3 < $return3)) {
                                $btime = date('H', $book2);
                                $lower = $btime;
                                $upper = '23';
                                for ($i = 0; $i < $lower; $i++) {
                                    ?>
                                    <td>-</td>
                                    <?php
                                }
                                for ($i = $lower - 1; $i < $upper; $i++) {
                                    ?>
                                    <td><p class="cross">X</p></td>
                                    <?php
                                }
                            }

                       
                          
                        }
                        while ($data3 = mysqli_fetch_array($avail3)) {
                            $car = $data3['car_number'];

                            if ($car_name == $car) { 
                                for($i=0;$i<24;$i++){ ?>
                               
                                    <td>-</td>
                                    <?php
                                }
                            }
                        }
                        
                        ?>


                       
                    </tr>
    <?php } 
 }
?>


        </tbody>

    </table>
</div>