<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
         <div class="row">
            <div class="col-12">
                <h1>Referrals List</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Referrals</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Referrals</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Referrals List</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>

                <a href="<?=base_url()?>admin/agent/add_referral" style="float: right;" class="btn btn-primary">Add New Referral</a>


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
						<table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                               <thead>
                                    <tr>

                                        <th>Referring Co.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($getRecord as $value) {
	?>
                                    <tr>

                                        <td><?=$value->username?></td>
                                        <td><?=$value->ref_first_name?></td>
                                        <td><?=$value->ref_last_name?></td>
                                        <td><?=$value->ref_email?></td>
                                        <td><?=$value->ref_phone?></td>
                                        <td>
                                            <?=date('m-d-Y', strtotime($value->ref_created_date));?>
                                        </td>

                                         <td style="text-align:center;">
                                            <div class="btn-group">
                                                <?php
                                                if($this->session->userdata('user_type') == 'admin') {
                                                ?>
                                                 <a data-url="<?=base_url()?>admin/referrals/delete/<?=$value->id?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                             <?php }
                                             ?>

                                                 <a style="margin-top:3px;" href="<?=base_url()?>admin/referrals/view/<?=$value->id?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>

                                                 
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
}
?>
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
            $('#datatable-list').DataTable({
                "order": [[ 5, "desc" ]]
            });
        } );
</script>