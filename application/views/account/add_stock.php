<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-title">
				<h1>Add Inventory</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/stocks/index"); ?>">Inventory Master</a></li>
					<li class="active">Add Inventory</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Inventory Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/stocks/add_stock"); ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group date_div col-sm-12">
									<label for="date" class="form-control-label" id="brand_lbl">Date</label><span class="red_star">*</span>
									<input type="text" class="form-control datetimepicker2" id="date" name="date" readonly  placeholder="Date" onblur="change_status('date_div')" value="<?php if(isset($_REQUEST['date'])){ echo $_REQUEST['date']; } ?>">
								</div>
							</div>							
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
							
							<div class="col-sm-3">
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
															<th>Product Code</th>
															<th>Product Name</th>
															<th>Total Quantity</th>
															<th>Received Quantity</th>
															<th>Pending Quantity</th>
															<th>Received Status</th>
															<!--<th>R Number</th>
															<th>S Number</th>-->
															<th>Action</th>
															<th>Add Rack & Shelf</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(sizeof($vendor_po_product)>0)
															{
																for($i=0;$i<sizeof($vendor_po_product);$i++)
																{
																	?>
																		<tr>
																			<td><?php echo $vendor_po_product[$i]['product_code'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['product_name'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['quantity'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['received_quantity'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['pending_qty'];  ?></td>
																			<td><?php echo $vendor_po_product[$i]['received_status'];  ?></td>
	<!--<div class="form-group r_number_div">																
		<td>
			<input type="text" name="r_number[]" class="form-control" style="width:90px;" id="r_num<?php echo $vendor_po_product[$i]['po_product_id'] ?>" placeholder="R Number" onkeyup= "change_status('parts_description_div'),integer('r_num<?php echo $vendor_po_product[$i]['po_product_id'] ?>')"/>
		</td>
	</div>
																
	<div class="form-group ">																
		<td>
			<input type="text" name="s_number[]" class="form-control s_number_div" style="width:90px;" id="s_num<?php echo $vendor_po_product[$i]['po_product_id'] ?>" placeholder="R Number" onkeyup="change_status('parts_description_div'), integer('s_num<?php echo $vendor_po_product[$i]['po_product_id'] ?>')"/>	
		</td>
	</div>-->
																			<td>
																				<input type="hidden"  name="po_product_id[]" value="<?php echo $vendor_po_product[$i]['po_product_id'];  ?>"/>
																				<input type="hidden"  name="product_id[]" value="<?php echo $vendor_po_product[$i]['product_id'];  ?>"/>
																				<input type="hidden"  name="total_qty[]" value="<?php echo $vendor_po_product[$i]['quantity'];?>"/>
																				<input type="hidden"  name="received_quantity[]" value="<?php echo $vendor_po_product[$i]['received_quantity'];  ?>"/>
																				<input type="text" name="process_qty[]" class="form-control" style="width:80px;" id="i<?php echo $vendor_po_product[$i]['po_product_id'] ?>" placeholder="QTY"  value="<?php echo $vendor_po_product[$i]['pending_qty'];  ?>" onkeyup="intfloat('i<?php echo $vendor_po_product[$i]['po_product_id'] ?>')"/>				
																					<script>
																						$("#i<?php echo $vendor_po_product[$i]['po_product_id'] ?>").keyup(function()
																						{
																							var qty=$(this).val();
																							var real_qty="<?php echo $vendor_po_product[$i]['pending_qty'];  ?>";
																							if(qty>real_qty)
																							{
																								$(this).val(real_qty);
																							}
																						});
																					</script>
																			</td>
																	</form>
<td>
<button type="button" class="btn btn-warning md-trigger action" data-modal="modal-<?php echo $vendor_po_product[$i]['po_product_id']; ?>">Add Rack/Shelf</button>
		<div class="md-modal  md-effect-7" id="modal-<?php echo $vendor_po_product[$i]['po_product_id'];?>" style="max-width: 100%; width: 90%; margin-top: 30px">
		<div class="md-content" style=" box-shadow: 1px 0 10px #0000006b;height: 80vh;overflow-y: auto;">
			<h3 style="padding: 5px;"> Add Rack / Shelf Number<button type="button" class="btn btn-base md-close" style="position: absolute; right: 30px; top: 7px;font-size: 12px;">Close!</button></h3>
			<div class="n-modal-body" style="padding: 15px;background: #f8fafa !important;">
				<div class="col-sm-12">
					<div class="panel panel-bd lobidrag">					
						<div class="panel-body">							
							<div class="row">
								<div class="form-group col-sm-3">
									<label class="form-control-label">Product Code:</label>
									<div><?php echo $vendor_po_product[$i]['product_code'] ?></div>
								</div>
								<div class="form-group col-sm-3">
									<label class="form-control-label">Product Name:</label>
									<div><?php echo $vendor_po_product[$i]['product_name'] ?></div>
								</div>
							</div><br>
							<form method="POST" id="frm<?php echo $vendor_po_product[$i]['po_product_id'] ?>" autocomplete="off" action="<?php echo base_url("account/stocks/add_rack_shelf");?>">
								<input type="hidden" name="product_id" value="<?php echo $vendor_po_product[$i]['po_product_id']; ?>">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group rack_number_div col-sm-12">
											<label for="rack_number" class="form-control-label" id="rack_number_lbl">Rack Number</label><span class="red_star">*</span>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group shelf_number_div col-sm-12">
											<label for="shelf_number" class="form-control-label" id="shelf_number_lbl">Shelf Number</label><span class="red_star">*</span>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group shelf_number_div col-sm-12">
											<label for="shelf_number" class="form-control-label" id="shelf_number_lbl">Quantity</label><span class="red_star">*</span>
										</div>
									</div>
									<div class="col-sm-3">
										<label for="shelf_number" class="form-control-label" id="shelf_number_lbl">Action</label>
									</div>
								</div>
								<div class="row btnSectionClone">
									<div class="col-sm-3">
										<div class="form-group rack_number_div col-sm-12">
											<input type="text" class="form-control" id="rack_number<?php echo $vendor_po_product[$i]['po_product_id'];?>" name="rack_number[]" placeholder="Rack Number" onkeyup="change_status('rack_number_div', integer(rack_number<?php echo $vendor_po_product[$i]['po_product_id']?>)" >
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group shelf_number_div col-sm-12">
											<input type="text" class="form-control" id="shelf_number<?php echo $vendor_po_product[$i]['po_product_id'];?>" name="shelf_number[]" placeholder="Shelf Number" onkeyup="change_status('shelf_number_div', integer(shelf_number<?php echo $vendor_po_product[$i]['po_product_id']?>)" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group product_qty_div col-sm-12">
											<input type="text" class="form-control" id="product_qty<?php echo $vendor_po_product[$i]['po_product_id'];?>" name="product_qty[]" placeholder="Quantity" onkeyup="change_status('product_qty_div', integer(product_qty<?php echo $vendor_po_product[$i]['po_product_id'];?>)" >
										</div>
									</div>
									<div class="col-sm-3" id="add_div">
										<a class="btn btn-success btn-top add_rack" id="add_row">Add</a>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-3">
										<button type="submit" class="btn btn-primary" value="Add" style="margin-left: 10px;">Submit</button>
									</div>
								</div>
								
								<script type="text/javascript">
									function change_status(div)
									{
										$("."+div).removeClass("has-danger");
									}
									
									$("#frm<?php echo $vendor_po_product[$i]['po_product_id'];?>").submit(function(e)
									{
										var flag="True";
										var rack_number = $("#rack_number<?php echo $vendor_po_product[$i]['po_product_id'];?>").val();
										
										
										if(rack_number=="" || rack_number==null)
										{
											$(".rack_number_div").addClass("has-danger");
											flag="False";
										}
										if(flag=="False")
										{
											e.preventDefault();
											return false;
										}
									});
								</script>
								
								
								
							</form>
						</div>
						</div>
					</div>	
				</div>				 
				<button type="button" class="btn btn-base md-close myextra-btn">Close!</button> 
			</div>
		</div>
	</div>
</td>
																		</tr>
																	<?php
																}
															}
														?>
													
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12"> 
											<button type="submit" class="btn btn-primary w-md m-rb-5">Add Stock</button>
											<a href="<?php echo base_url("account/stocks/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
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
													
													<select class="form-control basic-single" id="product<?php echo $j; ?>" name="product[]" onchange="change_status('po_type_div')">
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
												<input type="text" name="quantity[]" id="qty<?php echo $j; ?>" placeholder="QTY" onkeyup="intfloat('qty<?php echo $j ?>')" class="form-control" style="width:100px;"/>
											</div>
										</div>
									<?php
								}
								?>
									<div class="row">
										<div class="col-sm-3" style="padding-left:20px;">
											<button type="submit" class="btn btn-primary w-md m-rb-5">Add Inventory</button>
											<a href="<?php echo base_url("account/stocks/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
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
<script src="<?php echo base_url("public/assets/plugins/modals/modalEffects.js"); ?>"></script>
<script>
	$(document).on('click', '.add_rack', function(){
		
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add_rack').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$tr.before($clone);
	});
	
	$(document).on('click', '.remove', function(){
		
		$(this).closest('.btnSectionClone').remove();
	});
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
			  $.ajax({url:"<?php echo base_url('account/stocks/get_vendor_po'); ?>",method:'POST',data:{vendor:vendor},success:function(a)
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
	$(document).on('blur','#date',function()
	{
		var po_type=$('#po_type').val();
		if(po_type==1)
		{
			withpo();
		}
		else
		{
			witouthpo();
		}
	});

	function withpo()
	{
		var date=$('#date').val();
		var po_type=$('#po_type').val();
		var vendor=$('#vendor').val();
		var vendor_po=$('#vendor_po').val();
		var flag="True";
		if(date=="")
		{
			$(".date_div").addClass("has-danger");
			flag="False";
		}
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
			var qry=document.location="<?php echo base_url('account/stocks/add?date='); ?>"+date+'&po_type='+po_type+'&vendor='+vendor+'&po='+vendor_po;
		}
	}
	function witouthpo()
	{
		var date=$('#date').val();
		var po_type=$('#po_type').val();
		var vendor=$('#vendor').val();
		var flag="True";
		if(date=="")
		{
			$(".date_div").addClass("has-danger");
			flag="False";
		}
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
		if(flag=="True")
		{
			var qry=document.location="<?php echo base_url('account/stocks/add?date='); ?>"+date+'&po_type='+po_type+'&vendor='+vendor;
		}
	}
	
	

	$(document).on('change', '#po_type', function() {
	  var po_type=$(this).val();
	  if(po_type)
	  {
		   $('#vendor').html('<option selected disabled value="">Please wait while loading...</option>');
		  $.ajax({url:"<?php echo base_url('account/stocks/get_vendor'); ?>",method:'POST',data:{po_type:po_type},success:function(a)
		  {
			  $('#vendor').html(a);
		  }});
	  }
	  if(po_type==2)
	  {
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
	
	$('.myextra-btn').click(function () {
		$('.md-modal').removeClass('md-show');
	});
</script>