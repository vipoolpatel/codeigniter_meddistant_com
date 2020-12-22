<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Quotes Requested</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Quotes Requested</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List Quotes</li>
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
                        <!-- <h5 class="card-title">List Quotes</h5> -->
                        <?php if (!empty($quote_requested_data)) {
	?>
						<table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
							<thead>
								<tr>
								    <th>Request No</th>
								    <th>Date Recieve</th>
								    <th>Status</th>
									<th>Customer Name</th>
									<th>Gender</th>
									<th>City</th>
									<th>Country</th>
									<th>Treatment</th>
									
								</tr>
							</thead>
							<tbody>
							<?php
							$quote_status = "";
								foreach ($quote_requested_data as $data) {
									?>
								<tr>
								    <td><?php echo ucfirst($data['request_no']) ?></td>
								    <td><?php echo date('d-m-Y', strtotime($data['created_on'])) ?></td>

<td>
								    	

								    	<?php
$user_id = $this->session->userdata('user_id');
		$quote_requested_id = $data['id'];

		$check_any_payment = $this->db->join('tbl_quote_sent', 'tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
		$check_any_payment = $this->db->where('tbl_quote_sent.type', 'Treatment');
		$check_any_payment = $this->db->where('tbl_checkout.id_quote_request', $quote_requested_id);
		$check_any_payment = $this->db->get('tbl_checkout')->num_rows();

		$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
			'id_user' => $user_id,
			'quote_request_id' => $quote_requested_id,
		), $row = 1, 'created_on DESC');

		$quote_sent_id = !empty($check_quote_status['quote_sent_id']) ? $check_quote_status['quote_sent_id'] : '';

		$check_my_payment = $this->db->select('tbl_checkout.*');
		$check_my_payment = $this->db->from('tbl_checkout');
		$check_my_payment = $this->db->join('tbl_quote_sent', 'tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
		$check_my_payment = $this->db->where('tbl_checkout.id_quote_request', $quote_requested_id);
		$check_my_payment = $this->db->where('tbl_checkout.id_quote_sent', $quote_sent_id);
		$check_my_payment = $this->db->where('tbl_quote_sent.type', 'Treatment');
		$check_my_payment = $this->db->get()->row();
		if (!empty($check_my_payment->checkout_id)) {
			echo '<a style="color: #fff;" href="' . base_url() . 'customer_checkout/checkout_detail/' . $check_my_payment->checkout_id . '" class="label_custom">View Booking Detail</a>';
		} else if ($data['status'] == 1 || !empty($check_any_payment)) {
			echo '<span class="label_custom lbl_warning" style="background:red">Declined</span>';
		} else if (!empty($check_quote_status)) {
			?>
			<span class="label_custom lbl_warning">Quote Sent</span>
			<?php
} else {

			if (strtotime($data['awaiting_quotes_date']) < strtotime('-90 days')) {
				?>
<span class="label_custom lbl_warning">Unavailable</span>
<?php
} else {
				if ($data['quote_status'] != INCOMPLETE) {
					?>
	<span class="label_custom lbl_warning"><?=AWAITINGQUOTE?></span>
	<a href="<?php echo base_url(); ?>quotes_requested/manage_send_quote/<?php echo $data['id'] ?>" class="btn btn-success btn-sm please_quote"> Please Quote</a>
	<?php
}
			}

		}

		?>



									<div class="btn-group" style="margin-left: 20px;">
										 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                    </div>

								    </td>



									<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' ' . ucwords($data['last_name']) : ucwords($data['full_name']) ?></td>
									<td><?php echo ucfirst($data['gender']) ?></td>
									<td><?php echo ucfirst($data['city']) ?></td>
									<td><?php echo ucfirst($data['country']) ?></td>
									<td><?php echo ucfirst($data['procedure_treatment']) ?></td>

								
								</tr>
							<?php }} else {?>
							<div style = "color: #ff0002; text-align: center">No Quote Requested </div>
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
    function showAjaxModal(url)
    {
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            success: function (response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }
    $(document).ready(function() {
	    $('#datatable-list').DataTable({

	        "order": [[ 0, "desc" ]]

	    });
	} );
</script>
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div  class="modal-body">


            </div>
        </div>
    </div>
</div>