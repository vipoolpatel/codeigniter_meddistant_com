<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>List Hospitals</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Hospitals</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List Hospitals</li>
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
                        <!-- <h5 class="card-title">List Doctors</h5> -->
                        <?php if (!empty($hospital_data)) {
	?>
						<table  id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
							<thead>
								<tr>
									<th>Image</th>
									<th>Hospital Name</th>
									<th>Hospital City</th>
                                    <th>State/Province </th>
									<th>Hospital JCI</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
foreach ($hospital_data as $data) {
		?>
							<tr>
                                <td>


     <img src="<?php echo base_url(); ?>uploads/hospital/<?php echo $data['pic_area']; ?>" style="height: 80px; width: 100px; overflow: hidden; ">

                           </td>
								<td><?php echo ucwords($data['hospital_name']); ?></td>
								<td><?php echo ucwords($data['hospital_city']); ?></td>
                                <td><?php echo ucwords($data['hospital_state']); ?></td>
								<td><?php echo ucwords($data['hospital_jci']); ?></td>
								<td>
                                     <a style="margin-top:3px;" href="<?=base_url()?>manage_facility/edit_hospitals/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-pencil d-block"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <a data-url = "<?php echo base_url(); ?>manage_facility/delete_hospitals/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                </td>

							</tr>
							<?php }} else {?>
								<div style = "color: #ff0002; text-align: center">No Hospital Found </div>
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
            $('#datatable-list').DataTable();
        } );
    </script>
