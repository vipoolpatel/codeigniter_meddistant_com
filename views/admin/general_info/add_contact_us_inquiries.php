<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Add Contact us Inquiries</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                            </li>
							<li class="breadcrumb-item"><a href="<?php echo base_url("/admin/general_info/contact_inq"); ?>">Contact us Inquiries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Contact us Inquiries</li>
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
                                    <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="first_name" value="<?=set_value('first_name');?>"  type="text" min="1">
                                         <div class="error"><?php echo form_error('first_name'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="last_name" type="text" min="1" value="<?=set_value('last_name');?>">
                                         <div class="error"><?php echo form_error('last_name'); ?></div>
                                    </div>
                                </div>

        <div class="form-group row">
            <label for="emailAddress" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input  class="form-control" name="email" type="email" min="1" value="<?=set_value('email');?>">
             <div class="error" style="color: red;"><?php echo form_error('email'); ?></div>
            </div>
        </div>

 <div class="form-group row">
            <label for="phoneNo" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
            <input class="form-control" name="phone" type="text" min="1" value="<?=set_value('phone');?>">
            <div class="error"><?php echo form_error('phone'); ?></div>
            </div>
        </div>

                                <div class="form-group row">
                                    <label for="phoneNo" class="col-sm-2 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" name="subject" type="text" min="1" value="<?=set_value('subject');?>">
                                    <div class="error"><?php echo form_error('subject'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phoneNo" class="col-sm-2 col-form-label">Note </label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" min="1" name="message" type="text"><?=set_value('message');?></textarea>
                                    <div class="error"><?php echo form_error('message'); ?></div>
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
