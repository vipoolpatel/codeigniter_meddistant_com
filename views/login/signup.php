<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.css" rel="stylesheet" type="text/css">
<style>
   .signup .focus .form-label ,.signup .notempty .form-label{
   opacity: 0 !important;
   }
   .form-control {
    border:1px solid #000 !important;
    padding-left: 10px !important;
    border-radius: 5px !important;
   }
   .form-label {
      left: 10px !important;
   }
 .custom-select .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
    border: 1px solid #000 !important;
    padding-left: 10px;
    border-radius: 5px !important;
    line-height: 39px;

}
</style>
<section class="section-30 section-sm-60 bg-light signup">
   <div class="shell">
      <div class="range range-sm-center">
         <div class="cell-sm-7 cell-md-5 cell-lg-5">
            <div class="block-shadow text-center">
               <div class="block-inner">

                <?php
                  if ($key == "patients" || $key == "hospital") {
                    ?>
                    <img src="<?=base_url()?>assets/img/HospitalsSignup.1.jpg" style="border-radius: 10px;">
                    <?php
                  }
                  else if ($key == "employers") {
                    ?>
                    <img src="<?=base_url()?>assets/img/male-patient-meddistant.com-about-med-treatment.jpg" style="border-radius: 10px;">
                    <?php
                  }
                  else
                  { ?>
                    <img src="<?=base_url()?>assets/img/HospitalsSignup.1.jpg" style="border-radius: 10px;">
                    <?php
                  }
                  
                ?>

                  <div class="offset-top-35">
                    <img src="<?=base_url()?>assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg">
                  </div>

                  <p class="text-uppercase text-abbey text-bold">The Efficient Healthcare Marketplace</p>

               </div>
               <?php if ($this->session->flashdata('success_message')) {?>
               <div class="success_msg response">
                  <i class="fa fa-check"></i>
                  <span><?php echo $this->session->flashdata('success_message'); ?></span>
               </div>
               <?php }?>
               <?php if ($this->session->flashdata('error_message')) {?>
               <div class="error_msg response">
                  <i class="fa fa-times-circle"></i>
                  <span><?php echo $this->session->flashdata('error_message'); ?></span>
               </div>
               <?php }?>
               <form id="registration_form" class="form-modern form-darker offset-top-22" action="<?php echo base_url() . "signup/register"; ?>" method="post">
                  <div class="block-inner">


                     
                  <div class="form-group custom-select">
                    <select name="user_type" id="user_type_data" class="form-control">
                      <?php if ($key == "patients") { ?>
                      <option value="customer" data-content="Full Name" selected>Patient/Customer</option>
                      <?php } else if ($key == "hospital") { ?>
                      <option value="hospital" data-content="Hospital / Clinic Name">Hospital/Clinic/Physician</option>
                      <?php } else if ($key == "employers") { ?>
                      <option value="employer" data-content="Company Name">Employer/Insurer/Broker/Affiliate</option>
                      <?php } else { ?>
                      <option value="customer" data-content="Full Name" >Patient/Customer</option>
                      <option value="hospital" data-content="Hospital / Clinic Name">Hospital/Clinic/Physician</option>
                      <option value="employer" data-content="Company Name">Employer/Insurer/Broker/Affiliate</option>
                      <?php } ?>    
                      </select>
                    </div>

                    
                      <div class="form-group custom-select">
                        <select name="country" id="getCountry" required class="form-control">
                           <option value="">Your Country</option>
                           <?php
                              foreach ($getCountry as $value) {?>
                           <option value="<?=$value->country_name?>"><?=$value->country_name?></option>
                           <?php
                              }
                              ?>
                        </select>
                     </div>


                     <div class="form-group custom-select offset-top-22" id="fff">
                        <input id="register-form-name" type="text" required name="first_name" class="form-control first_name">
                        <label for="register-form-name" class="form-label"  id="first_name">User First Name</label>
                     </div>

                     <div class="form-group custom-select offset-top-22" id="lll">
                        <input id="register-form-name" type="text" required name="last_name" class="form-control last_name">
                        <label for="register-form-name" class="form-label" id="last_name">User Last Name</label>
                     </div>
                     <div class="form-group offset-top-22" id="abc">
                        <input id="register-form-name" type="text" name="username"  class="form-control username">
                        <label for="register-form-name" class="form-label" id="name">Full Name</label>
                     </div>
                     <div class="form-group offset-top-22">
                        <input id="feedback-email" type="email" required name="email"  class="form-control">
                        <label for="feedback-email" class="form-label">Email</label>
                     </div>

                     <div class="form-group offset-top-22">
                        <input id="password" minlength="6" type="password" required name="password"  class="form-control">
                        <label for="register-form-password" class="form-label">Password</label>
                     </div>
                     
                     <input type="hidden" id="pass_text">
                     <input type="hidden" id="pass_score">
                     <div class="form-group offset-top-22">
                        <input type="password" id="cPassword" minlength="6" required name="cpassword"  class="form-control">
                        <label for="register-form-password-confirm" class="form-label">Confirm password</label>
                     </div>







                     <div class="form-group offset-top-22">
                        <input id="register-form-phone" type="text" required name="phone_no"  class="form-control">
                        <label for="register-form-phone" class="form-label">Phone</label>
                     </div>
                     <div class="form-group offset-top-22">
                        <p for="" class="form-label " id= "showp" style="
                           color: green;margin-bottom: 100px;display:none;
                           ">Note:signup is currently available for these countries</p>
                     </div>
                   


                     <div class="form-group  offset-top-22">
                        <?php
                           $firstNumber_review = mt_rand(0,9);
                           $SecondNumber_review = mt_rand(0,9);
                           ?>
                        <label style="width: 100%;text-align: left;"><?=$firstNumber_review?> + <?=$SecondNumber_review?> = ?</label>
                        <input type="hidden" name="current_captcha" value="<?=$firstNumber_review + $SecondNumber_review ?>">
                        <input type="text" required name="captcha" class="form-control" placeholder="Sum Above">
                     </div>



                  </div>
                  <div class="offset-top-30 offset-sm-top-50">
                     <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                  </div>
               </form>
            </div>
            <div class="group-inline offset-top-15 text-center"><span class="text-dark">Already have a account?</span><a href="<?php echo base_url(); ?>login" class="link link-primary-inverse">Login here.</a></div>
         </div>
      </div>
   </div>
