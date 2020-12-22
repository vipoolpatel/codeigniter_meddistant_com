<style type="text/css">
   .form-control{
   font-size: 14px;
   border: 1px solid #d2d2d2;
   color: #030303;
   }
   .required{
   color: red;
   }
   .form-group label {
   text-align: left;
   width: 100%;
   padding-bottom: 5px;
   }
   .form-group {
   text-align: left;
   color: #030303;
   }
   .col-md-6 {
   padding-bottom: 15px;  
   }
</style>
<section class="section-30 section-sm-60 bg-light signup">
   <div class="shell">
      <div class="range range-sm-center">
         <div class="cell-sm-12">
            <div class="block-shadow" style="padding: 30px;">
               <form action="" method="post">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Choose Your Health Provider Type <span class="required">*</span></label>
                           <select class="form-control" id="HealthProviderType" required name="hos_med_provider_type">
                              <option value="">Select</option>
                              <?php foreach ($get_med_provider_type as $value) { ?>
                              <option <?=($value->id == $user->hos_med_provider_type) ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->name?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Health Provider Name <span class="required">*</span></label>
                           <input type="text" class="form-control" value="<?=$user->username?>" name="hos_health_provider_name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Street Address <span class="required">*</span></label>
                           <input type="text" class="form-control" value="<?=$user->address?>" name="hos_street_address">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>City <span class="required">*</span></label>
                           <input type="text" class="form-control" value="<?=$user->city?>" name="hos_city">
                        </div>
                     </div>
                     <?php
                        if($user->country == 'USA')
                        {
                        ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>State or Province <span class="required">*</span></label>
                           <select class="form-control" id="StateorProvince" required name="hos_state_province">
                              <option value="">Select</option>
                           </select>
                        </div>
                     </div>
                     <?php }
                        else
                        { ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>State or Province <span class="required">*</span></label>
                           <input type="text" value="<?=$user->state?>" required name="hos_state_province" class="form-control">
                        </div>
                     </div>
                     <?php }
                        ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Postal Zip Code <span class="required"><?=($user->country == 'USA') ? '*' : ''?></span></label>
                           <input type="text" <?=($user->country == 'USA') ? 'required' : ''?> class="form-control" value="<?=$user->zipcode?>" name="hos_postal_zip_code">
                        </div>
                     </div>
                     <div class="col-md-6">
                     </div>
                     <?php
                        if($user->country == 'USA')
                        {
                        ?>
                     <div class="col-md-12">
                        <div class="form-group">
                           <p>Please register by paying for Meddistant.com platform setup fee of ($<span id="get_setup_fees">0</span>) along with a chosen plan that covers, but not limited to:</p>
                           <p>1-Meddistant platform integration</p>
                           <p>2-Your facility information enhancement at Meddistant platform</p>
                           <p>3-Medical trips logistics setup to your facility.</p>
                           <p>4-Configure additional users</p>
                           <p>Please note that a separate agreement may follow detailing obligations.</p>
                           <br />
                        </div>
                     </div>

                     <span id="getPlanDetail"></span>
                    

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>P.O. Number (optional) </label>
                           <input type="text" value="<?=$user->hos_p_o_number?>" class="form-control" name="hos_p_o_number">
                        </div>
                     </div>
                     <div class="col-md-6"></div>
                     <?php }
                        else
                        { ?>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Please register today as Meddistant will help you with:</label>
                           <p>1-Meddistant platform integration</p>
                           <p>2-Your facility information enhancement at Meddistant platform</p>
                           <p>3-Medical trips logistics setup to your facility.</p>
                           <p>4-Configure additional users</p>
                           <br />
                        </div>
                     </div>
                     <?php }
                        ?>
                     <div class="col-md-12">
                        <div class="form-group" style="color: green; font-weight: bold;font-size: 18px;margin-top: 10px;">
                           Please note that your registration to Meddistant platform is available now, but may not be available in the future.
                        </div>
                        <div class="form-group">
                           <label><input type="checkbox" required name="agree"> I agree to  <a style="color: blue" target="_blank" href="<?=base_url()?>about/terms">Terms of Service</a></label>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group" style="margin-top: 20px;">
                           <button class="btn btn-success btn-sm">Register</button>
                        </div>
                     </div>
                  </div>
            </div>
            </form>
         </div>
      </div>
   </div>
   </div>
</section>
<script src="<?php echo base_url(); ?>assets/frontend-asset/updated/js/core.min.js"></script>
<script type="text/javascript">

   $('body').delegate('.plan_id','change', function(){
         var type = $(this).attr('id');
         var html = '';
         if(type == 0)
         {
            html = '<label><input type="radio" value="1" checked required name="payment_option"> By Credit Card</label>';
         }
         else
         {
            html = '<label><input type="radio" value="1" required  name="payment_option"> By Credit Card</label>\n\
                        <label><input type="radio" required  value="2" name="payment_option"> Invoice Later </label>';
         }
         $('#getPaymentOption').html(html);
   });

   $('#HealthProviderType').change(function(){
         HealthProviderType();   
   });
   function HealthProviderType() {
      var id = $('#HealthProviderType').val();
      var hos_state_province = '<?=$user->state?>';
         $.ajax({
            type:'POST',
            url:"<?=base_url()?>signup/get_health_provider_type",
            data: {id: id, hos_state_province: hos_state_province},
            dataType: 'JSON',
            success:function(data){
               $('#StateorProvince').html(data.success);
               $('#get_setup_fees').html(data.setup_fees);
               $('#getPlanDetail').html(data.html_plan);
               
            }
         });
   }
   
   HealthProviderType();
</script>
