<!DOCTYPE html>
<html lang="en">
  <head>
  <title>The Shipper:<?php loader_display($page);?></title>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO -->
<meta name="description" content="The shipper is an initiative to make trasportation of goods efficient and reliable. We are using technology to mitigate logistics risk and reduce cost of trasportation which helps us to provide economical, timely and reliable experience to our customers.">
<meta name="keywords" content="The Shipper , packers movers kolkata  , packers and movers in kolkata">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<link rel="stylesheet" href="<?php loader_display(ROOT_PATH)?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php loader_display(ROOT_PATH)?>css/datetimepicker.css">
<link href="<?php loader_display(ROOT_PATH)?>css/style.css" media="all" rel="stylesheet" />
<script src="<?php loader_display(ROOT_PATH)?>js/jquery.min.js"></script>
<script src="<?php loader_display(ROOT_PATH)?>js/jquery-ui.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72046210-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<!--fixed navigation bar wtih dropdown menu-->
 <div class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span> 
       </button>
       <img src="images/shipper_logo.png"/>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
          <li <?php if("home" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH) ?>" >Home</a></li>
          <li<?php if("about_us" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'about_us') ?>">About</a></li>
          <li <?php if("fares" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'fares') ?>" >Pricing</a></li>
          <li <?php if("track_order" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'track_order') ?>" >Track Order</a></li>
          <li <?php if("contact" == $page){?> class="active"<?php }?> ><a href="<?php loader_display(ROOT_PATH.'contact') ?>" >Contact Us</a></li>
          <li></li>
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