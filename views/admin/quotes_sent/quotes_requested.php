<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>List Quotes</h1>
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
            <?php if ($this->session->flashdata('error_message')) { ?>
                <div class="alert alert-danger alert-dismissible fade show rounded">
					<?php echo $this->session->flashdata('error_message'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
				<?php if ($this->session->flashdata('success_message')) { ?>
				<div class="alert alert-success alert-dismissible fade show rounded">
					<?php echo $this->session->flashdata('success_message'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php } ?>
        </div>

        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title">List Quotes</h5> -->
                        <?php if (!empty($quote_requested_data)) { ?>
						<table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
							<thead>
								<tr>
								    <th>Request No</th>
								    <th>Date Recieve</th>
									<th>Customer Name</th>
									<th>Gender</th>
									<th>City</th>
									<th>Country</th>
									<th>Treatment</th>
									<th>Message</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($quote_requested_data as $data) {
								?>
								<tr>
								    <td><?php echo ucfirst($data['request_no']) ?></td>
								    <td><?php echo $data['created_on'] ?></td>
									<td><?php echo empty($data['full_name']) ? ucwords($data['first_name']) . ' '. ucwords($data['last_name'])  : ucwords($data['full_name']) ?></td>
									<td><?php echo ucfirst($data['gender']) ?></td>
									<td><?php echo ucfirst($data['city']) ?></td>
									<td><?php echo ucfirst($data['country']) ?></td>
									<td><?php echo ucfirst($data['procedure_treatment']) ?></td>
									<td ><?php echo ucfirst($data['message']) ?></td>
									<?php
									$user_id = $this->session->userdata('user_id');
									$quote_requested_id = $data['id'];
									$check_quote_status = $this->common_model->get_tbl_data('quote_sent', '*', array(
											'id_user' => $user_id,
											'quote_request_id' => $quote_requested_id
									), $row = 1, 'created_on DESC');
									?>
									<?php 
									if($data['status'] == 1){?>
										<td style="width: 100px">
											Declined
											<div class="btn-group" style="margin-left: 20px;">
										 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <?php if($data['quote_image'] != ""){ ?>
                                                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $data['quote_image']; ?>" target="_blank" title="Attachment"><img src="<?php echo base_url(); ?>uploads/attachment.jpg" alt=""></a>
                                                    <?php } ?>
                                                </div>
										</td>
									<?php }elseif($check_quote_status) { ?>
										<td style="width: 100px; color: #ff002c;"><b>Quote Sent</b> 
										<div class="btn-group" style="margin-left: 20px;">
										 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <?php if($data['quote_image'] != ""){ ?>
                                                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $data['quote_image']; ?>" target="_blank" title="Attachment"><img src="<?php echo base_url(); ?>uploads/attachment.jpg" alt=""></a>
                                                    <?php } ?>
                                                </div></td>
									<?php } else { ?>
									<td style="width: 100px">
										<?php 
										if (strtotime($data['created_on']) < strtotime('-7 days')) { ?>
											Unavailable
										<?php }else{ ?>
										<a href="<?php echo base_url(); ?>quotes_requested/manage_send_quote/<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Please Quote</a> 
										<div class="btn-group" style="margin-left: 20px;">
										 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <?php if($data['quote_image'] != ""){ ?>
                                                        <a href="<?php echo base_url(); ?>upload_dir/quote_image/<?php echo $data['quote_image']; ?>" target="_blank" title="Attachment"><img src="<?php echo base_url(); ?>uploads/attachment.jpg" alt=""></a>
                                                    <?php } ?>
                                                </div>
										 </td>
									<?php }} ?>
									
                                               
								</tr>
							<?php } } else { ?>
							<div style = "color: #ff0002; text-align: center">No Quote Requested </div>
							<?php } ?>
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
	    $('#datatable-list').DataTable();
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