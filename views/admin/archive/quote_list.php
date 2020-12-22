<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Archive Quote Requests List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="/admin/Dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Quote Requests</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quote Requests List</li>
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
                            <!-- <h5 class="card-title">Quote Requests List</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
									<th>Request No</th>
									<th>Request Date</th>
									<th>Initiated by</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone No</th>
									<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($quote_data as $data) {
	?>
									<tr>
										<td><?php echo $data['request_no'] ?></td>
										<td><?php echo date('d M, Y', strtotime($data['created_on'])); ?></td>
										<td><?php if ($data['user_type'] == 'customer') {echo "Customer";} else if ($data['user_type'] == 'agent') {echo "Agent";} else if ($data['user_type'] == 'admin') {echo "Admin";}?></td>
										<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' ' . ucwords($data['last_name']) : ucwords($data['full_name']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
										<td><?php echo ucwords($data['phone_no']) ?></td>
										<td style="text-align:center;">
                                            <div class="btn-group">
												<a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>

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
<script>
// function assign_agent(agent_id, quote_request_id) {
// 	$.ajax({
// 		type: 'post',
// 		url: '<?php echo base_url(); ?>admin/manage_quotes/assign_agent',
// 		data: {
// 			"agent_id": agent_id,
// 			"quote_request_id": quote_request_id,
// 		},
// 		success: function (data) {
// 			$('#assign_agent_response').css('display', 'block');
// 			$('#assign_agent_response_text').text(data);
// 		}
// 	});
// }
$(document).ready(function(){
	$(".hotel_accommodation").change(function(){
		if($(this).val() != 0){
			$.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>admin/manage_quotes/assign_agent',
				data: {
					"agent_id": $(this).val(),
					"quote_request_id": $(this).attr('quote-request-id'),
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
            $('#datatable-list').DataTable({
                "order": [[ 0, "desc" ]]
            });
        } );
    </script>