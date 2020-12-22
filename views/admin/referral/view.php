<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                          <h1>Referrals Detail</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/referrals"); ?>">Manage Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Referrals View</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


                </div>
			</div>


            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>ID</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$upcomming->id?></label>
                                    </div>
                                </div>

   <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>User Name</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$upcomming->username?></label>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>First Name</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$upcomming->ref_first_name?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Last Name</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$upcomming->ref_last_name?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Email</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$upcomming->ref_email?></label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Phone No</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$upcomming->ref_phone?></label>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Created Date</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=date('Y-m-d', strtotime($upcomming->ref_created_date));?></label>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>