				<?php if ($this->session->flashdata('error') !== FALSE){ ?>
					<div class="alert alert-danger">
						<strong>Error!</strong> <?=$this->session->flashdata('error');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('warning') !== FALSE){ ?>
					<div class="alert alert-warning">
						<strong>Warning!</strong> <?=$this->session->flashdata('warning');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('info') !== FALSE){ ?>
					<div class="alert alert-info">
						<strong>Info!</strong> <?=$this->session->flashdata('info');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('success') !== FALSE){ ?>
					<div class="alert alert-success">
						<strong>Success!</strong> <?=$this->session->flashdata('success');?>
					</div>
				<?php }?>