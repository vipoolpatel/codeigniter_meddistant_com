<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Booking Setup</h4>
			</div>
		</div>
		<!-- end page title end breadcrumb -->
		
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
		
		
		
		<div class="row">
			<div class="col-12">
				<div class="col-md-6 offset-3">
					<div class="card-box">
						<h4 class="m-t-0 m-b-30 header-title">Booking Price</h4>
						
						
							<?php $attributes = array('class' => 'form-horizontal', 'id' => '');
							echo form_open('admin/setting/save_booking_prices', $attributes); ?>
						
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Price per Night:</label>
								<div class="col-9">
									<input class="form-control" name="price_per_night" id="" placeholder="$" type="number" min="1" value="<?php if(!empty($booking_prices_data)) { echo $booking_prices_data['price_per_night'];} ?>" required>
								</div>
							</div>
						
						<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Cleaning Fee:</label>
								<div class="col-9">
									<input class="form-control" name="cleaning_fee" id="" placeholder="$" type="number" min="1" value="<?php if(!empty($booking_prices_data)) { echo $booking_prices_data['cleaning_fee'];} ?>" required>
								</div>
							</div>
							
						
							<div class="form-group mb-0 justify-content-end row">
								<div class="col-9">
									<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div> <!-- end row -->
	
	</div> <!-- end container -->
	
	

</div>
<!-- end wrapper -->






</body>

</html>
