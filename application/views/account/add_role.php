<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Role</h1>
				<small>Role Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Master</a></li>
					<li><a href="<?php echo base_url("account/role/index"); ?>">Role Master</a></li>
					<li class="active">Add Role</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Role Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/role/add_role"); ?>">
							<div class="col-sm-12">
								<div class="form-group permision_div col-sm-6">
									<label for="permision" class="form-control-label" id="permision_lbl">Permission</label><span class="red_star">*</span>
									 <select multiple="multiple" class="testselect2" name="permision[]" id="permision" onchange="change_status('permision_div')">
										<option selected disabled value="">Select Permissions</option>
										<?php
											if(sizeof($permission)>0)
											{
												for($i=0;$i<sizeof($permission);$i++)
												{
													?>
														<option value="<?php echo $permission[$i]['permission_id']; ?>">
															<?php echo $permission[$i]['permission_name']; ?>
														</option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group role_name_div col-sm-6">
								<label for="role_name" class="form-control-label" id="role_name_lbl">Role Name</label><span class="red_star">*</span>
								<input type="text" class="form-control" id="role_name" name="role_name"  placeholder="Role Name" onkeyup="change_status('role_name_div')"/>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group description_div col-sm-6">
									<label for="last_name" class="form-control-label" id="description_lbl">Description</label>
									<textarea type="text" class="form-control" id="description"  name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-base pull-left">Add Role</button>
									<a href="<?php echo base_url("account/role/index") ?>">
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
		var permision=$("#permision").val();
		var role_name=$("#role_name").val();
		var description=$("#description").val();

		if(permision=="" || permision==null)
		{
			$(".permision_div").addClass("has-danger");
			flag="False";
		}
		if(role_name=="" || role_name==null)
		{
			$(".role_name_div").addClass("has-danger");
			flag="False";
		}
	
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});
</script>