
<div >
<div class="">
    <div class="">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Manage Doctor</h4>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <?php if ($this->session->flashdata('error_message')) {?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('error_message'); ?></span>
            </div>
        <?php }?>
        <?php if ($this->session->flashdata('success_message')) {?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('success_message'); ?></span>
            </div>
        <?php }?>

        <div class="row">
            <div class="col-sm-12">

                <?php $attributes = array('class' => 'form-horizontal', 'id' => '');
echo form_open_multipart('manage_doctors/manage_doctor', $attributes);?>

                <input type="hidden" name="<?php if (empty($doctor_data)) {
	echo 'add';
} else {
	echo 'edit';
}?>" value="1">
                <input type="hidden" name="edit_id" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['doctor_id'];
}?>">

                <div class="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-10 control-label">Doctor Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="name" id="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['name'];
}?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-10 control-label">Phone Number</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="phone_no" id="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['phone_no'];
}?>" required>
                                </div>
                            </div>

                              <div class="form-group">
                                <label class="col-md-10 control-label">Hospital Name</label>
                                <div class="col-md-10">

                             <select name="hospital_id" required class="form-control">

<option value="">Select Hospital</option>

 <?php foreach ($getHospital as $per) {?>


           <option <?=($per->id == $doctor_data['hospital_id']) ? 'selected' : ''?> value="<?=$per->id?>"><?php echo $per->hospital_name ?></option>

    <?php }?>

</select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-10 control-label">Language Spoken</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="language_spoken" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['language_spoken'];
}?>" required>
                                </div>
                            </div>




                        </div>








                        <div class="col-lg-6">
                            <div class="form-group mt-1">
                                <label class="col-md-10 control-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="email" id="" placeholder="" type="email" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['email'];
}?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-10 control-label">Gender</label>
                                <div class="col-sm-10">
                                    <select name="gender"  required class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label class="col-md-10 control-label">Doctor Image</label>
                                <div class="col-md-10">
                                    <input  name="doctor_image" id=""  type="file" />
                                </div>
                            </div>

                            <div class="form-group mt-2">
                               <img src="<?php echo base_url(); ?>upload_dir/doctors_image/<?php echo $doctor_data['doctor_image']; ?>"  style="height: 80px; width: 100px; overflow: hidden; ">
                            </div>
                        </div>
                    </div><!-- end row -->

                    <hr>


                  <?php $specialties = explode(',', $doctor_data['specialties']);?>

                    <h4 class="header-title m-t-0 m-b-30">Specialities </h4>

                    <div class="row">
<?php
foreach ($getTreatment as $value) {

	?>

                        <div class="col-sm-6">
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckboxT<?=$value->id?>" name="specialties[]" value="<?=$value->treatment_name?>" <?php if (!empty($doctor_data) && in_array($value->treatment_name, $specialties)) {?> checked <?php }?>>
                                        <label for="inlineCheckboxT<?=$value->id?>"> <?=$value->treatment_name?> </label>
                                    </span>
                        </div>
                        <?php }
?>


                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-10 control-label">Years in Speciality</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="specialty_years" id="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['specialty_years'];
}?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-10 control-label">Residency (Hospital)</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="residency" id="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['residency'];
}?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-10 control-label">Board Certified In (Country)</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="board_certified" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['board_certified'];
}?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-10 control-label">License Number</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="license_number" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['license_number'];
}?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-10 control-label">About doctor <span style="font-size: 10px">(description about the doctor in less than 100 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="about_doctor"><?php if (!empty($doctor_data)) {
	echo $doctor_data['about_doctor'];
}?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-10 control-label">Training <span style="font-size: 10px">(in less than 50 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="training"><?php if (!empty($doctor_data)) {
	echo $doctor_data['training'];
}?></textarea>
                                </div>
                            </div>


                        </div>








                        <div class="col-lg-6">
                            <div class="form-group mt-1">
                                <label class="col-md-10 control-label">Education</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="education" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['education'];
}?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-10 control-label">Board Credentials</label>
                                <div class="col-md-10">
                                    <span class="col-md-4 radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio0" value="Board Certified" name="board_credential" <?php if (!empty($doctor_data) && $doctor_data['board_credential'] === 'Board Certified') {?> checked <?php }?> >
                                        <label for="inlineRadio0"> Board Certified </label>
                                    </span>

                                </div>
                            </div>

                            <br><br>

                            <div class="form-group mt-4">
                                <label class="col-md-10 control-label">License country</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="license_country" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
	echo $doctor_data['license_country'];
}?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-10 control-label">Professional Associations  <span style="font-size: 10px">(in less than 50 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control"  name="professional_association"><?php if (!empty($doctor_data)) {
	echo $doctor_data['professional_association'];
}?></textarea>
                                </div>
                            </div>


                        </div>
                    </div><!-- end row -->

                    <div class="form-group row mb-0 float-right">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mb-0">Update</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div><!-- end col -->
        </div>

    </div> <!-- end container -->

</div>
</div>