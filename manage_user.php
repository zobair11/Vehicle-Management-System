<?php
include('inc/head.php');
include('inc/navigation.php');
$CustomFunction->isLoginAdmin();

        $page_id = "admin";

        include('inc/navigation.php');
        ?>
        <div class="row">
            <div class="col-md-12" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php


                        $allData = mysqli_query($connection, "SELECT * FROM user_info ");
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
                                        <th>User Id</th>                     
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Password</th>        
                                        <th>Role</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    for ($i = 1; $i <= $num_rows; $i++) {

                                        while ($user = mysqli_fetch_array($allData)) {
                                            $u_id = (int) $user['user_id'];
                                            $first_name = $user['first_name'];
                                            $last_name = $user['last_name'];
                                            $user_name = $user['user_name'];
                                            $email = $user['email'];
                                            $password = $user['password'];
                                            $role = $user['role'];
                                            ?>
                                            <tr>


                                                <td><?php echo $u_id; ?></td>
                                                <td><?php echo $first_name; ?></td>

                                                <td><?php echo $last_name; ?></td>
                                                <td><?php echo $user_name ?></td>            
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $password ?></td>
                                                <td><?php echo $role ?></td>
                                                <td><?php echo "<a href='edit_user.php?user_id=$u_id'>Edit</a> | <a href='delete_user.php?user_id=$u_id'>Delete</a>"; ?></td>

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
        <?php include('inc/footer.php'); ?>

<?php include('inc/end.php'); ?>
