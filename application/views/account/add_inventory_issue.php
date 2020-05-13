<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Inventory Request</h1>
				<small>Inventory Request Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/inventory_issue/index");?>">Inventory Request Master</a></li>
					<li class="active">Add Inventory Request</li>
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
					<?php 
					/* echo"<pre>";
					print_r($info);
					exit(); */
					?>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/inventory_issue/add_inventory_issue"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Product Name</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-1">
									<label for="product_qty" class="form-control-label" id="product_qty_lbl">Quantity</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-3">
									<label for="notes" class="form-control-label" id="product_qty_lbl">Notes</label>
								</div>
								<div class="col-sm-2">
									<label class="form-control-label" >Action</label>
								</div>
							</div>
							<?php 
							$issue_stock = $this->session->userdata("issue_stock");
							if($issue_stock['user_id']=='' )
							{
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
										<input type="text" class="form-control" id="product_qty" name="product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div', integer('product_qty'))"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group notes_div">
										<input type="text" class="form-control" id="notes" name="notes[]" placeholder="Notes" onkeyup="change_status('notes_div')"/>
									</div>
								</div>
								<div class="col-sm-3" id = "add_div">
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
								</div>
							</div>
							
							<!--<div class="row tessttst" id="tessttst">
								<div class="row">
									<div id="row_id_1">
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
												<input type="text" class="form-control" id="product_qty" name="product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div', integer('product_qty'))">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group notes_div">
												<input type="text" class="form-control" id="notes" name="notes[]" placeholder="Notes" onkeyup="change_status('notes_div')">
											</div>
										</div>									
										<div class="col-sm-1" id = "add_div" >
											<a class="btn btn-success btn-top add" id="add_row">Add</a>
										</div>
										<div class="col-sm-2" id="totalprice0" data-srno="1"> </div>
									</div>
								</div>
							</div>-->
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Submit</button>
									</div>
								</div>
							</div>
						</form>
						<br>
						
						<?php 
							}?>
						
					<?php 
						$issue_stock = $this->session->userdata("issue_stock");
						$user = $this->session->userdata("user");
						if($issue_stock['user_id'] != '' && $issue_stock['user_id']==$user['id'])
						{	$issu_product = $issue_stock['issu_product'];
							?>
							<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/inventory_issue/add_inventory_issue"); ?>">
							<?php
								for($j=0; sizeof($issu_product)>$j; $j++)
								{
									?>
									<div class="row btnSectionClone">
										<div class="col-sm-3">
											<div class="form-group product_name_div">
												<select class="form-control basic-single" id="product_name" name="up_product_name[]" onchange="change_status('product_name_div')">
													<option selected value="">Select Product Name</option>
													<?php
														if(sizeof($product_info))
														{
															for($i=0;$i<sizeof($product_info);$i++)
															{ ?>
																	<option value="<?php echo $product_info[$i]['product_id'];?>" <?php if($issu_product[$j]['product_id'] == $product_info[$i]['product_id'])
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
										<!--<div class="col-sm-2">
											<div class="form-group start_date_div">
												<input type="text" class="form-control datetimepicker2" id="start_date" name="up_start_date[]" placeholder="Start Date" onkeyup="change_status('start_date_div')" value="<?php echo $issu_product[$j]['start_date']?>"/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group end_date_div">
												<input type="text" class="form-control datetimepicker2" id="end_date" name="up_end_date[]" placeholder="End Date" onkeyup="change_status('end_date_div')" value="<?php echo $issu_product[$j]['end_date']?>"/>
											</div>
										</div>-->
										<div class="col-sm-1">
											<div class="form-group product_qty_div">
												<input type="text" class="form-control" id="product_qty" name="up_product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div', integer('product_qty'))" value="<?php echo $issu_product[$j]['product_qty']?>"/>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group notes_div">
												<input type="text" class="form-control" id="notes" name="up_notes[]" placeholder="Notes" onkeyup="change_status('notes_div')" value="<?php echo $issu_product[$j]['notes']?>"/>
											</div>
										</div>
										<div class="col-sm-3" id = "add_div">
											<a class="remove btn btn-sm btn-danger btn-top">Remove</a>
										</div>
									</div>
									<?php
								}?>
								
								<div class="row btnSectionClone">
									<div class="col-sm-3">
										<div class="form-group product_name_div">
											<select class="form-control basic-single" id="product_name" name="up_product_name[]" onchange="change_status('product_name_div')">
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
											<input type="text" class="form-control" id="product_qty" name="up_product_qty[]" placeholder="qty" onkeyup="change_status('product_qty_div', integer('product_qty'))"/>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group notes_div">
											<input type="text" class="form-control" id="notes" name="up_notes[]" placeholder="Notes" onkeyup="change_status('notes_div')" />
										</div>
									</div>
									<div class="col-sm-3" id = "add_div">
										<a class="btn btn-success btn-top add" id="add_row">Add</a>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<button type="submit" class="btn btn-base pull-left">Update</button>
										</div>
									</div>
								</div>
							</form>
							
							<hr>
								<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/inventory_issue/add"); ?>">						
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group production_date_div">
												<label for="production_date" class="form-control-label" id="production_date_lbl">Production Date</label><span class="red_star">*</span>
												<input type="text" class="form-control datetimepicker2" id="production_date" name="production_date" placeholder="Production Date" onkeyup="change_status('production_date_div')"/>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group description_div">
												<label for="description" class="form-control-label" id="description_lbl"> Description</label>
												<textarea rows="3" cols="50" type="text" class="form-control" id="description" name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
											</div>
										</div>
									</div>							
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<button type="submit" class="btn btn-base pull-left">Submit</button>
												<a href="<?php echo base_url("account/department/index") ?>">
													<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
												</a>
											</div>
										</div>
									</div>
								</form>							
							<?php
						}	
						?>
						
					</div>
				</div>
			</div>		
		</div>		
	</div> 
</div>
<script>

	/* $(document).ready(function()
	{
		var count = 1;
		$(document).on('click', '#add_row', function()
		{
			++count;				
			var html_code = '<div class="row"><div id="row_id_'+count+'"><div class="col-sm-3"><div class="form-group product_name_div'+count+'"><select class="form-control basic-single" id="product_name" name="product_name[]" onchange="change_status("product_name_div'+count+'")" data-srno="'+count+'" updateToBox="'+count+'"><option selected value="">Select Product Name</option><?php if(sizeof($product_info)) { for($i=0;$i<sizeof($product_info);$i++) { ?> <option value="<?php echo $product_info[$i]['product_id']; ?>"> <?php echo $product_info[$i]['product_name']; ?> </option> <?php } } ?> </select> </div> </div><div class="col-sm-1"><div class="form-group product_qty_div'+count+'"><input type="text" class="form-control" id="product_qty'+count+'" name="product_qty[]" placeholder="qty" onkeyup="change_status("product_qty_div'+count+'", integer("product_qty'+count+'"))"></div> </div> <div class="col-sm-3"> <div class="form-group notes_div"> <input type="text" class="form-control" id="notes" name="notes[]" placeholder="Notes" onkeyup="change_status("notes_div")"> </div></div><div class="col-sm-1" id = "add_div" > <a class="btn btn-danger btn-top remove">Remove</a> </div> <div class="col-sm-2" id="totalprice'+count+'" data-srno="1"> </div> </div></div>';
			$('#tessttst').append(html_code);
		});
	}); */

	/* $(document).on('change', '.products', function()
	{	
		var testst = $(this).val();
		var updateToBox = $(this).attr('updateToBox');
		//var product_id= $('#product_id').val();
		if(testst)
		{
			var link = "<?php echo base_url("account/product/view?id=")?>"+testst;
			console.log(link);
			$("#totalprice"+updateToBox).html('<a href="'+link+'">PO</a>');			 
		}
	});
	$(document).on('click', '.remove', function(){
		$(this).parent().parent().remove();
	}); */




	$(document).on('click', '.add', function()
	{
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find('.select2-container--default').remove();
		$clone.find('#product_name').select2();
		
		$clone.find('input.datetimepicker2')
		  .removeClass('hasDatepicker')
		  .removeData('datepicker')
		  .unbind()
		  .datetimepicker({
				format:'d-m-Y',
				defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
				timepicker:false
			});
		  
		$tr.before($clone);		
	});
	
	$(document).on('click', '.remove', function(){		
		$(this).closest('.btnSectionClone').remove();
	});

	$(document).on('change', '.vendors', function()
	{	
		var testst = $(this).val();
		var updateToBox = $(this).attr('updateToBox');
		console.log(updateToBox);
		if(testst)
		{
			var link = "<?php echo base_url("account/po/add?vendor=")?>"+testst;
			console.log(link);
			$("#totalprice"+updateToBox).html('<a href="'+link+'">PO</a>');			 
		}
	});
	
	/* $(document).on('click', '.remove', function(){
		$(this).parent().parent().remove();
	}); */
	

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	$("#frm").submit(function(e)
	{
		var flag="True";
		var department_name = $("#department_name").val();		
		var description 	= $("#description").val();
		
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
	
	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});

</script>