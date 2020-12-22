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
                  <form action="<?php echo base_url() ?>quotes_requested/manage_send_quote" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="add" value="1">
                     <input type="hidden" name="quote_request_id" value="<?php echo $this->uri->segment(3); ?>">
                     <?php if ($this->session->userdata('user_type') == 'agent') {?>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">Type <span class="required">*</span></label>
                           <select id="ChangeType" class="form-control" name="type" required>
                              <option value="Treatment">Treatment</option>
                              <option value="Service">Service</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-row show-in-service" style="display:none;">
                        <div class="form-group col-md-12">
                           <label for="">Service Name <span class="required">*</span></label>
                           <input class="form-control" id="service_name" type="text" name="service_name">
                        </div>
                     </div>
                     <?php } else {
                        ?>
                     <input type="hidden" value="Treatment" name="type">
                     <?php
                        }
                        ?>
                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-6">
                           <label for="">Hospital/Clinic <span class="required">*</span></label>
                           <select class="form-control" required name="hospital_clinic" id="hospital_clinic_ajax">
                              <option value="">Select Hospital/Clinic</option>
                              <?php
                                 if (!empty($hospital)) {
                                 	foreach ($hospital as $hospitals) {?>
                              <option data-val="<?php echo $hospitals['id']; ?>" value="<?php echo $hospitals['id']; ?>"><?php echo $hospitals['hospital_name'] ?></option>
                              <?php }
                                 }
                                 ?>
                              <?php if ($this->session->userdata('user_type') == 'agent') {?>
                              <option value="0">Add Hospital/Clinic</option>
                              <?php }
                                 ?>
                           </select>
                        </div>
                        <div class="form-group col-md-6" id="new_hospital_clinic" style="display: none;">
                           <label for="doctor">Add Hospital/Clinic</label>
                           <input class="form-control" name="new_hospital_clinic" type="text">
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">
                           <?php if ($this->session->userdata('user_type') != 'agent') {?>Hospital <?php }?> Quotes/Ref. No. <span class="required">(Optional)</span></label>
                           <input class="form-control" name="hospital_ref" id="" type="text" value="" >
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">Name of Quote preparer <span class="required">*</span></label>
                           <input class="form-control" name="quote_preparer_name" value="<?php if (!empty($facility_data)) {
                              echo $facility_data['username'];
                              }?>" type="text" required>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">Email</label>
                           <input class="form-control" value="<?php if (!empty($facility_data)) {
                              echo $facility_data['email'];
                              }?>" type="email" disabled>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">Phone No</label>
                           <input class="form-control" value="<?php if (!empty($facility_data)) {
                              echo $facility_data['phone_no'];
                              }?>" type="text" disabled>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="">Treatment Category</label>
                           <input class="form-control" value="<?php if (!empty($send_quote_data)) {
                              echo $send_quote_data['procedure_treatment'];
                              }?>" type="text" disabled>
                        </div>
                     </div>
                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-6">
                           <label for="doctor">Doctor <span class="required">*</span></label>
                           <select class="form-control" required id="doctor" name="doctor" onchange="otherDoctor(event)">
                              <option value="">Select Doctor</option>
                              <?php if (isset($doctors)): ?>
                              <?php foreach ($doctors as $doctor) {?>
                              <option value="<?php echo $doctor['doctor_id'] ?>"><?php echo $doctor['name'] ?></option>
                              <?php
                                 }
                                 endif;?>
                              <option value="0">Add Other Doctor</option>
                           </select>
                        </div>
                        <div class="form-group col-md-6" id="new_doctor" style="display: none;">
                           <label for="doctor">Add Doctor</label>
                           <input class="form-control" name="new_doctor" type="text">
                        </div>
                     </div>



                     


                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for=""><span class="ChangeMessage">Message/Proposed treatment</span> <span class="required">*</span></label>
                           <textarea class="form-control" required name="message"></textarea>
                        </div>
                     </div>


                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-12">
                           <label for="inputEmail4">Length of stay days <span class="required">*</span></label>
                           <input class="form-control validation-number" required id="stay_length" name="stay_length" type="text">
                        </div>
                     </div>


                     


                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for=""><span class="ChangeTotal">Total Treatment Cost ($)</span> <span class="required">*</span><span class="hide-in-service">
                                <input style="margin-left: 10px;" type="checkbox" name="is_determined" id="is_determined"> To be determined, explained in message above </span>
                           </label>
                          
                           <input class="form-control validation-number" id="treatment_cost" required name="treatment_cost" type="text">
                        </div>
                     </div>


                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-12">
                           <label for="">Accommodations Included? <span class="required">*</span></label>
                           <br>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input include-stay-accomodations upcoming_hotel" type="radio" required name="accomodations"  id="inlineRadio0"
                                 value="yes">
                              <label class="form-check-label" for="inlineRadio0">
                              Yes
                              </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input include-stay-accomodations upcoming_hotel" type="radio" required name="accomodations" id="inlineRadio00"
                                 value="no">
                              <label class="form-check-label" for="inlineRadio00">
                              No
                              </label>
                           </div>
                        </div>
                     </div>



                     <div class="form-group hotel_show hide-in-service" id="" style="display: none;">
                        <label for="">Hotel Name <span class="required"> *</span></label>
                        <input class="form-control requi_hotel" name="hotel_name" type="text">
                     </div>

                     <div class="form-group hotel_show hide-in-service" id="" style="display: none;">
                        <label for="">Stay/Hotel Option Cost<span class="required"> *</span> </label>
                        <input class="form-control requi_hotel validation-number" name="hotel_cost" type="text">
                     </div>




