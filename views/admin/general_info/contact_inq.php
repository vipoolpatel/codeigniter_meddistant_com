   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Contacts us Inquiries</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact us Inquiries</li>
                        </ol>

                    </nav>

                    <div class="separator mb-4">

                    </div>
 <a href="<?=base_url()?>admin/general_info/add_contact_us_inquiries" class="btn btn-primary">Add New Contact</a>


   <a href="<?=base_url()?>admin/general_info/add_contact_us_inquiries_upload_excel" class="btn btn-primary">Upload Excel</a>

 <br>
 <br>

                </div>
            </div>


			<div class="col-12">
				<?php if ($this->session->flashdata('error')) {?>
				<div class="alert alert-danger alert-dismissible fade show rounded">
					<?php echo $this->session->flashdata('error'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }?>
				<?php if ($this->session->flashdata('success')) {?>
					<div class="alert alert-success alert-dismissible fade show rounded">
						<?php echo $this->session->flashdata('success'); ?>
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
                            <!-- <h5 class="card-title">Schedule Calls</h5> -->

                            <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                         <th>#</th>
                                        <th>Date</th>
										<th>Name</th>

										<th>Email</th>
                                        <th>Phone</th>
										<th>Subject</th>
                                        <th>Status</th>
                                        <th>Type</th>
										<th>Note</th>
                                                                                <?php
if ($this->session->userdata('user_type') == 'admin') {
	?>
                                        <th>Assign Agent</th>
                                        <?php }
?>
										<th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
									<?php
foreach ($contact_inq_data as $data) {

	$cehckQR = $this->db->where('email', $data['email']);
	$cehckQR = $this->db->where('assigned_agent', $data['agent_id']);
	$cehckQR = $this->db->get('tbl_quote_request')->num_rows();
	?>
									<tr>
                                        <td><?=$data['id']?></td>
                                         <td><?php echo date('d M, Y', strtotime($data['contact_date'])); ?></td>
										<td><?php echo ucwords($data['full_name']) ?></td>

										<td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
										<td><?php echo ucwords($data['phone']) ?></td>
                                        <td><?php echo ucwords($data['subject']) ?></td>
                                        <td><?=!empty($cehckQR) ? 'Yes QR' : 'No QR'?></td>
                                        <td><?php echo ucwords($data['type']) ?></td>
		<td><?php echo ucfirst($data['message']) ?></td>

                                                                                <?php
if ($this->session->userdata('user_type') == 'admin') {
		?>
             <td style="width: 20%">

        <select name="admin_id"  class="form-control"  onchange="change_status_contact(this.value, <?php echo $data['id']; ?>)">
        <option value="">Select Agent</option>

            <?php
foreach ($getAgent as $agent) {
			?>
<option value="<?php echo $agent['user_id']; ?>" <?=($data['agent_id'] === $agent['user_id']) ? 'selected' : ''?>> (<?php echo ucfirst($agent['email']); ?>) </option>
                    <?php
}
		?>
        </select>
    </td>
      <?php }
	?>



										<td>
<a style="margin-top:3px;" href="<?=base_url()?>admin/general_info/edit_contact_us_inquiries/<?php echo $data['id'] ?>" title="Detail"><i class="simple-icon-pencil d-block"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <?php
if ($this->session->userdata('user_type') == 'admin') {
		?>
                                            <a data-url = "<?php echo base_url(); ?>admin/general_info/dlt_contact_inq/<?php echo $data['id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                            <?php }
	?>
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





function change_status_contact(agent_id,id) {
    $.ajax({
        type: 'post',
        url: '<?=base_url();?>admin/general_info/assign_agent_general',
        data: {
            "agent_id": agent_id,
            "id": id,
        },
        success: function (data) {
            alert("Agent Successfully Assign!!");
        }
    });
}


</script>

<script type="text/javascript">
        $(document).ready(function() {
              $('#datatable-list').DataTable( {
                 "order": [[ 0, "desc" ]]
           } );


            
        } );
</script>
