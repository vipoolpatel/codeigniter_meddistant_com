<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>My Files</h1>
                    <?php
                    if($this->session->userdata('user_type') == 'customer') {
                    ?>
                        <a href="<?=base_url()?>myfiles/add" style="float: right;" class="btn btn-primary">Add New File</a>
                    <?php } ?>

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

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            
							
                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Request No</th>
										<th>Request Date</th>
										<th>Files</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($getMyFiles as  $file) {
                                        ?>
                                        <tr>
                                            <td><?=$file->request_no?></td>
                                            <td><?=date('Y-m-d h:i A',strtotime($file->created_on))?></td>
                                            <td>
                                                <div class="row">
                                                    <?php
                                                    if (!empty($file->quote_image)) {

                                                        $file_type_one = $this->common_model->getFileSingle($file->file_type_one);
                                                        if(!empty($file_type_one))
                                                        {
                                                        ?>

                                                        <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_one->name?></div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                         <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $file->quote_image; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 1</a> </div>
                                                          <br />
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>

                                                <div class="row">
                                                    <?php
                                                    if (!empty($file->quote_image_two)) {

                                                        $file_type_two = $this->common_model->getFileSingle($file->file_type_two);
                                                        if(!empty($file_type_two))
                                                        {
                                                        ?>
                                                            <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_two->name?></div> 
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                         <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $file->quote_image_two; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 2</a> 
                                                         </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>

                                                <div class="row">

                                                      <?php
                                                    if (!empty($file->quote_image_three)) {

                                                        $file_type_three = $this->common_model->getFileSingle($file->file_type_three);
                                                        if(!empty($file_type_three))
                                                        {
                                                        ?>
                                                         <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_three->name?></div> 
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                             <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $file->quote_image_three; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 3</a>
                                                         </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>

                                                <div class="row">
                                                    <?php
                                                    if (!empty($file->quote_image_four)) {

                                                        $file_type_four = $this->common_model->getFileSingle($file->file_type_four);
                                                        if(!empty($file_type_four))
                                                        {
                                                        ?>
                                                        <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_four->name?></div> 
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                         <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $file->quote_image_four; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 4</a> 
                                                        </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>

                                                <div class="row">
                                                    <?php
                                                    if (!empty($file->quote_image_five)) {

                                                        $file_type_five = $this->common_model->getFileSingle($file->file_type_five);
                                                        if(!empty($file_type_five))
                                                        {
                                                        ?>
                                                        <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_five->name?></div> 
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="col-md-6">
                                                            <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $file->quote_image_five; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File 5</a> 
                                                        </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>


                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    foreach ($getMyFileUser as $value) {
                                       ?>
                                       <tr>
                                            <td><?=$value->id?></td>  
                                            <td><?=date('Y-m-d h:i A',strtotime($value->created_at))?></td>
                                            <td>
                                                <div class="row">
                                                    <?php
                                                        $file_type_id = $this->common_model->getFileSingle($value->file_type_id);
                                                        if(!empty($file_type_id))
                                                        {
                                                        ?>

                                                        <div class="col-md-6" style="font-weight: 900;font-size: 17px;"><?=$file_type_id->name?></div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-6">
                                                         <a href="<?php echo base_url(); ?>uploads/document/<?php echo $value->document; ?>" style="font-weight: 900;font-size: 17px;text-decoration: underline;color:blue;margin-right: 10px;" target="_blank">File</a> </div>
                                                          <br />
                                                    
                                                </div>
                                            </td>

                                       </tr>

                                       <?php
                                    }
                                    ?>
								
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
	</main>
    <script type="text/javascript">
        $(document).ready(function() {
              $('#datatable-list').DataTable( {
                    "order": [[ 0, "desc" ]]
                });

        } );
    </script>