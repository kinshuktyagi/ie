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
					<li><a href="<?php echo base_url("administrator"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Contractual</a></li>
					<li><a href="#">Employee Master</a></li>
					<li class="active">Employee List</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("administrator/employee/add_employee"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Employee</button></a>
				<a href="<?php echo base_url("administrator/employee/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
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
					<form method="POST" action="<?php echo base_url("administrator/employee/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Client ID</th>
										<th>Pacific ID</th>
										<th>Employee Name</th>
										<th>City</th>
										<th>Address</th>
										<th style="min-width:90px;">Add Date</th>
										<th style="min-width:100px;">Modify Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									<tr>
										<td><input type="text" name="employee_id" placeholder="Client ID" value="<?php if(isset($_SESSION['search']['emp_employee_id'])){ echo $_SESSION['search']['emp_employee_id']; } ?>" class="form-control"/></td>
									
										<td><input type="text" name="pacific_id" placeholder="Pacific ID" value="<?php if(isset($_SESSION['search']['emp_pacific_id'])){ echo $_SESSION['search']['emp_pacific_id']; } ?>" class="form-control"/></td>
									
										
										<td><input type="text" name="employee_name" placeholder="Employee Name" value="<?php if(isset($_SESSION['search']['emp_employee_name'])){ echo $_SESSION['search']['emp_employee_name']; } ?>" class="form-control"/></td>
									
										<td><input type="text" name="city" placeholder="City" value="<?php if(isset($_SESSION['search']['emp_city'])){ echo $_SESSION['search']['emp_city']; } ?>" class="form-control"/></td>
										<td><input type="text" name="address" placeholder="Address" value="<?php if(isset($_SESSION['search']['emp_address'])){ echo $_SESSION['search']['emp_address']; } ?>" class="form-control"/></td>
										<td></td>
										<td></td>
										
										
								
										
										<td>
											<select name="status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['emp_status']) && $_SESSION['search']['emp_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['emp_status']) && $_SESSION['search']['emp_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>
										<td>
											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($data)>0)
										{
											for($i=0;$i<sizeof($data);$i++)
											{
												?>
												<tr>
													<td><?php echo $data[$i]['user_id']; ?></td>
													<td><?php echo $data[$i]['pacific_id']; ?></td>
													<td><?php echo $data[$i]['employee_name']; ?></td>
													<td><?php echo $data[$i]['city']; ?></td>
													<td><?php echo $data[$i]['address']; ?></td>
													<td><?php echo date("d-M-Y",strtotime($data[$i]['add_date'])); ?></td>
													<td>
														<?php
															if($data[$i]['modify_date'])
															{
																echo date("d-M-Y",strtotime($data[$i]['modify_date']));
															}
														?>
													</td>
													<td>
														<?php 
															if($data[$i]['status']=="True")
															{
																echo'<span class="label label-success m-r-15">'.$data[$i]['status'].'</span>';
															}
															else if($data[$i]['status']=="False")
															{
																echo'<span class="label label-warning m-r-15">'.$data[$i]['status'].'</span>';
															}
														?>
													</td>
													<td>
														<select id="<?php echo $data[$i]['employee_id']; ?>" class="action">
															<option selected disabled value="">Select Action</option>
															<option value="Manage">Manage</option>
															<?php
																if($data[$i]['status']=='True')
																{
																	echo'<option value="Disable">Disable</option>';
																}
																 if($data[$i]['status']=='False')
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
												<td colspan="10">
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
			$(".action").change(function()
			{
				var id=$(this).prop("id");
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("administrator/employee/disable?employee_id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("administrator/employee/enable?employee_id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("administrator/employee/manage?employee_id=") ?>"+id;
				}
			});
			
			  $('.datetimepicker2').datetimepicker({
				format:'d-m-Y',
				defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
				timepicker:false
			  });
		</script>
	</div> 
</div>