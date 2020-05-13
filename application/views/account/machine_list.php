<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Machine</h1>
				<small>Machine List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Machine Master</a></li>
					<li class="active">Machine List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/machine/add_machine"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Machine</button></a>
				<a href="<?php echo base_url("account/machine/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Machine List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/machine/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Machine Code</th>
										<th>Machine Name</th>
										<th>Running Cost</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="mach_code" placeholder="Machine Code" value="<?php if(isset($_SESSION['search']['mach_code'])){ echo $_SESSION['search']['mach_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="mach_name" placeholder="Machine Name" value="<?php if(isset($_SESSION['search']['mach_name'])){ echo $_SESSION['search']['mach_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="mach_running_cost" placeholder="Running Cost" value="<?php if(isset($_SESSION['search']['mach_running_cost'])){ echo $_SESSION['search']['mach_running_cost']; } ?>" class="form-control"/></td>
										<td><input type="text" name="mach_description" placeholder="Description" value="<?php if(isset($_SESSION['search']['mach_description'])){ echo $_SESSION['search']['mach_description']; } ?>" class="form-control"/></td>
										<td>
											<select name="mach_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['mach_status']) && $_SESSION['search']['mach_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['mach_status']) && $_SESSION['search']['mach_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>									
										<td>
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php									
										if(sizeof($machine)>0)
										{
											for($i=0;$i<sizeof($machine);$i++)
											{
												?>
													<tr>
														<td><?php echo $machine[$i]['machine_code']; ?></td>
														<td><?php echo $machine[$i]['machine_name']; ?></td>
														<td><?php echo $machine[$i]['running_cost']; ?></td>
														<td><?php echo $machine[$i]['description']; ?></td>
														<td>
															<?php 
																if($machine[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$machine[$i]['status'].'</span>';
																}
																else if($machine[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$machine[$i]['status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $machine[$i]['machine_id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($machine[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($machine[$i]['status']=='False')
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
					document.location="<?php echo base_url("account/machine/disable?id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/machine/enable?id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/machine/manage?id=") ?>"+id;
				}
				
			});
		
		</script>
		</div> 
	</div>