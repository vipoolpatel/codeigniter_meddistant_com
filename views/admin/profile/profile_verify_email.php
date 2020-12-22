  <!--<script src="https://bootstrapcreative.com/wp-bc/wp-content/themes/wp-bootstrap/codepen/bootstrapcreative.js?v=7"></script>-->
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>

<body>
<!-- partial:index.partial.html -->
<div class="jumbotron text-center">
    <?php if(!empty($user_code)) { ?>
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong><?php echo $user_data ?></p>
  <hr>
    <?php } else{ ?>
     <h1 class="display-3"><?php echo $user_data ?></h1>
 
    <?php } ?>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="https://meddistant.com" role="button">Continue to homepage</a>
  </p>
</div>
<!-- partial -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>
</body>
