<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			var date = new Date();
			date.setDate(date.getDate()-1);
			
			$(function () {
				$('#checkin').datetimepicker({
					format: 'DD/MM/YYYY',
					minDate:new Date(),
					disabledDates: [
						moment("09/26/2018"),
						moment("09/29/2018"),
					]
				});
				$('#checkout').datetimepicker({
					format: 'DD/MM/YYYY',
					useCurrent: false,
					minDate:new Date(),
					disabledDates: [
						moment("09/26/2018"),
						moment("09/29/2018"),
					]
				});
				
				
				$("#checkin").on("dp.change", function (e) {
					if( e.date ){
						e.date.add(1, 'day');
					}
					$('#checkout').data("DateTimePicker").minDate(e.date);
				});
				$("#checkout").on("dp.change", function (e) {
					if( e.date ){
						e.date.subtract(1, 'day');
					}
					$('#checkin').data("DateTimePicker").maxDate(e.date);
				});
				
				
				
			});
		});
	</script>

	
	
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
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ct-category">
					<i class="fa fa-home"></i>
					<i class="fa fa-chevron-right ct-u-size9"></i>
					<a href="#"><span>Book Now</span></a>
				</div>
			</div>
		</div>
		<div class="row ct-u-paddingTop50 ct-u-paddingBottom70">
			<div class="col-md-4 ct-u-paddingRight45 hidden-sm hidden-xs">
				<img src="<?php echo base_url()?>assets/images/12376081_1311357635568858_131887275567425807_n.jpg" alt="Book House">
			</div>
			<div class="col-md-8">
				<div class="row">
					<?php $attributes = array('class' => 'ct-bookForm', 'id' => 'booking_inquiry');
					echo form_open('BookHouse/booking_inquiry', $attributes); ?>
					<div class="input-group col-md-12">
							<div class="ct-formSlash ct-u-marginBottom10"></div>
						</div>
					
					<div class="successMessage alert alert-success ct-u-marginTop20" style="display: none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<span></span>
					</div>
					<div class="errorMessage alert alert-danger ct-u-marginTop20" style="display: none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<span></span>
					</div>
					
					
						<div class="input-group col-md-12">
							<input type="text" class="form-control" name="name" placeholder="name" required>
						</div>
						<div class="input-group col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" placeholder="email" required>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="phone_no" placeholder="phone" required>
								</div>
							</div>
						</div>
						<div class="input-group col-md-12">
							<div class="ct-formSlash ct-u-marginBoth10"></div>
						</div>
						<div class="input-group col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="ct-datepicker">
										<input type="text" class="form-control datepicker" id="checkin" name="checkin" placeholder="Check In">
									</div>
								</div>
								<div class="col-md-6">
									<div class="ct-datepicker">
										<input type="text" class="form-control datepicker" id="checkout" name="checkout" placeholder="Check Out">
									</div>
								</div>
							</div>
						</div>
						<div class="input-group col-md-12">
							<div class="row">
								<div class="col-md-6">
									<select class="ct-selectAdults ct-select--full" id="adults" name="adults">
										<option>&nbsp;</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</div>
								<div class="col-md-6">
									<select class="ct-selectChildren ct-select--full" id="children" name="children">
										<option>&nbsp;</option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
						</div>
						<div class="input-group col-md-12">
							<textarea rows="5" class="form-control" name="comments" placeholder="Comments"></textarea>
						</div>
						
						<div class="input-group col-md-12 ct-u-paddingTop30">
							<button type="submit" class="btn btn-primary">Send your enquiry</button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="ct-contactBox">
		<div class="container">
			<div class="text-center ct-u-paddingTop60 ct-u-paddingBottom100">
				<h2>Or Contact Us Directly</h2>
				<small>Do you have questions? Write to us.</small>
				<p>For a non-binding reservation please enter below the additional company information. We are happy to answer all your open questions in a personal conversation. Call us at: (012) 345-6789. If you are not fluent reach, please leave a callback request in your mailbox. If you want to contact us, please fill in the following fields: If you want to contact us, please fill in the following fields:</p>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<form class="ct-bookForm contactForm validateIt" method="post" action="http://houses.html.themeplayers.net/beach/assets/form/send.php" role="form" data-email-subject="Contact Form" data-show-errors="true">
							<div class="input-group">
								<input type="text" class="form-control" name="field[]" placeholder="first name" required>
							</div>
							<div class="input-group">
								<input type="text" class="form-control" name="field[]" placeholder="last name" required>
							</div>
							<div class="input-group">
								<input type="email" class="form-control" name="field[]" placeholder="email" required>
							</div>
							<div class="input-group">
								<textarea rows="6" class="form-control" name="field[]" placeholder="message" required></textarea>
							</div>
							<div class="input-group ct-u-paddingTop20">
								<button type="submit" class="btn btn-primary">Contact Us</button>
							</div>
						</form>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	



</body>

</html>
