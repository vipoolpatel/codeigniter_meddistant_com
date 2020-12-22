<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Upload Excel</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
							<li class="breadcrumb-item"><a href="<?php echo base_url("/admin/general_info/contact_inq"); ?>">Contact us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Contact Upload Excel</li>
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

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
							<!-- <h5 class="mb-4">Edit Profile</h5> -->
                         <form action="" method="post" enctype="multipart/form-data" >

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">CSV or Excel File <span class="required" style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" style="margin-bottom: 10px;" name="result_file"  type="file"  required>
                                    <a style="color: blue;" href="<?=base_url()?>uploads/contact-inq-date.csv">Download Demo Excel File</a>
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Send</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
