<?php include(ACTION_PATH.'fare_calculator_action.php');?>
<script>

	   jQuery(function(){
       // jQuery('#datetime3').datetimepicker();
			jQuery('.time').datetimepicker({
				format:'g:i a',
				datepicker:false,
				pick12HourFormat: true   
			});
	
        });	
</script>
<section class="section  body_gray_bottom" >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="main_heading super  text-center">Fare Calculator</h1>
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
<?php if("" == $case){?>
<section class="section-page-short" id="get_quote_section">
    <div class="container">
        <div class="col-sm-12">
          <br/>
          <br/>
          <form id="get_quote_form" class="form-horizontal form" method="POST" action="<?php loader_display(ROOT_PATH.'farecalculator')?>">
                            <div class="form-group">
                              <div class="col-sm-12">
                              <div class="col-sm-6">
                                <label for="name" class="col-sm-5 control-label text-left">Total Distance(in km)*</label>
                                <div class="col-sm-7 reg_form_div"><input name="total_distance" type="text" id="total_distance" maxlength="<?php loader_display(MOBILE_MAXLEN)?>"  class="form-control required float" value= "<?php loader_display($total_distance)?>" placeholder="Total Journey Distance"/></div>
                               </div>
                              <div class="col-sm-6">
                                <label for="mobile_no" class="col-sm-5 control-label text-left">Total time(in minutes)*</label>
                                <div class="col-sm-7 reg_form_div"><input name="total_time" type="text" id="total_time" maxlength="<?php loader_display(MOBILE_MAXLEN)?>"  class="form-control required numeric" value= "<?php loader_display($total_time)?>" placeholder="Total Journey Time"/></div>
                                </div>
                              </div>    
                           </div>
                           <div class="form-group">
                              <div class="col-sm-12">
                                <div class="col-sm-6">   
                                  <label for="dob" class="col-sm-5 control-label text-left">Select Vehicle ? *</label>
                                    <div class="col-sm-7 reg_form_div">
                                      <?php get_vehiclelist(); ?>
                                    </div>
                                  </div>
                                <div class="col-sm-6">
                                  <label for="datetime" class="col-sm-5 control-label text-left">Toll and Taxes(in Rs) *</label>
                                    <div class="col-sm-7 reg_form_div"><input name="toll_charge" type="text" id="toll_charge" class="form-control required numeric" value= "<?php loader_display($toll_charge)?>" placeholder="Extra Charge"/></div>
                                 </div>
                              </div>    
                           </div>
                         <div class="form-group text-center">
                            <div class="">
                                <input type="submit" id="calculate_fare" name="calculate_fare" class="btn btn-large btn-default" value="Caculate Fare" />
                            </div>         
                        </div>
                    </form> 
          </div>
        </div>
</section>
<?php }if("final_bill" == $case){?>  
<section class="section-short" >
    <div class="container">
        <div class="col-sm-12">
          <div class="form-group">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-8">
              <?php loader_display($list1)?>
              </div>
         </div>
         <div class="form-group">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-8">
              <?php loader_display($list2)?>
              </div>
         </div>

       </div>
    </div>
 </div>
 <?php }?>

  



