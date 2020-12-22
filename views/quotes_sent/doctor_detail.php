<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Doctor Detail</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Manage Doctor</li>
                            <li class="breadcrumb-item active" aria-current="page">doctor Doctor</li>
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
                                            <img src="<?php if(!empty($user_data)) { if($user_data['doctor_image'] != ''){echo base_url().'upload_dir/doctors_image/'.$user_data['doctor_image']; }else{echo base_url().'assets/admin_asset/updated/img/profile-pic-l.jpg';} } ?>" style="width: 113px;" alt="">
                                        </div>
                                    </div>
                                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Name</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['name']); } ?></label>
                                    </div>
                                </div>

                                <hr>


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
                                    <label for="userName" class="col-sm-2 col-form-label"><b>License Country</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['license_country']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>License Number</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['license_number']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Specialties</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['specialties']); } ?></label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label"><b>Language Spoken</b></label>
                                    <div class="col-sm-10">
                                        <label for="userName" class="col-form-label"><?php if(!empty($user_data)) { echo ucfirst($user_data['language_spoken']); } ?></label>
                                    </div>
                                </div>

                                <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>