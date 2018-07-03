<?php 
include('inc/head.php');
$CustomFunction->isLoginAdmin();
$page_id = "delete_car";
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
                           
                            $car_id = (int) $_GET['id'];
                            

                            $customFunction = new CustomFunction();

                            if( isset($_POST['delete']) && $_POST['delete'] == 'YES' ) { 

                                $query = $customFunction->deleteData('cars', 'id', $car_id);

                                if( $query ) {
                                    echo "<div class='alert alert-success'>Car deleted</div>";
                                    $customFunction->redirect('manage_cars.php', 3);
                                } else {
                                    echo "<div class='alert alert-danger'>Something went wrong.</div>";
                                    echo mysqli_error($connection);
                                }

                            } elseif( isset($_POST['delete']) && $_POST['delete'] == 'NO' ) {
                                $customFunction->redirect('manage_cars.php');
                            }
                            ?>  
                                        
                    <h3>Are you sure to delete this Car</h3>
                    </div>
                    </div>

                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$car_id"; ?>">
                        <div class="form-group">                            
                            <input type="submit" name="delete" value="YES" class="btn btn-danger">
                            <input type="submit" name="delete" value="NO" class="btn btn-success">
                        </div>                       
                    </form>
                </div>               
            </div>           
        </div> 


  <?php include('inc/footer.php');
  include('inc/end.php');
  ?>



