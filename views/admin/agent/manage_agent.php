<style>
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 100% !important;
    }
    .required {
         color:  red;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Add Agent</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/dashboard"); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url("/admin/agent"); ?>">Manage Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Agent</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


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

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <h5 class="mb-4">Add Agent</h5> -->
                        <form action="<?php echo base_url() . 'admin/agent/manage_agent'; ?>" method="post"
                              enctype="multipart/form-data" >
                            <input type="hidden" name="<?php if (empty($agent_data)) {
                                echo 'add';
                            } else {
                                echo 'edit';
                            }?>" value="1">
                            <input type="hidden" name="edit_id" value="<?php if (!empty($agent_data)) {
                                    echo $agent_data['user_id'];
                                }?>">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">User First Name <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="username" id="inputName" placeholder=""  value="<?=set_value('username');?>" type="text" min="1" required>
                                          <div style="color: red;"><?php echo form_error('username'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">User Last Name <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="last_name" id="inputName" placeholder="" type="text" min="1" required value="<?=set_value('last_name');?>">
                                    <div style="color: red;"><?php echo form_error('last_name'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPhoneNo" class="col-sm-2 col-form-label">Phone No <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="phone_no" id="inputPhoneNo" placeholder="" type="text" min="1" required value="<?=set_value('phone_no');?>">
                                    <div style="color: red;"><?php echo form_error('phone_no'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="email" id="inputEmail" placeholder="" type="email"
                                           min="1" required value="<?=set_value('email');?>">
                                            <div style="color: red;"><?php echo form_error('email'); ?></div>
                                </div>
                            </div>
                            <?php
if ($this->session->userdata('user_type') == 'admin') {?>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Designation All</label>
                                    <div class="col-sm-10" style="margin-top: 10px;">
                                        <input type="checkbox" name="territory">
                                    </div>
                                </div>


                        

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Pay Type</label>
                                    <div class="col-sm-10">
                                        <select name="pay_type" id="" class="form-control" >
                                            <option value="c">Commission</option>
                                            <option value="m">Monthly Pay Commission</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Pay Rate</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="0" name="pay_rate" id="inputEmail" placeholder="" type="number" >
                                            <div style="color: red;"><?php echo form_error('pay_rate'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="commission_rate" class="col-sm-2 col-form-label">Commission Rate</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="0" name="commission_rate"
                                               id="commission_rate"
                                               placeholder="" type="number" >
                                               <div style="color: red;"><?php echo form_error('commission_rate'); ?></div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Agent Type <span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="agent_type" id="" class="form-control" >
                                            <option value="i">Individual</option>
                                            <option value="c">Company</option>
                                        </select>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="row Agent-Company" style="display:none;">
                                <hr>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                     <input class="form-control" name="company_name" id="" placeholder=""
                                               type="text">
                                </div>
                            </div>
                             <hr>
                            </div>

                              <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Country <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <select  name="country" class="form-control ChangeCountry" required>
                                        <option data-val="0" value="">Select Country</option>
                                        <?php
                                        foreach ($getCountry as $value) {
                                            ?>
                                            <option data-val="<?=$value->id?>" value="<?=$value->country_name?>"><?=$value->country_name?></option>
                                            <?php
                                            }

                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">State <span class="required">*</span></label>
                                <div class="col-sm-10" id="getState">
                                    <input name="state" id="" class="form-control statename" type="text" required value="<?=set_value('state');?>">
                                    <div style="color: red;"><?php echo form_error('state'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">City <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input required name="city" id="" class="form-control" type="text" value="<?=set_value('city')?>">
                                    <div style="color: red;"><?php echo form_error('city'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Address <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <textarea required name="address" class="form-control" id="" rows="3"><?=set_value('address')?></textarea>
                                     <div style="color: red;"><?php echo form_error('address'); ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zipcode" class="col-sm-2 col-form-label">Zip Code <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input  name="zipcode" required id="zipcode" class="form-control"  type="text" value="<?=set_value('zipcode')?>">
                                     <div style="color: red;"><?php echo form_error('zipcode'); ?></div>
                                </div>
                            </div>



                            <div class="form-group row hide-company">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Gender <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <select name="gender" required id="" class="form-control">
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tax_id" class="col-sm-2 col-form-label">Tax ID (If USA)</label>
                                <div class="col-sm-10">
                                    <input class="form-control"  value="0" name="tax_id"
                                           id="tax_id"
                                           placeholder="" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Picture</label>
                                <div class="col-sm-10">
                                    <input name="picture" id="" class="form-control" style="height: 40px;padding: 7px;"
                                           type="file">
                                    <span style="color:grey;">Allowed only gif|jpg|png|jpeg formats</span>
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mb-0">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo base_url(); ?>assets/admin_asset/updated/js/vendor/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">

$(document).ready(function(){

    $('#getState').delegate('.statename','change',function(){
            getdatainfo();
    });

    $('#territory').change(function(){
            getdatainfo();
    });


    function getdatainfo(){
        var country_name = $('.ChangeCountry').val();
         var state_name = $('.statename').val();
         var territory = $('#territory').val();
            $.ajax({
                   type:'POST',
                   url:"<?=base_url()?>admin/agent/GeneralAgentAssign",
                   data: {country_name: country_name,state_name:state_name,territory:territory},
                   dataType: 'JSON',
                   success:function(data){
                        if(data.success == false)
                        {
                            alert('Other agent already assigned this information.');
                        }
                   }
            });
    }


    $('.ChangeCountry').change(function(){
            getState();
            getdatainfo();
        });

        function getState()
        {
            var country_id = $('.ChangeCountry option:selected').attr('data-val');
            $.ajax({
                   type:'POST',
                   url:"<?=base_url()?>admin/agent/getStateAgent",
                   data: {country_id: country_id},
                   dataType: 'JSON',
                   success:function(data){
                        $('#getState').html(data.success);
                   }
            });

        }
    });





</script>
