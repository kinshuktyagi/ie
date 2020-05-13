<div class="content-wrapper">
	  <!-- Main content -->
	  
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Set</h1>
				<small>Set Master</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Master</a></li>
					<li><a href="#">Role Set Master</a></li>
					<li class="active">Add Set</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				
				<a href="<?php echo base_url("account/set/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Back</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Add Role Set</h4>
						</div>
					</div>
					<form method="POST" id="frm" action="<?php echo base_url("account/set/add_set"); ?>">
						 <div class="panel-body">
							
						 
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group set_name_div">
										<label for="set_name" class="form-control-label" id="set_name_lbl">Set Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="set_name" name="set_name"  placeholder="Set Name" onkeyup="change_status('set_name_div')"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl">Set Description</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="description" name="description"  placeholder="Set Description" onkeyup="change_status('description_div')"/>
									</div>
								</div>
							</div>
								<div class="row">
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
																				<input type="checkbox" class="permission" name="permission[]" id="option<?php echo $count; ?>" value="<?php echo $role_id; ?>" />
																				<label for="option<?php echo $count; ?>"><?php echo $permission[$j]['permission_name']; ?></label> 
																				<!--<span class="text-success" style="font-size:10px;"> (<?php echo $permission[$j]['description']; ?>)</span>-->
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
								<div class="col-sm-2">
									<button type="submit" class="btn btn-primary w-md m-rb-5">Add Set</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<script>
			$("#frm").submit(function(e)
			{
				var set_name=$("#set_name").val();
				var description=$("#description").val();
				var flag="True";
				if(set_name=="")
				{
					$(".set_name_div").addClass("has-danger");
					flag="False";
				}
				if(description=="")
				{
					$(".description_div").addClass("has-danger");
					flag="False";
				}
			    var data=[];
				$("input:checkbox[class=permission]:checked").each(function () {
					data.push($(this).val());
				});
				if(data=="")
				{
					flag="False";
					alert("!! Plese select roles and permissions !!");
				}
				if(flag=="False")
				{
					e.preventDefault();
					return false;
				}
				  
			});
		
		</script>
		</div> 
	</div>
