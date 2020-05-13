<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Inventory Issue</h1>
				<small>Inventory Issue List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Inventory Issue Master</a></li>
					<li class="active">Inventory Issue List</li>
				</ol>
			</div>
		</div>
		<?php $this->load->view("flash");?>
		<div class="row">
			<div class="col-sm-12 text-right">
				<!--<a href="<?php echo base_url("account/inventory_issue/add_inventory_issue"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Inventory Request</button></a>-->
				<a href="<?php echo base_url("account/inventory_issue/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Inventory Issue List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/inventory_issue/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 75px;">Request Code</th>
										<th style="min-width: 145px;">Production Date</th>
										<th>Description</th>
										<th>Added By</th>
										<th style="min-width: 60px;">Add Date</th>
										<th style="min-width: 100px;">Modify Date</th>
										<th>Request Status</th>
										<th>Status</th>										
										<th>Action</th>										
									</tr>
									<tr>										
										<td><input type="text" name="issu_request_code" placeholder="Code" value="<?php if(isset($_SESSION['search']['issu_request_code'])){ echo $_SESSION['search']['issu_request_code']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="issu_prod_date" placeholder="Production Date" value="<?php if(isset($_SESSION['search']['issu_prod_date']) && ($_SESSION['search']['issu_prod_date']!='')){ echo date("d-M-Y",strtotime($_SESSION['search']['issu_prod_date'])); } ?>" class="form-control"/></td>
										
										<td><input type="text" name="issu_description" placeholder="Description" value="<?php if(isset($_SESSION['search']['issu_description'])){ echo $_SESSION['search']['issu_description']; } ?>" class="form-control"/></td>
										<td><input type="text" name="issu_added_by" placeholder="First Name" value="<?php if(isset($_SESSION['search']['issu_added_by'])){ echo $_SESSION['search']['issu_added_by']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="issu_add_date" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['issu_add_date']) && ($_SESSION['search']['issu_add_date']!='')){ echo date("d-M-Y",strtotime($_SESSION['search']['issu_add_date'])); } ?>" class="form-control"/></td>
										
										<td><input type="text" name="issu_modify_date" placeholder="Modify Date" value="<?php if(isset($_SESSION['search']['issu_modify_date']) && ($_SESSION['search']['issu_modify_date']!='')){ echo date("d-M-Y",strtotime($_SESSION['search']['issu_modify_date'])); } ?>" class="form-control"/></td>
										<td>
											<select name="issu_request_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="Pending" <?php if(isset($_SESSION['search']['issu_request_status']) && $_SESSION['search']['issu_request_status']=='Pending'){ echo'selected'; } ?>>Pending</option>
												<option value="Partial-Completed" <?php if(isset($_SESSION['search']['issu_request_status']) && $_SESSION['search']['issu_request_status']=='Partial-Completed'){ echo'selected'; } ?>>Partial-Completed</option>
												<option value="Completed" <?php if(isset($_SESSION['search']['issu_request_status']) && $_SESSION['search']['issu_request_status']=='Completed'){ echo'selected'; } ?>>Completed</option>
											</select>
										</td>
										<td>
											<select name="issu_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['issu_status']) && $_SESSION['search']['issu_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['issu_status']) && $_SESSION['search']['issu_status']=='False'){ echo'selected'; } ?>>False</option>
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
														<td><?php echo $user[$i]['inventory_request_code']; ?></td>
														<td>
														<?php 
															if($user[$i]['production_date']!='')
															{
																echo date("d-M-Y",strtotime($user[$i]['production_date']));
															}
														?>
														</td>
														<td><?php echo $user[$i]['description']; ?></td>
														<td><?php echo $user[$i]['first_name']; ?></td>
														<td>
														<?php 
															if($user[$i]['add_date']!='')
															{
																echo date("d-M-Y",strtotime($user[$i]['add_date']));
															}
														?>
														</td>
														<td>
														<?php 
															if($user[$i]['modify_date']!='')
															{
																echo date("d-M-Y",strtotime($user[$i]['modify_date']));
															}
														?>
														</td>
														
														<td>
															<?php 
																if($user[$i]['request_status']=="Pending")
																{
																	echo'<span class="label label-success m-r-15">'.$user[$i]['request_status'].'</span>';
																}
																else if($user[$i]['request_status']=="Partial-Completed")
																{
																	echo'<span class="label label-warning m-r-15">'.$user[$i]['request_status'].'</span>';
																}
																else if($user[$i]['request_status']=="Completed")
																{
																	echo'<span class="label label-warning m-r-15">'.$user[$i]['request_status'].'</span>';
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
																    <option value="view">View</option>
																    <option value="approve">Approve</option>
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
					document.location="<?php echo base_url("account/inventory_issue/disable?dept=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/inventory_issue/enable?dept=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/inventory_issue/manage?dept=") ?>"+id;
				}
				if(action=='view')
				{
					document.location="<?php echo base_url("account/inventory_issue/view?id=") ?>"+id;
				}
				if(action=='approve')
				{
					document.location="<?php echo base_url("account/inventory_issue/approve?id=") ?>"+id;
				}
			});
		
		</script>
		</div> 
	</div>
