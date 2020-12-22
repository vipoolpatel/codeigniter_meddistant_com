<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style type="text/css">
        .dtr-data{
            white-space: normal;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>List Doctors</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Doctors</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List Doctors</li>
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
                        <?php if (!empty($doctors_data)) {
	?>
						<table  id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
							<thead>
								<tr>
									<th>Doctor Name</th>
                                    <th>Country</th>
                                    <th>Residency (Hospital)</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Gender</th>
									<th>Image</th>
									<th>Specialties</th>
									<th>Education</th>
									<th>Residency</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
foreach ($doctors_data as $data) {
		?>
							<tr>
								<td><?php echo ucwords($data['name']); ?></td>
                                <td><?php echo ucwords($data['hospital_country']); ?></td>
                                <td><?php echo ucwords($data['residency']); ?></td>
								<td><?php echo ucwords($data['email']); ?></td>
								<td><?php echo $data['phone_no']; ?></td>
								<td><?php echo $data['gender']; ?></td>
								<td> <img src="<?php echo base_url(); ?>upload_dir/doctors_image/<?php echo $data['doctor_image']; ?>" style="height: 80px; width: 100px; overflow: hidden; "> </td>
								<td> <?php echo ucwords($data['specialties']); ?> </td>
								<td><?php echo ucwords($data['education']); ?></td>
								<td><?php echo ucwords($data['residency']); ?></td>
                                <td>
                                        <a data-url="<?php echo base_url(); ?>admin/doctors/delete/<?php echo $data['doctor_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a>
                                </td>

							</tr>
							<?php }} else {?>
								<div style = "color: #ff0002; text-align: center">No Doctor Found </div>
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

</script>
<script type="text/javascript">
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