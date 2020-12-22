<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Add Search Engine Optimization</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
							<li class="breadcrumb-item"><a href="<?php echo base_url("/admin/search_engine_optimization"); ?>">Search Engine Optimization</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Search Engine Optimization</li>
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
							<!-- <h5 class="mb-4">Edit Profile</h5> -->
                         <form action="" method="post" enctype="multipart/form-data" >
                               
                                <div class="form-group row">
                                    <label for="url" class="col-sm-2 col-form-label">URL <span style="color: red;"> *</span></label>
                                    <div class="col-sm-10">
										<input class="form-control" name="slug" required type="text" min="1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meta_title" class="col-sm-2 col-form-label">Meta Title <span style="color: red;"> *</span></label>
                                    <div class="col-sm-10">
										<input required class="form-control" name="meta_title" type="text" min="1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" min="1" name="meta_description" type="text"></textarea>
                                    </div>
                                </div>
                                   <div class="form-group row">
                                    <label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword <span style="color: red;"> *</span></label>
                                    <div class="col-sm-10">
                                    <textarea required class="form-control" min="1" name="meta_keyword" type="text"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Add SEO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    