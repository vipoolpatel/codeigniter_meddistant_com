<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
   <head>
      <title><?=!empty($getHeader->meta_title) ? $getHeader->meta_title : 'Meddistant - Beauty, Wellness and Health'?></title>
      <meta name="format-detection" content="telephone=no">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="google-site-verification" content="-8Z1tKg2FDmn5fnNdyxewU6_ZxC_vjpAdvzXNPtU2Ho" />
      <meta charset="utf-8">
      <?php
if (!empty($getHeader->meta_description)) {
   ?>
      <meta name="description" content="<?=$getHeader->meta_description?>"/>
      <?php }
?>
      <?php
if (!empty($getHeader->meta_keyword)) {
   ?>
      <meta name="keywords" content="<?=$getHeader->meta_keyword?>"/>
      <?php }
?>
      <meta name="author" content="https://meddistant.com"/>
      <link rel="icon" href="<?php echo base_url(); ?>assets/frontend-asset/updated/images/favicon.jpg" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend-asset/updated/css/css.css?family=Roboto:100,300,400,500,700%7CPlayfair+Display:400,700,700i,900,900i">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend-asset/updated/css/style.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend-asset/updated/css/custom.css">

      <!--<link rel='stylesheet' id="wptwa-public-css"  href="<?php echo base_url(); ?>assets/frontend-asset/updated/wpt-whatsapp/assets/css/public.css?ver=2.2.5" type='text/css' media='all' />-->
      <!--<link rel='stylesheet' id='wptwa-generated-css'  href="<?php echo base_url(); ?>assets/frontend-asset/updated/wpt-whatsapp/assets/css/auto-generated-wptwa.css?ver=1566462501" type='text/css' media='all' />-->
      <style>
         .select2-container--bootstrap .select2-selection--single .select2-selection__rendered { color: black; padding: 0; }
         .wptwa-toggle .WhatsApp{ padding-left:3px!important; }
         .wptwa-toggle { padding: 28px 17px!important; margin-right: 85px!important;
         }
         @media only screen and (min-width: 768px) {
         .wptwa-toggle { margin-right: 90px!important; }
         }
         .post-body{ color:black; }
         @media screen and (max-width: 414px){
         .wptwa-mobile-center .wptwa-toggle { left: 70%; right: auto; transform: translateX(-50%); }
         }
      </style>
      <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
      <script> var $jq132 = jQuery.noConflict( true ); </script>
      <script type="text/javascript">
         $jq132(document).ready(function() {
             $jq132(document).on('click','.wptwa-toggle',function(){
              $jq132(document).find('.wptwa-container').toggleClass('wptwa-show');
           });
         });
         $jq132(document).ready(function() {
             $jq132(document).on('click','.wptwa-close',function(){
              $jq132(document).find('.wptwa-container').removeClass('wptwa-show');
           });
         });
      </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153011510-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153011510-1');
