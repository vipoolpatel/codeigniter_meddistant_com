<main>
   <style>
      .radio label, .checkbox label {
      cursor: pointer;
      }
      .required {
      color: red;
      }
   </style>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <?php if ($this->session->userdata('user_type') != 'agent') {
               if (!empty($facility_data['username'])) {
                echo "<h1>" . $facility_data['username'] . " Quote</h1>";
               } else {
                echo "<h1>Meddistant Quote</h1>";
               }
               
               } else {
               echo "<h1>Meddistant Quote</h1>";
               }
               
               $service = '';
               if ($user_data['type'] == 'Service') {
               $service = 'display:none';
               }
               ?>
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
                  <!-- <h5 class="mb-4">Send Quote</h5> -->
                  <form action="<?php echo base_url() . 'quotes_sent/quote_edit_sent/' . $user_data['quote_sent_id'] ?>" method="post" enctype="multipart/form-data" >
                     <?php
                        if ($user_data['type'] == 'Treatment') {
                          ?>
                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-6">
                           <label for="doctor">Doctor <span class="required">*</span></label>
                           <select class="form-control" required id="doctor" name="doctor_id" onchange="otherDoctor(event)">
                              <option value="">Select Doctor</option>
                              <?php if (isset($doctors)): ?>
                              <?php foreach ($doctors as $doctor) {
                                 $selected = '';
                                 if ($doctor['doctor_id'] == $user_data['doctor_id']) {
                                  $selected = 'selected';
                                 }
                                 ?>
                              <option <?=$selected?> value="<?php echo $doctor['doctor_id'] ?>"><?php echo $doctor['name'] ?></option>
                              <?php
                                 }
                                  endif;?>
                              <option <?=($user_data['doctor_id'] == '0') ? 'selected' : ''?> value="0">Add Other Doctor</option>
                           </select>
                        </div>
                        <div class="form-group col-md-6" id="new_doctor" style="<?=($user_data['doctor_id'] == '0') ? '' : 'display: none;'?>">
                           <label for="doctor">Add Doctor</label>
                           <input class="form-control" name="new_doctor" type="text" value="<?=$user_data['new_doctor']?>">
                        </div>
                     </div>



                    





                     <?php }?>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for=""><span class="ChangeMessage">
                           <?php
                              if ($user_data['type'] == 'Treatment') {
                                echo "Message/Proposed treatment ";
                              } else {
                                echo "Proposed Service ";
                              }
                              ?>
                           </span> <span class="required">*</span></label>
                           <textarea class="form-control" required name="message"><?=$user_data['message']?></textarea>
                        </div>
                     </div>
                     <?php
                        if ($user_data['type'] == 'Treatment') {
                          ?>
                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-12">
                           <label for="inputEmail4">Length of stay days <span class="required">*</span></label>
                           <input class="form-control validation-number" required id="stay_length" name="stay_length" type="text" value="<?=$user_data['stay_length']?>">
                        </div>
                     </div>
                     <?php }
                        ?>


                


                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for=""><span class="ChangeTotal">
                           <?php
                              if ($user_data['type'] == 'Treatment') {
                                echo "Total Treatment Cost ($) ";
                              } else {
                                echo "Total Cost ($) ";
                              }
                              ?>
                           </span> <span class="required">*</span></label>
                           <input class="form-control validation-number" required name="treatment_cost" id="treatment_cost" type="text" value="<?=$user_data['treatment_cost']?>">
                        </div>
                     </div>



                      <?php
                        if ($user_data['type'] == 'Treatment') {
                          ?>
                    <div class="form-row hide-in-service">
                        <div class="form-group col-md-12">
                           <label for="">Accommodations <span class="required">*</span></label>
                           <br>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input include-stay-accomodations upcoming_hotel" type="radio" required name="accomodations"  <?php if (!empty($user_data) && isset($user_data['accomodations'])) {
                                 if ($user_data['accomodations'] === 'yes') {?> checked <?php }}?>  id="inlineRadio0"
                                 value="yes">
                              <label class="form-check-label" for="inlineRadio0">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input include-stay-accomodations upcoming_hotel" type="radio" required name="accomodations" <?php if (!empty($user_data) && isset($user_data['accomodations'])) {
                                 if ($user_data['accomodations'] === 'no') {?> checked <?php }}?> id="inlineRadio00"
                                 value="no"
                                 >
                              <label class="form-check-label" for="inlineRadio00">
                              No
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="form-row hide-in-service hotel_show">
                        <div class="form-group col-md-12">
                           <label for="inputEmail4">Hotel Name <span class="required">*</span></label>
                           <input id="hotel_name" class="form-control requi_hotel" required name="hotel_name" type="text" value="<?=$user_data['hotel_name']?>">
                        </div>
                     </div>

                     <div class="form-row hide-in-service hotel_show">
                        <div class="form-group col-md-12">
                           <label for="inputEmail4">Stay/Hotel Option Cost <span class="required">*</span></label>
                           <input class="form-control requi_hotel validation-number" required id="hotel_cost" name="hotel_cost" type="text" value="<?=$user_data['hotel_cost']?>">
                        </div>
                     </div>


                   <?php }
                   ?>



