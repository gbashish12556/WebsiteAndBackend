<?php include(ACTION_PATH."register_vehicle_action.php");?>
<script>
        function initialize() {
        var input = document.getElementById('vehicle_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //alert(place.geometry.location.lat());
            //document.getElementById('vehicle_locationcity').value = place.name;
            document.getElementById('vehicle_locationLat').value = place.geometry.location.lat();
            document.getElementById('vehicle_locationLng').value = place.geometry.location.lng();
            //alert($('#vehicle_locationLat').val());
            //alert($('#vehicle_locationLng').val());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>

<section class="section  body_gray_bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="main_heading super  text-center">Register Vehicle</h1>
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
        <div class="col-sm-12">
          <br/>
          <br/>
          <form id="vehicle_register_form" name="vehicle_register_form" class="form-horizontal form padding-top-bottom-10" action="" method="post" >
                            <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                <label for="name" class="col-sm-5 control-label text-left">Owner's Name*</label>
                                <div class="col-sm-7 reg_form_div"><input name="owner_name" type="text" id="owner_name" class="form-control required customvalidation" maxlength="<?php loader_display(NAME_MAXLEN)?>" value= "<?php loader_display($owner_name)?>"/></div>
                               </div>
                              <div class="col-sm-6">
                                <label for="mobile_no" class="col-sm-5 control-label text-left">Owner's Contact No *</label>
                                <div class="col-sm-7 reg_form_div"><input name="owner_mobile_no" type="text" id="owner_mobile_no" maxlength="<?php loader_display(MOBILE_MAXLEN)?>" minlength="<?php loader_display(MOBILE_MINLEN)?>" class="form-control required numeric mobile_no" value= "<?php loader_display($owner_mobile_no)?>"/></div>
                                </div>
                              </div>    
                           </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                <label for="name" class="col-sm-5 control-label text-left">Drivers's Name*</label>
                                <div class="col-sm-7 reg_form_div"><input name="driver_name" type="text" id="driver_name" class="form-control required customvalidation" maxlength="<?php loader_display(NAME_MAXLEN)?>" value= "<?php loader_display($driver_name)?>"/></div>
                               </div>
                              <div class="col-sm-6">
                                <label for="surname" class="col-sm-5 control-label text-left">Drivers's Contact No *</label>
                                <div class="col-sm-7 reg_form_div"><input name="driver_mobile_no" type="text" id="driver_mobile_no" class="form-control required mobile_no"  maxlength="<?php loader_display(MOBILE_MAXLEN)?>" minlength="<?php loader_display(MOBILE_MINLEN)?>" value= "<?php loader_display($driver_mobile_no)?>"/></div>
                                </div>
                              </div>    
                           </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                   <label for="vehicle_type" class="col-sm-5 control-label text-left">Vehicle*</label>
                                    <div class="col-sm-7 reg_form_div">
                                        <?php get_vehiclelist(); ?>
                                    </div>
                                   </div>    
                              <div class="col-sm-6">
                                <label for="name" class="col-sm-5 control-label text-left">Vehicle No*</label>
                                <div class="col-sm-7 reg_form_div"><input name="vehicle_no" type="text" id="vehicle_no"  class="form-control required truck_no" maxlength="<?php loader_display(VEHICLE_NO_MAXLEN)?>" minlength="<?php loader_display(VEHICLE_NO_MINLEN)?>" value= "<?php loader_display($vehicle_no)?>"/></div>
                               </div>                             
                              </div>    
                           </div>
                           <div class="form-group">
                                <div class="col-sm-12">
                                   <div class="col-sm-6">
                                <label for="surname" class="col-sm-5 control-label text-left">Location*</label>
                                  <div class="col-sm-7 reg_form_div" >
                                  <input name="vehicle_location" type="text" id="vehicle_location" class="form-control required" value= "<?php loader_display($vehicle_location)?>" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />
                                  </div>
                                   <input type="hidden" id="vehicle_locationLat" name="vehicle_locationLat" value= "<?php loader_display($vehicle_locationLat)?>" />
                                   <input type="hidden" id="vehicle_locationLng" name="vehicle_locationLng" value= "<?php loader_display($vehicle_locationLng)?>" />  
                                </div> 
                                   <div class="col-sm-6">
                                   </div>
                                </div>
                            </div>
                          <?php loader_set_session('form_session',rand(10,10000));?>
                          <input type="text" name="session" id="session" value="<?php loader_display(loader_get_session('form_session'));?>" hidden/>
                          <div class="form-group text-center">
                              <div class="">
                                <input type="submit" id="contact_button" class="btn btn-large btn-default"  value="Register">
                              </div> 
                          </div>
                       </form>    
          </div>
        </div>
</section>        
