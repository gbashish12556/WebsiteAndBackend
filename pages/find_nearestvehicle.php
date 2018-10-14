<?php include(ACTION_PATH.'find_nearestvehilce_action.php');?>
<br/><br/><br/><br/>
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