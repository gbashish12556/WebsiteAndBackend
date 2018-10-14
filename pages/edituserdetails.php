<?php include(ACTION_PATH.'edit_user_details_action.php') ?> ?>

<?php
$phone_no = loader_get_session('phone_no');
$customer_name = loader_get_session('username');
$query ="SELECT * FROM tbl_customer_info WHERE fld_mobile_no='".$phone_no."' AND fld_name = '".$customer_name."'";
$result=loader_query($query);
$row = loader_fetch_assoc($result);
$customer_email = $row['fld_email'];
$customer_address = $row['fld_postal_address'];
?>

<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super text-center">Edit Details</h1>
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



<div class="container">
  <div class="col-sm-a2">
    <div class="form-group">
        <div class="col-sm-12 bg_gray_border padding-top-bottom-30">
            <h4 class="footer_header text-center"><span class="title-black">Details:</span></h4>
            <form id="commentForm"  class="form-horizontal form padding-top-bottom-10" action ="<?php loader_display(ROOT_PATH.'edituserdetails'); ?>" method="POST">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control green-bg required customvalidation" maxlength="<?php loader_display(NAME_MAXLEN)?>" id="name" name="customer_name" value="<?php loader_display($customer_name)?>" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                <div class="col-sm-10">
                  <input  type="email" class="form-control green-bg required email" maxlength="<?php loader_display(EMAIL_MAXLEN)?>" id="email" name="customer_email" value="<?php loader_display($customer_email)?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Phone*</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control green-bg required" id="phone"  name="phone_no" minlength="<?php loader_display(MOBILE_MINLEN)?>" maxlength="<?php loader_display(MOBILE_MAXLEN)?>" value="<?php loader_display($phone_no)?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Address*</label>
                <div class="col-sm-10">
                  <textarea  class="form-control green-bg required"  rows="3" id="address" name="customer_address" >
                  <?php loader_display($customer_address); ?>
                  </textarea>
                </div>
              </div>
        <?php loader_set_session('form_session',rand(10,10000));?>
              <input type="text" name="session" id="session" value="<?php loader_display(loader_get_session('form_session'));?>" hidden/>
              <div class="form-group text-center">
                 <div class="">
                     <input type="submit"   name="edit_user_details_button" class="btn btn-large btn-default" value="Submit" />
                 </div>
             </div>
           </form>
        </div>
      </div>
    </div>
  </div>
