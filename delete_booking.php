<?php
include('inc/head.php');
$customFunction->userAdmin();
$page_id = "delete_booking";
include('inc/navigation.php');

?>


<div id="wrap">

    <div id="wrapper">
        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
             <div class="col-md-12">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12"> 
                    <?php
                    $b_id = (int) $_GET['id'];


                    $customFunction = new CustomFunction();

                    if (isset($_POST['delete']) && $_POST['delete'] == 'YES') {

                        // $column_name = array('is_cancelled', 'cancelled_time', 'cancelled_by');

                                    
                        //     $column_value = array('1', now(), '$u_id');

                                    
                                    
                                    
                        //     $query = $customFunction->updateData('bookings', $column_name, $column_value, 'id', $b_id); 
                        if (isset($user_id_normal)) {
                                $u_id = $user_id_normal;
                            } else {
                                $u_id = $user_id_admin;
                            }

                        $query = mysqli_query( $connection, "UPDATE bookings SET is_cancelled='1', cancelled_time=now() , cancelled_by = '$u_id' WHERE id = '$b_id' ");


                        if ($query) {
                            echo "<div class='alert alert-success'>Booking canceled</div>";
                            $customFunction->redirect('manage_booking.php');
                        } else {
                            echo "<div class='alert alert-danger'>Something went wrong.</div>";
                            echo mysqli_error($connection);
                        }
                    } elseif (isset($_POST['delete']) && $_POST['delete'] == 'NO') {
                        $customFunction->redirect('manage_booking.php');
                    }
                    ?>                  
                    <h3>Are you sure to cancel this Booking</h3>
                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$b_id"; ?>">
                        <div class="form-group">                            
                            <input type="submit" name="delete" value="YES" class="btn btn-danger">
                            <input type="submit" name="delete" value="NO" class="btn btn-success">
                        </div>                       
                    </form>
                </div>               
            </div>           
        </div> 
 

<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>