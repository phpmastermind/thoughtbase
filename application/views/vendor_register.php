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
										<li class="active">Advertiser Register</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Advertiser Register</h2>
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
																				<form action="<?php echo site_url('main/vendorRegister'); ?>" id="register" method="POST" type="post">
																				<?php $this->load->view('components/vendor_register_form'); ?>	
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