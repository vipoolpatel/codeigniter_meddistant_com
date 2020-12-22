<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Quote Requests List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Quote Requests</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Quotes</li>
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
                            <!-- <h5 class="card-title">List Quotes</h5> -->
							<?php if (!empty($customer_quotes_data)) {
	?>
                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Request No</th>
										<th>Request Date</th>
										<th>Phone</th>
                                        <th>Request By</th>
										<th>Treatment</th>
                                        <th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($customer_quotes_data as $data) {
		if ($data['status'] == 1) {
			continue;
		}
		?>
										<tr>
                                            <td><?php echo $data['request_no']; ?></td>
											<td><?php echo date('Y-m-d', strtotime($data['created_on'])) ?></td>
											<td><?php echo ucwords($data['phone_no']) ?></td>
                                            <td><?php echo $data['request_by']; ?></td>
											<td><?php echo ucfirst($data['procedure_treatment']) ?></td>
                                            <td><?php
if (strtotime($data['created_on']) < strtotime('-90 days')) {
			echo 'Expired';
		} else {
			$paid = $this->db->query("SELECT *  FROM tbl_checkout  WHERE id_quote_request = '" . $data['id'] . "'")->result_array();
			if ($paid) {
				echo '<span class="label_custom">Booked</span>';
			} else {
				if ($data['quote_status'] == PLEASEQUOTE) {
					echo '<span class="label_custom lbl_warning">' . AWAITINGQUOTE . '</span>';
				} else {
					echo '<span class="label_custom">' . $data['quote_status'] . '</span>';
				}
			}
		}?></td>
                                            <td style="text-align:center;">
                                                <div class="btn-group">
                                                    <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/edit_quote/<?php echo $data['id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp;


                                                    <!--
                                                    <a data-url="<?php echo base_url(); ?>customer_quotes/dlt_customer_quote/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                                    -->

                                                    <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/quote_detail/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                                </div>
                                            </td>
										</tr>
									<?php }} else {?>
									<div style = "color: #ff0002; text-align: center">No Record Found </div>
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