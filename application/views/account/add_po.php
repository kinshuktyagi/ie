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
					<li class="active">Add PO</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
		<?php 
			/* echo($vendor_id);
			exit('sdscfsf'); 
			echo"<pre>";
			print_r($tnc_data);
			exit();*/
		?>
		<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/po/add_po"); ?>">
			<div class="col-sm-3">
				<label for="vendor_name" class="form-control-label" id="vendor_lbl">Select Vendor</label><span class="red_star">*</span>
				<div class="form-group vendor_div">
					<select class="form-control basic-single" id="vendor" name="vendor" onchange="change_status('vendor_div')"/>
						<option selected value="">Select Vendor</option>
						<?php
						
							if(sizeof($vendor))
							{
								for($i=0;$i<sizeof($vendor);$i++)
								{
									?>
										<option value="<?php echo $vendor[$i]['vendor_id']; ?>" <?php echo $vendor[$i]['vendor_id']==$vendor_id?'selected':''?>><?php echo $vendor[$i]['vendor_name']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<label for="tnc" class="form-control-label" id="tnc_lbl">Select TNC</label><span class="red_star">*</span>
				<div class="form-group vendor_div">
					<select class="form-control basic-single" id="tnc" name="tnc" onchange="change_status('tnc_div')"/>
						<option selected value="">Select TNC</option>
						<?php
						
							if(sizeof($tnc_data))
							{
								for($i=0;$i<sizeof($tnc_data);$i++)
								{
									?>
										<option value="<?php echo $tnc_data[$i]['tnc_id']; ?>"><?php echo $tnc_data[$i]['tnc_name']; ?></option>
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
										<option value="<?php echo $quotation[$i]['quotation_id']; ?>"><?php echo $quotation[$i]['quotation_code']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
					<button type="submit" class="btn btn-primary w-md m-rb-5" value="Add PO">Add PO</button>
					<a href="<?php echo base_url("account/po/add"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset</button></a>
					<a href="<?php echo base_url("account/po/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">&lt;&lt; Back</button></a>
				
			</div>
		</div>
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
				<?php 
				if($vendor_id!='')
				{ 
					?>
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
								<label for="product_name" class="form-control-label" id="product_name_lbl">UOM</label><span class="red_star">*</span>
							</div>
							<div class="col-sm-2">
								<label for="product_name" class="form-control-label" id="product_name_lbl">Quantity</label><span class="red_star">*</span>
							</div>
						</div>
						<?php
						/* echo $vendor_id;
						exit(); */
						
						/* echo"<pre>";
						print_r($product);
						exit(); */
							for($k=0; 10 > $k; $k++ )
							{  
								if(sizeof($product) > $k)
								{ 
									?>
									<div class="row">
										<div class="col-sm-4">									
											<div class="form-group products_div">
												<select class="form-control basic-single products" id="products<?php echo $k;?>" name="product[]" onchange="change_status('products_div')"/>
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
											<div class="form-group uom_div">
												<select class="form-control" id="uom" name="uom" onchange="change_status('uom_div')">
													<option selected disabled value="">Select UOM Type</option>
													<?php
														if(sizeof($uom))
														{
															for($i=0;$i<sizeof($uom);$i++)
															{
																?>
																	<option value="<?php echo $uom[$i]['uom_id']; ?>"><?php echo $uom[$i]['uom_name']; ?></option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">									
											<div class="form-group quantity_div">
												<input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Received Quantity" onkeyup="change_status('quantity_div',integer('quantity'))" />
											</div>
										</div>
										<div class="col-sm-4" id="view<?php echo $k; ?>" >
											<a href="<?php echo base_url("account/product/view?id=").$product[$k]['product_id']?>">View Product</a>
										</div>
									</div>																
								<?php
								}
								else
								{	?>
									<div class="row">
										<div class="col-sm-4">									
											<div class="form-group products_div">
												<select class="form-control basic-single products" id="products<?php echo $k;?>" name="product[]" onchange="change_status('products_div')"/>
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
											<div class="form-group uom_div">
												<select class="form-control" id="uom" name="uom" onchange="change_status('uom_div')">
													<option selected disabled value="">Select UOM Type</option>
													<?php
														if(sizeof($uom))
														{
															for($i=0;$i<sizeof($uom);$i++)
															{
																?>
																	<option value="<?php echo $uom[$i]['uom_id']; ?>"><?php echo $uom[$i]['uom_name']; ?></option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">									
											<div class="form-group quantity_div">
												<input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Received Quantity" onkeyup="change_status('quantity_div',integer('quantity'))">
											</div>
										</div>
										<div class="col-sm-4" id="view<?php echo $k; ?>">
										</div>
									</div>
								
								<?php
								}?>
								
								<script>
									$("#products<?php echo $k;?>").change(function()
									{										
										var productId=$(this).val();
										if(productId)
										{
											var link = "<?php echo base_url("account/product/view?id=")?>"+productId;
											
											$('#view<?php echo $k;?>').html('<a href="'+link+'">View Product</a>');
										}
									});
								</script>
								
							<?php	
							}	
							?>

							<!--<div class="row btnSectionClone">
								<div class="col-sm-4">
									<div class="form-group products_div">
										<select class="form-control basic-single" id="products" name="product[]" onchange="change_status('products_div')"/>
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
									<div class="form-group uom_div">
										<select class="form-control" id="uom" name="uom" onchange="change_status('uom_div')">
											<option selected disabled value="">Select UOM Type</option>
											<?php
												if(sizeof($uom))
												{
													for($i=0;$i<sizeof($uom);$i++)
													{
														?>
															<option value="<?php echo $uom[$i]['uom_id']; ?>"><?php echo $uom[$i]['uom_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group quantity_div">
										<input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity" onkeyup="change_status('quantity_div_div',integer('quantity'))"/>
									</div>
								</div>								
								<div class="col-sm-1" id = "add_div" >
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
								</div>
							</div>-->
							
							<div class="row tessttst" id="tessttst">
								<div class="row">
									<div id="row_id_1">
										<div class="col-sm-4">											
											<div class="form-group products_div">
												<select class="form-control basic-single products" id="products" name="product[]" onchange="change_status('products_div')" data-srno="0" updateToBox="0"/>
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
											<div class="form-group uom_div">
												<select class="form-control" id="uom" name="uom" onchange="change_status('uom_div')"/>
													<option selected disabled value="">Select UOM Type</option>
													<?php
														if(sizeof($uom))
														{
															for($i=0;$i<sizeof($uom);$i++)
															{
																?>
																	<option value="<?php echo $uom[$i]['uom_id']; ?>"><?php echo $uom[$i]['uom_name']; ?></option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>										
										<div class="col-sm-2">
											<div class="form-group quantity_div">
												<input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity" onkeyup="change_status('quantity_div_div',integer('quantity'))"/>
											</div>
										</div>										
										<div class="col-sm-1" id = "add_div" >
											<a class="btn btn-success btn-top add" id="add_row">Add</a>
										</div>
										<div class="col-sm-2" id="totalprice0" data-srno="1"> </div>
									</div>
								</div>
							</div>						
						<?php 
						}?>	
					</div>
				</div>
			</div>		
		</div>
		</form>
	</div> 
</div>
<script>

	$(document).ready(function()
	{
		var count = 1;
		$(document).on('click', '#add_row', function()
		{
			++count;				
			var html_code = '<div class="row"><div id="row_id_'+count+'"><div class="col-sm-4"><div class="form-group products_div"><select class="form-control products" id="products" name="product[]" onchange="change_status("products_div")" data-srno="'+count+'" updateToBox="'+count+'"><option selected value="">Select Product</option><?php if(sizeof($products)){ for($i=0;$i<sizeof($products);$i++){ ?><option value="<?php echo $products[$i]['product_id']; ?>"><?php echo $products[$i]['product_name']; ?></option><?php } } ?> </select> </div> </div><div class="col-sm-2"><div class="form-group uom_div"> <select class="form-control" id="uom" name="uom" onchange="change_status("uom_div")"><option selected disabled value="">Select UOM Type</option><?php if(sizeof($uom)) { for($i=0;$i<sizeof($uom);$i++){ ?> <option value="<?php echo $uom[$i]['uom_id']; ?>"><?php echo $uom[$i]['uom_name']; ?></option> <?php } } ?> </select> </div></div><div class="col-sm-2"><div class="form-group quantity_div"><input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity" onkeyup="change_status("quantity_div_div",integer("quantity"))"> </div> </div> <div class="col-sm-1" id = "add_div" > <a class="btn btn-danger btn-top remove">Remove</a> </div> <div class="col-sm-2" id="totalprice'+count+'" data-srno="1"> </div> </div></div>';
			$('#tessttst').append(html_code);
		});
	});

	$(document).on('change', '.products', function()
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
	});
	$(document).on('click', '.remove', function(){
		$(this).parent().parent().remove();
	});


	$("#vendor").change(function()
	{
		var vendorId=$(this).val();
		if(vendorId)
		{
			document.location="<?php echo base_url("account/po/add?vendor=")?>"+vendorId;
		}
		else
		{
			document.location="<?php echo base_url("account/po/add") ?>";
		}
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	$("#frm").submit(function(e)
	{
		var vendor=$("#vendor").val();
		var tnc=$("#tnc").val();
		var quotation=$("#quotation").val();
		var flag="True";
		if(vendor=="" || vendor==null)
		{
			$("#vendor_lbl").css("color","red");
			flag="False";
		}
		if(tnc=="" || tnc==null)
		{
			$("#tnc_lbl").css("color","red");
			flag="False";
		}
		/* if(quotation=="" || quotation==null)
		{
			$("#quotation_lbl").css("color","red");
			flag="False";
		}
		 */
		/* var countdata= $('input[name="selected_product_id[]"]:checked').length;
		if(countdata==0)
		{
			alert('!! Please select product for continue !!');
			flag="False";
		} */

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>