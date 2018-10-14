<?php include(ACTION_PATH.'order_status_action.php') ?>
<script>
//display of map
  var directionDisplay;
  var map;

   function initialize3() {
    var directionsService = new google.maps.DirectionsService();  
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var myOptions = {
	  zoom:12,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	directionsDisplay.setMap(map);
	//var distanceInput = document.getElementById("distance");
	var start = '<?php loader_display($from_point)?>';
	var end = '<?php loader_display($to_point)?>';
    var request = {
		origin:start,
		destination:end,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	  };
    directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
		  directionsDisplay.setDirections(response);
		//  distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
         }
	  });
  }
  google.maps.event.addDomListener(window, 'load', initialize3);
</script>
<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Order Status</h1>
        </div>
      </div>
    </div>
</section>
<section>
    <div class="col-sm-12"> 
      <div>
                      <?php
                      if(isset($success_message) && $success_message !="")
                       {  
                       ?>
                       <div class="alert alert-success">
                                    <button data-dismiss="alert" class="close" type="button">close</button>
                                    <?php loader_display($success_message); ?>
                                </div>        
                     <?php  } ?>
      </div>
      <div>
                     <?php
                    if(isset($error_message) &&  $error_message != "")
                    {
                    ?>
                    <div class="alert alert-danger">
                                                 <button data-dismiss="alert" class="close" type="button">close</button>
                                                 <?php loader_display($error_message); ?>
                                         </div>
                  <?php  } ?>
      </div>
  </div>
</section>

<section class="section section-very-short">
  <div class="container">
    <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
                <div class="col-sm-4 text_box">
                      <h3 class="text-center" >Booking Details</h3>
                      <label>Approximate Fare:</label>  <span>Rs. <?php loader_display($total_fare)?></span><br><br>
                      <label>Pickup Point:</label> <span><?php loader_display($from_point)?></span><br><br>
                      <label>Drop Point:</label> <span><?php loader_display($to_point)?></span><br><br>
                      <label>Pickup Date & Time:</label> <span><?php loader_display($booking_datetime)?></span><br><br>
                      <label>Approximate Distance:</label> <span><?php loader_display($total_distance)?> Kms</span><br><br>
                </div>
                <div class="col-sm-4 text_box">
                        <h3 class="text-center" >Vehicle Details</h3></hr>
                        <label class="text-left" >Vehicle No:</label> <span><?php loader_display($vehicle_no)?></span><br><br>
                        <label class="text-left" >Vehicle Type:</label> <?php loader_display($vehicle_name)?><br><br>
                        <label class="text-left" >Driver Name:</label> <span><?php loader_display($driver_name)?></span><br><br>
                        <label class="text-left" >Driver Mobile:</label> <?php loader_display($driver_mobile_no)?><br><br>
                 </div>
                 <div id="map_canvas" class="col-sm-4 text_box">
                 </div>
             </div> 
         </div>
         
         <div class="col-sm-12 table-container"> 
           <?php loader_display($list)?>
         </div>
    </div>
  </div>
</section>         
