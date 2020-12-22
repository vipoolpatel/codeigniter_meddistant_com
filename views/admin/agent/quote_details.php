<main>
<style>
	.radio label {
		cursor: pointer;
	}
</style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
					<h1>Request Detail</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
							</li>
							<?php if ($this->session->userdata('user_type') == 'agent') {?>
								<li class="breadcrumb-item">Manage Quote Requests</li>
							<?php } else {?>
								<li class="breadcrumb-item">Quote Requests</li>
							<?php }?>
							<li class="breadcrumb-item active" aria-current="page">Quote Detail</li>
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
							<!-- <h5 class="mb-4">Add Quote</h5> -->
							<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>Quota Number:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->request_no;}?></label>
                                    </div>
                                    <div class="form-group col-md-6">
									<label for=""><b>Created On:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->created_on;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>First Name:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->first_name;}?></label>
                                    </div>
                                    <div class="form-group col-md-6">
									<label for=""><b>Last Name:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->last_name;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
									<label for=""><b>Age:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->age;}?></label>
                                    </div>
                                    <div class="form-group col-md-6">
										<label for=""><b>Gender:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->gender;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>Country:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->country;}?></label>
                                    </div>
                                    <div class="form-group col-md-6">
										<label for=""><b>Street:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->street;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>City:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->city;}?></label>
                                    </div>
                                    <div class="form-group col-md-6">
										<label for=""><b>State:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->state;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>Zipcode:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->zipcode;}?></label>
                                    </div>
                                    <?php
if ($this->session->userdata('user_type') != "hospital") {
	?>
                                    <div class="form-group col-md-6">
										<label for=""><b>Email:</b></label>
                                    </div>
                                    <?php }
?>
								</div>
								<div class="form-row">
								                                    <?php
if ($this->session->userdata('user_type') != "hospital") {
	?>
                                    <div class="form-group col-md-6">
										<label for=""><b>Phone No:</b></label>
                                    </div>
                                    <?php }

?>
                                    <div class="form-group col-md-6">
										<label for=""><b>Desired Country:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->desired_country;}?></label>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label for=""><b>Treatment:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->treatment_name;}?></label>
                                    </div>
								</div>
								<hr>
								<?php
if ($quote_sent_data) {
	?>
								<h4 class="mb-4">Your Doctor</h4>
								<?php if ($quote_sent_data[0]['doctor_id'] == NULL || $quote_sent_data[0]['doctor_id'] == 0) {?>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Name</label>
									<div class="col-sm-10">
										<?php echo $quote_sent_data[0]['new_doctor'] ?>
									</div>
								</div>
								<?php } else {
		?>
									<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Name</label>
									<div class="col-sm-10">
									<?php
$doctor_id = $quote_sent_data[0]['doctor_id'];
		$doctor = $this->db->query("SELECT *  FROM tbl_doctors  WHERE doctor_id = '$doctor_id'")->result_array();
		echo (isset($doctor[0]['name'])) ? $doctor[0]['name'] : '';
		?>
									</div>
								</div>
								<div class="row">
								<label class="col-form-label col-sm-2 pt-0">Email</label>
									<div class="col-sm-10">
										<?php echo (isset($doctor[0]['email'])) ? $doctor[0]['email'] : '';
		?>
									</div>
								</div>
								<div class="row">
								<label class="col-form-label col-sm-2 pt-0">Language Spoken</label>
									<div class="col-sm-10">
										<?php echo (isset($doctor[0]['language_spoken'])) ? $doctor[0]['language_spoken'] : '';
		?>
									</div>
								</div>
								<div class="row">
								<label class="col-form-label col-sm-2 pt-0">Specialties</label>
									<div class="col-sm-10">
										<?php echo (isset($doctor[0]['specialties'])) ? $doctor[0]['specialties'] : '';
		?>
									</div>
								</div>
								<div class="row">
								<label class="col-form-label col-sm-2 pt-0">License Number</label>
									<div class="col-sm-10">
										<?php echo (isset($doctor[0]['license_number'])) ? $doctor[0]['license_number'] : '';
		?>
									</div>
								</div>
								<div class="row">
								<label class="col-form-label col-sm-2 pt-0">License Country</label>
									<div class="col-sm-10">
										<?php echo (isset($doctor[0]['license_country'])) ? $doctor[0]['license_country'] : '';
		?>
									</div>
								</div>
								<?php }?>
								<hr>
								<?php }?>
								<h4 class="mb-4">Your Health</h4>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">High Cholesterol</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="high_cholesterol" disabled id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->high_cholesterol == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="high_cholesterol" disabled id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->high_cholesterol == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Anemic</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="anemic" id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->anemic == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="anemic" id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->anemic == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Diabetic</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="diabetic" id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->diabetic == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="diabetic" id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->diabetic == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Heart Issues</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="heart_issues" id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->heart_issues == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="heart_issues" id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->heart_issues == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Allergic</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="allergic" id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->allergic == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="allergic" id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->allergic == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">Pregnant</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="pregnant" id="gridRadios1"
												value="yes" <?php if (isset($quote_data)) {if ($quote_data[0]->pregnant == "yes") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" disabled name="pregnant" id="gridRadios1"
												value="no" <?php if (isset($quote_data)) {if ($quote_data[0]->pregnant == "no") {echo "checked";}}?>>
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<h4 class="mb-4">Heath Conditions and Treatment Detail</h4>

								<div class="row">

									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<?php
if ($quote_data[0]->treatment_detail != "") {
	echo $quote_data[0]->treatment_detail;
} else if ($quote_data[0]->message != "") {
	echo $quote_data[0]->message;
}
?>
										</div>
									</div>
								</div>

								<?php if (isset($quote_data)) {?>
									<?php if ($quote_data[0]->quote_image != "") {?>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for=""><b>File:</b>
													<a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image; ?>" style="text-decoration: underline;color:blue;" target="_blank">File</a>
												</label>
											</div>
											<div class="form-group col-md-6">
											</div>
										</div>
									<?php }?>
								<?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
