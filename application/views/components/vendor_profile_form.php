<?php extract($result); ?>
<form action="<?php echo site_url('vendors/profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="editaccount"  />
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>E-mail Address*</label><br />
			<b><?php echo set_value('email',(isset($email) ? $email:'')); ?></b>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Name*</label>
			<input name="userName" type="text" value="<?php echo set_value('userName',(isset($name) ? $name:'')); ?>" class="form-control input-lg">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Registered Company Name*</label>
			<input name="company" type="text" value="<?php echo set_value('company',(isset($company_name) ? $company_name:'')); ?>" class="form-control input-lg">
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
  <div class="col-md-12">
    <input type="submit" value="Update Account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>



<form action="<?php echo site_url('vendors/profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="changepassword"  />
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>New Password*</label>
			<input name="password" type="password" id="password" value="" class="form-control input-lg"  >
		</div>
		<div class="col-md-6">
			<label>Re-enter Password*</label>
			<input name="confirm_password" type="password" value=""  class="form-control input-lg"  >
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Change Password" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>