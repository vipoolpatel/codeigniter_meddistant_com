<?php if ($this->session->flashdata('success_message')) {?>
<div class="success_msg response" style=" text-align: center; ">
   <i class="fa fa-check"></i>
   <span><?php echo $this->session->flashdata('success_message'); ?></span>
</div>
<?php }?>
<?php if ($this->session->flashdata('error_message')) {?>
<div class="error_msg response" style="text-align: center;">
   <i class="fa fa-times-circle"></i>
   <span><?php echo $this->session->flashdata('error_message'); ?></span>
</div>
<?php }?>

<style type="text/css">
   
.header-content {
  display: block;
  width: 100%;
  height: auto;
  position: relative;
}

.header-bg {
  background-image: url('<?php echo base_url(); ?>assets/img/homepage.png');
}

.header-bg, .header-overlay {
  position: absolute;
  top: 0;
  left: 0;
  content: "";
  width: 100%;
  height: 100%;
  background-color: #f5f5f5;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}

.header-overlay {
  background-position: center center;
  background-color: #384c79;
  opacity: 0.7;
  z-index: 0;
}

.header-main-content {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  width: 100%;
  height: auto;
  min-height: 415px;
  padding: 50px 0;
  position: relative;
}

.header-main-content p {
  color: #fff;
  font-size: 20px;
}

.header-main-content h1 {
  font-size: 25px;
  line-height: 50px;
  color: #fff;
  margin-bottom: 25px;
  margin-top: 145px;
}

.header-action-btn {
  margin-top: 30px;
}


@media (max-width:767px) {
  .header-main-content h1 {
      font-size: 21px;
      line-height: normal;
      margin-bottom: 0px;
      text-align: center;
       margin-top: 0px;
  }
  .hide-mobile {
      display: none;
  }

  .header-main-content {
      top: 125px;
  }

  .header-action-btn {
    text-align: center;
  }

  
}



</style>


<main class="page-content">

      <section class="header-content">
         <div class="header-bg"></div>
         <div class="header-overlay"></div>
         <div class="container">
               <div class="row">
                     <div class="col-md-7"></div>
                     <div class="col-md-5">
                           
               <div class="header-main-content content-padding">
                  <h1>The Efficient Healthcare Marketplace</h1>
                  <p class="hide-mobile">Human touch, tech-driven, giving</p>
                  <p style="margin-top: 0px;" class="hide-mobile">patients a happy and safe experience </p>
                  <div class="header-action-btn">
                     <a href="<?=base_url()?>signup?key=patients" style="background: #64366c;border: #64366c;" class="btn btn-primary btn-primary-redirect scroll">Find a medical provider & get quotes</a>
                  </div>
               </div>

                     </div>
               </div>
                
         </div>
      </section>




<!--    <section>
      <div data-loop="false" data-autoplay="false" data-simulate-touch="true" class="swiper-container swiper-slider swiper-variant-1 bg-gray-base">
         <div class="swiper-wrapper text-center">
            <div data-slide-bg="<?php echo base_url(); ?>assets/frontend-asset/updated/images/home-slider1.WebP" class="swiper-slide" style="background-position: left;">
               <div class="swiper-slide-caption">
                  <div class="shell">
                     <div class="range range-xs-center text-right">
                        <div class="cell-sm-11 cell-md-10">
                           <div data-caption-animate="fadeInUp" data-caption-delay="0s" class="text-white text-capitalize jumbotron-custom border-modern">Meddistant for Patients </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="450s" class="offset-sm-top-5 text-capitalize">
                              <p class="text-big-22  veil reveal-sm-inline-block" >Find a medical provider for your specific need.<br /></p>
                           </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="550s" class="offset-top-15"><a href="<?=base_url()?>quote-process" class="btn btn-primary btn-primary-redirect scroll">Find a medical provider & get quotes</a>
                        </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="650s" class="border-modern p-t-100">
                              <p class="text-big-22 veil reveal-sm-inline-block text-purple text-bold text-left">Any of your medical or cosmetic treatment needs <br/>at USA top hospitals or at certified international <br/> medical destinations.</p>
                     </div>
                  </div>
               </div>
            </div>
               </div>
            </div>
            <div data-slide-bg="<?php echo base_url(); ?>assets/frontend-asset/updated/images/home-slider-2222.WebP" class="swiper-slide" style="background-position: right;">
               <div class="swiper-slide-caption">
                  <div class="shell">
                     <div class="range range-xs-center">
                        <div class="cell-sm-11 cell-md-10 cell-lg-12">
                           <div data-caption-animate="fadeInUp" data-caption-delay="0s" class="text-white text-capitalize jumbotron-custom border-modern">Meddistant for Employers </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="450s" class="offset-sm-top-5">
                              <p class="text-big-19 text-white veil reveal-sm-inline-block text-capitalize" style="line-height: 1;">Less Abesenteeism Employees Treated Withing Days, Not Weeks, <br /> Higher Productivity, Higher Satisfactions and More Sacings. </p>
                           </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="550s" class="offset-top-15"><a onclick="window.location.href='<?php echo base_url(); ?>signup'" href="<?php echo base_url(); ?>signup" class="btn btn-primary scroll">Join Quality Savings</a></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div data-slide-bg="<?php echo base_url(); ?>assets/frontend-asset/updated/images/home-slider3.Webp" class="swiper-slide" style="background-position: left;">
               <div class="swiper-slide-caption">
                  <div class="shell">
                     <div class="range range-xs-center text-right">
                        <div class="cell-sm-11 cell-md-10 cell-lg-12">
                           <div data-caption-animate="fadeInUp" data-caption-delay="0s" class="text-white text-capitalize jumbotron-custom border-modern">Meddistant for Hospitals/Clinics </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="450s" class="offset-sm-top-5">
                              <p class="text-big-19 text-white veil reveal-sm-inline-block text-capitalize">To serve medical travelers in a transparent manner</p>
                           </div>
                           <div data-caption-animate="fadeInUp" data-caption-delay="550s" class="offset-top-15"><a onclick="window.location.href='<?php echo base_url(); ?>signup'" href="<?php echo base_url(); ?>signup" class="btn btn-primary scroll">Join Our Network</a></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="swiper-scrollbar veil-lg"></div>
         <div class="swiper-nav-wrap veil reveal-lg-block">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
         </div>
      </div>
   </section> -->












   <section class="section-10 section-sm-10 section-sm-bottom-100 bg-white bg-image bg-image-1" style="padding-bottom: 40px;">
      <div class="shell">
         <div class="range range-xs-center range-md-left offset-top-30">
            <div class="cell-sm-8 cell-md-6 cell-lg-6" style="padding: 4% 4%;padding-bottom: 0px;">
               <h5><?=$getlanding_page->title?></h5>
               <div class="offset-top-22 size-17">
                  <?=$getlanding_page->description?>
               </div>


               <img src="<?=base_url()?>assets/img/Mtravel3.jpg" />

               <p style="text-align: center;font-weight: bold;font-size: 24px;color: red;">Private Jet Service, Available now... <a style="color: blue" href="<?=base_url()?>signup?key=patients">Inquire</a></p>


            </div>
            <div class="cell-sm-4 cell-md-6 cell-lg-6">
               <div class="stitle bg-cape-cod context-dark text-white text-center py-5">                
                  <h4>Efficient marketplace for patients,employers and medical providers.</h4>
               </div>
               <div class="offset-top-22 size-17">
             
             <div>
                 <h4 style="display: inline-block">Patients: </h4>   
                <a class="btn btn-primary" style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px; float: right; margin-top: 0px;" href="<?=base_url()?>signup?key=patients">Signup & Quotes</a>
                
             </div>
                              
                  <ul class="list-marked">
                     <li>Get Offers from top quality USA medical providers or from International accredited facilities</li>
                     <li>Save on any medical or cosmetic procedure</li>
                     <li>Enjoy the full assistance of Meddistant staff to reach your destination and safely back.</li>
                  </ul>             
               </div>
               <div class="offset-top-22 size-17">
               <div>
                 <h4 style="display: inline-block">Hospitals/Clinics/Physicians: </h4> 
                <a class="btn btn-primary" style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px; float: right; margin-top: 0px;" href="<?=base_url()?>signup?key=hospital">Signup & Gain</a>
                
             </div>
               
                  <ul class="list-marked">
                      <li>Save on Meddistant offered products and services</li>
                      <li>Join a the vast network of medical providers maximizing patients satisfaction</li>
                      <li>Enjoy the bility to transfer patients to other medical providers effeciently</li>
                      <li>Attract patients from around the US and the World.</li>                
                      <li>High privacy/security/HIPAA complaint architecture</li>

                  </ul>             
               </div>
               <div class="offset-top-22 size-17">
                     
               <div>
                 <h4 style="display: inline-block">Employers/Insurers/Brokers: </h4>  
                <a class="btn btn-primary" style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px; float: right; margin-top: 0px;" href="<?=base_url()?>signup?key=employers">Signup & Save</a>
                
             </div>
                                 
                  <ul class="list-marked">
                     <li>Efficient technology driven process with a human touch</li>
                        <li>Quality health benefits for the modern employer</li>
                        <li>Accredited Hospitals and clinics from around the world</li>
                        <li>Patients unmatched quality of medical service and facilitation.</li>
                  </ul>
               </div>
               <!-- <div class="bg-cape-cod context-dark text-white pad-3">
                  <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true"> Efficient technology driven process with a human touch.</i>
                      <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true">  Quality health benefits for the modern employer.</i>
                      <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true"> Accredited Hospitals and clinics from around the world.</i>
                     <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true">  Patients unmatched quality of medical services and facilitation.</i>
                  </div> -->              

                <!-- <video width="100%" controls >
                     <source src="<?php echo base_url(); ?>assets/frontend-asset/updated/220919-Meddistant.mp4" type="video/mp4" autostart="false">
                     Your browser does not support the video tag.
                  </video> -->
            </div>
         </div>
      </div>
   </section>
   <!-- <section class="bg-cape-cod context-dark text-white text-center py-5">
      <div class="container">
         <div class="stitle">
            <p>Approximate treatment cost, not including airfare travel or lodging costs.</p>
            <h4>Want a binding price quote for a specific medical procedure and destination? Request a quote below.</h4>
         </div>
      </div>
   </section> -->
   <!-- <section class="schedule_table">
      <div class="container">
         <div class="table-responsive">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th scope="col">Procedure</th>
                     <th scope="col">USA</th>
                     <th scope="col">Turkey</th>
                     <th scope="col">Mexico</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Tummy Tuck</td>
                     <td>$8000</td>
                     <td>$3200</td>
                     <td>$4500</td>
                  </tr>
                  <tr>
                     <td>Liposuction</td>
                     <td>$6000</td>
                     <td>$2800</td>
                     <td>$4000</td>
                  </tr>
                  <tr>
                     <td>Hair Transplant</td>
                     <td>$11000</td>
                     <td>$2300</td>
                     <td>$3700</td>
                  </tr>
                  <tr>
                     <td>Eye lid(upper&amp;lower)</td>
                     <td>$9000</td>
                     <td>$2500</td>
                     <td>$4100</td>
                  </tr>
                  <tr>
                     <td>Gasrtic Bypass</td>
                     <td>$26000</td>
                     <td>$7000</td>
                     <td>$11000</td>
                  </tr>
                  <tr>
                     <td>Dental Implant</td>
                     <td>$2500</td>
                     <td>$700</td>
                     <td>$1100</td>
                  </tr>
                  <tr>
                     <td>Knee Replacement</td>
                     <td>$35000</td>
                     <td>$9000</td>
                     <td>$12500</td>
                  </tr>
                  <tr>
                     <td>Spinal Fusion</td>
                     <td>$110000</td>
                     <td>$15500</td>
                     <td>$18000</td>
                  </tr>
                  <tr>
                     <td>Hip Replacement</td>
                     <td>$40000</td>
                     <td>$13500</td>
                     <td>$15000</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </section> -->
  <!--  <section class="bg-cape-cod context-dark" id="get-offer">
      <div class="shell">
         <div class="range range-xs-center range-md-left">
            <div class="cell-xs-10 cell-md-6 text-left section-60 section-sm-90">
               <h3 style="text-transform: capitalize;"> Meddistant </h3>
               <div class="offset-top-40 carousel-testimonials-home">
                  -- <h6>Discover a new you</h6> --
                     <img src="<?php echo base_url(); ?>assets/frontend-asset/images/images.jpg" class="img-fluid" alt="meddistant image">
               </div>
            </div>
            <div class="cell-xs-10 cell-md-6 section-60 section-sm-90">
               <h3 style="color: white; font-size: 22px; margin-top: 20px;text-transform: unset;">Free marketplace for patients, employers and hospitals</h3>
                 <div style="clear: both;"></div><br>
               <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true"> Efficient technology driven process with a human touch.</i>

                <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true">  Quality health benefits for the modern employer.</i>

                <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true"> Accredited Hospitals and clinics from around the world.</i>
              <i class="fa fa-arrow-right" style="color: white; font-size: 18px;" aria-hidden="true">  Patients unmatched quality of medical services and facilitation.</i>
               <div style="clear: both;"></div>

               <div style="clear: both;"></div>

               <a style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px;" href="<?=base_url()?>signup" class="btn btn-primary">Join Today</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <a style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px;" href="<?=base_url()?>quote-process" class="btn btn-primary">Free Quotes</a>

         <p style="text-align: left; color: white; font-size: 18px;">Join Us Today or Just Get Free Competing Quotes</p>

            </div>
         </div>
      </div>
   </section> -->


   <section style="text-align: center;padding-top: 10px;padding-bottom: 10px;color: #000;font-size: 24px;">
     We work with top world hospitals that can perform many treatments and surgeries, click here for full list <a class="btn btn-primary" style="text-transform: capitalize;font-size: 18px;font-weight: normal;border-radius: 50px;" href="<?=base_url()?>treatment">Treatments List</a>
   </section>


   <section class="boxes1">
      <div class="range range-condensed range-xs-center range-sm-left">
         <div class="cell-xs-10 cell-sm-4 height-fill">
             <article class="icon-box">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-6"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/knee-surgery" class="text-capitalize">Knee Surgery</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base">A person may have knee surgery to treat pain in the joint due to an injury, such as torn cartilage or a torn ligament.</p>
               </div>
               <a href="<?php echo base_url(); ?>treatment/knee-surgery" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>
         </div>
         <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
            <article class="icon-box icon-box-top-line">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-2"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/eyelid" class="text-capitalize">Eye Surgery</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base" >An eyelid is the skin that covers the eye, but also the one of the most age defining.Fatty deposits under those lids expose or even exaggerate our age.</p>
               </div>
               <a href="<?php echo base_url(); ?>treatment/eyelid" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>
         </div>
         <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
            <article class="icon-box icon-box-top-line">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-3"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/dental-implant" class="text-capitalize">Dental Implant</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base">A dental implant is a surgical component that interfaces with the bone of the jaw or skull to support a dental prosthesis.</p>
               </div>
               <a href="#" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>
         </div>
         <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
            <article class="icon-box">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-4"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/ivf" class="text-capitalize">IVF</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base">In Vitro Fertilization is a medical procedure, where eggs produced by ovaries are collected using special tools and fertilized externally </p>
               </div>
               <a href="<?php echo base_url(); ?>treatment/ivf" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>
         </div>
         <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
            <article class="icon-box">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-5"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/tummy" class="text-capitalize">Tummy Tucks</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base">Many patients resort to tummy tuck surgery to tighten the skin, reduce excess fat and tighten abdominal muscles.
                  </p>
               </div>
               <a href="<?php echo base_url(); ?>treatment/tummy" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>
         </div>

         <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
         <article class="icon-box icon-box-top-line">
               <div class="box-top">
                  <div class="box-icon"><span class="icon icon-primary icon-lg icon-1"></span></div>
                  <div class="box-header">
                     <h5><a href="<?php echo base_url(); ?>treatment/hair-transplant" class="text-capitalize">Hair Transplant</a></h5>
                  </div>
               </div>
               <div class="box-body">
                  <p class="text-gray-base">It's a type of surgery that moves hair you already have to fill an area with thin or no hair.</p>
               </div>
               <a href="<?php echo base_url(); ?>treatment/hair-transplant" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
            </article>

         </div>
      </div>
   </section>




   <section class="boxes container pt-3">
      <div class="range range-condensed range-xs-center range-sm-left">
         <div data-items="1" data-sm-items="1" data-stage-padding="15" data-loop="true" data-margin="15" data-mouse-drag="true" data-nav="true" data-dots="false" class="owl-carousel owl-carousel-center owl-nav-modern owl-style-minimal owl-style-minimal-inverse text-center">
            <div class="owl-item text-center">
               <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                      <article class="icon-box">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-6"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/knee-surgery" class="text-capitalize">Knee Surgery</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base">A person may have knee surgery to treat pain in the joint due to an injury, such as torn cartilage or a torn ligament.</p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/knee-surgery" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>
               </div>
            </div>
            <div class="owl-item text-center">
               <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                        <article class="icon-box icon-box-top-line">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-2"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/eyelid" class="text-capitalize">Eye Surgery</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base" >An eyelid is the skin that covers the eye, but also the one of the most age defining.Fatty deposits under those lids expose or even exaggerate our age.</p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/eyelid" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>
                     </div>
            </div>
            <div class="owl-item text-center">
               <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                        <article class="icon-box icon-box-top-line">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-3"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/dental-implant" class="text-capitalize">Dental Implant</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base">A dental implant is a surgical component that interfaces with the bone of the jaw or skull to support a dental prosthesis.</p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/dental-implant" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>
                     </div>
            </div>
            <div class="owl-item text-center">
                <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                        <article class="icon-box">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-4"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/ivf" class="text-capitalize">IVF</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base">In Vitro Fertilization is a medical procedure, where eggs produced by ovaries are collected using special tools and fertilized externally</p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/ivf" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>
                     </div>
            </div>
            <div class="owl-item text-center">
                <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                        <article class="icon-box">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-5"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/tummy" class="text-capitalize">Tummy Tucks</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base">Many patients resort to tummy tuck surgery to tighten the skin, reduce excess fat and tighten abdominal muscles.
                              </p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/tummy" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>
                     </div>
            </div>
            <div class="owl-item text-center">
                <div class="cell-xs-10 cell-sm-4 height-fill offset-top-40 offset-sm-top-0">
                <article class="icon-box icon-box-top-line">
                           <div class="box-top">
                              <div class="box-icon"><span class="icon icon-primary icon-lg icon-1"></span></div>
                              <div class="box-header">
                                 <h5><a href="<?php echo base_url(); ?>treatment/hair-transplant" class="text-capitalize">Hair Transplant</a></h5>
                              </div>
                           </div>
                           <div class="box-body">
                              <p class="text-gray-base">It's a type of surgery that moves hair you already have to fill an area with thin or no hair.</p>
                           </div>
                           <a href="<?php echo base_url(); ?>treatment/hair-transplant" class="btn btn-icon-only btn-icon-single btn-icon-default"><span class="icon icon-sm material-icons-arrow_forward"></span></a>
                        </article>

                     </div>
            </div>
         </div>
      </div>
   </section>
   <section class="section-60" style="padding-bottom: 0px;">
      <div class="shell text-center">
         <div class="range">
            <div class="cell-xs-12">
               <h3><span class="text-thin">Only</span>Top Accredited Hospitals Worldwide <span class="text-thin">Are Considered For You</span></h3>
               <div class="row">
                  <div class="col-md-6">
                     <img src="<?php echo base_url(); ?>assets/frontend-asset/images/ClevelandClinic.png" class="img-fluid" alt="">                    
                  </div>
                  <div class="col-md-6">
                     <img src="<?php echo base_url(); ?>assets/frontend-asset/images/KolanHospital-03.WebP" class="img-fluid" alt="">
                  </div>
                </div>
            </div>
         </div>
      </div>
   </section>
   <section class="">
      <div class="shell text-center">
         <div class="range range-xs-center">
            <div class="cell-sm-10 cell-md-10 cell-lg-12">
               <div class="panel panel-lg bg-primary bg-white-outline-btn text-center">
                  <h3 class="text-white"><span class="text-thin">Stay Informed On </span>Quality Savings <span class="text-thin">&</span>Treatments</h3>
                  <form action="<?php echo base_url() . "welcome/email_subscription"; ?>" method="post" class="group group-bottom offset-top-15 offset-sm-top-35">
                     <div class="group-item form-group" style="min-width: 40%;">
                        <input id="index-request-email" type="email" name="email" data-constraints="@Required" required="" class="form-control">
                        <label for="index-request-email" class="form-label">Enter Email</label>
                     </div>
                     <br>
                     <div class="group-item form-group" style="min-width: 40%;">
                          <?php
$firstNumber = mt_rand(0, 9);
$SecondNumber = mt_rand(0, 9);
?>
<?=$firstNumber?> + <?=$SecondNumber?>
                     </div>
                     <br>
                     <div class="group-item form-group" style="min-width: 20%;">
                        <input id="index-request-code" type="text" name="captcha" data-constraints="@Required" required class="form-control">
                        <label for="index-request-email" class="form-label">Verification Code</label>

                        <input type="hidden"  name="current_captcha"  value="<?=$firstNumber + $SecondNumber?>">
                     </div>
                     <br>

                     <div class="group-item group-item-sm">
                        <button type="submit" class="btn btn-block btn-white-outline">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="section-50 section-sm-90 section-sm-bottom-60">
      <div class="shell text-center">
         <h3>Medical <span class="text-thin">Destinations</span></h3>
         <div class="range range-xs-center offset-top-40">
            <div data-items="1" data-sm-items="2" data-md-items="3" data-stage-padding="15" data-loop="true" data-margin="15" data-mouse-drag="true" data-nav="true" data-dots="false" class="owl-carousel owl-carousel-center owl-nav-modern owl-style-minimal owl-style-minimal-inverse text-center">
               <div class="owl-item text-center">
                  <div class="cell-xs-8 cell-sm-7 cell-md-4 offset-md-top-0">
                     <div class="post-boxed reveal-lg-inline-block">
                        <div class="post-boxed-img-wrap"><a href="javascript:;"><img src="<?php echo base_url() . "/assets/frontend-asset/images/uploads/sites/11/2018/03/LibertyUSAfinal.png"; ?>" alt="" width="322" height="219"/></a></div>
                        <div class="post-boxed-caption">
                              <div class="post-boxed-title text-bold"><a href="javascript:;">USA</a></div>
                           <div class="offset-top-5">
                              <p>
                                "The Land of free" is a top medical treatment destination not for cost reason but for the high quality medical care and technology.You get to enjoy the superior care in most ethnically diverce country on earth.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="owl-item text-center">
                  <div class="cell-xs-8 cell-sm-7 cell-md-4">
                     <div class="post-boxed reveal-lg-inline-block">
                        <div class="post-boxed-img-wrap"><a href="<?php echo base_url() . "destinations/turkey"; ?>"><img src="https://meddistant.com/assets/frontend-asset/images/uploads/sites/11/2018/03/turkey.WebP" alt="" width="322" height="219"/></a></div>
                        <div class="post-boxed-caption">
                           <div class="post-boxed-title text-bold"><a href="<?php echo base_url() . "destinations/turkey"; ?>">Turkey</a></div>
                           <div class="offset-top-5">
                              <p>
                                 This country surpasses any country in our consideration list as best medical destination. In recent years, Turkey has emerged as a top medical tourism destination.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="owl-item text-center">
                  <div class="cell-xs-8 cell-sm-7 cell-md-4 offset-md-top-0">
                     <div class="post-boxed reveal-lg-inline-block">
                        <div class="post-boxed-img-wrap"><a href="<?php echo base_url() . "destinations/mexico"; ?>"><img src="https://meddistant.com/assets/frontend-asset/images/uploads/sites/11/2018/03/Mexico1.WebP" alt="" width="322" height="219"/></a></div>
                        <div class="post-boxed-caption">
                           <div class="post-boxed-title text-bold"><a href="<?php echo base_url() . "destinations/mexico"; ?>">Mexico (Coming Soon)</a></div>
                           <div class="offset-top-5">
                              <p>
                                 Healthcare tourism is flourishing for many years as Americans travel to Mexico to get quality and affordable care.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="section-60 section-sm-90 bg-primary">
      <div class="shell text-center text-md-left">
         <div class="range range-md-middle range-md-center">
            <div class="cell-md-8 cell-lg-7">
               <h4 class="text-white">Meddistant Your Caring Medical Services Facilitators</h4>
               <p class="text-white size-17">We help you find treatment options that bring you the best value, including travel and destination arrangements.</p>
            </div>
            <div class="cell-md-4 cell-lg-3 offset-top-30 offset-md-top-0"><a href="<?php echo base_url() . "contact"; ?>" class="btn btn-lg btn-white-outline">Contact Now</a></div>
         </div>
      </div>
   </section>
</main>
<script>
   $jq132(document).ready(function() {
       $('.btn-primary-redirect').click(function(){
            var url = $(this).attr('href');
            window.location.href = url;
       });
   });
</script>