<style type="text/css">
    .required{ color :red; }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Add Referral</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("admin/agent/referral_list"); ?>">Manage Referrals</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Referral</li>
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
                                <label class="col-sm-12">
                                    <b>
                                    <p style="color:red;font-size: 20px;">Note:</p>
                                    <p style="font-size: 16px;">Meddistant will not solicit to or contact referrals without their consent. Meddistant will also maintain their data privacy to high levels in accordance with HIPAA health information act and GPDR regulations.</p>
                                    <p style="font-size: 16px;">Only name, email and phone number (if supplied) will be stored by Meddistant.</p>
                                     </b>
                                </label>
                            </div>

                            


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Company/Affiliate <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_id" required> 
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_company as $key => $value) {
                                            ?>
                                            <option value="<?=$value->user_id?>"><?=$value->username?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">First Name <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="<?=set_value('ref_first_name');?>" name="ref_first_name"  type="text"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Last Name <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="<?=set_value('ref_last_name');?>" name="ref_last_name"  type="text"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="ref_email" type="email" required value="<?=set_value('ref_email');?>">
                                    <div style="color: red;"><?php echo form_error('ref_email'); ?></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone No</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="ref_phone"
                                           type="text"  value="<?=set_value('ref_phone');?>">
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Send</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
