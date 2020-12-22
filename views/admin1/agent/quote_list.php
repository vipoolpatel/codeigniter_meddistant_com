<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right m-t-15">
					<a href="<?php echo base_url(); ?>admin/agent/manage_quote" type="button" class="btn btn-info" aria-expanded="false">New Quote</a>
				</div>
				<h4 class="page-title">Quotes List</h4>
	
			</div>
		</div>
		<!-- end page title end breadcrumb -->
		
		<?php if ($this->session->flashdata('error_message')) { ?>
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('error_message'); ?></span>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('success_message')) { ?>
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('success_message'); ?></span>
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
						foreach($quote_data as $data) {
						?>
						<tr>
							<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' '. ucwords($data['last_name'])  : ucwords($data['full_name']) ?></td>
							<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
							<td><?php echo ucwords($data['phone_no']) ?></td>
							
							<td><a href="<?php echo base_url(); ?>admin/agent/manage_quote/del/<?php echo $data['id'] ?>" title="Delete"><i class="dripicons-trash"></i></a> </td>
					
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
