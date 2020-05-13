<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Enquiry</h1>
				<small>Enquiry Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li><a href="<?php echo base_url("account/enquiry/index"); ?>">Enquiry List</a></li>
					<li class="active">Manage Enquiry</li>
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
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/enquiry/update_enquiry_items"); ?>" enctype="multipart/form-data">
						
							<div class="row">
								<div class="col-sm-2">
									<label for="material_name" class="form-control-label" id="material_name_lbl">Part Name</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-1">
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
											<input type="text" class="form-control" id="material_name<?php echo $j; ?>" name="material_name[]" placeholder="Material Name" onkeyup="change_status('material_name_div')" style="width:110%"/>
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group drawing_number_div">
											<input type="text" class="form-control" id="drawing_number<?php echo $j; ?>" name="drawing_number[]" placeholder="Drawing No" onkeyup="change_status('drawing_number_div'), integer('drawing_number<?php echo $j; ?>')" style="width:125%;  padding: 5px;"/>
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
							
							
							<input type="hidden" value="<?php echo $enquiry_id; ?>" name="enq_id">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" id="iteam_form" class="btn btn-base pull-left">Add Enquiry</button>
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
									<tbody id="data_iteams">
										<?php
											
											if(sizeof($info_items)>0)
											{
												for($j=0; sizeof($info_items)>$j; $j++)
												{
													?>
													<tr>
														<td><?php echo $info_items[$j]['material_name']; ?></td>
														<td><?php echo $info_items[$j]['drawing_number']; ?></td>
														<!--<td><?php echo $info_items[$j]['part_number']; ?></td>-->
														<td>
															<div class="col-sm-8">
																<input class="form-control qty_child" type="number" name="qty" id="qty" value="<?php echo $info_items[$j]['quantity']; ?>">
																<input type="hidden" class="child_enq_id" name="enquiry_id" value="<?php echo $info_items[$j]['enquiry_id']?>">
															</div>
															<button type="button" id="<?php echo $info_items[$j]['id'] ?>" class="btn btn-warning m-rb-5 child_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>
														</td>
														<td>
															<div class="col-sm-8">
																<input class="form-control weight_child_val" type="number" name="weight" id="weight" value="<?php echo $info_items[$j]['weight']; ?>">
															</div>		
															<button type="button" id="<?php echo $info_items[$j]['id'] ?>" class="btn btn-warning m-rb-5 weight_refresh btn-sm" value="R"><i class="glyphicon glyphicon-refresh"></i></button>	
														</td>
														<td>
														<a href="<?php echo base_url().'uploads/'. $info_items[$j]['drawing'];?>"><i class="glyphicon glyphicon-download-alt"></i></a>
														</td>
														<td>
														<a href="<?php echo base_url().'uploads/'. $info_items[$j]['cad'];?>"><i class="glyphicon glyphicon-download-alt"></i></a>
														</td>
														<td><?php echo $info_items[$j]['description']; ?></td>
														<td>
															<button type="button" id="<?php echo $info_items[$j]['id'] ?>" class="btn btn-danger btn-sm m-rb-5 delete" value="D"><i class="glyphicon  glyphicon-trash"></i>
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
					</div>
					
				</div>
			</div>		
		</div>		
	</div> 
</div>
<script>

	$('.child_refresh').click(function() 
	{
		var row_id=$(this).prop('id');
		var qty=$(this).parents('tr').find('input.qty_child').val();
		var enquiry_id=$(this).parents('tr').find('input.child_enq_id').val();
		
		if(row_id && qty>0)
		{
			$.ajax({url:'<?php echo base_url("account/enquiry/update_item_quantity");?>',method:'POST',data:{row_id:row_id,qty:qty,enquiry_id:enquiry_id},success:function(a)
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
				$.ajax({url:'<?php echo base_url("account/enquiry/remove_enquiry_item");?>',method:'POST',data:{row_id:row_id},success:function(a)
				{
					location.reload(true);
				}}); 
			}			
		}
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

	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});

</script>