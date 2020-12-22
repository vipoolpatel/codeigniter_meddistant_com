
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meddistant - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin_asset/images/favicon.ico">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/datatables.responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/vendor/bootstrap-datepicker3.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/main.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_asset/updated/css/dore.light.purple.css" />
    <link rel='stylesheet' id="wptwa-public-css"  href="<?php echo base_url(); ?>assets/frontend-asset/updated/wpt-whatsapp/assets/css/public.css?ver=2.2.5" type='text/css' media='all' />
    <link rel='stylesheet' id='wptwa-generated-css'  href="<?php echo base_url(); ?>assets/frontend-asset/updated/wpt-whatsapp/assets/css/auto-generated-wptwa.css?ver=1566462501" type='text/css' media='all' />
    <style>
        table > thead{
        background: #922C88 !important;
        color: white !important;
        }
        .wptwa-toggle .WhatsApp{
            padding-left:3px!important;
        }
        .wptwa-toggle {
            padding: 28px 17px!important;
            margin-right: 105px!important;
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
</head>
<body id="app-container" onload="set_interval()" class="menu-default show-spinner">
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Are you sure want to delete?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="#" id="deleteButton" class="btn btn-danger">Delete</a>
          </div>
      </div>
  </div>
</div>