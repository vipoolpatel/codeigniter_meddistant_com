<main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Testimonial List</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="/admin/Dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Manage Testimonial</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Testimonial List</li>
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
									<th>#</th>
									<th>Name</th>
									<th>Rating</th>
                                    <th>City</th>
									<th>Country</th>
									<th>Description</th>
									<th>Status</th>
									<th>Created Date</th>
                                    <th>Picture</th>
									<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($getRecord as $value) {
	?>
									<tr>
										<td><?=$value->id?></td>
										<td><?=$value->first_name?> <?=$value->last_name?></td>
										<td><?=$value->rating?></td>
                                        <td><?=$value->city?></td>
										<td><?=$value->country?></td>
										<td><?=$value->description?></td>


									 <td>
<select style="width:100px;" class="form-control ChangeStatus" data-table="testimonial" id="<?=$value->id?>"  >
<option value="1" <?=($value->status == '1') ? 'selected' : ''?>>Active </option>
<option value="0" <?=($value->status == '0') ? 'selected' : ''?>>Inactive </option>
</select>

</td>

 <td><?=date('m-d-Y', strtotime($value->created_date));?></td>

  <td>
                                        <?php
if (!empty($value->picture)) {
		?>
 <img src="<?=base_url()?>uploads/customer/<?=$value->picture?>" style="width: 113px;" alt="">

<?php
} else {
		?>
 <img src="<?=base_url()?>assets/admin_asset/updated/img/profile-pic-l.jpg" style="width: 113px;" alt="">

<?php
}
	?>
                                        </td>


										<td style="text-align:center;">
                                            <div class="btn-group">
												<a data-url="<?=base_url()?>admin/testimonial/delete/<?=$value->id?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;

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

$(document).ready(function(){

	 $('.ChangeStatus').change(function(){
            var status = $(this).val();
            var id = $(this).attr('id');
            var table = $(this).attr('data-table');
            $.ajax({
                type:'POST',
                url:"<?=base_url()?>admin/testimonial/ChangeStatus",
                data: {status:status,id:id,table:table},
                dataType: 'JSON',
                success:function(data){
                    alert('Status successfully changed.');
                }
            });
    });
});
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-list').DataTable({
                "order": [[ 0, "desc" ]]
            });
        } );
    </script>