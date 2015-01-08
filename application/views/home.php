<?$this->layout->block('breadcrumbs')?>

<?$this->layout->block()?>

<!--page content -->
		<div class="home-intro light secundary">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque<em>Free.</em>
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
						</p>
					</div>
					<div class="col-md-4">
						<div class="get-started">
							<a href="<?=site_url('main/clientLogin') ?>"" class="btn btn-lg btn-primary">Get Started Now!</a>
							<div class="learn-more">or <a data-hash href="#learnMore">learn more.</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="learnMore" class="container">
			<div class="row center">
				<div class="col-md-12">
					<h2 class="short word-rotator-title">
						Survey is
						<strong class="inverted">
							<span class="word-rotate">
								<span class="word-rotate-items">
									<span>simple</span>
									<span>convinent</span>
									<span>free</span>
								</span>
							</span>
						</strong>
						Lorem ipsum dolor sit amet
					</h2>
					<p class="featured lead">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
					</p>
				</div>
			</div>
		</div>
		<div class="home-concept">
			<div class="container">
				<div class="row center">
					<span class="sun"></span>
					<span class="cloud"></span>
					<div class="col-md-2 col-md-offset-1">
						<div class="process-image" data-appear-animation="bounceIn">
							<br/>
							<strong>Select Requireme</strong>
						</div>
					</div>
					<div class="col-md-2">
						<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
							<br/>
							<strong>create Survey</strong>
						</div>
					</div>
					<div class="col-md-2">
						<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
							<br/>
							<strong>Post!</strong>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-1">
						<div class="project-image">
							<br/><br/><br/><br/><br/>
							<strong class="our-work">Get Survey</strong>
						</div>
					</div>
				</div>
		
			</div>
		</div>
<!--page content end-->

<?$this->layout->block('currentPageJS')?>
	<!-- Current Page JS -->
	<script src="<?=base_url('assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/rs-plugin/js/jquery.themepunch.revolution.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/circle-flip-slideshow/js/jquery.flipshow.js') ?>"></script>
	<script src="<?=base_url('assets/js/views/view.home.js') ?>"></script>
<?$this->layout->block()?>