<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Search Engine Optimization</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/search_engine_optimization"); ?>">Search Engine Optimization</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Search Engine Optimization</li>
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
        <label class="col-sm-2 col-form-label">URL <span style="color: red;"> *</span> </label>
        <div class="col-sm-10">
            <input class="form-control" name="slug" readonly required type="text" value="<?=set_value('slug', $edit_row->slug);?>">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Meta Title <span style="color: red;"> *</span></label>
        <div class="col-sm-10">
            <input class="form-control" name="meta_title" required  type="text" value="<?=set_value('meta_title', $edit_row->meta_title);?>">
        </div>
    </div>
     <div class="form-group row">
        <label for="phoneNo" class="col-sm-2 col-form-label">Meta Description</label>
        <div class="col-sm-10">
        <textarea class="form-control" min="1" name="meta_description" type="text"><?=set_value('meta_description', $edit_row->meta_description);?></textarea>
        </div>
    </div>
     <div class="form-group row">
        <label for="phoneNo" class="col-sm-2 col-form-label">Meta Keyword <span style="color: red;"> *</span></label>
        <div class="col-sm-10">
        <textarea class="form-control" required min="1" name="meta_keyword" type="text"><?=set_value('meta_keyword', $edit_row->meta_keyword);?></textarea>
        </div>
    </div>


        <div class="form-group row mb-0 float-right">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary mb-0">Update SEO</button>
            </div>
        </div>
    </form>
</div>
    </div>
</div>
</div>
</div>
</main>
