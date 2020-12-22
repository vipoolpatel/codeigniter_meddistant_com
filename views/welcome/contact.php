<main class="page-content">
<!-- Google Tag Manager (noscript) -->
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTG4KM9" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) --><br style="display:none;" data-autoplay="0" id="btBody">
    <section style="background-image: url(<?php echo base_url(); ?>assets/frontend-asset/updated/images/commen-banner.jpg);" class="section-30 section-sm-40 section-md-66 section-lg-bottom-90 bg-gray-dark page-title-wrap">

      <div class="shell">

        <div class="page-title">

          <h2>Contact Us</h2>

        </div>

      </div>

    </section>

    <section class="section-60 section-sm-top-90 section-sm-bottom-100 contact-us-section">

      <div class="shell">

        <div class="range range-xs-center range-md-left">

          <div class="cell-md-7 cell-lg-6">

        <?php if ($this->session->flashdata('error_message')) {?>
      <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span style="color: #fff;"><?php echo $this->session->flashdata('error_message'); ?></span>
      </div>
    <?php }?>
    <?php if ($this->session->flashdata('success_message')) {?>
      <div class="alert alert-success">
        <button class="close" data-close="alert"></button>
        <span><?php echo $this->session->flashdata('success_message'); ?></span>
      </div>
    <?php }?>


            <h3>Get in <span class="text-thin">Touch</span></h3>
			<?php $attributes = array('class' => 'form-modern offset-top-15', 'method' => 'post', 'data-form-type' => 'contact', 'data-form-output' => 'form-output-global');
echo form_open('contact/', $attributes);?>

              <div class="range">

                <div class="cell-sm-6">

                  <div class="form-group">

                    <input id="contact-fname" required type="text" value="<?=set_value('full_name');?>" name="full_name" data-constraints="@Required" class="form-control">

                    <label for="contact-fname" class="form-label">First Name</label>

                  </div>

                </div>

                <div class="cell-sm-6 offset-top-30 offset-sm-top-0">

                  <div class="form-group">

                    <input id="contact-lname" required type="text" value="<?=set_value('lname');?>" name="lname" data-constraints="@Required" class="form-control">

                    <label for="contact-lname" class="form-label">Last Name</label>

                  </div>

                </div>

                <div class="cell-sm-6 offset-top-30">

                  <div class="form-group">

                    <input id="contact-email" required type="email" name="email" data-constraints="@Email @Required" class="form-control" value="<?=set_value('email');?>">
                    <label for="contact-email" class="form-label">Email</label>
                    <div class="error_message" style="color: red;"><?php echo form_error('email'); ?></div>

                  </div>

                </div>

                <div class="cell-sm-6 offset-top-30">

                  <div class="form-group">

                    <input id="contact-subject" required value="<?=set_value('subject');?>" type="text" name="subject" data-constraints="@Required" class="form-control">

                    <label for="contact-subject" class="form-label">Subject</label>

                  </div>

                </div>
                 <div class="cell-xs-12 offset-top-30">
                  <div class="form-group">
                    <input id="contact-phone" required value="<?=set_value('phone');?>" type="text" name="phone" data-constraints="@Required" class="form-control">
                    <label for="contact-phone" class="form-label">Phone</label>
                  </div>
                </div>

                <div class="cell-xs-12 offset-top-30">

                  <div class="form-group">

                    <div class="textarea-lined-wrap">

                      <textarea id="contact-message"  required name="message" data-constraints="@Required" class="form-control"><?=set_value('message');?></textarea>

                      <label for="contact-message" class="form-label">Message</label>

                    </div>

                  </div>

                </div>


                 <div class="cell-xs-12 offset-top-30">

                  <div class="form-group">
            <?php
$firstNumber = mt_rand(0, 9);
$SecondNumber = mt_rand(0, 9);
?>
           <div><?=$firstNumber?> + <?=$SecondNumber?> = ?</div>
<input type="hidden"  name="current_captcha"  value="<?=$firstNumber + $SecondNumber?>">
 <input id="contact-subject" required type="text" name="captcha" placeholder="Above Sum" class="form-control">





                  </div>

                </div>

                <div class="cell-xs-8 offset-top-30 offset-xs-top-30 offset-sm-top-60">

                  <button type="submit" class="btn btn-primary btn-block">Send</button>

                </div>

                <div class="cell-xs-4 offset-top-22 offset-xs-top-30 offset-sm-top-60">

                  <button type="reset" class="btn btn-silver-outline btn-block">Reset</button>

                </div>

              </div>

			  <?php echo form_close(); ?>

          </div>

          <div class="cell-lg-1 veil reveal-lg-inline-block"></div>

          <div class="cell-md-5 cell-lg-4 offset-top-50 offset-md-top-0">

            <div class="range">

              <div class="cell-sm-10 cell-md-12">

                <h3>How to <span class="text-thin">Reach Us</span></h3>

                <p class="offset-sm-top-30 text-secondary"> If you have any questions, just fill in the contact form, and we will answer you shortly. If you are living nearby, come visit us. </p>

              </div>

              <div class="cell-sm-6 cell-md-12 offset-top-35">

                <h6>Northbrook, IL USA</h6>

                <address class="contact-info">

                <p class="text-uppercase"></p>

                <dl class="list-terms-inline">

                  <dt>Telephone</dt>

                  <dd><a href="tel:+18889699959" class="link-secondary">1-888-969-9959 (USA & Canada) </a></dd>

                </dl>

                <dl class="list-terms-inline">

                  <dt>Fax</dt>

                  <dd><a href="tel:+13128899105" class="link-secondary">1-312-889-9105 (Worldwide) </a></dd>

                </dl>

                <dl class="list-terms-inline">

                  <dt>Telephone</dt>

                  <dd><a href="tel:+905469473789" class="link-secondary">+90-54-194-3789 (Turkey)</a></dd>

                </dl>

                <a href="<?php echo base_url() . "schedule-call"; ?>" class="btn btn-rect btn-primary reveal-block reveal-sm-inline-block">Schedule a call</a>

                <!--<dl class="list-terms-inline">-->

                <!--  <dt>E-mail</dt>-->

                <!--  <dd><a href="mailto:care@meddistant.com" class="link-primary"><span class="__cf_email__">care@meddistant.com</span></a></dd>-->

                <!--</dl>-->

                </address>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    <!--<div class="google-map">-->

    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.6852651480735!2d-87.63198688491887!3d41.87811757339282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2d75288947df%3A0xe0f704b2b4be9e80!2sChicago%20IL.%20USA!5e0!3m2!1sen!2sin!4v1568056482561!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->

    <!--</div>-->

  </main>