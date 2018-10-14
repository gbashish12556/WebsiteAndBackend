<?php $name = $mobile_no = $pickup_point = $drop_point = $datetime3 = ""; ?>
<script type="text/javascript">
	//intialize place dropdown 1
            function initializ1() {
        var input = document.getElementById('drop_point');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //alert(place.name);
            //document.getElementById('dropcity2').value = place.name;
            //**document.getElementById('dropLat').value = place.geometry.location.lat();
            //**document.getElementById('dropLng').value = place.geometry.location.lng();
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
            //**document.getElementById('pickupLat').value = place.geometry.location.lat();
            //**document.getElementById('pickupLng').value = place.geometry.location.lng();
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
<meta name="google-site-verification" content="e4ThV_fpr176RnEt9vaLzk-0dhTZQGAd5qRKpZP34BY" />
 <!--Start Carousel-->
 <section id="section_main">
     <div class="container">
          <div class="row">
             <div class="form-group text-center">
               <div class="col-sm-3">
               </div>
               <div class="col-sm-6">
               <div class="main_form">
                 <div class="main_page_heading padding-top-5">
                   <div class="text-main-page">
                    <h2 id="home_heading1">TheShipper</h2>
                   </div>
                    <div class="text-main-page">
                    	<h2>Easiest way to book a Mini-Truck</h2>
                    </div>
                    <div class="text-main-page">
                        <h3 id="home_heading3">Call or Whatsapp : 0<?php loader_display(COMPANY_NO)?> </h3>
                    </div>
                    <br/>
               </div>
                 <div class="vehicle_image" hidden>
                    <img id="vehicle_image" alt="image" src="#" />
                  </div>
                 <div>
                    <form id="get_quote_form" class="form-horizontal form" method="POST" action="<?php loader_display(ROOT_PATH.'confirmbooking')?>">
                          <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6 margin-bottom-10">
                                <div class="reg_form_div"><input name="pickup_point" id="pickup_point" class="form-control required" value= "<?php loader_display($pickup_point)?>"   type="text" size="50" placeholder="Pickup Point" autocomplete="on" runat="server" /></div>
                                <!-- <input type="hidden" id="pickupLat" name="pickupLat" />
                                <input type="hidden" id="pickupLng" name="pickupLng" />  -->
                               </div>
                              <div class="col-sm-6">
                                  <div class="reg_form_div"><input name="drop_point" id="drop_point" class="form-control required" value= "<?php loader_display($drop_point)?>" type="text" size="50" placeholder="Drop Off Point" autocomplete="on" runat="server" /></div>
                                <!-- <input type="hidden" id="dropLat" name="dropLat" />
                                <input type="hidden" id="dropLng" name="dropLng" />  -->
                                </div>
                              </div>
                           </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6 margin-bottom-10">
                                    <div class="reg_form_div">
                                      <?php get_vehiclelist(); ?>
                                    </div>
                                  </div>
                              <div class="col-sm-6">
                                    <div class="reg_form_div">
                                        <input name="mobile_no" type="text" id="mobile_no" maxlength="<?php loader_display(MOBILE_MAXLEN)?>" minlength="<?php loader_display(MOBILE_MINLEN)?>" class="form-control required numeric mobile_no" placeholder="Mobile No"  value= "<?php loader_display($mobile_no)?>"/>
                                    </div>
                                </div>
                              </div>
                           </div>
                          <div class="form-group text-center">
                            <div class="">
                                <input type="submit" onclick="ga('send','event','getquote_button_click','clicked','getquote_form','1')" id="get_quote_button" name="get_quote_button" class="btn btn-large btn-default" value="Get Quote" />
                            </div>
                        </div>
                    </form>   <br />
              </div>
               </div>
               </div>
               <div class="col-sm-3">
               </div>
             </div>
          </div>
     </div>
 </section>
 <!--End Carousel-->
<!--start why shipper-->

  <section class="section section-very-short body-green">
        <div class="container text-center">
       		<div class="col-sm-12">
            	<h1 class="general-title">
					<span>Why TheShipper ?</span>
				</h1>
            	<div class="form-group">
		            <div class="col-sm-6">
                        <div class="image-container">
                                <img alt="Call Us" src="images/whyus_image.png" class="img-rounded" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <ul id="home_ul">
                          <li class="why_us"><h5 class="padding_top_bottom"> Best packers and movers in kolkata</h5></li>
                          <li class="why_us"><h5 class="padding_top_bottom">Quickest response</h5></li>
                          <li class="why_us"><h5 class="padding_top_bottom">Lowest price</h5></li>
                          <li class="why_us"><h5 class="padding_top_bottom">Fastest delivery</h5></li>
                          <li class="why_us"><h5 class="padding_top_bottom">No negotiation with driver</h5></li>
                          <li class="why_us"><h5 class="padding_top_bottom">Pay per km</h5></li>
                       </ul>
                    </div>
                </div>
        	</div>
        </div>
  </section>
<!--end how it works-->

<footer id="sub_footer" >

		<div class="row">
		<div  class="col-md-6">
        <h4 id="home_heading4">TheShipper</h4>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <span itemprop="streetAddress">144/145/59A Jogendra Nath Mukherjee Road ,</span>
                       <span itemprop="addressLocality">LA-PB-980 Ghusuri ,</span>
                       <span itemprop="addressRegion">Howrah</span>
                       <span itemprop="postalCode">711107</span>
            </div>
            <div>
              <ul class="list-unstyled" itemprop="contactPoint" itemscope itemtype="http://schema.org/ContactPoint">
                <li itemprop="telephone" ><span class="fa fa-mobile-phone margin-right-10"></span>+91-<?php loader_display(COMPANY_NO)?></li>
                <li itemprop="email" ><span class="fa fa-envelope-o margin-right-10"></span><a href="mailto:<?php loader_display(COMPANY_EMAIL)?>"><?php loader_display(COMPANY_EMAIL)?></a></li>
              </ul>
            </div><br/>
        <div id="socialmedia" class="row grid20">
           <div class="col-xs-1"style="float:left;"> <a href="https://www.facebook.com/shipper.co.in/"><div class="box"><img id ="fb" alt="Shipper Facebook" src="images/transparent.png"></div></a></div>
            <div class="col-xs-1"style="float:left;"><a href="https://plus.google.com/b/115800598092294557544/115800598092294557544" rel="Publisher"><div class="box2"><img id="googleplus" alt="Shipper GooglePlus" src="images/transparent.png" id="home_googleplus" ></div></a></div>
            <div class="col-xs-1"style="float:left;"><a href="https://twitter.com/ShipprTransport"><div class="box1"><img  id="twitter" alt="Shipper Twitter" src="images/transparent.png"></div></a></div>
            <div class="col-xs-9"style="float:left;"><a href="https://play.google.com/store/apps/details?id=in.co.theshipper.www.shipper_customer" rel="Publisher"><img id="googleplay" alt="Shipper Googleplay" src="images/transparent.png"></a></div>
			
        </div>
		</div>
		<div  class="col-md-6" >
			
		</div>
		</div>
<style>
#fb{
				background:url(images/new.png) -2px -134px; 
				width: 29px;
				height: 29px;
				}
			
			#twitter{background:url(images/new.png)  -40px -134px; 
						width: 29px;
						height: 29px;}
			#googleplus{background:url(images/new.png) -116px -134px; 
						width: 29px;
						height: 29px;}
			
			.box{
				float:left; 
				width: 29px;
				height: 29px;
				overflow: hidden;
				background: url(images/new.png) -1px -164px;
				}	
			.box img{
					width:29px;
					float:left; 
					}
			.box:hover img{
					margin-top:-31px;
					-webkit-transition: margin 1s;
					-moz-transition: margin 1s;
					transition: margin 1s;
						}
						.box1{float:left; 
				
				width: 29px;
				height: 29px;
				overflow: hidden;
				background: url(images/new.png) -40px -164px;
				}	
			.box1 img{
					width:29px;
					float:left; 
					}
			.box1:hover img{
					margin-top:-31px;
					-webkit-transition: margin 1s;
					-moz-transition: margin 1s;
					transition: margin 1s;
						}
						.box2{float:left; 
				
				width: 29px;
				height: 29px;
				overflow: hidden;
				background: url(images/new.png) -116px -164px;
				}	
			.box2 img{
					width:29px;
					float:left; 
					}
			.box2:hover img{
					margin-top:-31px;
					-webkit-transition: margin 1s;
					-moz-transition: margin 1s;
					transition: margin 1s;
						}
						#googleplay{background:url(images/new.png) -15px -87px; 
