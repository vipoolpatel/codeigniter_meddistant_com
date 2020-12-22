<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Edit Profile</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Profile</li>
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
							<form class="mb-5" method="post" action="<?php echo base_url(); ?>profile/update_profile" enctype = "multipart/form-data" novalidate="novalidate">
                            <div class="form-group row">
                                    <label for="firstName" class="col-sm-2 col-form-label">User First Name</label>
                                    <div class="col-sm-10">
										<input <?php if ($user_data['user_type'] === 'customer') {echo 'readonly';}?> class="form-control" name="first_name" id="firstName" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['first_name']);}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-sm-2 col-form-label">User Last Name</label>
                                    <div class="col-sm-10">
										<input <?php if ($user_data['user_type'] === 'customer') {echo 'readonly';}?> class="form-control" name="last_name" id="lastName" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['last_name']);}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emailAddress" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input readonly class="form-control" name="email" id="emailAddress" placeholder="" type="email" min="1" required value="<?php if (!empty($user_data)) {echo $user_data['email'];}?>">
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
                                            <?php if ($this->session->userdata('user_type') == "customer") {?>
                                                <img src="<?php if (!empty($user_data)) {if ($user_data['picture'] != '') {echo base_url() . 'uploads/customer/' . $user_data['picture'];} else {echo base_url() . 'assets/admin_asset/updated/img/profile-pic-l.jpg';}}?>" style="width: 113px;" alt="">
                                            <?php } else {?>
                                                <img src="<?php if (!empty($user_data)) {if ($user_data['picture'] != '') {echo base_url() . 'uploads/hospital/' . $user_data['picture'];} else {echo base_url() . 'assets/admin_asset/updated/img/profile-pic-l.jpg';}}?>" style="width: 113px;" alt="">
                                            <?php }?>
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
                                 <?php if ($user_data['user_type'] != 'customer') {?>
                                 <div class="form-group row">
                                     <?php if ($user_data['user_type'] == 'employer') { ?>
                                    <label for="lastName" class="col-sm-2 col-form-label">Company Name</label>
                                    <?php } else {?>

                                        <label for="lastName" class="col-sm-2 col-form-label">Med. Provider Name </label>

                                   <?php }?>
                                    <div class="col-sm-10">
										<input class="form-control" name="company_name" id="company_name" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['username']);}?>">
                                    </div>
                                </div>
                                <?php }?>

   <?php if ($user_data['user_type'] == 'hospital') {
	?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Med. Provider Type</label>
        <div class="col-sm-10">
            <select class="form-control" disabled>
                <option value="">Select</option>
                <?php
                foreach ($get_med_provider_type as $provider_type) {
                    ?>
                    <option <?=($provider_type->id == $user_data['hos_med_provider_type']) ? 'selected' : '' ?> value="<?=$value->id?>"><?=$provider_type->name?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>


                               <!--  <div class="form-group row">
                                      <label for="" class="col-sm-2 col-form-label">License/Permit Number</label>
                                       <div class="col-sm-10">
                                        <input class="form-control" name="license_number" id="" placeholder="" type="text" value="<?php if (!empty($user_data)) {
		echo $user_data['license_number'];
	}?>" required readonly>
										</div>
                                </div>
                                 -->
                                <?php }
?>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
<input class="form-control" name="country" id="country" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['country']);}?>" readonly>

                                    </div>
                                </div>
                                <script type="text/javascript">
                                jQuery("#country option[value='<?php if (!empty($user_data)) {echo ucfirst($user_data['country']);}?>']").attr('selected','selected');
                                </script>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" id="address" rows="3"><?php if (!empty($user_data)) {echo ucfirst($user_data['address']);}?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input  name="city" id="city" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['city']);}?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <?php
if (!empty($getState)) {
	?>
    <select name="state" id="state" class="form-control">
            <option value="">Select State</option>
            <?php
foreach ($getState as $value) {
		?>
<option <?=($value->state_name == $user_data['state']) ? 'selected' : ''?> value="<?=$value->state_name?>"><?=$value->state_name?></option>
<?php
}
	?>

    </select>
<?php
} else {?>
         <input  name="state" id="state" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['state']);}?>" >
<?php
}
?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
                                    <div class="col-sm-10">
                                        <input  name="zipcode" id="zipcode" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['zipcode']);}?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                            <form method="post" action="<?php echo base_url(); ?>profile/update_pwd" id="pwd_form">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>