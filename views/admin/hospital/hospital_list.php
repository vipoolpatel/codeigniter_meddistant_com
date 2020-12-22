<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Medical Providers</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Medical Providers</li>
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
                                        <th>Joined Date</th>
                                        <th>Type</th>
                                        <th>Rate</th>
                                        <th>Payment Type</th>
                                        <th>Direct Payment</th>
                                        <th>Commission (%)</th>
                                        <th>Prepayment (%)</th>
                                        <th>Plan Trip</th>
										<th>Email</th>
										<th>Contact Name</th>
                                        <th>Phone No</th>

                                        <th>Country</th>
                                        <th>State</th>
                                        <?php
                                       if($this->session->userdata('user_type') == 'admin') {
                                        ?>
                                        <th>Active Date</th>
                                        <th>Status</th>
                                        <th>Assign Agent</th>
                                       <th>Action</th>
                                       <?php }
                                       ?>

                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                        foreach ($hospital_data as $data) {
                                    ?>
									<tr>
										<td><?php echo ucwords($data['username']) ?></td>
                                        
                                        <td><?=date('Y-m-d', strtotime($data['created_on']))?></td>
                                        <td>
                                        <?php
                                            if(!empty($data['hos_med_provider_type'])) {
                                                $getData = $this->db->where('id', $data['hos_med_provider_type']);
                                                $getData = $this->db->get('tbl_med_provider_type')->row();  
                                                ?>
                                                <?=$getData->name?>                                              
                                            <?php
                                            }
                                            else {
                                                echo "N/A";
                                            }
                                        ?>
                                        </td>
                                        <td>

                                            <?php
                                            if(!empty($data['plan_id']) && $data['country'] == 'USA') {
                                                if($data['payment_option'] == '2')
                                                {
                                                    echo "Invoice";
                                                }
                                                $getDataFee = $this->db->where('id', $data['plan_id']);
                                                $getDataFee = $this->db->get('tbl_med_provider_type_plan')->row();
                                                ?>
                                                <br />                                            
                                                Setup Fee : $<?=!empty($getData->setup_fee) ? $getData->setup_fee : ''?>
                                                  <br />
                                                <?=$getDataFee->plan_name?> : $<?=$getDataFee->price?>
                                                <?php
                                            }
                                            else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($data['country'] == 'USA') {
                                            ?>
                                                <?=($data['hos_payment'] == '1') ? 'Paid' : 'Unpaid'?>
                                            <?php }
                                            else
                                            { 
                                                    echo "N/A";
                                                ?>
                                            <?php }
                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            if(!empty($data['paid_setup']) || !empty($data['subscription_type']) || !empty($data['subscription_price']))
                                            { ?>
                                                   Setup Fee : <?=$data['paid_setup']?> <br />
                                                   Subscription Type : <?=$data['subscription_type']?> <br />
                                                   Subscription Price : <?=$data['subscription_price']?> <br />
                                           <?php }
                                           else
                                           {
                                                echo "N/A";
                                           }
                                            ?>
                                        </td>


                                        <td><?=$data['hospital_commission']?></td>
                                        
                                        <td><?=$data['hospital_prepay']?></td>
                                        <td>
                                            <?php
                                        if(!empty($data['start_date']) && !empty($data['end_date']))
                                        {
                                            ?>
                                            <?=$data['start_date']?> to <?=$data['end_date']?>
                                            <?php
                                        }
                                        else
                                        { ?>
                                            None
                                       <?php }
                                            ?>
                                            
                                        </td>

										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
										<td><?php echo ucwords($data['first_name']) ?><?php echo " " ?><?php echo ucwords($data['last_name']) ?></td>
                                        <td><?php echo ucwords($data['phone_no']) ?></td>
                                        <td><?php echo ucwords($data['country']) ?>
                                        </td>
                                        <td><?php echo ucwords($data['state']) ?></td>

                                        <?php
                    if($this->session->userdata('user_type') == 'admin') {
                                        ?>
                                        <td>
                                            Start Date = <?=!empty($data['start_quote_date']) ? date('Y-m-d', strtotime($data['start_quote_date'])) : '-' ?>
                                            <br />

                                            End Date = <?=!empty($data['end_quote_date']) ? date('Y-m-d', strtotime($data['end_quote_date'])) : '-' ?>
                                        </td>
                                        <td style="width: 10%">
											<?php
//                                            a.kader
                                           $approved = $data['is_quote'];?>

                                            <select name="is_quote"  class="form-control"  onchange="change_status(this.value, <?php echo $data['user_id']; ?>)">
                                                <option <?php if ($approved == 1) {echo "selected";}?> value="1">Active</option>
                                                <option <?php if ($approved == 0) {echo "selected";}?> value="0">Inactive</option>
                                            </select>
                                        </td>

                                        <td>
                                            <select id="<?=$data['user_id']?>" class="form-control assign_agent" style="width: 150px;">
                                                <option value="">Select agent to assign </option>
                                            <?php
                                            foreach($agents_data as $agent)
                                            { ?>
                                                <option <?=($data['agent_id'] ==  $agent['user_id']) ? 'selected' : '' ?> value="<?php echo $agent['user_id']; ?>"><?php echo ucfirst($agent['email']); ?></option>
                                           <?php }
                                            ?>
                                            </select>
                                        </td>

                                        <!--<td style="text-align:center;">-->
                                        <!--    <div class="btn-group">-->
                                        <!--        <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp; <a data-url="<?php echo base_url(); ?>admin/hospital/manage_hospital/del/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp; <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/detail/<?php echo $data['user_id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a> -->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp; <a data-url="<?php echo base_url(); ?>admin/hospital/manage_hospital/del/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp; <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/hospital/facility_detail/<?php echo $data['user_id'] ?>" title="FDetail"><i class="simple-icon-eye d-block"></i></a>

                                                 &nbsp;&nbsp;&nbsp;

     <a style="margin-top:3px;border-radius: 50px !important;" class="btn btn-success" href="<?php echo base_url(); ?>admin/hospital/pdf_ageement/<?php echo $data['user_id'] ?>" title="Ageement">Ageement</a>


                                            </div>
                                        </td>

                                    <?php }
                                    ?>


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

$(document).on('change', '.assign_agent', function() {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>admin/hospital/assign_agent',
        data: {
            "agent_id": $(this).val(),
            "user_id": $(this).attr('id'),
        },
        success: function (data) {
            alert('Agent Assigned successfully!');
        }
    });        
});



function change_status(status, hospital_id) {
	$.ajax({
		type: 'post',
        // a.kader
		//url: '<?php //echo base_url(); ?>//admin/hospital/change_status',
		// url: '<?php echo base_url(); ?>admin/hospital/change_approve_status',
        url: '<?php echo base_url(); ?>admin/hospital/change_approve_status_quote',
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