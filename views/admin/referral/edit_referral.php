<style type="text/css">
    .required{ color :red; }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Referral</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("admin/agent/referral_list"); ?>">Manage Referrals</a></li>
                           </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Referral</li>
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
<!-- Hidden Strat -->
    <input name="id" required type="hidden" value="<?=$edit_row->id?>" />

<!-- Hidden End -->
	<div class="form-group row">
        <label class="col-sm-2 col-form-label">First Name <span class="required">*</span></label>
        <div class="col-sm-10">
            <input class="form-control" name="ref_first_name"  type="text" value="<?=set_value('ref_first_name', $edit_row->ref_first_name);?>"  required>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Last Name <span class="required">*</span></label>
        <div class="col-sm-10">
            <input class="form-control" name="ref_last_name" value="<?=set_value('ref_last_name', $edit_row->ref_last_name);?>"  type="text"  required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email <span class="required">*</span></label>
        <div class="col-sm-10">
            <input class="form-control" readonly value="<?=set_value('ref_email', $edit_row->ref_email);?>" name="ref_email" type="email" >
        </div>
    </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone No</label>
            <div class="col-sm-10">
                <input class="form-control" name="ref_phone" type="text" value="<?=set_value('ref_phone', $edit_row->ref_phone);?>">
            </div>
        </div>

    <div class="form-group row mb-0 float-right">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary mb-0">Update</button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</main>
