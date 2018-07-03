<div class="navbar-more-overlay"></div>
<nav class="navbar navbar-inverse navbar-fixed-top animate">
    <div class="container navbar-more visible-xs">
        <!--
        <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                        <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Submit</button>
                                </span>
                        </div>
                </div>
        </form>-->


    </div>
    <div class="container">
        <?php if (isset($_SESSION['logged_user_normal']) && $_SESSION['logged_user_normal'] != '' || isset($_COOKIE['logged_user_normal'])) { ?>
            <div class="navbar-header hidden-xs visible-xs">
                <a class="navbar-brand" href="index.php"></a>
            </div>

            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                    <a href="#">
                        <span class="menu-icon fa fa-automobile"></span>
                        LISA VMS
                    </a>
                </li>
                <?php 
                //condition to show hide back button
                if($page_id !== "index"){
                     echo ' <li class="index">
                    <a href="index.php">
                        <span class="menu-icon fa fa-mail-reply"></span>
                        <span class="hidden-xs">BACK</span>
                        <span class="visible-xs">BACK</span>
                    </a>
                </li>';
                } else {
 };?>
                

                <!--<li class="visible-xs">
                        <a href="#navbar-more-show">
                                <span class="menu-icon fa fa-bars"></span>
                                More
                        </a>
                </li>-->
            </ul>
        <?php } ?>


        <?php if (isset($_SESSION['logged_user_admin']) && $_SESSION['logged_user_admin'] != '' || isset($_COOKIE['logged_user_admin']) ) { ?>
            <div class="navbar-header hidden-xs visible-xs">
                <a class="navbar-brand" href="index.php"></a>
            </div>

            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                    <a href="#">
                        <span class="menu-icon fa fa-automobile"></span>
                        LISA VMS
                    </a>
                </li>

                <?php 
                //condition to show hide back button
                if($page_id !== "index"){
                     echo ' <li class="index">
                    <a href="index.php">
                        <span class="menu-icon fa fa-mail-reply"></span>
                        <span class="hidden-xs">BACK</span>
                        <span class="visible-xs">BACK</span>
                    </a>
                </li>';
                } else {
 };?>


                <!--<li class="visible-xs">
                        <a href="#navbar-more-show">
                                <span class="menu-icon fa fa-bars"></span>
                                More
                        </a>
                </li>-->
            </ul>
<?php } ?>


<?php if (isset($_SESSION['logged_user_driver_general']) && $_SESSION['logged_user_driver_general'] != '' || isset($_COOKIE['logged_user_driver_general']) ) { ?>
            <div class="navbar-header hidden-xs visible-xs">
                <a class="navbar-brand" href="manage_general_job.php"></a>
            </div>

            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                    <a href="#">
                        <span class="menu-icon fa fa-automobile"></span>
                        LISA VMS
                    </a>
                </li>

                <li>
                    <a href="manage_general_job.php">
                        <span class="menu-icon fa fa-mail-reply"></span>
                        
                    </a>
                    
                </li>
                <li>
                    <a href="logout_driver.php">
                        <span class="menu-icon fa fa-automobile"></span>

                    Logout</a>
                </li>


                <!--<li class="visible-xs">
                        <a href="#navbar-more-show">
                                <span class="menu-icon fa fa-bars"></span>
                                More
                        </a>
                </li>-->
            </ul>
<?php } ?>

<?php if (isset($_SESSION['logged_user_driver_shuttle']) && $_SESSION['logged_user_driver_shuttle'] != '' || isset($_COOKIE['logged_user_driver_shuttle']) ) { ?>
            <div class="navbar-header hidden-xs visible-xs">
                <a class="navbar-brand" href="manage_shuttle_job.php"></a>
            </div>

            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                    <a href="#">
                        <span class="menu-icon fa fa-automobile"></span>
                        LISA VMS
                    </a>
                </li>

                <li>
                    <a href="manage_shuttle_job.php">
                        <span class="menu-icon fa fa-mail-reply"></span>
                        
                    </a>
                    
                </li>
                <li>
                    <a href="logout_driver.php">
                        <span class="menu-icon fa fa-automobile"></span>

                    Logout</a>
                </li>


                <!--<li class="visible-xs">
                        <a href="#navbar-more-show">
                                <span class="menu-icon fa fa-bars"></span>
                                More
                        </a>
                </li>-->
            </ul>
<?php } ?>




    </div>
</nav>