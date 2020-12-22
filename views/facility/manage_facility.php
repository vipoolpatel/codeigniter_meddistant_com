<main>
   <style>
      .radio label, .checkbox label {
      cursor: pointer;
      }
      .facility-hide {
      display: none;
      }
      .required {
      color: red;
      }
   </style>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="/dashboard">Dashboard</a>
                  </li>
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
               	<form action="" method="post" enctype="multipart/form-data">
                  
                  <div class="form-row ">
                     <div class="form-group col-md-6">
                        <label for="">Med. Facility Name <span class="required">*</span></label>
                        <input type="text" name="username"  readonly value="<?=$facility_data['username']?>" required class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="">Stree Address <span class="required">*</span></label>
                        <input type="text" name="address"  readonly value="<?=$facility_data['address']?>" class="form-control">
                     </div>
                  </div>
                  <div class="form-row ">
                     <div class="form-group col-md-4">
                        <label for="">City <span class="required">*</span></label>
                        <input type="text" name="city" readonly  value="<?=$facility_data['city']?>"  class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label for="">State <span class="required">*</span></label>
                        <?php
                           if($facility_data['country'] == 'USA')
                           {
                           ?>
                        <select class="form-control" disabled name="state" required="">
                           <option value="">Select</option>
                           <?php
                              foreach ($get_usa_state as $key => $usa_state) {
                              	?>
                           <option <?=($usa_state->state_name == $facility_data['state']) ? 'selected' : ''?> value="<?=$usa_state->state_name?>"><?=$usa_state->state_name?></option>
                           <?php
                              }
                              ?>
                        </select>
                        <?php
                           }
                           else
                           {
                           	?>
                        <input type="text" name="state"  readonly value="<?=$facility_data['state']?>" class="form-control">  	
                        <?php
                           }
                           ?>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="">Postal Code <span class="required">*</span></label>
                        <input type="text" name="zipcode" readonly  value="<?=$facility_data['zipcode']?>" class="form-control">
                     </div>
                  </div>
                  <div class="form-row ">
                     <div class="form-group col-md-6">
                        <label for="">Country <span class="required">*</span></label>
                        <input type="text"  readonly="" value="<?=$facility_data['country']?>" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="">Phone No. <span class="required">*</span></label>
                        <input type="text" name="phone_no" readonly  value="<?=$facility_data['phone_no']?>" class="form-control">
                     </div>
                  </div>
                  <div class="form-row ">
                     <?php $payment_types = explode(',', $facility_data['payment_types']);?>
                     <div class="form-group col-md-6">
                        <label for="">What forms of payment do you accept?</label>
                        <br>
                        <div class="form-check form-check-inline ">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Cash" name = "payment_types[]" <?php if (!empty($facility_data) && in_array('Cash', $payment_types)) {?> checked <?php }?> >
                           <label class="form-check-label" for="inlineCheckbox1">Cash</label>
                        </div>
                        <div class="form-check form-check-inline ">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Credit" name = "payment_types[]" <?php if (!empty($facility_data) && in_array('Credit', $payment_types)) {?> checked <?php }?> >
                           <label class="form-check-label" for="inlineCheckbox2">Credit</label>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <div class="form-group">
                           <label for="">Medical Provider Descriptive Picture <span class="required">*</span></label>
                           <input type="file" accept="image/x-png,image/gif,image/jpeg" name="medical_provider_picture" <?=!empty($facility_data['medical_provider_picture']) ? '' : 'required' ?> class="form-control">

                           <?php
                           if(!empty($facility_data['medical_provider_picture']))
                           { ?>
                           	<a style="color: blue" href="<?=base_url()?>assets/provider_picture/<?=$facility_data['medical_provider_picture']?>" target="_blank">Show Current Pic</a>  
                           	<?php
                           }
                           ?>
                           <input type="hidden" value="<?=$facility_data['medical_provider_picture']?>" name="old_medical_provider_picture">
                           
                        </div>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for="">Does your quote to customer include anesthesia and lab fees?</label>
                        <br>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="lab_fee" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'yes') {?> checked <?php }?> id="inlineRadio0"
                              value="yes">
                           <label class="form-check-label" for="inlineRadio0">
                           Yes
                           </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="lab_fee" <?php if (!empty($facility_data) && $facility_data['lab_fee'] === 'no') {?> checked <?php }?> id="inlineRadio00"
                              value="no">
                           <label class="form-check-label" for="inlineRadio00">
                           No
                           </label>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <h4 class="header-title m-t-0 m-b-30">What kind of procedure do you provide? (check all that apply) </h4>
                  <br>
                  <div class="form-row">
                     <?php
                        foreach ($getTreatment as $value) {
                        	$checked = '';
                        	if (!empty($facility_procedure)) {
                        		foreach ($facility_procedure as $procedure) {
                        			if ($procedure->procedure_name == $value->id) {
                        				$checked = 'checked';
                        			}
                        		}
                        	}
                        	?>
                     <div class="form-group col-md-3">
                        <div class="form-check form-check-inline ">
                           <input <?=$checked?> class="form-check-input" type="checkbox" id="inlineCheckboxT<?=$value->id?>" value="<?=$value->id?>" name="facility_procedure[]" >
                           <label class="form-check-label" for="inlineCheckboxT<?=$value->id?>"><?=$value->treatment_name?></label>
                        </div>
                     </div>
                     <?php }
                        ?>
                  </div>
                  <hr>
                  <div class="form-group ">
                     <div class="form-group ">
                        <label for="">Medical Provider Description (100 or more words) <span class="required">*</span></label>
                        <textarea class="form-control" required minlength="100" name="about_us"><?=$facility_data['about_us']?></textarea>
                     </div>
                  </div>
                  <div class="form-check form-check-inline ">
                     <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="yes" name = "terms" autocomplete="off" required  checked >
                     <label class="form-check-label" for="inlineCheckbox1" >I agree to <a href="#" data-toggle="modal" data-target="#term_services" id="term_of_services" style="color:blue">Terms of Service</a></label>
                     <br>
                  </div>
                  <br>
                  <label>
                  Welcome to our network of hospitals and clinics. This registration subject to to approval by Meddistant Inc, ususally when first filled out above form.
                  </label>
                  <br>
                  <br>
                  <div class="form-group row mb-0 float-right">
                     <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary mb-0">Submit</button>
                     </div>
                  </div>
                  </form>
                  <!-- Modal -->
                  <div id="term_services" class="modal fade" role="dialog">
                     <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title">TERMS AND CONDITIONS</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                           </div>
                           <div class="modal-body">
                              <?php $this->load->view('about/hospital_terms');?>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
