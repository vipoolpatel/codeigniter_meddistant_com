

<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper">

    <!--HEADER START-->


    <!--HEADER END-->



    <!--INNER BANNER STAsRT-->

    <section id="inner-banner">

        <div class="container">

            <h3>Recover your Password</h3>

        </div>

    </section>

    <!--INNER BANNER END-->



    <!--MAIN START-->

    <div id="main">

        <!--SIGNUP SECTION START-->

        <section class="signup-section">

            <div class="container">
	<div class="shell">
	<div class="range range-sm-center">
		<div class="cell-sm-7 cell-md-5 cell-lg-4">
		<div class="block-shadow text-center">
               
				<div class="block-inner">
                    <div class="thumb"><img style="width: 150px;height: 139px;padding: 21px;" src="<?php echo base_url(); ?>assets/frontend-asset/images/forgot.jpg" alt="img"></div>

                    <?php $attributes = array('class' => '', 'id' => 'recover_password_form');
                    echo form_open(base_url(). 'login/recover_password', $attributes); ?>

                    <?php if($this->session->flashdata('error_message')){ ?>
                        <div class="alert alert-danger ">
                            <button class="close" data-close="alert"></button>
                            <span class="text-white"><?php echo $this->session->flashdata('error_message'); ?></span>
                        </div>
                    <?php }?>
                    <?php if($this->session->flashdata('success_message')){ ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo $this->session->flashdata('success_message'); ?></span>
                        </div>
                    <?php }?>

                        <div class="form-group"> <i class="fa fa-envelope"></i>

                            <input name="email" type="email" class="form-control" placeholder="Email" required>

                        </div>



                        <input type="submit" class="btn btn-success" value="Submit">
				</div>


                    <?php echo form_close(); ?>

                </div>

            </div> </div>

            </div> </div>

        

        </section>

        <!--SIGNUP SECTION END-->



    </div>

    <!--MAIN END-->





</div>

<!--WRAPPER END-->



</body>

