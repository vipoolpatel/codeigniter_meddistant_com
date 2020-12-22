 <?php
 if(!empty($user_data))
 {
 ?>
 <form action="<?php echo base_url() . 'admin/usa_availability/store_update/' . $user_data['id'] ?>" method="post" enctype="multipart/form-data" >
<?php 
} else { ?>
    <form action="<?= base_url() ?>admin/usa_availability/store_update" method="post" enctype="multipart/form-data" >
<?php
}
?>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">States</label>
    <div class="col-sm-10">

        <input class="form-control" name="states" required value="<?=$user_data['state_name']?>" type="text">

    </div>
</div>

 <div class="form-group row">
    <label class="col-sm-2 col-form-label">Hospitals</label>
    <div class="col-sm-10">
        <select class="form-control" name="hospitals">
            <option <?=($user_data['hospitals'] == '1') ? 'selected' : ''?> value="1">Active</option>
            <option <?=($user_data['hospitals'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
        </select>
        
    </div>
</div>

 <div class="form-group row">
    <label class="col-sm-2 col-form-label">Clinics</label>
    <div class="col-sm-10">
          <select class="form-control" name="clinics">
            <option <?=($user_data['clinics'] == '1') ? 'selected' : ''?> value="1">Active</option>
            <option <?=($user_data['clinics'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
        </select>

        
    </div>
</div>

 <div class="form-group row">
    <label class="col-sm-2 col-form-label">Physicians</label>
    <div class="col-sm-10">
        <select class="form-control" name="physicians">
            <option <?=($user_data['physicians'] == '1') ? 'selected' : ''?> value="1">Active</option>
            <option <?=($user_data['physicians'] == '0') ? 'selected' : ''?> value="0">Inactive</option>
        </select>
    </div>
</div>



<div class="form-group row mb-0 float-right">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary mb-0">Submit</button>
    </div>
</div>
</form>