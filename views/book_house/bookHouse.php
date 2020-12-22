<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<![endif]-->

<head>
	
<!--	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">-->
	
	
	

	
	
</head>
<body class="cssAnimate ct-headroom--scrollUpMenu beach">
<div class="ct-preloader">
	<div class="ct-preloader-content"></div>
</div>





















<div id="ct-js-wrapper" class="ct-pageWrapper">
	<div class="ct-navbarMobile ct-navbarMobile--inverse">
		<a class="navbar-brand" href="index.html">
			<div class="ct-logo">
				<h1>Houses <span>rent</span></h1>
				<img src="<?php echo base_url(); ?>assets/images/demo-content/beach-logo.png" alt="Logo Beach">
			</div>
		</a>
		<button type="button" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	
	
	<div class="container" id="bookingNextStage">
		<div class="row">
			<div class="col-md-12">
				<div class="ct-category">
					<i class="fa fa-home"></i>
					<i class="fa fa-chevron-right ct-u-size9"></i>
					<span>Contact Info</span>
				</div>
			</div>
		</div>
		
		
		
		
		
		
		
		
		<div class="row ct-u-paddingBottom70 ">
			
			<div class="col-md-8" style="background: #fff; box-shadow: 0 0 10px #ededed">
				<div class="row">
					<?php $attributes = array('class' => 'ct-bookForm', 'id' => 'reservation');
					echo form_open('BookHouse/save_reservation', $attributes); ?>
				
					<?php $cal_price = $booking_prices_data['price_per_night'] * $booking_data['total_nights'];
					  $total_price = $cal_price + $booking_prices_data['cleaning_fee']; ?>
					
					<input type="hidden" name="checkin" value="<?php echo $booking_data['checkin']; ?>">
					<input type="hidden" name="checkout" value="<?php echo $booking_data['checkout']; ?>">
					<input type="hidden" name="total_nights" value="<?php echo $booking_data['total_nights']; ?>">
					<input type="hidden" name="adults" value="<?php echo $booking_data['adults']; ?>">
					<input type="hidden" name="children" value="<?php echo $booking_data['children']; ?>">
					<input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
					
					
					<div class="successMessage alert alert-success ct-u-marginTop20" style="display: none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<span></span>
					</div>
					<div class="errorMessage alert alert-danger ct-u-marginTop20" style="display: none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<span></span>
					</div>
					
					
						<h4 class="ct-u-paddingBottom40"  style="font-family: ; margin: 20px 0 0 18px">Begin your booking</h4>
				
					
					<div class="input-group col-md-12 ct-u-paddingBoth5">
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" placeholder="First Name" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
							</div>
						</div>
					</div>
					
					<div class="input-group col-md-12 ct-u-paddingBoth5">
						<div class="row">
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" placeholder="email" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_no" placeholder="phone" required>
							</div>
						</div>
					</div>
					
					
					<div class="input-group col-md-12 ct-u-paddingTop30 ct-u-paddingBottom25">
						<button type="submit" class="btn btn-primary">Reserve Now</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			
			
			
			<div class="col-md-4 ct-u-paddingRight45 hidden-sm hidden-xs">
				<h4 style="padding-top: 5px;padding-bottom: 10px;">Reservation Details </h4>
			
				<img src="<?php echo base_url()?>assets/images/booking.jpg" alt="Book House">
				
				<div class="ct-u-paddingBoth10 font-weight-bold" style="display: inline-block">
					Year round beach house with all the comforts of home.
					York, ME, US
				</div>
				<div class="col-md-12 bg-white" style="display: table; padding: 0; border: 1px solid rgba(7,6,3,0.16); background: #fff">
				<div class="col-md-6 ct-u-paddingBoth10" style="display: table-cell; border-right: 1px solid rgba(7,6,3,0.16); font-size: 13px">
					<span style="color: #99ADB6; line-height: 20px;">Check-In</span> <br> <?php echo date('D M d, ', strtotime($booking_data['checkin'])) . '4:00pm'; ?>
				</div>
				<div class="col-md-6 ct-u-paddingBoth10" style="display: table-cell;  font-size: 13px">
					<span style="color: #99ADB6; line-height: 20px;">Checkout</span> <br> <?php echo date('D M d, ', strtotime($booking_data['checkout'])) . '11:00am'; ?>
				</div>
			</div>
				
				
				
				
				
				
					<div style="display: inline-block; padding: 15px; background: white;">
						
						
							<div class="col-md-6 ct-u-paddingBoth5">
								Rent (<?php echo $booking_data['total_nights']; ?> nights)
							</div>
							<div class="col-md-6 text-right ct-u-paddingBoth5">
								<?php echo '$'.number_format($booking_prices_data['price_per_night'] * $booking_data['total_nights'], 2); ?>
							</div>
							<div class="col-md-6 ">
								Cleaning Fee
							</div>
							<div class="col-md-6 text-right">
								<?php echo '$'.$booking_prices_data['cleaning_fee']; ?>
							</div>
						
						
							<div class="col-md-6 ct-u-paddingBoth15">
								<strong>Total</strong>
							</div>
							<div class="col-md-6 text-right ct-u-paddingBoth15">
								<strong>
									<?php
									$cal_price = $booking_prices_data['price_per_night'] * $booking_data['total_nights'];
									echo '$'.number_format($cal_price + $booking_prices_data['cleaning_fee'], 2);
									
									?>
								</strong>
							</div>
						
						
						
						
						
						<hr />
					
					</div>
			
			
			
	
		</div>
		</div>
	</div>
	
	
	
	
	
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function () {
			// Handler for .ready() called.
			$('html, body').animate({
				scrollTop: $('#bookingNextStage').offset().top,
			}, 'slow');
		});
	</script>

</body>

</html>
