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
										<li class="active">Login</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Login</h2>
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
												<h4>I'm a Returning User</h4>
												<form action="<?=site_url('main/clientLogin') ?>" id="login" method="post" >
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>E-mail Address</label>
																<input name="email" type="text" value="<?php echo set_value('email'); ?>" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<a class="pull-right" href="<?php echo site_url('main/forgot_password'); ?>">(Lost Password?)</a>
																<label>Password</label>
																<input name="password" type="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
																	<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																</label>
															</span>
														</div>
														<div class="col-md-6">
															<input type="submit" value="Login" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
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