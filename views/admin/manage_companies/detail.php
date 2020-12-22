<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                          <h1>Company Detail</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/manage_companies"); ?>">Manage Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Detail</li>
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
                                    <label  class="col-sm-2 col-form-label"><b>First Name</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$getRecord->first_name?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Last Name</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$getRecord->last_name?></label>
                                    </div>
                                </div>

                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Company Name</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$getRecord->username?></label>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Email</b></label>
                                    <div class="col-sm-10">
                                        <label  class="col-form-label"><?=$getRecord->email?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Phone No</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->phone_no?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Stree Address</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->address?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Country</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->country?></label>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>State/Province</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->state?></label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>City</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->city?></label>
                                    </div>
                                </div>


<div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Postal/Zip Code</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->zipcode?></label>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Company Type</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->company_type?></label>
                                    </div>
                                </div>











                                 <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Company Description</b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->company_description?></label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Est. Employees or Referral pool </b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->enter_number?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Self Insured Employer </b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->self_insured_employer?></label>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label"><b>Do you offer incentives for employees to travel aboard of trearment </b></label>
                                    <div class="col-sm-10">
                                        <label class="col-form-label"><?=$getRecord->employees_travel?></label>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>