<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Team</h1>
				<small>Team Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Team Master</a></li>
					<li><a href="<?php echo base_url("account/team/index"); ?>">Team List</a></li>
					<li class="active">Add Team</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Team Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/team/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group department_div">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Department Name</label><span class="red_star">*</span>
										<select  class="form-control" id="department_name" name="department_name" onchange="change_status('department_div')">
											<option selected disabled value="">Select Department</option>
											<?php
												if(sizeof($department))
												{
													for($i=0;$i<sizeof($department);$i++)
													{											
														?>
															<option value="<?php echo $department[$i]['id']; ?>"> <?php echo $department[$i]['department_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>								
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="form-group team_name_div">
										<label for="team_name" class="form-control-label" id="team_name_lbl">Team Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="team_name" name="team_name"  placeholder="Team Name" onkeyup="change_status('team_name_div')"/>
									</div>
								</div>								
							</div>



							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Team</button>
										<a href="<?php echo base_url("account/team/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
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
		var team_name 	= $("#team_name").val();
		
		if(department_name=="" || department_name==null)
		{
			$(".department_div").addClass("has-danger");
			flag="False";
		}
		if (team_name=="") 
		{
			$(".team_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});

</script>