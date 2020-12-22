<!-- Google Tag Manager (noscript) -->
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTG4KM9" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) --><br style="display:none;" data-autoplay="0" id="btBody">
<section class="section-35 section-sm-75 section-lg-90 bg-whisper-lighten">
  <div class="shell">
	<div class="range">
	  <div class="cell-md-3 cell-lg-3"></div>
	  <div class="cell-md-6 cell-lg-6">

	  	<?php if ($this->session->flashdata('error_message')) {?>
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('error_message'); ?></span>
			</div>
		<?php }?>
		<?php if ($this->session->flashdata('success_message')) {?>
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span><?php echo $this->session->flashdata('success_message'); ?></span>
			</div>
		<?php }?>


		<h3>Schdule <span class="text-thin">a Call</span></h3>
		<div class="success_msg response" style="display: none">
			<i class="fa fa-check"></i>
			<span></span>
		</div>
		<div class="error_msg response" style="display: none">
			<i class="fa fa-times-circle"></i>
			<span></span>
		</div>
		<style type="text/css">
			.form-control{
				color: #000 !important;
			}
		</style>
		<?php $attributes = array('class' => 'form-modern offset-top-22', 'id' => 'schedule_call', 'method' => 'post', 'data-form-type' => 'contact', 'data-form-output' => 'form-output-global');
echo form_open('schedule-call/', $attributes);?>
		  <div class="range">
			<div class="cell-sm-6">
			  <div class="form-group">
				<input id="schedule-name" type="text" required name="full_name" data-constraints="@Required" class="form-control">
				<label for="schedule-name"  class="form-label">Name</label>
			  </div>
			</div>
			<div class="cell-sm-6 offset-top-35 offset-sm-top-0">
			  <div class="form-group">
				<input id="schedule-email" type="email" required name="email" data-constraints="@Email @Required" class="form-control">
				<label for="schedule-email" class="form-label">Email</label>
			  </div>
			</div>
			<div class="cell-sm-6 offset-top-35">
			  <div class="form-group">
				<input id="schedule-phone" type="phone" required name="phone_no" data-constraints="@Numeric @Required" class="form-control">
				<label for="schedule-phone" class="form-label">Phone</label>
			  </div>
			</div>
			<div class="cell-sm-6 offset-top-35">
			  <div class="form-group common-select">
				<select required name="procedure_treatment" data-constraints="@Required" class="form-control" id="schedule-select">
					<option>Select Treatment</option>
					<?php
foreach ($getTreatment as $value) {
	?>
						<option value="<?=$value->id?>"><?=$value->treatment_name?></option>
						<?php
}
?>
				  </select>
				<label for="schedule-select" class="form-label">Select Treatment</label>
			  </div>
			</div>
			<div class="cell-sm-6 offset-top-35">
			  <div class="form-group">
				<input id="schedule-date" type="text" required name="schedule_date" required data-constraints="@Required" data-time-picker="date" class="form-control">
				<label for="schedule-date" class="form-label">Schedule Date</label>
			  </div>
			</div>
			<div class="cell-sm-6 offset-top-35">
			  <div class="form-group common-select">
				<select name="time_from" required data-constraints="@Required" class="form-control" id="schedule-time">
					<option>Select Time</option>
					<option>8am-9am</option>
					<option>10am-11am</option>
					<option>11am-12am</option>
					<option>12am-1pm</option>
					<option>1pm-2pm</option>
					<option>2pm-3pm</option>
					<option>3pm-4pm</option>
					<option>4pm-5pm</option>
					<option>5pm-6pm</option>
					<option>6pm-7pm</option>
					<option>7pm-8pm</option>
					<option>8pm-9pm</option>
				  </select>
				<label for="schedule-time" class="form-label">Time Interval</label>
			  </div>
			</div>
			<div class="cell-xs-12 offset-top-35">
			  <div class="form-group">
				<div class="textarea-lined-wrap">
				  <textarea id="schedule-message" style="max-height: 110px;" required name="message" data-constraints="@Required" class="form-control"></textarea>
				  <label for="schedule-message"  class="form-label">Message</label>
				</div>
			  </div>
			</div>
			<div class="cell-xs-5 offset-top-30 offset-xs-top-30 offset-sm-top-50">
			  <button type="submit" class="btn btn-primary btn-block">Send</button>
			</div>
			<div class="cell-xs-3 offset-top-22 offset-xs-top-30 offset-sm-top-50">
			  <button type="reset" class="btn btn-silver-outline btn-block">Reset</button>
			</div>
		  </div>
		</form>
	  </div>
	  <div class="cell-md-3 cell-lg-3"></div>
	</div>
  </div>
</section>