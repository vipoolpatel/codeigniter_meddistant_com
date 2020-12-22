<main>
   <style>
      .radio label {
      cursor: pointer;
      }
      a {
      color: #007bff;
      text-decoration: none;
      background-color: transparent;
      -webkit-text-decoration-skip: objects;
      }
      .required {
      color: red;
      }
      .font-size-bigger {
         font-size: 16px;
      }
   </style>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <?php if (isset($quote_data)) { ?>
            <h1>Edit Quote</h1>
            <?php } else { ?>
            <h1>Request Quotes</h1>
            <?php } ?>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="#">Dashboard</a>
                  </li>
                  <?php if ($this->session->userdata('user_type') == 'agent') { ?>
                  <li class="breadcrumb-item">Manage Quote Requests</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item">Quote Requests</li>
                  <?php } ?>
                  <?php if (isset($quote_data)) { ?>
                  <li class="breadcrumb-item active" aria-current="page">Edit Quote</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active" aria-current="page">Request Quotes</li>
                  <?php } ?>
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
                  <!-- <h5 class="mb-4">Add Quote</h5> -->
                  <form class="mb-5" action="<?php echo base_url(); ?>admin/agent/manage_quote" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="procedure_treatment" value="<?= isset($quote_data[0]->procedure_treatment) ? $quote_data[0]->procedure_treatment : '' ?>">
                     <input type="hidden" name="is_file" value="<?= !empty($quote_data[0]) ? $quote_data[0]->is_file : 0 ?>">
                     <input type="hidden" name="request_no" value="<?= !empty($quote_data[0]->request_no) ? $quote_data[0]->request_no : '' ?>">
                     <input type="hidden" name="patient_no" value="<?= !empty($quote_data[0]->patient_no) ? $quote_data[0]->patient_no : '' ?>">
                     <input type="hidden" name="<?php if (empty($quote_data)) {
                        echo 'add';
                        } else {
                        echo 'edit';
                        } ?>" value="1">
                     <input type="hidden" name="edit_id" value="<?php if (isset($quote_data)) {
                        echo $quote_data[0]->id;
                        } ?>">
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="">First Name <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if (isset($quote_data)) { ?>
                              <span><?php echo $quote_data[0]->first_name; ?></span>
                              <?php } elseif (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->first_name; ?></span>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" <?= $readonly ?> required name="first_name" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->first_name;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->first_name;
                              } ?>"> <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="">Last Name <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if (isset($quote_data)) { ?>
                              <span><?php echo $quote_data[0]->last_name; ?></span>
                              <?php } elseif (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->last_name; ?></span>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" <?= $readonly ?> required name="last_name" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->last_name;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->last_name;
                              } ?>"><?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="">Age <?php
                              if (!empty($required)) {
                              ?><span class="required">*</span>
                           <?php }
                              ?>
                           </label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if (isset($quote_data)) { ?>
                              <span><?php echo $quote_data[0]->age; ?></span>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" <?= $required ?> name="age" <?php if (isset($customer_data)) {
                              if (isset($customer_data[0]->age)) {
                                 echo 'readonly';
                              }
                              } ?> value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->age;
                              } ?>"><?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="">Gender <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->gender == "Male"){ ?>
                              <span>Male</span>
                              <?php } else if ($quote_data[0]->gender == "Female") { ?>
                              <span>Female</span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select <?= $readonly ?> name="gender" class="form-control" required>
                              <option <?php if (isset($quote_data)) {
                                 if ($quote_data[0]->gender == "Male") {
                                    echo "selected";
                                 }
                                 } ?>>Male</option>
                              <option <?php if (isset($quote_data)) {
                                 if ($quote_data[0]->gender == "Female") {
                                    echo "selected";
                                 }
                                 } ?>>Female</option>
                           </select>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="country">Country <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php  foreach ($getCountry as $country_name) { ?>
                              <?php if ($quote_data[0]->country == $country_name->country_name) { ?>
                              <span><?= $country_name->country_name ?></span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select name="country" class="form-control" id="getCountry" required>
                              <?php
                                 foreach ($getCountry as $country_name) { ?>
                              <option data-val="<?= $country_name->id ?>" <?php if (isset($quote_data)) {
                                 if ($quote_data[0]->country == $country_name->country_name) {
                                    echo "selected";
                                 }
                                 } ?> value="<?= $country_name->country_name ?>"><?= $country_name->country_name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="">Street</label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->street){ ?>
                              <span><?php echo $quote_data[0]->street; ?></span>
                              <?php }  ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" name="street" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->street;
                              } ?>"><?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="">City</label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->city){ ?>
                              <span><?php echo $quote_data[0]->city; ?></span>
                              <?php }  elseif (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->city; ?></span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" name="city" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->city;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->city;
                              } ?>"><?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <input type="hidden" id="getOldState" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->state;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->state;
                              } ?>">
                           <label for="">State / Province</label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->state){ ?>
                              <span><?php echo $quote_data[0]->state; ?></span>
                              <?php }  else if (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->state; ?></span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <div id="getState">
                              <input type="text" class="form-control" name="state" value="<?php if (isset($quote_data)) {
                                 echo $quote_data[0]->state;
                                 } elseif (!empty($customer_data)) {
                                 echo $customer_data[0]->state;
                                 } ?>">
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="">Zipcode</label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->zipcode){ ?>
                              <span><?php echo $quote_data[0]->zipcode; ?></span>
                              <?php }  else if (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->zipcode; ?></span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="text" class="form-control" name="zipcode" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->zipcode;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->zipcode;
                              } ?>"><?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="">Email <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->email){ ?>
                              <span><?php echo $quote_data[0]->email; ?></span>
                              <?php }  ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input type="email" required class="form-control" name="quote_email" <?php if (isset($quote_data)) { ?> value="<?php echo $quote_data[0]->email; ?>" <?php } ?> <?php if ($this->session->userdata('user_type') === 'customer') { ?> readonly <?php } ?> value="<?php if ($this->session->userdata('user_type') === 'customer') {
                              echo $this->session->userdata('email');
                              } ?>"><?php } ?>
                           <input type="hidden" class="form-control" <?php if ($this->session->userdata('user_type') === 'agent') { ?> readonly <?php } ?> name="email" value="<?php if ($this->session->userdata('user_type') === 'customer') {
                              echo $this->session->userdata('email');
                              } ?>">
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="">Phone No <?php
                              if (!empty($required)) {
                              ?><span class="required">*</span>
                           <?php }
                              ?></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php if(isset($quote_data)) { ?>
                              <?php if ($quote_data[0]->phone_no){ ?>
                              <span><?php echo $quote_data[0]->phone_no; ?></span>
                              <?php }  else if (!empty($customer_data)) { ?>
                              <span><?php echo $customer_data[0]->phone_no; ?></span>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <input <?= $readonly ?> type="text" class="form-control" <?php if (!empty($customer_data)) {
                              if (!empty($customer_data[0]->phone_no)) {
                                 echo 'readonly';
                              }
                              } ?> <?= $required ?> name="phone_no" value="<?php if (isset($quote_data)) {
                              echo $quote_data[0]->phone_no;
                              } elseif (!empty($customer_data)) {
                              echo $customer_data[0]->phone_no;
                              } ?>"><?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label class="font-size-bigger" for="inputEmail4"><b>Treatment <span class="required">(Select "other" if not on list) *</span></b></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php foreach ($getTreatment as $value) { ?>
                              <?php if (!empty($quote_data)) { ?>
                              <?php if ($quote_data[0]->procedure_treatment == $value->id) { ?>
                              <span><?= $value->treatment_name ?></span>
                              <?php } ?>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select id="procedure_treatment" name="procedure_treatment" class="form-control" required>
                              <option value="">Select Treatment *</option>
                              <?php
                                 foreach ($getTreatment as $value) {
                                    $selected = '';
                                    if (!empty($quote_data)) {
                                       if ($quote_data[0]->procedure_treatment == $value->id) {
                                          $selected = 'selected';
                                       }
                                    }
                                 ?>
                              <option <?= $selected ?> value="<?= $value->id ?>"><?= $value->treatment_name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <?php } ?>
                        </div>
                     </div>
                     <hr />
                     <p>Please Select at Least one Destination for treatment</p>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label class="font-size-bigger" for=""><b>Planned Medical Trips</b> <span class="required">(optional)</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php foreach ($getDestinationHospital as $destination) { ?>
                              <?php if (!empty($quote_data[0])) { ?>
                              <?php if ($quote_data[0]->destination_hospital_id == $destination->user_id) { ?>
                              <span><?= $destination->username ?></span>
                              <?php } else { ?>
                              <span>No Destionation Plan</span>
                              <?php } ?>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select class="form-control" name="destination_hospital_id" id="destination_hospital_id">
                              <option data-val="" value="">No Destionation Plan</option>
                              <?php
                                 foreach ($getDestinationHospital as $destination) { ?>
                              <option data-val="<?= $destination->country ?>" <?= !empty($quote_data[0]) ? ($quote_data[0]->destination_hospital_id == $destination->user_id) ? 'selected' : '' : '' ?> value="<?= $destination->user_id ?>"><?= $destination->username ?>, <?= $destination->city ?>, <?= $destination->state ?>, <?= $destination->country ?> (<?= $destination->start_date ?> to <?= $destination->end_date ?>)</option>
                              <?php
                                 }
                                 ?>
                           </select>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="country">Desired Country <span class="required">*</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php foreach ($getCountryQuate as $value_c) { ?>
                              <?php if (!empty($quote_data[0])) { ?>
                              <?php if ($quote_data[0]->desired_country == $value_c->country_name) { ?>
                              <span name="desired_country" id="desired_country_edit_page" data-val="<?= $value_c->id ?>"><?= $value_c->country_name ?></span>
                              <?php } ?>
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select name="desired_country" id="desired_country" class="form-control" required>
                              <option data-val="" value="">Select</option>
                              <?php
                                 foreach ($getCountryQuate as $value_c) {
                                 ?>
                              <option data-val="<?= $value_c->id ?>" <?php if (isset($quote_data)) {
                                 if ($quote_data[0]->desired_country == $value_c->country_name) {
                                    echo "selected";
                                 }
                                 } ?> value="<?= $value_c->country_name ?>"><?= $value_c->country_name ?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="country">Desired Country <span class="required">(optional)</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <?php foreach ($getCountryQuate as $value_c) { ?>
                              <?php if (!empty($quote_data[0])) { ?>
                              <?php if ($quote_data[0]->desired_country2 == $value_c->country_name) { ?>
                              <span name="desired_country2" id="desired_country2_edit_page" data-val="<?= $value_c->id ?>"><?= $value_c->country_name ?></span>
                              <?php } ?>
                              <?php if (! $quote_data[0]->desired_country2 == $value_c->country_name) { ?>
                              <span>Select</span>
                              <?php } ?>                         
                              <?php } ?>
                              <?php } ?>
                           </div>
                           <?php } else { ?>
                           <select name="desired_country2" id="desired_country2" class="form-control">
                              <option data-val="" value="">Select</option>
                              <?php
                                 foreach ($getCountryQuate as $value_c) {
                                 ?>
                              <option data-val="<?= $value_c->id ?>" <?php if (isset($quote_data)) {
                                 if ($quote_data[0]->desired_country2 == $value_c->country_name) {
                                    echo "selected";
                                 }
                                 } ?> value="<?= $value_c->country_name ?>"><?= $value_c->country_name ?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label>If USA, you may choose a state <span class="required">(optional)</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <span id="desired_state_edit_page" name="desired_state"></span>
                           </div>
                           <?php } else { ?>
                           <select id="desired_state" name="desired_state" class="form-control">
                              <option value="">Select</option>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label>If USA, you may choose a state <span class="required">(optional)</span></label>
                           <?php if(isset($edit_page)) { ?>
                           <div class="form-control">
                              <span id="desired_state2_edit_page" name="desired_state2"></span>
                           </div>
                           <?php } else { ?>
                           <select id="desired_state2" name="desired_state2" class="form-control">
                              <option value="">Select</option>
                           </select>
                           <?php } ?>
                        </div>
                     </div>
                     <hr>
                     <h4 class="mb-4">Your Health <span class="required">(Recommended)</span></h4>
                     <div class="row">
                        <label class="col-form-label col-sm-2 pt-0">High Cholesterol</label>
                        <div class="col-sm-10">
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="high_cholesterol" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->high_cholesterol)) {
                                    if ($quote_data[0]->high_cholesterol == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="high_cholesterol" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->high_cholesterol)) {
                                    if ($quote_data[0]->high_cholesterol == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
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
                              <input class="form-check-input" type="radio" name="anemic" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->anemic)) {
                                    if ($quote_data[0]->anemic == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="anemic" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->anemic)) {
                                    if ($quote_data[0]->anemic == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
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
                              <input class="form-check-input" type="radio" name="diabetic" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->diabetic)) {
                                    if ($quote_data[0]->diabetic == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="diabetic" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->diabetic)) {
                                    if ($quote_data[0]->diabetic == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
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
                              <input class="form-check-input" type="radio" name="heart_issues" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->heart_issues)) {
                                    if ($quote_data[0]->heart_issues == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="heart_issues" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->heart_issues)) {
                                    if ($quote_data[0]->heart_issues == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
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
                              <input class="form-check-input" type="radio" name="allergic" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->allergic)) {
                                    if ($quote_data[0]->allergic == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="allergic" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->allergic)) {
                                    if ($quote_data[0]->allergic == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
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
                              <input class="form-check-input" type="radio" name="pregnant" id="gridRadios1" value="yes" <?php
                                 if (!empty($quote_data[0]->pregnant)) {
                                    if ($quote_data[0]->pregnant == 'yes') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="pregnant" id="gridRadios1" value="no" <?php
                                 if (!empty($quote_data[0]->pregnant)) {
                                    if ($quote_data[0]->pregnant == 'no') {
                                       echo "checked";
                                    }
                                 }
                                 ?>>
                              <label class="form-check-label" for="gridRadios1">
                              No
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label class="font-size-bigger" for=""><b>Specify Heath Conditions and Treatment Detail</b> <span class="required"></span></label>
                           <textarea name="treatment_detail" class="form-control" class="form-control" id="treatment_detail" rows="3"><?php if (!empty($quote_data[0]->treatment_detail)) {
                              echo $quote_data[0]->treatment_detail;
                              } else if (!empty($quote_data[0]->message)) {
                              echo $quote_data[0]->message;
                              } ?></textarea>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label class="font-size-bigger"><input id="is_insurance" name="is_insurance" <?= !empty($quote_data[0]->is_insurance) ? 'checked' : '' ?> value="Yes" type="checkbox"> <b>Confirm with your insurance if it convers. </b></label>
                        </div>
                     </div>
                     <div class="row insurance_information" style="<?= !empty($quote_data[0]->is_insurance) ? '' : 'display:none' ?>">
                        <div class="form-group col-md-6">
                           <label>Provide Insurance Information <span class="required">*</span></label>
                           <textarea name="insurance_information" class="form-control" class="form-control" id="insurance_information" rows="3"><?php if (!empty($quote_data[0]->insurance_information)) {
                              echo $quote_data[0]->insurance_information;
                              } ?></textarea>
                        </div>
                     </div>
                     <hr>
                     <div class="form-row">
                        <input type="hidden" value="<?= !empty($quote_data[0]->quote_image) ? $quote_data[0]->quote_image : '' ?>" class="form-control" name="old_quote_image">
                        <input type="hidden" value="<?= !empty($quote_data[0]->orignal_quote_image) ? $quote_data[0]->orignal_quote_image : '' ?>" class="form-control" name="old_orignal_quote_image">
                        <?php if (empty($quote_data[0]->quote_image)) { ?>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(Recommended)</span></label>
                           <select class="form-control" name="file_type_one" style="margin-bottom: 10px;">
                              <option value="">Select File Type</option>
                              <?php
                                 foreach ($getFileType as $filetype) {
                                 ?>
                              <option <?= !empty($quote_data[0]) ? ($quote_data[0]->file_type_one == $filetype->id) ? 'selected' : '' : '' ?> value="<?= $filetype->id ?>"><?= $filetype->name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <input type="file" class="form-control" name="quote_image">
                        </div>
                        <?php } else { ?>
                        <input type="hidden" value="<?= $quote_data[0]->file_type_one ?>" name="file_type_one">
                        <?php } ?>
                        <input type="hidden" value="<?= !empty($quote_data[0]->quote_image_two) ? $quote_data[0]->quote_image_two : '' ?>" class="form-control" name="old_quote_image_two">
                        <input type="hidden" value="<?= !empty($quote_data[0]->orignal_quote_image_two) ? $quote_data[0]->orignal_quote_image_two : '' ?>" class="form-control" name="old_orignal_quote_image_two">
                        <?php if (empty($quote_data[0]->quote_image_two)) { ?>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(Recommended)</span></label>
                           <select class="form-control" name="file_type_two" style="margin-bottom: 10px;">
                              <option value="">Select File Type</option>
                              <?php
                                 foreach ($getFileType as $filetype) {
                                 ?>
                              <option <?= !empty($quote_data[0]) ? ($quote_data[0]->file_type_two == $filetype->id) ? 'selected' : '' : '' ?> value="<?= $filetype->id ?>"><?= $filetype->name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <input type="file" class="form-control" name="quote_image_two">
                        </div>
                        <?php } else { ?>
                        <input type="hidden" value="<?= $quote_data[0]->file_type_two ?>" name="file_type_two">
                        <?php }
                           ?>
                        <input type="hidden" value="<?= !empty($quote_data[0]->quote_image_three) ? $quote_data[0]->quote_image_three : '' ?>" class="form-control" name="old_quote_image_three">
                        <input type="hidden" value="<?= !empty($quote_data[0]->orignal_quote_image_three) ? $quote_data[0]->orignal_quote_image_three : '' ?>" class="form-control" name="old_orignal_quote_image_three">
                        <?php if (empty($quote_data[0]->quote_image_three)) { ?>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <select class="form-control" name="file_type_three" style="margin-bottom: 10px;">
                              <option value="">Select File Type</option>
                              <?php
                                 foreach ($getFileType as $filetype) {
                                 ?>
                              <option <?= !empty($quote_data[0]) ? ($quote_data[0]->file_type_three == $filetype->id) ? 'selected' : '' : '' ?> value="<?= $filetype->id ?>"><?= $filetype->name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <input type="file" class="form-control" name="quote_image_three">
                        </div>
                        <?php
                           } else { ?>
                        <input type="hidden" value="<?= $quote_data[0]->file_type_three ?>" name="file_type_three">
                        <?php }
                           ?>
                        <input type="hidden" value="<?= !empty($quote_data[0]->quote_image_four) ? $quote_data[0]->quote_image_four : '' ?>" class="form-control" name="old_quote_image_four">
                        <input type="hidden" value="<?= !empty($quote_data[0]->orignal_quote_image_four) ? $quote_data[0]->orignal_quote_image_four : '' ?>" class="form-control" name="old_orignal_quote_image_four">
                        <?php if (empty($quote_data[0]->quote_image_four)) { ?>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <select class="form-control" name="file_type_four" style="margin-bottom: 10px;">
                              <option value="">Select File Type</option>
                              <?php
                                 foreach ($getFileType as $filetype) {
                                 ?>
                              <option <?= !empty($quote_data[0]) ? ($quote_data[0]->file_type_four == $filetype->id) ? 'selected' : '' : '' ?> value="<?= $filetype->id ?>"><?= $filetype->name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <input type="file" class="form-control" name="quote_image_four">
                        </div>
                        <?php } else { ?>
                        <input type="hidden" value="<?= $quote_data[0]->file_type_four ?>" name="file_type_four">
                        <?php }
                           ?>
                        <input type="hidden" value="<?= !empty($quote_data[0]->quote_image_five) ? $quote_data[0]->quote_image_five : '' ?>" class="form-control" name="old_quote_image_five">
                        <input type="hidden" value="<?= !empty($quote_data[0]->orignal_quote_image_five) ? $quote_data[0]->orignal_quote_image_five : '' ?>" class="form-control" name="old_orignal_quote_image_five">
                        <?php if (empty($quote_data[0]->quote_image_five)) { ?>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <select class="form-control" name="file_type_five" style="margin-bottom: 10px;">
                              <option value="">Select File Type</option>
                              <?php
                                 foreach ($getFileType as $filetype) {
                                 ?>
                              <option <?= !empty($quote_data[0]) ? ($quote_data[0]->file_type_five == $filetype->id) ? 'selected' : '' : '' ?> value="<?= $filetype->id ?>"><?= $filetype->name ?></option>
                              <?php }
                                 ?>
                           </select>
                           <input type="file" class="form-control" name="quote_image_five">
                        </div>
                        <?php } else { ?>
                        <input type="hidden" value="<?= $quote_data[0]->file_type_five ?>" name="file_type_five">
                        <?php }
                           ?>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <?php if (isset($quote_data)) {
                              ?>
                           <?php if (!empty($quote_data[0]->quote_image)) {
                              $file_type_one = $this->common_model->getFileSingle($quote_data[0]->file_type_one);
                              if (!empty($file_type_one)) { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?= $file_type_one->name ?></span>
                           <?php
                              }
                              ?>
                           <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 1</a>
                           <?php } ?>
                           <?php if (!empty($quote_data[0]->quote_image_two)) {
                              $file_type_two = $this->common_model->getFileSingle($quote_data[0]->file_type_two);
                              if (!empty($file_type_two)) { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?= $file_type_two->name ?></span>
                           <?php
                              }
                              ?>
                           <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_two; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 2</a>
                           <?php } ?>
                           <?php if (!empty($quote_data[0]->quote_image_three)) {
                              $file_type_three = $this->common_model->getFileSingle($quote_data[0]->file_type_three);
                              if (!empty($file_type_three)) { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?= $file_type_three->name ?></span>
                           <?php
                              }
                              ?>
                           <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_three; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 3</a>
                           <?php } ?>
                           <?php if (!empty($quote_data[0]->quote_image_four)) {
                              $file_type_four = $this->common_model->getFileSingle($quote_data[0]->file_type_four);
                              if (!empty($file_type_four)) { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?= $file_type_four->name ?></span>
                           <?php
                              }
                              ?>
                           <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_four; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 4</a>
                           <?php } ?>
                           <?php if (!empty($quote_data[0]->quote_image_five)) {
                              $file_type_five = $this->common_model->getFileSingle($quote_data[0]->file_type_five);
                              if (!empty($file_type_five)) { ?>
                           <span style="font-weight: 900;font-size: 17px;"><?= $file_type_five->name ?></span>
                           <?php
                              }
                              ?>
                           <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $quote_data[0]->quote_image_five; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 5</a>
                           <?php } ?>
                           <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                     </div>
                     <hr>
                     <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="accepted" name="terms" required <?php if (isset($quote_data)) {
                           if ($quote_data[0]->terms == "accepted") {
                        echo "checked";
                        }
                        } ?>>
                        <label class="form-check-label" for="inlineCheckbox1" ">I agree with the <a href=" <?= base_url() ?>about/terms" target="_blank">Terms and Conditions</a>.</label>
                     </div>
                     <br>
                     <br>
                     <div class="form-group row mb-0 float-right">
                        <div class="col-sm-10">
                           <?php if (isset($quote_data)) { ?>
                           <button type="submit" class="btn btn-primary mb-0">Update</button>
                           <?php } else { ?>
                           <button type="submit" class="btn btn-primary mb-0">Submit</button>
                           <?php } ?>
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
                  destination_hospital(); 
               }
      });
    });


   
      $('#destination_hospital_id').change(function() {

         var procedure_treatment = $('#procedure_treatment').val();
         if(procedure_treatment == '')
         {
            alert("Please Select Treatment First");
            $(this).val('');
         }
         destination_hospital(); 

      });
   
      function destination_hospital() {
        // $('#desired_state').prop('required', false);
         var country = $('#destination_hospital_id option:selected').attr('data-val');
         $('#desired_country').val(country);
         $('#desired_country2').val('');
         desired_country();
         desired_country2();
         if (country == '') {
            $('#desired_country').attr("disabled", false);
            $('#desired_country2').attr("disabled", false);
   
            $('#desired_state').attr("disabled", false);
            $('#desired_state2').attr("disabled", false);
   
   
         } else {
            $('#desired_country').attr("disabled", true);
            $('#desired_country2').attr("disabled", true);
   
            $('#desired_state').attr("disabled", true);
            $('#desired_state2').attr("disabled", true);
         }
      }
   
      destination_hospital();
   
      $('#select_all').on('click', function() {
         if (this.checked) {
            $('.checkbox').each(function() {
               this.checked = true;
            });
         } else {
            $('.checkbox').each(function() {
               this.checked = false;
            });
         }
      });
   
   
      $('#desired_country').change(function() {
         var mycountry = $(this).val();
         var second = $('#desired_country2').val();
         if (mycountry == second) {
            alert('Please choose another country because this country already selected');
            $(this).val('');
         }
      });
   
   
      $('#desired_country2').change(function() {
         var mycountry = $(this).val();
         var second = $('#desired_country').val();
         if (mycountry == second) {
            alert('Please choose another country because this country already selected');
            $(this).val('');
         }
      });
   
   
      $('#getCountry').change(function() {
         getState();
      });
   
      function getState() {
   
         var country_id = $('#getCountry option:selected').attr('data-val');
         var state_name = $('#getOldState').val();
         $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>admin/agent/getState",
            data: {
               country_id: country_id,
               state_name: state_name
            },
            dataType: 'JSON',
            success: function(data) {
               $('#getState').html(data.success);
            }
         });
   
      }
      getState();
   
   
      $('#is_insurance').change(function() {
         if (this.checked) {
            $('.insurance_information').show();
            $('#insurance_information').prop('required', true);
         } else {
            $('.insurance_information').hide();
            $('#insurance_information').prop('required', false);
         }
   
      });
   
   
      $('.checkbox').on('click', function() {
         if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#select_all').prop('checked', true);
         } else {
            $('#select_all').prop('checked', false);
         }
      });
   
   
      $('#desired_country').change(function() {
         desired_country();
      });
   
      function desired_country() {
       <?php if (isset($edit_page)) { ?>
       
         var country_id = $('#desired_country_edit_page').attr('data-val');
       <?php } else { ?>
       var country_id = $('#desired_country option:selected').attr('data-val');
       <?php } ?>
       
       
       <?php if (isset($edit_page)) { ?>
         $('#desired_state_edit_page').prop('required', true);
       <?php } else { ?>
       
       //$('#desired_state').prop('required', true);
       <?php } ?>
   
       
         $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>welcome/getStateDirect",
            data: {
               country_id: country_id
            },
            dataType: 'JSON',
            success: function(data) {
               $('#desired_state').html(data.success);
               
               <?php if (!empty($quote_data[0])) { ?>
               <?php if (isset($edit_page)) { ?>
                  $('#desired_state_edit_page').text('<?= $quote_data[0]->desired_state ?>');
              <?php } else { ?>
              $('#desired_state').val('<?= $quote_data[0]->desired_state ?>');
              <?php } ?>
               <?php  } ?>
              
               
            }
         });
      }
   
      $('#desired_country2').change(function() {
         desired_country2();
      });
   
   
      function desired_country2() {
        
       <?php if (isset($edit_page)) { ?>
       var country_id = $('#desired_country2_edit_page').attr('data-val');
       <?php } else { ?>
       var country_id = $('#desired_country2 option:selected').attr('data-val');
       <?php } ?>
       
       
         $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>welcome/getStateDirect",
            data: {
               country_id: country_id
            },
            dataType: 'JSON',
            success: function(data) {
               $('#desired_state2').html(data.success);
            
            
               <?php if (!empty($quote_data[0])) { ?>
               <?php if (isset($edit_page)) { ?>
              <?php if ($quote_data[0]->desired_state2) { ?>
                 $('#desired_state2_edit_page').text('<?= $quote_data[0]->desired_state2 ?>');
             <?php } else { ?>
             $('#desired_state2_edit_page').text('Select');
             <?php } ?>
               <?php } else { ?> 
              
               $('#desired_state2').val('<?= $quote_data[0]->desired_state2 ?>');
               <?php } ?>           
               <?php } ?>
               
               
   
   
            }
         });
      }
   
      desired_country();
      desired_country2();
   
   });
</script>
