<?php
//Test Changing
include('inc/head.php');

$customFunction->userAdmin();  //checking if user is looged in
//place page id beofre navigation
$page_id = "index";

include('inc/navigation.php');
?>

<section id="top-logo">

    <div class="container">

        <div class="row">

            <!-- Show user name and PHP code is saved in header.php -->
            <p style="text-align: center">Welcome <strong><?php echo $username ?>!</strong></p>
            
        </div>

    </div>
</section>

<section id="primary-menu">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if (isset($user_id_admin)) { ?>

        <!--<span style="margin-right: 20px;" class="glyphicon glyphicon-tasks"></span>-->
                    <a class="btn btn-block btn-lg btn-primary" href="car_availability.php">Check Availability</a>
                    <a class="btn btn-block btn-lg btn-primary" href="booking.php">Make a Booking</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="manage_booking.php">My Bookings</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="manage_user.php">Manage Users</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="admin_booking_manage.php">Manage All Bookings</a> <!-- Show all bookings -->
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="add_user.php">Add User</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="add_driver.php">Add Driver</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="add_cars.php">Add Car</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="manage_cars.php">Manage Car</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="assign_job.php">Assign job</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="user_settings.php">Settings</a>
                     <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="map_view.php">Map View</a>
                    <!--  <a class="btn btn-primary btn-block d-block" href="logout.php">Logout</a> -->
                    <?php
                } else {
                    ?>
                    <a class="btn btn-block btn-lg btn-primary" href="car_availability.php">Check Availability</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="booking.php">Make a Booking</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="manage_booking.php">My Bookings</a>
                    <a class="btn3d btn btn-primary btn-lg btn-block d-block" href="user_settings.php">Settings</a>
                   
                <?php } ?>



            </div>
        </div>

    </div>
</section>

<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>



