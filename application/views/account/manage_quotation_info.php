<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Quotation</h1>
				<small>Manage Quotation Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/quotation/index"); ?>">Quotation Master</a></li>
					<li class="active">Manage Quotation</li>
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
					<?php 
					/* echo"<pre>";
					print_r($info_data);
					exit(); */
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label">Customer Name</label></br>
									<span><?php echo $enquiry_info['name']?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label">Order Type</label></br>
									<span>
										<?php
											if($enquiry_info['order_type'] =='1')
											{
												echo"Sales";
											}else{
												echo "Job Work";
											}
										?>
									</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Email</label></br>
									<span><?php echo $enquiry_info['email']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Phone</label></br>
									<span><?php echo $enquiry_info['phone']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
									<span><?php echo $enquiry_info['aadhar']?></span>
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">PAN</label></br>
									<span> <?php echo $enquiry_info['pan']; ?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Tan</label></br>
									<span><?php echo $enquiry_info['tan']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
									<span><?php echo $enquiry_info['aadhar']?></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Address</label></br>
									<span><?php echo $enquiry_info['address'].','.$enquiry_info['pincode'].'<br>'.$enquiry_info['city'].','.$enquiry_info['stateName'].','.$enquiry_info['countryName'] ?></span>
								</div>
							</div>
						</div>
						
						<h4>Enquiry Items</h4>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 145px">Part Name</th>
										<th>Quantity</th>
										<th>Weight</th>
										<th>Drawing</th>
										<th>CAD</th>
										<th>Parts Description</th>									
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($item_info)>0)
										{
											for($i=0;$i<sizeof($item_info);$i++)
											{
												?>
													<tr>
														<td><?php echo $item_info[$i]['part_name']; ?></td>
														<td><?php echo $item_info[$i]['quantity']; ?></td>
														<td><?php echo $item_info[$i]['weight']; ?></td>
														<td><a href="<?php echo base_url().'uploads/'. $item_info[$i]['drawing'];?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
														<td><a href="<?php echo base_url().'uploads/'. $item_info[$i]['cad'];?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
														<td><?php echo $item_info[$i]['description']; ?></td>
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
						<br>
					</div>
				</div>	
			</div>	
			<div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Manage Quotation</h4>
						</div>
					</div>
					<div class="panel-body">	
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/quotation/update_quotation"); ?>">
							
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group part_name_div">
										<label for="next_followup_date" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Drawing Numbar</label><span class="red_star">*</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group fabrication_div">
										<label for="fabrication" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Part Number</label><span class="red_star">*</span>
										
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group stress_relieving_div">
										<label for="stress_relieving" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Filed Name</label><span class="red_star">*</span>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group machining_div">
										<label for="machining" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Price</label><span class="red_star">*</span>
									</div>
								</div>
								<!--<div class="col-sm-1">
									<div class="form-group percentage_div">
										<label for="total" class="form-control-label" id="total_lbl" style="font-size: xx-small;">Percentage</label><span class="red_star">*</span>
									</div>
								</div>-->
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="total" class="form-control-label" id="total_lbl" style="font-size: xx-small;">Action</label>
									</div>
								</div>
							</div>
							<?php 
							
							/* //exit(sizeof($info));
							echo"<pre>";							
							$info = $info_data['product'];
							print_r($info_data);
							print_r($info);
							exit(); */
							$info = $info_data['product']; 
							
							if(sizeof($info)>0)
							{
								for($k=0; sizeof($info)>$k; $k++)
								{ ?>
							
									<div class="row btnSectionClone">
										<div class="col-sm-3">
											<div class="form-group drawing_number_div">
												<select  class="form-control basic-single" id="drawing_number" name="update_drawing_number[]" onchange="change_status('drawing_number_div')">
													<option selected value="">Select Drawing Number</option>
													<?php
														if(sizeof($item_info))
														{
															for($i=0;$i<sizeof($item_info);$i++)
															{ ?>
																	<option value="<?php echo $item_info[$i]['drawing_number']; ?>" <?php echo $item_info[$i]['drawing_number']== $info[$k]['drawing_number'] ? 'selected' : '';?> >
																		<?php echo $item_info[$i]['drawing_number']; ?>
																	</option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group update_part_number_div">
												<select  class="form-control basic-single" id="update_part_number" name="update_part_number[]" onchange="change_status('update_part_number_div')">
													<option selected value="">Select Part Name</option>
													<?php
														if(sizeof($item_info))
														{
															for($i=0;$i<sizeof($item_info);$i++)
															{ ?>
																	<option value="<?php echo $item_info[$i]['part_name']; ?>" <?php echo $item_info[$i]['part_name']== $info[$k]['part_name'] ? 'selected' : '';?> >
																		<?php echo $item_info[$i]['part_name']; ?>
																	</option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group update_field_div">
												<select class="form-control basic-single" id="update_field" name="update_field[]" onchange="change_status('update_field_div')">
													<option selected value="">Select Field</option>
													<?php
														if(sizeof($field))
														{
															for($i=0;$i<sizeof($field);$i++)
															{ ?>
																	<option value="<?php echo $field[$i]['id']; ?>" <?php echo $field[$i]['id']== $info[$k]['field'] ? 'selected' : '';?>>
																		<?php echo $field[$i]['field_name']; ?>
																	</option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group update_price_div">
												<input type="text" class="form-control price" id="update_price" name="update_price[]" placeholder="Price" value="<?php echo $info[$k]['price']?>" onkeyup="change_status('update_price_div',integer('update_price'))"/>
											</div>
										</div>
										
									 
										<input type="hidden" name="quotation_update_id[]" value="<?php echo $info[$k]['id']; ?>" >
										<div class="col-sm-2">
											<div class="form-group total_div">
												<select id="<?php echo $info[$k]['id']; ?>" name="update_action[]" class="form-control action">
													<option selected value="update">Update</option>
													<option value="delete">Delete</option>
												</select>
											</div>
										</div>
									</div>									
								<?php
								}?>
								
								<div class="row">
									<div class="col-sm-1">
										<label for="total" class="form-control-label" id="total_lbl" style="font-size: xx-small;">Percentage</label><span class="red_star">*</span>
										<div class="form-group update_percentage_div">
											<input type="text" class="form-control percantage" id="update_percentage" name="update_percentage" placeholder="%" min="1" max="100" value="<?php echo $info_data['profit_percentage']; ?>" onkeyup="change_status('update_percentage_div',integer('update_percentage'))"/>
										</div>
									</div>
									<div class="col-sm-3">
										<label for="tnc" class="form-control-label" id="tnc_lbl" style="font-size: xx-small;">TNC</label><span class="red_star">*</span>
										<div class="form-group tnc_div">
											<select class="form-control basic-single" id="tnc" name="tnc" onchange="change_status('tnc_div')">
												<option selected value="">Select TNC</option>
												<?php
													if(sizeof($tnc_info))
													{
														for($i=0;$i<sizeof($tnc_info);$i++)
														{ ?>
																<option value="<?php echo $tnc_info[$i]['tnc_id']; ?>" <?php echo $info_data['tnc'] == $tnc_info[$i]['tnc_id'] ? 'selected':''?>>
																	<?php echo $tnc_info[$i]['tnc_name']; ?>
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
							}							
							?>
							<div class="row btnSectionClone">
								<div class="col-sm-3">
									<div class="form-group">
										<!--<select  class="form-control basic-single" id="drawing_number" name="drawing_number[]" onchange="change_status('drawing_number_div')">
											<option selected disabled value="">Select Drawing Number</option>
											<?php
												if(sizeof($item_info))
												{
													for($i=0;$i<sizeof($item_info);$i++)
													{ ?>
															<option value="<?php echo $item_info[$i]['drawing_number']; ?>">
																<?php echo $item_info[$i]['drawing_number']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>-->
										<select class="form-control basic-single" id="drawing_number" name="drawing_number[]" onchange="change_status('drawing_number_div')"/>
											<option selected  value="">Select Drawing number</option>
											<?php
												if(sizeof($item_info))
												{
													for($i=0;$i<sizeof($item_info);$i++)
													{
														?>
															<option value="<?php echo $item_info[$i]['drawing_number']; ?>"><?php echo $item_info[$i]['drawing_number']; ?></option>
														<?php
													}
												}
											?>
									</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group part_number_div">
										<select  class="form-control basic-single" id="part_number" name="part_name[]" onchange="change_status('drawing_number_div')">
											<option selected value="">Select Part Name</option>
											<?php
												if(sizeof($item_info))
												{
													for($i=0;$i<sizeof($item_info);$i++)
													{ ?>
															<option value="<?php echo $item_info[$i]['part_name']; ?>">
																<?php echo $item_info[$i]['part_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group filed_div">
										<select  class="form-control basic-single" id="field" name="field[]" onchange="change_status('field_div')">
											<option selected value="">Select Field</option>
											<?php
												if(sizeof($field))
												{
													for($i=0;$i<sizeof($field);$i++)
													{ ?>
															<option value="<?php echo $field[$i]['id']; ?>">
																<?php echo $field[$i]['field_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group price_div">
										<input type="text" class="form-control price" id="price" name="price[]" placeholder="Price" onkeyup="change_status('price_div',integer('price'))"/>
									</div>
								</div>
								
							 
								<!--<div class="col-sm-1">
									<div class="form-group percentage_div">
										<input type="text" class="form-control percantage" id="percentage" name="percentage[]" placeholder="%" min="1" max="100" onkeyup="change_status('percentage_div',integer('percentage'))"/>
									</div>
								</div>-->
								<div class="col-sm-1" id = "add_div" >
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
								</div>
							</div>
							<input type="hidden" name="enquiry_id" value="<?php echo $info_data['enquiry_id']?>">
							<input type="hidden" name="quotation_id" value="<?php echo $info_data['quotation_id']?>">
							
							<!--<div class="row">
								<div class="col-sm-1">
									<input type="text" class="form-control percantage" id="percentage" name="percentage" placeholder="%" min="1" max="100" onkeyup="change_status('percentage_div',integer('percentage'))"/>
								</div>
							</div></br>-->
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update Quotation</button>
										
									</div>
								</div>
							</div>
						</form></br>
						<h3>Quotation Log.</h3><hr>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Drawing Number</th>
										<th>Part Number</th>
										<th>Field</th>
										<th>Price</th>
										<th>Percentage</th>
										<th>Total</th>
										<th>Date</th>																
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										if(sizeof($quotation_log)>0)
										{
											for($j=0; sizeof($quotation_log)>$j; $j++)
											{
												if($quotation_log[$j]['log_count']=='0')
												{
													?>
													<tr>
														<td colspan="7"><b>Log <?php echo ($count = $count+1)?></b></td>
													</tr>
													<?php 
												}	?>
												<tr>
													<td><?php echo $quotation_log[$j]['drawing_number'];?></td>
													<td><?php echo $quotation_log[$j]['part_name'];?></td>
													<td><?php echo $quotation_log[$j]['field_name'];?></td>
													<td><?php echo $quotation_log[$j]['price'];?></td>
													<td><?php echo $quotation_log[$j]['percentage'];?></td>
													<td><?php echo $quotation_log[$j]['total'];?></td>
													<td><?php echo date("d-M-Y", strtotime($quotation_log[$j]['add_date']));?></td>
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
<script>
	$(document).on('click', '.add', function(){
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find('.select2-container--default').remove();
		$clone.find('#drawing_number').select2();
		$clone.find('#part_number').select2();
		$clone.find('#field').select2();
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
		/* var flag="True";
		var part_name = $("#part_name").val();		
		var fabrication = $("#fabrication").val();
		var stress_relieving = $("#stress_relieving").val();
		var machining = $("#machining").val();
		var labour_and_trans = $("#labour_and_trans").val();
		var powder_coating = $("#powder_coating").val();
		var total = $("#total").val();
		
		if(part_name==""){
			$(".part_name_div").addClass("has-danger");
			flag="False";
		}
		if(fabrication==""){
			$(".fabrication_div").addClass("has-danger");
			flag="False";
		}
		if(stress_relieving==""){
			$(".stress_relieving_div").addClass("has-danger");
			flag="False";
		}
		if(machining==""){
			$(".machining_div").addClass("has-danger");
			flag="False";
		}
		if(powder_coating==""){
			$(".powder_coating_div").addClass("has-danger");
			flag="False";
		}
		if(labour_and_trans==""){
			$(".labour_and_trans_div").addClass("has-danger");
			flag="False";
		}
		if(total==""){
			$(".total_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		} */
	});
</script>