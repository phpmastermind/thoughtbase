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
										<li class="active">Dashboard</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Dashboard</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row">
		<div class="col-md-12" style="padding-bottom:10px;">
		   <?php $this->load->view('client_menu'); ?>
		</div>
		</div>
		
		
		<div class="row">
						<div class="pricing-table">
							<div class="col-md-3 col-sm-6 ">
								<div class="plan most-popular">
									<h3>Total Earnings<span>$0.00</span></h3>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 ">
								<div class="plan  center">
									<div class="plan-ribbon-wrapper"></div>
									<h3>Total Withdrawal<span>$0.00</span></h3>
									
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="plan">
									<h3>Balance<span>$0.00</span></h3>									
								</div>
							</div>
						</div>
					</div>
		
		<div class="row">
		
			<div class="col-md-12">
			
				<div class="tabs">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#active" data-toggle="tab">Completed surveys</a>
						</li>
					
					</ul>
					<div class="tab-content">
						<div id="active" class="tab-pane active">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											Sl.No
										</th>
										<th>
											Name
										</th>
										<th>
											Amount
										</th>
									</tr>
								</thead>
								<tbody>	
								 <?php 
								     if( count($data) > 0 && 1==2 ){ 
								     foreach($data as $row => $val ){
									 if($val['archived'] == 0 ){
								 ?>	
									
										<tr>
											<td>
												<?php echo $val['post_id']; ?>
											</td>
											<td>
												<?php echo $val['event_name']; ?>
											</td>
											<td>
												<?php echo @date('d/m/Y H:i',strtotime($val['submitted_date'])); ?>
											</td>
										</tr>
								<?php }}}else{ ?>		
								       
										<tr>
											<td colspan="3">
												You havent completed any survey
											</td>
											
										</tr>
								
								<?php } ?>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>