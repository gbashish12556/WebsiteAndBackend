<?php include(ACTION_PATH.'register_action.php')?>
<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Register</h1>
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

<section class="section-tiny">
     <div class="container">
         <div class="row">

            <form class="form-horizontal form" action="<?php loader_display(ROOT_PATH.'register'); ?>" method="POST">
                <div class="form-group">
                  <div class="col-sm-4"></div>
                   <div class="col-sm-4 text-center" id="register_form">
                       <input type="text" class="form-control" maxlength="20"  name="phone_no"  placeholder="Enter Phone Number"  required title="Enter valid 10 digit Phone number"/>
                   </div>
                   <div class="col-sm-4"></div>
                </div>
                <div class="form-group text-center">
                  <div class=""  id="register_button">
                      <button type="submit"  name="login_button" class="btn btn-large btn-default"  >login</button>
                  </div>
                    <div class="" id="register_button">
                        <button type="submit"  name="register_button" class="btn btn-large btn-default"  >Register</button>
                    </div>
                </div>
            </form>

       </div>
    </div>
</section>

<!-- modal for otp confirmation -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header" id="register_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-lock"></span>Confirm OTP</h4>
      </div>
        <div class="modal-body" id="register_modal">
          <form action="<?php loader_display(ROOT_PATH.'register'); ?>" method="post" role="form">
            <div class="form-group">
              <label for="otp"> OTP</label>
              <input type="text" class="form-control" name="<?php if(loader_post_isset('login_button')) loader_display("login_otp"); else loader_display("register_otp")?>" id="otp" placeholder="Enter OTP" required>
            </div>
            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> SUBMIT</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" name="confirm_otp" class="btn btn-large btn-default pull-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal for customer details -->

  <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">


        <div class="modal-content">
          <div class="modal-header" id="register_modal">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-lock"></span> Enter Details</h4>

          </div>
          <div class="modal-body" id="register_modal">
            <form action="<?php loader_display(ROOT_PATH.'register'); ?>" method="post" role="form">
              <div class="form-group">
                <label for="custName">Name</label>
                <input type="text" class="form-control" name="customer_name" id="custName" placeholder="Enter Name" required>
              </div>
              <div class="form-group">
                <label for="custEmail">Email</label>
                <input type="text" class="form-control" name="customer_email" id="custEmail" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                <label for="custAddress">Address</label>
                <input type="text" class="form-control" name="customer_address" id="custAddress" placeholder="Enter Address" required>
              </div>

              <button type="submit" name="details_button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> SUBMIT</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-large btn-default pull-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
