<main>
   <style>
      .radio label {
      cursor: pointer;
      }
   </style>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>
               <?php
                  if ($quote_sent_data->type == 'Treatment') {
                    echo $quote_sent_data->hospital_clinic;
                  } else {
                    echo $quote_sent_data->quote_by;
                  }
                  ?>
               Quote Detail
            </h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">Quote Sent Detail</li>
               </ol>
            </nav>
            <div class="separator mb-5"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-body">
                  <h5 class="mb-4">
                     <a class="btn btn-primary mb-0" href="<?=base_url()?>admin/agent/quote_detail_sent_pdf/<?=$quote_sent_data->quote_sent_id?>" >PDF Download</a>
                  </h5>
                  <div class="form-row">
                     <div class="form-group col-md-12">
                        <img style="max-width: 250px;" src="<?=base_url()?>assets/admin_asset/updated/img/logo-black.jpg" />
                        <label style="display: block;margin-top: 15px;">
                           <p style="font-weight: bold;"> Illinois, USA</p>
                           <p style="font-weight: bold;"> USA & Canada +1888 9699959</p>
                           <p style="font-weight: bold;"> Worldwide  +1312 8899105 </p>
                           <p style="font-weight: bold;"> Turkey +90 (541)9473789 </p>
                           <p style="font-weight: bold;"> care@meddistant.com</p>
                        </label>
                     </div>
                  </div>


                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <label style="font-size: 18px;color: blue;"><b>Patient Booking</b> </label>
                     </div>
                  </div>




                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Date:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=date('m-d-Y', strtotime($quote_sent_data->created_on))?>
                     </div>
                  </div>


                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Patient No.:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                             <?=$quote_sent_data->patient_no?>
                     </div>
                  </div>



                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Quote Request No.:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                          <?=$quote_sent_data->request_no?>
                     </div>
                  </div>






                  <?php
                  if(!empty($quote_sent_data->revised_date)) {
                  ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Revised Date:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=date('m-d-Y', strtotime($quote_sent_data->revised_date))?>
                     </div>
                  </div>
                  <?php }
                  ?>

                  


                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Patient Name:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->first_name?> <?=$quote_sent_data->last_name?>
                     </div>
                  </div>
                  <?php
                     if (!empty($quote_sent_data->rev_date)) {
                        ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Rev. Date:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=date('m-d-Y', strtotime($quote_sent_data->rev_date))?>
                     </div>
                  </div>
                  <?php }
                     ?>
                  <?php
                     if ($quote_sent_data->type == 'Treatment') {?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Treatment:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->treatment_name?>
                     </div>
                  </div>
                  <?php } else {?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Service:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->service_name?>
                     </div>
                  </div>
                  <?php }
                     ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital/Clinic:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->hospital_clinic?>
                     </div>
                  </div>
                  <?php
                     if (!empty($getHospital)) {
                        ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital Pic:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <img  style="height: 80px; width: 100px;" src="<?=base_url()?>uploads/hospital/<?=$getHospital->pic_area?>">
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital City:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$getHospital->hospital_city?>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital JCI:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$getHospital->hospital_jci?>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital State:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$getHospital->state?>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hospital Country:</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$getHospital->country?>
                     </div>
                  </div>
                  <?php }
                     ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b><?=($quote_sent_data->type != 'Service') ? 'Hospital' : ''?> Quotes/Ref. No.:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->hospital_ref?>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Quote By:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->quote_by?>
                     </div>
                  </div>
                 
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Phone No:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->phone_no?>
                     </div>
                  </div>

                   <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Med Provider Email:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->email?>
                     </div>
                  </div>


                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Doctor:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?php
                           if (!empty($quote_sent_data->name)) {
                            ?>
                        <a style="color: blue;" href="<?=base_url()?>customer_quotes_received/view_doctor_profile/<?=$quote_sent_data->doctor_id?>"><?=$quote_sent_data->name?></a>
                        <?php
                           } else {
                            echo !empty($quote_sent_data->new_doctor) ? $quote_sent_data->new_doctor : '';
                           }
                           ?>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Accommodations:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->accomodations?>
                     </div>
                  </div>
                  <?php
                     if ($quote_sent_data->accomodations == 'yes') {
                        ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hotel Name:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->hotel_name?>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b><?=($quote_sent_data->type != 'Service') ? 'Message/Proposed treatment' : 'Proposed Service'?>:</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->message?>
                     </div>
                  </div>


                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Length of stay (Days):</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->stay_length?>
                     </div>
                  </div>

                  <?php
                     if ($quote_sent_data->accomodations == 'yes') {
                        ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Hotel Total Cost ($):</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$quote_sent_data->hotel_cost?>
                     </div>
                  </div>
                  <?php
                     }
                     ?>

                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b><?=($quote_sent_data->type != 'Service') ? 'At heath facility' : 'Cost'?> ($):</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <b><?=!empty($quote_sent_data->treatment_cost) ? $quote_sent_data->treatment_cost : 'To be determined'?></b>
                     </div>
                  </div>

                  <?php
                  if(!empty($quote_sent_data->facilitation_fees)) {
                  ?>
                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Prepaid Fees ($):</b> </label>
                     </div>
                     <div class="form-group col-md-10">
                        <b><?=!empty($quote_sent_data->facilitation_fees) ? $quote_sent_data->facilitation_fees : 'To be determined'?></b>
                     </div>
                  </div>
               <?php }
               ?>


                  



                  <div class="form-row">
                     <div class="form-group col-md-2">
                        <label for=""><b>Prepayment (%):</b></label>
                     </div>
                     <div class="form-group col-md-10">
                        <?=$prepayment_hospital?>%
                     </div>
                  </div>
                  <h4 class="mb-4">File</h4>
                  <div class="form-row">
                     <?php if (!empty($quote_sent_data->file_one)) {?>
                     <div class="form-group col-md-1">
                        <label for="">
                        <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $quote_sent_data->file_one; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 1</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_sent_data->file_two)) {?>
                     <div class="form-group col-md-1">
                        <label for="">
                        <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $quote_sent_data->file_two; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 2</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_sent_data->file_three)) {?>
                     <div class="form-group col-md-1">
                        <label for="">
                        <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $quote_sent_data->file_three; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 3</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_sent_data->file_four)) {?>
                     <div class="form-group col-md-1">
                        <label for="">
                        <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $quote_sent_data->file_four; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 4</a>
                        </label>
                     </div>
                     <?php }?>
                     <?php if (!empty($quote_sent_data->file_five)) {?>
                     <div class="form-group col-md-1">
                        <label for="">
                        <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $quote_sent_data->file_five; ?>" style="text-decoration: underline;color:blue;" target="_blank">File 5</a>
                        </label>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
