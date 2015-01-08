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
										<li class="active">Confirm your E-mail address</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Confirm your E-mail address</h2>
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
								
					<div class="alert alert-info">
						<strong>Info!</strong>&nbsp;&nbsp;Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.<br />  If you do not receive the confirmation email within a few minutes, please check your Junk , Spam E-mail folder just in case the confirmation email got delivered there instead of your inbox. If so, select the confirmation message and click Not Junk which will allow future messages to get through.
					</div>
																					
										

							</div>
						</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>