<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>16 Ocean Breeze - Trip</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="16oceanbreeze" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin_asset/images/favicon.ico">
	
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/plugins/morris/morris.css">
	
	<!-- App css -->
	<link href="<?php echo base_url(); ?>assets/admin_asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin_asset/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin_asset/css/style.css" rel="stylesheet" type="text/css" />
	
	<!-- DataTables -->
	<link href="<?php echo base_url(); ?>assets/admin_asset/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	
	
	<script src="<?php echo base_url(); ?>assets/admin_asset/js/modernizr.min.js"></script>


</head>



<body>

<!-- Navigation Bar-->
<header id="topnav">
	<div class="topbar-main">
		<div class="container-fluid " style="">
			
			<!-- Logo container-->
			<div class="logo wrapper-page" style="margin: 0; float: left; text-transform:unset;  display: contents ">
				<!-- Text Logo -->
				<!--<a href="index.html" class="logo">-->
				<!--<span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
				<!--<span class="logo-large"><i class="mdi mdi-radar"></i> Adminto</span>-->
				<!--</a>-->
				<!-- Image Logo -->
				
				<a href="<?php echo base_url(); ?>admin/dashboard" class="logo"><span>Trip <span>Detail</span></span>  </a>
			
			
			</div>
			<!-- End Logo container-->
			
			
			<div class="menu-extras topbar-custom">
				
				<ul class="list-unstyled topbar-right-menu float-right mb-0">
					
					<li class="menu-item">
						<!-- Mobile menu toggle-->
						<a class="navbar-toggle nav-link">
							<div class="lines">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</a>
						<!-- End mobile menu toggle-->
					</li>
					
					
					<li class="dropdown notification-list">
						<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
						   aria-haspopup="false" aria-expanded="false">
							<!--							<img src="--><?php //echo base_url(); ?><!--assets/admin_asset/images/users/avatar-1.jpg" alt="user" class="rounded-circle">-->
							<?php echo ucwords($this->session->userdata('first_name')); ?> <i class="fa fa-caret-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
							
							
							<!-- item-->
							<a href="<?php echo base_url(); ?>admin/logout/trip" class="dropdown-item notify-item">
								<i class="ti-power-off m-r-5"></i> Logout
							</a>
						
						</div>
					</li>
				
				</ul>
			</div>
			<!-- end menu-extras -->
			
			<div class="clearfix"></div>
		
		</div> <!-- end container -->
	</div>
	<!-- end topbar-main -->
	
</header>
<!-- End Navigation Bar-->

