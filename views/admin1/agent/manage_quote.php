<!DOCTYPE html>
<html>
<style>
	.radio label {
		cursor: pointer;
	}
</style>

<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Add Quote</h4>
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
			<div class="col-sm-12">
				
				<?php $attributes = array('class' => 'form-horizontal', 'id' => '');
				echo form_open('admin/agent/manage_quote', $attributes); ?>
				
				
				<input type="hidden" name="<?php if(empty($quote_data)) { echo 'add'; } else { echo 'edit';} ?>" value="1">
				<input type="hidden" name="edit_id" value="<?php if(!empty($quote_data)) { echo $quote_data['id']; }?>">
				
				
				
				<div class="card-box">
					<div class="row">
						<div class="col-lg-6">
								<div class="form-group">
									<label class="col-md-2 control-label">First Name</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="fname" placeholder="First Name">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Age</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="age" placeholder="Age">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-2 control-label">Country</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="country" placeholder="Country">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">City</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="city" placeholder="City">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Zipcode</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="zipcode" placeholder="Zipcode">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Phone No</label>
									<div class="col-md-10">
										<input type="text" class="form-control" required name="phone_no" placeholder="Phone No">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Treatment</label>
									<div class="col-sm-10">
										<select name="procedure_treatment" class="form-control" required>
											<option>liposuction</option>
											<option>Tummy Tuck </option>
											<option>Beard hair transplant</option>
											<option>Brazilian butt lift</option>
											<option>Breast lift</option>
											<option>Breast Reduction</option>
											<option>Breasts augmentation</option>
											<option>Facelift Procedures</option>
											<option>Forehead Lift</option>
											<option>Hair transplant</option>
											<option>Ear Surgeries</option>
											<option>(Nose job) Rhinoplasty</option>
											<option>(Eye lid Surgery) Blepharoplasty </option>
											<option>Gastric Bypass</option>
											<option>Sleeve Gastrectomy</option>
											<option>Adjustable Gastric Band</option>
											<option>Biliopancreatic Diversion with Duodenal Switch (BPD/DS)</option>
											<option>Root Canal Treatment</option>
											<option>Installation of a dental implant</option>
											<option>Crowns</option>
											<option>Veneers</option>
											<option>Other Treatment</option>
										</select>
									</div>
								</div>
						</div>
						
						
						
						
						
						
						
						
						<div class="col-lg-6">
								<div class="form-group">
									<label class="col-md-2 control-label">Last Name</label>
									<div class="col-md-10">
										<input type="text" name="lname" class="form-control" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Gender</label>
									<div class="col-sm-10">
										<select name="gender" class="form-control" required>
											<option>Male</option>
											<option>Female</option>
										</select>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-2 control-label">Street</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="street" placeholder="Street">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">State</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="state" placeholder="State">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<input type="email" required class="form-control" name="quote_email"
										<?php if($this->session->userdata('user_type') === 'customer') { ?>
											   disabled
											   <?php } ?> placeholder="Email"
											   value="<?php if($this->session->userdata('user_type') === 'customer') {
											   	echo $this->session->userdata('email');
											   } ?>">
										
										<input type="hidden" class="form-control"
												<?php if($this->session->userdata('user_type') === 'customer') { ?>
												<?php } ?> name="email" placeholder="Email"
											   value="<?php if($this->session->userdata('user_type') === 'customer') {
												   echo $this->session->userdata('email');
											   } ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Desired Country</label>
									<div class="col-sm-10">
										<select name="desired_country" class="form-control" required>
											<option>Turkey</option>
											<option>Italy </option>
											<option>Mexico</option>
										</select>
									</div>
								</div>
						</div>
					</div><!-- end row -->
					
					
					<hr>
					
					<h4 class="header-title m-t-0 m-b-30"> Your Health   </h4>
					<div class="row">
						<div class="col-lg-8">
								<div class="form-group">
									<label class="col-md-4 control-label">High Cholesterol</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio1" value="yes" name="high_cholesterol" >
										<label for="inlineRadio1"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio2" value="no"  name="high_cholesterol">
										<label for="inlineRadio2"> No </label>
									</span>
								</div>
							
								<div class="form-group">
									<label class="col-md-4 control-label">Anemic</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio11" value="yes" name="anemic" >
										<label for="inlineRadio11"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio12" value="no"  name="anemic">
										<label for="inlineRadio12"> No </label>
									</span>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Diabetic</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio3" value="yes" name="diabetic" >
										<label for="inlineRadio3"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio4" value="no"  name="diabetic">
										<label for="inlineRadio4"> No </label>
									</span>
								</div>
							
								<div class="form-group">
									<label class="col-md-4 control-label">Heart Issues</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio5" value="yes" name="heart_issues" >
										<label for="inlineRadio5"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio6" value="no"  name="heart_issues">
										<label for="inlineRadio6"> No </label>
									</span>
								</div>
							
								<div class="form-group">
									<label class="col-md-4 control-label">Allergic</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio7" value="yes" name="allergic" >
										<label for="inlineRadio7"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio8" value="no"  name="allergic">
										<label for="inlineRadio8"> No </label>
									</span>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">pregnant</label>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio9" value="yes" name="pregnant" >
										<label for="inlineRadio9"> Yes </label>
									</span>
									<span class="col-md-4 radio radio-info radio-inline">
										<input type="radio" id="inlineRadio10" value="no"  name="pregnant">
										<label for="inlineRadio10"> No </label>
									</span>
								</div>
							<hr>
							
								<div class="checkbox checkbox-primary">
									<input id="checkbox-h" type="checkbox" value="accepted" name="terms" required >
									<label for="checkbox-h">
										I agree with the Terms and Conditions.
									</label>
								</div>
							
							
							
						</div>
					</div><!-- end row -->
					
					
					
					
						<div class="row">
							<div class="col-lg-11">
								<div class="form-group mb-0 justify-content-end pull-right">
									<div class="col-9">
										<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
