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
                           <label>Choose Your Health Provider : <?=$user->name?> </label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Health Provider Name : <?=$user->username?></label>
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
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>P.O. Number : <?=$user->hos_p_o_number?></label>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <p>Please register by paying for Meddistant.com platform setup fee of ($<?=$user->setup_fee?>) that covers, but not limited to:</p>
                           <p>1-Meddistant platform integration</p>
                           <p>2-Your facility information enhancement at Meddistant platform</p>
                           <p>3-Medical trips logistics setup to your facility.</p>
                           <p>4-Configure additional users</p>
                           <p>Please note that a separate agreement many follow detailing obligations.</p>
                           <br />

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
             url:"<?=base_url()?>signup/subscribe_payment_success",
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