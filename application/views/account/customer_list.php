<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Customer</h1>
				<small>Customer List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Customer Master</a></li>
					<li class="active">Customer List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/customer/add_customer"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Customer</button></a>
				<a href="<?php echo base_url("account/customer/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Customer List</h4>
						</div>
					</div>
					<?php
					/* echo"<pre>";
					print_r($user);
					//print_r($_SESSION);
					exit(); */
					?>
					<form method="POST" action="<?php echo base_url("account/customer/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 130px;">Customer Code</th>
										<th style="min-width: 110px;">Name</th>
										<th style="min-width: 110px;">Phone</th>
										<th style="min-width: 110px;">Email</th>
										<th>City</th>					
										<th style="min-width:100px;">Add Date</th>
										<th style="min-width:100px;">Modify Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									
									<tr>
										<td><input type="text" name="cu_code" placeholder="Customer Code" value="<?php if(isset($_SESSION['search']['cu_code'])){ echo $_SESSION['search']['cu_code']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="cu_name" placeholder="Name" value="<?php if(isset($_SESSION['search']['cu_name'])){ echo $_SESSION['search']['cu_name']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="cu_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['cu_phone'])){ echo $_SESSION['search']['cu_phone']; } ?>" class="form-control"/></td>
										<td><input type="text" name="cu_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['cu_email'])){ echo $_SESSION['search']['cu_email']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="cu_city" placeholder="City" value="<?php if(isset($_SESSION['search']['cu_city'])){ echo $_SESSION['search']['cu_city']; } ?>" class="form-control"/></td>
										<td></td>
										<td></td>
										<td>
											<select name="cu_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['cu_status']) && $_SESSION['search']['cu_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['cu_status']) && $_SESSION['search']['cu_status']=='False'){ echo'selected'; } ?>>False</option>
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
														<td><?php echo $user[$i]['cust_code']; ?></td>
														<td><?php echo $user[$i]['name']; ?></td>
														<td><?php echo $user[$i]['phone']; ?></td>
														<td><?php echo $user[$i]['email']; ?></td>
														<td><?php echo $user[$i]['city']; ?></td>
														<td><?php 
															if($user[$i]['add_date']!=''){
																echo date("d-M-Y",strtotime($user[$i]['add_date'])); 
															}?>
														</td>
														<td><?php 
															if($user[$i]['modify_date']!=''){
																echo date("d-M-Y",strtotime($user[$i]['modify_date'])); 
															} ?>
														
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
															<select id="<?php echo $user[$i]['cust_id']; ?>" class="action">
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
				var id=$(this).prop("id");
				//alert(id);
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/customer/disable?customer=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/customer/enable?customer=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/customer/manage?customer=") ?>"+id;
				}
			});
		
		</script> 
		</div> 
	</div>
