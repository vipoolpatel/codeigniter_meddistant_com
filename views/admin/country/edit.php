<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Country</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/country"); ?>">Country</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Country</li>
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
                        <form action="<?php echo base_url() . 'admin/country/edit/' . $user_data['id'] ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Country Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="country_name" value="<?=$user_data['country_name']?>" type="text">
                                </div>
                            </div>

                            


   <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hospital</label>
                                <div class="col-sm-10">

                                    <select class="form-control" name="is_hospital">
                                      
                                            <option <?=($user_data['is_hospital'] == '1') ? 'selected' : ''?> value="1">Active</option>
                                            <option <?=($user_data['is_hospital'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Employer</label>
                                <div class="col-sm-10">

                                    <select class="form-control" name="is_employer">
                                       
                                            <option <?=($user_data['is_employer'] == '1') ? 'selected' : ''?> value="1">Active</option>
                                            <option <?=($user_data['is_employer'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>


   

                           

                                 <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Quote</label>
                                <div class="col-sm-10">

                                    <select class="form-control" name="is_quote">
                                       
                                            <option <?=($user_data['is_quote'] == '1') ? 'selected' : ''?> value="1">Active</option>
                                            <option <?=($user_data['is_quote'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Agent</label>
                                <div class="col-sm-10">

                                    <select class="form-control" name="is_agent">
                                       
                                            <option <?=($user_data['is_agent'] == '1') ? 'selected' : ''?> value="1">Active</option>
                                            <option <?=($user_data['is_agent'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>






                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Update Country</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
