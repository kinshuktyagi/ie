<div class="content-wrapper">
	  <!-- Main content -->
	  
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Department</h1>
				<small>Assign Department.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">User Master</a></li>
					<li><a href="#">User List</a></li>
					<li class="active">Assign Department</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">				
				<a href="<?php echo base_url("account/user/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Back</button></a>
			  </div>
		</div>

		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Assign Department</h4>
						</div>
					</div>
					<?php 
						$user=$this->session->userdata("user");
						/* echo "<pre>";
						print_r($team);
						print_r($user_dept_desg);
						print_r($designation);
						print_r($department);
						exit(); 
						echo"<pre>";
						print_r($user_data);
						exit();*/
					?>
					<form method="POST" id="frm" action="<?php echo base_url("account/user/add_department_desg"); ?>">
						 <div class="panel-body">
								<div class="row">								
									<div class="col-sm-3">
										<div class="form-group department_div">
										<label for="dept_set" class="form-control-label" id="dept_lbl">Department</label><span class="red_star">*</span>
										<select  class="form-control" id="dept_set" name="dept_set" onchange="change_status('department_div')">
											<option selected disabled value="">Select Department</option>
											<?php
												if(sizeof($department))
												{
													for($i=0;$i<sizeof($department);$i++)
													{											
														?>
															<option value="<?php echo $department[$i]['id']; ?>">
																<?php echo $department[$i]['department_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
										</div><br>
									</div>
									<!--<div class="col-sm-3">
										<div class="form-group report_to_div">
										<label for="team" class="form-control-label" id="report_to_lbl">Team</label>
										<select  class="form-control" id="team" name="team" onchange="change_status('team_div')">
										</select>
										</div><br>
									</div>-->
									
									<div class="col-sm-3">
										<div class="form-group designation_div">
											<label for="desg_set" class="form-control-label" id="desg_lbl">Designation</label><span class="red_star">*</span>
											<select  class="form-control" id="desg_set" name="desg_set" onchange="change_status('designation_div')">
												<option selected disabled value="">Select Designation</option>
												<?php
													if(sizeof($designation))
													{												
														for($i=0;$i<sizeof($designation);$i++)
														{ ?>
																<option value="<?php echo $designation[$i]['id']; ?>">
																	<?php echo $designation[$i]['designation_name']; ?>
																</option>
															<?php
														}
													}
												?>
											</select>
										</div><br>
									</div>

									<div class="col-sm-3">
										<div class="form-group report_to_div">
										<label for="report_to" class="form-control-label" id="report_to_lbl">Report To</label>
										<select  class="form-control basic-single" id="report_to" name="report_to" onchange="change_status('report_to_div')">
											<option value=""> Select </option>
											<?php
												if(sizeof($user_data))
												{
													for($r=0;$r<sizeof($user_data);$r++)
													{											
														?>
															<option value="<?php echo $user_data[$r]['id']; ?>">
																<?php echo $user_data[$r]['first_name'].' '.$user_data[$r]['last_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
										</div><br>
									</div>
								</div>
								<div class="">
									<input type="hidden" name="user_id" value="<?php echo $_REQUEST['usr']; ?>"/>
									<div class="table-responsive"></div>
								</div>
							<div class="row">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary w-md m-rb-5">Add Department</button>
									<a href="<?php echo base_url("account/user/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
								</div>
							</div><br>
							<div class="row">
								<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Department Name</th>
										<th>Designation Name</th>
										<th>Report To</th>
										<th>Default</th>										
										<th>Status</th>										
										<th>Action</th>										
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($user_dept_desg)>0)
										{
											for($i=0;$i<sizeof($user_dept_desg);$i++)
											{
												
												?>
													<tr>
														<td><?php echo $user_dept_desg[$i]['department_name']; ?></td>
														<td><?php echo $user_dept_desg[$i]['designation_name']; ?></td>
														<td><?php echo $user_dept_desg[$i]['first_name'].' '.$user_dept_desg[$i]['last_name']; ?></td>
														<td>														
															<?php 
																if($user_dept_desg[$i]['is_default']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$user_dept_desg[$i]['is_default'].'</span>';
																}
																else if($user_dept_desg[$i]['is_default']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$user_dept_desg[$i]['is_default'].'</span>';
																}
															?>
														</td>
														<td>														
															<?php 
																if($user_dept_desg[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$user_dept_desg[$i]['status'].'</span>';
																}
																else if($user_dept_desg[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$user_dept_desg[$i]['status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $user_dept_desg[$i]['id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($user_dept_desg[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($user_dept_desg[$i]['status']=='False')
																		{
																			echo'<option value="Enable">Enable</option>';
																		}
																	?>
															</select>
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
					</form>
				</div>
			</div>
		</div>
		
		
		<script>
			function change_status(div)
			{
				$("."+div).removeClass("has-danger");
			}
					
			$("#frm").submit(function(e)
			{
			    var flag="True";
				var dept_set=$("#dept_set").val();
				var desg_set=$("#desg_set").val();

				//alert(dept_set);

				if(dept_set=="" || dept_set==null)
				{
					$(".department_div").addClass("has-danger");
					flag="False";
				}
				if(desg_set=="" || desg_set==null)
				{
					$(".designation_div").addClass("has-danger");
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
				var id=$(this).prop("id");
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/user/disable_assign_department?usr=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/user/enable_assign_department?usr=") ?>"+id;
				}
			});
			
			// get the Team on change of departemnt..
			$(document).on("change","#dept_set",function()
			{
				var departemnt_id=$("#dept_set").val();
				if(departemnt_id)
				{
					$.ajax({url:"<?php echo base_url("account/user/get_department_team"); ?>",method:"POST",data:{departemnt_id:departemnt_id},success:function(a)
					{
						$("#team").html(a);
						$("#report_to")	.html('');
					}});
				}
			});
			
			
			// get the desgnation on change of Team..
			$(document).on("change","#team",function()
			{
				var team=$("#team").val();
				if(team)
				{
					$.ajax({url:"<?php echo base_url("account/user/get_department_employee"); ?>",method:"POST",data:{team:team},success:function(a)
					{
						$("#report_to")	.html(a);
					}});
				}
			});
			
			
		
		</script>
	</div> 
</div>
