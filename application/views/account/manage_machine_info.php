<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Machine</h1>
				<small>Machine Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/machine/index"); ?>">Machine Master</a></li>
					<!--<li><a href="<?php echo base_url("account/machine/index"); ?>">Machine List</a></li>-->
					<li class="active">Manage Machine</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Machine Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/machine/update_machine"); ?>">
							<div class="row">					
								<div class="col-sm-4">
									<div class="form-group machine_name_div">
										<label for="machine_name" class="form-control-label" id="machine_name_lbl">Machine Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="machine_name" name="machine_name"  placeholder="Machine Name" onkeyup="change_status('machine_name_div')" value="<?php echo $info['machine_name'];?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group running_cost_div">
										<label for="running_cost" class="form-control-label" id="running_cost_lbl">Running Cost per hour</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="running_cost" name="running_cost" placeholder="Running Cost" onkeyup="change_status('running_cost_div', integer('running_cost'))" value="<?php echo $info['running_cost']; ?>"/>
									</div>
								</div>								
							</div>	
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="gstin_number" class="form-control-label" id="gstin_number_lbl">Description</label>
										<textarea rows="4" cols="150" type="text" class="form-control" id="description"  name="description" placeholder="Description" ><?php echo $info['description'];?></textarea>
									</div>
								</div>
								<input type="hidden" name="machine_id" value="<?php echo $info['machine_id']; ?>"/>
							</div>

							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update Machine</button>
									<a href="<?php echo base_url("account/machine/index") ?>">
										<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
									</a>
								</div>
							</div>
					</div>
				</div>
			</div>
		
		</div>
		</form>
		</div> 
</div>
<script>
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}

	$("#frm").submit(function(e)
	{
		var flag="True";
		var machine_name = $("#machine_name").val();
		var running_cost = $("#running_cost").val();
			
		if(machine_name=="")
		{
			$(".machine_name_div").addClass("has-danger");
			flag="False";
		}
		if(running_cost=="")
		{
			$(".running_cost_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});



</script>