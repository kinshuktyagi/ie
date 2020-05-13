<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Industry</h1>
				<small>Industry Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Industry Master</a></li>
					<li><a href="<?php echo base_url("account/industry/index"); ?>">Industry List</a></li>
					<li class="active">Manage Industry</li>
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
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/industry/update_industry"); ?>">
							<div class="row">					
								<div class="col-sm-4">
									<div class="form-group">
										<label for="industry_name" class="form-control-label" id="gstin_number_lbl">Industry Name</label>
										<input type="text" class="form-control" id="industry_name" name="industry_name" placeholder="Industry Name"  value="<?php echo $info['industry_name']; ?>" onkeyup="change_status('industry_name_div')"/>
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
								<input type="hidden" name="industry_id" value="<?php echo $info['id']; ?>"/>
							</div>

							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update Industry</button>
									<a href="<?php echo base_url("account/industry/index") ?>">
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
		var industry_name = $("#industry_name").val();
			
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