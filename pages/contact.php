<?php include(ACTION_PATH.'contact_action.php')?>
<script>
var myCenter=new google.maps.LatLng(22.624773,88.355110);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
  <section class="section body_gray_bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="main_heading super text-center">Contact Us</h1>
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
          <div class="form-group">
              <div class="col-sm-6 bg_gray_border padding-top-bottom-30">
                  <h4 class="footer_header text-center"><span class="title-black">Message Us:</span></h4>
                  <form id="commentForm"  class="form-horizontal form padding-top-bottom-10" action ="<?php loader_display(ROOT_PATH.'contact'); ?>" method="POST">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
                      <div class="col-sm-10">
                        <input  type="text" class="form-control green-bg required customvalidation" maxlength="<?php loader_display(NAME_MAXLEN)?>" id="name" name="name" value="<?php loader_display($name)?>" >
                      </div>
                    </div>
                    <div class="form-group" >
                      <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                      <div class="col-sm-10">
                        <input  type="email" class="form-control green-bg required email" maxlength="<?php loader_display(EMAIL_MAXLEN)?>" id="email" name="email" value="<?php loader_display($email)?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Subject*</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control green-bg required" id="subject"  name="subject" minlength="<?php loader_display(SUBJECT_MINLEN)?>" maxlength="<?php loader_display(SUBJECT_MAXLEN)?>" value="<?php loader_display($subject)?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message*</label>
                      <div class="col-sm-10">
                        <textarea  class="form-control green-bg required"  rows="3" id="message" name="message" minlength="<?php loader_display(MESSAGE_MINLEN)?>" maxlength="<?php loader_display(MESSAGE_MAXLEN)?>">
                        <?php loader_display($message); ?>
                        </textarea>
                      </div>
                    </div>
					 <?php loader_set_session('form_session',rand(10,10000));?>
                    <input type="text" name="session" id="session" value="<?php loader_display(loader_get_session('form_session'));?>" hidden/>
                    <div class="form-group text-center">
                       <div class="">
                           <input type="submit" onclick="ga('send','event','contact_form_button','clicked','contact_form','1')" id="contact_button" name="contact_button" class="btn btn-large btn-default" value="Send" />
                       </div>
                   </div>
                 </form>
              </div>
              <div class="col-sm-6 bg_gray_border">
                  <h4 class="footer_header" ><span class="title-black">Head Office</span></h4>
                  <div class="address padding-top-bottom-10" itemscope itemtype="http://schema.org/LocalBusiness" >
                     <span itemprop="name">TheShipper</span>
                     <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                      <span itemprop="streetAddress">144/145/59A Jogendra Nath Mukherjee Road ,</span>
                       <span itemprop="addressLocality">LA-PB-980 Ghusuri ,</span>
                       <span itemprop="addressRegion">Howrah</span>
                       <span itemprop="postalCode">711107</span>
                     </div>
                  </div>
                  <div>
                    <ul class="list-unstyled" itemprop="contactPoint" itemscope itemtype="http://schema.org/ContactPoint">
                      <li itemprop="telephone" ><span class="fa fa-mobile-phone margin-right-10"></span>+91-<?php loader_display(COMPANY_NO)?></li>
                      <li itemprop="email" ><span class="fa fa-envelope-o margin-right-10"></span><a href="mailto:<?php loader_display(COMPANY_EMAIL)?>"><?php loader_display(COMPANY_EMAIL)?></a></li>
                    </ul>
                  </div><br/>
                  <h4 class="footer_header"><span class="title-black">Location</span></h4>
                  <div class="padding-top-bottom-10">
                    <a href="https://www.google.co.in/maps/place/144%2F145,+Jogendranath+Mukherjee+Rd,+Ghusuri,+Howrah,+West+Bengal+711107/@22.6081031,88.351068,15z/data=!4m2!3m1!1s0x3a0277d9ac267b11:0xa00093dbb54385b9" target="_blank">
                    <div id="googleMap"></div>
                    </a>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
  <script type="text/javascript">
  /*$(document).ready(function(){
		$(function() {
		var form = $('#commentForm');
		var formMessages = $('#form_messages');
		$(form).submit(function(event) {
			var valid_user = $('#username').valid('');
			var valid_email = $('#email').valid('');
			var valid_subject = $('#subject').valid('');
			var valid_message = $('#message').valid('');
			if((true == valid_user)&&(true == valid_email)&&(true == valid_subject)&&(true == valid_message))
			{
			$('.btn').attr('disabled','disabled');
			event.preventDefault();
			var formData = $(form).serialize();
				$.ajax({
					type: 'POST',
					url: $(form).attr('action'),
					data: formData,
				    success: function(data) {
						    $('#username').val('');
							$('#email').val('');
							$('#subject').val('');
							$('#message').val('');
						$(formMessages).removeClass('error');
						$(formMessages).addClass('success');
						$(formMessages).html("<h2>Contact Form Successfully Submitted!</h2>");
					  }
				});
			}
			}).fail(function(data) {
		     $('btn').removeAttr('disabled');
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');
		    $(formMessages).html("<h2>Contact Form could not be Submitted!</h2>");
		    });
			return false;
	    });
	});*/
  </script>
