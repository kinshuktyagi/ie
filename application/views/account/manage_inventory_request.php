<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Inventory Request</h1>
				<small>Inventory Request Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/inventory_request/index"); ?>">Inventory Request Master</a></li>
					<!--<li><a href="<?php echo base_url("account/inventory_request/index"); ?>">Inventory Issue List</a></li>-->
					<li class="active">Manage Inventory Request</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Inventory Request Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/inventory_request/update_inventory_request"); ?>">
							<?php							
							$product = $info['product'];							
							if(sizeof($info))
							{	?>
								<div class="row">
									<div class="col-sm-3">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Product Name</label><span class="red_star">*</span>
									</div>
									<div class="col-sm-1">
										<label for="product_qty" class="form-control-label" id="product_qty_lbl">Quantity</label><span class="red_star">*</span>
									</div>
									<div class="col-sm-3">
										<label for="product_qty" class="form-control-label" id="product_qty_lbl">Notes</label>
									</div>
									<div class="col-sm-2">
										<label class="form-control-label" >Action</label>
									</div>
								</div>
						
						
								<?php
								for($j=0; sizeof($product)>$j; $j++)
								{
									?>
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group product_name_div">
												<select class="form-control basic-single" id="product_name" name="up_product_name[]" onchange="change_status('product_name_div')">
													<option selected value="">Select Product Name</option>
													<?php
														if(sizeof($product_info))
														{
															for($i=0;$i<sizeof($product_info);$i++)
															{ ?>
																	<option value="<?php echo $product_info[$i]['product_id'];?>" <?php if($product[$j]['product_id'] == $product_info[$i]['product_id'])
																	{
																		echo "Selected";
																	}?>>
																		<?php echo $product_info[$i]['product_name']; ?>
																	</option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group product_qty_div">
												<input type="text" class="form-control" id="product_qty" name="up_product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div')" value="<?php echo $product[$j]['product_qty']?>"/>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group notes_div">
												<input type="text" class="form-control" id="notes" name="up_notes[]" placeholder="Notes" onkeyup="change_status('notes_div')" value="<?php echo $product[$j]['notes']?>"/>
											</div>
										</div>
										<div class="col-sm-2">
											<select class="form-control basic-single" name="product_action[]" >
												<option selected value="update">Update</option>
												<option value="delete">Delete</option>
											</select>
										</div>
										<input type="hidden" name="inventory_request_product_id[]" value=<?php echo  $product[$j]['id']; ?>>
									</div>
									<?php 
								}
									?>
								<div class="row btnSectionClone">
									<div class="col-sm-3">
										<div class="form-group product_name_div">
											<select class="form-control basic-single" id="product_name" name="product_name[]" onchange="change_status('product_name_div')">
												<option selected value="">Select Product Name</option>
												<?php
													if(sizeof($product_info))
													{
														for($i=0;$i<sizeof($product_info);$i++)
														{ ?>
																<option value="<?php echo $product_info[$i]['product_id']; ?>">
																	<?php echo $product_info[$i]['product_name']; ?>
																</option>
															<?php
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group product_qty_div">
											<input type="text" class="form-control" id="product_qty" name="product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div')"/>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group notes_div">
											<input type="text" class="form-control" id="notes" name="notes[]" placeholder="Notes" onkeyup="change_status('notes_div')" />
										</div>
									</div>
									<div class="col-sm-3" id = "add_div">
										<a class="btn btn-success btn-top add" id="add_row">Add</a>
									</div>
								</div>
								
								<br>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group production_date_div">
											<label for="production_date" class="form-control-label" id="production_date_lbl">Production Date</label><span class="red_star">*</span>
											<input type="text" class="form-control datetimepicker2" id="production_date" name="production_date" placeholder="Production Date" onchange="change_status('production_date_div')" value="<?php echo $info['production_date']?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group description_div">
											<label for="description" class="form-control-label" id="description_lbl"> Description</label>
											<textarea rows="3" cols="50" type="text" class="form-control" id="description" name="description" placeholder="Description" onkeyup="change_status('description_div')"><?php echo $info['description']?></textarea>
										</div>
									</div>
									<input type="hidden" name="inventory_request_id" value="<?php echo $info['id']; ?>"/>
								</div>
								<div class="col-sm-4" style="padding-top:23px;">
									<div class="form-group">
										<button type="submit" id="test" class="btn btn-base pull-left">Update </button>
										<a href="<?php echo base_url("account/inventory_request/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
								<?php
							}	
							?>	
					</div>
				</div>
			</div>
		
		</div>
		</form>
		</div> 
</div>
<script>
	$(document).on('click', '.add', function()
	{
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find('.select2-container--default').remove();
		$clone.find('#product_name').select2();
				  
		$tr.before($clone);		
	});
	
	$(document).on('click', '.remove', function(){		
		$(this).closest('.btnSectionClone').remove();
	}); 
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}

	$("#frm").submit(function(e)
	{
		var flag="True";
		var production_date = $("#production_date").val();
			
		if(production_date=="")
		{
			$(".production_date_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});

	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});

</script>