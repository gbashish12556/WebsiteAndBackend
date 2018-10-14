
<?php include(ACTION_PATH.'feedback_action.php'); ?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/PostalAddress">
  <head>
  <title>The Shipper | Hire a mini truck in kolkata</title>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO -->
<meta name="description" content="The shipper is an initiative to make trasportation of goods efficient and reliable.we provide economical, timely and reliable service.">
<meta name="keywords" content="The Shipper, Shipper , hire mini-trucks in kolkata, Tata ace for rent in kolkata,">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="author" content="TheShipper">
<meta name="google-site-verification" content="e4ThV_fpr176RnEt9vaLzk-0dhTZQGAd5qRKpZP34BY" />
<link rel="shortcut icon" href="images/shipper_logo.png" />
<link rel="publisher" href="https://plus.google.com/u/0/b/115800598092294557544/115800598092294557544/about/p/pub?_ga=1.211753493.1234164146.1470391371" />
<link rel="stylesheet" href="<?php loader_display(ROOT_PATH)?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php loader_display(ROOT_PATH)?>css/datetimepicker.min.css">
<link href="<?php loader_display(ROOT_PATH)?>css/style.css" media="all" rel="stylesheet" />
<link rel="stylesheet" href="<?php loader_display(ROOT_PATH)?>css/feedback_slider.min.css"><!-- Include css file here-->

<script src="<?php loader_display(ROOT_PATH)?>js/jquery.min.js"></script>
<script src="<?php loader_display(ROOT_PATH)?>js/jquery-ui.min.js"></script>
<script src="<?php loader_display(ROOT_PATH)?>js/bootstrap.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72046210-1', 'auto');
  ga('send', 'pageview');

</script>

<!---->

<script type="text/javascript">

	$(document).ready(function(){
    $("#button").click(function(){
      $('#feedback_form').toggleClass("move");
    });
	}); //document.ready

</script>
<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=80135745"></script>

</head>
<body>
<!--fixed navigation bar wtih dropdown menu-->

<!---->
<div id="feedback_form">

   <img  id="button" alt="Feedback Shipper" src="images/feedback.png">

		<form action ="<?php loader_display(ROOT_PATH.$page); ?>" method="post" >
			<div id="heading" >Feedback Us</div>
			  <p> <label>Name* </label><input type="text" name="feedback_name" required/></p>
			<p><label>Phone* </label><input type="text" name="feedback_phone" pattern="^[2-9]{2}[0-9]{8}$" required title="Enter valid 10 digit Phone number"/></p>
			<p><label>Subject* </label><input type="text" name="feedback_subject" required /></p>
			<p><label>Message* </label><textarea name="feedback_message" required></textarea></p>
      <?php loader_set_session('feedback_session',rand(10,10000));?>
      <p><input type="text" name="fsession" id="session" value="<?php loader_display(loader_get_session('feedback_session'));?>" hidden/></p>
      <p><input type="submit" name="submit" class="btn btn-large btn-default" value="send"></p>

		</form>
  </div>

 <div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
       </button>
       <img alt="Shipper Logo" src="images/shipper_logo.png"/>
       <a href="https://play.google.com/store/apps/details?id=in.co.theshipper.www.shipper_customer" rel="Publisher"><img id="googleplay" alt="Shipper Googleplay" src="images/download_app.png"></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
          <li <?php if("home" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH) ?>" >Home</a></li>
          <li<?php if("aboutus" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'aboutus') ?>">About</a></li>
          <li <?php if("fares" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'fares') ?>" >Pricing</a></li>
          <li <?php if("trackorder" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'trackorder') ?>" >Track Order</a></li>
         <li <?php if("contact" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'contact') ?>" >Contact Us</a></li>
         <li <?php if("register" == $page){?> class="active"<?php }?>><a href="<?php if(loader_session_isset('username')){ loader_display(ROOT_PATH.'customerprofile');} else{ loader_display(ROOT_PATH.'register'); }?>"><?php if(loader_session_isset('username')){ loader_display(loader_get_session('username')); }else {loader_display("Register"); }?></a></li>
         		<!-- all your main menu links here -->
		<li><a class="cd-signin" href="#0">Sign in</a></li>
		<li><a class="cd-signup" href="#0">Sign up</a></li>
      </ul>
    </div>

    <script>
	$('li').click(function(){
		//alert('ashish');
		$('li').removeClass('active');
		$(this).flnd('li').addClass('active');
		});

	</script>
  </div>
</div>
