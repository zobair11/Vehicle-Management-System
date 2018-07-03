<?php
require_once 'inc/head.php';
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
                                    <h2 style="text-align: center;">Schedules of Vehicles by Date</h2>
                                    <h4 style="text-align: center;">Please select a date to see the schedules</h4>
                                </div>
                                
                                    <div class="col-lg-12">
                                        <label>Select Date</label>
                                        <input class="form-control input-sm" readonly="" type="text" name="date" onchange="showAvaiability(this.value)" id="date">
                                    </div>
                                    <div class="col-lg-12">

                                        <!-- table starts here !-->
                                

                                        <div class="col-lg-12" id="data">
                                           
                                           

                                        </div>

                                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showAvaiability(str) {
    if (str == "") {
        document.getElementById("data").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","check_availability.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<!-- Don't want to show the footer -->
<?php //include('inc/footer.php'); ?>
<?php include('inc/end.php'); ?>