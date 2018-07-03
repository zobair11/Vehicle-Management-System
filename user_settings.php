<?php include('inc/head.php');
$CustomFunction->userAdmin();
$page_id = "settings";
include('inc/navigation.php'); ?>


<section id="top-logo">

    <div class="container">

        <div class="row">
            <p style="text-align: center">User Settings<strong><?php // Add User Name echo  "$user_name";?></strong></p>
        </div>

    </div>
</section>

<section id="primary-menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
               
                <a class="btn btn-primary btn-lg btn-block d-block" href="update_user_settings.php">Update Profile</a>
                <a class="btn btn-primary btn-lg btn-block d-block" href="logout_user.php">Logout</a>
                 <?php if (isset($user_id_admin)) { ?>
                <a class="btn btn-primary btn-lg btn-block d-block" href="update_parameter.php">Update Parameters</a>
                <?php } ?>

            </div>
        </div>


    </div>
</section>

<?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>



