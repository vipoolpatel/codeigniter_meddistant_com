<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Agents List </h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/admin/agent"); ?>">Manage Agents</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Agents List</li>
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
                                        <th>Gender</th>
                                        <th>Type</th>
                                        <th>Country</th>
                                        <th>Territory</th>
                                        <th>Approve Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                        foreach ($agent_data as $data) {
                                        	?>
									<tr>
										<td><?php echo ucwords($data['username']) ?></td>
										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
                                        <td><?php echo ucwords($data['phone_no']) ?></td>
                                        <td><?php if ($data['gender'] == 'm') {echo "Male";} else if ($data['gender'] == 'f') {echo "Female";}?></td>
                                        <td><?php if ($data['agent_type'] == 'i') {echo "Individual";} else if ($data['agent_type'] == 'c') {echo "Company";}?></td>
                                        <td><?php echo ucwords($data['country']) ?></td>

                                        <td><?php echo ucwords($data['state']) ?> - <?php echo ucwords($data['territory']) ?></td>
                                        <td style="width: 10%">
											<?php
//                                            a.kader
                                            	$approved = $data['approved'];
                                            	$status = $data['active'];?>
											<select name="status"  class="form-control"  onchange="change_status(this.value, <?php echo $data['user_id']; ?>)">
                                                <option <?php if ($approved == 3) {echo "selected";}?> value="3">Pending</option>
                                                <option <?php if ($approved == 1) {echo "selected";}?> value="1">Approve</option>
                                                <option <?php if ($approved == 0) {echo "selected";}?> value="0">Disapprove</option>
											</select>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> 

                                                &nbsp;&nbsp;&nbsp;

                                                 <a data-url="<?php echo base_url(); ?>admin/agent/manage_agent/del/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> 

                                                 &nbsp;&nbsp;&nbsp;

                                                  <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/agent/detail/<?php echo $data['user_id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>

                                                </a> 
                                                &nbsp;&nbsp;&nbsp; 
                                                <a class="btn btn-primary" style="margin-top:3px;border-radius: 50px !important;" href="<?php echo base_url(); ?>admin/agent/booked_sales?user_id=<?php echo $data['user_id'] ?>" title="Commision">Commision</a>
                                                <?php
                                                if($data['territory'] != 'all')
                                                {
                                                ?>

                                                &nbsp;&nbsp;&nbsp; 
                                               <a class="btn btn-info" style="margin-top:3px;border-radius: 50px !important;" href="<?php echo base_url(); ?>admin/agent/assign_country/<?php echo $data['user_id'] ?>" title="Country">Country</a> 

                                                &nbsp;&nbsp;&nbsp; 
                                                <a class="btn btn-success" style="margin-top:3px;border-radius: 50px !important;" href="<?php echo base_url(); ?>admin/agent/assign_state/<?php echo $data['user_id'] ?>" title="State">State</a> 
                                            <?php }
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
function change_status(status, agent_id) {
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>admin/agent/change_status',
		data: {
			"active": status,
			"id": agent_id,
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