<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend-asset/password/password.min.css" rel="stylesheet" type="text/css">

<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Manage Profile</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/profile"); ?>">Manage Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


            </div>
        </div>

        <div class="col-12">

            <?php if ($this->session->flashdata('success_message')) {?>
                <div class="alert alert-success alert-dismissible fade show rounded">
                    <?php echo $this->session->flashdata('success_message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" >

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="username" value="<?=$user_data['username']?>" type="text"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="<?=$user_data['email']?>" name="email"   type="email" readonly required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone No</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="phone_no" type="text" value="<?=$user_data['phone_no']?>" required>
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="password" name="password" type="text" >
                                    (Leave blank if you are not changing the password)
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script type="text/javascript">
    

    $('#password').password({

        shortPass: 'The password is too short',
        badPass: 'Weak Password; try combining letters & numbers',
        goodPass: 'Medium; try using special characters',
        strongPass: 'Strong password',
        containsUsername: 'The password contains the username',
        enterPass: 'Type your password',
        showPercent: false,
        showText: true, // shows the text tips
        animate: true, // whether or not to animate the progress bar on input blur/focus
        animateSpeed: 'fast', // the above animation speed
        username: false, // select the username field (selector or jQuery instance) for better password checks
        usernamePartialMatch: true, // whether to check for username partials
        minimumLength: 6 // minimum password length (below this threshold, the score is 0)

   });
   


</script>