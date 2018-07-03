
<script type="text/javascript">

//Top Navigation JS
$(document).ready(function() {
    $('a[href="#navbar-more-show"], .navbar-more-overlay').on('click', function(event) {
		event.preventDefault();
		$('body').toggleClass('navbar-more-show');
		if ($('body').hasClass('navbar-more-show'))	{
			$('a[href="#navbar-more-show"]').closest('li').addClass('active');
		}else{
			$('a[href="#navbar-more-show"]').closest('li').removeClass('active');
		}
		return false;
	});
});

// Success page animation
var loader = document.getElementsByClassName('loader')

document.addEventListener('click', function(){
  toggleClass('done', loader[0])
})

window.setInterval(function(){
  toggleClass('done', loader[0])
}, 4500)

function toggleClass(toggleClassName, target) {
  var currentClassName = ' ' + target.className + ' '
  if (~currentClassName.indexOf(' ' + toggleClassName + ' ')) {
    target.className = currentClassName.replace(' ' + toggleClassName + ' ', ' ').trim()
  } else {
    target.className = (currentClassName + ' done').trim()
  }
}


//Bottom Popup Menu
var ops = {
    'html':true,    
    content: function(){
        return $('#content').html();
    }
};


$(function(){
    $('#example').popover(ops)

});

function hide(){
  $('#example').popover('hide');
}


var dateToday = new Date();
var todayDate = dateToday.getDate();
var todayMonth = dateToday.getMonth()+1;
var todayYear  = dateToday.getFullYear();
var todayDateMonthYear = todayDate+'-'+todayMonth+'-'+todayYear;

var minutes = dateToday.getMinutes();
$( function() {
    $( "#date" ).datepicker({
      dateFormat: 'yy-mm-dd',
      minDate   : dateToday
    });
  } );


//Calender control
//here passing the $minutes_steps from glabalvariable to times_steps
var times_steps = <?php echo $minutes_steps; ?>

    $("#bookingtime").datetimepicker({

      
      //if(checkIfToday==dateToday){
      //minTime : 0},
      step: times_steps,
      //minDate: -0,
      minDateTime: new Date()
   
      

    });

       $("#jobassigndate").datepicker({ 
      minDate: new Date()

    });

     $("#jobassigndate").change(function(){
      var jobdate = ("$jobassigndate").val();

        $(".pushdate").val(jobdate);
     });



    
     

 // $("#shiftstarttimepicker").datetimepicker({ 
 //      datepicker:false,
 //      step: 10
 //    });

    //var checkIfToday  = $("#bookingtime").val();
      //alert(checkIfToday);

    
    $("#bookingtime").change(function() {
      //alert(todayDateMonthYear);
      //if ("#bookingtime").val() {}
      
      //Load day limits on booking from globalveriables.php
      var day_limits = <?php echo $day_limits ?>;   
      var dateBooking =  $("#bookingtime").val();
      
      //var format2 = strtodate(dateBooking);
      //var format = new Date(dateBooking,'YYYY-MM-DD');
      //alert(format);
      var maxdays = new Date(dateBooking);
      var sixDaysAfterBooking = maxdays.setDate(maxdays.getDate() + day_limits);
      //alert(dateToday);
      
      $("#returntime").datetimepicker({
        
        step: times_steps,
        minDate: dateBooking,
        maxDate: sixDaysAfterBooking,
        //minDate: -0,
        minDateTime: new Date()

      });
    });


  
  
  // Form Radio for Self Drive
 $(function() {
    // Input radio-group visual controls
    $('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
});

</script>

