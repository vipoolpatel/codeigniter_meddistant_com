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

                           <?php if ($this->session->flashdata('error_message')) { ?>

                              <div class="col-md-12">
                                 <div class="form-group">
                                    <div class="alert alert-danger" style="color: #fff">
                                       <span><?php echo $this->session->flashdata('error_message'); ?></span>
                                    </div>
                                 </div>
                              </div>

                           <?php } ?>

                     <div class="col-md-12">
                        <div class="form-group">
                           <label style="text-align: center;color: red;font-size: 18px;">The Efficient Healthcare Network That Drives Results</label>
                        </div>

                        <div class="form-group">
                           <label style="text-align: center;padding-bottom: 25px;color: blue;font-size: 18px;">Users enjoy 50% or more savings on facilitation fees, and additional savings on medical or cosmetic treatment costs with <br /> Meddistant special care.</label>
                        </div>

                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Choose Your Organization Provider Type <span class="required">*</span></label>
                           <select class="form-control" required id="company_type_id" name="company_type_id">
                              <option value="">Select</option>
                              <?php foreach ($get_company_type as $value) { ?>
                              <option <?=($value->id == $user->company_type_id) ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->company_type?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Company / Affiliate Name <span class="required">*</span></label>
                           <input type="text" class="form-control" required value="<?=$user->username?>" name="username">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Street Address <span class="required">*</span></label>
                           <input type="text" class="form-control" required  value="<?=$user->address?>" name="address">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>City <span class="required">*</span></label>
                           <input type="text" class="form-control" required value="<?=$user->city?>" name="city">
                        </div>
                     </div>
                     <?php
                        if($user->country == 'USA')
                        {
                        ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>State or Province <span class="required">*</span></label>
                           <select class="form-control" required name="state">
                              <option value="">Select</option>
                              <?php
                              foreach ($get_usa_state as $usa_state) {
                                 ?>
                                 <option <?=($usa_state->state_name == $user->state) ? 'selected' : '' ?> value="<?=$usa_state->state_name?>"><?=$usa_state->state_name?></option>
                                 <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <?php }
                        else
                        { ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>State or Province <span class="required">*</span></label>
                           <input type="text" value="<?=$user->state?>" required name="state" class="form-control">
                        </div>
                     </div>
                     <?php }
                        ?>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Postal Zip Code <span class="required"><?=($user->country == 'USA') ? '*' : ''?></span></label>
                           <input type="text" <?=($user->country == 'USA') ? 'required' : ''?> class="form-control" value="<?=$user->zipcode?>" name="zipcode">
                        </div>
                     </div>


                     <div class="col-md-6 hide_show_affiliate_partner">
                        <div class="form-group">
                           <label>Affiliate Partner Code <span class="required">*</span></label>
                           <input type="text" class="form-control affiliate_partner_code" value="<?=$user->affiliate_partner_code?>" name="affiliate_partner_code">
                        </div>
                     </div>



                     <span id="hide_show_data">

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Users at any year <span class="required">*</span></label>
                              <select class="form-control remove_required" id="EmployerSubscriptionType" required name="employer_subscription_id">
                                 <option value="">Select</option>
                                 <?php foreach ($get_employer_subscription as $values) { ?>
                                 <option <?=($values->id == $user->employer_subscription_id) ? 'selected' : '' ?> value="<?=$values->id?>"><?=$values->name?></option>
                                 <?php } ?>
                              </select>
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

                     </span>


                     <div class="col-md-12">
                        <div class="form-group">
                           <label><input type="checkbox" required name="agree"> I agree to  <a style="color: blue" target="_blank" href="<?=base_url()?>about/terms">Terms of Service</a></label>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group" style="margin-top: 20px;">
                           <button type="submit" class="btn btn-success btn-sm">Register</button>
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

   
   $('body').delegate('#company_type_id','change', function() {
         company_type();
   });

   function company_type() {
         var id = $('#company_type_id').val();
         if(id == 3)
         {
            $('.remove_required').prop('required',false);
            $('.affiliate_partner_code').prop('required',true);

            $('#hide_show_data').hide();
            $('.hide_show_affiliate_partner').show();
            $('#EmployerSubscriptionType').val('');
            EmployerSubscriptionType();
         }
         else
         {
            $('#hide_show_data').show();
            $('.hide_show_affiliate_partner').hide();
            $('.remove_required').prop('required',true);
            $('.affiliate_partner_code').prop('required',false);
            $('.affiliate_partner_code').val('');
         }

   }

   company_type();

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


   $('#EmployerSubscriptionType').change(function(){
         EmployerSubscriptionType();   
   });


   function EmployerSubscriptionType() {
      var id = $('#EmployerSubscriptionType').val();
      if(id != '')
      {
         var state = '<?=$user->state?>';
         $.ajax({
            type:'POST',
            url:"<?=base_url()?>signup/get_employer_subscription_type",
            data: {id: id, state: state},
            dataType: 'JSON',
            success:function(data){
               $('#get_setup_fees').html(data.setup_fees);
               $('#getPlanDetail').html(data.html_plan);
               
            }
         });
      }
      else
      {
            $('#get_setup_fees').html('');
            $('#getPlanDetail').html('');
      }
   }
   
   EmployerSubscriptionType();
</script>
