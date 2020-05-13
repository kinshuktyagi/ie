<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Notification</h1>
				<small>Notification List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Notification Master</a></li>
					<li class="active">Notification List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/notification/add_notification"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add notification</button></a>
				<a href="<?php echo base_url("account/notification/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<?php 
		/* echo"<pre>";
		print_r($user);
		exit(); */
		?>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Notification List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/notification/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>User Type</th>
										<th style="min-width: 150px;">Department</th>
										<th style="min-width: 140px;">Notification Name</th>
										<th>End Date</th>
										<th>Description</th>
										<th>Email Send</th>
										<!--<th>Add Date</th>
										<th>Modify Date</th>-->
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="ntc_user_type" placeholder="User Type" value="<?php if(isset($_SESSION['search']['ntc_user_type'])){ echo $_SESSION['search']['ntc_user_type']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="ntc_department" placeholder="Department Name" value="<?php if(isset($_SESSION['search']['ntc_department'])){ echo $_SESSION['search']['ntc_department']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="ntc_name" placeholder="Notification Name" value="<?php if(isset($_SESSION['search']['ntc_name'])){ echo $_SESSION['search']['ntc_name']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="ntc_end_date" placeholder="End Date" value="<?php if(isset($_SESSION['search']['ntc_end_date']) && ($_SESSION['search']['ntc_end_date']!='') ){ echo date("d-M-Y",strtotime($_SESSION['search']['ntc_end_date'])); } ?>" class="form-control"/></td>
										
										<!--<td><input type="text" name="it_add_date" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['ntc_end_date']) && ($_SESSION['search']['ntc_end_date']!='') ){ echo date("d-M-Y",strtotime($_SESSION['search']['ntc_end_date'])); } ?>" class="form-control"/></td>-->
										
										<td><input type="text" name="ntc_description" placeholder="Description" value="<?php if(isset($_SESSION['search']['ntc_description'])){ echo $_SESSION['search']['ntc_description']; } ?>" class="form-control"/></td>
										<td>
											<select name="ntc_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['ntc_email']) && $_SESSION['search']['ntc_email']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['ntc_email']) && $_SESSION['search']['ntc_email']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>
										<td>
											<select name="ntc_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['ntc_status']) && $_SESSION['search']['ntc_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['ntc_status']) && $_SESSION['search']['ntc_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>									
										<td>
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($user)>0)
										{
											for($i=0;$i<sizeof($user);$i++)
											{
												?>
													<tr>
														<td><?php echo $user[$i]['user_type']; ?></td>
														<td><?php echo $user[$i]['department_name']; ?></td>
														<td><?php echo $user[$i]['notification_name']; ?></td>
														<td><?php if ( $user[$i]['end_date']!='') {
																echo date("d-M-Y",strtotime($user[$i]['end_date']));
															}?></td>
														
														<td><?php echo $user[$i]['description']; ?></td>
														<td>
															<?php 
																if($user[$i]['email_send']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$user[$i]['email_send'].'</span>';
																}
																else if($user[$i]['email_send']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$user[$i]['email_send'].'</span>';
																}
															?>
														</td>
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
					</form>
				</div>
			</div>
		</div>

		<script>
			$('.popoverData').popover();
			$(".action").change(function()
			{
				var id = $(this).prop("id");
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/notification/disable?id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/notification/enable?id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/notification/manage?id=") ?>"+id;
				}
			});
		
		</script>
		</div> 
	</div>
