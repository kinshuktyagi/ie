<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Storage Type</h1>
				<small>Storage Type Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Storage Type Master</a></li>
					<li><a href="<?php echo base_url("account/storage_type/index"); ?>">Storage type List</a></li>
					<li class="active">Manage Storage Type</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Storage Type Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/storage_type/update_storage_type"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group storage_type_name_div">
										<label for="storage_type_name" class="form-control-label" id="storage_type_name_lbl">Storage Type Name</label>
										<input type="text" class="form-control" id="storage_type_name" name="storage_type_name" placeholder="Storage Type Name" value="<?php echo $info['storage_type_name']; ?>" onkeyup="change_status('storage_type_name_div')"/>
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
								<input type="hidden" name="storage_id" value="<?php echo $info['id']; ?>"/>
							</div>

							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update Storage Type</button>
									<a href="<?php echo base_url("account/storage_type/index") ?>">
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
		var storage_type_name = $("#storage_type_name").val();
		
		if(storage_type_name=="")
		{
			$(".storage_type_name_div").addClass("has-danger");
			flag="False";
		}
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});



</script>