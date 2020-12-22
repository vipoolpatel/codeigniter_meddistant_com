<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>County List</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">County</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">County List</li>
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

        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
						<table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>County </th>
                                        <th>Hospital</th>
                                        <th>Employer </th>
                                        <th>Quote</th>
                                        <th>Agent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($getRecord as $data) {
	?>
                                    <tr>
                                    <td><?php echo ucwords($data['country_name']) ?></td>
                                    
                                    <td><?=($data['is_hospital'] == '1') ? 'Active' : 'Inactive'?></td>
                                      <td><?=($data['is_employer'] == '1') ? 'Active' : 'Inactive'?></td>

                                    <td><?=($data['is_quote'] == '1') ? 'Active' : 'Inactive'?></td>
                                    <td><?=($data['is_agent'] == '1') ? 'Active' : 'Inactive'?></td>
                                    <td style="text-align:center;">
                                            <div class="btn-group">
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/country/edit/<?php echo $data['id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp;

                                                 <a data-url="<?php echo base_url(); ?>admin/country/delete/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;


                                            </div>
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