<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Quotes Received</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Quotes Received</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quotes Received</li>
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
<?php if (!empty($quotes_received_data)) {
	?>
                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>

                                    	<th>Request No</th>
										<th>Treatment</th>
										<th>Hospital/Clinic</th>
										<th>Quote By</th>
											<th>Type</th>
										<th>Stay</th>
										<th>Stay Incl</th>
										<th>Treatment Cost</th>
										<th>Caring Doctor</th>
										<!--<th>Hospital</th>-->
										<th>Hosptial Facility</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
$this->user_id = $this->session->userdata('user_id');
	$i = 1;
	foreach ($quotes_received_data as $data) {
		$quote_request_id = $data['quote_request_id'];
		$quote_sent_id = $data['quote_sent_id'];
		$get_cehckout_data = $this->db->query("SELECT * FROM tbl_checkout WHERE id_quote_sent = '$quote_sent_id'")->row_array();

		?>
				<tr>
					<td><?php echo ucwords($data['request_no']); ?></td>
					<td><?php echo ucwords($data['procedure_treatment']); ?></td>
					<td><?php echo ucfirst($data['hospital_clinic']) ?></td>
					<td><?php echo ucfirst($data['quote_by']) ?></td>
					<td><?php echo ucfirst($data['type']) ?></td>
					<td>
											<?php
if ($data['stay_length'] == 'N/A') {
			echo $data['stay_length'];
		} else {
			echo ucfirst($data['stay_length']) . ' ' . 'Days';
		}

		?>

    										</td>

					<td><?php echo ucfirst($data['accomodations']) ?></td>
					<td ><?php echo '$' . $data['treatment_cost'] ?></td>
											<td ><?php
if ($data['doctor_id'] != Null || $data['doctor_id'] != 0) {
			$doctor_id = $data['doctor_id'];
			$doctor = $this->db->query("SELECT *  FROM tbl_doctors  WHERE doctor_id = '$doctor_id'")->result_array();
			echo '<a style="color: blue;" href="Customer_quotes_received/view_doctor_profile/' . $doctor_id . '">';
			echo (isset($doctor[0]['name'])) ? $doctor[0]['name'] : '';
			echo '<a>';
		} else {
			echo !empty($data['new_doctor']) ? $data['new_doctor'] : '';
		}?></td>
											<!--<td><a class="btn btn-success btn-sm" href="/admin/hospital/detail/<?php echo ucfirst($data['id_user']) ?>">View Hosptial</a> </td>-->


												<td>
												<?php
if (!empty($data['hospital_table_id'])) {
			?>
												<a class="btn btn-success btn-sm" href="/admin/hospital/get_facility/<?php echo ucfirst($data['hospital_table_id']) ?>">View Hosptial Facility</a>
												<?php } else {
			echo "N/A";
		}
		?>

												 </td>


					<td><?php
if (strtotime($data['created_on']) < strtotime('-90 days')) {
			echo 'Expired';
		} else {
			$paid = $this->db->query("SELECT *  FROM tbl_checkout  WHERE id_quote_sent = '" . $data['quote_sent_id'] . "'")->result_array();
			if ($paid) 
			{
				if(ucfirst($data['type']) == 'Service')
				{
					echo '<span class="label_custom">Paid</span>';
				}
				else
				{
					echo '<span class="label_custom">Booked</span>';
				}
			}
			else 
			{
				echo '<span class="label_custom lbl_warning">Pending</span>';
			}
		}?></td>

											<?php
$user_id = $this->session->userdata('user_id');
		$quote_requested_id = $data['id'];
		$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
			'id_user' => $user_id,
			'quote_request_id' => $quote_requested_id,
		), $row = 1, 'created_on DESC');
		?>
											<?php if (!empty($get_cehckout_data['checkout_id'])) {?>
												<td style="width: 150px; color: #b81c23;">
													<a href="<?php echo base_url(); ?>customer_checkout/checkout_detail/<?php echo $get_cehckout_data['checkout_id'] ?>" class="btn btn-success btn-sm">

														<?php
													if(ucfirst($data['type']) == 'Service')
													{
														echo "Payment Details";
													}
													else
													{
														echo "View Booking Detail";
													}
													?>

												</a>

													 <a href="<?php echo base_url(); ?>admin/agent/quote_detail_sent/<?php echo $data['quote_sent_id'] ?>" class="btn btn-sm"><i class="simple-icon-eye d-block"></i></a>


												</td>
											<?php } else {
			?>
												<td style="width: 100px">

												<a href="<?php echo base_url(); ?>customer_checkout/process_quote/<?php echo $data['quote_sent_id'] ?>" class="btn btn-success btn-sm">Checkout</a>

												 <a href="<?php echo base_url(); ?>admin/agent/quote_detail_sent/<?php echo $data['quote_sent_id'] ?>" class="btn btn-sm"><i class="simple-icon-eye d-block"></i></a>

												 </td>
											<?php }?>
										</tr>
									<?php }} else {?>

									<div style = "color: #ff0002; text-align: center">No Quote Received </div>

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
             $('#datatable-list').DataTable( {
                    "order": [[ 0, "desc" ]]
                });

        } );
    </script>