<div class="wrapper" style="padding: 80px">
	<div class="container-fluid">
		
		
		<div class="row" align="center">
			<div class="col-sm-12">
				<h1 class="page-title" style="font-size: 29px">Your reservation is being confirmed</h1>
			</div>
		</div>
		
		<br>
		

		
		
		<div class="row d-print-none">
			<div class="col-sm-8">
				<div class="bg-picture card-box" style="padding: 60px">
					<div class="profile-info-name">
						
						<div class="profile-info-detail">
							<h2 class="m-0">What to expect next</h2>
							<p class="text-muted m-b-20"><i></i></p>
							<p style="line-height: 35px; font-size: 17px">
								
								You will receive an email shortly confirming your dates selected.  You will then have 30 days to send in a deposite to secure these dates
								
							</p>
							
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<!--/ meta -->
				
				
			
			</div>
			
			<div class="col-sm-4 d-print-none" id="reservation_receipt">
				<div class="card-box" style="padding: 0">
					
					
					<div class="col-sm-12"  style="display: inline-block">
						<div class="col-sm-10" style="float: left">
					<h1 class="header-title m-t-0 m-b-3" style="font-weight: 500; font-size: 19px; padding: 15px 0 0 0;">Reservation #<span class="text-danger">
							<?php echo $this->session->userdata('reservation_id'); ?>
						</span></h1>
						</div>
						
						<div class="col-sm-2" style="float: left; padding-top: 13px">
							<a  href="javascript:window.print()" id="print-now" style="color: #0c7cd5; cursor: pointer; font-size: 16px" class="strong">Print</a>
						</div>
					</div>
					
					
					
					<ul class="list-group m-b-0 user-list">
						<li class="list-group-item">
							<img src="<?php echo base_url()?>assets/images/booking.jpg" class="trip-reservation-img" width="100%" alt="Book House">
						</li>
						
						<li class="list-group-item">
							<span style="font-weight: 500">16 Ocean Breeze</span>
							York Beach, ME
							03909
						</li>
						
						<li class="list-group-item" style="padding: 10px 0 10px 0;">
							<div class="col-sm-12"  style="display: inline-block">
							<div class="col-sm-6" style="float: left">
								<span style="color: #99ADB6; line-height: 20px;">Check-In</span> <br> <?php echo date('D M d, ', strtotime($reservation_data['checkin'])) . '4:00pm'; ?>
							
							</div>
							
							<div class="col-sm-6" style="float: left">
								<span style="color: #99ADB6; line-height: 20px;">Checkout</span> <br> <?php echo date('D M d, ', strtotime($reservation_data['checkout'])) . '11:00am'; ?>
							
							</div>
							</div>
						</li>
						<li class="list-group-item" style="padding: 10px 0 10px 0;">
							<div class="col-sm-12"  style="display: inline-block">
								<div class="col-sm-6" style="float: left">
									<b>Total</b>
								</div>
								
								<div class="col-sm-6" style="float: left">
									<b><?php echo '$'.number_format($reservation_data['total_price'], 2); ?></b>
								
								</div>
							</div>
						</li>
					</ul>
				</div>
				
				
			</div>
		</div>
		
		
		
		
		
		<div class="row d-print-block" style="display: none;">
			<div class="col-md-12">
				<div class="card-box">
					<!-- <div class="panel-heading">
                        <h4>Invoice</h4>
                    </div> -->
					<div class="panel-body">
						<div class="clearfix">
							<div class="pull-left">
								<h2>Reservation #  <strong><?php echo $this->session->userdata('reservation_id'); ?></strong>
								</h2>
							</div>
						</div>
						
						<div class="col-sm-8">
							<div class="card-box" style="padding: 0">
								
								<ul class="list-group m-b-0 user-list">
									
									<li class="list-group-item">
										<span style="font-weight: 500">16 Ocean Breeze</span><br>
										York Beach, ME
										03909
									</li>
									
									<li class="list-group-item">
										<div class="col-sm-12"  style="display: inline-block">
											<div class="col-sm-6" style="float: left">
												<span style="color: #99ADB6; line-height: 20px;">Check-In</span> <br> <?php echo date('D M d, ', strtotime($reservation_data['checkin'])) . '4:00pm'; ?>
											
											</div>
											
											<div class="col-sm-6" style="float: left">
												<span style="color: #99ADB6; line-height: 20px;">Checkout</span> <br> <?php echo date('D M d, ', strtotime($reservation_data['checkout'])) . '11:00am'; ?>
											
											</div>
										</div>
									</li>
									
									
									<li class="list-group-item">
										<div class="col-sm-12"  style="display: inline-block">
											<div class="col-sm-6" style="float: left">
												Rent (<?php echo $reservation_data['total_nights']; ?> nights)
											</div>
											
											<div class="col-sm-6" style="float: left">
												<?php echo '$'.number_format($booking_prices_data['price_per_night'] * $reservation_data['total_nights'], 2); ?>
											
											</div>
										</div>
									</li>
									
									<li class="list-group-item">
										<div class="col-sm-12"  style="display: inline-block">
											<div class="col-sm-6" style="float: left">
												Cleaning Fee
											</div>
											
											<div class="col-sm-6" style="float: left">
												<?php echo '$'.$booking_prices_data['cleaning_fee']; ?>
											</div>
										</div>
									</li>
									
									
									
									
									<li class="list-group-item">
										<div class="col-sm-12"  style="display: inline-block">
											<div class="col-sm-6" style="float: left">
												<b>Total</b>
											</div>
											
											<div class="col-sm-6" style="float: left">
												<b><?php echo '$'.number_format($reservation_data['total_price'], 2); ?></b>
											
											</div>
										</div>
									</li>
								</ul>
							</div>
						
						
						</div>
						
						
						
						<hr>
					</div>
				</div>
			
			</div>
		
		</div>
		
		
		
		
		
	</div> <!-- end container -->
	
</div>
<!-- end wrapper -->






</body>

</html>
