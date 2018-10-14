<?php
loader_start_session();
$customer_name = loader_get_session('username');
$phone_no = loader_get_session('phone_no');

$query ="SELECT * FROM tbl_customer_info WHERE fld_mobile_no='".$phone_no."' AND fld_name = '".$customer_name."'";
$result=loader_query($query);
$row = loader_fetch_assoc($result);
$email = $row['fld_email'];
$address = $row['fld_postal_address'];


?>

<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Welcome <?php loader_display($customer_name);?></h1>
        </div>
      </div>
    </div>
</section>
<section>

<div class="container text-center">
  <div class="row">
    <div class="col-md-8">
      <h3 id="heading"><u>DETAILS</u></h3>
    </div>
    <div class="col-md-4">
      <a href="<?php loader_display(ROOT_PATH.'logout')?>" ><h3><b>Logout</b></h3></a>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <h3 class="pull-left">Customer Name: </h3>
    </div>
    <div class="col-md-5">
        <h3 class="pull-left"><?php loader_display($customer_name); ?> </h3>
    </div>
    <div class="col-md-4">
        <h3><a href="<?php loader_display(ROOT_PATH.'edituserdetails')?>" id="logout">Edit Details</a> </h3>
    </div>

  </div>


  <div class="row">
    <div class="col-md-3">
      <h3 class="pull-left">Phone no:</h3>
    </div>
    <div class="col-md-5">
        <h3 class="pull-left"> <?php loader_display($phone_no);?></h3>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <h3 class="pull-left">Email Address:</h3>
    </div>
    <div class="col-md-5">
        <h3 class="pull-left"> <?php loader_display($email);?></h3>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <h3 class="pull-left">Address:</h3>
    </div>
    <div class="col-md-5">
        <h3 class="pull-left"> <?php loader_display($address);?></h3>
    </div>
  </div>
</div>
<br><br><br>
