<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Manual Hospital List </h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manual Hospitals List</li>
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
                            <!-- <h5 class="card-title">List Agent</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Email</th>
										<th>Contact Name</th>  
                                        <th>Phone No</th>
                                        <th>Country</th>
                                       
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									foreach($hospital_data as $data) {
									?>
									<tr>
										<td><?php echo ucwords($data['username']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
										<td><?php echo ucwords($data['first_name']) ?><?php echo " " ?><?php echo ucwords($data['last_name']) ?></td>
                                        <td><?php echo ucwords($data['phone_no']) ?></td>
                                        <td><?php echo ucwords($data['country']) ?></td>
                                       
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                
                                                <?php if($this->session->userdata('user_type')=='admin') {?>
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp; <a data-url="<?php echo base_url(); ?>admin/hospital/manage_hospital/del/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i> <?php } ?>
                                                </a> &nbsp;&nbsp;&nbsp; <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/detail/<?php echo $data['user_id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                                            </div>
                                        </td>
									</tr>
									<?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </main>
    
    <script>
function change_status(status, hospital_id) {
	$.ajax({
		type: 'post',
        // a.kader
		//url: '<?php //echo base_url(); ?>//admin/hospital/change_status',
		url: '<?php echo base_url(); ?>admin/hospital/change_approve_status',
		data: {
			"status": status,
			"id": hospital_id,
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