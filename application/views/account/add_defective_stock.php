<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-title">
				<h1>Add Defective Inventory</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/defective_stock/index"); ?>">Defective Inventory Master</a></li>
					<li class="active">Add Inventory</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Add Inventory</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/defective_stock/add_stock"); ?>" enctype="multipart/form-data">
						<div class="row">
							<?php
								if(isset($_REQUEST['po_type']) && $_REQUEST['po_type']==2)
								{
									?>
										<div class="col-sm-2">
											<div class="form-group date_div col-sm-12">
												<label for="date" class="form-control-label" id="brand_lbl">Date</label><span class="red_star">*</span>
												<input type="text" class="form-control datetimepicker2" autocomplete="off" id="date" name="date"  required placeholder="Date" onblur="change_status('date_div')" value="<?php if(isset($_REQUEST['date'])){ echo $_REQUEST['date']; } ?>">
											</div>
										</div>
									<?php
								}
							?>
							
							
							<div class="col-sm-3">
								<div class="form-group po_type_div col-sm-12">
									<label for="po_type" class="form-control-label" id="po_type_lbl">Purchase Type</label><span class="red_star">*</span>
									<select class="form-control basic-single" id="po_type" name="po_type" onchange="change_status('po_type_div')">
										<option selected disabled value="">Select Purchase Type</option>
										<?php
											if(sizeof($po_type)>0)
											{
												for($i=0;$i<sizeof($po_type);$i++)
												{
													?>
														<option value="<?php echo $po_type[$i]['po_type_id']; ?>" <?php if(isset($_REQUEST['po_type']) && $_REQUEST['po_type']==$po_type[$i]['po_type_id']){ echo 'selected'; } ?>>
															<?php echo $po_type[$i]['po_type_name']; ?>
														</option>
													<?php
												}
											}
										?>	
									</select>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group vendor_div col-sm-12">
									<label for="vendor" class="form-control-label" id="vendor_lbl">Select Vendor</label><span class="red_star">*</span>
									<select class="form-control basic-single" id="vendor" name="vendor" onchange="change_status('vendor_div')">
										<option selected disabled value="">Select Vendor</option>
										<?php
											if(sizeof($vendor)>0)
											{
												for($i=0;$i<sizeof($vendor);$i++)
												{
													?>
														<option  value='<?php echo $vendor[$i]['vendor_id']; ?>' <?php if(isset($_REQUEST['vendor']) && $_REQUEST['vendor']==$vendor[$i]['vendor_id']){ echo 'selected'; } ?>>
															<?php echo $vendor[$i]['vendor_name'].' / '.$vendor[$i]['vendor_code']; ?>
														</option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>
							
								<div class="col-sm-4">
									<div class="form-group vendor_po_div col-sm-12">
										<label for="vendor_po" class="form-control-label" id="vendor_po_lbl">Select PO</label>
										<select class="form-control basic-single" id="vendor_po" name="vendor_po" onchange="change_status('vendor_po_div')">
											<option selected disabled value="">Select PO</option>
											<?php
												if(sizeof($vendor_po)>0)
												{
													for($i=0;$i<sizeof($vendor_po);$i++)
													{
														?>
															<option  value='<?php echo $vendor_po[$i]['poid']; ?>' <?php if(isset($_REQUEST['po']) && $_REQUEST['po']==$vendor_po[$i]['poid']){ echo 'selected'; } ?>>
																<?php echo $vendor_po[$i]['add_date'].' / Quantity '.$vendor_po[$i]['quantity'].' / Pending '.$vendor_po[$i]['pending_qty']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							
						</div>
						<?php
							if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==1) && (isset($_REQUEST['po']) && $_REQUEST['po']!=''))
							{
								?>
								
									<div class="row">
										<div class="col-sm-12"> 
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr class="t_head">
															<th>Vendor Code</th>
															<th>Vendor Name</th>
															<th>GST Number</th>
															<th>PO ID</th>
															<th>Add Date</th>
															<th>Total Quantity</th>
															<th>Received Quantity</th>
															<th>Pending Quantity</th>
															<th>Received Status</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php echo $vendor_po_info['vendor_code'];  ?></td>
															<td><?php echo $vendor_po_info['vendor_name'];  ?></td>
															<td><?php echo $vendor_po_info['gst_number'];  ?></td>
															<td><?php echo $vendor_po_info['poid'];  ?></td>
															<td><?php echo $vendor_po_info['add_date'];  ?></td>
															<td><?php echo $vendor_po_info['quantity'];  ?></td>
															<td><?php echo $vendor_po_info['received_quantity'];  ?></td>
															<td><?php echo $vendor_po_info['pending_qty'];  ?></td>
															<td><?php echo $vendor_po_info['receive_status'];  ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									</br>
									<div class="row">
										<div class="col-sm-12"> 
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr class="t_head">
															<th>Product Name</th>
															<th>Total Quantity</th>
															<th>Received Quantity</th>
															
															<th>Defective Quantity</th>
															<th>Remain Quantity</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(sizeof($vendor_po_product)>0)
															{
																for($i=0;$i<sizeof($vendor_po_product);$i++)
																{
																	$total=$vendor_po_product[$i]['received_quantity']-$vendor_po_product[$i]['quantity_defective'];
																	?>
																		<tr>
																			<td><?php echo $vendor_po_product[$i]['product_name'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['quantity'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['received_quantity'];  ?></td>
																			
																			<td><?php echo $vendor_po_product[$i]['quantity_defective'];  ?></td>
																			<td><?php echo $total;  ?></td>
																			<td>
																				<input type="hidden"  name="product_id[]" value="<?php echo $vendor_po_product[$i]['product_id'];  ?>"/>
																				<input type="text" name="process_qty[]" class="form-control" style="width:80px;" id="i<?php echo $vendor_po_product[$i]['product_id'] ?>" placeholder="QTY"  value="" onkeyup="intfloat('i<?php echo $vendor_po_product[$i]['product_id'] ?>')"/>
																				
																					<script>
																						$("#i<?php echo $vendor_po_product[$i]['product_id'] ?>").keyup(function()
																						{
																							var qty=$(this).val();
																							//alert(qty);
																							var real_qty=parseFloat("<?php echo $total;  ?>");
																							
																							if(qty>real_qty)
																							{
																								$(this).val(real_qty);
																							}
																						});
																					</script>
																				
																			</td>
																		</tr>
																	<?php
																}
															}
															else
															{
																?>
																	<tr>
																		<td colspan="6">
																			Sorry no record found to display...
																		</td>
																	</tr>
																<?php
															}
														?>
													
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="row">
										<br>
										<div class="col-sm-5"> 
											<textarea name="description" placeholder="Description" rows="5" required style="width:100%;"></textarea>
										</div>
										<div class="col-sm-12"> 
											<button type="submit" class="btn btn-primary w-md m-rb-5">Add Defective Stock</button>
											<a href="<?php echo base_url("account/defective_stock/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
										</div>
									</div>
								<?php
							}
							if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==2))
							{
								?>
									<div class="row">
											<div class="col-sm-3" style="padding-left:20px;"><label class="form-control-label">Raw Product</label></div>
											<div class="col-sm-3"><label class="form-control-label">Quantity</label></div>
									</div>
								<?php
								for($j=0;$j<9;$j++)
								{
									?>
										<div class="row">
											<div class="col-sm-3">
												<div class="form-group product<?php echo $j; ?>_div col-sm-12">
													
													<select class="form-control basic-single" id="product<?php echo $j; ?>" <?php if($j==0){ echo'required'; } ?> name="product[]" onchange="change_status('po_type_div')">
														<option selected value="">Select Product</option>
														<?php
															if(sizeof($product)>0)
															{
																for($i=0;$i<sizeof($product);$i++)
																{
																	?>
																		<option value="<?php echo $product[$i]['product_id']; ?>">
																			<?php echo $product[$i]['product_name']; ?>
																		</option>
																	<?php
																}
															}
														?>	
													</select>
												</div>
											</div>
											<div class="col-sm-3">
												<input type="text" name="quantity[]" id="qty<?php echo $j; ?>" placeholder="QTY" <?php if($j==0){ echo'required'; } ?> onkeyup="intfloat('qty<?php echo $j ?>')" class="form-control" style="width:100px;"/>
											</div>
										</div>
									<?php
								}
								?>
									<div class="row">
										<br>
										<div class="col-sm-5"> 
											<textarea name="description" placeholder="Description" rows="5" required style="width:100%;"></textarea>
										</div>
										<div class="col-sm-12" style="padding-left:10px;">
											<button type="submit" class="btn btn-primary w-md m-rb-5">Add Inventory</button>
											<a href="<?php echo base_url("account/defective_stock/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
										</div>
									</div>
								<?php
							}
						?>
						
					
					</div>
				</div>
			</div>
		</div>
		</div>
		</form>
	</div> 
</div>
<script>

	$(document).on('change','#vendor',function()
	{
		var vendor=$('#vendor').val();
		var po_type=$('#po_type').val();
		if(po_type==2)
		{
			$('#vendor_po').html('<option selected disabled value="">Select PO</option>');
			witouthpo();
		}
		else
		{
			$('#vendor_po').html('<option selected disabled value="">Please wait while loading...</option>');
			  $.ajax({url:"<?php echo base_url('account/defective_stock/get_vendor_po'); ?>",method:'POST',data:{vendor:vendor},success:function(a)
			  {
				  $('#vendor_po').html(a);
			  }});
		}
		
	});
	$(document).on('change','#vendor_po',function()
	{
		var po_type=$('#po_type').val();
		if(po_type==1)
		{
			withpo();
		}
	});

	function withpo()
	{
		var date=$('#date').val();
		var po_type=$('#po_type').val();
		var vendor=$('#vendor').val();
		var vendor_po=$('#vendor_po').val();
		var flag="True";
		if(po_type=="" || po_type==null)
		{
			$(".po_type_div").addClass("has-danger");
			flag="False";
		}
		if(vendor=="" || vendor==null)
		{
			$(".vendor_div").addClass("has-danger");
			flag="False";
		}
		if(vendor_po=="" || vendor_po==null)
		{
			$(".vendor_po_div").addClass("has-danger");
			flag="False";
		}
		if(flag=="True")
		{
			var qry=document.location="<?php echo base_url('account/defective_stock/add?po_type='); ?>"+po_type+'&vendor='+vendor+'&po='+vendor_po;
		}
	}
	function witouthpo()
	{
		var date=$('#date').val();
		var po_type=$('#po_type').val();
		var vendor=$('#vendor').val();
		var flag="True";
		
		if(po_type=="" || po_type==null)
		{
			$(".po_type_div").addClass("has-danger");
			flag="False";
		}
		/* if(vendor=="" || vendor==null)
		{
			$(".vendor_div").addClass("has-danger");
			flag="False";
		} */
		if(flag=="True")
		{
			var qry=document.location="<?php echo base_url('account/defective_stock/add?po_type='); ?>"+po_type+'&vendor='+vendor;
		}
	}
	
	

	$(document).on('change', '#po_type', function() {
	  var po_type=$(this).val();
	  if(po_type==1)
	  {
		   $('#vendor').html('<option selected disabled value="">Please wait while loading...</option>');
		  $.ajax({url:"<?php echo base_url('account/defective_stock/get_vendor'); ?>",method:'POST',data:{po_type:po_type},success:function(a)
		  {
			  $('#vendor').html(a);
		  }});
	  }
	  if(po_type==2)
	  {
		  witouthpo();
		  $('#vendor_po').html('<option selected disabled value="">Select PO</option>');
	  }
	});



	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	$("#frm").submit(function(e)
	{
		/* var flag="True";
		var brand=$("#brand").val();

		if(brand=="" || brand==null)
		{
			$(".brand_div").addClass("has-danger");
			flag="False";
		}
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		} */
	});
	
$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});
</script>