<?php if ($this->session->userdata('user_type') == 'agent') { 
   ?>
                     <div class="form-group hide-in-service" >
                        <label for="">Facilitation Fees <span class="required"> *</span> </label>
                        <input class="form-control requi_hotel validation-number" required name="facilitation_fees" id="facilitation_fees" type="text">
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
                           		<option value="<?=$i?>"><?=$i?>%</option>
                           		<?php } ?>
                           </select>
                        </div>
                     </div>
<?php } ?>


                     <div class="form-row hide-in-service">
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_one">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_two">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_three">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_four">
                        </div>
                        <div class="form-group col-md-2">
                           <label for="">Attach related Pics/Files <span class="required">(optional)</span></label>
                           <input type="file" class="form-control" name="file_five">
                        </div>
                     </div>
                     <hr>
                     <!-- <div style="color: #ff002c; font-size: 10px; margin-bottom: 10px">
                        * Please note that above cost may not change if proposed treatment is followed. In rare cases cost may change up or down based on in-person meeting with doctor at location or via consultations. Any change in cost change will never more than 20% above quoted price.
                     </div> -->
                     <div style="color: #ff002c; font-size: 12px">
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
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
   $(".validation-number").keypress(function (e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
   }
   });
   

   
   $('#is_determined').change(function(){
      $('#treatment_cost').val('');
      if(this.checked)
      {
         $('#treatment_cost').prop('readonly',true);
      }
      else
      {
         $('#treatment_cost').prop('readonly',false);
      }
   });


   $('#treatment_cost').keyup(function(){
      $('#facilitation_fees').val('');
   });

   $('#facilitation_fees').keyup(function(){

       var fees = $(this).val();
      if($('#is_determined').prop("checked") == true){   
      
         if(fees > 200)
         {
            $(this).val('');
            alert('Please make fee below $200');
         }

      }
      else
      {

         var amount = $('#treatment_cost').val();
        
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
      }


   });
   
   
   $('#ChangeType').change(function(){
   var value = $(this).val();
   if(value == 'Service')
   {
     $('.hide-in-service').hide();
     $('.show-in-service').show();
   
     $('.ChangeMessage').html('Proposed Service');
     $('.ChangeTotal').html('Total Cost ($)');
     $('#stay_length').prop('required',false);
     $('#hospital_clinic_ajax').prop('required',false);
     $('#doctor').prop('required',false);
     $('.include-stay-accomodations').prop('required',false);
   
     $('#service_name').prop('required',true);
     $('.requi_hotel').prop('required',false);
     $('#facilitation_fees').prop('required',false);
     
     $('.requi_hotel').val('');
   }
   else
   {
   $('.hide-in-service').show();
   $('.show-in-service').hide();
   $('.ChangeMessage').html('Message/Proposed treatment');
   $('.ChangeTotal').html('Total Treatment Cost ($)');
   $('#stay_length').prop('required',true);
   $('#hospital_clinic_ajax').prop('required',true);
   $('#facilitation_fees').prop('required',true);
      $('#doctor').prop('required',true);
      $('.include-stay-accomodations').prop('required',true);
   
      $('#service_name').prop('required',false);
      $('#service_name').val('');
   }
   });
   
   
   $('#hospital_clinic_ajax').change(function(){
   var value =  $('#hospital_clinic_ajax option:selected').attr('data-val');
   $.ajax({
   type:'POST',
   url:"<?=base_url()?>quotes_requested/getDoctor",
   data: {user_id: value},
   dataType: 'JSON',
   success:function(data){
   	$('#doctor').html(data.success);
   }
   });
   });
   
   
   $('#hospital_clinic_ajax').change(function(){
   var value = $(this).val();
   if(value == 0)
   {
   $('#new_hospital_clinic').show();
   
   }
   else
   {
   $('#new_hospital_clinic').hide();
   
   }
   });
   
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
