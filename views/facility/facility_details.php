<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Facility Details</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Facility Details</li>
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
							<!-- <h5 class="mb-4">Edit Profile</h5> -->
							<!-- <h5 class="mb-4">Add Facility</h5> -->
							<?php $attributes = array('class' => 'md-5', 'id' => '');
// 			print_r($facility_data[0]['facility_name']);
echo form_open('manage_facility/manage_facility', $attributes);?>
								<input type="hidden" name="<?php if (empty($facility_data[0])) {
	echo 'add';
} else {
	echo 'edit';
}?>" value="1">
								<input type="hidden" name="edit_id" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['facility_id'];
}?>">
                            <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Facility Name</label>
                                        <!--Changes done on 20191218-->
                                        <div class="col-sm-10">
                                        <input class="form-control" name="facility_name" id="" type="text" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['facility_name'];
}?>" required>
										</div>
                                        <!--END-->
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Years in operation</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" name="operation_years" id="" placeholder="" type="text" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['operation_years'];
}?>" required>
									</div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Number of Surgeons</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" name="total_surgeons" id="" placeholder="" type="text" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['total_surgeons'];
}?>" required>
									</div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Facility Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="4" name="facility_desc"><?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['facility_desc'];
}?></textarea>
									</div>
                                </div>

                                <div class="form-group row">
                                  	<label for=""  class="col-sm-2 col-form-label">JCI Accredited</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="jci_accredited" <?php if (!empty($facility_data[0]) && isset($facility_data[0]['jci_accredited'])) {
	if ($facility_data[0]['jci_accredited'] === 'yes') {
		?> checked <?php }}?> id="inlineRadio0"
												value="yes">
											<label class="form-check-label" for="inlineRadio0">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="jci_accredited" <?php if (!empty($facility_data[0]) && isset($facility_data[0]['jci_accredited'])) {
	if ($facility_data[0]['jci_accredited'] === 'no') {?> checked <?php }}?> id="inlineRadio00"
												value="no">
											<label class="form-check-label" for="inlineRadio00">
												No
											</label>
										</div>
									</div>
                                </div>



                                <div class="form-group row">
                                      <label for="" class="col-sm-2 col-form-label">License/Permit Number</label>
                                       <div class="col-sm-10">
                                        <input class="form-control" name="license_number" id="" placeholder="" type="text" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['license_number'];
}?>" required>
										</div>
                                </div>
                                <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">License/Permit Country</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="license_country" id="" placeholder="" type="text" value="<?php if (!empty($facility_data[0])) {
	echo $facility_data[0]['license_country'];
}?>" required readonly>
									</div>
                                </div>
                                	<?php $payment_types = explode(',', $facility_data[0]['payment_types']);?>
                                <div class="form-group row">
                                  	<label for=""  class="col-sm-2 col-form-label">What forms of payment do you accept?</label>
									 <div class="col-sm-10">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Cash" name = "payment_types[]" <?php if (!empty($facility_data[0]) && in_array('Cash', $payment_types)) {?> checked <?php }?> >
											<label class="form-check-label" for="inlineCheckbox1">Cash</label>
										</div>
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Credit" name = "payment_types[]" <?php if (!empty($facility_data[0]) && in_array('Credit', $payment_types)) {?> checked <?php }?> >
											<label class="form-check-label" for="inlineCheckbox2">Credit</label>
										</div>
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Other" name = "payment_types[]" <?php if (!empty($facility_data[0]) && in_array('Other', $payment_types)) {?> checked <?php }?> >
											<label class="form-check-label" for="inlineCheckbox3">Other</label>
										</div>
									</div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">Does your quote to customer include anesthesia and lab fees?</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="lab_fee" <?php if (!empty($facility_data[0]) && $facility_data[0]['lab_fee'] === 'yes') {?> checked <?php }?> id="inlineRadio0"
												value="yes">
											<label class="form-check-label" for="inlineRadio0">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="lab_fee" <?php if (!empty($facility_data[0]) && $facility_data[0]['lab_fee'] === 'no') {?> checked <?php }?> id="inlineRadio00"
												value="no">
											<label class="form-check-label" for="inlineRadio00">
												No
											</label>
										</div>
									</div>
                                </div>
                                								<hr>

								<?php
