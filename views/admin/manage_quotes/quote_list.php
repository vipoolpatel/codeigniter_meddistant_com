<main>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>Quote Requests List</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
              <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item"> <a href="#">Dashboard</a> </li>
                <li class="breadcrumb-item"> <a href="#">Quote Requests</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Quote Requests List</li>
              </ol>
            </nav>
            <div class="separator mb-5"></div>
          </div>
        </div>
        <div class="col-12">
          <?php if ($this->session->flashdata('error_message')) {?>
          <div class="alert alert-danger alert-dismissible fade show rounded"> <?php echo $this->session->flashdata('error_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <?php }?>
          <?php if ($this->session->flashdata('success_message')) {?>
          <div class="alert alert-success alert-dismissible fade show rounded"> <?php echo $this->session->flashdata('success_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
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
                      <th>Quote Status</th>
                      <th>Assigned Agent</th>
                      <th>City, State</th>
                      <th>Country</th>
                      <th>Type</th>
                      <th>Initiated by</th>
                      <th>Name</th>
                      
                      
                     
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

foreach ($quote_data as $data) {
  $quote_status = '';
  
	$get_employee_Type = $this->db->select('tbl_company_type.company_code');
	$get_employee_Type = $this->db->from('tbl_referrals');
	$get_employee_Type = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');
	$get_employee_Type = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id');
	$get_employee_Type = $this->db->where('tbl_referrals.ref_email', $data['email']);
	$get_employee_Type = $this->db->get()->row();
	$company_type = !empty($get_employee_Type->company_code) ? $get_employee_Type->company_code : $data['company_type'];

	$quote_requested_id = $data['id'];

    $paid = $this->db->select('tbl_checkout.*,tbl_quote_sent.type');
    $paid = $this->db->from('tbl_checkout');
    $paid = $this->db->join('tbl_quote_sent','tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
    $paid = $this->db->where('tbl_checkout.id_quote_request',$data['id']);
    $paid = $this->db->get()->result();

  if (!empty($paid)) {

    foreach ($paid as $key => $value_paid) {
      $status_paid = '';
      if($value_paid->type == 'Service')
      {
          $status_paid = 'Svs. Paid';
      }
      else
      {
         $status_paid = 'Booked';
      }

      $quote_status .= '<a href="'.base_url().'customer_checkout/checkout_detail/'.$value_paid->checkout_id.'" style="color: #fff;" class="label_custom">'.$status_paid.'</a>';  
      $quote_status .= '<br>';      
    }

		
	} else {
		$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
			'quote_request_id' => $quote_requested_id,
		), $row = 1, 'created_on DESC');

		if (!empty($check_quote_status)) {
			$quote_status = '<span class="label_custom lbl_warning">Quote Received</span>';
		} else if ($data['status'] == 1) {
			$quote_status = '<span style="background-color: red;" class="label_custom">Declined</span>';
		} else {
			if ($data['quote_status'] != "") {
				if ($data['quote_status'] == PLEASEQUOTE) {
					$quote_status = '<span class="label_custom lbl_warning">' . AWAITINGQUOTE . '</span>';
				} else {
					$quote_status = '<span class="label_custom">' . $data['quote_status'] . '</span>';
				}
			}
		}
	}

	?>
                    <tr>
                      <td><?php echo $data['request_no'] ?></td>
                      <td><?php echo date('M d, Y', strtotime($data['created_on'])); ?></td>
                      <td> <?php echo $quote_status; ?></td>


                         <td style="width: 15%"><?php
$agent_id = $data['assigned_agent'];
  // $agents_data = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'agent' AND country = '" . $data['desired_country'] . "' ")
  $agents_data = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'agent' ")->result_array();?>


                        <select name="hotel_accommodation" quote-request-id = "<?php echo $data['id']; ?>"  class="form-control hotel_accommodation" style = "width:150px;">
                          <option value="0">Select agent to assign</option>
                          <?php
foreach ($agents_data as $d) {
    ?>
                          <option value="<?php echo $d['user_id']; ?>" data-email = "<?php echo ucfirst($d['email']); ?>" <?php if ($agent_id === $d['user_id']) {?> selected <?php }?>> (<?php echo ucfirst($d['email']); ?>) </option>
                          <?php }?>
                        </select></td>


                       <td><?php echo ucwords($data['city']) ?>, <?php echo ucwords($data['state']) ?></td>
                      <td><?php echo ucwords($data['country']) ?></td>


                      <td><?=$company_type?></td>


                      <td><?=($data['request_by'] == 'Self') ? 'Customer' : $data['request_by']?></td>

                      <td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' ' . ucwords($data['last_name']) : ucwords($data['full_name']) ?></td>

                 
                      
                   
                      <td style="text-align:center;"><div class="btn-group"> <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/edit_quote/<?php echo $data['id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp; <a data-url="<?php echo base_url(); ?>admin/manage_quotes/del_quote/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp; <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                        &nbsp;&nbsp;&nbsp;

                        <a class="btn btn-success" style="margin-top:3px;border-radius: 50px !important;" href="<?php echo base_url(); ?>admin/agent/pdf_consent/<?php echo $data['id'] ?>" title="Consent">Consent</a>

                       

                        </div></td>
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
$(document).on('change', '.hotel_accommodation', function() {

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
					alert('Agent Assigned successfully!');
				}
			});
		}
});

</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable({"order": [[0, "desc" ]]});
        } );
    </script>