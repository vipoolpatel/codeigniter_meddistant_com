<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Meddistant - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin_asset/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/bootstrap-float-label.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/main.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/dore.light.purple.css" />
</head>

<body class="background">
<div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <div style="text-align: center;margin-bottom: 40px;">
                                <a href="http://localhost/meddistant.com/">
                                    <img src="<?=base_url()?>assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg" alt="logo" width="170" height="34">
                                </a>    
                            </div>
                            
                             


                            <p class="white mb-0 h6" style="text-align: center;">
                                As an ADMIN user, you agree to hold customers data and privacy to highest standards and never share their data except with Meddistant and medical providers.
                            </p>
                            


						</div>
                        <div class="form-side">
                            <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded">
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success alert-dismissible fade show rounded">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                          
                            <h6 class="mb-4">Login</h6>
                            <?php $attributes = array('class' => '', 'id' => '');
							echo form_open('admin/login/userLogin', $attributes); ?>
                                <label class="form-group has-float-label mb-4">
									<input name="email" class="form-control" type="email" required="" placeholder="Email">
                                    <span>E-mail</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
									<input name="password" class="form-control" type="password" required="" placeholder="Password">
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?php echo base_url()."login/recover_password";?>">Forget password?</a>
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</main>
	<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/dore.script.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/scripts.js"></script>
	
</body>

</html>
