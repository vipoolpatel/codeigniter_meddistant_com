<!-- Navigation Bar-->
<header id="topnav">
	<div class="topbar-main">
		<div class="container-fluid " style="">
			
			<!-- Logo container-->
			<div class="logo wrapper-page" style="margin: 0; float: left; text-transform:unset; display: contents ">
				<!-- Text Logo -->
				<!--<a href="index.html" class="logo">-->
				<!--<span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
				<!--<span class="logo-large"><i class="mdi mdi-radar"></i> Adminto</span>-->
				<!--</a>-->
				<!-- Image Logo -->
				
				<a href="#" class="logo"><span>Medd<span>istant</span></span></a>
			
			
			</div>
			<!-- End Logo container-->
			
			
			<div class="menu-extras topbar-custom">
				
				<ul class="list-unstyled topbar-right-menu float-right mb-0">
					
					<li class="menu-item">
						<!-- Mobile menu toggle-->
						<a class="navbar-toggle nav-link">
							<div class="lines">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</a>
						<!-- End mobile menu toggle-->
					</li>
				
					
					<li class="dropdown notification-list">
						<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
						   aria-haspopup="false" aria-expanded="false">
<!--							<img src="--><?php //echo base_url(); ?><!--assets/admin_asset/images/users/avatar-1.jpg" alt="user" class="rounded-circle">-->
						<?php echo ucwords($this->session->userdata('username')); ?> <i class="fa fa-caret-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
							
							<!-- item-->
							<!--<a href="javascript:void(0);" class="dropdown-item notify-item">
								<i class="ti-user m-r-5"></i> Profile
							</a>-->
							
							
							<!-- item-->
							<a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item notify-item">
								<i class="ti-power-off m-r-5"></i> Logout
							</a>
						
						</div>
					</li>
				
				</ul>
			</div>
			<!-- end menu-extras -->
			
			<div class="clearfix"></div>
		
		</div> <!-- end container -->
	</div>
	<!-- end topbar-main -->
	
	<div class="navbar-custom">
		<div class="container-fluid">
			<div id="navigation">
				<!-- Navigation Menu-->
				<ul class="navigation-menu">
				<!--	<li class="has-submenu">
						<a href="#"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
					</li>-->
					
					<?php
					if($this->session->userdata('user_type') === 'admin') { ?>
					<li class="has-submenu">
						<a href="<?php echo base_url(); ?>admin/general_info/contact_inq"><i class="mdi mdi-message"></i> <span> Contact us Inquiry </span> </a>
					</li>
		
					
					<li class="has-submenu">
						<a href="<?php echo base_url(); ?>admin/general_info/scheduled_calls"><i class="mdi mdi-calendar"></i> <span> Scheduled Calls </span> </a>
					</li>
					
					<li class="has-submenu">
						<a href="<?php echo base_url(); ?>admin/general_info/newsletter"><i class="mdi mdi-email"></i> <span> Email Subscription  </span> </a>
					</li>
					
					
					<li class="has-submenu">
						<a href="<?php echo base_url(); ?>admin/agent"><i class="mdi mdi-settings"></i> <span> Manage Agents  </span> </a>
					</li>
						
						
						<li class="has-submenu">
							<a href="<?php echo base_url(); ?>admin/manage_quotes"><i class="mdi mdi-settings"></i> <span> Manage Quote Requests  </span> </a>
						</li>
					<?php } ?>
					
					
					
					
					
					<?php
					if($this->session->userdata('user_type') === 'agent') { ?>
					<li class="has-submenu">
						<a href="<?php echo base_url(); ?>admin/agent/quote_list"><i class="mdi mdi-settings"></i> <span> Manage Quotes  </span> </a>
					</li>
					<?php } ?>
					
				</ul>
				<!-- End navigation menu -->
			</div> <!-- end #navigation -->
		</div> <!-- end container -->
	</div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->
