<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.css" rel="stylesheet" type="text/css">

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
							<form class="mb-5" action="<?php echo base_url(); ?>admin/profile/update_profile" method="post" enctype = "multipart/form-data" novalidate="novalidate">


                                   <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Territory, Countries</label>
                                    <div class="col-sm-10" style="margin-top: 6px;">
                                             <?php
                                                if($user_data['territory'] != 'all')
                                                {
                                                

                                        foreach ($getRecordCountry as $keyval) {
                                        ?>
                                     
                                             <?=!empty($keyval->country_name) ? $keyval->country_name : '-'?>
                                     
                                           <?php
                                            }
                                        }
                                            else
                                            {
                                                echo "All";
                                            }
                                           ?>
                                        
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Territory, USA States</label>
                                    <div class="col-sm-10" style="margin-top: 6px;">
                                            <?php
                                                if($user_data['territory'] != 'all')
                                                {
                                        foreach ($getRecordState as $keyvalue) {
                                        ?>
                                        <tr>
                                             <td>
                                             <?=!empty($keyvalue->state_name) ? $keyvalue->state_name : '-'?>
                                             </td>
                                        </tr>
                                           <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "All";
                                           
                                        }
                                        ?>
                                        
                                    </div>
                                </div>


                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">User First Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="username" id="inputName" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['first_name']);}?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">User Last Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="last_name" id="inputName" placeholder="" type="text" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['last_name']);}?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="territory" class="col-sm-2 col-form-label">Designation All</label>
                                        <div class="col-sm-10">
                                            <input <?php if ($user_data['user_type'] === 'agent') {echo 'readonly';}?> class="form-control" name="territory" id="territory" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {echo $user_data['territory'];}?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="pay_type" class="col-sm-2 col-form-label">Pay Type</label>
                                        <div class="col-sm-10">
                                            <input <?php if ($user_data['user_type'] === 'agent') {echo 'readonly';}?> class="form-control" name="pay_type" id="pay_type" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {if ($user_data['pay_type'] == "m") {echo "Monthly Pay";} else if ($user_data['pay_type'] == "c") {echo "Commission";}}?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pay_rate" class="col-sm-2 col-form-label">Pay Rate</label>
                                        <div class="col-sm-10">
                                            <input <?php if ($user_data['user_type'] === 'agent') {echo 'readonly';}?> class="form-control" name="pay_rate" id="pay_rate" placeholder="" type="text" min="1" value="$<?php if (!empty($user_data)) {echo $user_data['pay_rate'];}?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="commission_rate" class="col-sm-2 col-form-label">Commission Rate</label>
                                        <div class="col-sm-10">
                                            <input <?php if ($user_data['user_type'] === 'agent') {echo 'readonly';}?> class="form-control" name="commission_rate" id="commission_rate" placeholder="" type="text" min="1" value="<?php if (!empty($user_data)) {echo $user_data['commission_rate'];}?>%">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPhoneNo" class="col-sm-2 col-form-label">Phone No</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="phone_no" id="inputPhoneNo" placeholder="" type="text" min="1"  required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['phone_no']);}?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="emailAddress" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="email" id="emailAddress" placeholder="" type="email" min="1" required value="<?php if (!empty($user_data)) {echo ucfirst($user_data['email']);}?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row Agent-Company" style=" <?php if (!empty($user_data)) {if ($user_data['agent_type'] == 'i') {echo "display:none;";} else if ($user_data['agent_type'] == 'c') {echo "display:contents;";} else {echo "display:none;";}}?> ">
                                    <hr>
                                   <div class="form-group row">
                                        <label for="company_name" class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                             <input class="form-control" name="company_name" id="" placeholder="" type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['company_name']);}?>">
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                  <div class="form-group row">
                                    <label for="company_country"  class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">

                                    <input readonly type="text" class="form-control"  value="<?php if (!empty($user_data)) {echo $user_data['country'];}?>">
                                    </div>
                                </div>

                               <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" id="" rows="3"><?php if (!empty($user_data)) {echo ucfirst($user_data['address']);}?></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input  name="city" id="" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['city']);}?>" >
                                    </div>
                                </div>

                                    <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input  name="state" id="" readonly class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['state']);}?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
                                    <div class="col-sm-10">
                                        <input readonly <?php if ($user_data['user_type'] === 'agent') {echo 'readonly';}?>  name="zipcode" id="zipcode" class="form-control"  type="text" value="<?php if (!empty($user_data)) {echo ucfirst($user_data['zipcode']);}?>">
                                    </div>
                                </div>


                                <div class="form-group row" style="<?=($user_data['agent_type'] == 'c') ? 'display:none' : ''?>">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="gender" id="" class="form-control">
                                            <option <?php if (!empty($user_data)) {if ($user_data['gender'] == 'm') {echo 'selected';}}?> value = "m">Male</option>
                                            <option <?php if (!empty($user_data)) {if ($user_data['gender'] == 'f') {echo 'selected';}}?> value = "f">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div style="width: 125px;border: 6px solid grey;">
                                            <img src="<?php if (!empty($user_data)) {if ($user_data['picture'] != '') {echo base_url() . 'uploads/agent/' . $user_data['picture'];} else {echo base_url() . 'assets/admin_asset/updated/img/profile-pic-l.jpg';}}?>" style="width: 113px;" alt="">
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


                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                            <form method="post" action="<?php echo base_url(); ?>admin/profile/update_pwd" id="pwd_form">
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



<script type="text/javascript">
    
    
    $('#cpassword').password({

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
   


</script>