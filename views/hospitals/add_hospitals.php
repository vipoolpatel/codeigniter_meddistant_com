<main>
   <style>
      .radio label, .checkbox label {
      cursor: pointer;
      }
      .required {
      color: red;
      }

   </style>
   <div class="container-fluid">
      <div class="row">
                <div class="col-12">

                    <h1>Add Hospital/Clinic</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                     <li class="breadcrumb-item">Manage Hospital</li>
                            <li class="breadcrumb-item active" aria-current="page">Add Hospital</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
         </div>

      <div class="col-12">
         <?php if ($this->session->flashdata('error_message')) {?>
         <div class="alert alert-danger alert-dismissible fade show rounded">
            <?php echo $this->session->flashdata('error_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <?php }?>
         <?php if ($this->session->flashdata('success_message')) {?>
         <div class="alert alert-success alert-dismissible fade show rounded">
            <?php echo $this->session->flashdata('success_message'); ?>
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
                  <!-- <h5 class="mb-4">Send Quote</h5> -->
                  <form action="" method="post" enctype="multipart/form-data" >

                  <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Upload pic <span  style="color: red;">*</span></label>
                          <div class="col-sm-10">
                           <input class="form-control" style="margin-bottom: 10px;" name="pic_area"  type="file"  required>

                          </div>
                      </div>

                   <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Hospital/Clinic  Name <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input class="form-control" name="hospital_name" type="text">
                          </div>
                      </div>

                      
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Hospital/Clinic City<span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input class="form-control" name="hospital_city" type="text">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">State/Province  <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input class="form-control" required name="hospital_state" type="text">
                          </div>
                      </div>




                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Hospital/Clinic <?=(strtoupper($getUser->country) == 'USA') ? '' : 'JCI'?> Accredited <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <input type="radio" name="hospital_jci"
                                 value="Yes" style="margin-top: 4px;">&nbsp;&nbsp;Yes
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="hospital_jci"
                                 value="No" style="margin-top: 4px;">&nbsp;&nbsp;No
                          </div>
                      </div>


                       <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Describe Hospital/Clinic in 100 or more words: <span style="color: red;">*</span></label>
                          <div class="col-sm-10">
                              <textarea class="form-control" required name="description" minlength="100"></textarea>
                          </div>
                      </div>




                     <br>
                     <div class="form-group row mb-0 float-right">
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-primary mb-0">Save</button>
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
