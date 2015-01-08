<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>E-mail Address*</label>
			<input name="email" type="email" value="<?php echo set_value('email',(isset($email) ? $email:'')); ?>" required class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Name*</label>
			<input name="userName" type="text" value="<?php echo set_value('userName',(isset($userName) ? $userName:'')); ?>" class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Registered Company Name*</label>
			<input name="company" type="text" value="<?php echo set_value('company',(isset($company) ? $company:'')); ?>" class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Business Registration Number (UEN)*</label>
			<input name="uen" type="text" value="<?php echo set_value('uen',(isset($uen) ? $uen:'')); ?>" class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Contact Number*</label>
			<input name="contact_number" type="text" value="<?php echo set_value('contact_number',(isset($contact_number) ? $contact_number:'')); ?>" class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Password*</label>
			<input name="password" type="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg"  >
		</div>
		<div class="col-md-6">
			<label>Re-enter Password*</label>
			<input name="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg"  >
		</div>
	</div>
</div>