<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Follwoup</h1>
				<small>Follwoup Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Follwoup Master</a></li>
					<li><a href="<?php echo base_url("account/enquiry_followup/index"); ?>">Followup List</a></li>
					<li class="active">Add Follwoup</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<?php $this->load->view("flash");?>
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
						print_r($info_log);
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
						<?php 
						/* echo"<pre>";
						print_r($enquiry_info);
						exit(); */
						?>
						<h4>Enquiry Items</h4>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<!--<th style="min-width: 145px">Material Name</th>-->
										<th style="min-width: 145px">Drawing Number</th>
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
														<!--<td><?php echo $item_info[$i]['material_name']; ?></td>-->
														<td><?php echo $item_info[$i]['drawing_number']; ?></td>
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
							<h4>Add Quotation</h4>
						</div>
					</div>
					<div class="panel-body">	
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/quotation/add"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group part_name_div">
										<label for="next_followup_date" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Drawing Numbar</label><span class="red_star">*</span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group fabrication_div">
										<label for="fabrication" class="form-control-label" id="next_followup_date_lbl" style="font-size: xx-small;">Part Name</label><span class="red_star">*</span>
										
									</div>
								</div>
								<div class="col-sm-3">
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
								<div class="col-sm-1">
									<div class="form-group total_div">
										<label for="total" class="form-control-label" id="total_lbl" style="font-size: xx-small;">Action</label>
									</div>
								</div>								
							</div>
							<div class="row btnSectionClone">
								<div class="col-sm-3">
									<div class="form-group drawing_number_div">
										<select class="form-control basic-single" id="drawing_number" name="drawing_number[]" onchange="change_status('drawing_number_div')">
											<option selected value="">Select Drawing Number</option>
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
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group part_name_div">
										<select  class="form-control basic-single" id="part_name" name="part_name[]" onchange="change_status('part_name_div')">
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
								<div class="col-sm-3">
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
										<input type="text" class="form-control percantage" id="percentage" name="percentage[]" placeholder="%" min="1" max="100" value="20" onkeyup="change_status('percentage_div',integer('percentage'))"/>
									</div>
								</div>-->
								<div class="col-sm-1" id = "add_div" >
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
									<label for="percentage" class="form-control-label" id="percentage_lbl" style="font-size: xx-small;">Percentage</label><span class="red_star">*</span>
									<input type="text" name="percentage" class="form-control price" id="percentage" max="100" onkeyup="change_status('percentage_div',integer('percentage'))" placeholder="%" >
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
															<option value="<?php echo $tnc_info[$i]['tnc_id']; ?>">
																<?php echo $tnc_info[$i]['tnc_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							</div></br>
							<input type="hidden" name="enquiry_id" value="<?php echo $enquiry_info['id']?>">
							<input type="hidden" name="enquiry_code" value="<?php echo $enquiry_info['enquiry_code']?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Quotation</button>
										<a href="<?php echo base_url("account/quotation/index") ?>">
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
	$(document).on('click', '.add', function(){
		var percentage    = $("#percentage").val();
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find("#percentage").val(percentage);
		$clone.find('.select2-container--default').remove();
		$clone.find('#part_name').select2();
		$clone.find('#drawing_number').select2();
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
		var flag="True";
		var drawing_number = $("#drawing_number").val();		
		var part_name = $("#part_name").val();		
		var percentage = $("#percentage").val();
		var tnc = $("#tnc").val();
		
		if(part_name=="" || part_name==null){
			$(".part_name_div").addClass("has-danger");
			flag="False";
		}
		if(drawing_number == "" || drawing_number== null ){
			$(".drawing_number_div").addClass("has-danger");
			flag="False";
		}
		
		if(percentage==""){
			$(".percentage_div").addClass("has-danger");
			flag="False";
		}
		if(tnc=="" || tnc==null){
			$(".tnc_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});
	
	$('.popoverData').popover();
	$(".action").change(function()
	{
		var id = $(this).prop("id");
		var action=$(this).val();
		if(action=='manage')
		{
			document.location="<?php echo base_url("account/quotation/manage_quotation?id=") ?>"+id;
		}
		if(action=='view')
		{
			document.location="<?php echo base_url("account/quotation/view_quotation?id=") ?>"+id;
		}
	});
		
</script>