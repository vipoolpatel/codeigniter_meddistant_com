<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Email Subscription</h4>
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
							<th>#:</th>
							<th>Email</th>
							<th>Subscription Date</th>
						
						</tr>
						</thead>
						
						
						<tbody>
						<?php
						$i = 1;
						foreach($subscription_data as $data) {
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
							<td><?php echo date('m-d-Y', strtotime($data['subscription_date'])); ?></td>
		
					
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
