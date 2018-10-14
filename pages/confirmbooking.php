<?php include(ACTION_PATH.'confirm_booking_action.php'); ?>
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
	var start = '<?php loader_display($pickup_point)?>';
	var end = '<?php loader_display($drop_point)?>';
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
	jQuery(function(){
		jQuery('#datetime').datetimepicker({
			format:'d/m/Y h:m a',
			minDate:'+1970/01/01',
			maxDate:'+1970/01/08',
			pick12HourFormat: false
		});
	});
</script>
<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Confirm Booking</h1>
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
<section class="section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              <div class="col-sm-6 custom_box">
                  <form class="form-horizontal form" action = "<?php loader_display(ROOT_PATH.'trackorder'); ?>" method="POST" >
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Name*</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control required" maxlength="<?php loader_display(NAME_MAXLEN)?>" value="<?php loader_display($name)?>" />
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Date&Time*</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="datetime" id="datetime" class="form-control required" value="<?php loader_display($datetime3)?>"/>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Fare(approx)</span></label>
                             </div>
                             <div class="col-sm-3">
                                <input type="text" name="fare_min" id="fare_min" class="form-control required" value="<?php loader_display($fare_min)?>" readonly="readonly"/>
                             </div>
                             <div class="col-sm-1">
                             <p><strong>_</strong></p>
                             </div>
                             <div class="col-sm-3">
                                <input type="text" name="fare_max" id="fare_max" class="form-control required" value="<?php loader_display($fare_max)?>" readonly="readonly"/>
                             </div>
                             <div class="col-sm-2">
                                <label><span>Rs.</span></label>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Contact No</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control required" maxlength="<?php loader_display(MOBILE_MAXLEN)?>" minlength="<?php loader_display(MOBILE_MINLEN)?>" value="<?php loader_display($mobile_no)?>" readonly="readonly"/>
                             </div>
                        </div>
                        <!--VEHICLE TYPE DISPLAY FIELD-->
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Vehicle Type</span></label>
                             </div>
                             <div class="col-sm-9">
                                <select name="vehicle_type" id="vehicle_type" class="form-control required numeric"  readonly="readonly"/>
                                   <?php loader_display(get_vehicletype($vehicle_type))?> ?>
                                </select>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Pickup Point</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="pickup_point" id="pickup_point" class="form-control" value="<?php loader_display($pickup_point)?>" readonly="readonly"/>
                                <!-- <input type="hidden" id="pickupLat" name="pickupLat" value="<?php loader_display($pickupLat)?>"/>
                                <input type="hidden" id="pickupLng" name="pickupLng" value="<?php loader_display($pickupLng)?>"/> -->
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Drop off Point</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="drop_point" id="drop_point" class="form-control" value="<?php loader_display($drop_point)?>" readonly="readonly"/>
                                <!-- <input type="hidden" id="dropLat" name="dropLat" value="<?php loader_display($dropLat)?>"/>
                                <input type="hidden" id="dropLng" name="dropLng" value="<?php loader_display($dropLng)?>"/> -->
                             </div>
                        </div>

                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Distance(approx)</span></label>
                             </div>
                             <div class="col-sm-7">
                                <input type="text" name="distance" id="distance" class="form-control required" value="<?php loader_display($distance)?>" readonly="readonly"/>
                             </div>
                             <div class="col-sm-2">
                                 <label><span>km.</span></label>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-3">
                                <label for="from_location"><span>Time(approx)</span></label>
                             </div>
                             <div class="col-sm-9">
                                <input type="text" name="actual_time" id="actual_time" class="form-control required" value="<?php loader_display($actual_time)?>" readonly="readonly"/>
                             </div>
                        </div>
                        <?php loader_set_session('form_session',rand(10,10000));?>
                        <input type="text" name="session" id="session" value="<?php loader_display(loader_get_session('form_session'));?>" hidden/>
                        <div class="form-group text-center">
                            <div class="">
                                <input type="submit" onclick="ga('send','event','confirmbooking_button_click','clicked','confirmbooking_form','1')" id="confirm_booking" name="confirm_booking" class="btn btn-large btn-default" value="Confirm Booking" />
                            </div>
                        </div>
                  </form>
              </div>
              <div class="col-sm-6 custom_box">
                  <div class="form-group">
                      <div class="margin-top-5 sub_box map" id="map_canvas" >
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</section>
