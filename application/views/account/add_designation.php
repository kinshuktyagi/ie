<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Designation</h1>
				<small>Designation Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Designation Master</a></li>
					<li><a href="<?php echo base_url("account/designation/index"); ?>">Designation List</a></li>
					<li class="active">Add Designation</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Designation Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/designation/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group designation_name_div">
										<label for="department_name" class="form-control-label" id="designation_name_lbl">Designation Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="designation_name" name="designation_name"  placeholder="Designation Name" onkeyup="change_status('designation_name_div')"/>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group priority_name_div">
										<label for="priority" class="form-control-label" id="priority_lbl">Priority</label><span class="red_star">*</span>
										<input type="number" class="form-control" id="priority" name="priority"  placeholder="Priority" onkeyup="change_status('priority_name_div')"/>
									</div>
								</div>
								
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="4" cols="150" type="text" class="form-control" id="description"  name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Designation</button>
										<a href="<?php echo base_url("account/designation/index") ?>">
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
		var designation_name = $("#designation_name").val();
		var priority = $("#priority").val();
		var description 	= $("#description").val();
		
		if(designation_name=="")
		{
			$(".designation_name_div").addClass("has-danger");
			flag="False";
		}
		
		if(priority=="" )
		{
			$(".priority_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});

</script>