$user_id = $this->session->userdata('user_id');
$facility_id = $facility_data[0]['facility_id'];
$facility_procedure = $this->common_model->get_tbl_data('facility_procedure', '*', array(
	'id_facility' => $facility_id,
	'id_tbl_user' => $user_id,
), '', 'created_on DESC');

?>
								<h4 class="header-title m-t-0 m-b-30">For what kind of procedure do you provide? (check all that apply) </h4>
								<br>
								<div class="form-row">
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="liposuction" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('liposuction', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?> >
											<label class="form-check-label" for="inlineCheckbox1">liposuction</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Breast Reduction" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Breast Reduction', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?> >
											<label class="form-check-label" for="inlineCheckbox1">Breast Reduction</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Ear Surgeries" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Ear Surgeries', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Ear Surgeries</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Sleeve Gastrectomy" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Sleeve Gastrectomy', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Sleeve Gastrectomy</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Tummy Tuck" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Tummy Tuck', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Tummy Tuck</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Breasts augmentation" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Breasts augmentation', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Breasts augmentation</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="(Nose job) Rhinoplasty" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('(Nose job) Rhinoplasty', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">(Nose job) Rhinoplasty</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Adjustable Gastric Band" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Adjustable Gastric Band', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Adjustable Gastric Band</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Beard hair transplant" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Beard hair transplant', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Beard hair transplant</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Facelift Procedures" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Facelift Procedures', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Facelift Procedures</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="(Eye lid Surgery) Blepharoplasty" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('(Eye lid Surgery) Blepharoplasty', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">(Eye lid Surgery) Blepharoplasty</label>
										</div>
									</div>
									<?php /*
<div class="form-group col-md-3">
<div class="form-check form-check-inline ">
<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Biliopancreatic Diversion with Duodenal Switch (BPD/DS)" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Biliopancreatic Diversion with Duodenal Switch (BPD/DS)', array_column($facility_procedure, 'procedure_name'))) { ?> checked <?php } ?>>
<label class="form-check-label" for="inlineCheckbox1">Biliopancreatic Diversion with <br>Duodenal Switch (BPD/DS)</label>
</div>
</div> */?>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Brazilian butt lift" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Brazilian butt lift', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Brazilian butt lift</label>
										</div>
									</div>
								</div>
								<div class="form-row">

									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Forehead Lift" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Forehead Lift', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Forehead Lift</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Gastric Bypass" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Gastric Bypass', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Gastric Bypass</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Root Canal Treatment" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Root Canal Treatment', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Root Canal Treatment</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Breast lift" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Breast lift', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Breast lift</label>
										</div>
									</div>
								</div>
								<div class="form-row">

									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Hair transplant" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Hair transplant', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Hair transplant</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Installation of a dental implant" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Installation of a dental implant', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Installation of a dental implant</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Crowns" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Crowns', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Crowns</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Veneers" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Veneers', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Veneers</label>
										</div>
									</div>
								</div>
								<div  class="form-row">

									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Oncoloyg" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Oncoloyg', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Oncoloyg</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Orthopedics" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Orthopedics', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Orthopedics</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Stem Cell Therapy" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Stem Cell Therapy', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Stem Cell Therapy</label>
										</div>
									</div>
									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="General Surgery" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('General Surgery', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">General Surgery</label>
										</div>
									</div>
								</div>
								<div class="form-row">

									<div class="form-group col-md-3">
										<div class="form-check form-check-inline ">
											<input class="form-check-input" type="checkbox" onclick="otherDetail()" id="other_treatment" value="Other Treatment" name = "facility_procedure[]" <?php if (!empty($facility_data[0]) && in_array('Other Treatment', array_column($facility_procedure, 'procedure_name'))) {?> checked <?php }?>>
											<label class="form-check-label" for="inlineCheckbox1">Other Treatment</label>
										</div>
										<div class="form-group " id="other_detail" style="display:none">
											<textarea class="form-control"  rows="4" name="other_detail"></textarea>
										</div>
									</div>


								</div>
								<hr>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update Facility</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>