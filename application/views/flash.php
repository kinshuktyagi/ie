<div class="row">
  <div class="col-sm-12">
	<?php
		if($this->session->flashdata("error"))
		{
			
		?>
			<div class="alert alert-sm alert-danger alert-dismissible message_lbl" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<i class="fa fa-exclamation-circle"></i><strong>Danger!</strong> <?php echo $this->session->flashdata("error"); ?>
			</div>
		<?php
			}
			else if($this->session->flashdata("success"))
			{
			
		?>
			<div class="alert alert-sm alert-success alert-dismissible message_lbl" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<i class="fa fa-check"></i><strong>Success... </strong> <?php echo $this->session->flashdata("success"); ?>
			</div>
		<?php
			}
		?>
  </div>
</div>