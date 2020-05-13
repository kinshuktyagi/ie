<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Category</h1>
				<small>Category Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Category Master</a></li>
					<li><a href="<?php echo base_url("account/department/index"); ?>">Category List</a></li>
					<li class="active">Manage Category</li>
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
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/raw_material_category/update_category"); ?>">
							<div class="row">			
								<div class="col-sm-4">
									<div class="form-group category_name_div">
										<label for="category_name" class="form-control-label" id="category_name_lbl">Category Name</label>
										<input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="<?php echo $info['category_name']; ?>" onkeyup="change_status('category_name_div')" />
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
								<input type="hidden" name="cat_id" value="<?php echo $info['id']; ?>"/>
							</div>
							<div class="col-sm-4" style="padding-top:23px;">
								<div class="form-group">
									<button type="submit" id="test" class="btn btn-base pull-left">Update Category</button>
									<a href="<?php echo base_url("account/raw_material_category/index") ?>">
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
		var category_name = $("#category_name").val();
		
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