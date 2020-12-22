<!DOCTYPE html>
<html>

<head>


</head>

<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
	<div class="text-center">
		<a href="<?php echo base_url(); ?>" class="logo"><span>16ocean<span>breeze</span></span></a>
		<h5 class="text-muted mt-0 font-600">Guests, please fill out the below form to access your trip details.</h5>
	</div>

	

	
	<div class="m-t-40 card-box">
		<div class="text-center">
			<h4 class="text-uppercase font-bold mb-0">Trip Detail</h4>
		</div>
		
		<div class="p-20">

			<?php if ($this->session->flashdata('error')) { ?>
				<div class="alert alert-danger">
					<button class="close" data-close="alert"></button>
					<span><?php echo $this->session->flashdata('error'); ?></span>
				</div>
			<?php } ?>
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success">
					<button class="close" data-close="alert"></button>
					<span><?php echo $this->session->flashdata('success'); ?></span>
				</div>
			<?php } ?>
			
			<?php $attributes = array('class' => 'form-horizontal m-t-20', 'id' => '');
			echo form_open('admin/trip/guestLogin', $attributes); ?>
			
				<div class="form-group">
					<div class="col-xs-12">
						<input name="email" class="form-control" type="email" required="" placeholder="Email">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input name="reservation_id" class="form-control" type="text" required="" placeholder="Reservation Id">
					</div>
				</div>


				<div class="form-group text-center m-t-30">
					<div class="col-xs-12">
						<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
					</div>
				</div>

			

			<?php echo form_close(); ?>

		</div>
	</div>
	<!-- end card-box-->

	<br><br><br><br>

</div>
<!-- end wrapper page -->


</body>

</html>
