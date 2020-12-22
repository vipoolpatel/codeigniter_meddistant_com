<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                	<?php
                	if ($getInvoice['type'] == 'Treatment') {
                	?>
                    <h1>Booking Detail</h1>
                	<?php }
                	else {	 ?>
                	<h1>Payment Details</h1>
               		<?php } ?>


                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Quotes Received by Facility</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Invoice Detail</li>
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
                        <h5>
                        	<a class="btn btn-primary mb-0" href="<?=base_url()?>customer_checkout/checkout_detail_pdf/<?=$getInvoice['checkout_id']?>" >PDF Download</a>
                        	<br /><br />
                        </h5>

                        	<div class="form-row">
	                            <div class="form-group col-md-12">
	                                   <img style="max-width: 250px;" src="<?=base_url()?>assets/admin_asset/updated/img/logo-black.jpg" />

									<label style="display: block;margin-top: 15px;">
	                                 	<p style="font-weight: bold;"> Meddistant Care Team</p>
										<p style="font-weight: bold;"> USA & Canada +1888 9699959</p>
										<p style="font-weight: bold;"> Worldwide  +1312 8899105 </p>
										<p style="font-weight: bold;"> Turkey +90 (541)9473789 </p>
										<p style="font-weight: bold;"> care@meddistant.com</p>
									</label>

	                            </div>
	                        </div>

                    		<div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Name :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['first_name']?> <?=$getInvoice['last_name']?>
	                            </div>
	                        </div>

                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>QR No. :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['request_no']?>
	                            </div>
	                        </div>


 								<div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b> Hospital/Clinic :</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                    <?=$getInvoice['hospital_clinic']?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Treatment :</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                    <?=$getInvoice['treatment_name']?>
                                    </div>
                                </div>

<?php
if ($getInvoice['type'] == 'Treatment') {
?>

								<div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Country :</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                    <?=$getHospital['country']?>
                                    </div>
                                </div>

<?php
}?>


                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Service :</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                    <?=$getInvoice['service_name']?>
                                    </div>
                                </div>


							 <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b><?=($getInvoice['type'] != 'Service') ? 'Message/Proposed treatment' : 'Proposed Service'?> :</b></label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <?=$getInvoice['message']?>
                                    </div>
                                </div>

                            <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Payment Date :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=date('m-d-Y', strtotime($getInvoice['payment_date']))?>
	                            </div>
	                        </div>

	                          <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Payment Type :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['payment_type']?>
	                            </div>
	                        </div>

                       		     <?php
if ($getInvoice['type'] == 'Treatment') {
	?>

	                    	<div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Treatment Date :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['schedule_treatment']?>
	                            </div>
	                        </div>


	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Total ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=!empty($getInvoice['total_checkout_price']) ? number_format($getInvoice['total_checkout_price'], 2) : '0'?>
	                            </div>
	                        </div>


	                        <?php
if (!empty($getInvoice['companion_name'])) {
		?>
	                         <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Companion Name :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['companion_name']?>
	                            </div>
	                        </div>
	                        <?php }
	?>


	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Meddistant will arrange your hotel accommodations :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=!empty($getInvoice['accommodation']) ? 'Yes' : 'No'?>
	                            </div>
	                        </div>
<?php
if (!empty($getInvoice['hotel_accommodation'])) {
		?>
	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Hotel Accommodation for <?=$getInvoice['total_stay_day']?> Days :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                            	<?php
if ($getInvoice['hotel_accommodation'] == 100) {
			echo "3 or 4 Star Hotel ($100/day)";
		} else if ($getInvoice['hotel_accommodation'] == 140) {
			echo "5 Star Hotel ($140/day)";
		} else if ($getInvoice['hotel_accommodation'] == 94) {
			echo "3 or 4 Star Hotel ($94/day)";
		} else if ($getInvoice['hotel_accommodation'] == 127) {
			echo "5 Star Hotel ($127/day)";
		} else {
			echo "4/5 Star Hotel ($" . $getInvoice['hotel_accommodation'] . "/day)";
		}
		?>

	                            </div>
	                        </div>
	                        <?php }
	?>

	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Flight/Travel to Destination :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?=$getInvoice['travel_accommodation']?>
	                            </div>
	                        </div>

<?php
if (!empty($getInvoice['hotel_accommodation'])) {
		?>
	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Hotel ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                                    <?php
$hotel = $getInvoice['hotel_accommodation'] * $getInvoice['total_stay_day'];
		echo number_format($hotel, 2);
		?>
	                            </div>
	                        </div>
	                        <?php }
	?>



	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Promotion ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                            		<?php
	                            		if($getInvoice['accommodation_promotion'] == '0')
	                            		{
	                            			echo "Free one day guided tour";
	                            		}
	                            		else
	                            		{
	                            			if(!empty($getInvoice['accommodation_promotion']))	
	                            			{
                            					echo "$50 Off ($50 for one day)";
	                            			}
	                            		}
	                            		?>
	                            </div>
	                        </div>





                            <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Discount ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                            <?=!empty($getInvoice['total_discount']) ? number_format($getInvoice['total_discount'], 2) : '0'?>
	                            </div>
	                        </div>

<?php }
?>

	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Paid Amount ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                            <?=!empty($getInvoice['checkout_price']) ? number_format($getInvoice['checkout_price'], 2) : '0'?>

	                            </div>
	                        </div>
                       		     <?php
if ($getInvoice['type'] == 'Treatment') {?>


							<?php
							if(!empty($getInvoice['facilitation_fees']))
							{
							?>

							<div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Paid Amount Facilitation <?=!empty($getInvoice['facilitation_fee_cash']) ? '(Cash)' : ''?> ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                              		<?=number_format($getInvoice['facilitation_fees'],2)?>
	                            </div>
	                        </div>

		                    <?php }
		                    ?>



	                        <div class="form-row">
	                            <div class="form-group col-md-2">
	                                <label for=""><b>Remaining Payment at Hospital/Clinic ($) :</b> </label>
	                            </div>
	                            <div class="form-group col-md-10">
	                              <?=!empty($getInvoice['remaining_payment']) ? number_format($getInvoice['remaining_payment'], 2) : '0'?>
	                            </div>
	                        </div>
<?php }
?>




                        </div>

                    </div>
                </div>
            </div>


        </div>
	</main>