<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Scheduled Calls</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Scheduled Calls</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
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
										<th>Full Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Procedure</th>
										<th>Schedule Date</th>
										<th>Time</th>
										<th>Message</th>
										<?php
if ($this->session->userdata('user_type') == 'admin') {
	?>
										<th>Assign to Agent</th>
										<th>Action</th>
										<?php }
?>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($scheduled_calls_data as $data) {
	?>
									<tr>
										<td><?php echo ucwords($data['full_name']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
										<td><?php echo ucwords($data['phone_no']) ?></td>
										<td><?php echo ucfirst($data['procedure_treatment']) ?></td>
										<td><?php echo $data['schedule_date']; ?></td>
										<td style="width: 75px"> <?php echo $data['time_from']; ?></td>
										<td ><?php echo ucfirst($data['message']) ?></td>
																				<?php
if ($this->session->userdata('user_type') == 'admin') {
		?>
										<td ><?php
$agent_id = $data['agent'];
		$agents_data = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'agent'")->result_array();?>
											<select name="hotel_accommodation" quote-request-id = "<?php echo $data['id']; ?>"  class="form-control hotel_accommodation" style = "width:150px;">
												<option value="0">Select agent to assign</option>
												<?php
foreach ($agents_data as $d) {
			?>
													<option value="<?php echo $d['user_id']; ?>" data-email = "<?php echo ucfirst($d['email']); ?>" <?php if ($agent_id === $d['user_id']) {?> selected <?php }?>> (<?php echo ucfirst($d['email']); ?>)
													</option>
												<?php }?>
											</select></td>

											<td>
													<a data-url="<?=base_url()?>admin/general_info/delete_scheduled_calls/<?=$data['id']?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a>
											</td>
											<?php }
	?>
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
		$(document).ready(function(){
			$(".hotel_accommodation").change(function(){
				if($(this).val() != 0){
					$.ajax({
						type: 'post',
						url: '<?php echo base_url(); ?>admin/general_info/assign_agent',
						data: {
							"agent_id": $(this).val(),
							"id": $(this).attr('quote-request-id'),
							"email": $(this).find(':selected').attr('data-email'),
						},
						success: function (data) {
							// $('#assign_agent_response').css('display', 'block');
							// $('#assign_agent_response_text').text(data);
							alert(data);
						}
					});
				}
			});
		});
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable();
        } );
</script>
