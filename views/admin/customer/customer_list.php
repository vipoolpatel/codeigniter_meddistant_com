<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Customers List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Customers</li>
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
                            <!-- <h5 class="card-title">List Agent</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                       
										<th>Name</th>
										<th>Email</th>
                                        <th>Phone No</th>
                                        <th>Country</th>
                                        <th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($customer_data as $data) {
	?>
									<tr>
                                        <td><?php echo ucwords($data['first_name']) ?> <?php echo ucwords($data['last_name']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
                                        <td><?php echo ucwords($data['phone_no']) ?></td>
                                        <td><?php echo ucwords($data['country']) ?></td>
                                        <td style="width: 10%">
											<?php
$status = $data['active'];?>
                                            <?php if ($status == 1) {
		echo "Active";
	} else {
		echo "Inactive";
	}?>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/customer/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp; <a data-url="<?php echo base_url(); ?>admin/customer/manage_customer/del/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp; <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/customer/detail/<?php echo $data['user_id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>

                                                <?php
                                                $count_file = $this->common_model->getMyFilesCount($data['email'], $data['user_id']);
                                                if(!empty($count_file))
                                                {
                                                ?>
                                                <a href="<?=base_url()?>admin/customer/detail_file?email=<?=$data['email']?>&user_id=<?=$data['user_id']?>" class="btn btn-primary btn-sm" style="padding: 6px;border-radius: 7px !important;margin-left: 14px;">File <?=$count_file?></a>
                                                <?php 
                                                }
                                                ?>


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
function change_status(status, customer_id) {
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>admin/customer/change_status',
		data: {
			"active": status,
			"id": customer_id,
		},
		success: function (data) {
            alert("Status Change Successfully!!");
			// $('#assign_agent_response').css('display', 'block');
			// $('#assign_agent_response_text').text(data);
		}
	});
}
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable();
        } );
</script>
