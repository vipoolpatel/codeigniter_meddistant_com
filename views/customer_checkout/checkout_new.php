<main>
    <style>
        .radio label,
        .checkbox label {
            cursor: pointer;
        }
    </style>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Schedule Treatment</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">Quote Received by Facility</li>
                        <li class="breadcrumb-item active" aria-current="page">Schedule Treatment</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>

            </div>
        </div>

        <div class="col-12">
            <?php if ($this->session->flashdata('error_message')) { ?>
                <div class="alert alert-danger alert-dismissible fade show rounded">
                    <?php echo $this->session->flashdata('error_message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php } ?>
                    <?php if ($this->session->flashdata('success_message')) { ?>
                        <div class="alert alert-success alert-dismissible fade show rounded">
                            <?php echo $this->session->flashdata('success_message'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <?php } ?>
                            <?php
					$total_treatment_price = $selected_quote_data['treatment_cost'];
					$quoted_price = $total_treatment_price / 100 *(15);
				//	$quoted_price = 300;
				?>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Schedule Treatment</h5>
                        <?php $attributes = array('class' => '', 'id' => 'checkout_form');
							echo form_open('customer_checkout/apply_coupon', $attributes); ?>
                            <input type="hidden" id="session" name="session" value="<?php if($this->session->userdata('accommodation')) { echo 'yes';} else { echo 'no';} ?>">

                            <input type="hidden" name="total_quote_price" id="total_quote_price" value="<?php 	if($this->session->userdata('total_before_coupon')) {
										if($this->session->userdata('coupon_discount') != '') {
											echo (number_format($this->session->userdata('total_before_coupon') - 150, 2,'.', ''));
										} else {
											echo $this->session->userdata('total_before_coupon');
										}
									} else {
										echo number_format($quoted_price, 2, '.', '');
									} ?>">
                            <input type="hidden" id="payment_method" name="payment_method">
                            <input type="hidden" name="quote_sent_id" value="<?php echo $this->uri->segment(3); ?>">
                            <input type="hidden" name="procedure_treatment" value="<?php echo $selected_quote_data['procedure_treatment']; ?>">
                            <input type="hidden" name="quote_request_id" value="<?php echo $selected_quote_data['quote_request_id']; ?>">
                            <input type="hidden" name="total_before_coupon" id="total_before_coupon" value="<?php if($this->session->userdata('total_before_coupon')) {echo $this->session->userdata('total_before_coupon'); } else {echo number_format($quoted_price, 2, '.', '');} ?>">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Select Treatment Date <span style="color:red;">(Select 7 day range, Meddistant will confirm a date within the range)</span> </label>
                                    <select name="schedule_treatment" required class="form-control">
                                        <?php 
										/* for( $days = 7; $days--; ) {
											<option <?php ///if($selected_schedule_treatment==$treatment_date) { ?> selected
																							<?php  //} ?>>
																								<?php// echo $treatment_date ?>
																						</option>
											}
										?>     */ ?>
										<?php
											//$date = new DateTime('+5 days');
											
											
											//$date = new DateTime('-1 days');
											
                                            $selected_schedule_treatment = $this->session->userdata('schedule_treatment') == '' ? '' : $this->session->userdata('schedule_treatment');
											/* $previous_week_at = strtotime("-1 week");
											$start_week_at = strtotime("+0 day",$previous_week_at);
											$end_week_at = strtotime("+7 day",$start_week_at);
											$start_week_at= date("d M,Y ",$start_week_at);
											$end_week_at = date("d M,Y",$end_week_at);
											$treatment_date_at = $start_week_at.' --- '.$end_week_at; */ ?>
											<!--<option value="<?php echo $treatment_date_at; ?>"><?php echo $treatment_date_at; ?></option>-->
											<?php for($total_duration = 0;$total_duration<=12; $total_duration++ ){
												$previous_week = strtotime("+".$total_duration." week");
												$start_week = strtotime("+0 day",$previous_week);
												$end_week = strtotime("+7 day",$start_week);
												$start_week = date("d M,Y ",$start_week);
												$end_week = date("d M,Y",$end_week);
												$treatment_date = $start_week.' --- '.$end_week;
											?>
											 <option value="<?php echo $treatment_date; ?>" <?php if($selected_schedule_treatment==$treatment_date) { ?> selected
																							<?php  } ?>>
										
											<?php echo $treatment_date; ?>
										
                                            </option>
											<?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-check col-md-5" style="margin-left: 19px;">
                                    <input class="form-check-input" type="checkbox" id="own_accommodation" value="own_accommodation" name="accommodation" required <?php if($this->session->userdata('accommodation') == 'own_accommodation') { ?> checked <?php  } ?> >
                                    <label class="form-check-label" for="own_accommodation">Hotel/Stay</label>
                                </div>
                                <div class="form-check col-md-5" style="margin-left: 85px;">
                                    <input class="form-check-input" type="checkbox" id="meddistant_accommodation" value="meddistant_accommodation" name="accommodation" required <?php if($this->session->userdata('accommodation') == 'meddistant_accommodation') { ?> checked
                                    <?php  } ?> >
                                        <label class="form-check-label" for="meddistant_accommodation">Meddistant will arrange your hotel accommodations</label>
                                </div>
							</div>
							<br>
                            <div class="form-row accommodation_section" style="<?php if($this->session->userdata('hotel_accommodation')) { ?>display: flex; <?php } else { ?> display: flex; <?php } ?>">
                                <div class="form-group col-md-6">
                                    <label for="">Hotel Accommodation for 1 week stay</label>
                                    <select name="hotel_accommodation" class="form-control" id="accommodation_hotel">
                                        <option value=""> Select Hotel Type</option>
                                        <option value="100" <?php if($this->session->userdata('hotel_accommodation') == '100') { ?> selected
                                            <?php  } ?>>3 or 4 Star Hotel ($100/day)</option>
                                        <option value="140" <?php if($this->session->userdata('hotel_accommodation') == '140') { ?> selected
                                            <?php  } ?>>5 Star Hotel ($140/day)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Flight/Travel to Destination</label>
                                    <select name="travel_accommodation" class="form-control" id="accommodation_travel">
                                        <option value=""> ---Select---</option>
                                        <option value="own" <?php if($this->session->userdata('travel_accommodation') == 'own') { ?> selected
                                            <?php  } ?>>Will arrange my own</option>
                                        <option value="meddistant" <?php if($this->session->userdata('travel_accommodation') == 'meddistant') { ?> selected
                                            <?php  } ?>>Meddistant to arrange and invoice</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-row col-md-12 accommodation_section" style="padding: 0px;<?php if($this->session->userdata('hotel_accommodation')) { ?>display: flex; <?php } else { ?> display: flex; <?php } ?>">
								<div class="form-group col-md-6">
                                    <label for="">Please Select Promotion</label>
                                    <select name="accommodation_promotion" class="form-control" id="accommodation_promotion">
                                        <option value="0"> Select Promotion Type</option>
                                        <option value="100" <?php if($this->session->userdata('accommodation_promotion') == '100') { ?> selected
                                            <?php  } ?>>$100 Off ($100 for one day)</option>
                                        <option value="0" <?php if($this->session->userdata('accommodation_promotion') == '0') { ?> selected
                                            <?php  } ?>>Free one guided tour </option>
                                    </select>
                                    <p id="discount-error" style="color:red;"></p>
                                </div>
								<div class="col-md-3" style="padding-left: 27px;margin-top: 1.7em;">
                                    <input  type="radio" id="Prepayment_accommodation" value="prepayment_accommodation" name="prepayment_accommodation" <?php if($this->session->userdata('prepayment_accommodation') == 'prepayment_accommodation') { ?> checked
                                    <?php  } ?>  required  >
                                        <label  for="prepayment_accommodation">Full Prepayment</label>
										<p style="color:red;">(If you prefer or financed)</p>
                                </div>
								<div class="col-md-3" style="padding-left: 27px;margin-top: 1.7em;">
                                    <input type="radio" id="discount_prepayment_accommodation" value="discount_prepayment_accommodation" name="prepayment_accommodation" <?php if($this->session->userdata('prepayment_accommodation') == 'discount_prepayment_accommodation') { ?> checked
                                    <?php  } ?>  required  >
                                        <label for="discount_prepayment_accommodation">Prepayment</label>
										<p style="color:red;">(If you prefer 20% payment)</p>
                                </div>
							</div>
							<div class="form-row col-md-12 accommodation_section" style="<?php if($this->session->userdata('hotel_accommodation')) { ?>display: flex; <?php } else { ?> display: flex; <?php } ?>">
								 <div class="form-check col-md-6" style="padding-left: 27px;margin-top: 0.7em;">
                                    <input class="form-check-input" type="radio" id="companion" value="companion" name="companion" <?php if($this->session->userdata('companion') == 'companion') { ?> checked
                                    <?php  } ?>  required >
                                    <label class="form-check-label" for="companion">Select if companion is coming with you</label>
                                </div>
                                <div class="form-check col-md-6 companionName" style="<?php if($this->session->userdata('companion_name')) { ?>display: flex; <?php } else { ?> display: flex; <?php } ?>">
                                    <input  type="text" class="form-control" id="companion_name" name="companion_name" placeholder="Enter companion name here." value="<?php if(!empty($this->session->userdata('companion_name'))) { echo $this->session->userdata('companion_name'); } ?>" required >
                                </div>
							</div>
                            <script>
                                $(document).ready(function() {
									$("input[name$='companion']").click(function() {
										var companion_name = $('#companion').val();
										if (companion_name === 'companion') {
											 $('.companionName').css('display', 'block');
										}else{
											$('.companionName').css('display', 'block');
										}
									});
                                    var quoted_price_val = $('#quoted_price_val').val();
                                    quoted_price_val = quoted_price_val.replace(/,/g, "");

										
                                    
                                    $("input[name$='accommodation']").click(function() {
                                        var accommodation = $(this).val();

                                        if (accommodation === 'meddistant_accommodation') {

                                            $('.accommodation_section').css('display', 'flex');
                                            var total_before_coupon = $('#total_before_coupon').val();
                                            <?php if($this->session->userdata('coupon_discount')) { ?>

                                            $('#total_quote_price').val(total_before_coupon - 150);

                                            <?php } else { ?>
                                            $('#total_quote_price').val(total_before_coupon);
                                            <?php } ?>

                                        } else {
                                            $('.accommodation_section').css('display', 'flex');
                                            $('#accommodation_cost').text(0);

                                            <?php if($this->session->userdata('coupon_discount')) { ?>
                                            $('#total_quote_price').val(quoted_price_val - 150);
                                            $('#total_checkout_price').text(quoted_price_val - 150);
                                            $('#total_before_coupon').val(quoted_price_val - 150);
                                            $('.total_to_pay').text('$' + (quoted_price_val - 150));

                                            <?php } else { ?>

                                            $('#total_checkout_price').text(quoted_price_val);
                                            $('#total_before_coupon').val(quoted_price_val);
                                            $('#total_quote_price').val(quoted_price_val);

                                            <?php } ?>

                                            //$('#accommodation_hotel').val('');
                                        }
                                    });
                                    $('#accommodation_hotel').change(function() {
										var accommodation_promotion = $('#accommodation_promotion').val();
										var prepayment_accommodation = $("input[name='prepayment_accommodation']:checked").val();
                                        
                                        var hotel_accommodation_cost = $(this).val() * 7;
										//alert(prepayment_accommodation);
                                        $('#accommodation_cost').text('$' + hotel_accommodation_cost);

                                        var is_coupon_available = $('#is_coupon_available').val();

                                        if (is_coupon_available === 'yes') {
                                            var total_before_coupon = parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - 150;
                                            $('#total_checkout_price').text('$' + (parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - 150 - parseInt(accommodation_promotion)));
                                            $('.total_to_pay').text('$' + total_before_coupon);

                                        } else {
                                            var total_before_coupon = parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost);
											if(prepayment_accommodation =='discount_prepayment_accommodation'){
												var Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost))- parseInt(accommodation_promotion));
												// Totalvalue = Totalvalue ;
												//console.log(Totalvalue);
												 $('#total_checkout_price').text(Totalvalue+'.00');
												 $('#total_quote_price').val(Totalvalue);
											}else{
												$('#total_checkout_price').text('$' + (parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - parseInt(accommodation_promotion)));
												$('#total_quote_price').val(parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - parseInt(accommodation_promotion));
											}

                                        }

                                        $('#total_before_coupon').val(total_before_coupon);

                                    })
									$('#accommodation_promotion').change(function() {
										var prepayment_accommodation = $("input[name='prepayment_accommodation']:checked").val();
                                        var accommodation_promotion = $(this).val();
										var hotel_accommodation_cost = $('#accommodation_hotel').val() * 7;
                                        $('#accommodation_cost').text('$' + hotel_accommodation_cost);

                                        var is_coupon_available = $('#is_coupon_available').val();

                                        if (is_coupon_available === 'yes') {
                                            var total_before_coupon = parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - 150;
                                            $('#total_checkout_price').text('$' + (parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - 150- parseInt(accommodation_promotion)));
                                            $('.total_to_pay').text('$' + total_before_coupon);

                                        } else {
                                            var total_before_coupon = parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost);
											if(prepayment_accommodation =='discount_prepayment_accommodation'){
												 var Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost)));
												 //var Totalvalue   = ((20 * parseInt(quoted_price_val))/100) + parseInt(hotel_accommodation_cost);
												 if(Totalvalue > accommodation_promotion){
													Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost))- parseInt(accommodation_promotion));
												    $('#discount-error').text(' ');
												 }else{
												//	Totalvalue = Totalvalue; 
													Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost))- parseInt(accommodation_promotion));
													$('#discount-error').text('Discount greater than original value');
												 }
												 $('#total_checkout_price').text('$' +Totalvalue+'.00');
												 $('#total_quote_price').val(Totalvalue);
												 $('#total_before_coupon').val(Totalvalue);
											}else if(prepayment_accommodation =='prepayment_accommodation'){
												var TotalValue = parseInt(quoted_price_val) + parseInt(hotel_accommodation_cost) - parseInt(accommodation_promotion);
												$('#total_checkout_price').text('$' + TotalValue);
												$('#total_quote_price').val(TotalValue);
												$('#total_before_coupon').val(TotalValue);
											}
                                            
                                        }

                                        $('#total_before_coupon').val(total_before_coupon);


                                    })
									$("input[name$='prepayment_accommodation']").click(function() {
										var Paccommodation = $(this).val();
									//	var hotel_accommodation_cost = $('#accommodation_hotel').val() * 7;
										
										if(Paccommodation == 'discount_prepayment_accommodation'){
											 var accommodation_promotion = $('#accommodation_promotion').val();
											 var quoted_price_val = $('#quoted_price_val').val();
											 quoted_price_val = quoted_price_val.replace(/,/g, "");
											 var accommodation_hotel = $('#accommodation_hotel').val() * 7;
											 
											 $('#accommodation_cost').text('$' + accommodation_hotel);
											 
											 //var Totalvalue   = qouted_value/100 *20;
											// console.log(quoted_price_val+'--'+accommodation_hotel);
											 var Totalvalue   = .20 * quoted_price_val + accommodation_hotel;
											// console.log(Totalvalue);
											// var Totalvalue   = ((20 * parseInt(quoted_price_val))/100) + parseInt(accommodation_hotel);
											if(Totalvalue > accommodation_promotion){	 
												Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(accommodation_hotel))- parseInt(accommodation_promotion));
												$('#discount-error').text(' ');
											}else{
											    Totalvalue   = .20 * ((parseInt(quoted_price_val) + parseInt(accommodation_hotel))- parseInt(accommodation_promotion));
											    $('#discount-error').text('Discount greater than original value');
											//	Totalvalue = Totalvalue ;
											}
											 $('#total_checkout_price').text('$' + Totalvalue+'.00');
											$('#total_quote_price').val(Totalvalue);
											$('#total_before_coupon').val(Totalvalue);
										}else{
										    $('#discount-error').text(' ');
											var quoted_price_val = $('#quoted_price_val').val();
											price = quoted_price_val.replace(/,/g, "");
											//var total_accomodate_price =  price.substr(0, price.indexOf('.'));
											var accommodation_promotion = $('#accommodation_promotion').val();
											var accommodation_hotel = $('#accommodation_hotel').val() * 7;
											$('#accommodation_cost').text('$' + accommodation_hotel);
											//alert(price+'--'+accommodation_promotion+'--'+accommodation_hotel);
											var total = parseInt(price) + parseInt(accommodation_hotel) - parseInt(accommodation_promotion);
											$('#total_checkout_price').text('$' + total+'.00');
											$('#total_quote_price').val(total+'.00');
											$('#total_before_coupon').val(total);
										} 
									})
                                });
                            </script>

                            <hr>

                            <div class="form-row">
                                <div class="col-md-5"></div>
                                <div class="col-md-4" align="right">
                                    <div><b>20% of total treatment:</b></div>
                                </div>
                                <input type="hidden" id="quoted_price_val" value="<?php echo number_format($quoted_price, 2, '.', ''); ?>">
                                <div class="col-lg-3" align="right" id="quoted_price">
                                    <?php echo '$'.number_format($quoted_price, 2, '.', ''); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6" align="right">
                                    <div><b>Accommodations charges per schedule above:</b></div>
                                </div>
                                <div class="col-lg-3" align="right" id="accommodation_cost">
                                    <?php if($this->session->userdata('hotel_accommodation')) { echo '$'.number_format($this->session->userdata('hotel_accommodation') * 7, 2, '.', ''); } else { echo '0';} ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6" align="right">
                                    <div style="font-size: 16px; letter-spacing: 2px; margin-top: 5px"><b>Total:</b></div>
                                </div>
                                <div class="col-lg-3" align="right" style=" color: black; font-size: 16px; letter-spacing: 1px;">
                                    <div id="total_checkout_price" style="margin-top: 5px">
                                        <?php
										if($this->session->userdata('total_before_coupon')) {

											if($this->session->userdata('coupon_discount') != '') {
												echo '$'. (number_format($this->session->userdata('total_before_coupon') - 150, 2));
											} else {
												echo '$'.$this->session->userdata('total_before_coupon');
											}
										} else {
											echo '$'.number_format($quoted_price);
										} ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-4">
                                <div class="card-box">
                                    <div class="col-xl-12">
                                        <ul class="nav nav-tabs">
                                            <h4 style="font-size: 20px" class="text-success">Continue To Checkout</h4>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="funds">
                                                <p>Do you have a coupon code? Use that code to get extra discount,
                                                    <br>(From promotion % of treatment cost/not accommodations) on any payment type below.</p>
                                                <div class="col-md-6 coupon_code_section" style=" padding-left: 0px; margin-bottom: 20px;">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="text" required name="coupon_code" class="form-control" id="coupon_code" placeholder="Enter Coupon card here." value="<?php if($this->session->userdata('coupon_code')) { echo $this->session->userdata('coupon_code'); } ?>  ">
                                                        </div>
                                                        <div class="col-md-3 text-right p-0">
                                                            <button type="button" id="apply_coupon" class="btn btn-success btn-block">Apply</button>
                                                        </div>
                                                    </div>
                                                    <div class="coupon_success text-success" style="<?php if($this->session->flashdata('is_coupon_available') == 'yes' || $this->session->userdata('coupon_discount') != '') { ?>display: block<?php } else { ?> display: none <?php } ?>">Coupon Discount Added Successfully</div>
                                                    <div class="coupon_error text-danger" style="<?php if($this->session->flashdata('is_coupon_available') == 'no') { ?>display: block<?php } else { ?> display: none <?php } ?>">Invalid / Expired Coupon Code</div>
                                                    <div class="coupon_data_section" style="<?php if($this->session->flashdata('is_coupon_available') == 'yes' || $this->session->userdata('coupon_discount') != '') { ?>display: block<?php } else { ?> display: none <?php } ?>">
                                                        <h5 class="float-left coupon_success text-danger" style="">
																		SAVING:
																		<span class = "total_saving_coupon">$150 </span><br>
																	</h5>
                                                        <h4 class="float-left coupon_success text-success" style="clear: both">
																		Total To Pay:
																		<span class = "total_to_pay">
																		<?php echo '$'. (number_format($this->session->userdata('total_before_coupon') - 150, 2)); ?>
																		</span><br>
																	</h4>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                </form>
                                                <form action="<?php echo base_url(); ?>customer_checkout/checkout" class="" id="payment_form" method="post" accept-charset="utf-8">

                                                    <input type="hidden" name="total_quote_price" value="<?php if($this->session->userdata('total_before_coupon')) {
																if($this->session->userdata('coupon_discount') != '') {
																	echo (number_format($this->session->userdata('total_before_coupon') - 150, 2, '.', ''));
																} else {
																	echo $this->session->userdata('total_before_coupon');
																}
															} else {
																echo number_format($quoted_price, 2, '.', '');
															} ?>">
                                                    <input type="hidden" name="quote_sent_id" value="<?php echo $this->uri->segment(3); ?>">
                                                    <input type="hidden" name="procedure_treatment" value="<?php echo $selected_quote_data['procedure_treatment']; ?>">
                                                    <input type="hidden" name="quote_request_id" value="<?php echo $selected_quote_data['quote_request_id']; ?>">

                                                    <div class="mb-3" style="background: #f3f3f3; padding: 15px 15px; color: #0b0b0b">

                                                        <span class="col-md-4 radio radio-info radio-inline">
															<input type="radio" required id="inlineRadio0" class="payment_method" value="paypal" name="payment_method">
															<label for="inlineRadio0"> Pay Pal </label>
														</span>

																<span class="col-md-4 radio radio-info radio-inline">
															<input type="radio" required id="inlineRadio02" class="payment_method" value="card" name="payment_method">
															<label for="inlineRadio02"> Credit Card </label>
														</span>

                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="col-md-12 m-t-20 p-0">
                                                        <input type="submit" class="btn btn-primary btn-block btn-lg" id="paypal_btn" value="Continue">
                                                    </div>

                                                    <div class="clearfix"></div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="strip_layout">
                                    </div>
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
<script>
	$('#apply_coupon').click(function () {
		
		var coupon_code = $('#coupon_code').val();
		
		if(coupon_code !== '') {
			$('form#checkout_form').submit();
		} else {
			alert("Please enter coupon code");
		}
		
		
	});
	$('form#payment_form').on('submit', function (e) {
		e.preventDefault();
		const payment_type = $("input[name='payment_method']:checked").val();
		var session = $('#session').val();
		
		if(session == 'no') {
			if(payment_type == 'paypal') {
				$('#payment_method').val(payment_type);
				$('form#checkout_form').submit();
			} else {
				var token = function(res){
					var $id = $('<input type=hidden name=stripeToken />').val(res.id);
					var $email = $('<input type=hidden name=stripeEmail />').val(res.email);
					$('form').append($id).append($email).submit();
				};
				
				<?php if($this->session->userdata('coupon_discount')) { ?>
				var amount = $('#total_quote_price').val();
				<?php } else { ?>
				
				var amount = $('#total_before_coupon').val();
			 	<?php } ?>
				
				
				if(payment_type == 'card') {
					
					StripeCheckout.open({
						key:         "<?php echo $this->config->item('stripe_publishable_key'); ?>",
						amount:      amount * 100,
						name:        'Meddistant.com',
						panelLabel:  'Checkout',
						token:       token
					});
					//$('#strip_form').trigger('click');
					//$('#custom_card_value').val($('#custom_value').val());
					
					//const btn1 = document.querySelector('#strip_form button');
					//btn1.click();
				}
				
			}
		} else {
			if(payment_type == 'paypal') {
				
				$(this).submit();
			} else {
				
				var token = function(res){
					var $id = $('<input type=hidden name=stripeToken />').val(res.id);
					var $email = $('<input type=hidden name=stripeEmail />').val(res.email);
					$('form').append($id).append($email).submit();
				};
				
				<?php if($this->session->userdata('coupon_discount')) { ?>
				var amount = $('#total_quote_price').val();
				<?php } else { ?>
				
				var amount = $('#total_before_coupon').val();
				<?php } ?>
				
				
				if(payment_type == 'card') {
					
					StripeCheckout.open({
						key:         "<?php echo $this->config->item('stripe_publishable_key'); ?>",
						amount:      amount * 100,
						name:        'Meddistant.com',
						panelLabel:  'Checkout',
						token:       token
					});
					//$('#strip_form').trigger('click');
					//$('#custom_card_value').val($('#custom_value').val());
					
					//const btn1 = document.querySelector('#strip_form button');
					//btn1.click();
				}
			}
		}

		
		return false;
	});
</script>