<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Treatment</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/treatment"); ?>">Manage Treatment</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Treatment</li>
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
        <label class="col-sm-2 col-form-label">Treatment Name </label>
        <div class="col-sm-10">
            <input class="form-control" name="treatment_name"  type="text" value="<?=set_value('treatment_name', $edit_row->treatment_name);?>"  required>
        </div>
    </div>
	
	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Order By</label>
        <div class="col-sm-10">
            <input class="form-control" name="order_by_data"  type="text" value="<?=set_value('order_by_data', $edit_row->order_by_data);?>"  required>
        </div>
    </div>


                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Update Treatment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
