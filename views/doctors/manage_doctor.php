<main>
<style>
	.radio label, .checkbox label {
		cursor: pointer;
	}
	.required {
		color: red;
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
				<?php if ($this->session->flashdata('error_message')) {?>
				<div class="alert alert-danger alert-dismissible fade show rounded">
					<?php echo $this->session->flashdata('error_message'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }?>
				<?php if ($this->session->flashdata('success_message')) {?>
					<div class="alert alert-success alert-dismissible fade show rounded">
						<?php echo $this->session->flashdata('success_message'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
			</div>

		<div class="row">
			<div class="col-12">
				<div class="card mb-4">
                    <div class="card-body">
						<!-- <h5 class="mb-4">Add Doctor</h5> -->
					<?php $attributes = array('class' => '', 'id' => '');
echo form_open_multipart('manage_doctors/manage_doctor', $attributes);?>

					<input type="hidden" name="<?php if (empty($facility_data)) {
	echo 'add';
} else {
	echo 'edit';
}?>" value="1">
					<input type="hidden" name="edit_id" value="<?php if (!empty($facility_data)) {
	echo $facility_data['facility_id'];
}?>">

					<div class="form-row">
						<div class="form-group col-md-6">
							<label c>Doctor Name</label>
							<input class="form-control" name="name" id="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['facility_name'];
}?>" required>
						</div>
						<div class="form-group col-md-6">
							<label >Email <span class="required">(Optional)</span></label>
							<input class="form-control" name="email" id="" placeholder="" type="email" value="<?php if (!empty($facility_data)) {
	echo $facility_data['operation_years'];
}?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label >Phone Number <span class="required">(Optional)</span></label>
							<input class="form-control" name="phone_no" id="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['facility_name'];
}?>" required>
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
}?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Doctor Image</label>
							<input  name="doctor_image" id="" class="form-control" style="height: 40px;padding: 7px;"  type="file"  required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Hospital Name</label>
					<select class="form-control" required name="hospital_id">
						<option value="">Select Hospital</option>
						<?php
foreach ($getHospital as $row) {
	?>
			<option value="<?=$row->id?>"><?=$row->hospital_name?></option>
						<?php
}
?>


					</select>
						</div>

					</div>

					<hr>

					<h4 class="header-title m-t-0 m-b-30">Specialities </h4>
					<br>

<div class="form-row">
<?php
foreach ($getTreatment as $value) {
	?>
		<div class="form-group col-md-3">
			<div class="form-check form-check-inline ">
				<input  class="form-check-input" type="checkbox" id="inlineCheckboxT<?=$value->id?>" value="<?=$value->treatment_name?>" name="specialties[]" >
				<label class="form-check-label" for="inlineCheckboxT<?=$value->id?>"><?=$value->treatment_name?></label>
			</div>
		</div>

		<?php }
?>
</div>




					<hr>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Years in Speciality</label>
							<input class="form-control" name="specialty_years" id="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['facility_name'];
}?>" required>
						</div>

						<!-- 
						<div class="form-group col-md-6">
							<label>Education</label>
							<input class="form-control" name="education" id="" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['operation_years'];
}?>" required>
						</div> -->


					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Residency (Hospital) </label>
							<input class="form-control" name="residency" id=""  type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['facility_name'];
}?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Board Credentials</label>
							<br>
							<div class="form-check form-check-inline mt-2">
								<input class="form-check-input board_certified" type="radio" name="board_credential" id="inlineCheckbox1" value="Board Certified" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'yes') {?> checked <?php }?> required>
								<label class="form-check-label" for="inlineCheckbox1">Board Certified</label>
							</div>

						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6" >
							<label>Board Certified In (Country)</label>
							<input class="form-control" name="board_certified" id="board_certified" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['license_number'];
}?>" required>
						</div>
						<div class="form-group col-md-6"></div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>License Number <span class="required">(Optional)</span></label>
							<input class="form-control" name="license_number" id="license_number" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['license_number'];
}?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>License Country <span class="required">(Optional)</span></label>
							<input class="form-control" name="license_country" id="license_country" placeholder="" type="text" value="<?php if (!empty($facility_data)) {
	echo $facility_data['operation_years'];
}?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>About doctor <span style="font-size: 10px">(description about the doctor in more than 100 words) </span> <span class="required">*</span></label>
							<textarea class="form-control" minlength="100" required rows="4" name="about_doctor"><?php if (!empty($facility_data)) {
	echo $facility_data['facility_desc'];
}?></textarea>
						</div>
						<div class="form-group col-md-6">
							<label>Professional Associations  <span style="font-size: 10px">(in less than 50 words) </span> <span class="required">(Optional)</span></label>
							<textarea class="form-control"  rows="4" name="professional_association"><?php if (!empty($facility_data)) {
	echo $facility_data['facility_desc'];
}?></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Training <span style="font-size: 10px">(in less than 50 words) </span> <span class="required">(Optional)</span></label>
							<textarea class="form-control"  rows = "4" name="training"><?php if (!empty($facility_data)) {
	echo $facility_data['facility_desc'];
}?></textarea>
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
<script type="text/javascript"   src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
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
		$('.board_certified').click(function(){
		    $('#license_number').attr('required',true);
		     $('#license_country').attr('required',true)
		     $('#board_certified').removeAttr('required');
		});
		$('.board_eligible').click(function(){
		    $('#board_certified').attr('required',true);
		    $('#license_number').removeAttr('required');
		    $('#license_country').removeAttr('required');
		});
		$('.other_certification').click(function(){
		    $('#license_number').removeAttr('required');
		    $('#license_country').removeAttr('required');
		    $('#board_certified').removeAttr('required');
		});

    </script>