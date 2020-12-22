

<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper">

    <!--HEADER START-->


    <!--HEADER END-->



    <!--INNER BANNER STAsRT-->

    <section id="inner-banner">

        <div class="container">

            <h1>Create New Password</h1>

        </div>

    </section>

    <!--INNER BANNER END-->



    <!--MAIN START-->

    <div id="main">

        <!--SIGNUP SECTION START-->

        <section class="signup-section">

            <div class="container">

                <div class="holder">

                    <div class="thumb"><img src="<?php echo base_url(); ?>frontend_assets/images/signup.png" alt="img"></div>

                    <?php $attributes = array('class' => '', 'id' => 'update_password_form');
                    echo form_open('signup/update_password', $attributes); ?>

                    <?php if($this->session->flashdata('error_message')){ ?>
                        <div class="alert alert-danger ">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo $this->session->flashdata('error_message'); ?></span>
                        </div>
                    <?php }?>
                    <?php if($this->session->flashdata('success_message')){ ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo $this->session->flashdata('success_message'); ?></span>
                        </div>
                    <?php }?>


                    <input type="hidden" name="email"  class="form-control control" placeholder="New emaillll" value='<?php echo $email; ?>'>

                    <div class="input-box"> <i class="fa fa-unlock"></i>

                        <input name="password" type="password" placeholder="Password" required minlength="6">

                    </div>

                    <div class="input-box"> <i class="fa fa-unlock"></i>

                        <input name="confirm_password" type="password" placeholder="Confirm Password" required minlength="6">

                    </div>



                        <input type="submit" value="Submit">



                    <?php echo form_close(); ?>

                </div>

            </div>

        </section>

        <!--SIGNUP SECTION END-->



    </div>

    <!--MAIN END-->





</div>

<!--WRAPPER END-->



</body>

