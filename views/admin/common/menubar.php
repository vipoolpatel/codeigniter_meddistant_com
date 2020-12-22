<style type="text/css">
    .text-align-menu li a {
        text-align: center;
    }
</style>
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
            <?php if ($this->session->userdata('user_type') == 'agent') {?>
                <?php if ($this->session->userdata('agent_password_changed') == 0) {?>
                    <div class="">
                        <span style="color:grey;">Please Change Your <a href="<?php echo base_url(); ?>admin/profile" style="text-decoration: underline;">Password</a></span>
                    </div>
                <?php }?>
            <?php }?>
        </div>


        <a class="navbar-logo" href="<?php echo base_url(); ?>admin/dashboard">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">


              <!--                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">-->
<!--                    <i class="simple-icon-size-fullscreen"></i>-->
<!--                    <i class="simple-icon-size-actual"></i>-->
<!--                </button>-->

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name"><?php echo ucwords($this->session->userdata('username')); ?></span>
                    <span>
                        <?php if ($this->session->userdata('picture') == "") {?>
                            <img alt="Profile Picture" src="<?php echo base_url(); ?>assets/admin_asset/updated/img/profile-pic-l.jpg" />
                        <?php } else {?>
                            <img alt="Profile Picture" src="<?php echo base_url(); ?>uploads/agent/<?php echo $this->session->userdata('picture'); ?>" />
                        <?php }?>
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                <?php if ($this->session->userdata('user_type') == 'admin' && empty($this->session->userdata('super_admin'))) {

	?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/profile">Profile</a>
                    <?php } else {
	?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/profile">Profile</a>
                        <?php
}
?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/logout">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled text-align-menu">
                    <?php
if ($this->session->userdata('user_type') === 'admin') {
	?>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>admin/dashboard">
                            <i class="iconsminds-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/general_info/contact_inq">
                            <i class="iconsminds-digital-drawing"></i> Contact Us Inquiry
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/general_info/scheduled_calls">
                            <i class="iconsminds-monitor---phone"></i> Scheduled Calls
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/general_info/newsletter">
                            <i class="iconsminds-email"></i> Email Subscription
                        </a>
                    </li>
                    <li>
                        <a href="#quotes">
                            <i class="iconsminds-file"></i> Quote Requests
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/discounts">
                            <i class="simple-icon-list"></i> Discount Codes
                        </a>
                    </li>

             <!--        <li>
                        <a href="<?php echo base_url(); ?>admin/agent/referral_list">
                            <i class="simple-icon-list"></i> Referral
                        </a>
                    </li> -->

                    <li>
                        <a href="#agents">
                            <i class="iconsminds-business-man"></i> Manage Agents
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/customer">
                            <i class="iconsminds-business-man-woman"></i> Manage Customers
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/doctors">
                            <i class="iconsminds-doctor"></i> Manage Doctors
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/hospital">
                            <i class="iconsminds-building"></i> Medical Providers
                        </a>
                    </li>




                    <li>
                        <a href="#ManageCompanies">
                            <i class="iconsminds-building"></i> Manage Companies
                        </a>
                    </li>


	                
	                    <li>
	                        <a href="<?php echo base_url(); ?>admin/archives">
	                            <i class="iconsminds-folder"></i> Archive
	                        </a>
	                    </li>


                    <li>
                        <a href="#ManageTreatment">
                            <i class="iconsminds-file"></i> Manage Treatment
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#employees">
                            <i class="iconsminds-three-arrow-fork"></i> Manage Employees
                        </a>
                    </li> -->



                    <li>
                        <a href="<?php echo base_url(); ?>admin/testimonial">
                            <i class="iconsminds-file"></i> Testimonial
                        </a>
                    </li>

                   <li>
                        <a href="#ManageAdmin">
                            <i class="iconsminds-file"></i> Manage Admin
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/search_engine_optimization">
                            <i class="iconsminds-digital-drawing"></i> SEO
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/landing_page">
                            <i class="iconsminds-file"></i> Landing Page
                        </a>
                    </li>


                    <li>
                        <a href="#ManageCountry">
                            <i class="iconsminds-digital-drawing"></i> Country
                        </a>
                    </li>
                  

                    <li>
                        <a href="<?php echo base_url(); ?>admin/usa_availability">
                            <i class="iconsminds-digital-drawing"></i> US States
                        </a>
                    </li>

                    <li style="text-align: center;">
                        <a href="<?php echo base_url(); ?>admin/med_provider_type">
                            <i class="iconsminds-digital-drawing"></i> USA Med. Subscriptions
                        </a>
                    </li>


                    <li style="text-align: center;">
                        <a href="<?php echo base_url(); ?>admin/employer_subscription">
                            <i class="iconsminds-digital-drawing"></i> Employer Subscriptions
                        </a>
                    </li>


                    <?php 
                }
                ?>


                    <?php
