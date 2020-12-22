<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right m-t-15">
					<a href="<?php echo base_url(); ?>admin/agent/manage_agent" type="button" class="btn btn-info" aria-expanded="false">Add Agent</a>
				</div>
				<h4 class="page-title">Agents List</h4>
	
			</div>
		</div>
		<!-- end page title end breadcrumb -->
		
		<?php if ($this->session->flashdata('error')) { ?>
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('error'); ?></span>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('success')) { ?>
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('success'); ?></span>
			</div>
		<?php } ?>
		<div class="row">
			<div class="col-12">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Delete</th>
						</tr>
						</thead>
						
						
						<tbody>
						<?php
						foreach($agent_data as $data) {
						?>
						<tr>
							<td><?php echo ucwords($data['username']) ?></td>
							<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
							<td><?php echo ucwords($data['phone_no']) ?></td>
							
							<td><a href="<?php echo base_url(); ?>admin/agent/manage_agent/del/<?php echo $data['user_id'] ?>" title="Delete"><i class="dripicons-trash"></i></a> </td>
					
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- end row -->
	
	</div> <!-- end container -->
	
	
		   <!-- Right Sidebar -->
		   <!-- /Right-bar -->

</div>
<!-- end wrapper -->






</body>

</html>
