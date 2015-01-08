<?php $this->load->view('components/form_message'); ?>
<form action="<?php echo site_url('clients/profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="editaccount"  />
<input type="hidden" name="email" value="<?php echo $profile['email']; ?>"  />
<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>E-mail Address*</label><br />
      <b><?php echo $profile['email']; ?></b>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Name*</label>
      <input name="userName"  type="text" value="<?php echo $profile['contact_name']; ?>" class="form-control input-lg">
    </div>
  </div>
</div>


<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Contact Number*</label>
      <input name="contact_number" type="text" value="<?php echo $profile['contact_number']; ?>" class="form-control input-lg">
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Interests</label><br />
     	<input type="checkbox" name="music" <?php  if( $profile['music'] == 1){ ?> checked <?php } ?> value="1" />&nbsp;Music&nbsp;<input type="checkbox" name="movies" <?php  if( $profile['movies'] == 1){ ?> checked <?php } ?> value="1" />&nbsp;Movies&nbsp;<input type="checkbox" <?php  if( $profile['business'] == 1){ ?> checked <?php } ?> name="business" value="1" />&nbsp;Business
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Age</label><br />
	  <select name="age">
       <?php for($i=18;$i<100;$i++){ ?>
         <option value="<?php echo $i; ?>" <?php if($profile['age'] == $i){ ?> selected <?php } ?> ><?php echo $i; ?></option>
       <?php } ?>
	   </select>
	  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <input type="checkbox" name="newsletter" value="1" <?php if($profile['newsletter'] == 1){ ?> checked <?php } ?> />Subscribe to newsletter
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Update Account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>
<div class="row">
 <div class="col-md-12">
  <h4>Change Password</h4>
 </div>
</div>
<form action="<?php echo site_url('clients/profile'); ?>" id="register" method="POST" type="post">
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
<div class="row">
 <div class="col-md-12">
  <h4>Deactivate Account</h4>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
    <a href="<?php echo site_url('clients/deactivate'); ?>" onclick="return confirm('are you sure you want to deactivate your account ?');" ><button type="button" class="btn btn-danger">Deactivate</button></a>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
  <h4></h4>
 </div>
</div>