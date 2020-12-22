<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1>Add Hospital</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
							<li class="breadcrumb-item">Manage Hospitals</li>
                            <li class="breadcrumb-item active" aria-current="page">Add Hospital</li>
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
                            <form class="mb-5" action="<?php echo base_url(); ?>admin/hospital/add_hospita_details" method="post" enctype = "multipart/form-data" novalidate="novalidate">
                               
                                <div class="form-group row">
                                    <label for="userName" class="col-sm-2 col-form-label">UserName</label>
                                    <div class="col-sm-10">
										<input  class="form-control" name="name" id="userName" placeholder="" type="text" min="1" required value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="first_name" id="firstName" placeholder="" type="text" min="1" required value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
										<input class="form-control" name="last_name" id="lastName" placeholder="" type="text" min="1" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emailAddress" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input  class="form-control" name="email" id="emailAddress" placeholder="" type="email" min="1" required value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phoneNo" class="col-sm-2 col-form-label">Phone No</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" name="phone_no" id="phoneNo" placeholder="" type="text" min="1" required value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="gender" id="gender" class="form-control" >
                                            <option  value = "m">Male</option>
                                            <option  value = "f">Female</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Picture</label>
                                    <div class="col-sm-10">
                                        <input  name="picture" id="" class="form-control" style="height: 40px;padding: 7px;"  type="file">
                                        <span style="color:grey;">Allowed only gif|jpg|png|jpeg formats</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                    <select id="country" name="country" required class="form-control">
                                         <option selected value=""> Select Country</option>
                                     <?php 
                                      
                                     foreach($country as $value)
                                     {
                                        
                                    ?>
                                         <option value="<?php echo $value['id'] ?>"> <?php echo $value['country_name'] ?></option>
                                     <?php
                                         
                                     }
                                     ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                  
                                        <select id="state" name="state" class="form-control">
                                     
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input  name="city" id="city" class="form-control"  type="text" value="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" id="address" rows="3"></textarea>
                                    </div>
                                </div>
                            
                         
                                <div class="form-group row">
                                    <label for="cpassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
										<input class="form-control" data-parsley-equalto="#cpassword" name="password" id="cpassword" placeholder="Password" type="password" min="6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
									<input class="form-control" data-parsley-equalto="#password" name="password" id="password" placeholder="Password" type="password" min="6">
                                    </div>
								</div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary mb-0">Add Hospital</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
     <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
    <script>
        $('#country').change(function(){
            var value=$(this).val();
            $.ajax({
                url: "/admin/hospital/get_state_by_country",
                method: "POST",
                data: {value:value},
                success:function(response) {
                   $('#state').html(response);
                }
            })
        });
    </script>