if ($this->session->userdata('user_type') === 'agent') {?>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>admin/dashboard">
                            <i class="iconsminds-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>



                    <li>
                        <a href="#SalesData">
                            <i class="iconsminds-add-cart"></i> Sales
                        </a>
                    </li>

                    <li>
                        <a href="#quotes">
                            <i class="iconsminds-file"></i> Manage Quote Requests
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/quotes_sent">
                            <i class="iconsminds-file"></i> Quotes Sent
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/quotes_received">
                            <i class="iconsminds-file"></i> Quotes Received
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/hospital/assigned">
                            <i class="iconsminds-building"></i> My Assigned Hospitals/Clinics
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/hospital">
                            <i class="iconsminds-building"></i> All Hospitals/Clinics
                        </a>
                    </li>

                

                    <li>
                        <a href="<?php echo base_url(); ?>admin/doctors">
                            <i class="iconsminds-doctor"></i> Doctors
                        </a>
                    </li>


                    <?php }?>
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
                <?php
if ($this->session->userdata('user_type') === 'admin') {?>



                <ul class="list-unstyled" data-link="ManageAdmin">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/admin/add">
                            <i class="iconsminds-add-file"></i> Add Admin
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/admin">
                            <i class="simple-icon-list"></i> Admin List
                        </a>
                    </li>
                </ul>
                  <ul class="list-unstyled" data-link="ManageCountry">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/country/add">
                            <i class="iconsminds-add-file"></i> Add Country
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/country">
                            <i class="simple-icon-list"></i> Country List
                        </a>
                    </li>
                </ul>

                  
                <ul class="list-unstyled" data-link="ManageTreatment">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/treatment/add">
                            <i class="iconsminds-add-file"></i> Add Treatment
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/treatment">
                            <i class="simple-icon-list"></i> List Treatment
                        </a>
                    </li>
                </ul>




                <ul class="list-unstyled" data-link="quotes">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/manage_quote">
                            <i class="iconsminds-add-file"></i> Add Quote
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/manage_quotes">
                            <i class="simple-icon-list"></i> List Quote
                        </a>
                    </li>
                     
                </ul>




                <ul class="list-unstyled" data-link="ManageCompanies">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/manage_companies">
                            <i class="iconsminds-add-file"></i> Manage Companies
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/referrals">
                            <i class="simple-icon-list"></i> Referrals List
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="agents">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/manage_agent">
                            <i class="iconsminds-add-user"></i> Add Agent
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent">
                            <i class="simple-icon-list"></i> List Agent
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/booked_sales">
                            <i class="simple-icon-list"></i> Booked Sales
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="employees">
                    <li>
                        <a href="#">
                            <i class="iconsminds-add-file"></i> Add Employee
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="simple-icon-list"></i> List Employee
                        </a>
                    </li>
                </ul>
                <?php }?>
                <?php
if ($this->session->userdata('user_type') === 'agent') {?>



                <ul class="list-unstyled" data-link="quotes">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/manage_quote">
                            <i class="iconsminds-add-file"></i> Submit a Quote Request
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/quote_list">
                            <i class="simple-icon-list"></i> Quote Requests List
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="SalesData">

                    <li>
                        <a href="<?php echo base_url(); ?>admin/general_info/scheduled_calls">
                            <i class="simple-icon-list"></i> Scheduled Calls
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/general_info/contact_inq">
                            <i class="simple-icon-list"></i> Contact List
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/sales_leads">
                            <i class="simple-icon-list"></i> QR Leeds
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/booked_sales">
                            <i class="simple-icon-list"></i> Booked Sales
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/agent/company_ref">
                            <i class="simple-icon-list"></i> Ref. Companies
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/referrals">
                            <i class="simple-icon-list"></i> Referral List
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/discounts">
                            <i class="simple-icon-list"></i> Discounts
                        </a>
                    </li>


                </ul>

                <?php }?>
            </div>
        </div>
    </div>