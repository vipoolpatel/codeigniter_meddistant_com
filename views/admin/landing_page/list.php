<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Landing Page</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("admin/dashboard"); ?>">Dashboard</a>
                            </li>
						    <li class="breadcrumb-item active" aria-current="page">Landing Page</li>
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

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
						 <form action="" method="post" enctype="multipart/form-data" >
                               
                            
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title <span style="color: red;"> *</span></label>
                                    <div class="col-sm-10">
										<input class="form-control" name="title" value="<?=$getdata->title?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description  <span style="color: red;"> *</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control"  name="description" rows="10"><?=$getdata->description?></textarea>
                                    </div>
                                </div>
                               
                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    