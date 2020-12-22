<section class="section-30 section-sm-60 bg-light">
<!-- Google Tag Manager (noscript) -->
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTG4KM9" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) --><br style="display:none;" data-autoplay="0" id="btBody">
	<div class="shell">
	<div class="range range-sm-center">
		<div class="cell-sm-7 cell-md-5 cell-lg-4">
		<div class="block-shadow text-center">
			<div class="block-inner">

				
				<img src="<?=base_url()?>assets/img/Medassist.99.jpg" style="border-radius: 10px;margin-bottom: 20px;">

				<img src="<?=base_url()?>assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg" alt="logo" width="170" height="34">


			<p class="text-uppercase text-abbey text-bold">Login to your account</p>


			<!-- <div class="offset-top-40 offset-sm-top-60"><span class="icon icon-xl icon-gray-base fa-unlock-alt"></span></div> -->



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
			<form class="form-modern form-darker offset-top-40" action="<?php echo base_url() . "login/userlogin"; ?>" method="post">
				<div class="block-inner">
					<div class="form-group">
					<input id="login-form-email" type="text" name="email" data-constraints="@email @Required" class="form-control">
					<label for="login-form-email" class="form-label">Email</label>
					</div>
					<div class="form-group offset-top-22">
					<input id="login-form-password" type="password" name="password" data-constraints="@Required" class="form-control">
					<label for="login-form-password" class="form-label">Password</label>
					</div>
					<div class="offset-top-15"><a href="<?php echo base_url() . "login/recover-password"; ?>" class="link-default">Forgot your password?</a></div>
				</div>
				<div class="offset-top-30 offset-sm-top-40">
					<button type="submit" class="btn btn-primary btn-block">Sign in</button>
					<!--<a href="#" class="btn btn-social-google" style="margin-top:0px;width:100%;background: #ffffff;border: 1px solid #c6c6c6;color: #4f5457;"> <img src="<?php echo base_url(); ?>assets/Svg/google.svg" height="20px" width="20px" class="pull-left">Login With Gmail</a>-->
					<!--<a href="<?php echo $authURL; ?>" class="btn btn-social-fb" style="margin-top: 0px;width: 100%;background: #3b5998;border: #3b5998;color: white;"> <img src="<?php echo base_url(); ?>assets/Svg/facebook.svg" height="20px" width="20px" class="pull-left "> Login With Facebook</a>-->
					<!--<a href="#" class="btn btn-social-instagram" style="margin-top:0px;width:100%;background: #E4405F;border: 1px solid #E4405F;color: white;"> <img src="<?php echo base_url(); ?>assets/Svg/instagram.svg" height="20px" width="20px" class="pull-left">Login With Instagram</a>-->
					<!--<a href="#" class="btn btn-social-twitter" style="margin-top:0px;width:100%;background: #55ACEE;border: 1px solid #55ACEE;color: white;"> <img src="<?php echo base_url(); ?>assets/Svg/twitter.svg" height="20px" width="20px" class="pull-left">Login With Twitter</a>-->
				</div>
			</form>
		</div>
		<div class="group-inline offset-top-15 text-center"><span class="text-dark">Don't have an account yet?</span><a href="<?php echo base_url(); ?>signup" class="link link-primary-inverse">Sign up here.</a></div>
		</div>
	</div>
	</div>
</section>