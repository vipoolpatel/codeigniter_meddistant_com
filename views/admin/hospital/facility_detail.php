<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Hospital Detail</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">Manage Hospitals</li>
                  <li class="breadcrumb-item active" aria-current="page">Hospital Detail</li>
               </ol>
            </nav>
            <div class="separator mb-5"></div>
         </div>
      </div>
      <div class="row mb-4">
         <div class="col-12 mb-4">
            <div class="card">
               <div class="card-body">
                  <!-- <h5 class="card-title">List Agent</h5> -->
                  <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                     <thead>
                        <tr>
                           <th>Hospital Pic</th>
                           <th>Hospital Name</th>
                           <th>Hospital City</th>
                           <th>Hospital JCI</th>
                           <th>Created Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           if (!empty($getHospital)) {
                            foreach ($getHospital as $value) {
                                ?>
                        <tr>
                           <td>
                              <?php
                                 if (!empty($value->pic_area)) {
                                            ?>
                              <img src="<?php echo base_url(); ?>uploads/hospital/<?=$value->pic_area?>" style="height: 80px; width: 100px; overflow: hidden; ">
                              <?php }?>
                           </td>
                           <td><?=$value->hospital_name?></td>
                           <td><?=$value->hospital_city?></td>
                           <td><?=$value->hospital_jci?></td>
                           <td>
                              <?=date('d-m-Y h:i A', strtotime($value->created_date));?>
                           </td>
                        </tr>
                        <?php }
                           } else {?>
                        <tr>
                           <td colspan="100%">No hospital found.</td>
                        </tr>
                        <?php }
                           ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <?php if (!empty($getUser)) {?>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-body">
                  <div class="form-group row">
                     <label for="userName" class="col-sm-2 col-form-label"><b>Payment Types</b></label>
                     <div class="col-sm-10">
                        <label for="userName" class="col-sm-2 col-form-label">
                        <?=ucfirst($getUser->payment_types)?></label>
                     </div>
                  </div>
                  <hr />
                  <div class="form-group row">
                     <label for="userName" class="col-sm-2 col-form-label"><b>Lab Fee</b></label>
                     <div class="col-sm-10">
                        <label for="userName" class="col-sm-2 col-form-label">
                        <?=ucfirst($getUser->lab_fee)?></label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php }?>
   </div>
   <div class="row mb-4">
      <div class="col-12 mb-4">
         <div class="card">
            <div class="card-body">
               <h4 class="header-title m-t-0 m-b-30">For what kind of procedure provided</h4>
               <br>
               <div class="form-row">
                  <?php
                     foreach ($getTreatment as $value) {
                        $checked = '';
                        if (!empty($facility_procedure)) {
                            foreach ($facility_procedure as $procedure) {
                                if ($procedure->procedure_name == $value->id) {
                                    $checked = 'checked';
                                }
                            }
                        }
                        ?>
                  <div class="form-group col-md-3">
                     <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="checkbox" readonly disabled id="inlineCheckboxT<?=$value->id?>" value="<?=$value->id?>" <?=$checked?> >
                        <label class="form-check-label" for="inlineCheckboxT<?=$value->id?>"><?=$value->treatment_name?></label>
                     </div>
                  </div>
                  <?php }
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>



      <div class="row mb-4">
      <div class="col-12 mb-4">
         <div class="card">
            <div class="card-body">
               <label><b>Medical Provider Descriptive Picture </b></label>
               <br />
                   <?php
               if(!empty($getUser->medical_provider_picture))
               { ?>
                   <a href="<?=base_url()?>assets/provider_picture/<?=$getUser->medical_provider_picture?>" target="_blank"><img style="height: 200px;" src="<?=base_url()?>assets/provider_picture/<?=$getUser->medical_provider_picture?>"> </a>
                <?php
               }
               ?>
                <br />
                <br />

                <label><b>Medical Provider Description</b> </label>
                <br />
                <?=$getUser->about_us?>

            </div>
         </div>
      </div>
   </div>


   



</main>
