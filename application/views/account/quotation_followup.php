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
					print_r($info);
					exit(); */
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label">Customer Name</label></br>
									<span><?php echo $info['name']?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label">Order Type</label></br>
									<span>
										<?php
											if($info['order_type'] =='1')
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
									<span><?php echo $info['email']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Phone</label></br>
									<span><?php echo $info['phone']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
									<span><?php echo $info['aadhar']?></span>
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">PAN</label></br>
									<span> <?php echo $info['pan']; ?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Tan</label></br>
									<span><?php echo $info['tan']?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
									<span><?php echo $info['aadhar']?></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Address</label></br>
									<span><?php echo $info['address'].','.$info['pincode'].'<br>'.$info['city'].','.$info['stateName'].','.$info['countryName'] ?></span>
								</div>
							</div>
						</div>
						
						<h4>Quotation Information</h4>
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
									</tr>
								</thead>
								<tbody>
									<?php
										$info_items = $quotation_info['product'];
											/* echo"<pre>";
											print_r($quotation_info);
											exit(); */
											if(sizeof($info_items)>0)
											{
												for($j=0; sizeof($info_items)>$j; $j++)
												{
													?>
													<tr>
														<td>
															<div>
																<strong><?php echo $info_items[$j]['drawing_number']; ?></strong>
															</div>
														</td>
														<td><?php echo $info_items[$j]['part_name'];?></td>
														<td><?php echo $info_items[$j]['field_name'];?></td>
														<td><?php echo $info_items[$j]['price'];?></td>
														<td><?php echo $info_items[$j]['percentage'];?></td>
														<td><?php echo $info_items[$j]['total'];?></td>
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
							<h4>Quotation Follwoup</h4>
						</div>
					</div>
					<?php 
					/* echo"<pre>";
					print_r($quotation_info);
					exit(); */
					?>
					<div class="panel-body">	
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/quotation/add_followup"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group flp_action_div">
										<label for="flp_action" class="form-control-label" id="flp_action_lbl">Follwoup Action</label><span class="red_star">*</span>
										<select class="form-control action" id="flp_action" name="flp_action" onchange="change_status('flp_action_div')">
											<option selected disabled value="">Select Action</option>
											<?php
												if(sizeof($followup_action))
												{
													for($l=0;$l<sizeof($followup_action);$l++)
													{											
														?>
															<option value="<?php echo $followup_action[$l]['action_id']; ?>">
																<?php echo $followup_action[$l]['action_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							
								<div class="col-sm-3" id="next_date">
									<div class="form-group next_followup_date_div">
										<label for="next_followup_date" class="form-control-label" id="next_followup_date_lbl">Next Follwoup Date</label><span class="red_star">*</span>
										<input type="text" class="form-control datetimepicker2" id="next_followup_date" name="next_followup_date" placeholder="Date" onkeyup="change_status('next_followup_date_div')" readonly />
									</div>
								</div>							
								<div class="col-sm-4">
									<div class="form-group comment_div">
										<label for="comment" class="form-control-label" id="comment_lbl">Comment<span class="red_star">*</span>
										<textarea rows="2" cols="50" type="text" class="form-control" id="comment" name="comment" placeholder="Comment" onkeyup="change_status('comment_div')"></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" name="enquiry_id" value="<?php echo $quotation_info['enquiry_id']; ?>">
							<input type="hidden" name="enquiry_code" value="<?php echo $quotation_info['enquiry_code']; ?>">
							<input type="hidden" name="quotation_id" value="<?php echo $quotation_info['quotation_id'];?>">
							<input type="hidden" name="quotation_code" value="<?php echo $quotation_info['quotation_code'];?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Follwoup</button>
										<a href="<?php echo base_url("account/quotation/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
						</form></br>
						<h4>Follwoup Details</h4>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 145px">Followup Action</th>
										<th style="min-width: 145px">Comment</th>
										<th>Added By</th>
										<th>Next Followup Date</th>
										<th>Add Date</th>
										<th>Followup Status</th>
										<th style="min-width: 100px">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									/* echo"<pre>";
									print_r($enq_flp);
									exit(); */
									
										if(sizeof($flp)>0)
										{
											for($i=0;$i<sizeof($flp);$i++)
											{ ?>
													<tr>
														<td><?php echo $flp[$i]['action_name']; ?></td>
														<td><?php echo $flp[$i]['followup_comment']; ?></td>
														<td><?php echo $flp[$i]['first_name'].' '.$flp[$i]['last_name'];?></td>
														
														<td><?php 
														
														if($flp[$i]['next_followup_date']!= '1970-01-01')
															{
																echo  date('d-M-Y',strtotime($flp[$i]['next_followup_date']));
															}
														 ?>
														</td>
														<td><?php
															if($flp[$i]['add_date']!= null)
															{
																echo  date('d-M-Y',strtotime($flp[$i]['add_date']));
															}	?>
														
														</td>
														<td>
														<?php 
															if($i==0)
															{
																if($flp[$i]['followup_status']=="3")
																{
																	echo'<span class="label label-success m-r-15">'.$flp[$i]['status_name'].'</span>';
																}
																else if($flp[$i]['followup_status']=="4")
																{
																	echo'<span class="label label-danger m-r-15">'.$flp[$i]['status_name'].'</span>';
																}else{
																	echo'<span class="label label-warning m-r-15">'.$flp[$i]['status_name'].'</span>';
																} 
															}
														?>
														</td>
<td style="width: 200px;">
	<button type="button" class="btn btn-warning btn-xs md-trigger action action_mdl" data-modal="modal-<?php echo $flp[$i]['id'];?>">Manage</button>
	<div class="md-modal  md-effect-7" id="modal-<?php echo $flp[$i]['id'];?>" style="max-width: 100%; width: 90%; margin-top: 30px">
		<div class="md-content" style=" box-shadow: 1px 0 10px #0000006b;height: 80vh;overflow-y: auto;">
			<h3 style="padding: 5px;"> Manage Followup<button type="button" class="btn btn-base md-close" style="position: absolute; right: 30px; top: 7px;font-size: 12px;">Close!</button></h3>
			<div class="n-modal-body" style="padding: 15px;background: #f8fafa !important;">
					<div class="col-sm-12">
						<div class="panel panel-bd lobidrag">
							<div class="panel-heading">
								<div class="panel-title">
									<h4>Enquiry Information</h4>
								</div>
							</div>
							<?php 
							/* echo"<pre>";
							print_r($info);
							exit(); */
							?>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group department_name_div">
											<label class="form-control-label">Customer Name</label></br>
											<span><?php echo $info['name']?></span>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group department_name_div">
											<label class="form-control-label">Order Type</label></br>
											<span>
												<?php
													if($info['order_type'] =='1')
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
											<span><?php echo $info['email']?></span>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group department_name_div">
											<label for="department_name" class="form-control-label" id="department_name_lbl">Phone</label></br>
											<span><?php echo $info['phone']?></span>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group department_name_div">
											<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
											<span><?php echo $info['aadhar']?></span>
										</div>
									</div>
								</div>
								<div class="row">							
									<div class="col-sm-3">
										<div class="form-group department_name_div">
											<label class="form-control-label" id="department_name_lbl">PAN</label></br>
											<span> <?php echo $info['pan']; ?></span>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group department_name_div">
											<label class="form-control-label" id="department_name_lbl">Tan</label></br>
											<span><?php echo $info['tan']?></span>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group department_name_div">
											<label for="department_name" class="form-control-label" id="department_name_lbl">Aadhar</label></br>
											<span><?php echo $info['aadhar']?></span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group department_name_div">
											<label class="form-control-label" id="department_name_lbl">Address</label></br>
											<span><?php echo $info['address'].','.$info['pincode'].'<br>'.$info['city'].','.$info['stateName'].','.$info['countryName'] ?></span>
										</div>
									</div>
								</div>
								
								<h4>Quotation Information</h4>
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
											</tr>
										</thead>
										<tbody>
											<?php
												$info_items = $quotation_info['product'];
													/* echo"<pre>";
													print_r($quotation_info);
													exit(); */
													if(sizeof($info_items)>0)
													{
														for($j=0; sizeof($info_items)>$j; $j++)
														{
															?>
															<tr>
																<td>
																	<div>
																		<strong><?php echo $info_items[$j]['drawing_number']; ?></strong>
																	</div>
																</td>
																<td><?php echo $info_items[$j]['part_name'];?></td>
																<td><?php echo $info_items[$j]['field_name'];?></td>
																<td><?php echo $info_items[$j]['price'];?></td>
																<td><?php echo $info_items[$j]['percentage'];?></td>
																<td><?php echo $info_items[$j]['total'];?></td>
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
					<form method="POST" class="frm" id="frm_flp<?php echo $flp[$i]['id'];?>" autocomplete="off" action="<?php echo base_url("account/quotation/update_quotation_followup"); ?>">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group flp_action_up_div">
									<label for="flp_action" class="form-control-label" id="flp_action_lbl">Follwoup Action</label><span class="red_star">*</span>
									<select class="form-control" id="flp_action_up<?php echo $flp[$i]['id'];?>" name="flp_action" onchange="change_status('flp_action_up_div')">
										<option selected disabled value="">Select Action</option>
										<?php
											if(sizeof($followup_action))
											{
												for($k=0;$k<sizeof($followup_action);$k++)
												{											
													?>
														<option value="<?php echo $followup_action[$k]['action_id']; ?>"<?php echo $followup_action[$k]['action_id']==$flp[$i]['followup_action']?'selected':''; ?>>
															<?php echo $followup_action[$k]['action_name']; ?>
														</option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>	
							<?php 
							/* if($flp[$i]['next_followup_date']!='1970-01-01' || $flp[$i]['next_followup_date'] !='')
							{
								echo"hello"; */
								?>
								<div class="col-sm-3" id="next_date<?php echo $flp[$i]['id'];?>">
									<div class="form-group next_followup_date_div">
										<label for="next_followup_date" class="form-control-label" id="next_followup_date_lbl">Next Follwoup Date</label>
										<input type="text" class="form-control datetimepicker2" id="next_followup_date<?php echo $flp[$i]['id'];?>" name="next_followup_date" placeholder="Date" onkeyup="change_status('next_followup_date_div')" readonly value="<?php echo $flp[$i]['next_followup_date'];?>" />
									</div>
								</div>
								<?php 
							//}
							?>
							<div class="col-sm-4">
								<div class="form-group comment_up_div">
									<label for="comment" class="form-control-label" id="comment_lbl">Comment<span class="red_star">*</span>
									<textarea rows="2" cols="50" type="text" class="form-control" id="comment_up<?php echo $flp[$i]['id'];?>" name="comment" placeholder="Comment" onkeyup="change_status('comment_up_div')"><?php echo $flp[$i]['followup_comment']; ?></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="enquiry_id" value="<?php echo $quotation_info['enquiry_id']; ?>">
						<input type="hidden" name="quotation_id" value="<?php echo $quotation_info['quotation_id'];?>">						
						<input type="hidden" name="followup_id" id="followup_id<?php echo $flp[$i]['id'];?>" value="<?php echo $flp[$i]['id'];?>">						
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<button type="submit" id ="frm_follp<?php echo $flp[$i]['id'];?>" class="btn btn-base pull-left">Manage Follwoup</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
</td>
<script type="text/javascript">
	$('.action_mdl').on('click', function(){
		var action_val = $('#next_followup_date<?php echo $flp[$i]['id'];?>').val();
		console.log(action_val);
	});

	/* var action_val = $('#next_followup_date<?php echo $flp[$i]['id'];?>').val();
	console.log(action_val);
	if(action_val == '4')
	{
		$('#next_date<?php echo $flp[$i]['id'];?>').hide();
	}
	else if(action_val == '3')
	{
		$('#next_date<?php echo $flp[$i]['id'];?>').hide();
	}else{
		$('#next_date<?php echo $flp[$i]['id'];?>').show();
	} */
	
	$('#flp_action_up<?php echo $flp[$i]['id'];?>').on('change', function() {
		
		var action=$(this).val();
		
		if(action == '4')
		{
			$('#next_date<?php echo $flp[$i]['id'];?>').hide();
			$(".next_followup_date_div").removeClass("has-danger");
		}
		else if(action == '3')
		{
			$('#next_date<?php echo $flp[$i]['id'];?>').hide();
			$(".next_followup_date_div").removeClass("has-danger");
		}else{
			$('#next_date<?php echo $flp[$i]['id'];?>').show();
			$(".next_followup_date_div").removeClass("has-danger");
		}
		
	});
	
	$('.datetimepicker2<?php echo $flp[$i]['id'];?>').datetimepicker({
		format:'d-m-Y',
		minDate: 0,
		defaultDate:'<?php echo $flp[$i]['id'];?>', // it's my birthda				
		timepicker:false
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}

	$("#frm<?php echo $flp[$i]['id'];?>").on("click", function(e)
	{
		var flag="True";
		var flp_action_up = $("#flp_action_up<?php echo $flp[$i]['id'];?>").val();
		var next_followup_date = $("#next_followup_date<?php echo $flp[$i]['id'];?>").val();
		var comment_up = $("#comment_up<?php echo $flp[$i]['id'];?>").val();
		
		if(flp_action_up=="" || flp_action_up==null)
		{
			$(".flp_action_up_div").addClass("has-danger");
			flag="False";
		}
		if(comment_up=="")
		{
			$(".comment_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}		
	});
</script>


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
			</div>		
		</div>		
	
	</div> 
	</div> 
</div>
<script src="<?php echo base_url("public/assets/plugins/modals/modalEffects.js"); ?>"></script>
<script>
	
	$('#flp_action').on('change', function() {
		
		var action=$(this).val();
		if(action == '4')
		{
			$('#next_date').hide();
			$(".next_followup_date_div").removeClass("has-danger");
		}
		else if(action == '3')
		{
			$('#next_date').hide();
			$(".next_followup_date_div").removeClass("has-danger");
		}else{
			$('#next_date').show();
			$(".next_followup_date_div").removeClass("has-danger");
		}
		
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	$("#frm").submit(function(e)
	{
		var flag="True";
		var flp_action = $("#flp_action").val();
		var next_followup_date = $("#next_followup_date").val();		
		var comment = $("#comment").val();	
		
		if(flp_action=="" || flp_action==null)
		{
			$(".flp_action_div").addClass("has-danger");
			flag="False";
		}
		/* if( (flp_action!="3" || flp_action!="4") && next_followup_date=='')
		{
			$(".next_followup_date_div").addClass("has-danger");
			flag="False";
		} */
		if(comment=="")
		{
			$(".comment_div").addClass("has-danger");
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