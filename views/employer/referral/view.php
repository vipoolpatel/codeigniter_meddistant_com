
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>View Referral</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/referrals"); ?>">Manage Referrals</a></li>
                           </li>
                        <li class="breadcrumb-item active" aria-current="page"> View Referral</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">

     <form action="" method="post" enctype="multipart/form-data" >

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">ID</label>
        <div class="col-sm-10">
            <?=$upcomming->id?>
        </div>
    </div>

	<div class="form-group row">
        <label class="col-sm-2 col-form-label">First Name </label>
        <div class="col-sm-10">
            <?=$upcomming->ref_first_name?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Last Name </label>
        <div class="col-sm-10">
             <?=$upcomming->ref_last_name?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
              <?=$upcomming->ref_email?>

        </div>
    </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone No</label>
            <div class="col-sm-10">
                 <?=$upcomming->ref_phone?>

            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created Date</label>
            <div class="col-sm-10">

               <?=date('d-m-Y h:i A', strtotime($upcomming->ref_created_date));?>
            </div>
        </div>

    <div class="form-group row mb-0 float-right">
        <div class="col-sm-10">
            <a href="<?=base_url();?>referrals" class="btn btn-primary mb-0">Back</a>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</main>
