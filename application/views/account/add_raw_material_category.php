<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Category</h1>
				<small>Category Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/raw_material_category/index"); ?>">Category Master</a></li>
					<li class="active">Add Category</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Category Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/raw_material_category/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group category_name_div">
										<label for="category_name" class="form-control-label" id="category_name_lbl">Category Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" onkeyup="change_status('category_name_div')"/>
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
										<button type="submit" class="btn btn-base pull-left">Add Category</button>
										<a href="<?php echo base_url("account/raw_material_category/index") ?>">
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
		var category_name = $("#category_name").val();
		var description 	= $("#description").val();
		
		if(category_name=="")
		{
			$(".category_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>