<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Division</h1>
				<small>Division Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Division Master</a></li>
					<li><a href="<?php echo base_url("account/division/index"); ?>">Division List</a></li>
					<li class="active">Add Division</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Division Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/division/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group department_name_div">
										<label for="division_name" class="form-control-label" id="division_name_lbl">Division Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="division_name" name="division_name"  placeholder="Division Name" onkeyup="change_status('division_name_div')"/>
									</div>
								</div>
								
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="division_description" class="form-control-label" id="division_description_lbl"> Description
										<textarea rows="4" cols="50" type="text" class="form-control" id="division_description"  name="division_description" placeholder="Description" onkeyup="change_status('division_description_div')"></textarea>
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Division</button>
										<a href="<?php echo base_url("account/division/index") ?>">
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
		var department_name = $("#division_name").val();		
		var description 	= $("#division_description").val();
		
		if(department_name=="")
		{
			$(".department_name_div").addClass("has-danger");
			flag="False";
		}	

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>