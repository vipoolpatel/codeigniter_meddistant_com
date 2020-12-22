<!DOCTYPE html>
<html>


<body>

<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Availability</h4>
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
				<div class="col-md-6 offset-3">
					<div class="card-box">
						<h4 class="m-t-0 m-b-30 header-title">Booking Availability</h4>
						
						
						<?php $attributes = array('class' => 'form-horizontal', 'id' => '');
						echo form_open('admin/setting/save_availability', $attributes); ?>
						
						<div class="form-group row">
							<label for="inputEmail3" class="col-3 col-form-label">Date From</label>
							<div class="col-9">
								<input class="form-control" name="date_from" id="datepicker" placeholder="" type="text" value="" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-3 col-form-label">Date To</label>
							<div class="col-9">
								<input class="form-control" name="date_to" id="datepicker" placeholder="" type="text" value="" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="inputPassword5" class="col-3 col-form-label">Title</label>
							<div class="col-9">
								<input class="form-control" name="title" id="" placeholder="" type="text" value="">
							</div>
						</div>
						
						
						<div class="form-group mb-0 justify-content-end row">
							<div class="col-9">
								<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div> <!-- end row -->
		
		
		
		
		
		
		<div class="row">
			<div class="col-12">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Date From</th>
							<th>To Date</th>
							<th>Title</th>
							<th>Delete</th>
						</tr>
						</thead>
						
						
						<tbody>
						<?php
						foreach($availability_data as $data) {
							?>
							<tr>
								<td><?php echo date('d M, Y', strtotime($data['date_from'])); ?></td>
								<td><?php echo date('d M, Y', strtotime($data['date_to'])); ?></td>
								
								<td><?php echo $data['title']; ?></td>
								<td><a href="<?php echo base_url(); ?>admin/general_info/dlt_contact_inq/<?php echo $data['id'] ?>" title="Delete"><i class="dripicons-trash"></i></a> </td>
							
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- end row -->
	
		
		
		
		
		
	</div> <!-- end container -->



</div>
<!-- end wrapper -->






</body>

</html>
