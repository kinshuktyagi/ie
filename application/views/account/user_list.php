<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Employee</h1>
				<small>Employee List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Employee Master</a></li>
					<li class="active">Employee List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/user/add_user"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Employee</button></a>
				<a href="<?php echo base_url("account/user/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Employee List</h4>
						</div>
					</div>
					<?php
					/* echo"<pre>";
					print_r($user);
					//print_r($_SESSION);
					exit(); */
					?>
					<form method="POST" action="<?php echo base_url("account/user/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 110px;">Employee Code</th>
										<th style="min-width: 110px;">First Name</th>
										<th style="min-width: 110px;">Last Name</th>
										<th style="min-width: 110px;">Username</th>
										<!--<th style="min-width: 140px;">User Type</th>-->
										<th>Mobile</th>
										<th>Email</th>
										<th style="min-width:100px;">Add Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									
									<tr>
										<td><input type="text" name="user_code" placeholder="First Name" value="<?php if(isset($_SESSION['search']['user_code'])){ echo $_SESSION['search']['user_code']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="first_name" placeholder="First Name" value="<?php if(isset($_SESSION['search']['user_first_name'])){ echo $_SESSION['search']['user_first_name']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="last_name" placeholder="Last Name" value="<?php if(isset($_SESSION['search']['user_last_name'])){ echo $_SESSION['search']['user_last_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="user_name" placeholder="User Name" value="<?php if(isset($_SESSION['search']['user_user_name'])){ echo $_SESSION['search']['user_user_name']; } ?>" class="form-control"/></td>
										
										<!--<td>
											<select class="form-control testselect1" id="user_type" name="user_type">
												<option selected disabled value="">Select User Type</option>
												<?php
													if(sizeof($user_type))
													{
														for($i=0;$i<sizeof($user_type);$i++)
														{
															?>
																<option value="<?php echo $user_type[$i]['id'];?>" <?php if(isset($_SESSION['search']['user_user_type']) && $_SESSION['search']['user_user_type']== $user_type[$i]['id']){ echo'selected'; } ?>><?php echo $user_type[$i]['user_type']; ?></option>
															<?php
														}
													}
												?>
											</select>
										</td>-->
										<td><input type="text" name="mobile" placeholder="Mobile" value="<?php if(isset($_SESSION['search']['user_mobile'])){ echo $_SESSION['search']['user_mobile']; } ?>" class="form-control"/></td>
										<td><input type="text" name="email" placeholder="Email" value="<?php if(isset($_SESSION['search']['user_email'])){ echo $_SESSION['search']['user_email']; } ?>" class="form-control"/></td>
										<td></td>
										<td>
											<select name="status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['user_status']) && $_SESSION['search']['user_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['user_status']) && $_SESSION['search']['user_status']=='False'){ echo'selected'; } ?>>False</option>
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
														<td><?php echo $user[$i]['emp_code']; ?></td>
														<td><?php echo $user[$i]['first_name']; ?></td>
														<td><?php echo $user[$i]['last_name']; ?></td>
														<td><?php echo $user[$i]['user_name']; ?></td>
														<!--<td><?php echo $user[$i]['user_type']; ?></td>-->
														
														<td><?php echo $user[$i]['mobile']; ?></td>
														<td><?php echo $user[$i]['email']; ?></td>
														<td><?php echo date("d-M-Y",strtotime($user[$i]['add_date'])); ?></td>
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
																		/* if($user[$i]['user_type_id']=='3'){
																			echo'<option value="add_address">Add Address</option>';
																		} */
																	?>
																    <option value="Manage">Manage</option>
																    <option value="Department">Assign Department</option>
																    <option value="Reset">Reset Password</option>
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
				var id=$(this).prop("id");
				//alert(id);
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/user/disable?usr=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/user/enable?usr=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/user/manage?usr=") ?>"+id;
				}
				if(action=='Reset')
				{
					document.location="<?php echo base_url("account/user/reset_password?usr=") ?>"+id;
				}
				/* if(action=='Role')
				{
					document.location="<?php echo base_url("account/user/role?usr=") ?>"+id;
				} */
				if(action=='Department')
				{
					document.location="<?php echo base_url("account/user/department?usr=") ?>"+id;
				}
				if(action=='add_address')
				{
					var new_id = id + '&type=' + 'user';
					document.location="<?php echo base_url("account/user/add_address?usr=") ?>"+new_id;
				}
				
			});
		
		</script> 
		</div> 
	</div>
