<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Facility Details</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Facility Details</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List Facility</li>
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
                        <!-- <h5 class="card-title">List Facility</h5> -->
                        <?php if (!empty($facility_data)) { ?>
                            <table class="data-table data-table-standard">
                                <thead>
                                    <tr>
                                        <th>Facility Name</th>
                                        <th>Facility Description</th>
                                        <th>Operation Years</th>
                                        <th>Surgeons</th>
                                        <th>License Number</th>
                                        <th>License Country</th>
                                        <th>Payment Types</th>
                                        <th>Lab Fees</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

									foreach($facility_data as $data) {
									?>
                                        <tr>
                                            <td>
                                                <?php echo ucwords($data['facility_name']); ?>
                                            </td>
                                            <td>
                                                <?php echo ucwords($data['facility_desc']); ?>
                                            </td>
                                            <td>
                                                <?php echo $data['operation_years']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['total_surgeons']; ?>
                                            </td>
                                            <td><span class="text-danger"><?php echo $data['license_number']; ?></span></td>
                                            <td>
                                                <?php echo ucwords($data['license_country']); ?>
                                            </td>
                                            <td>
                                                <?php echo ucwords($data['payment_types']); ?>
                                            </td>
                                            <td>
                                                <?php echo ucwords($data['lab_fee']); ?>
                                            </td>

                                        </tr>
                                        <tbody>
                                            <?php
											$facility_id = $data['facility_id'];
											$user_id = $this->session->userdata('user_id');
											$facility_procedure = $this->common_model->get_tbl_data('facility_procedure', '*', array('id_facility' => $facility_id, 'id_tbl_user' => $user_id), '', 'created_on DESC');
											?>
											<?php if (!empty($facility_data)) { ?>
												<tr>
													<td colspan="8">
														<h3 class="text-success mt-5">Your Treatment Procedures</h3></td>
												</tr>
												<?php
												$i = 1;
												foreach ($facility_procedure as $procedure) { ?>
												<tr>
													<td>
														<?php echo $i++; ?>
													</td>
													<td colspan="3"><b><?php echo ucfirst($procedure['procedure_name']); ?></b></td>
												</tr>
												<?php } ?>
												<?php } else { ?>
												<tr>
													<td colspan="8">
														<h4 class="text-danger mt-5">No Treatment Procedures Found Please <a href="<?php echo base_url(); ?>manage_facility/manage_facility">Click here to add.</a></h4></td>
												</tr>
												<?php } ?>
												<?php } } else { ?>
													<div style="color: #ff0002; text-align: center">No Facility Data Found, Please <a href="<?php echo base_url(); ?>manage_facility/manage_facility">Add your Facility.</a> </div>
												<?php } ?>
                                		</tbody>
                            </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>