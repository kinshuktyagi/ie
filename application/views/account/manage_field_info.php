<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Field</h1>
				<small>Field Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Field Master</a></li>
					<li><a href="<?php echo base_url("account/field/index"); ?>">Field List</a></li>
					<li class="active">Manage Field</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Field Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/field/update_field"); ?>">
							<div class="row">					
								<div class="col-sm-4">
									<div class="form-group">
										<label for="gstin_number" class="form-control-label" id="gstin_number_lbl">Field Name</label>
										<input type="text" class="form-control" id="field_name" name="field_name" placeholder="Field Name"  value="<?php echo $info['field_name']; ?>"/>
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
								<input type="hidden" name="field_id" value="<?php echo $info['id']; ?>"/>
							</div>

							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update Field</button>
									<a href="<?php echo base_url("account/field/index") ?>">
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
		var department_name = $("#department_name").val();
			
		if(department_name=="")
		{
			$(".designation_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});



</script>