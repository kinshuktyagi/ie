
<div class="content-wrapper">
	  <!-- Main content -->
	  
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Role</h1>
				<small>Assign Role.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">User Master</a></li>
					<li><a href="#">User List</a></li>
					<li class="active">Assign Role</li>
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
							<h4>Assign Role</h4>
						</div>
					</div>
					<form method="POST" id="frm" action="<?php echo base_url("account/user/add_role"); ?>">
						 <div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<select  class="form-control" id="role_set" name="role_set">
											<option selected disabled value="">Select Role Set</option>
											<?php
												if(sizeof($set))
												{
													
													for($i=0;$i<sizeof($set);$i++)
													{
														?>
															<option value="<?php echo $set[$i]['set_id']; ?>" <?php if((isset($_REQUEST['set']) && $set[$i]['set_id']==$_REQUEST['set']) || (in_array($set[$i]['set_id'],$set_id))){ echo'selected'; } ?>>
																<?php echo $set[$i]['set_name']; ?>
															</option>
														<?php
													}
												}
											?>
										</select><br>
									</div>
								</div>
								<div class="">
									<input type="hidden" name="user_id" value="<?php echo $_REQUEST['usr']; ?>"/>
									<?php
										if(sizeof($role)>0)
										{
											$count=1;
											for($i=0;$i<sizeof($role);$i++)
											{
												?>
													<div class="form-group col-sm-12">
														<div class="row">
														<div class="col-sm-3">
														<label class="form-control-label"><?php echo $role[$i]['role_name']; ?> <span class="text-violet" style="font-size:10px;"> (<?php echo $role[$i]['description']; ?>)</span></label>
														</div>
														<div class="col-sm-9">
															<div class="row">
															<?php
																
																if(sizeof($role[$i]['permission'])>0)
																{
																	$permission=$role[$i]['permission'];
																	
																	
																	for($j=0;$j<sizeof($permission);$j++)
																	{
																		$role_id=$role[$i]['role_id']."-".$permission[$j]['permission_id'];
																		?>
																			<div class="col-sm-2">
																			<div class="checkbox">
																				<!-- Role id & Permission id -->
																				<input type="checkbox" class="permission" name="permission[]" id="option<?php echo $count; ?>" value="<?php echo $role_id; ?>" <?php if(in_array($role_id,$role_permission)){ echo'checked'; } ?>/>
																				<label for="option<?php echo $count; ?>"><?php echo $permission[$j]['permission_name']; ?></label> 
																				
																			</div>
																			</div>
																		<?php
																		$count++;
																	}
																}
															?>
															
															</div>	
														</div>	
														
													</div>
													</div>
												<?php
											}
										}
									?>
									
									
									
									
								</div>
							<div class="row">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary w-md m-rb-5">Assign Role</button>
									<a href="<?php echo base_url("account/user/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<script>
		
			$("#role_set").change(function()
			{
				var usr=<?php echo $_REQUEST['usr']; ?>;
				var set=$(this).val();
				var qry="?usr="+usr+"&set="+set;
				document.location="<?php echo base_url("account/user/role"); ?>"+qry;
				
			});
		
			$("#frm").submit(function(e)
			{
			    var data=[];
				$("input:checkbox[class=permission]:checked").each(function () {
					data.push($(this).val());
				});
				if(data=="")
				{
					alert("!! Please select Permissions !!")
					e.preventDefault();
					return false;
				}
				  
			});
		
		</script>
		</div> 
	</div>
