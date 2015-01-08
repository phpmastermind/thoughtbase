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
			<div class="col-md-9">
				<div class="tabs">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#active" data-toggle="tab">My Surveys</a>
						</li>
						<li>
							<a class=" icon icon-thumbs-o-up" href="#rec" data-toggle="tab">Completed Surveys</a>
						</li>
					
					</ul>
					<div class="tab-content">
						<div id="active" class="tab-pane active">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											Id
										</th>
										<th>
											Name
										</th>
										<th>
											Post Date
										</th>
										<th>
											Deliver On
										</th>
										<th>
											Amount
										</th>
										<th>
											View/Edit
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									    if( count($result) > 0 && 1==2 ) { 
									    foreach($result as $row => $val ){
										if($val['archived']==0){
									?>
										<tr>
											<td>
												<?php echo $val['post_id']; ?>
											</td>
											<td>
												Event <?php echo get_event($val['sub_event_type'])."&nbsp;/&nbsp;".get_main_event($val['sub_event_type']); ?>
											</td>
											<td>
												<?php echo date('d/m/Y',strtotime($val['submitted_date'])); ?>
											</td>
											<td>
												<?php echo substr($val['date'],0,10);  ?>
											</td>
											<td>
												<?php echo $val['unit']; ?>&nbsp;sgd per&nbsp;<?php echo $val['post_unit']; ?>
											</td>
											<td>
												<a class="btn btn-primary" href="<?=site_url('clients/post/'.$val['post_id']) ?>">View</a>
											</td>
										</tr>
										<?php }}} ?>
										
									
								</tbody>
							</table>
						</div>
						<div id="rec" class="tab-pane">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											Id
										</th>
										<th>
											Name
										</th>
										<th>
											Post Date
										</th>
										<th>
											Deliver On
										</th>
										<th>
											Amount
										</th>
										<th>
											View/Edit
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									   //vendor subcat list get
									    $vendor_cat = get_vendor_cat($this->session->userdata('vendor_id'));
										if( count($result) > 0  || 1==2 ) { 
									    foreach($result as $row => $val ){
										if( $val['archived']== 0 && $val['vendor_cat_id'] > 0 && in_array($val['vendor_cat_id'],$vendor_cat)){
									?>
										<tr>
											<td>
												<?php echo $val['post_id']; ?>
											</td>
											<td>
												Event <?php echo get_event($val['sub_event_type'])."&nbsp;/&nbsp;".get_main_event($val['sub_event_type']); ?>
											</td>
											<td>
												<?php echo date('d/m/Y',strtotime($val['submitted_date'])); ?>
											</td>
											<td>
												<?php echo substr($val['date'],0,10);  ?>
											</td>
											<td>
												<?php echo $val['unit']; ?>&nbsp;sgd per&nbsp;<?php echo $val['post_unit']; ?>
											</td>
											<td>
												<a class="btn btn-primary" href="<?=site_url('clients/post/'.$val['post_id']) ?>">View</a>
											</td>
										</tr>
										<?php }}} ?>
										
									
								</tbody>
							</table>
						</div>
						
						
						
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<aside class="sidebar">
					<div class="featured-box featured-box-secundary default info-content">
						<div class="box-content">
							<?php if(isset($profile['logo']) && $profile['logo'] !=""  ){ ?>
							<img class="img-thumbnail img-responsive" style="max-width:200px;" src="<?php echo base_url(); ?>assets/thim/timthumb.php?src=<?php echo base_url(); ?>uploads/vendor/<?php echo $profile['logo'];  ?>&zc=1">
							<?php } ?>
							<hr class="visible-sm visible-xs tall" />
							<h4><?php echo $profile['company_name']; ?></h4>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-striped">
										<tbody>
											<tr>
												<td>
													Balance
												</td>
												<td>
													 0.00$
												</td>
									
									
											</tr>
											<tr>
												<td>
													Surveys
												</td>
												<td>
													0
												</td>
											</tr>
											<tr>
												<td>
													
												</td>
												<td>
													<?php # echo @date('Y/m/d',strtotime($profile['register_date'])); ?>
												</td>
											</tr>
										</tbody>
									 </table>
								</div>
							</div>
								<div class="row">
									<div class="col-md-12">
										<button type="button" class="btn btn-primary btn-xs col-md-12"><a style="color:#fff;text-decoration:none;" href="<?php echo site_url('vendors/profile'); ?>">Manage Profile</a></button>
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col-md-12">
									
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col-md-12">
									</div>
								<div class="row">&nbsp;</div>
						
						</div>
					</div>
			    </aside>
			</div>
		</div>
	</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>