</section>
<script>
   $(document).ready(function () {
   
   
   
   $("#user_type_data").change(function(){
   	var user_type = $(this).val();
   	$.ajax({
   		type:'POST',
   		url:"<?=base_url()?>signup/getCountry",
   		data: {user_type: user_type},
   		dataType: 'JSON',
   		success:function(data){
   			$('#getCountry').html(data.success);
   		}
   	 });
   
   
       if($(this[this.selectedIndex]).text()=="Hospital/Clinic" || $(this[this.selectedIndex]).text()=="Employer/Organization"){
           $("#fff").hide();
           $("#lll").hide();
           $("#abc").show();
   
       	$('.first_name').prop('required',false);
       	$('.last_name').prop('required',false);
       	$('.username').prop('required',true);
       }
       else {
   
           $("#fff").show();
           $("#lll").show();
           $("#abc").hide();
           $('.first_name').prop('required',true);
       	$('.last_name').prop('required',true);
       	$('.username').prop('required',false);
       }
   });
   
   
    $("#user_type_data").change(function() {
           $('#name').text($('option:selected').attr('data-content'));
       }).change();
   
   
   });
   
   
   jQuery(document).ready(function($) {
   
    $(".form-control").focus(function(){
      $(this).parent().addClass("focus");
   
     }).blur(function(){
          $(this).parent().removeClass("focus");
     })
   
   });
   
   jQuery(document).ready(function($) {
   
    $('.form-control').blur(function()
       {
           if( !$(this).val() ) {
                 $(this).parent().removeClass('notempty');
           }
           else{
               $(this).parent().addClass("notempty");
           }
       });
   
   });
   
   
   
   $('#password').password({
   	shortPass: 'The password is too short',
   	badPass: 'Weak Password; try combining letters & numbers',
   	goodPass: 'Medium; try using special characters',
   	strongPass: 'Strong password',
   	containsUsername: 'The password contains the username',
   	enterPass: 'Type your password',
   	showPercent: false,
   	showText: true, // shows the text tips
   	animate: true, // whether or not to animate the progress bar on input blur/focus
   	animateSpeed: 'fast', // the above animation speed
   	username: false, // select the username field (selector or jQuery instance) for better password checks
   	usernamePartialMatch: true, // whether to check for username partials
   	minimumLength: 6 // minimum password length (below this threshold, the score is 0)
   });
   
   $('#password').on('password.text', (e, text, score) => {
   	$('#pass_text').val(text);
   	$('#pass_score').val(score);
   });
   
   
   $('#registration_form').submit(function () {
   	var pwd = $("#password").val();
   	var cpwd = $("#cPassword").val();
   
   
   		if(pwd != cpwd){
   			$("#err_text").css('display', 'block').text("Password does not match!");
   			return false;
   		}
   
   		var pass_text = $('#pass_text').val();
   		var pass_score = $('#pass_score').val();
   
   		if(pass_text == "") {
   			var pass_text = 'Weak Password';
   		}
   
   		if (pass_score <= 30) {
   			alert(pass_text);
   			return false;
   		}
   
   
   		$("#register_form").submit();
   
   
   });
</script>
