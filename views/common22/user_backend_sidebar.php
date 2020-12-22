<!-- Side Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->

    <?php

    $user_data = $this->common_model->get_table_data('user', '*', array('user_id' => $this->session->userdata('user_id')), '', $row = 1);

    if (!empty($user_data['profile_pic'])) {
        $profile_pic = base_url() . 'upload_dir/profile_pics/' . $user_data['profile_pic'];
    } else {
        $profile_pic = base_url() . 'assets/user_backend_asset/img/avatar.jpg';
    }

    ?>
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="<?php echo $profile_pic; ?>" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4">
                <?php
                if (strlen($this->session->userdata('username')) > 10) {
                    echo substr($this->session->userdata('username'), 0, 10) . '...';
                } else {
                    echo $this->session->userdata('username');
                }

                ?> </h1>


        </div>
    </div>

    <!-- Sidebar Navidation Menus-->

    <span class="heading">Main Navigation</span>
    <ul class="list-unstyled">
        <li <?php if ($this->uri->segment(1) == 'dashboard') { ?>class="active"<?php } ?>><a
                    href="<?php echo base_url(); ?>dashboard"> <i class="fa fa-user"></i> Your Account </a></li>
        <li <?php if ($this->uri->segment(1) == 'job_criteria' && empty($this->uri->segment(2))) { ?>class="active"<?php } ?>>
            <a href="<?php echo base_url(); ?>job_criteria"> <i class="fa fa-hourglass-start"></i>Your Job Criteria </a>
        </li>
        <li <?php if ($this->uri->segment(2) == 'job_criteria_result') { ?>class="active"<?php } ?>><a
                    href="<?php echo base_url(); ?>job_criteria/job_criteria_result"> <i
                        class="fa fa-hourglass-start"></i>Search Criteria Results </a></li>
        <li <?php if ($this->uri->segment(2) == 'manage_documents') { ?>class="active"<?php } ?>><a
                    href="<?php echo base_url(); ?>account/manage_documents"> <i class="fa fa-file-archive-o"></i>
                Resume / Cover Letter </a></li>

        <li <?php if ($this->uri->segment(2) == 'invoices') { ?>class="active"<?php } ?>><a
                    href="<?php echo base_url(); ?>account/invoices"> <i class="fa fa-money"></i> Invoices </a></li>

        <li <?php if ($this->uri->segment(1) == 'checkout') { ?>class="active"<?php } ?>><a
                    href="<?php echo base_url(); ?>checkout"> <i class="fa fa-money"></i> Checkout </a></li>
        <li><a href="<?php echo base_url(); ?>logout"> <i class="fa fa-sign-out"></i>Log Out </a></li>
    </ul>


    <!-- <ul class="list-unstyled">
        <li class="active"><a href="<?php /*echo base_url();*/ ?>dashboard"> <i class="fa fa-user"></i> Dashboard  </a></li>
        <li><a href="<?php /*echo base_url();*/ ?>account/manage_resume"> <i class="fa fa-file-archive-o"></i>Manage Resume </a></li>
        <li><a href="categories.html"> <i class="fa fa-clipboard"></i>Categories </a></li>
        <li><a href="processes.html"> <i class="fa fa-hourglass-start"></i>Processes </a></li>
        <li><a href="<?php /*echo base_url();*/ ?>checkout"> <i class="fa fa-money"></i>Payments </a></li>
        <li><a href="promotions.html"> <i class="fa fa-gift"></i>Promotions </a></li>
        <li><a href="settings.html"> <i class="fa fa-cogs"></i>Settings </a></li>
        <li><a href="Logout.html"> <i class="fa fa-sign-out"></i>Log Out </a></li>

    </ul>-->
</nav>