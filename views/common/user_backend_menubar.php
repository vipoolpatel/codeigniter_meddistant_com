<nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>
        </div>


        <a class="navbar-logo" href="<?php echo base_url(); ?>dashboard">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">


                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name"><?php

if ($this->session->userdata('user_type') === 'hospital') {
	echo ucwords($this->session->userdata('username'));

} else {
	if (!empty($this->session->userdata('first_name'))) {
		echo ucwords($this->session->userdata('first_name'));
	} else {
		echo ucwords($this->session->userdata('username'));
	}
}
?>
                     </span>

                    <span>
                        <?php if ($this->session->userdata('picture') == "") {?>
                            <img alt="Profile Picture" src="<?php echo base_url(); ?>assets/admin_asset/updated/img/profile-pic-l.jpg" />
                        <?php } else {?>
                            <?php if ($this->session->userdata('user_type') == "customer") {?>
                                <img alt="Profile Picture" src="<?php echo base_url(); ?>uploads/customer/<?php echo $this->session->userdata('picture'); ?>" />
                            <?php } else {?>
                                <img alt="Profile Picture" src="<?php echo base_url(); ?>uploads/hospital/<?php echo $this->session->userdata('picture'); ?>" />
                            <?php }?>
                        <?php }?>
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>profile">Profile</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>logout">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                                    <?php
if ($this->session->userdata('user_type') === 'employer') {
	?>
        <li class="<?=($this->uri->segment(1) == "dashboard") ? 'active' : ''?>">
            <a href="<?php echo base_url(); ?>dashboard">
                <i class="iconsminds-dashboard"></i>
                <span>Welcome</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>entrollment_data">
                <i class="iconsminds-male"></i><span>Membership</span>
            </a>
        </li>

        <?php
$validate_data = $this->db->where('user_id', $this->session->userdata('user_id'));
	$validate_data = $this->db->get('tbl_user')->row();
	if (!empty($validate_data->address)
		&& !empty($validate_data->city)
		&& !empty($validate_data->state)
		&& !empty($validate_data->country)
		&& !empty($validate_data->zipcode)
		&& !empty($validate_data->company_type_id)
		&& !empty($validate_data->self_insured_employer)
		&& !empty($validate_data->employees_travel)
		&& !empty($validate_data->terms)
        && !empty($validate_data->is_quote)
	) {
		?>
        <li>
            <a href="#ReferralsList">
                <i class="iconsminds-file"></i> Referrals
            </a>
        </li>
        <?php }
	?>
<?php }
?>
					<?php
if ($this->session->userdata('user_type') === 'customer') {?>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>admin/agent/manage_quote">
                            <i class="iconsminds-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?=base_url()?>customer_quotes">
                            <i class="iconsminds-file"></i> Quote Requests List
                        </a>
					</li>


					<li>
                        <a href="<?php echo base_url(); ?>customer_quotes_received">
                            <i class="iconsminds-files"></i> Quotes Received
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>myfiles">
                            <i class="iconsminds-files"></i>
                            <span>My Files</span>
                        </a>
                    </li>
                     
                    <li>
                        <a href="<?php echo base_url(); ?>testimonial">
                            <i class="iconsminds-files"></i>
                            <span>Testimonial</span>
                        </a>
                    </li>

                    <?php }?>
                    <?php
if ($this->session->userdata('user_type') === 'hospital') {?>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>dashboard">
                            <i class="iconsminds-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#FacilityDetails">
                            <i class="iconsminds-male"></i> Medical Provider Details
                        </a>
                    </li>
                    <li>
                        <a href="#doctors">
                            <i class="iconsminds-doctor"></i> Manage Doctors
                        </a>
					</li>
					<li>
                        <a href="<?php echo base_url(); ?>quotes_requested">
                            <i class="iconsminds-file"></i> Quotes Requested
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>quotes_sent">
                            <i class="iconsminds-file"></i> Quotes Sent
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
                            <?php
if ($this->session->userdata('user_type') === 'employer') {?>
                <ul class="list-unstyled" data-link="ReferralsList">
                    <li>
                        <a href="<?php echo base_url(); ?>referrals/add">
                            <i class="iconsminds-add-file"></i> Add Referrals
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>referrals/upload_excel">
                            <i class="iconsminds-add-file"></i> Referrals (csv)
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>referrals">
                            <i class="simple-icon-list"></i> Referrals List
                        </a>
                    </li>
                </ul>

                <?php }?>

				<?php
if ($this->session->userdata('user_type') === 'customer') {?>
                <ul class="list-unstyled" data-link="quotes">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/manage_quote">
                            <i class="iconsminds-add-file"></i> Request Quotes
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>customer_quotes">
                            <i class="simple-icon-list"></i> Quote Requests List
                        </a>
                    </li>
                </ul>
                <?php }?>
                <?php
if ($this->session->userdata('user_type') === 'hospital') {?>
                <ul class="list-unstyled" data-link="facility">
                    <li>
                        <a href="<?php echo base_url(); ?>manage_facility/manage_facility">
                            <i class="iconsminds-add-user"></i> Add Facility
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>manage_facility">
                            <i class="simple-icon-list"></i> List Facility
                        </a>
                    </li>
				</ul>


                <ul class="list-unstyled" data-link="FacilityDetails">
                    <li>
                        <a href="<?php echo base_url(); ?>manage_facility/manage_facility">
                            <i class="simple-icon-list"></i> Medical Provider Details
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>manage_facility/hospitals">
                            <i class="simple-icon-list"></i> Hospitals
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>manage_facility/add_hospitals">
                            <i class="simple-icon-list"></i> Add Hospitals / Clinics
                        </a>
                    </li>
                </ul>






				<ul class="list-unstyled" data-link="doctors">
                    <li>
                        <a href="<?php echo base_url(); ?>manage_doctors/manage_doctor">
                            <i class="iconsminds-add-user"></i> Add Doctor
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>manage_doctors">
                            <i class="simple-icon-list"></i> List Doctors
                        </a>
                    </li>
                </ul>
                <?php }?>
            </div>
        </div>
    </div>