width: 83px;
height: 29px;}
.grid20 .col-xs-1{width:6%;}
.grid20 .col-xs-9{width:50%;}
</style>
  </footer>
<script>
 $('#create_order_button').click(function(e){
      	    e.preventDefault();
			//alert('Ashish');
			var pickup_lat = $('#pickup_lat').val();
			var pickup_lng = $('#pickup_lng').val();
			var booking_datetime = $('#booking_datetime').val();
			var BookingDatetime =  getDateTime(booking_datetime);
			  if(("" != pickup_lat)&&("" != pickup_lng)){
				$.ajax({
					type: "POST",
					url: "<?php loader_display(ROOT_PATH."detect_availibility")?>",
					data:'current_lat='+ pickup_lat + '&current_lng='+ pickup_lng,
					success: function(data){
						if(data.trim()){
							alert(data);
						}else{
							var nowDate= new Date();
							//alert('BookingDatetime'+BookingDatetime+'nowDate'+nowDate);
							LastThirtyMin= new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate.getMinutes() + 30,nowDate.getSeconds());
							//alert('BookingDatetime'+BookingDatetime+'LastThirtyMin'+LastThirtyMin);
							if(BookingDatetime<LastThirtyMin){
								alert('Minimum Date&Time half an hour from now');
							}else{
								$('#create_form').submit();
							}
						}
					}
				});
			  }
    });
$(function () {  
 var PickupPoint = $("#pickup_point").autocomplete({ 
      change: function() {
		  	  var pickup_lat = $('#pickup_lat').val();
			  var pickup_lng = $('#pickup_lng').val();
			  if(("" !== pickup_lat)&&("" !== pickup_lng)){
				$.ajax({
					type: "POST",
					url: "<?php loader_display(ROOT_PATH."detect_availibility")?>",
					data:'current_lat='+ pickup_lat + '&current_lng='+ pickup_lng,
					success: function(data){
						if(data.trim()){
							alert(data);
						}
					}
				});
			  }
	  }
   });
   PickupPoint.autocomplete('option','change').call(PickupPoint);
});
function getDateTime(DateString){
	var reggie = /^([0][1-9]|[12][0-9]|3[0-1])\/([0][1-9]|1[0-2])\/(\d{4}) (0[0-9]|1[0-2])\:([0-5][0-9]) (am|pm)$/;
	var dateArray = reggie.exec(DateString); 
	//alert(dateArray[4]+dateArray[6])
	if((dateArray[6] === 'pm')){
		 var hours = (+dateArray[4])+12;
	}else if((dateArray[6] === 'am')){
		var hours = (+dateArray[4]);
	}
	var dateObject = new Date(
		(+dateArray[3]),
		(+dateArray[2])-1, // Careful, month starts at 0!
		(+dateArray[1]),
		(hours),
		(+dateArray[5]),
		0
	);
	return dateObject;}
</script>