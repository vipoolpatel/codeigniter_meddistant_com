<style type="text/css">
   .form-control{
   font-size: 14px;
   border: 1px solid #d2d2d2;
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
             
                  <div class="row">

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Organization Provider Type : <?=$user->company_type?> </label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Company / Affiliate Name : <?=$user->username?></label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Street Address : <?=$user->address?></label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>City : <?=$user->city?></label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>State or Province : <?=$user->state?></label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Postal Zip Code : <?=$user->zipcode?></label>
                        </div>
                     </div>

                     <?php
                     if(!empty($user->affiliate_partner_code))
                     {
                     ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Affiliate Partner Code : <?=$user->affiliate_partner_code?></label>
                        </div>
                     </div>
                   <?php }
                   ?>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Users at any year : <?=$user->name?></label>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label>P.O. Number : <?=$user->hos_p_o_number?></label>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="form-group">
                           <label><?=$get_plan_single->plan_name?></label>
                        </div>
                     </div>



                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Setup Fee : $<?=$user->setup_fee?></label>
                           <label>Rate : $<?=$get_plan_single->price?></label>
                           <label>Payable Amount : $<?=$get_plan_single->payable_amount?></label>
                        </div>
                     </div>


                     <div class="col-md-12">
                        <div class="form-group" style="margin-top: 20px;">
                          <div id="paypal-button-container"></div>
                        </div>
                     </div>


                  </div>
            </div>
    
         </div>
      </div>
   </div>
   </div>
</section>

<script src="<?php echo base_url(); ?>assets/frontend-asset/updated/js/core.min.js"></script>


<script src="https://www.paypal.com/sdk/js?client-id=AaiT_7UenuX5G8wX35MRysE80g756k0KYagiEDXtojdCl60GuR4e__B7n1DeBv6Hg_XIq2htd0IIP-KK&vault=true" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          'plan_id': '<?=$get_plan_single->plan_id?>'
        });
      },
      onApprove: function(data, actions) {
         var user_id = '<?=$user->user_id?>';
         $.ajax({
             type:'POST',
             url:"<?=base_url()?>signup/emp_subscribe_payment_success",
             data: {user_id:user_id,subscriptionID:data.subscriptionID},
             dataType: 'JSON',
             success:function(response){
                alert(response.success);
                window.location.href = "<?=base_url('dashboard')?>";
             }
         });

      }
  }).render('#paypal-button-container');

</script>