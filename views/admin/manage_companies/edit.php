<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Company</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/manage_companies"); ?>">Manage Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


            </div>
        </div>

        <div class="col-12">
            <?php if ($this->session->flashdata('error')) {?>
                <div class="alert alert-danger alert-dismissible fade show rounded">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>
            <?php if ($this->session->flashdata('success')) {?>
                <div class="alert alert-success alert-dismissible fade show rounded">
                    <?php echo $this->session->flashdata('success'); ?>
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
                        <form action="<?php echo base_url() . 'admin/manage_companies/edit/' . $user_data['user_id'] ?>" method="post" enctype="multipart/form-data" >

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="company_name" value="<?=$user_data['username']?>" type="text"  required>
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
                                    <input class="form-control" name="phone_no"
                                           type="text" value="<?=$user_data['phone_no']?>" required>
                                </div>
                            </div>


                             <div class="form-group row">
                                <label for="inputPhoneNo" class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="country" required>

                                            <option value="">Select Country</option>
                                            <?php
foreach ($get_country as $value) {
	$selected = '';
	if ($value->country_name == $user_data['country']) {
		$selected = 'selected';
	}
	?>
                                                <option <?=$selected?> value="<?=$value->country_name?>"><?=$value->country_name?></option>
                                                <?php
}
?>
                                    </select>
                                </div>
                            </div>


                              <div class="form-group row">
                                <label for="inputPhoneNo" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="company_type_id" required>

                                            <option value="">Select Type</option>
                                            <?php
foreach ($get_company_type as $value) {
	$selected = '';
	if ($value->id == $user_data['company_type_id']) {
		$selected = 'selected';
	}
	?>
                                                <option <?=$selected?> value="<?=$value->id?>"><?=$value->company_type?></option>
                                                <?php
}
?>
                                    </select>
                                </div>
                            </div>


                            <hr />

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="password" type="text" >
                                     (Leave blank if you are not changing the password)
                                </div>
                            </div>


                            <hr >

                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Paid Setup </label>
                                    <div class="col-sm-10">
                                        <input  name="paid_setup"  class="form-control"  type="text" value="<?=$value->paid_setup?>" >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Subscription Type </label>
                                    <div class="col-sm-10">

                                        <?php
                                        $subscription_type = $value->subscription_type;
                                        ?>
                                        <select class="form-control" name="subscription_type">
                                            <option value="">Select</option>
                                            <option <?=($subscription_type == 'Month') ? 'selected' : '' ?> value="Month">Month</option>
                                            <option <?=($subscription_type == 'Annual') ? 'selected' : '' ?> value="Annual">Annual</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">Subscription Price </label>
                                    <div class="col-sm-10">
                                        <input  name="subscription_price"  class="form-control"  type="text" value="<?=$value->subscription_price?>" >
                                    </div>
                                </div>

                            <hr >







                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary mb-0">Update Profile</button>
                                    <a href="javascript:;" id="<?=$user_data['user_id']?>" class="btn btn-primary ResetPasswordViaEmail">Reset Password Via Email</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        
     $('.ResetPasswordViaEmail').click(function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>admin/agent/reset_password_via_email",
            data: {
               id: id
            },
            dataType: 'JSON',
            success: function(data) {
                alert("Email successfully sent");
            }
         });
      });

</script>
