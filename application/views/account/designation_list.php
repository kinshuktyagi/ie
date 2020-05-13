<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Designation</h1>
				<small>Designation List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Designation Master</a></li>
					<li class="active">Designation List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/designation/add_designation"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Designation</button></a>
				<a href="<?php echo base_url("account/designation/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Designation List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/designation/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Designation Name</th>
										<th>Priority</th>
										<th>Description</th>										
										<th>Status</th>										
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="ds_designation_name" placeholder="Designation Name" value="<?php if(isset($_SESSION['search']['ds_designation_name'])){ echo $_SESSION['search']['ds_designation_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="ds_designation_priority" placeholder="Priority" value="<?php if(isset($_SESSION['search']['ds_designation_priority'])){ echo $_SESSION['search']['ds_designation_priority']; } ?>" class="form-control"/></td>
										<td><input class="form-control" type="text" name="ds_designation_description" placeholder="Description" value="<?php if(isset($_SESSION['search']['ds_designation_description'])){ echo $_SESSION['search']['ds_designation_description']; } ?>" class="form-control"/></td>
										<td>
											<select name="dep_designation_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['dep_designation_status']) && $_SESSION['search']['dep_designation_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['dep_designation_status']) && $_SESSION['search']['dep_designation_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>
										

										<td>											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
									
									</tr>
								</thead>
								
								</form>
								<tbody>
									<?php
										if(sizeof($user)>0)
										{
											for($i=0;$i<sizeof($user);$i++)
											{
												//$user_team=$this->user_model->get_team_name($user[$i]['id']);
												?>
													<tr>
														<td><?php echo $user[$i]['designation_name']; ?></td>
														<td><?php echo $user[$i]['priority']; ?></td>	
														<td><?php echo $user[$i]['description']; ?></td>
														<td>
															<?php 
																if($user[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$user[$i]['status'].'</span>';
																}
																else if($user[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$user[$i]['status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $user[$i]['id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($user[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($user[$i]['status']=='False')
																		{
																			echo'<option value="Enable">Enable</option>';
																		}
																	?>
																    <option value="Manage">Manage</option>
																    <!-- <option value="Disable">Disable</option> -->
																    <!-- <option value="Reset">Reset Password</option> -->
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
						<div class="row">
							<div class="col-sm-6" >
								<?php
									echo $paginate;
								?>
							</div>
							<div class="col-sm-6 text-right text-primary" style="padding-top:40px;padding-right:20px;">
								Total <?php echo $total; ?> records found to display.
							</div>
					  </div>
					</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	
		<script>
			$('.popoverData').popover();
			$(".action").change(function()
			{
				var id=$(this).prop("id");
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/designation/disable?dsg=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/designation/enable?dsg=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/designation/manage?dsg=") ?>"+id;
				}
				/*if(action=='Reset')
				{
					document.location="<?php echo base_url("account/designation/reset_password?usr=") ?>"+id;
				}
				if(action=='Role')
				{
					document.location="<?php echo base_url("account/designation/role?usr=") ?>"+id;
				}*/
			});
		
		</script>
		</div> 
	</div>
