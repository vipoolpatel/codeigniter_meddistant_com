<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

						<h1>Testimonial</h1>

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
							</li>
							<li class="breadcrumb-item">Manage Testimonial</li>
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
							<form class="mb-5" action="" method="post" enctype = "multipart/form-data" >

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Picture <span style="color:red"><?=!empty($user_data->picture) ? '' : '*'?></span></label>

                                    <input name="picture" <?=!empty($user_data->picture) ? '' : 'required'?> class="form-control" style="height: 40px;padding: 7px;" type="file">

            <div style="width: 125px;border: 6px solid grey;">
            <?php
if (!empty($user_data->picture)) {
	?>
 <img src="<?=base_url()?>uploads/customer/<?=$user_data->picture?>" style="width: 113px;" alt="">

<?php
} else {
	?>
 <img src="<?=base_url()?>assets/admin_asset/updated/img/profile-pic-l.jpg" style="width: 113px;" alt="">

<?php
}
?>




      </div>
                                </div>

                                 <div class="form-group col-md-6">
                                    <?php
$rating = 0;
if (!empty($getTestimonial->rating)) {
	$rating = $getTestimonial->rating;
}
?>
                                        <label for="">Rating <span style="color:red">*</span></label>
                                        <select class="form-control"  required="" name="rating">
                                            <option <?=($rating == '1') ? 'selected' : ''?> value="1">1</option>
                                            <option <?=($rating == '2') ? 'selected' : ''?> value="2">2</option>
                                            <option <?=($rating == '3') ? 'selected' : ''?> value="3">3</option>
                                            <option <?=($rating == '4') ? 'selected' : ''?> value="4">4</option>
                                            <option <?=($rating == '5') ? 'selected' : ''?> value="5">5</option>
                                        </select>
                                    </div>


                            </div>

								<div class="form-row">


                                      <div class="form-group col-md-12">
                                        <label for="">Testimonial <span style="color:red">*</span></label>
                                        <textarea class="form-control"  required name="description"><?=!empty($getTestimonial->description) ? $getTestimonial->description : ''?></textarea>
                                    </div>
								</div>


<hr />
                                <div class="form-row">


                                      <div class="form-group col-md-12">
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" <?=!empty($getTestimonial->agree) ? 'checked' : ''?> value="accepted" name="agree" required>
                                    <label class="form-check-label" for="inlineCheckbox1" > Agree to submit my testimonial “as is” to meddistant.com website and any other media outlet Meddistant Inc. may choose. Testimonial is final, unless you inform us to remove in writing. For privacy, name to be abbreviated ad "John Smith" to "John S."
                                    </label>
                                </div>

                                    </div>
                                </div>


                                <div class="form-group row mb-0 float-right">
                                    <div class="col-sm-10">
										<button type="submit" class="btn btn-primary mb-0">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>