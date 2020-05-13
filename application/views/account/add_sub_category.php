<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Sub Category</h1>
				<small>Sub Category Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/sub_category/index"); ?>">Sub Category Master</a></li>
					<li class="active">Add Category</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Sub Category Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/sub_category/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group pro_category_div">
										<label for="pro_category" class="form-control-label" id="pro_category_lbl">Product Category</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="pro_category" name="category" onchange="change_status('pro_category_div')">
											<option selected disabled value="">Select Category</option>
											<?php
												if(sizeof($product_cat))
												{
													for($i=0;$i<sizeof($product_cat);$i++)
													{
														?>
															<option value="<?php echo $product_cat[$i]['id']; ?>"><?php echo $product_cat[$i]['raw_material_category_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group sub_cat_name_div">
										<label for="sub_cat_name" class="form-control-label" id="sub_cat_name_lbl">Sub Category Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" placeholder="Sub Category Name" onkeyup="change_status('sub_cat_name_div')"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="2" cols="50" type="text" class="form-control" id="description" name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
									</div>
								</div>
							</div><br>
							<div class="row">
							<?php 
								
								if(sizeof($product_sub_cat_field)>0)
								{
									for($i=0; sizeof($product_sub_cat_field)>$i; $i++)
									{
										?>
										<div class="col-sm-3" style="padding: 10px;">
											<div class="row">
												<div class="col-sm-9"><label class="form-control-label"><?php echo $product_sub_cat_field[$i]['field_name']?></label></div>
												<div class="col-sm-3"><input type="checkbox" class="fields" name="fields[]" value="<?php echo $product_sub_cat_field[$i]['field_id']?>"></div>
											</div>
										</div>										
										<?php
										if($i==4)
										{
											echo"</br>";
										}
									}
								}	
							?>
							</div><br>					
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Sub Category</button>
										<a href="<?php echo base_url("account/sub_category/index") ?>">
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
		var sub_cat_name = $("#sub_cat_name").val();
		var pro_category = $("#pro_category").val();
		var fields = $('input.fields').is(':checked');
		var description = $("#description").val();
		
		if (fields=='') 
		{
			alert('Please Select Any Checkbox!');
			flag="False";
		}
		if(sub_cat_name=="")
		{
			$(".sub_cat_name_div").addClass("has-danger");
			flag="False";
		}
		if(pro_category=="" || pro_category==null)
		{
			$(".pro_category_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>