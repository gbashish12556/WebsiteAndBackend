<?php include(ACTION_PATH.'fares_action.php')?>
<section class="section  body_gray_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main_heading super  text-center">Pricing</h1>
        </div>
      </div>
     </div>
</section>
<section class="section">
   <div class="container">
      <div class="row">
          <div class="col-md-12">
              <ul class="nav nav-tabs nav-pills">
              <?php loader_display($list_tab)?>
              </ul>
          </div>     
          <div class="tab-content"> 
          <?php loader_display($list)?>
          </div>
          <div class="text-center"><p>Note: Toll and Taxes are extra.Charges in city area during peak hours will be higher.</p></div>
      </div>
   </div>   
</section>

<section class="section text-center">
</section>