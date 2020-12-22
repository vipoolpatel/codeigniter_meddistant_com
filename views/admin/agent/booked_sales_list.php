<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Booked Sales List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url()?>admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Manage Booked Sales</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Booked Sales List</li>
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

<form action="" method="get">




<div class="form-row">

    <div class="form-group col-md-2">
        <label>Total Booked Sales ($): <span id="getTotalBookedSales">0</span></label>
   </div>

   <div class="form-group col-md-2">
        <label>Total Commission : <span id="getTotalCommission">0</span> </label>
   </div>

   <div class="form-group col-md-2">
        <label>Facilitaion Fees (by CC) : <span id="getFacilitaionFeeCC">0</span> </label>
   </div>

   <div class="form-group col-md-2">
        <label>Facilitaion Fees (by Cash) : <span id="getFacilitaionFeeCash">0</span> </label>
   </div>


</div>

<hr />


<div class="form-row">
<?php
if ($this->session->userdata('user_type') == 'admin') {
	$assigned_agent = !empty($this->input->get('user_id')) ? $this->input->get('user_id') : '';
	?>

    <div class="form-group col-md-2">
      <label for="">Agent ID</label>
      <select class="form-control" name="user_id">
          <option value="">Select Agent</option>
          <?php
foreach ($getAgent as $val_agent) {?>
<option <?=($assigned_agent == $val_agent->user_id) ? 'selected' : ''?> value="<?=$val_agent->user_id?>"><?=$val_agent->username?> (<?=$val_agent->email?>)</option>
<?php
}
	?>
      </select>

   </div>
<?php
$agent_email = !empty($getAgentName->email) ? $getAgentName->email : '';
	?>

    <div class="form-group col-md-2">
      <label for="">Agent Email</label>
      <input type="text" class="form-control" name="agent_email" placeholder="Agent Email" value="<?=!empty($this->input->get('agent_email')) ? $this->input->get('agent_email') : $agent_email?>">
   </div>


<?php
$agent_username = !empty($getAgentName->username) ? $getAgentName->username : '';
	?>
    <div class="form-group col-md-2">
      <label for="">Agent Name</label>
      <input type="text" class="form-control" name="name" placeholder="Agent Name" value="<?=!empty($this->input->get('name')) ? $this->input->get('name') : $agent_username?>">
   </div>

   <?php }
?>




 <!--   <div class="form-group col-md-2">
      <label for="">Email</label>
      <input type="text" class="form-control" name="email" placeholder="Email" value="<?=!empty($this->input->get('email')) ? $this->input->get('email') : ''?>">
   </div> -->

   <div class="form-group col-md-2">
      <label for="">Start Date</label>
      <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="<?=!empty($this->input->get('start_date')) ? $this->input->get('start_date') : ''?>">
   </div>
   <div class="form-group col-md-2">
      <label for="">End Date</label>
      <input type="date" class="form-control" name="end_date" placeholder="End Date" value="<?=!empty($this->input->get('end_date')) ? $this->input->get('end_date') : ''?>">
   </div>

    <div class="form-group col-md-2" style="margin-top: 25px;">
      <input type="submit" class="btn btn-primary" value="Search">
      <a href="<?=base_url()?>admin/agent/booked_sales" class="btn btn-success">Reset</a>
   </div>

</div>
</form>



                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                         	<?php if (!empty($quote_data)) {
	?>
                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                    	<th>QR No.</th>
                                    	<th>Name</th>
                                    	<th>Email</th>
                                    	<th>City</th>
                  										<th>Phone No</th>
                  										<th>Treatment / Service</th>
                  										<th>Payment Date</th>
                  										<th>Book Date</th>
                  										<th>Treatment / Service Cost ($)</th>
                  										<th>Paid Amount ($)</th>
                  										<th>Commission ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
$TotalCommission = 0;
$getTotalBookedSales = 0;

$getFacilitaionFeeCC = 0;
$getFacilitaionFeeCash = 0;

	foreach ($quote_data as $value) {

		if (!empty($value['remaining_payment'])) {
			$total = $value['total_checkout_price'] - $value['remaining_payment'];
		} else {
			$total = !empty($value['total_checkout_price']) ? $value['total_checkout_price'] : 0;
		}

		$total_co = !empty($value['total_checkout_price']) ? $value['total_checkout_price'] : 0;
		if ($value['type'] == 'Service') {
			$total_com = ($total_co * 3) / 100;
		} else {
			$commission_rate = !empty($value['commission_rate']) ? $value['commission_rate'] : 0;
			$total_com = ($total_co * $commission_rate) / 100;
		}

		$TotalCommission = $TotalCommission + $total_com;




		$getTotalBookedSales = $getTotalBookedSales + $value['total_checkout_price'];


    if(!empty($value['facilitation_fee_cash']))
    {
        $facilitation_fees_commission = $value['facilitation_fees'] * 0.5;
        $TotalCommission = $TotalCommission + $facilitation_fees_commission;
    }
    else
    {
       $getFacilitaionFeeCC = $getFacilitaionFeeCC + $value['facilitation_fees'];      
    }



		?>
                                		<tr>
                                			<td><?=$value['request_no']?></td>
                                			<td><?=$value['first_name']?> <?=$value['last_name']?></td>
                                			<td><?=$value['email']?></td>
                                			<td><?=$value['city']?></td>
                                			<td><?=$value['phone_no']?></td>
                                			<td><?=!empty($value['procedure_treatment']) ? $value['procedure_treatment'] : $value['service_name']?></td>
                                			<td><?=date('m-d-Y', strtotime($value['payment_date']))?></td>
                                			<td><?=$value['schedule_treatment']?></td>
                                			<td><?=number_format($value['total_checkout_price'], 2)?></td>
                                			<td><?=number_format($total, 2)?></td>
                                			<td><?=number_format($total_com, 2)?></td>
                                		</tr>
                                <?php	}
	?>

                                </tbody>
                            </table>
<?php
} else {
	?>

							<div style = "color: #ff0002; text-align: center">No Booked Sales </div>
<?php }
?>
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
             var total = '<?=$TotalCommission?>';
             $('#getTotalCommission').html(total);

             var getTotalBookedSales = '<?=$getTotalBookedSales?>';

             $('#getTotalBookedSales').html(getTotalBookedSales);

             var getFacilitaionFeeCash = '<?=$getFacilitaionFeeCash?>';
             $('#getFacilitaionFeeCash').html(getFacilitaionFeeCash);

             var getFacilitaionFeeCC = '<?=$getFacilitaionFeeCC?>';
             $('#getFacilitaionFeeCC').html(getFacilitaionFeeCC);

             



        } );
    </script>