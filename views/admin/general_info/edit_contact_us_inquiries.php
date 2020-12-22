<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Contact us Inquiries</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/general_info/contact_inq"); ?>">Contact us Inquiries</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Contact us Inquiries</li>
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
                        <form action="" method="post" enctype="multipart/form-data" >

                        <!-- Hidden Strat -->
    <input name="id" required type="hidden" value="<?=$edit_row->id?>" />

<!-- Hidden End -->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">First Name </label>
        <div class="col-sm-10">
            <input class="form-control" name="first_name"  type="text" value="<?=set_value('first_name', $edit_row->first_name);?>">
        </div>
    </div>

	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input class="form-control" name="last_name"  type="text" value="<?=set_value('last_name', $edit_row->last_name);?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input class="form-control" name="email" readonly type="email" value="<?=set_value('email', $edit_row->email);?>">
        </div>
    </div>
     <div class="form-group row">
        <label class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
            <input class="form-control" name="phone"  type="text" value="<?=set_value('phone', $edit_row->phone);?>">
        </div>
    </div>

     <div class="form-group row">
        <label class="col-sm-2 col-form-label">Subject</label>
        <div class="col-sm-10">
            <input class="form-control" name="subject"  type="text" value="<?=set_value('subject', $edit_row->subject);?>">
        </div>
    </div>
     <div class="form-group row">
        <label for="phoneNo" class="col-sm-2 col-form-label">Note </label>
        <div class="col-sm-10">
        <textarea class="form-control" min="1" name="message" type="text"><?=set_value('message', $edit_row->message);?></textarea>
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
