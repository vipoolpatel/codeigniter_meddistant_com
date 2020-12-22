<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Plan</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Plan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Plan List</li>
                    </ol>
                </nav>
                <div class="separator mb-4"></div>
                 <a href="<?= base_url(); ?>admin/med_provider_type/add_plan/<?php echo $provider_type_id ?>" class="btn btn-primary">Add New Plan</a> 
                <br>
                <br>
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
                    <th>Plan Name </th>
                    <th>Rate </th>
                    <th>Payable Amount</th>
                    <th>Plan ID </th>
                    <th>Action </th>
                   
                </tr>
            </thead>
            <tbody>
     
        <?php
            foreach ($getRecord as $data) {
            ?>
            <tr>
                
                <td><?php echo $data['plan_name'] ?></td>
                
                <td><?php echo $data['price'] ?></td>
                <td><?php echo $data['payable_amount'] ?></td>
                
                <td><?php echo $data['plan_id'] ?></td>
                <td style="text-align:center;">
                <div class="btn-group">
                   <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/med_provider_type/edit_plan/<?php echo $data['provider_type_id'] ?>/<?php echo $data['id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp;
                </div>
              <div class="btn-group">
                   <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/med_provider_type/delete_plan/<?php echo $data['provider_type_id'] ?>/<?php echo $data['id'] ?>" title="Edit"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
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
    });
</script>