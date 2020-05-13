<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add PO</h1>
				<small>PO Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">PO Master</a></li>
					<li><a href="<?php echo base_url("account/po/index"); ?>">PO List</a></li>
					<li class="active">Manage PO</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
		<?php		
			/* echo"<pre>";
			print_r($po);
			exit(); */		
		?>
		<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/po/update_po"); ?>">
			<div class="col-sm-3">
				<label for="vendor_name" class="form-control-label" id="vendor_lbl">Select Vendor</label><span class="red_star">*</span>
				<div class="form-group vendor_div">
					<input class="form-control" type="text" name="vendor" value="<?php echo $po['vendor_name']?>" readonly >
					 
				</div>
			</div>
			<div class="col-sm-3">
				<label for="tnc" class="form-control-label" id="tnc_lbl">Select TNC</label><span class="red_star">*</span>
				<div class="form-group tnc_div">
					<select class="form-control basic-single" id="tnc" name="tnc" onchange="change_status('tnc_div')"/>
						<option selected value="">Select TNC</option>
						<?php
						
							if(sizeof($tnc_data))
							{
								for($i=0;$i<sizeof($tnc_data);$i++)
								{
									?>
										<option value="<?php echo $tnc_data[$i]['tnc_id']; ?>" <?php echo $tnc_data[$i]['tnc_id']==$po['tnc_id']?'selected':''?>><?php echo $tnc_data[$i]['tnc_name']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<label for="quotation" class="form-control-label" id="quotation_lbl">Select Quotation</label>
				<div class="form-group quotation_div">
					<select class="form-control basic-single" id="quotation" name="quotation" onchange="change_status('quotation_div')"/><span class="red_star">*</span>
						<option selected value="">Select Quotation</option>
						<?php
							if(sizeof($quotation))
							{
								for($i=0;$i<sizeof($quotation);$i++)
								{
									?>
										<option value="<?php echo $quotation[$i]['quotation_id']; ?>" <?php echo $quotation[$i]['quotation_id']==$po['quotation_id']?'selected':''?>><?php echo $quotation[$i]['quotation_code']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
			</div>
			<input type="hidden" name="poid" value="<?php echo $po['poid']; ?>">
			<div class="col-sm-6">
				<button type="submit" class="btn btn-primary w-md m-rb-5" value="Add PO">Manage PO</button>
				<a href="<?php echo base_url("account/po/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">&lt;&lt; Back</button></a>
				
			</div>
		</div>
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>PO Information</h4>
						</div>
					</div>
					<div class="panel-body">							
						<div class="row">
							<div class="col-sm-4">
								<label for="product_name" class="form-control-label" id="product_name_lbl">Product Name</label><span class="red_star">*</span>
							</div>
							<div class="col-sm-2">
								<label for="product_name" class="form-control-label" id="product_name_lbl">Quantity</label><span class="red_star">*</span>
							</div>
							<div class="col-sm-2">
								<label for="product_name" class="form-control-label" id="product_name_lbl">Action</label><span class="red_star">*</span>
							</div>
						</div>
						<?php
						$product = $po['product'];
						if(sizeof($product))
						{ 
							for($k=0; sizeof($product) > $k; $k++ )
							{ 
									?>
									<div class="row">
										<div class="col-sm-4">									
											<div class="form-group update_product_div">
												<select class="form-control basic-single" id="update_product" name="update_product[]" onchange="change_status('update_product_div')"/>
													<option selected value="">Select Product</option>
													<?php
														if(sizeof($products))
														{
															for($i=0;$i<sizeof($products);$i++)
															{
																?>
																	<option value="<?php echo $products[$i]['product_id']; ?>" <?php echo $products[$i]['product_id'] == $product[$k]['product_id'] ? 'selected' : ''?>><?php echo $products[$i]['product_name']; ?></option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
									
										<div class="col-sm-2">									
											<div class="form-group update_quantity_div">
												<input type="text" class="form-control" id="update_quantity" name="update_quantity[]" placeholder="Received Quantity" onkeyup="change_status('update_quantity_div',integer('update_quantity'))" value="<?php echo $product[$k]['quantity']?>"/>
											</div>
										</div>
										<input type="hidden" name="po_product_id[]" value="<?php echo $product[$k]['po_product_id']?>">
										<div class="col-sm-2">									
											<div class="form-group action_div">
												<select class="form-control" id="products" name="manage_action[]"/>
													<option selected value="update">Update</option>
													<option value="delete">Delete</option>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<a href="<?php echo base_url("account/product/view?id=").$product[$k]['product_id']?>" >View Product</a>
										</div>
									</div>
								
								<?php
								
							}	
						}	
							?>

							<div class="row btnSectionClone">
								<div class="col-sm-4">
									<div class="form-group add_product_div">
										<select class="form-control basic-single" id="add_product" name="add_product[]" onchange="change_status('add_product_div')"/>
											<option selected value="">Select Product</option>
											<?php
												if(sizeof($products))
												{
													for($i=0;$i<sizeof($products);$i++)
													{
														?>
															<option value="<?php echo $products[$i]['product_id']; ?>"><?php echo $products[$i]['product_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group quantity_div">
										<input type="text" class="form-control" id="add_quantity" name="add_quantity[]" placeholder="Quantity" onkeyup="change_status('add_quantity_div',integer('add_quantity'))"/>
									</div>
								</div>
								<div class="col-sm-1" id = "add_div" >
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
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
	
	$(document).on('click', '.add', function(){
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find('.select2-container--default').remove();
		$clone.find('#add_product').select2();
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
		var tnc=$("#tnc").val();
		var quotation=$("#quotation").val();
		var flag="True";
		
		if(tnc=="" || tnc==null)
		{
			$("#tnc_lbl").css("color","red");
			flag="False";
		}
		/* if(quotation=="" || quotation==null)
		{
			$("#quotation_lbl").css("color","red");
			flag="False";
		} */

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>