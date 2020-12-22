<!DOCTYPE html>
<html>
<style>
	.radio label, .checkbox label {
		cursor: pointer;
	}
</style>

<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Send Quote</h4>
			</div>
		</div>
		<!-- end page title end breadcrumb -->
		
		<?php if ($this->session->flashdata('error_message')) { ?>
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('error_message'); ?></span>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('success_message')) { ?>
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('success_message'); ?></span>
			</div>
		<?php } ?>
		
		<div class="row">
			<div class="col-sm-6 offset-3">
				
				<?php $attributes = array('class' => 'form-horizontal', 'id' => '');
				echo form_open('quotes_requested/manage_send_quote', $attributes); ?>
				
				<input type="hidden" name="add" value="1">
				<input type="hidden" name="quote_request_id" value="<?php echo $this->uri->segment(3); ?>">
				
				<div class="card-box">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="col-md-12 control-label">Hospital/Clinic</label>
								<div class="col-md-12">
									<input class="form-control" name="hospital_clinic" id="" type="text" value="<?php if (!empty($facility_data)) {
										echo $facility_data['facility_name'];
									} ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Name of Quote preparer</label>
								<div class="col-md-12">
									<input class="form-control" name="quote_preparer_name" value="<?php if (!empty($facility_data)) {
										echo $facility_data['username'];
									} ?>" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Email</label>
								<div class="col-md-12">
									<input class="form-control" value="<?php if (!empty($facility_data)) {
										echo $facility_data['email'];
									} ?>" type="email" disabled>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Phone No</label>
								<div class="col-md-12">
									<input class="form-control" value="<?php if (!empty($facility_data)) {
										echo $facility_data['phone_no'];
									} ?>" type="text" disabled>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Treatment Category</label>
								<div class="col-md-12">
									<input class="form-control" value="<?php if (!empty($send_quote_data)) {
										echo $send_quote_data['procedure_treatment'];
									} ?>" type="text" disabled>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="col-md-12 control-label">Message/Proposed treatment</label>
								<div class="col-md-12">
									<textarea class="form-control" required maxlength="1000" name="message"></textarea>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-md-12 control-label">Length of stay </label>
								<div class="col-md-12">
									<input class="form-control" required name="stay_length" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Total Treatment Cost </label>
								<div class="col-md-12">
									<input class="form-control" required name="treatment_cost" type="text">
								</div>
							</div>
							
						</div>
					</div>
					
					
					<div style="color: #ff002c; font-size: 10px; margin-bottom: 10px">
						* Please note that above cost may not change if proposed treatment is followed. In rare cases cost may change up or down based on in-person meeting with doctor at location or via consultations. Any change in cost change will never more than 20% above quoted price.
					</div>
					
					
					<div style="color: #ff002c; font-size: 10px">
						* Treatment cost excludes any travel or accommodation expenses.
					</div>
					
					<div class="row">
						<div class="col-lg-11">
							<div class="form-group mb-0 justify-content-end pull-right">
								<div class="col-12">
									<button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<?php echo form_close(); ?>
			
			</div><!-- end col -->
		</div>
	
	</div> <!-- end container -->

</div>
<!-- end wrapper -->

</body>

</html>
