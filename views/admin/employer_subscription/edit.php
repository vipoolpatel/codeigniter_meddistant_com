<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Employer Subscription</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/employer_subscription"); ?>">Employer Subscription</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Employer Subscription</li>
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
                        <form action="<?php echo base_url() . 'admin/employer_subscription/edit/' . $user_data['id'] ?>" method="post" enctype="multipart/form-data" >
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="name" value="<?=$user_data['name']?>" type="text">
                                </div>
                            </div>

                           

                       

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Setup Fee </label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="setup_fee" value="<?=$user_data['setup_fee']?>" type="text">
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
