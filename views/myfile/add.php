<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Add New File</h1>
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
                  <form class="mb-5" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                         
                         <div class="col-md-4">
                                
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label for="">File Type <span style="color:red">*</span></label>
                                       <select class="form-control" required name="file_type_id" style="margin-bottom: 10px;">
                                          <option value="">Select File Type</option>
                                          <?php
                                             foreach($getFileType as $filetype) {
                                             ?>
                                          <option value="<?=$filetype->id?>"><?=$filetype->name?></option>
                                          <?php }
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label for="">Attach related Pics/Files <span style="color:red">*</span></label>
                                       <input name="document" required class="form-control" style="height: 40px;padding: 7px;" type="file">
                                    </div>
                                 </div>
                                 <div class="form-group row mb-0 float-right">
                                    <div class="col-sm-10">
                                       <button type="submit" class="btn btn-primary mb-0">Submit</button>
                                    </div>
                                 </div>


                         </div>
                         <div class="col-md-4">
                            
                         </div>

                         <div class="col-md-4">
                            
                         </div>
                     </div>

                    

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
