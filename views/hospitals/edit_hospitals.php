<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Hospital/Clinic</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/manage_facility/hospitals"); ?>">Hospital</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Hospital</li>
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
    <input name="id" required type="hidden" value="<?=$hospital_data->id?>" />

<!-- Hidden End -->
<div class="form-group row">
                          <label class="col-sm-2 col-form-label">Upload pic <span  style="color: red;">*</span></label>
                          <div class="col-sm-10">
                           <input class="form-control" style="margin-bottom: 10px;" name="pic_area"  type="file">
                           <img  width="70" height="70"  src="<?=base_url()?>uploads/hospital/<?=$hospital_data->pic_area?>">
                             <input type="hidden" value="<?=$hospital_data->pic_area?>" name="old_imagename">
                          </div>
                      </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Hospital/Clinic Name </label>
        <div class="col-sm-10">
            <input class="form-control" name="hospital_name"  type="text" value="<?=set_value('hospital_name', $hospital_data->hospital_name);?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Hospital/Clinic City </label>
        <div class="col-sm-10">
            <input class="form-control" name="hospital_city"  type="text" value="<?=set_value('hospital_city', $hospital_data->hospital_city);?>">
        </div>
    </div>


    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">State/Province <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input class="form-control" value="<?=$hospital_data->hospital_state?>" required name="hospital_state" type="text">
                          </div>
                      </div>

     <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Hospital/Clinic <?=(strtoupper($getUser->country) == 'USA') ? '' : 'JCI'?> Accredited <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input type="radio" name="hospital_jci"
                                 value="Yes"<?=($hospital_data->hospital_jci == 'Yes') ? 'checked' : ''?> style="margin-top: 4px;">&nbsp;&nbsp;Yes
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="hospital_jci"
                                 value="No"<?=($hospital_data->hospital_jci == 'No') ? 'checked' : ''?> style="margin-top: 4px;">&nbsp;&nbsp;No
                          </div>
                      </div>



                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Describe Hospital/Clinic in 100 or more words: <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <textarea class="form-control" required name="description" minlength="100"><?=$hospital_data->description?></textarea>
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
