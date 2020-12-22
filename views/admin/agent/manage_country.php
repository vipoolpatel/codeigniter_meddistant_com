<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Country List </h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?=base_url()?>admin/agent">Manage Country</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Country List</li>
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

<!-- Add Form Start -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="<?php echo base_url() . 'admin/agent/add_assign_country'; ?>" method="post" enctype="multipart/form-data" >
                             <input name="user_id" type="hidden" value="<?=$user_id?>" />
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Country Name </label>
                                <div class="col-sm-10">

                                    <select class="form-control" name="country_id" required="">
                                        <option value="">Select Country Name</option>
                                            <?php
                                            foreach ($get_country as $row) {
                                            ?>
                                            <option value="<?=$row->id?>"><?=$row->country_name?></option>
                                             <?php }?>
                                        
                                    </select>

                                </div>
                            </div>
                          
                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Form End -->

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">List Agent</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
										<th>Country Name</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                            foreach ($getRecord as $value) {
                                ?>
									<tr>
                                        <td><?=$value->country_name?></td>
									    <td><?=date('d-m-Y', strtotime($value->created_at));?></td>
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                  <a data-url="<?=base_url()?>admin/agent/delete_assign_country/<?=$value->user_id?>/<?=$value->id?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> 

                                                </a> 
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
            $('#datatable-list').DataTable();
        } );
</script>