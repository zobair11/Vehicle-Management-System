<script type="text/javascript">

    function checkAvailability() {

        var isupdate = $("#isupdate").val();
        var rowID = $("#rowID").val();
        var destination = $("#destination").val();
        var other_destination = $("#input_other_destination").val();
        var carnumber = $("#carnumber").val();
        var bookingtime = $("#bookingtime").val();
        var returntime = $("#returntime").val();
        var pickup = $("#pickup").val();
        var other_pickup = $("#input_other_pickup").val();
        var job_type = document.getElementsByName('job_type').value;

        $.ajax({
            type: "POST",
            url: "booking_check_submit.php",
            data: {
                "isupdate": isupdate,
                "rowID": rowID,
                "destination": destination,
                "other_destination": other_destination,
                "carnumber": carnumber,
                "bookingtime": bookingtime,
                "returntime": returntime,
                "job_type": job_type,
                "pickup": pickup,
                "other_pickup": other_pickup
            },
            cache: false,
            success: function (data) {
                // RCV error from booking_check_submit.php and show error on car unaviablity.
                if (data == "Error!") {
                   document.getElementById("txtHint").innerHTML = '<div class="alert alert-danger"><strong>'+carnumber+'</strong> - is not avaialable on above selected time.</div>';
                } else {
                    //No Error ? Redirect to Success.
                    window.location.href = 'success.php';
                }

                //window.alert(data);
            },
            error: function (err) {
                alert(err);
            }
        });
    }

</script>

<script type="text/javascript">

    // Booking form validation
    $(document).ready(function () {

        $('#submit').click(function (e) {
            e.preventDefault();

//        //checking if the custom location is active

//            if ( $("#destination").val() != "other_destination") {
//                var destination = $("#destination").val();
//            }
//            else{
//                var destination = $("#input_other_destination").val();
//            }
//            if ( $("#pickup").val() != "other_pickup") {
//                var pickup = $("#pickup").val();
//            }
//            else{
//                var pickup = $("#input_other_pickup").val();
//            }

            var destination = $("#destination").val();
            var other_destination = $("#input_other_destination").val();
            var carnumber = $("#carnumber").val();
            var bookingtime = $("#bookingtime").val();
            var returntime = $("#returntime").val();
            var job_type = document.getElementsByName('job_type').value;
            var pickup = $("#pickup").val();
            var other_pickup = $("#input_other_pickup").val();

            $.ajax({
                type: "POST",
                url: "booking_validation.php",
                dataType: "json",
                data: {destination: destination, other_destination: other_destination, job_type: job_type, carnumber: carnumber, bookingtime: bookingtime, returntime: returntime, pickup: pickup, other_pickup: other_pickup},
                success: function (data) {

                    if (data.code == "200") {

                        //alert(data);
                        // Data code return 200, so let's check car aviability by calling function and show conflict msg if any.
                        checkAvailability();

                    } else {
                        $(".display-error").html("<ul>" + data.msg + "</ul>");
                        $(".display-error").css("display", "block");
                    }
                }
            });


        });
    });
</script>