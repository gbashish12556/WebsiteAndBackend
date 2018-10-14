<?php include(ACTION_PATH.'get_quote_action.php');?>
<script type="text/javascript">
	//intialize place dropdown 1
            function initializ1() {
        var input = document.getElementById('drop_point');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //alert(place.name);
            //document.getElementById('dropcity2').value = place.name;
            document.getElementById('dropLat').value = place.geometry.location.lat();
            document.getElementById('dropLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initializ1); 
	//intialize place dropdown 2
    function initialize() {
        var input = document.getElementById('pickup_point');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //alert(place.name);
            //document.getElementById('pickupcity2').value = place.name;
            document.getElementById('pickupLat').value = place.geometry.location.lat();
            document.getElementById('pickupLng').value = place.geometry.location.lng();
            //alert($('#pickupLat').val());
            //alert($('#pickupLng').val());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
	   jQuery(function(){
       // jQuery('#datetime3').datetimepicker();
			jQuery('#datetime3').datetimepicker({
				format:'d/m/Y g:i a',
				minDate:'+1970/01/01',
				maxDate:'+1970/01/08',
				pick12HourFormat: false   
			});
	
        });	
</script>
<section class="section  body_gray" >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="main_heading super  text-center">Get Quote</h1>
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
<section class="section-page-short" id="get_quote_section">
    <div class="container">
        <div class="col-sm-12">
          <br/>
          <br/>
          <form id="get_quote_form" class="form-horizontal form" method="POST" action="<?php loader_display(ROOT_PATH.'confirm_booking')?>">
                            <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                <label for="name" class="col-sm-5 control-label text-left">Name*</label>
                                <div class="col-sm-7 reg_form_div"><input name="name" type="text" id="name" maxlength="<?php loader_display(NAME_MAXLEN)?>" class="form-control required customvalidation" value= "<?php loader_display($name)?>"/></div>
                               </div>
                              <div class="col-sm-6">
                                <label for="mobile_no" class="col-sm-5 control-label text-left">Mobile No *</label>
                                <div class="col-sm-7 reg_form_div"><input name="mobile_no" type="text" id="mobile_no" maxlength="<?php loader_display(MOBILE_MAXLEN)?>" minlength="<?php loader_display(MOBILE_MINLEN)?>" class="form-control required numeric mobile_no" value= "<?php loader_display($mobile_no)?>"/></div>
                                </div>
                              </div>    
                           </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                <label for="pickup_point" class="col-sm-5 control-label text-left">Pick Up Point*</label>
                                <div class="col-sm-7 reg_form_div"><input name="pickup_point" id="pickup_point" class="form-control required" value= "<?php loader_display($pickup_point)?>"   type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" /></div>

                                <input type="hidden" id="pickupLat" name="pickupLat" />
                                <input type="hidden" id="pickupLng" name="pickupLng" />  
                               </div>
                              <div class="col-sm-6">
                                <label for="drop_point" class="col-sm-5 control-label text-left">Drop Point *</label>
                                  <div class="col-sm-7 reg_form_div"><input name="drop_point" id="drop_point" class="form-control required" value= "<?php loader_display($drop_point)?>" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" /></div>
                                <input type="hidden" id="dropLat" name="dropLat" />
                                <input type="hidden" id="dropLng" name="dropLng" />  
                                  
                                </div>
                              </div>    
                           </div>

                          <div class="form-group">
                              <div class="col-sm-12">
                                <div class="col-sm-6">
                                  <label for="datetime" class="col-sm-5 control-label text-left">Date Time *</label>
                                    <div class="col-sm-7 reg_form_div"><input name="datetime3" type="text" id="datetime3" class="form-control required datetime" value= "<?php loader_display($datetime3)?>"/></div>
                                 </div>
                                <div class="col-sm-6">   
                                  <label for="dob" class="col-sm-5 control-label text-left">Select Vehicle ? *</label>
                                    <div class="col-sm-7 reg_form_div">
                                      <?php get_vehiclelist(); ?>
                                    </div>
                                  </div> 
                              </div>    
                           </div>
                         <div class="form-group text-center">
                            <div class="">
                                <input type="submit" id="get_quote_button" name="get_quote_button" class="btn btn-large btn-default" value="Get Quote" />
                            </div>         
                        </div></br>
                    </form> 
          </div>
        </div>
</section>  

  



