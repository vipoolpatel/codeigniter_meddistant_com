<main>
<style>
	.radio label, .checkbox label {
		cursor: pointer;
	}
</style>

<div class="wrapper">
	<div class="container-fluid">
		
			<div class="row">
                <div class="col-12">

                    <h1>Add Doctor</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Manage Doctors</li>
                            <li class="breadcrumb-item active" aria-current="page">Add Doctor</li>
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
			</div>
		
		<div class="row">
			<div class="col-12">
				<div class="card mb-4">
                    <div class="card-body">
						<!-- <h5 class="mb-4">Add Doctor</h5> -->
					<?php $attributes = array('class' => '', 'id' => '');
					echo form_open_multipart('manage_doctors/manage_doctor', $attributes); ?>
					
					<input type="hidden" name="<?php if (empty($facility_data)) {
						echo 'add';
					} else {
						echo 'edit';
					} ?>" value="1">
					<input type="hidden" name="edit_id" value="<?php if (!empty($facility_data)) {
						echo $facility_data['facility_id'];
					} ?>">

					<div class="form-row">
						<div class="form-group col-md-6">
							<label c>Doctor Name</label>
							<input class="form-control" name="name" id="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['facility_name'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label >Email</label>
							<input class="form-control" name="email" id="" placeholder="" type="email" value="<?php if (!empty($facility_data)) {
								echo $facility_data['operation_years'];
							} ?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label >Phone Number</label>
							<input class="form-control" name="phone_no" id="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['facility_name'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label >Gender</label>
							<select name="gender"  required class="form-control">
								<option value = "m">Male</option>
								<option value = "f">Female</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label >Language Spoken</label>
							<input class="form-control" name="language_spoken" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['license_number'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Doctor Image</label>
							<input  name="doctor_image" id="" class="form-control" style="height: 40px;padding: 7px;"  type="file"  required>
						</div>
					</div>
					
					<hr>
					
					<h4 class="header-title m-t-0 m-b-30">Specialities </h4>
					<br>
					<div class="row">
						<div class="col-sm-3">
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox4" name="specialties[]" value="liposuction" <?php if (!empty($facility_data) && in_array('liposuction', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox4"> liposuction </label>
									</span>
						</div>
						
						<div class="col-sm-3">
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox9" name="specialties[]" value="Breast Reduction" <?php if (!empty($facility_data) && in_array('Breast Reduction', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox9"> Breast Reduction </label>
									</span>
						</div>
						
						<div class="col-sm-3">
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox15" name="specialties[]" value="Ear Surgeries" <?php if (!empty($facility_data) && in_array('Ear Surgeries', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox15">Ear Surgeries </label>
									</span>
						</div>
						
						<div class="col-sm-3">
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox19" name="specialties[]" value="Sleeve Gastrectomy" <?php if (!empty($facility_data) && in_array('Sleeve Gastrectomy', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox19">Sleeve Gastrectomy </label>
									</span>
						</div>
					
					</div>
					
					<div class="row">
						<div class="col-sm-3">
							
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox5" name="specialties[]" value="Tummy Tuck" <?php if (!empty($facility_data) && in_array('Tummy Tuck', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox5"> Tummy Tuck </label>
									</span>
						
						</div>
						
						<div class="col-sm-3">
							
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox10" name="specialties[]" value="Breasts augmentation" <?php if (!empty($facility_data) && in_array('Breasts augmentation', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox10"> Breasts augmentation </label>
									</span>
						</div>
						
						<div class="col-sm-3">
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox16" name="specialties[]" value="(Nose job) Rhinoplasty" <?php if (!empty($facility_data) && in_array('(Nose job) Rhinoplasty', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox16"> (Nose job) Rhinoplasty </label>
									</span>
						</div>
						
						<div class="col-sm-3">
							<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox20" name="specialties[]" value="Adjustable Gastric Band" <?php if (!empty($facility_data) && in_array('Adjustable Gastric Band', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox20"> Adjustable Gastric Band </label>
									</span>
						</div>
					
					</div>
					
					<div class="row">
						<div class="col-sm-3">
							<span class="checkbox checkbox-success checkbox-inline">
								<input type="checkbox" id="inlineCheckbox6" name="specialties[]" value="Beard hair transplant" <?php if (!empty($facility_data) && in_array('Beard hair transplant', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
								<label for="inlineCheckbox6"> Beard hair transplant </label>
							</span>
						</div>
						
						<div class="col-sm-3">
							
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox11" name="specialties[]" value="Facelift Procedures" <?php if (!empty($facility_data) && in_array('Facelift Procedures', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox11"> Facelift Procedures </label>
									</span>
						</div>
						
						<div class="col-sm-3">
								
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox17" name="specialties[]" value="(Eye lid Surgery) Blepharoplasty" <?php if (!empty($facility_data) && in_array('(Eye lid Surgery) Blepharoplasty', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox17"> (Eye lid Surgery) Blepharoplasty </label>
									</span>
						</div>
						
						<div class="col-sm-3">
							
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox7" name="specialties[]" value="Brazilian butt lift" <?php if (!empty($facility_data) && in_array('Brazilian butt lift', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox7"> Brazilian butt lift </label>
									</span>
						
						</div>
					
					</div>
					
					<div class="row">
						
						
						<div class="col-sm-3">
							
								<span class="checkbox checkbox-success checkbox-inline ">
										<input type="checkbox" id="inlineCheckbox12" name="specialties[]" value="Forehead Lift" <?php if (!empty($facility_data) && in_array('Forehead Lift', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox12"> Forehead Lift </label>
									</span>
						
						</div>
						
						<div class="col-sm-3">
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox18" name="specialties[]" value="Gastric Bypass" <?php if (!empty($facility_data) && in_array('Gastric Bypass', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox18"> Gastric Bypass </label>
									</span>
						
						</div>
						
						<div class="col-sm-3">
							<span class=" checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox22" name="specialties[]" value="Root Canal Treatment" <?php if (!empty($facility_data) && in_array('Root Canal Treatment', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox22">Root Canal Treatment </label>
									</span>
						</div>
					<div class="col-sm-3">
								
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox8" name="specialties[]" value="Breast lift" <?php if (!empty($facility_data) && in_array('Breast lift', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox8"> Breast lift </label>
									</span>
						</div>
					</div>
					
					<div class="row">
						
						
						<div class="col-sm-3">
							
								
						
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox13" name="specialties[]" value="Hair transplant" <?php if (!empty($facility_data) && in_array('Hair transplant', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox13"> Hair transplant </label>
									</span>
						
						</div>
						
						<div class="col-sm-3">
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox23" name="specialties[]" value="Installation of a dental implant" <?php if (!empty($facility_data) && in_array('Installation of a dental implant', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox23"> Installation of a dental implant </label>
									</span>
						
						</div>
						
						<div class="col-sm-3">
									<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox24" name="specialties[]" value="Crowns" <?php if (!empty($facility_data) && in_array('Crowns', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox24"> Crowns </label>
									</span>
						</div>
					<div class="col-sm-3">
								
								<span class="checkbox checkbox-success checkbox-inline">
										<input type="checkbox" id="inlineCheckbox25" name="specialties[]" value="Veneers" <?php if (!empty($facility_data) && in_array('Veneers', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
										<label for="inlineCheckbox25"> Veneers </label>
									</span>
						</div>
					</div>
					<div class="row">
						
						
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Orthopedics" name = "specialties[]" <?php if (!empty($facility_data) && in_array('Orthopedics', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
											<label class="form-check-label" for="inlineCheckbox1">Orthopedics</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Stem Cell Therapy" name = "specialties[]" <?php if (!empty($facility_data) && in_array('Stem Cell Therapy', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
											<label class="form-check-label" for="inlineCheckbox1">Stem Cell Therapy</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="General Surgery" name = "specialties[]" <?php if (!empty($facility_data) && in_array('General Surgery', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
											<label class="form-check-label" for="inlineCheckbox1">General Surgery</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" onclick="otherDetail()" id="other_treatment" value="Other" name = "specialties[]" <?php if (!empty($facility_data) && in_array('Other', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
											<label class="form-check-label" for="inlineCheckbox1">Other</label>
										</div>
										<div class="form-group " id="other_detail" style="display: none;">
											<textarea class="form-control" rows="4" name="other_detail"></textarea>
										</div>
									</div>
					</div>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Years in Speciality</label>
							<input class="form-control" name="specialty_years" id="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['facility_name'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Education</label>
							<input class="form-control" name="education" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['operation_years'];
							} ?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Residency</label>
							<input class="form-control" name="residency" id="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['facility_name'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Board Credentials</label>
							<br>
							<div class="form-check form-check-inline mt-2">
								<input class="form-check-input" type="radio" name="board_credential" id="inlineCheckbox1" value="Board Certified" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'yes') { ?> checked <?php } ?>>
								<label class="form-check-label" for="inlineCheckbox1">Board Certified</label>
							</div>
							<div class="form-check form-check-inline mt-2">
								<input class="form-check-input" type="radio" name="board_credential" id="inlineCheckbox1" value="Board Eligible" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'no') { ?> checked <?php } ?>>
								<label class="form-check-label" for="inlineCheckbox1">Board Eligible</label>
							</div>
							<div class="form-check form-check-inline mt-2">
								<input class="form-check-input" type="radio" name="board_credential" id="inlineCheckbox1" value="Other Certification" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'no') { ?> checked <?php } ?>>
								<label class="form-check-label" for="inlineCheckbox1">Other Certification</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Board Certified or Eligible in</label>
							<input class="form-control" name="board_certified" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['license_number'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6"></div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>License Number</label>
							<input class="form-control" name="license_number" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['license_number'];
							} ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>License Country</label>
							<input class="form-control" name="license_country" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
								echo $facility_data['operation_years'];
							} ?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>About doctor <span style="font-size: 10px">(description about the doctor in less than 100 words) </span></label>
							<textarea class="form-control" maxlength="100" rows="4" name="about_doctor"><?php if (!empty($facility_data)) {
								echo $facility_data['facility_desc'];
							} ?></textarea>
						</div>
						<div class="form-group col-md-6">
							<label>Professional Associations  <span style="font-size: 10px">(in less than 50 words) </span></label>
							<textarea class="form-control" maxlength="50" rows="4" name="professional_association"><?php if (!empty($facility_data)) {
								echo $facility_data['facility_desc'];
							} ?></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Training <span style="font-size: 10px">(in less than 50 words) </span></label>
							<textarea class="form-control" maxlength="50" rows = "4" name="training"><?php if (!empty($facility_data)) {
								echo $facility_data['facility_desc'];
							} ?></textarea>
						</div>
						<div class="form-group col-md-6"></div>
					</div>
					<br>
					<br>
					<div class="form-group row mb-0 float-right">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary mb-0">Save</button>
						</div>
					</div>
				
				<?php echo form_close(); ?>
					</div>
				</div>
			
			</div><!-- end col -->
		</div>
	
	</div> <!-- end container -->

</div>
</main>
    <script type="text/javascript">
    	function otherDetail() {
		  var other_treatment = document.getElementById("other_treatment");
		  var other_detail = document.getElementById("other_detail");
		  if (other_treatment.checked == true){
		    other_detail.style.display = "block";
		  } else {
		     other_detail.style.display = "none";
		  }
		}
    </script>