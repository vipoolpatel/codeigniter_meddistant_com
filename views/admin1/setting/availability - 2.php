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
									<input class="form-control" name="date_from" id="" placeholder="" type="date" value="<?php if(!empty($availability_data)) { echo date('Y-m-d', strtotime($availability_data['date_from']));} ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-3 col-form-label">Date To</label>
								<div class="col-9">
									<input class="form-control" name="date_to" id="" placeholder="" type="date" value="<?php if(!empty($availability_data)) { echo date('Y-m-d', strtotime($availability_data['date_to']));} ?>" required>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="inputPassword5" class="col-3 col-form-label">Title</label>
								<div class="col-9">
									<input class="form-control" name="title" id="" placeholder="" type="text" value="<?php if(!empty($availability_data)) { echo $availability_data['title'];} ?>">
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
	
	</div> <!-- end container -->
	
	

</div>
<!-- end wrapper -->






</body>

</html>