<?php if ($this->session->userdata('user_type') == 'agent') { 

  ?>

                   <div class="form-group hide-in-service" >
                        <label for="">Facilitation Fees <span class="required"> *</span> </label>
                        <input class="form-control requi_hotel validation-number"  value="<?=$user_data['facilitation_fees']?>" required name="facilitation_fees" id="facilitation_fees" type="text">
                     </div>




  <?php
  $array_discount =  array('0','10','15','20','25','50','100');
  ?>
  
              <div class="form-row">
                <div class="form-group col-md-12">
                   <label><span>Due Payment at checkout (%)</span> <span class="required">*</span></label>
                   <select class="form-control" required name="agent_prepay">
                      <option value="">Select Due Payment at checkout</option>
                      <?php foreach($array_discount as $i) { ?>
                      <option <?=($user_data['agent_prepay'] == $i) ? 'selected' : '' ?> value="<?=$i?>"><?=$i?>%</option>
                      <?php } ?>
                   </select>
                </div>
             </div>
<?php } ?>



                     <?php
                        if ($user_data['type'] == 'Treatment') {
                          ?>
                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_one">
                           <?php
                              if (!empty($user_data['file_one'])) {
                                  ?>
                           <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $user_data['file_one'] ?>" style="text-decoration: underline;color:blue;" target="_blank">File 1</a>
                           <?php }
                              ?>
                           <input type="hidden" value="<?=$user_data['file_one']?>" name="old_file_one">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_two">
                           <?php
                              if (!empty($user_data['file_two'])) {
                                  ?>
                           <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $user_data['file_two'] ?>" style="text-decoration: underline;color:blue;" target="_blank">File 2</a>
                           <?php }
                              ?>
                           <input type="hidden" value="<?=$user_data['file_two']?>" name="old_file_two">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_three">
                           <?php
                              if (!empty($user_data['file_three'])) {
                                  ?>
                           <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $user_data['file_three'] ?>" style="text-decoration: underline;color:blue;" target="_blank">File 3</a>
                           <?php }
                              ?>
                           <input type="hidden" value="<?=$user_data['file_three']?>" name="old_file_three">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_four">
                           <?php
                              if (!empty($user_data['file_four'])) {
                                  ?>
                           <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $user_data['file_four'] ?>" style="text-decoration: underline;color:blue;" target="_blank">File 4</a>
                           <?php }
                              ?>
                           <input type="hidden" value="<?=$user_data['file_four']?>" name="old_file_four">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_five">
                           <?php
                              if (!empty($user_data['file_five'])) {
                                  ?>
                           <a href="<?php echo base_url(); ?>uploads/quotes/<?php echo $user_data['file_five'] ?>" style="text-decoration: underline;color:blue;" target="_blank">File 5</a>
                           <?php }
                              ?>
                           <input type="hidden" value="<?=$user_data['file_five']?>" name="old_file_five">
                        </div>
                     </div>
                     <?php }
                        ?>
                     <br>
                     <!-- <div style="color: #ff002c; font-size: 10px; margin-bottom: 10px">
                        * Please note that above cost may not change if proposed treatment is followed. In rare cases cost may change up or down based on in-person meeting with doctor at location or via consultations. Any change in cost change will never more than 20% above quoted price.
                     </div> -->
                     <div style="color: #ff002c; font-size: 12px">
                        * Treatment cost excludes any travel or accommodation expenses.
                     </div>
                     <br>
                     <div class="form-group row mb-0 float-right">
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-primary mb-0">Update</button>
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
   $(".validation-number").keypress(function (e) {
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
      }
    });



  $('#treatment_cost').keyup(function(){
      $('#facilitation_fees').val('');
    });

   $('#facilitation_fees').keyup(function(){
        var amount = $('#treatment_cost').val();
        var fees = $(this).val();
        if(amount == '')
        {
           amount = 0;
        }

        if(fees == '')
        {
           fees = 0;
        }

        var amount_five_percent = (amount * 5) / 100;

        if(fees > amount_five_percent)
        {
           $(this).val('');
           alert('Please make fee below $'+amount_five_percent);
        }
   });
   
   
   <?php
      if ($user_data['accomodations'] != 'yes') {?>
   
      $('.hotel_show').hide();
      $('.requi_hotel').prop('required',false);
      $('.requi_hotel').val('');
   <?php }
      ?>
   
      $('.upcoming_hotel').change(function(){
             var value = $(this).val();
             if(value == 'yes'){
                 $('.hotel_show').show();
                 $('.requi_hotel').prop('required',true);
             }
             else
             {
                 $('.hotel_show').hide();
                 $('.requi_hotel').prop('required',false);
                 $('.requi_hotel').val('');
             }
         });
   
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