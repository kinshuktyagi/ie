<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Enquiry</h1>
				<small>Enquiry Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li><a href="<?php echo base_url("account/enquiry/index"); ?>">Enquiry List</a></li>
					<li class="active">Add Enquiry</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry Information</h4>
						</div>
					</div>
					<div class="panel-body">
						
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/enquiry/add_enquiry_items"); ?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-2">
									<label for="material_name" class="form-control-label" id="material_name_lbl">Part Name</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-2">
									<label for="material_name" class="form-control-label" id="material_name_lbl">Drawing Number</label><span class="red_star">*</span>
								</div>
								<!--<div class="col-sm-1">
									<label for="material_name" class="form-control-label" id="material_name_lbl">Part Number</label>
								</div>-->
								<div class="col-sm-1">
									<label for="material_qty" class="form-control-label" id="material_qty_lbl">Quantity</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-1">
									<label for="material_weight" class="form-control-label" id="material_weight_lbl">Weight</label>
								</div>
								<div class="col-sm-2">
									<label for="drawing_name" class="form-control-label" id="drawing_name_lbl">DRAWING</label>
								</div>
								<div class="col-sm-2">
									<label for="cad_name" class="form-control-label" id="cad_name_lbl">CAD</label>						
								</div>
								<div class="col-sm-2">
									<label for="parts_description" class="form-control-label" id="parts_description_lbl">Parts Description
								</div>
							</div>
							<?php 
							for($j=0; 5>$j; $j++)
							{
								?>
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group material_name_div">
											<input type="text" class="form-control" id="material_name<?php echo $j; ?>" name="material_name[]" placeholder="Part Name" onkeyup="change_status('material_name_div')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group drawing_number_div">
											<input type="text" class="form-control" id="drawing_number<?php echo $j; ?>" name="drawing_number[]" placeholder="Drawing No" onkeyup="change_status('drawing_number_div'), integer('drawing_number<?php echo $j; ?>')" style="width:105%;  padding: 5px;"/>
										</div>
									</div>
									<!--<div class="col-sm-1">
										<div class="form-group part_number_div">
											<input type="text" class="form-control" id="part_number<?php echo $j; ?>" name="part_number[]" placeholder="Part No" onkeyup="change_status('part_number_div'), integer('part_number<?php echo $j; ?>')" style="width:110%"/>
										</div>
									</div>-->
									
									<div class="col-sm-1">
										<div class="form-group material_qty_div">
											<input type="text" class="form-control" id="material_qty<?php echo $j; ?>" name="material_qty[]" placeholder="qty" onkeyup="change_status('material_qty_div'), integer('material_qty<?php echo $j; ?>')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group material_weight_div">
											<input type="text" class="form-control" id="material_weight<?php echo $j; ?>" name="material_weight[]" placeholder="weight" onkeyup="change_status('material_weight_div'), integer('material_weight<?php echo $j; ?>')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group drawing_name_div">
											<input type="file" class="form-control" id="drawing_name <?php echo $j;?>" name="drawing_name[]" onkeyup="change_status('drawing_name_div')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group cad_name_div">
											<input type="file" class="form-control" id="cad_name<?php echo $j;?>" name="cad_name[]" placeholder="CAD Name" onkeyup="change_status('cad_name_div')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group parts_description_div">
											<textarea rows="1" cols="50" type="text" class="form-control" id="parts_description<?php echo $j;?>" name="parts_description[]" placeholder="Description" onkeyup="change_status('parts_description_div')"style="width:110%"></textarea>
										</div>
									</div>
								</div>
								<?php 
							}?>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Enquiry</button>
										<a href="<?php echo base_url("account/enquiry/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div></br>
						</form>
					
						<div class="panel-heading">
							<div class="panel-title">
								<h4>Enquiry Data</h4>
							</div>
						</div>
						<div class="panel-body" style="padding:1px !important;">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr class="t_head">
											<th style="min-width: 120px;">Part Name</th>
											<th style="min-width: 130px;">Drawing Number</th>
											<!--<th style="min-width: 120px;">Part Number</th>-->
											<th>Quantity</th>
											<th>Weight</th>
											<th>Drawing</th>
											<th>CAD</th>
											<th style="min-width: 140px;">Parts Description</th>
											<th>Action</th>						
										</tr>
									</thead>
									<tbody>
										<?php
											$cart = $this->cart->contents();
											if(sizeof($cart)>0)
											{
												foreach ($cart as $item)
												{
													?>
													<tr>
														<td><?php echo $item['name']; ?></td>
														<td><?php echo $item['drawing_number']; ?>
															<!--<div class="col-sm-8">
																<input class="form-control qty_child" type="number" name="draw_num" id="draw_num" value="<?php echo $item['drawing_number']; ?>" >
															</div>
															<button type="button" id="<?php echo $item['rowid'] ?>" class="btn btn-warning m-rb-5 draw_num_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>-->
														</td>
														<!--<td><?php echo $item['part_number']; ?>
															<div class="col-sm-8">
																<input class="form-control qty_child" type="number" name="part_num" id="part_num" value="<?php echo $item['part_number']; ?>">
															</div>
															<button type="button" id="<?php echo $item['rowid'] ?>" class="btn btn-warning m-rb-5 part_num_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>-->
														</td>
														<td>
															<div class="col-sm-8">
																<input class="form-control qty_child" type="number" name="qty" id="qty" value="<?php echo $item['qty']; ?>">
															</div>
															<button type="button" id="<?php echo $item['rowid'] ?>" class="btn btn-warning m-rb-5 child_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>
														</td>
														<td>
															<div class="col-sm-8">
																<input class="form-control weight_child_val" type="number" name="weight" id="weight" value="<?php echo $item['weight']; ?>">
															</div>
															<button type="button" id="<?php echo $item['rowid'] ?>" class="btn btn-warning m-rb-5 weight_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>	
														</td>
														<td>
															<a href="<?php echo base_url().'uploads/'.$item['options']['Size'];?>"><i class="glyphicon glyphicon-download-alt"></i>
														</td>
														<td>
															<a href="<?php echo base_url().'uploads/'.$item['options']['Color'];?>"><i class="glyphicon glyphicon-download-alt"></i>
														</td>
														<td><?php echo $item['coupon']; ?></td>
														<td>
															<button type="button" id="<?php echo $item['rowid'] ?>" class="btn btn-danger btn-sm m-rb-5 delete" value="D"><i class="glyphicon  glyphicon-trash"></i>
															</button>
														</td>
													</tr>
													<?php
												}
											}
											else
											{
												?>
												<tr>
													<td colspan="9">
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
					
					<?php
					
						if(sizeof($cart)>0)
						{ ?>
							<form method="POST" id="frm_sbmt" autocomplete="off" action="<?php echo base_url("account/enquiry/add");?>">						
								<div class="panel-body">							
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group order_type_div">
											<label for="order_type" class="form-control-label" id="order_type_lbl">Order Type</label><span class="red_star">*</span>
											<div id="otder_typ">
												<select class="form-control" id="order_type" name="order_type" onchange="change_status('order_type_div')">
													<option selected disabled value="">Select Order Type</option>
													<option value="1">Sales</option>
													<option value="2">Job Work</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group company_name_div">
											<label for="last_name" class="form-control-label" id="company_name_lbl">Select Customer</label>
											<select class="form-control basic-single" id="company_name" name="company_name" onchange="change_status('company_name_div')">
												<option selected disabled value="">Select Customer</option>
												<?php
													if(sizeof($cust_info))
													{
														for($i=0;$i<sizeof($cust_info);$i++)
														{ ?>
															<option value="<?php echo $cust_info[$i]['cust_id']; ?>"><?php echo $cust_info[$i]['name']; ?></option>
															<?php
														}
													}
												?>
											</select>
											<a href="<?php echo base_url()?>account/customer/add_customer">Add New Customer</a> 
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group order_date_div">
											<label for="order_date" class="form-control-label" id="order_date_lbl">Delivery Date</label>
											<input type="text" class="form-control datetimepicker2" id="order_date" name="order_date" placeholder="Delivery Date" readonly onchange="change_status('order_date_div')">
										</div>
									</div>									
								</div>								
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<button type="submit" class="btn btn-base pull-left">Submit Enquiry</button>
											<a href="<?php echo base_url("account/enquiry/index") ?>">
											</a>				
										</div>
										<button style="margin-left: 10px; margin-top: -18px;" type="button" id="clear_all" class="btn btn-warning m-rb-5 btn-sm" value="all"></i>Clear All Iteams</button>
									</div>
								</div>
							</form>								
						<?php 
						} ?>					
					</div>
				</div>
			</div>		
		</div>		
	</div> 
</div>
<script>
	
	$('#clear_all').click(function() 
	{
		var row_id='all';
		var res = confirm('Are You Sure ?');
		if(res == true)
		{
			$.ajax({url:'<?php echo base_url("account/enquiry/remove_item");?>',method:'POST',data:{row_id:row_id},success:function(a)
			{
				location.reload(true);
			}});					
		}
	});

	$('.delete').click(function() 
	{
		var row_id=$(this).prop('id');
		var res = confirm('Are You Sure ?');
		if(res == true)
		{
			if(row_id)
			{
				$.ajax({url:'<?php echo base_url("account/enquiry/remove_item");?>',method:'POST',data:{row_id:row_id},success:function(a)
				{
					location.reload(true);
				}}); 
			}			
		}
	});
	
	$('.child_refresh').click(function() 
	{
		var row_id=$(this).prop('id');
		var qty=$(this).parents('tr').find('input.qty_child').val();
		
			if(row_id && qty>0)
			{
				$.ajax({url:'<?php echo base_url("account/enquiry/update_item_qty");?>',method:'POST',data:{row_id:row_id,qty:qty},success:function(a)
				{
					location.reload(true);
				}}); 
			}			
		//}
	});
	
	$('.weight_refresh').click(function() 
	{
		var row_id=$(this).prop('id');
		var weight=$(this).parents('tr').find('input.weight_child_val').val();
		
		if(row_id && weight>0)
		{
			$.ajax({url:'<?php echo base_url("account/enquiry/update_item_weight");?>',method:'POST',data:{row_id:row_id,weight:weight},success:function(a)
			{
				location.reload(true);
			}}); 
		}			
		
	});
	
	/* $(document).on("change","#order_type",function()
	{
		var order_type=$("#order_type").val();
		if(order_type)
		{
			$.ajax({url:"<?php echo base_url("account/enquiry/get_order_type"); ?>",method:"POST",data:{order_type:order_type},success:function(a)
			{
				$("#otder_typ").html(a);
				location.reload('true');
			}});
		}
	}); */


	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	
	$("#frm_sbmt").submit(function(e)
	{
		var flag="True";
		var order_type = $("#order_type").val();
		var company_name = $("#company_name").val();
		var contact_person_name = $("#contact_person_name").val();
		var contact_number = $("#contact_number").val();
		var email = $("#email").val();
		var order_date = $("#order_date").val();
		var city = $("#city").val();
		var address = $("#address").val();
		
		if(order_type=="" || order_type==null)
		{
			$(".order_type_div").addClass("has-danger");
			flag="False";
		}
		if(company_name=="" || company_name==null)
		{
			$(".company_name_div").addClass("has-danger");
			flag="False";
		}
		if(contact_person_name=="")
		{
			$(".contact_person_name_div").addClass("has-danger");
			flag="False";
		}
		if(contact_number=="")
		{
			$(".contact_number_div").addClass("has-danger");
			flag="False";
		}
		if(email=="")
		{
			$(".email_div").addClass("has-danger");
			flag="False";
		}
		if(order_date=="")
		{
			$(".order_date_div").addClass("has-danger");
			flag="False";
		}
		if(city=="")
		{
			$(".city_div").addClass("has-danger");
			flag="False";
		}
		if(address=="")
		{
			$(".address_div").addClass("has-danger");
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
	
	$(function () {
		$('.datetimepicker2').datetimepicker({  minDate:new Date()});
	});

</script>