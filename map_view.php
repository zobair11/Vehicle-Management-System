
<?php
//Test Changing
include('inc/head.php');

$customFunction->isLoginAdmin();  
$page_id = "map_view";

include('inc/navigation.php');
?>

 <style>
           
            #map-canvas {
                height: 700px;
                width: 100%;
            }
            #iw_container .iw_title {
                font-size: 16px;
                font-weight: bold;
            }
            .iw_content {
                padding: 15px 15px 15px 0;
                line-height: 22pt;
                font-size: 14px;
            }
        </style>
              <div class="container">
                <div class="row">
                     <script src="http://maps.google.com/maps/api/js?key=AIzaSyDU4fckp4SLe0i0z_dBdFqtbhliyNLBc80&sensor=false" 
        type="text/javascript"></script>
        <div id="map-canvas"/></div>
        <script type="text/javascript">
            // necessary variables
            var map;
            var infoWindow;

            // markersData variable stores the information necessary to each marker
            var markersData = [
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vms";
//Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT
locations.locations,
locations.latitude,
locations.longitude,
locations.id,
bookings.job_number,
bookings.pickup,
bookings.booking_time,
bookings.job_start_time,
bookings.job_finish_time,
bookings.destination,
bookings.car_number,
bookings.return_time
FROM bookings INNER JOIN locations ON locations.locations = bookings.pickup
WHERE bookings.job_start_time IS NOT NULL AND bookings.job_finish_time IS NULL");

$number_of_rows = mysqli_num_rows($result);
// echo $nr;

for ($i = 0; $i <= $number_of_rows; $i++) {
    while ($result2 = mysqli_fetch_array($result)) {
        $id = $result2['id'];
        $latitude = $result2['latitude'];
        $longitude = $result2['longitude'];
        $job_number = $result2['job_number'];
        $pickup = $result2['pickup'];
        $booking_time = $result2['booking_time'];
        $job_start_time = $result2['job_start_time'];
        $return_time = $result2['return_time'];
        $destination = $result2['destination'];
        $car_number = $result2['car_number'];
        $marker_label = substr($car_number, 5);
        ?>
                        {
                            lat: <?php echo $latitude; ?>,
                            lng: <?php echo $longitude; ?>,
                            markerlabel: '<?php echo $marker_label; ?>',
                            jobnumber: '<?php echo $job_number; ?>',
                            destination: '<?php echo $destination; ?>',
                            booking_time: '<?php echo $booking_time; ?>',
                            returntime: '<?php echo $return_time; ?>',
                            carnumber: '<?php echo $car_number; ?>'
                        },
    <?php }
}
?>

            ];


            function initialize() {
                var mapOptions = {
                    center: new google.maps.LatLng(-8.913803, 13.190439),
                    zoom: 18,
                    mapTypeId: 'roadmap',
                };

                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                // a new Info Window is created
                infoWindow = new google.maps.InfoWindow();

                // Event that closes the Info Window with a click on the map
                google.maps.event.addListener(map, 'click', function () {
                    infoWindow.close();
                });

                // Finally displayMarkers() function is called to begin the markers creation
                displayMarkers();
            }
            google.maps.event.addDomListener(window, 'load', initialize);


            // This function will iterate over markersData array
            // creating markers with createMarker function
            function displayMarkers() {

                // this variable sets the map bounds according to markers position
                var bounds = new google.maps.LatLngBounds();

                // for loop traverses markersData array calling createMarker function for each marker 
                for (var i = 0; i < markersData.length; i++) {

                    var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
                    var carnumber = markersData[i].carnumber;
                    var markerlabel = markersData[i].markerlabel;
                    var jobnumber = markersData[i].jobnumber;
                    var destination = markersData[i].destination;
                    var booking_time = markersData[i].booking_time;
                    var returntime = markersData[i].returntime;

                    createMarker(latlng, markerlabel, jobnumber, destination, booking_time, returntime, carnumber);

                    // marker position is added to bounds variable
                    bounds.extend(latlng);
                }

                // Finally the bounds variable is used to set the map bounds
                // with fitBounds() function
                map.fitBounds(bounds);
            }
            
            
                         
            // This function creates each marker and it sets their Info Window content
            function createMarker(latlng, markerlabel, jobnumber, destination, booking_time, returntime, carnumber) {
                var marker = new google.maps.Marker({
                    map: map,
                    label: {text: markerlabel, color: "white"},
                   // label: markerlabel,
                    position: latlng,
                   // icon: 'http://inclinition.com/wp-content/uploads/2016/11/marker-map.png',
                    title: carnumber
                });

                // This event expects a click on a marker
                // When this event is fired the Info Window content is created
                // and the Info Window is opened.
                
                google.maps.event.addListener(marker, 'click', function () {

                    // Creating the content to be inserted in the infowindow
                    var iwContent = '<div id="iw_container">' +
                            '<div class="iw_title">'+ carnumber+'</div>' 
                            +'<div class="iw_content">'+'<strong>Destination:</strong> ' + destination + '<br />' 
                            +'<strong>Booking Time: </strong>'+booking_time + '<br />'
                            +'<strong>Possible Return Time: </strong>'+returntime + '</div></div>';

                    // including content to the Info Window.
                    infoWindow.setContent(iwContent);

                    // opening the Info Window in the current map and at the current marker location.
                    infoWindow.open(map, marker);
                });
            }
             function myClick(label){
            google.maps.event.trigger(markers[label], 'click');
        }
        </script>

                     
                    </div>
                  </div>

                

