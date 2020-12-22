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
</body>
</html>
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
  window.location = "<?=base_url()?>admin/logout";
}
</script>
<script>
    function deleteRow(e){
        var url = $(e).attr('data-url');
        $("#deleteButton").attr('href', url);
    }
    $(document).ready(function(){

        $('.select_list').select2();
        $("select[name = 'agent_type']").change(function(){
            if($(this).val() == 'i'){
                $('.Agent-Company').hide();
                $('.hide-company').show();

            }else{
                $('.Agent-Company').css('display', 'contents');
                $('.hide-company').hide();
            }
        });
        $("#company_country").change(function(){
            if($(this).val() == 'Usa'){
                $('.usa-hide').css('display', 'block');
            }else{
                $('.usa-hide').hide();
            }
        });
        <?php if (isset($user_data)) {?>
            <?php if ($user_data['country'] != '') {?>
                $("#country").val('<?php echo $user_data['country']; ?>');
            <?php }?>
            <?php if ($user_data['company_country'] != '') {?>
                $("#company_country").val('<?php echo $user_data['company_country']; ?>');
            <?php }?>
        <?php }?>
    } );

</script>


</script>
