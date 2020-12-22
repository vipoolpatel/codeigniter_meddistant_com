<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Edit Profile</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Manage Hospitals</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
							<!-- <h5 class="mb-4">Edit Profile</h5> -->
                            <form class="mb-5" action="<?php echo base_url(); ?>admin/hospital/update_profile" method="post" enctype = "multipart/form-data" novalidate="novalidate">
                                <input type="hidden" name="user_id" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['user_id']);}?>">


                              <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label">Choose Your Health Provider Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="hos_med_provider_type" >
                                            <option value="">Select</option>
                                            <?php foreach ($get_med_provider_type as $value) { ?>
                                    <option <?=($value->id == $user_data['hos_med_provider_type']) ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->name?></option>
                              <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label">Facility Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="name" id="userName" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['username']);}?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="first_name" id="firstName" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['first_name']);}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="last_name" id="lastName" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['last_name']);}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emailAddress" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input readonly class="form-control" name="email" id="emailAddress" placeholder="" type="email" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['email']);}?>">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="phoneNo" class="col-sm-2 col-form-label">Phone No</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" name="phone_no" id="phoneNo" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['phone_no']);}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="gender" id="gender" class="form-control">
                                            <option <?php if (!empty($user_data)) {if ($user_data['gender'] == 'm') {echo 'selected';}}?> value = "m">Male</option>
                                            <option <?php if (!empty($user_data)) {if ($user_data['gender'] == 'f') {echo 'selected';}}?> value = "f">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div style="width: 125px;border: 6px solid grey;">
                                            <img src="<?php if (!empty($user_data)) {if ($user_data['picture'] != '') {echo base_url() . 'uploads/hospital/' . $user_data['picture'];} else {echo base_url() . 'assets/admin_asset/updated/img/profile-pic-l.jpg';}}?>" style="width: 113px;" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Picture</label>
                                    <div class="col-sm-10">
                                        <input  name="picture" id="" class="form-control" style="height: 40px;padding: 7px;"  type="file">
                                        <span style="color:grey;">Allowed only gif|jpg|png|jpeg formats</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                    <select name="country" id="getCountry" class="form-control">
                                        <?php
foreach ($country as $value) {
	?>
                                        <option data-val="<?=$value->id?>" <?=($value->country_name == $user_data['country']) ? 'selected' : ''?>  value="<?=$value->country_name?>"><?=$value->country_name?></option>
                                            <?php
}
?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10" id="getState">
                                        <input  name="state" id="state" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['state']);}?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input  name="city" id="city" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['city']);}?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" id="address" rows="3"><?=$user_data['address']?></textarea>
                                    </div>
                                </div>


                                  <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Postal Zip Code </label>
                                    <div class="col-sm-10">
                                        <input  name="zipcode" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['zipcode']);}?>" >
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Commission Rate (%)</label>
                                    <div class="col-sm-10">
                                        <input  name="hospital_commission" id="hospital_commission" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['hospital_commission']);}?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Prepayment (%)</label>
                                    <div class="col-sm-10">
                                        <input  name="hospital_prepay" id="hospital_prepay" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['hospital_prepay']);}?>" >
                                    </div>
                                </div>

                                <hr />

                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Trip Start Date</label>
                                    <div class="col-sm-10">
                                        <input  name="start_date" class="form-control"  type="date" value="<?=!empty($user_data) ? $user_data['start_date'] : '' ?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Trip End Date</label>
                                    <div class="col-sm-10">
                                        <input  name="end_date"  class="form-control"  type="date" value="<?=!empty($user_data) ? $user_data['end_date'] : '' ?>" >
                                    </div>
                                </div>

                                <hr />

                               <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">P.O. Number (optional) </label>
                                    <div class="col-sm-10">
                                        <input  name="hos_p_o_number"  class="form-control"  type="text" value="<?=!empty($user_data) ? $user_data['hos_p_o_number'] : '' ?>" >
                                    </div>
                                </div>


                                 <hr />


                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Paid Setup </label>
                                    <div class="col-sm-10">
                                        <input  name="paid_setup"  class="form-control"  type="text" value="<?=!empty($user_data) ? $user_data['paid_setup'] : '' ?>" >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Subscription Type </label>
                                    <div class="col-sm-10">

                                        <?php
                                        $subscription_type = !empty($user_data) ? $user_data['subscription_type'] : '';
                                        ?>
                                        <select class="form-control" name="subscription_type">
                                            <option value="">Select</option>
                                            <option <?=($subscription_type == 'Month') ? 'selected' : '' ?> value="Month">Month</option>
                                            <option <?=($subscription_type == 'Annual') ? 'selected' : '' ?> value="Annual">Annual</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Subscription Price </label>
                                    <div class="col-sm-10">
                                        <input  name="subscription_price"  class="form-control"  type="text" value="<?=!empty($user_data) ? $user_data['subscription_price'] : '' ?>" >
                                    </div>
                                </div>



                                   <hr />





                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update Profile</button>
                                    </div>
                                </div>
                            </form>


                  <!--           <form method="post" action="<?php echo base_url(); ?>admin/hospital/update_pwd/<?php echo $user_data['user_id']; ?>" id="pwd_form">
                                <div class="form-group row">
                                    <label for="cpassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
										<input class="form-control" data-parsley-equalto="#cpassword" name="password" id="cpassword" placeholder="Password" type="password" min="6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
									<input class="form-control" data-parsley-equalto="#password" name="password" id="password" placeholder="Password" type="password" min="6">
                                    </div>
								</div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update Password</button>
                                    </div>
                                </div>
                            </form>
 -->

                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <a href="javascript:;" id="<?=$user_data['user_id']?>" class="btn btn-primary ResetPasswordViaEmail">Reset Password Via Email</a>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        
     $('.ResetPasswordViaEmail').click(function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>admin/agent/reset_password_via_email",
            data: {
               id: id
            },
            dataType: 'JSON',
            success: function(data) {
                alert("Email successfully sent");
            }
         });
      });


        
      $('#getCountry').change(function() {
         getState();
      });

      function getState() {

         var country_id = $('#getCountry option:selected').attr('data-val');
         var state_name = '<?=$user_data['state']?>';
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


    </script>