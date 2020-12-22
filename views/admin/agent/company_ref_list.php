<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Company Ref.</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url()?>admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Company Ref.</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Company Ref. List</li>
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
                            <!-- <h5 class="card-title">Quote Requests List</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Join Date</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Type</th>
                                        <th>Country</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($getRecord as $data) {
	?>
                                    <tr>
                                        <td><?php echo ucwords($data['username']) ?></td>
                                        <td><?=date('Y-m-d', strtotime($data['created_on']))?></td>
                                        <td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
                                        <td><?php echo ucwords($data['phone_no']) ?></td>
                                        <td><?=$data['company_type']?></td>
                                        <td><?php echo ucwords($data['country']) ?></td>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable();
        } );
</script>