<!DOCTYPE html>
<html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
		
		<div class="alert alert-success" id="assign_agent_response" style="display: none ">
			<button class="close" data-close="alert"></button>
			<span id="assign_agent_response_text"></span>
		</div>
		
		<div class="row">
			<div class="col-12">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Serial#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Assigned Agent</th>
							<th>Delete</th>
						</tr>
						</thead>
						
						
						<tbody>
						<?php
						foreach($quote_data as $data) {
						?>
						<tr>
							
							<td><?php echo $data['id'] ?></td>
							<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' '. ucwords($data['last_name'])  : ucwords($data['full_name']) ?></td>
							<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
							<td><?php echo ucwords($data['phone_no']) ?></td>
							
							
							
							<td style="width: 25%">
								<?php
								$agent_id = $data['assigned_agent'];
								if($data['assigned_agent'] == '') {
									$agents_data = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'agent'")->result_array();
									
									?>
									
									
									
									<select name="hotel_accommodation"  class="form-control"  onchange="assign_agent(this.value, <?php echo $data['id']; ?>)">
										
										<option value="">Select agent to assign</option>
									<?php
									foreach ($agents_data as $data) {
									?>
										
										
										<option value="<?php echo $data['user_id']; ?>" <?php if($agent_id === $data['user_id']) { ?> selected <?php } ?>> (<?php echo ucfirst($data['email']); ?>)
										</option>
										
										
										<?php } ?>
										
										
									</select>
									
									
									
								
							<?php	} else {
								
								
								$selected_data = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '$agent_id'")->row_array();
								
								?>
									<span class="label label-danger" style="color: white; border-radius: 3px; font-size: 12px;"><?php echo ucfirst($selected_data['email']);?>
									</span>
							<?php } ?>
								
								
							</td>
							
							
							<script>
								
								function assign_agent(agent_id, quote_request_id) {
									$.ajax({
										type: 'post',
										url: '<?php echo base_url(); ?>admin/manage_quotes/assign_agent',
										data: {
											"agent_id": agent_id,
											"quote_request_id": quote_request_id,
										},
										success: function (data) {
											
											$('#assign_agent_response').css('display', 'block');
											$('#assign_agent_response_text').text(data);
										}
									});
								}
							
							</script>
							
							
							
							<td><a href="<?php echo base_url(); ?>admin/manage_quotes/del_quote/<?php echo $data['id'] ?>" title="Delete"><i class="dripicons-trash"></i></a> </td>
					
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