</script>

   </head>
   <body style="" >
      <div class="page">
      <header class="page-head">
         <div class="rd-navbar-wrap">
            <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="53px" data-lg-stick-up-offset="53px" data-md-stick-up="true" data-lg-stick-up="true" class="rd-navbar rd-navbar-corporate-dark">
               <div class="rd-navbar-inner">
                  <div class="rd-navbar-aside">
                     <div data-custom-toggle=".rd-navbar-aside" data-custom-toggle-disable-on-blur="true" class="rd-navbar-aside-toggle"><span></span></div>
                     <div class="rd-navbar-aside-content context-dark">
                        <ul class="rd-navbar-aside-group list-units">
                           <li>
                              <div class="unit unit-horizontal unit-spacing-xs">
                                 <div class="unit-left"><span class="icon icon-xxs-small icon-primary material-icons-place icon-shift-1 offset-top-2"></span></div>
                                 <div class="unit-body"><a href="#" class="link-white-v2 reveal-inline">Northbrook, IL USA</a></div>
                              </div>
                           </li>
                           <li>
                              <div class="unit unit-horizontal unit-spacing-xs">
                                 <div class="unit-left"><span class="icon icon-xxs icon-primary fa-clock-o offset-top-2"></span></div>
                                 <div class="unit-body">
                                    <p class="text-white">Mon – Sat: 9:00am–07:00pm. Sunday CLOSED</p>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="unit unit-horizontal unit-spacing-xs">
                                 <div class="unit-left"><span class="icon icon-xxs icon-primary material-icons-phone icon-shift-2"></span></div>
                                 <div class="unit-body"><a href="callto:+18889699959" class="link-white-v2">+1(888)969-9959 (USA & Canada) </a></div>
                              </div>
                           </li>
                           <li>
                              <div class="unit unit-horizontal unit-spacing-xs">
                                 <div class="unit-left"><span class="icon icon-xxs icon-primary fa-fax icon-shift-2"></span></div>
                                 <div class="unit-body"><a href="callto:+13128899105" class="link-white-v2">+1(312)889-9105 (Worldwide & Fax)</a></div>
                              </div>
                           </li>
                        </ul>
                        <div class="rd-navbar-aside-group">
                           <ul class="list-inline list-inline-reset">
                              <li><a href="<?php echo base_url(); ?>login" class="btn btn-sm btn-dark sm-btn">Login</a></li>
                              <li><a href="<?php echo base_url(); ?>signup" class="btn btn-sm btn-dark sm-btn">SignUp</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="rd-navbar-group rd-navbar-search-wrap">
                     <div class="rd-navbar-panel">
                        <button data-custom-toggle=".rd-navbar-nav-wrap" data-custom-toggle-disable-on-blur="true" class="rd-navbar-toggle"><span></span></button>
                        <a href="<?php echo base_url(); ?>" class="rd-navbar-brand brand"><img src="https://meddistant.com/assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg" alt="logo" width="170" height="34"/></a>
                     </div>
                     <div class="rd-navbar-nav-wrap">
                        <div class="rd-navbar-nav-inner">
                           <ul class="rd-navbar-nav">
                              <li class="active"><a href="<?php echo base_url(); ?>">Home</a> </li>
                              <li>
                                 <a href="<?php echo base_url(); ?>about">About Us</a>
                                 <ul class="rd-navbar-dropdown">
                                    <li><a href="<?php echo base_url(); ?>about/why-meddistant">Why Meddistant</a> </li>
                                    <li><a href="<?php echo base_url(); ?>about/our-mission">Our Mission</a> </li>
                                    <li><a href="<?php echo base_url(); ?>about/med-treatment">Medical Treatment Effeciently</a> </li>
                                 </ul>
                              </li>
                              <li>
                                 <a href="<?php echo base_url(); ?>treatment/">Treatments</a>
                                 <ul class="rd-navbar-dropdown">
                                    <li><a href="<?php echo base_url(); ?>treatment/hair-transplant">Hair Transplant</a> </li>
                                    <li><a href="<?php echo base_url(); ?>treatment/facelift">Facelift </a> </li>
                                    <li><a href="<?php echo base_url(); ?>treatment/eyelid">Eye Surgery </a> </li>
                                    <li><a href="<?php echo base_url(); ?>treatment/dental-implant">Dental Implant </a> </li>
                                    <li><a href="<?php echo base_url(); ?>treatment/tummy">Tummy tucks </a> </li>
                                    <li><a href="<?php echo base_url(); ?>treatment/knee-surgery">Knee Surgery </a> </li>

                                    <li><a href="<?php echo base_url(); ?>treatment/ivf">IVF </a> </li>



                                 </ul>
                              </li>
                              <li>
                                 <a href="javascrip:;">Hospitals/Doctors</a>
                                 <ul class="rd-navbar-dropdown">
                                    <li><a href="<?php echo base_url(); ?>top-hospitals">Hospitals/Clinics or Spas</a> </li>
                                    <li><a href="<?php echo base_url(); ?>top-doctors">Physicians/Practioners </a> </li>
                                 </ul>
                              </li>
                              <li>
                                 <a href="<?php echo base_url(); ?>how-it-works">How It Works</a>
                              </li>
                              <li><a href="https://meddisafe.com/" target="_blank"><i>My Care Supplies </i></a> </li>
                              <li><a href="<?php echo base_url(); ?>contact">Contact Us</a> </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </nav>
         </div>
      </header>