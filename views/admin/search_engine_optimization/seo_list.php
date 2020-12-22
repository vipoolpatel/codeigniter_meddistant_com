   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Search Engine Optimization</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Search Engine Optimization</li>
                        </ol>

                    </nav>

                    <div class="separator mb-4">

                    </div>
<!--  <a href="<?=base_url()?>admin/search_engine_optimization/add_seo" class="btn btn-primary">Add New SEO</a><br>
 <br> -->

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
                            <!-- <h5 class="card-title">Schedule Calls</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                           
										<th>ID</th>
										<th>URL</th>
										<th>Meta Title </th>
										<th>Meta Description</th>
                                        <th>Meta Keyword </th>
                                        <th>Created Date</th>
										<th>Action</th>
                         
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($seo_data as $data) {
	?>
									<tr>
<td><?php echo ucwords($data['id']) ?></td>
<td><?php echo ucwords($data['slug']) ?></td>


<td><?php echo ucwords($data['meta_title']) ?></td>
<td><?php echo ucfirst($data['meta_description']) ?></td>

<td><?php echo ucfirst($data['meta_keyword']) ?></td>

<td><?php echo date('d M, Y', strtotime($data['created_date'])); ?></td>


										<td>
<a style="margin-top:3px;" href="<?=base_url()?>admin/search_engine_optimization/edit_seo/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-pencil d-block"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <!--   <a data-url = "<?php echo base_url(); ?>admin/search_engine_optimization/delete_dlt_seo/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp; -->
                                             </td>
      
									</tr>
									<?php }?>
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
