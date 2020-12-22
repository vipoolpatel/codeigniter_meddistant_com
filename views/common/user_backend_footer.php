<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/chartjs-plugin-datalabels.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/progressbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery.barrating.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/select2.full.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/nouislider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/Sortable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/mousetrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/dore.script.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/scripts.single.theme.js"></script>
<script>
function deleteRow(e){
   var url = $(e).attr('data-url');
   $("#deleteButton").attr('href', url);
}
</script>
<script language="javascript">

// Add the following into your HEAD section
var timer = 0;
function set_interval() {
  // the interval 'timer' is set as soon as the page loads
  timer = setInterval("auto_logout()", 1800000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
  // So set it to 300000
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer

  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    // second step: implement the timer again
    timer = setInterval("auto_logout()", 1800000);
    // completed the reset of the timer
  }
}

function auto_logout() {
  // this function will redirect the user to the logout script
  window.location = "<?=base_url()?>logout";
}
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d5be1dc77aa790be32fd2a7/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/frontend-asset/updated/wpt-whatsapp/assets/js/public.js?ver=2.2.5"></script>
<div class="wptwa-container circled-handler wptwa-mobile-center" data-delay-time="0" data-inactive-time="0" data-scroll-length="0">
   <div class="wptwa-box wptwa-js-ready">
      <div class="wptwa-description">
         <p>Hi there! Click one of our representatives below and we will get back to you as soon as possible.</p>
      </div>
      <span class="wptwa-close"></span>
      <div class="wptwa-people" style="max-height: 453px;">
         <a href="https://wa.me/18472223848" data-number="18472223848" class="wptwa-account wptwa-clearfix wptwa-no-image" data-auto-text="" data-ga-label="Meddistant" target="_blank">
            <div class="wptwa-face no-image"><img src="" onerror="this.style.display='none'" style="display: none;"></div>
            <div class="wptwa-info">
               <span class="wptwa-title"></span>
               <span class="wptwa-name">Meddistant</span>
            </div>
         </a>
      </div>
   </div>
   <div class="wptwa-toggle">
      <svg class="WhatsApp" width="20px" height="20px" viewBox="0 0 90 90">
         <use xlink:href="#wptwa-logo">
             <svg id="wptwa-logo">
                <path id="WhatsApp" d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522   c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982   c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537   c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938   c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537   c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333   c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882   c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977   c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344   c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223   C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z"></path>
              </svg>
         </use>
      </svg>
      <span class="wptwa-text"></span>
   </div>
   <div class="wptwa-mobile-close"><span>Close and go back to page</span></div>
</div> -->

</body>
</html>