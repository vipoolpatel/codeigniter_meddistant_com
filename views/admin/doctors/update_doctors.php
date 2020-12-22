
<div >
<div class="">
    <div class="">
        
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Manage Doctor</h4>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        
        <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('error_message'); ?></span>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('success_message'); ?></span>
            </div>
        <?php } ?>
        
        <div class="row">
            <div class="col-sm-12">
                
                <?php $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart('manage_doctors/manage_doctor', $attributes); ?>
                
                <input type="hidden" name="<?php if (empty($doctor_data)) {
                    echo 'add';
                } else {
                    echo 'edit';
                } ?>" value="1">
                <input type="hidden" name="edit_id" value="<?php if (!empty($doctor_data)) {
                    echo $doctor_data['doctor_id'];
                } ?>">
                
                <div class="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-10 control-label">Doctor Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="name" id="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['name'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Phone Number</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="phone_no" id="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['phone_no'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                    <!--        <div class="form-group">
                                <label class="col-md-10 control-label">doctor Description:</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="doctor_desc"><?php /*if (!empty($doctor_data)) {
                                            echo $doctor_data['doctor_desc'];
                                        } */?></textarea>
                                </div>
                            </div>-->
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Language Spoken</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="language_spoken" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['language_spoken'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            
                            
                        
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="col-lg-6">
                            <div class="form-group mt-1">
                                <label class="col-md-10 control-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="email" id="" placeholder="" type="email" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['email'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-10 control-label">Gender</label>
                                <div class="col-sm-10">
                                    <select name="gender"  required class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label class="col-md-10 control-label">Doctor Image</label>
                                <div class="col-md-10">
                                    <input  name="doctor_image" id=""  type="file"  required>
                                </div>
                            </div>
                        
                        </div>
                    </div><!-- end row -->
                    
                    <hr>
                    

                  <?php  $specialties = explode(',', $doctor_data['specialties']); ?>

                    <h4 class="header-title m-t-0 m-b-30">Specialities </h4>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox4" name="specialties[]" value="liposuction" <?php if (!empty($doctor_data) && in_array('liposuction', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox4"> liposuction </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox9" name="specialties[]" value="Breast Reduction" <?php if (!empty($doctor_data) && in_array('Breast Reduction', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox9"> Breast Reduction </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox15" name="specialties[]" value="Ear Surgeries" <?php if (!empty($doctor_data) && in_array('Ear Surgeries', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox15">Ear Surgeries </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox19" name="specialties[]" value="Sleeve Gastrectomy" <?php if (!empty($doctor_data) && in_array('Sleeve Gastrectomy', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox19">Sleeve Gastrectomy </label>
                                    </span>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox5" name="specialties[]" value="Tummy Tuck" <?php if (!empty($doctor_data) && in_array('Tummy Tuck', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox5"> Tummy Tuck </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                            
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox10" name="specialties[]" value="Breasts augmentation" <?php if (!empty($doctor_data) && in_array('Breasts augmentation', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox10"> Breasts augmentation </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox16" name="specialties[]" value="(Nose job) Rhinoplasty" <?php if (!empty($doctor_data) && in_array('(Nose job) Rhinoplasty',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox16"> (Nose job) Rhinoplasty </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                            <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox20" name="specialties[]" value="Adjustable Gastric Band" <?php if (!empty($doctor_data) && in_array('Adjustable Gastric Band',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox20"> Adjustable Gastric Band </label>
                                    </span>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            
                                
                            
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox6" name="specialties[]" value="Beard hair transplant" <?php if (!empty($doctor_data) && in_array('Beard hair transplant',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox6"> Beard hair transplant </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                            
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox11" name="specialties[]" value="Facelift Procedures" <?php if (!empty($doctor_data) && in_array('Facelift Procedures',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox11"> Facelift Procedures </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                                
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox17" name="specialties[]" value="(Eye lid Surgery) Blepharoplasty" <?php if (!empty($doctor_data) && in_array('(Eye lid Surgery) Blepharoplasty',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox17"> (Eye lid Surgery) Blepharoplasty </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                                <span class="checkbox checkbox-success checkbox-inline ">
                                        <input type="checkbox" id="inlineCheckbox21" name="specialties[]" value="Biliopancreatic Diversion with Duodenal Switch (BPD/DS)" <?php if (!empty($doctor_data) && in_array('Biliopancreatic Diversion with Duodenal Switch (BPD/DS)',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox21"> Biliopancreatic Diversion with <br>Duodenal Switch (BPD/DS) </label>
                                    </span>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox7" name="specialties[]" value="Brazilian butt lift" <?php if (!empty($doctor_data) && in_array('Brazilian butt lift',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox7"> Brazilian butt lift </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                            
                                <span class="checkbox checkbox-success checkbox-inline ">
                                        <input type="checkbox" id="inlineCheckbox12" name="specialties[]" value="Forehead Lift" <?php if (!empty($doctor_data) && in_array('Forehead Lift',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox12"> Forehead Lift </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox18" name="specialties[]" value="Gastric Bypass" <?php if (!empty($doctor_data) && in_array('Gastric Bypass',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox18"> Gastric Bypass </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                            <span class=" checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox22" name="specialties[]" value="Root Canal Treatment" <?php if (!empty($doctor_data) && in_array('Root Canal Treatment',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox22">Root Canal Treatment </label>
                                    </span>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                                
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox8" name="specialties[]" value="Breast lift" <?php if (!empty($doctor_data) && in_array('Breast lift',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox8"> Breast lift </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                            
                                
                        
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox13" name="specialties[]" value="Hair transplant" <?php if (!empty($doctor_data) && in_array('Hair transplant',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox13"> Hair transplant </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox23" name="specialties[]" value="Installation of a dental implant" <?php if (!empty($doctor_data) && in_array('Installation of a dental implant',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox23"> Installation of a dental implant </label>
                                    </span>
                        
                        </div>
                        
                        <div class="col-sm-6">
                                    <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox24" name="specialties[]" value="Crowns" <?php if (!empty($doctor_data) && in_array('Crowns',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox24"> Crowns </label>
                                    </span>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                                
                                <span class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox25" name="specialties[]" value="Veneers" <?php if (!empty($doctor_data) && in_array('Veneers', $specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox25"> Veneers </label>
                                    </span>
                        </div>
                        
                        <div class="col-sm-6">
                            
                                
                                
                                <span class="checkbox checkbox-success checkbox-inline ">
                                        <input type="checkbox" id="inlineCheckbox26" name="specialties[]" value="Other Treatment" <?php if (!empty($doctor_data) && in_array('Other Treatment',$specialties)) { ?> checked <?php } ?>>
                                        <label for="inlineCheckbox26"> Other Treatment </label>
                                    </span>
                        
                        </div>
                    
                    </div>
                    
                    
                    
                    
                    
                    <hr>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-10 control-label">Years in Speciality</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="specialty_years" id="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['specialty_years'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Residency</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="residency" id="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['residency'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Board Certified or Eligible in</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="board_certified" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['board_certified'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">License Number</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="license_number" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['license_number'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">About doctor <span style="font-size: 10px">(description about the doctor in less than 100 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" maxlength="100" name="about_doctor"><?php if (!empty($doctor_data)) {
                                            echo $doctor_data['about_doctor'];
                                        } ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Training <span style="font-size: 10px">(in less than 50 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" maxlength="50" name="training"><?php if (!empty($doctor_data)) {
                                            echo $doctor_data['training'];
                                        } ?></textarea>
                                </div>
                            </div>
                        
                        
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="col-lg-6">
                            <div class="form-group mt-1">
                                <label class="col-md-10 control-label">Education</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="education" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['education'];
                                    } ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-10 control-label">Board Credentials</label>
                                <div class="col-md-10">
                                    <span class="col-md-4 radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio0" value="Board Certified" name="board_credential" <?php if (!empty($doctor_data) && $doctor_data['board_credential'] === 'Board Certified') { ?> checked <?php } ?> >
                                        <label for="inlineRadio0"> Board Certified </label>
                                    </span>
                                    <span class="col-md-4 radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio00" value="Board Eligible" name="board_credential" <?php if (!empty($doctor_data) && $doctor_data['board_credential'] === 'Board Eligible') { ?> checked <?php } ?>>
                                        <label for="inlineRadio00"> Board Eligible  </label>
                                    </span><br>
                                    <span class="col-md-4 radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio001" value="Other Certification" name="board_credential" <?php if (!empty($doctor_data) && $doctor_data['board_credential'] === 'Other Certification') { ?> checked <?php } ?>>
                                        <label for="inlineRadio001"> Other Certification </label>
                                    </span>
                                </div>
                            </div>
                            
                            <br><br>
                            
                            <div class="form-group mt-4">
                                <label class="col-md-10 control-label">License country</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="license_country" id="" placeholder="" type="text" value="<?php if (!empty($doctor_data)) {
                                        echo $doctor_data['license_country'];
                                    } ?>" required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-md-10 control-label">Professional Associations  <span style="font-size: 10px">(in less than 50 words) </span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" maxlength="50" name="professional_association"><?php if (!empty($doctor_data)) {
                                            echo $doctor_data['professional_association'];
                                        } ?></textarea>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div><!-- end row -->
                    
                    <div class="form-group row mb-0 float-right">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mb-0">Update</button>
                        </div>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            
            </div><!-- end col -->
        </div>
    
    </div> <!-- end container -->

</div>         
</div>