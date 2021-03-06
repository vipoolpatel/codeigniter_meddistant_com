<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="container-fluid">
         <div class="row">
            <div class="col-12">
                <h1>Treatment List</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Treatment </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Treatment List</li>
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
                        <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                               <thead>
                                    <tr>
                                       <th>Treatment Name </th>
									   <th>Order By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($getRecord as $value) {
	?>
                                    <tr>

                                        <td><?=$value->treatment_name?></td>
										<td><?=$value->order_by_data?></td>


                                         <td style="text-align:center;">
                                            <div class="btn-group">
    <a style="margin-top:3px;" href="<?=base_url()?>admin/treatment/edit/<?=$value->id?>" title="Detail"><i class="simple-icon-pencil d-block"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <a data-url="<?=base_url()?>admin/treatment/delete/<?=$value->id?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;


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
            $('#datatable-list').DataTable();
        } );
</script>