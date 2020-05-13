<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Industry</h1>
				<small>Industry Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Industry Master</a></li>
					<li><a href="<?php echo base_url("account/industry/index"); ?>">Industry List</a></li>
					<li class="active">Add Industry</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Industry Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/industry/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group industry_name_div">
										<label for="industry_name" class="form-control-label" id="industry_name_lbl">Industry Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="industry_name" name="industry_name" placeholder="Industry Name" onkeyup="change_status('industry_name_div')"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="4" cols="50" type="text" class="form-control" id="description"  name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
									</div>
								</div>
							</div>							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Industry</button>
										<a href="<?php echo base_url("account/industry/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
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
		var industry_name = $("#industry_name").val();		
		var description 	= $("#description").val();
		
		if(industry_name=="")
		{
			$(".industry_name_div").addClass("has-danger");
			flag="False";
		}	

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>