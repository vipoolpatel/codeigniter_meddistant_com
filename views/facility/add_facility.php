<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Facility Setup</h4>
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
				<div class="col-md-6 col-md-offset-3">
					<div class="card-box">
						<h4 class="m-t-0 m-b-30 header-title">Facility Form</h4>
						
						
							<?php $attributes = array('class' => 'form-horizontal', 'id' => '');
							echo form_open('manage_facility/', $attributes); ?>
						
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Facility Name:</label>
								<div class="col-9">
									<input class="form-control" name="facility_name" id="" placeholder="" type="text"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">First Name:</label>
								<div class="col-9">
									<input class="form-control" name="first_name" id="" placeholder="" type="text"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Last Name:</label>
								<div class="col-9">
									<input class="form-control" name="last_name" id="" placeholder="" type="text"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">User ID:</label>
								<div class="col-9">
									<input class="form-control" name="user_id" id="" placeholder="" type="text"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Password:</label>
								<div class="col-9">
									<input class="form-control" name="password" id="" placeholder="" type="password"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Confirm Password:</label>
								<div class="col-9">
									<input class="form-control" name="confirm" id="" placeholder="" type="password"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Email Address:</label>
								<div class="col-9">
									<input class="form-control" name="email" id="" placeholder="" type="email"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Phone Number:</label>
								<div class="col-9">
									<input class="form-control" name="number" id="" placeholder="" type="number"  value="" required>
								</div>
							</div>
							
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Website URL:</label>
								<div class="col-9">
									<input class="form-control" name="website" id="" placeholder="" type="text"  value="" required>
								</div>
							</div>
							
						
						
						
                            <label>
                            <input name="terms" id="checkbox" type="checkbox" autocomplete="off"> I Agree to
                            <a href="/page/terms" target="_blank">Terms of Service</a>
                            </label>
                            <br><br>
                            
						
							
						
							<div class="form-group mb-0 justify-content-end row">
								<div class="col-9">
									<button type="submit" class="btn btn-info waves-effect waves-light">Register</button>
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
