<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Quote Requests List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="/admin/agent/Dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Manage Quote Requests</a>
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
                                         <th>Status</th>
                                        <th>Initiated By</th>
                                        <th>Type</th>
										<th>Name</th>
										<th>Email</th>
                                        <th>Country</th>
                                        <th>City</th>
										<th>Phone No</th>
                                       
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($quote_data as $data) {

	$get_employee_Type = $this->db->select('tbl_company_type.company_code');
	$get_employee_Type = $this->db->from('tbl_referrals');
	$get_employee_Type = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');
	$get_employee_Type = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id');
	$get_employee_Type = $this->db->where('tbl_referrals.ref_email', $data['email']);
	$get_employee_Type = $this->db->get()->row();
	$company_type = !empty($get_employee_Type->company_code) ? $get_employee_Type->company_code : $data['company_type'];

	?>
									<tr>
                                        <td><?php echo ucwords($data['request_no']) ?></td>

                                          <td>

                                       <?php
$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
		'id_user' => $this->session->userdata('user_id'),
		'quote_request_id' => $data['id'],
	), $row = 1, 'created_on DESC');


	
    $check_any_payment = $this->db->select('tbl_checkout.*,tbl_quote_sent.type');
    $check_any_payment = $this->db->from('tbl_checkout');
    $check_any_payment = $this->db->join('tbl_quote_sent','tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
    $check_any_payment = $this->db->where('tbl_checkout.id_quote_request',$data['id']);
    $check_any_payment = $this->db->get()->result();


	if (!empty($check_any_payment)) {
		foreach ($check_any_payment as $key => $value_paid) {
			$status_paid = '';
		    if($value_paid->type == 'Service')
		    {
		        $status_paid = 'Svs. Paid';
		    }
		    else
		    {
		        $status_paid = 'Booked';
		    }

			echo '<a style="color: #fff;" href="'.base_url().'customer_checkout/checkout_detail/'.$value_paid->checkout_id.'" class="label_custom">'.$status_paid.'</a> <br />';
		}
		
	} else {
		if ($data['status'] == 1) {
			echo '<span class="label_custom" style="background-color: red;">Declined</span>';
		} else {
			if (!empty($check_quote_status)) {
				echo '<span class="label_custom lbl_warning">Quote Sent</span>';
			} else {
				if ($data['quote_status'] == PLEASEQUOTE) {
					echo '<span class="label_custom lbl_warning">' . AWAITINGQUOTE . '</span>';
				} else {
					echo '<span class="label_custom">' . $data['quote_status'] . '</span>';
				}
			}

		}
	}
	?>

                                        </td>


                                    	<td><?=($data['request_by'] == 'Self') ? 'Customer' : $data['request_by']?></td>
                                    	<td><?=$company_type?></td>
										<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' ' . ucwords($data['last_name']) : ucwords($data['full_name']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
                                        <td><?php echo ucwords($data['country']) ?></td>
                                        <td><?php echo ucwords($data['city']) ?></td>
										<td><?php echo ucwords($data['phone_no']) ?></td>
                                      



                                        <td>

<?php
$user_id = $this->session->userdata('user_id');
	$quote_requested_id = $data['id'];

	$check_any_payment = $this->db->where('id_quote_request', $quote_requested_id);
	$check_any_payment = $this->db->get('tbl_checkout')->num_rows();

	$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
		'id_user' => $user_id,
		'quote_request_id' => $quote_requested_id,
	), $row = 1, 'created_on DESC');

	$quote_sent_id = !empty($check_quote_status['quote_sent_id']) ? $check_quote_status['quote_sent_id'] : '';

	$check_my_payment = $this->db->where('id_quote_request', $quote_requested_id);
	$check_my_payment = $this->db->where('id_quote_sent', $quote_sent_id);
	$check_my_payment = $this->db->get('tbl_checkout')->num_rows();
	if (!empty($check_my_payment)) {
		echo '<span class="label_custom">Booked</span>';
	} else if ($data['status'] == 1 || !empty($check_any_payment)) {
		echo '<span class="label_custom" style="background-color: red;">Declined</span>';
	} else if (!empty($check_quote_status)) {
		?>
            <span class="label_custom lbl_warning">Quote Sent</span>

           <a href="<?php echo base_url(); ?>quotes_requested/manage_send_quote/<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Please Quote</a>
            <?php
} else {

		if (strtotime($data['awaiting_quotes_date']) < strtotime('-90 days')) {
			?>
<span class="label_custom" tyle="background-color: red;">Unavailable</span>
<?php
} else {
			if ($data['quote_status'] != INCOMPLETE) {
				?>
    <span class="label_custom lbl_warning"><?=AWAITINGQUOTE?></span>
    <a href="<?php echo base_url(); ?>quotes_requested/manage_send_quote/<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Please Quote</a>
    <?php
} else {
				?>
        <span class="label_custom"> <?php echo $data['quote_status']; ?></span>
    <?php
}
		}

	}

	?>










                                         <div class="btn-group" style="margin-left:10px;">
                                         	<?php
                                         	if($data['request_by'] != 'Self') {
                                         	?>
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/edit_quote/<?php echo $data['id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                               <?php } ?>


                                                <!--
                                                <a data-url="<?php echo base_url(); ?>admin/manage_quotes/del_quote/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                                -->
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable({
                "order": [[ 0, "desc" ]]
            });
        } );
</script>