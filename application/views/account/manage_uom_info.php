<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Uom</h1>
				<small>Uom Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Uom Master</a></li>
					<li><a href="<?php echo base_url("account/uom/index"); ?>">Uom List</a></li>
					<li class="active">Manage Uom</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Uom Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/uom/update_uom"); ?>">
							<div class="row">	
								<div class="col-sm-4">
									<div class="form-group">
										<label for="uom_name" class="form-control-label" id="uom_name_lbl">UOM Name</label>
										<input type="text" class="form-control" id="uom_name" name="uom_name" placeholder="UOM Name"  value="<?php echo $info['uom_name']; ?>"/>
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
								<input type="hidden" name="uom_id" value="<?php echo $info['uom_id']; ?>"/>
							</div>

							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update UOM</button>
									<a href="<?php echo base_url("account/uom/index") ?>">
										<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
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
		var uom_name = $("#uom_name").val();
		
		if(uom_name=="")
		{
			$(".uom_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});



</script>