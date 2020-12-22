<main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Facility Details</h1>
                    <div class="separator mb-5"></div>
                </div>
			</div>


            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">


                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Payment Types:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                		<?=$getHospital->payment_types?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Lab:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                		<?=$getHospital->lab_fee?>
                                    </div>
                                </div>



                        <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Hospital/Clinic:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                		<?=$getHospital->hospital_name?>
                                    </div>
                                </div>

                				<div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>View Pic:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <a href="<?=base_url()?>uploads/hospital/<?=$getHospital->pic_area?>" target="_blank">
                                            <img  style="height: 80px; width: 100px;" src="<?=base_url()?>uploads/hospital/<?=$getHospital->pic_area?>">
                                        </a>
                                    
                                    </div>
                                </div>

                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Med. Provider:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <?=$getHospital->hospital_city?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Accredited:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <?=$getHospital->hospital_jci?>
                                    </div>
                                </div>

                                 <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Country / State:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <?=$getHospital->country?> / <?=$getHospital->hospital_state?>
                                    </div>
                                </div>


                                 <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for=""><b>Description:</b> </label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <?=$getHospital->description?>
                                    </div>
                                </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>