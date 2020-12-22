

<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper">

    <!--HEADER START-->


    <!--HEADER END-->



    <!--INNER BANNER STAsRT-->

    <section id="inner-banner">

        <div class="container">

            <h1>Recover your Username</h1>

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

                    <?php $attributes = array('class' => '', 'id' => 'recover_password_form');
                    echo form_open('login/recover_username', $attributes); ?>

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

                        <div class="input-box"> <i class="fa fa-envelope"></i>

                            <input name="email" type="email" placeholder="Email" required>

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

