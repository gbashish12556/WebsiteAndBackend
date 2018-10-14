<?php include(ACTION_PATH.'track_order_action.php')?>
<section class="section body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Track Order</h1>
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
            <form class="form-horizontal form" action="<?php loader_display(ROOT_PATH.'orderstatus');?>" method="POST">
                <div class="form-group">
                  <div class="col-sm-4"></div>
                   <div class="col-sm-4 text-center" id="register_form">
                       <input type="text" class="form-control required" maxlength="20" id="AWS_no" name="crn_no"  placeholder="Enter CRN Number" />
                   </div>
                   <div class="col-sm-4"></div>
                </div>
                <div class="form-group text-center">
                    <div class="">
                        <input type="submit" id="track_submit" name="track_submit" class="btn btn-large btn-default" value="Track Order" />
                    </div>
                </div>
            </form>
       </div>
    </div>
</section>
