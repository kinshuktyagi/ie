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
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry Information</h4>
						</div>
					</div>
					
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Customer Name</label></br>
									<span><?php echo $enq_data['name']?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Order Type</label></br>
									<span>
										<?php 
											if($enq_data['order_type'] =='1')
											{
												echo"Sales";
											}else{
												echo "Job Work";
											}
										?>
									</span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label class="form-control-label" id="department_name_lbl">Email</label></br>
									<span><?php echo $enq_data['email']?></span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group department_name_div">
									<label for="department_name" class="form-control-label" id="department_name_lbl">Phone</label></br>
									<span><?php echo $enq_data['phone']?></span>
								</div>
							</div>
						</div>
						<br>
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/enquiry_followup/add"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group flp_action_div">
										<label for="flp_action" class="form-control-label" id="flp_action_lbl">Follwoup Action</label><span class="red_star">*</span>
										<select class="form-control" id="flp_action" name="flp_action" onchange="change_status('flp_action_div')">
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
							
								<div class="col-sm-3">
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
							<input type="hidden" name="added_by" value="<?php echo $enq_data['assign_to']?>">
							<input type="hidden" name="enquiry_id" value="<?php echo $enq_data['id']?>">
							<input type="hidden" name="department" value="<?php echo $enq_data['department_id']?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Follwoup</button>
										<a href="<?php echo base_url("account/enquiry_followup/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
						</form>						
					</div>
					
					<div class="panel-body">
						<div class="row">
							<div class="panel-body" style="padding:1px !important;">
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
									
										if(sizeof($enq_flp)>0)
										{
											for($i=0;$i<sizeof($enq_flp);$i++)
											{ ?>
													<tr>
														<td><?php echo $enq_flp[$i]['action_name']; ?></td>
														<td><?php echo $enq_flp[$i]['followup_comment']; ?></td>
														<td><?php echo $enq_flp[$i]['first_name'].' '.$enq_flp[$i]['last_name'];?></td>
														
														<td><?php 
														if($enq_flp[$i]['next_followup_date']!='1970-01-01')
														{
															echo date('d-M-Y',strtotime($enq_flp[$i]['next_followup_date']));
														}
														 ?></td>
														<td><?php echo  date('d-M-Y',strtotime($enq_flp[$i]['add_date'])); ?></td>
														<td>
														<?php 
															if($i==0)
															{
																if($enq_flp[$i]['followup_status']=="3")
																{
																	echo'<span class="label label-success m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
																}
																else if($enq_flp[$i]['followup_status']=="4")
																{
																	echo'<span class="label label-danger m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
																}else{
																	echo'<span class="label label-warning m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
																} 
															}
														?>
														</td>
														

<td style="width: 200px;">
	<button type="button" class="btn btn-warning btn-xs md-trigger action" data-modal="modal-<?php echo $enq_flp[$i]['id'];?>">Manage</button>
	<div class="md-modal  md-effect-7" id="modal-<?php echo $enq_flp[$i]['id'];?>" style="max-width: 100%; width: 90%; margin-top: 30px">
		<div class="md-content" style=" box-shadow: 1px 0 10px #0000006b;height: 80vh;overflow-y: auto;">
			<h3 style="padding: 5px;"> Manage Followup<button type="button" class="btn btn-base md-close" style="position: absolute; right: 30px; top: 7px;font-size: 12px;">Close!</button></h3>
			<div class="n-modal-body" style="padding: 15px;background: #f8fafa !important;">
				<div class="col-sm-12">
					<div class="panel panel-bd lobidrag">					
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group department_name_div">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Customer Name</label></br>
										<span><?php echo $enq_data['name']?></span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group department_name_div">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Order Type</label></br>
										<span>
											<?php 
												if($enq_data['order_type'] =='1')
												{
													echo"Sales";
												}else{
													echo "Job Work";
												}
											?>
										</span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group department_name_div">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Email</label></br>
										<span><?php echo $enq_data['email']?></span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group department_name_div">
										<label for="department_name" class="form-control-label" id="department_name_lbl">Phone</label></br>
										<span><?php echo $enq_data['phone']?></span>
									</div>
								</div>
							</div>
						</div>
					</div>							
					<form method="POST" class="frm" id="frm_flp<?php echo $enq_flp[$i]['id'];?>" autocomplete="off" action="<?php echo base_url("account/enquiry_followup/update_enquiry_followup"); ?>">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group flp_action_div">
									<label for="flp_action" class="form-control-label" id="flp_action_lbl">Follwoup Action</label><span class="red_star">*</span>
									<select class="form-control" id="flp_action<?php echo $enq_flp[$i]['id'];?>" name="flp_action" onchange="change_status('flp_action_div')">
										<option selected disabled value="">Select Action</option>
										<?php
											if(sizeof($followup_action))
											{
												for($k=0;$k<sizeof($followup_action);$k++)
												{											
													?>
														<option value="<?php echo $followup_action[$k]['action_id']; ?>"<?php echo $followup_action[$k]['action_id']==$enq_flp[$i]['followup_action']?'selected':''; ?>>
															<?php echo $followup_action[$k]['action_name']; ?>
														</option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>						
							<div class="col-sm-3">
								<div class="form-group next_followup_date_div">
									<label for="next_followup_date" class="form-control-label" id="next_followup_date_lbl">Next Follwoup Date</label>
									<input type="text" class="form-control datetimepicker2" id="next_followup_date<?php echo $enq_flp[$i]['id'];?>" name="next_followup_date" placeholder="Date" onkeyup="change_status('next_followup_date_div')" readonly value="<?php echo $enq_flp[$i]['next_followup_date'];?>" />
								</div>
							</div>						
							<div class="col-sm-4">
								<div class="form-group comment_div">
									<label for="comment" class="form-control-label" id="comment_lbl">Comment<span class="red_star">*</span>
									<textarea rows="2" cols="50" type="text" class="form-control" id="comment<?php echo $enq_flp[$i]['id'];?>" name="comment" placeholder="Comment" onkeyup="change_status('comment_div')"><?php echo $enq_flp[$i]['followup_comment']; ?></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="added_by" id="added_by<?php echo $enq_flp[$i]['id'];?>" value="<?php echo $enq_data['assign_to']?>">
						
						<input type="hidden" name="enquiry_id" id="enquiry_id<?php echo $enq_flp[$i]['id'];?>" value="<?php echo $enq_data['id']?>">
						
						<input type="hidden" name="followup_id" id="followup_id<?php echo $enq_flp[$i]['id'];?>" value="<?php echo $enq_flp[$i]['id'];?>">
						
						<input type="hidden" id="department<?php echo $enq_flp[$i]['id'];?>" name="department" value="<?php echo $enq_data['department_id']?>">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<button type="submit" id ="frm_follp<?php echo $enq_flp[$i]['id'];?>" class="btn btn-base pull-left">Manage Follwoup</button>									
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
	$('.datetimepicker2<?php echo $enq_flp[$i]['id'];?>').datetimepicker({
		format:'d-m-Y',
		minDate: 0,
		defaultDate:'<?php echo $enq_flp[$i]['id'];?>', // it's my birthda				
		timepicker:false
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}

	$("#frm_follp<?php echo $enq_flp[$i]['id'];?>").on("click", function(e)
	{
		var flag="True";
		var flp_action = $("#flp_action<?php echo $enq_flp[$i]['id'];?>").val();
		var next_followup_date = $("#next_followup_date<?php echo $enq_flp[$i]['id'];?>").val();
		var comment = $("#comment<?php echo $enq_flp[$i]['id'];?>").val();
		var added_by = $("#added_by<?php echo $enq_flp[$i]['id'];?>").val();
		var enquiry_id = $("#enquiry_id<?php echo $enq_flp[$i]['id'];?>").val();
		var department = $("#department<?php echo $enq_flp[$i]['id'];?>").val();
		var followup_id = $("#followup_id<?php echo $enq_flp[$i]['id'];?>").val();
		
		if(flp_action=="" || flp_action==null)
		{
			$(".flp_action_div").addClass("has-danger");
			flag="False";
		}
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
		/* else
		{
			$.ajax({
				type:"POST",
				url:"<?php echo base_url("account/enquiry_followup/update_enquiry_followup"); ?>",
				data:{
					flp_action:flp_action,
					next_followup_date:next_followup_date,
					comment:comment,
					added_by:added_by,
					enquiry_id:enquiry_id,
					department:department,
					followup_id:followup_id
				},									    
				success: function () {console.log("Thanks!"); },
				failure: function() {console.log("Error!");}
			});
		} */
		
	});
</script>



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
<script src="<?php echo base_url("public/assets/plugins/modals/modalEffects.js"); ?>"></script>
<script>
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