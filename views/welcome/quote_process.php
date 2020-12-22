<link rel="stylesheet" href="https://meddistant.com/assets/admin_asset/updated/css/vendor/bootstrap.min.css" />
<main class="page-content">
<style>span.select2-selection.select2-selection--single{ border-color: #DEDEDE; }
.card-body .form-group { margin-top: 10px; }</style>

<div class="shell">
            <div class="row">
                <div class="col-12">
						<h1>Request Treatment Quotes</h1>
					<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">

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
					<div class="alert alert-success" style="font-size: 14px;">
						<?php echo $this->session->flashdata('success_message'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
			</div>
			<style type="text/css">
				.manage_quote{
					font-size: 16px;
				}
				.manage_quote label{
					font-weight: normal;
				}
				.form-control{
				font-size: 14px;
				}
				.required{
					color: red;
				}

			</style>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
							<!-- <h5 class="mb-4">Add Quote</h5> -->
							<form class="mb-5 manage_quote" action="<?php echo base_url(); ?>welcome/manage_quote" method="post"  enctype="multipart/form-data">

								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required  name="first_name"  value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Last Name <span class="required">*</span></label>
                                        <input type="text" name="last_name" required class="form-control"  value="">
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Age <span class="required">*</span></label>
                                        <input type="text" class="form-control" required name="age"  value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Gender <span class="required">*</span></label>
                                        <select name="gender" class="form-control" required>
											<option>Male</option>
											<option>Female</option>
										</select>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="country">Country <span class="required">*</span></label>
                                        <select name="country" id="getCountry"  class="form-control"  required>
                                        <option data-val="" value="">Select Country</option>
											                      	<?php
foreach ($getCountry as $country_name) {?>
	<option data-val="<?=$country_name->id?>" value="<?=$country_name->country_name?>"><?=$country_name->country_name?></option>
	                                        	<?php }
?>

										</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Street</label>
                                        <input type="text" class="form-control"  name="street"  value="">
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">City <span class="required">*</span></label>
                                        <input type="text" class="form-control" required name="city" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">State / Province <span class="required">*</span></label>
                                         <div id="getState">
                                        <input type="text" class="form-control" required name="state"  value="">
                                        </div>
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Zipcode <span style="display: none;" class="required show_zipcode">*</span></label>
                                        <input type="text" class="form-control" name="zipcode" id="zipcode" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Email <span class="required">*</span></label>
                                        <input type="email" required class="form-control" name="email"
										value="">
                                    </div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Phone No <span class="required">*</span></label>
                                        <input type="text" class="form-control" required  name="phone_no" value="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Treatment <span class="required"> (Select "other" if not on list) *</span></label>
                                        <select name="procedure_treatment" id="procedure_treatment" class="form-control" required>
											<option value="">Select Treatment</option>
                                    <?php
foreach ($getTreatment as $value) {?>
                                     <option value="<?=$value->id?>"><?=$value->treatment_name?></option>
                                <?php }
?>
										</select>
                                    </div>
								</div>
								<hr>
						<p><b>Select at Least one Destination for treatment</b></p>




						<div class="form-row">
						   <div class="form-group col-md-6">
						      <label for="">Planned Medical Trips <span class="required">(optional)</span></label>
						      <select class="form-control" name="destination_hospital_id" id="destination_hospital_id">
						      		<option data-val="" value="">No Destionation Plan</option>
						      		<?php
						      		foreach($getDestinationHospital as $destination)
						      		{ ?>
			      						<option data-val="<?=$destination->country?>" value="<?=$destination->user_id?>"><?=$destination->username?>, <?=$destination->city?>, <?=$destination->state?>, <?=$destination->country?>  (<?=$destination->start_date?> to <?=$destination->end_date?>)</option>
									<?php
						      		}
						      		?>
						      </select>
						   </div>
						</div>




								<div class="form-row">
									  <div class="form-group col-md-6">
                                        <label for="country">Desired Country <span class="required">*</span></label>
                                        <select name="desired_country" id="desired_country" class="form-control" required>
                                            <option data-val="" value="">Select</option>
											<?php
											foreach ($getCountryQuate as $value_c) {
												?>
											<option data-val="<?=$value_c->id?>" value="<?=$value_c->country_name?>"><?=$value_c->country_name?></option>
												<?php
											}
											?>
										</select>

								</div>
								 <div class="form-group col-md-6">
                                        <label for="country2">Desired Country <span class="required">(optional)</span></label>
                                        <select name="desired_country2" id="desired_country2" class="form-control">
                                            <option data-val="" value="">Select</option>
												 <?php
												foreach ($getCountryQuate as $value_c) {
													?>
												<option data-val="<?=$value_c->id?>" value="<?=$value_c->country_name?>"><?=$value_c->country_name?></option>
													<?php
												}
												?>
										</select>

								</div>
							</div>




						    <div class="form-row">

							    <div class="form-group col-md-6">
                                    <label>If USA may choose a state <span class="required">(optional)</span></label>
                                    <select id="desired_state" name="desired_state" class="form-control">
                                        <option value="">Select</option>
									</select>
								</div>

								<div class="form-group col-md-6">
                                    <label>If USA may choose a state <span class="required">(optional)</span></label>
                                    <select id="desired_state2" name="desired_state2" class="form-control">
                                		<option value="">Select</option>
									</select>
								</div>

							</div>






							<hr>

								<h4 class="mb-4">Your Health <span class="required">(Recommended)</span></h4>
								<div class="row">
									<label class="col-form-label col-sm-2 pt-0">High Cholesterol</label>
									<div class="col-sm-10">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="high_cholesterol" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="high_cholesterol" id="gridRadios1"
												value="no">
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
											<input class="form-check-input" type="radio" name="anemic" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="anemic" id="gridRadios1"
												value="no">
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
											<input class="form-check-input" type="radio" name="diabetic" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="diabetic" id="gridRadios1"
												value="no">
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
											<input class="form-check-input" type="radio" name="heart_issues" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="heart_issues" id="gridRadios1"
												value="no">
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
											<input class="form-check-input" type="radio" name="allergic" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="allergic" id="gridRadios1"
												value="no">
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
											<input class="form-check-input" type="radio" name="pregnant" id="gridRadios1"
												value="yes">
											<label class="form-check-label" for="gridRadios1">
												Yes
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="pregnant" id="gridRadios1"
												value="no">
											<label class="form-check-label" for="gridRadios1">
												No
											</label>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="form-group col-md-6">
                                        <label for="">Specify Heath Conditions and Treatment Detail <span class="required">*</span></label>
                                        <textarea name="treatment_detail" required class="form-control" class="form-control"  id="treatment_detail" rows="3"></textarea>
                                    </div>
								</div>
								<hr>
								<div class="form-row">
									<div class="form-group col-md-3">
                                        <label for="">Attach related Pics/Files <span class="required">(recommended)</span></label>

                                        <select class="form-control" name="file_type_one" style="margin-bottom: 10px;">
                                        	<option value="">Select File Type</option>
                                        	<?php
                                        	foreach($getFileType as $filetype) {
                                        	?>
                                        	<option value="<?=$filetype->id?>"><?=$filetype->name?></option>
	                                        <?php }
	                                        ?>
                                        </select>


                                        <input type="file" style="padding: 13px;margin-top: 10px;" class="form-control" name="quote_image">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>

                                         <select class="form-control" name="file_type_two" style="margin-bottom: 10px;">
                                        	<option value="">Select File Type</option>
                                        	<?php
                                        	foreach($getFileType as $filetype) {
                                        	?>
                                        	<option value="<?=$filetype->id?>"><?=$filetype->name?></option>
	                                        <?php }
	                                        ?>
                                        </select>


                                        <input type="file" style="padding: 13px;margin-top: 10px;" class="form-control" name="quote_image_two">
                                    </div>

									<div class="form-group col-md-6">
</div>
								</div>
								<hr>
								<div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="accepted" name = "terms" required >
                                    <label class="form-check-label" for="inlineCheckbox1" >I agree with the <a href="<?=base_url()?>about/terms">Terms and Conditions</a>.</label>
								</div>
								<br>
								<br>
								<div class="form-group row mb-0 " style="margin-left: 0px;">
                                    <div>
											<button type="submit" class="btn btn-primary mb-0" style="padding: 7px;font-size: 19px;">Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </main>
 <script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">

$(document).ready(function() {

	
	$('#procedure_treatment').change(function(e) {
		e.preventDefault();
		var treatment_id = $(this).val();
		$.ajax({
	           type:'POST',
	           url:"<?=base_url()?>welcome/getTreatmentHospital",
	           data: {treatment_id: treatment_id},
	           dataType: 'JSON',
	           success:function(data){
	           		$('#destination_hospital_id').html(data.success);
	           }
		});
	});


    $('#destination_hospital_id').change(function(){
		 var procedure_treatment = $('#procedure_treatment').val();
		 if(procedure_treatment == '')
		 {
		 	alert("Please Select Treatment First");
		 	$(this).val('');
		 }
		 else
		 {
		 	  var country = $('#destination_hospital_id option:selected').attr('data-val');
	         $('#desired_country').val(country);
	         if(country == '')
	         {
	            $('#desired_country').attr("readonly", false);
	         }
	         else
	         {
	            $('#desired_country').attr("readonly", true);   
	         }
		 }
    });



	$('#desired_country').change(function(){
    	var mycountry = $(this).val();
    	var second = $('#desired_country2').val();
    	if(mycountry == second)
    	{
    		alert('Please choose another country because this country already selected');
    		$(this).val('');
    	}
    });

   	$('#desired_country2').change(function(){
       	var mycountry = $(this).val();
       	var second = $('#desired_country').val();
       	if(mycountry == second)
       	{
       		alert('Please choose another country because this country already selected');
       		$(this).val('');
       	}
   });
   



    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

	$('#getCountry').change(function(){

		var country = $(this).val();
		if(country == 'USA')
		{
			$('.show_zipcode').show();
			$('#zipcode').attr("required", true);
		}
		else
		{
			$('.show_zipcode').hide();
			$('#zipcode').attr("required", false);
		}

		var country_id = $('#getCountry option:selected').attr('data-val');
		var state_name = '';
 		$.ajax({
	           type:'POST',
	           url:"<?=base_url()?>welcome/getState",
	           data: {country_id: country_id,state_name:state_name},
	           dataType: 'JSON',
	           success:function(data){
	           		$('#getState').html(data.success);
	           }
		});
	});


	$('#desired_country').change(function(){
		var country_id = $('#desired_country option:selected').attr('data-val');
		
 		$.ajax({
           type:'POST',
           url:"<?=base_url()?>welcome/getStateDirect",
           data: {country_id: country_id},
           dataType: 'JSON',
           success:function(data){
       		   $('#desired_state').html(data.success);
           }
		});
	});


	$('#desired_country2').change(function(){
		var country_id = $('#desired_country2 option:selected').attr('data-val');	
 		$.ajax({
           type:'POST',
           url:"<?=base_url()?>welcome/getStateDirect",
           data: {country_id: country_id},
           dataType: 'JSON',
           success:function(data){
       		   $('#desired_state2').html(data.success);
           }
		});
	});





});
</script>