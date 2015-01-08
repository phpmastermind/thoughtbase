<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url() ?>">Home</a></li>
										<li class="active">Register</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Register</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
					<?php $this->load->view('components/form_message'); ?>	
			</div>
		</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row featured-boxes login">
									<div class="col-md-6 col-md-offset-3">
																		<div class="featured-box featured-box-secundary default info-content">
																			<div class="box-content">
																				<h4>Register An Account</h4>
																				<form action="<?php echo site_url('main/clientRegister'); ?>" id="register" method="POST" type="post">
																				  <input type="hidden" name="disable_flag" value="1" />
																				<?php $this->load->view('components/register_form'); ?>	
																				
																				
																				
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Interests</label>
			<input type="checkbox" name="music" value="1" />&nbsp;Music&nbsp;<input type="checkbox" name="movies" value="1" />&nbsp;Movies&nbsp;<input type="checkbox" name="business" value="1" />&nbsp;Business
		</div>

	</div>
</div>	

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Age</label>	<br />
   <select name="age" style="width:90px;">
       <?php for($i=18;$i<100;$i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
       <?php } ?>
	   </select>			
			</div>
		<div class="col-md-6">
			
		</div>
	</div>
</div>																			
																				
																				
																				<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Verify you're human</label>
			<?php echo $image; ?>
			<input type="hidden" name="ocaptcha" value="<?php echo $word; ?>" class="form-control input-lg"  >
		</div>
		<div class="col-md-6">
			<label>Enter text from the image</label>
			<input name="captcha" type="text" value=""  class="form-control input-lg"  >
		</div>
	</div>
</div>

<div class="row">
																					<div class="col-md-12">
																						<input type="checkbox" name="newsletter" checked value="1" />subscribe to newsletter
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-12">
																						<input type="submit" value="Register" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																					</div>
																				</div>
																				</form>
																			</div>
																		</div>
																	</div>
								</div>
							</div>
						</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>