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
                  <h5 class="mb-4">
                     <a class="btn btn-primary mb-0" href="<?=base_url()?>admin/agent/quote_detail_pdf/<?php if (isset($quote_data)) {echo $quote_data[0]->id;}?>" >PDF Download</a>
                  </h5>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for=""><b>Quote Request Number:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->request_no;}?></label>
                     </div>

                     <div class="form-group col-md-6">
                        <label for=""><b>Patient No:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->patient_no;}?></label>
                     </div>
                     
                  </div>


                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for=""><b>Created On:</b> <?php if (isset($quote_data)) {echo date('m-d-Y', strtotime($quote_data[0]->created_on));}?></label>
                     </div>

                     <div class="form-group col-md-6">
                        <label for=""><b>Trip:</b> 
                           <?php
                           if(!empty($quote_data) && !empty($quote_data[0]->destination_hospital_id))
                           { 
                                 $getHostiptal =  $this->db->where('user_id',$quote_data[0]->destination_hospital_id);
                                 $getHostiptal =  $this->db->get('tbl_user')->row();
                                 
                              ?>
                              <?=$getHostiptal->username?>, <?=$getHostiptal->city?>, <?=$getHostiptal->state?>, <?=$getHostiptal->country?>  (<?=$quote_data[0]->destination_start_date?> to <?=$quote_data[0]->destination_end_date?>)
                          <?php }
                           ?>
                           
                           
                        </label>
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
                        <label for=""><b>Email:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->email;}?></label>
                     </div>
                     <?php }
                        ?>
                  </div>
                  <div class="form-row">
                     <?php
                        if ($this->session->userdata('user_type') != "hospital") {
                        	?>
                     <div class="form-group col-md-6">
                        <label for=""><b>Phone No:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->phone_no;}?></label>
                     </div>
                     <?php }
                        ?>
                     <div class="form-group col-md-6">
                        <label for=""><b>Treatment:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->procedure_treatment;}?></label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for=""><b>Desired Country 1:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->desired_country;}?></label>
                     </div>
                     <div class="form-group col-md-6">
                        <label for=""><b>Desired Country 2:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->desired_country2;}?></label>
                     </div>
                  </div>
                 <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for=""><b>Desired State 1:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->desired_state;}?></label>
                     </div>
                     <div class="form-group col-md-6">
                        <label for=""><b>Desired State 2:</b> <?php if (isset($quote_data)) {echo $quote_data[0]->desired_state2;}?></label>
                     </div>
                  </div>

               



                  <hr>
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
                  <?php
                     if (!empty($quote_data[0]->insurance_information)) {
                     	?>
                  <hr>
                  <h4 class="mb-4">Insurance</h4>
                  <div class="row">
                     <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                           <?=$quote_data[0]->insurance_information?>
                        </div>
                     </div>
                  </div>
                  <?php }
                     ?>
                  <hr>
                  <h4 class="mb-4">Heath Conditions and Treatment Detail</h4>
                  <div class="row">
                     <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                           <?php
                              if (!empty($quote_data[0]->treatment_detail)) {
                              	echo $quote_data[0]->treatment_detail;
                              } else if (!empty($quote_data[0]->message)) {
                              	echo $quote_data[0]->message;
                              }
                              ?>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <h4 class="mb-4">File</h4>
                  <?php if (isset($quote_data)) {?>
                  <div class="form-row">
                     <?php if (!empty($quote_data[0]->quote_image)) {?>
                     <div class="form-group col-md-1">
                     		<?php
                     	     $file_type_one = $this->common_model->getFileSingle($quote_data[0]->file_type_one);
                              if(!empty($file_type_one))
                              { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?=$file_type_one->name?></span>
                           <?php 
                              }
                              ?>

                        <label for="">
                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 1</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_data[0]->quote_image_two)) {?>
                     <div class="form-group col-md-1">

                 		<?php
                 	     $file_type_two = $this->common_model->getFileSingle($quote_data[0]->file_type_two);
                          if(!empty($file_type_two))
                          { ?>
                       <span style="font-weight: 900;font-size: 17px;"><?=$file_type_two->name?></span>
                       <?php 
                          }
                          ?>

                        <label for="">
                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_two; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 2</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_data[0]->quote_image_three)) {?>
                     <div class="form-group col-md-1">

                 		<?php
                 	     $file_type_three = $this->common_model->getFileSingle($quote_data[0]->file_type_three);
                          if(!empty($file_type_three))
                          { ?>
                       <span style="font-weight: 900;font-size: 17px;"><?=$file_type_three->name?></span>
                       <?php 
                          }
                          ?>


                        <label for="">
                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_three; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 3</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_data[0]->quote_image_four)) {?>
                     <div class="form-group col-md-1">

                     		<?php
                 	     $file_type_four = $this->common_model->getFileSingle($quote_data[0]->file_type_four);
                          if(!empty($file_type_four))
                          { ?>
                       <span style="font-weight: 900;font-size: 17px;"><?=$file_type_four->name?></span>
                       <?php 
                          }
                          ?>



                        <label for="">
                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_four; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 4</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_data[0]->quote_image_five)) {?>
                     <div class="form-group col-md-1">

             			<?php
                 	     $file_type_five = $this->common_model->getFileSingle($quote_data[0]->file_type_five);
                          if(!empty($file_type_five))
                          { ?>
                       <span style="font-weight: 900;font-size: 17px;"><?=$file_type_five->name?></span>
                       <?php 
                          }
                        ?>



                        <label for="">
                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_five; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 5</a>
                        </label>
                     </div>
                     <?php }?>
                  </div>
                  <?php }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
