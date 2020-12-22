<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Agent Detail</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                             <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/admin/agent"); ?>">Manage Agents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agent Detail</li>
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
                            <!-- <h5 class="mb-4">Edit Profile</h5> -->
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div style="width: 125px;border: 6px solid grey;">
                                            <img src="<?php if(!empty($user_data)) { if($user_data['picture'] != ''){echo base_url().'uploads/agent/'.$user_data['picture']; }else{echo base_url().'assets/admin_asset/updated/img/profile-pic-l.jpg';} } ?>" style="width: 113px;" alt="">
                                        </div>
                                    </div>
                                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>UserName</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['username']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>First Name</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['first_name']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Last Name</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['last_name']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Email</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['email']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Phone No</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['phone_no']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Gender</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { if($user_data['gender'] == "m"){echo "Male";}else if($user_data['gender'] == "f"){echo "Female";} } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Pay Type</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { if($user_data['pay_type'] == "m"){echo "Monthly";}else if($user_data['pay_type'] == "c"){echo "Commission";} } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Pay Rate</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['pay_rate']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Agent Type</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { if($user_data['agent_type'] == "i"){echo "Individual";}else if($user_data['agent_type'] == "c"){echo "Company";} } ?></label>
                                    </div>
                                </div>

                                <hr>
                                <div class="row Agent-Company" style=" <?php if(!empty($user_data)) { if($user_data['agent_type'] == 'i'){echo "display:none;";}else if($user_data['agent_type'] == 'c'){echo "display:contents;";}else{echo "display:none;";} } ?> ">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Name:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_name']); } ?></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Address:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_address']); } ?></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Country:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_country']); } ?></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Street:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_street']); } ?></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Apt or suit no:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_apt']); } ?></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label ><b>Company City:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_city']); } ?></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label ><b>Company State/province:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_state']); } ?></label>
                                        </div>
                                        <div class="form-group col-md-6 usa-hide">
                                            <label ><b>Company Zipcode:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_zipcode']); } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-row usa-hide" style="display: none;">
                                        <div class="form-group col-md-6">
                                            <label ><b>Company Tax Id:</b> <?php if(!empty($user_data)) { echo ucfirst($user_data['company_tax_id']); } ?></label>
                                        </div>
                                        <div class="form-group col-md-6"></div>
                                    </div>
                                    <hr>
                                </div>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Country</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['country']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>State</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['state']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>City</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['city']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Address</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['address']); } ?></label>
                                    </div>
                                </div>

                                <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>