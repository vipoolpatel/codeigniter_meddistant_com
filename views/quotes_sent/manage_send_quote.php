<main>
<style>
	.radio label, .checkbox label {
		cursor: pointer;
	}
</style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Send Quote</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Quotes Requested</li>
                            <li class="breadcrumb-item active" aria-current="page">Send Quote</li>
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
							<!-- <h5 class="mb-4">Send Quote</h5> -->
							<?php $attributes = array('class' => '', 'id' => '');
							echo form_open('quotes_requested/manage_send_quote', $attributes); ?>
								<input type="hidden" name="add" value="1">
								<input type="hidden" name="quote_request_id" value="<?php echo $this->uri->segment(3); ?>">
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Hospital/Clinic</label>
                                        <input class="form-control" name="hospital_clinic" id="" type="text" value="<?php if (!empty($facility_data)) {
										echo $facility_data['facility_name'];
										} ?>" required>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Name of Quote preparer</label>
                                        <input class="form-control" name="quote_preparer_name" value="<?php if (!empty($facility_data)) {
										echo $facility_data['username'];
										} ?>" type="text" required>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Email</label>
                                        <input class="form-control" value="<?php if (!empty($facility_data)) {
											echo $facility_data['email'];
										} ?>" type="email" disabled>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Phone No</label>
                                        <input class="form-control" value="<?php if (!empty($facility_data)) {
										echo $facility_data['phone_no'];
										} ?>" type="text" disabled>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Treatment Category</label>
                                        <input class="form-control" value="<?php if (!empty($send_quote_data)) {
										echo $send_quote_data['procedure_treatment'];
										} ?>" type="text" disabled>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="doctor">Doctor</label>
                                        <select class="form-control" id="doctor" name="doctor" onchange="otherDoctor(event)">
                                        	<option  selected="">Select Doctor</option>
                                        	<?php if (isset($doctors)):?>

                                        		<?php foreach ($doctors as  $doctor){?>
                                        			<option value="<?php echo $doctor['doctor_id']?>"><?php echo $doctor['name']?></option>
											<?php 
												}
											endif;?>
											<option   value="0">Add Other Doctor</option>
										  </select>
                                    </div>
                                    <div class="form-group col-md-6" id="new_doctor" style="display: none;">
                                        <label for="doctor">Add Doctor</label>
                                        <input class="form-control" name="new_doctor" type="text">
                                    </div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label for="">Include Stay Accomodations</label>
										<br>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="accomodations"  id="inlineRadio0"
												value="yes">
											<label class="form-check-label" for="inlineRadio0">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="accomodations" id="inlineRadio00"
												value="no">
											<label class="form-check-label" for="inlineRadio00">
												No
											</label>
										</div>
                                    </div>
									
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Message/Proposed treatment</label>
                                        <textarea class="form-control" required maxlength="1000" name="message"></textarea>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Length of stay</label>
                                        <input class="form-control" required name="stay_length" type="text">
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Total Treatment Cost ($)</label>
                                        <input class="form-control" required name="treatment_cost" type="text">
                                    </div>
								</div>
								<br>
								<div style="color: #ff002c; font-size: 10px; margin-bottom: 10px">
									* Please note that above cost may not change if proposed treatment is followed. In rare cases cost may change up or down based on in-person meeting with doctor at location or via consultations. Any change in cost change will never more than 20% above quoted price.
								</div>
								
								
								<div style="color: #ff002c; font-size: 10px">
									* Treatment cost excludes any travel or accommodation expenses.
								</div>
								<br>
                                <div class="form-group row mb-0 float-right">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
    	function otherDoctor(evt) {
    		
    		if (evt.target.value === "0") {
			   var other_detail = document.getElementById("new_doctor");
		    	other_detail.style.display = "block";
			}else{

			   var other_detail = document.getElementById("new_doctor");
		    	other_detail.style.display = "none";
			}
		  
		}
    </script>