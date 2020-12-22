<main>
   <style>
      .radio label,
      .checkbox label {
      cursor: pointer;
      }
      .checkout-total{
      display: grid;
      grid-template-columns:87% 12%;
      grid-gap: 1%;
      }
      @media (max-width: 550px) {
      .checkout-total{
      grid-template-columns:59% 30%;
      }
      }
      <?php
         if ($selected_quote_data['type'] == 'Service') {
          ?>
      .service-hide{
      display: none;
      }
      <?php
         }
         ?>
   </style>
   <?php
      $required = '';
      if ($selected_quote_data['type'] != 'Service') {
        $required = 'required';
      }
      ?>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Payment Details</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">Quote Received by Facility</li>
                  <li class="breadcrumb-item active" aria-current="page">Payment Details</li>
               </ol>
            </nav>
            <div class="separator mb-5"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-body">
                  <form action="<?=base_url()?>customer_checkout/checkout" method="post" id="payment_form">
                     <input type="hidden" value="<?=$selected_quote_data['quote_request_id']?>" name="quote_request_id"/>
                     <input type="hidden" value="<?=$selected_quote_data['quote_sent_id']?>" name="quote_sent_id"/>
                     <input type="hidden" value="<?=$selected_quote_data['treatment_name']?>" name="procedure_treatment"/>
                     <input type="hidden" id="stripeToken" name="stripeToken"/>
                     <input type="hidden" id="stripeEmail" name="stripeEmail"/>
                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>Date:</b> </label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=date('m-d-Y', strtotime($selected_quote_data['created_on']))?>
                        </div>
                     </div>
                     <?php
                        if ($selected_quote_data['type'] == 'Treatment') {?>
                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>Treatment:</b> </label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$selected_quote_data['treatment_name']?>
                        </div>
                     </div>
                     <?php } else {?>
                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>Service:</b> </label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$selected_quote_data['service_name']?>
                        </div>
                     </div>
                     <?php }
                        ?>

              



                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b><?=($selected_quote_data['type'] != 'Service') ? 'Message/Proposed treatment' : 'Proposed Service'?>:</b></label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$selected_quote_data['message']?>
                        </div>
                     </div>

                  <?php
                  if(!empty($getHospitalDetail)) {
                  ?>

                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label style="color: blue;font-size: 18px;"><b>Medical Facility</b> </label>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>Name:</b></label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$getHospitalDetail->username?>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>City:</b></label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$getHospitalDetail->city?>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>State:</b></label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$getHospitalDetail->state?>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-2">
                           <label for=""><b>Country:</b></label>
                        </div>
                        <div class="form-group col-md-10">
                           <?=$getHospitalDetail->country?>
                        </div>
                     </div>

                  <?php }
                  ?>


                     <div class="form-row service-hide">
                        <div class="form-group col-md-6">
                           <label for="">Select Treatment Date <span style="color:red;">(Select 7 day range, Meddistant will confirm a date within the range)</span> </label>

                           <?php
                           if(!empty($selected_quote_data['destination_start_date']) && !empty($selected_quote_data['destination_end_date']))
                           {
                           ?>
                           <input type="text" value="<?=date("M d,Y ", strtotime($selected_quote_data['destination_start_date']))?> - <?=date("M d,Y ", strtotime($selected_quote_data['destination_end_date']))?>" class="form-control" readonly name="schedule_treatment">

                        <?php }
                        else
                        {
                        ?>
                           
                           <select name="schedule_treatment" <?=$required?> class="form-control">
                              <option value="">---Select---</option>
                              <?php
                                 $duration = 1;
                                 $sevenduration = 7;
                                 
                                 for ($total_duration = 0; $total_duration <= 15; $total_duration++) {
                                 
                                  // $previous_week = strtotime("+" . $total_duration . " day");
                                 
                                  // $start_week = strtotime("+0 day", $previous_week);
                                  // $end_week = strtotime("+7 day", $start_week);
                                  // $start_week = date("M d,Y ", $start_week);
                                  // $end_week = date("M d,Y", $end_week);
                                  // $treatment_date = $start_week . ' - ' . $end_week;
                                  $today = strtotime("+" . $duration . " day");
                                  $seven = strtotime("+" . $sevenduration . " day");
                                 
                                  $start_week = date("M d,Y ", $today);
                                  $end_week = date("M d,Y", $seven);
                                 
                                  $treatment_date = $start_week . ' - ' . $end_week;
                                 
                                  ?>
                              <option value="<?php echo $treatment_date; ?>"><?=$treatment_date?></option>
                              <?php
                                 $duration = $duration + 7;
                                  $sevenduration = $sevenduration + 7;
                                 
                                 }
                                 ?>                        
                           </select>

                        <?php }
                        ?>

                        </div>
                        <div class="form-group col-md-6"></div>
                     </div>
                     <div class="form-row service-hide">
                        <div class="form-check col-md-5">
                           <label style="color:red;">Leave un-checked if arranging your own hotel/stay.</label>
                        </div>
                     </div>
                     <?php
                        if ($selected_quote_data['accomodations'] != 'yes') {
                          ?>
                     <div class="form-row service-hide">
                        <div class="form-check col-md-5" style="margin-left: 19px;">
                           <input class="form-check-input" type="checkbox" id="meddistant_accommodation" value="Meddistant will arrange your hotel accommodations" name="accommodation"  >
                           <label class="form-check-label" for="meddistant_accommodation">Meddistant will arrange your hotel accommodations</label>
                        </div>
                     </div>
                     <br>
                     <?php } else {?>
                     <div class="form-row service-hide">
                        <div class="form-check col-md-5" style="margin-left: 19px;">
                           <input class="form-check-input" type="checkbox" id="meddistant_accommodation_hotel" value="Meddistant or Hostiptal will arrange" checked name="accommodation"  >
                           <label class="form-check-label" for="meddistant_accommodation_hotel">Meddistant or Hostiptal will arrange</label>
                        </div>
                     </div>
                     <br>
                     <?php }
                        ?>
                     <div class="form-row accommodation_section service-hide">
                        <div class="form-group col-md-6">
                           <label for="">Hotel Accommodation for
                           <?php
                              if ($selected_quote_data['stay_length'] != 'N/A' && !empty($selected_quote_data['stay_length'])) {
                                if ($selected_quote_data['accomodations'] == 'yes') {
                                  $total_stay_day = $selected_quote_data['stay_length'];
                                } else {
                                  $total_stay_day = $selected_quote_data['stay_length'] + 2;
                                }
                              } else {
                                $total_stay_day = 2;
                              }
                              echo $total_stay_day;
                              ?>
                           Days Recommended</label>
                           <input type="hidden" value="<?=$total_stay_day?>" id="total_stay_day" name="total_stay_day">
                           <input type="hidden" value="<?=$selected_quote_data['accomodations']?>" id="get_accomodations">
                           <input type="hidden" value="<?=$selected_quote_data['quote_by']?>" id="get_quote_by">
                           <?php
                              if ($selected_quote_data['accomodations'] == 'yes') {
                                ?>
                           <input type="text" readonly   class="form-control"  value="<?=$selected_quote_data['hotel_name']?> (Total $<?=$selected_quote_data['hotel_cost']?>)">
                           <input type="hidden" readonly name="hotel_accommodation"   class="form-control" id="accommodation_hotel" value="<?=$selected_quote_data['hotel_cost']?>">
                           <input type="hidden" readonly class="form-control" id="old_accommodation_hotel" value="<?=$selected_quote_data['hotel_cost']?>">
                           <?php } else {
                              ?>
                           <select name="hotel_accommodation" class="form-control" id="accommodation_hotel" >
                              <option value=""> Select Hotel Type</option>
                              <?php
                              if($selected_quote_data['country'] == 'USA')
                              {
                                 ?>
                                 <option value="135">3 or 4 Star Hotel ($135/day)</option>
                                 <option value="185">5 Star Hotel ($185/day)</option>
                                 <?php
                              }
                              else
                              { ?>
                                 <option value="94">3 or 4 Star Hotel ($94/day)</option>
                                 <option value="127">5 Star Hotel ($127/day)</option>
                             <?php }
                              ?>



                              
                           </select>
                           <?php
                              }
                              ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="">Flight/Travel to Destination</label>
                           <select name="travel_accommodation" <?=$required?> class="form-control" id="accommodation_travel">
                              <option value=""> ---Select---</option>
                              <option value="Will arrange my own">Will arrange my own</option>
                              <option value="Meddistant to arrange and invoice">Meddistant to arrange and invoice</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-row col-md-12 accommodation_section service-hide" style="padding: 0px;">
                        <div class="form-group col-md-6">
                           <label for="">Please Select Promotion</label>
                           <select name="accommodation_promotion" class="form-control" id="accommodation_promotion" >
                              <option value=""> Select Promotion Type</option>
                              <?php
                              if($selected_quote_data['treatment_cost'] >= 500 && $prepayment_hospital >= 10)
                              {
                              ?>
                              <option value="50">$50 Off discount</option>
                           <?php }
                           ?>
                           <?php
                           if(!empty($getHospitalDetail) && $getHospitalDetail->country != 'USA') {
                           ?>
                              <option value="0">Free one day guided tour </option>
                              <?php } ?>
                           </select>
                           <p id="discount-error" style="color:red;"></p>
                        </div>




                     </div>
                     <div class="form-row col-md-12 service-hide">
                        <div class="form-check col-md-6" style="margin-top: 0.7em;">
                           <input class="form-check-input" type="checkbox" id="companion" value="companion" name="companion"   >
                           <label class="form-check-label" for="companion">Select if companion is coming with you</label>
                        </div>
                        <div class="form-check col-md-6 companion_name_show" style="display: none;">
                           <input  type="text" class="form-control" id="companion_name" name="companion_name" placeholder="Enter companion name here." >
                        </div>
                     </div>
                     <?php
                     if ($this->session->userdata('user_type') == "agent") {
                     ?>
                     <div class="form-row col-md-12 service-hide">
                        <div class="form-check col-md-6" style="margin-top: 0.7em;">
                           <input class="form-check-input" type="checkbox" data-val="<?=$selected_quote_data['facilitation_fees']?>" id="facilitation_fee_cash" name="facilitation_fee_cash"   >
                           <label class="form-check-label" for="facilitation_fee_cash">Facilitation Fee paid in Cash</label>
                        </div>
                     </div>
                     <?php }
                      ?>
                         <hr>

                     <div class="form-row col-md-12 service-hide"  style="margin-top: 0.7em;">
                        <div class="col-md-10" style="padding-left: 27px;margin-top: 1.7em;">
                           <div style="display: none;">
                              <input  type="radio" id="full_prepayment" class="payment_type" value="full_prepayment"  name="prepayment_accommodation" <?=$required?>    >
                              <label  for="full_prepayment">Full Prepayment</label>
                              <p style="color:red;">(If you prefer or financed)</p>
                           </div>
                        </div>
                        <div class="col-md-2" style="">
                           <input type="radio" id="Prepayment" class="payment_type" value="pre_payment" checked name="prepayment_accommodation"  <?=$required?>  >
                           <label style="color: green;font-size: 18px;font-weight: bold;" for="Prepayment">Payments</label>
                           <input type="hidden" id="get_prefer_payment_percent"  value="<?=!empty($prepayment_hospital) ? $prepayment_hospital : '0'?>"  >
                        </div>
                     </div>


                  
                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b><?=$selected_quote_data['type']?> Total ($):</b></div>
                        </div>
                        <div align="right"><?=!empty($selected_quote_data['treatment_cost']) ? $selected_quote_data['treatment_cost'] : 'To be determined'?></div>
                     </div>
                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;display: none;">
                        <div align="right">
                           <div><b><?=!empty($prepayment_hospital) ? $prepayment_hospital : '0'?>% of Total ($):</b></div>
                        </div>
                        <div align="right" id="quoted_price">0</div>
                     </div>
                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Hotel ($):</b></div>
                        </div>
                        <div align="right" id="quoted_hotel_price">0</div>
                     </div>
                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Discount ($):</b></div>
                        </div>
                        <div align="right" id="total_discount_html">0</div>
                     </div>


                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Promotion ($):</b></div>
                        </div>
                        <div align="right" id="quoted_promotion_price">0</div>
                     </div>

                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Facilitation fee ($):</b></div>
                        </div>
                        <div align="right" id="get_facilitation_fee"><?=$selected_quote_data['facilitation_fees']?></div>
                     </div>
              


                     <div class="checkout-total form-row" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Paid Today ($):</b></div>
                        </div>
                        <div align="right" id="total_checkout_price_html"><?=$selected_quote_data['treatment_cost'] + $selected_quote_data['facilitation_fees']?></div>

                        
                        <input type="hidden" name="total_facilitation_fee" id="total_facilitation_fee" value="<?=$selected_quote_data['facilitation_fees']?>">
                        <input type="hidden" name="total_checkout_price" id="total_checkout_price" value="<?=$selected_quote_data['treatment_cost']?>">
                        <input type="hidden" name="final_amount" id="final_amount" value="<?=$selected_quote_data['treatment_cost']?>">
                        <input type="hidden" name="remaining_payment" id="remaining_payment" value="0">
                        <input type="hidden" name="total_discount" id="total_discount" value="0">
                        <input type="hidden" name="coupon_code" id="coupon_code_ajax" value="">
                        <input type="hidden" name="discount_type" id="discount_type" value="">
                        <input type="hidden" name="discount_amount_percent" id="discount_amount_percent" value="">


                     </div>
                     <div class="checkout-total form-row service-hide" style="padding-bottom: 10px;">
                        <div align="right">
                           <div><b>Remaining Pay at Hospital/Clinic ($):</b></div>
                        </div>
                        <div align="right" id="remaining_payment_html">0</div>
                     </div>
                     <div class="col-lg-12 mt-4" style="padding: 0px;">
                        <div class="card-box">
                           <div class="col-xl-12" style="padding: 0px;">
                              <ul class="nav nav-tabs service-hide">
                                 <h4 style="font-size: 20px" class="text-success">Continue To Checkout</h4>
                              </ul>
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="funds">
                                    <p class="service-hide" style="margin-top: 10px;">Do you have a coupon code? Use that code to get extra discount.
                                    </p>
                                    <div class="col-md-6 coupon_code_section service-hide" style=" padding-left: 0px; margin-bottom: 20px;">
                                       <div class="row">
                                          <div class="col-md-9">
                                             <input type="text" class="form-control" id="coupon_code" style="text-transform: uppercase;" placeholder="Enter Coupon code here.">
                                          </div>
                                          <div class="col-md-3 text-right p-0">
                                             <button type="button" id="apply_coupon" class="btn btn-success btn-block">Apply</button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="mb-3" style="background: #f3f3f3; padding: 15px 15px; color: #0b0b0b">
                                       <span class="col-md-4 radio radio-info radio-inline">
                                       <input type="radio" required id="inlineRadio02" class="payment_method" value="card" name="payment_method">
                                       <label for="inlineRadio02"> Credit Card </label>
                                       </span>
                                       <span class="col-md-4 radio radio-info radio-inline">
                                       <input type="radio" required id="inlineRadio0" class="payment_method" value="paypal" name="payment_method">
                                       <label for="inlineRadio0"> Pay Pal </label>
                                       </span>

                                       <span class="col-md-4 radio radio-info radio-inline" id="no_payment" style="display: none;">
                                          <input type="radio" required id="inlineRadio5" class="payment_method no_payment_required" value="no_payment" name="payment_method">
                                          <label for="inlineRadio5"> No payment </label>
                                       </span>

                                       <div class="clearfix"></div>
                                       <img src="<?=base_url()?>assets/paypal/payment.png">
                                    </div>
                                    <div class="col-md-12 m-t-20 p-0">
                                       <input type="submit" class="btn btn-primary btn-block btn-lg" id="paypal_btn" value="Continue and Pay">
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                           </div>
                           <div id="strip_layout"></div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
   $('document').ready(function(){
   
   $('form#payment_form').on('submit', function (e) {
       e.preventDefault();
       var payment_type = $("input[name='payment_method']:checked").val();
       if(payment_type == 'card')
       {
           var amount = $('#final_amount').val();
           StripeCheckout.open({
               key:         "<?php echo $this->config->item('stripe_publishable_key'); ?>",
               amount:      amount * 100,
               name:        'Meddistant.com',
               panelLabel:  'Checkout',
               token: function(token) {
                   $("#stripeToken").val(token.id);
                   $("#stripeEmail").val(token.email);
                   e.currentTarget.submit();
               }
           });
       }
       else
       {
           e.currentTarget.submit();
       }
   });


       var value = 'pre_payment';
       $('.payment_type').change(function(){
            value = $(this).val();
            cal(value);
       });


          
   $('#facilitation_fee_cash').change(function(){
      var amount = $(this).attr('data-val');
      if(this.checked)
      {  
         $('#total_facilitation_fee').val('0');

      }
      else
      {
         $('#total_facilitation_fee').val(amount);
      }
      cal(value);
   });
   



   
   
       $('#meddistant_accommodation').change(function(){
           if(this.checked)
           {
               $('#accommodation_hotel').val('94');
           }
           else
           {
               $('#accommodation_hotel').val('');
           }
            cal(value);
       });
   
        $('#meddistant_accommodation_hotel').change(function(){
   
           var price = $('#old_accommodation_hotel').val();
           if(this.checked)
           {
               $('#accommodation_hotel').val(price);
           }
           else
           {
               $('#accommodation_hotel').val('');
           }
            cal(value);
       });
   
   
   
   
   
       $('#accommodation_hotel').change(function(){
            cal(value);
       });
   
       $('#accommodation_promotion').change(function(){
            cal(value);
       });
   
       $('#apply_coupon').click(function(){
   
           var coupon_code = $('#coupon_code').val();
           if(coupon_code != '')
           {
               var amount = $('#total_checkout_price').val();
               $.ajax({
                   type:'POST',
                   url:"<?=base_url()?>customer_checkout/apply_coupon",
                   data: {coupon_code: coupon_code,amount:amount},
                   dataType: 'JSON',
                   success:function(data){
                       if(data.coupon_code)
                       {
                           $('#coupon_code_ajax').val(data.coupon_code);
                           $('#discount_type').val(data.discount_type);
                           $('#discount_amount_percent').val(data.discount_amount_percent);
   
   
                           $('#apply_coupon').html('Applied');
                           $('#coupon_code').prop('readonly',true);
                           $('#apply_coupon').prop('disabled',true);
                       }
                       else
                       {
                           $('#coupon_code_ajax').val(data.coupon_code);
                           $('#discount_type').val(data.discount_type);
                           $('#discount_amount_percent').val(data.discount_amount_percent);
                           alert('Discount code not found.');
                       }
   
                       cal(value);
                   }
               });
           }
           else
           {
               alert('Discount code not found.');
           }
   
       });
   
   
       function cal(payment_type = '') {
           $(".no_payment_required"). prop("checked", false);


           var total_stay_day = $('#total_stay_day').val();
           var total_facilitation_fee = $('#total_facilitation_fee').val();
           var total_checkout_price = $('#total_checkout_price').val();
           var accommodation_hotel = $('#accommodation_hotel').val();
           var accommodation_promotion = $('#accommodation_promotion').val();
           var total_discount = $('#total_discount').val();
           var get_accomodations = $('#get_accomodations').val();
   
           var get_quote_by = $('#get_quote_by').val();
   
           var get_prefer_payment_percent = $('#get_prefer_payment_percent').val();
   
   
   
   
           var discount_type = $('#discount_type').val();
           var discount_amount_percent = $('#discount_amount_percent').val();
           var remaining_payment = 0;
           var total_remaining_payment = 0;
   
           if(payment_type == 'pre_payment')
           {
                 var total_checkout_price_pre = (parseFloat(total_checkout_price) * parseFloat(get_prefer_payment_percent)) / 100;
   
                 remaining_payment = parseFloat(total_checkout_price) - parseFloat(total_checkout_price_pre);
   
                 total_remaining_payment = remaining_payment;
                 $('#quoted_price').html(total_checkout_price_pre.toFixed(2));
           }
           else
           {
                 var total_checkout_price_pre = total_checkout_price;
                 $('#quoted_price').html('0');
           }
   
   
   
           if(discount_type == 'amount' || discount_type == 'percent')
           {
               if(discount_type == 'amount')
               {
                   total_discount = parseFloat(discount_amount_percent);
               }
               else
               {
                   total_discount = (parseFloat(total_checkout_price) * discount_amount_percent) / 100;
               }
   
               $('#total_discount_html').html(total_discount.toFixed(2));
               $('#total_discount').val(total_discount.toFixed(2));
   
   
           }
   
           if(total_discount == '')
           {
               total_discount = 0;
           }
   
           if(total_stay_day == '')
           {
               total_stay_day = 0;
           }
   
           if(accommodation_promotion == '')
           {
               accommodation_promotion = 0;
           }
   
           if(accommodation_hotel == '')
           {
               accommodation_hotel = 0;
           }
   
           if(total_checkout_price == '')
           {
               total_checkout_price = 0;
           }
   
           total_checkout_price = parseFloat(total_checkout_price) - parseFloat(total_discount);
   
           if(get_accomodations == 'yes')
           {
               var total_stay = parseFloat(accommodation_hotel);
           }
           else
           {
               var total_stay = parseFloat(total_stay_day) * parseFloat(accommodation_hotel);
           }
   
   
           $('#quoted_hotel_price').html(total_stay);
           $('#quoted_promotion_price').html(accommodation_promotion);
   
           if(get_accomodations == 'yes' && get_quote_by != 'Meddistant' && get_quote_by != 'Hospital/Clinic')
           {
               var total = parseFloat(total_checkout_price);
               total = parseFloat(total) - parseFloat(accommodation_promotion);
               remaining_payment = parseFloat(remaining_payment) + parseFloat(total_stay);
           }
           else
           {
               var total = parseFloat(total_checkout_price) + parseFloat(total_stay);
               total = parseFloat(total) - parseFloat(accommodation_promotion);
           }
   
   
           if(payment_type == 'pre_payment')
           {
   
   
   
                if(get_accomodations == 'yes' && get_quote_by != 'Meddistant' && get_quote_by != 'Hospital/Clinic')
                {
                     var pre_payment = parseFloat(total) - parseFloat(total_remaining_payment);;   
                }
                else
                {
                     var pre_payment = parseFloat(total) - parseFloat(remaining_payment);
                }
      
      
                pre_payment  = parseFloat(pre_payment) + parseFloat(total_facilitation_fee);
   
               // var remaining_payment = parseFloat(total) - parseFloat(pre_payment);
               $('#total_checkout_price_html').html(pre_payment.toFixed(2));

               if (pre_payment == '0') {
                  $('#no_payment').show();
               }

               $('#final_amount').val(pre_payment.toFixed(2));
               $('#remaining_payment').val(remaining_payment.toFixed(2));
               $('#remaining_payment_html').html(remaining_payment.toFixed(2));
           }
           else
           {
               $('#no_payment').hide();
               total = parseFloat(total) + parseFloat(total_facilitation_fee);
               $('#remaining_payment').val(remaining_payment.toFixed(2));
               $('#remaining_payment_html').html(remaining_payment.toFixed(2));
               $('#total_checkout_price_html').html(total.toFixed(2));
               $('#final_amount').val(total.toFixed(2));
           }
       }
   
       cal(value);
   
       $('#companion').change(function(){
           if(this.checked)
           {
               $('.companion_name_show').show();
           }
           else
           {
               $('.companion_name_show').hide();
           }
       });
   });
</script>
