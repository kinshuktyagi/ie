<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Permission</h1>
				<small>Permission List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Permission Master</a></li>
					<li class="active">Permission List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/permission/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Permission</button></a>
				<a href="<?php echo base_url("account/permission/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<?php 
		/* echo "<pre>";
		print_r($data);
		exit(); */
		?>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Role List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/permission/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Permission Name</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="role_name" placeholder="Permission Name" value="<?php if(isset($_SESSION['search']['role_name'])){ echo $_SESSION['search']['role_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="description" placeholder="Description" value="<?php if(isset($_SESSION['search']['description'])){ echo $_SESSION['search']['description']; } ?>" class="form-control"/></td>
										<td>
											<select name="status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['status']) && $_SESSION['search']['status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['status']) && $_SESSION['search']['status']=='False'){ echo'selected'; } ?>>False</option>
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
														<td><?php echo $data[$i]['permission_name']; ?></td>
														<td><?php echo $data[$i]['description']; ?></td>
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
															<select id="<?php echo $data[$i]['permission_id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
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
					document.location="<?php echo base_url("account/permission/disable?permission_id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/permission/enable?permission_id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/permission/manage?permission_id=") ?>"+id;
				}
				/* if(action=='Reset')
				{
					document.location="<?php echo base_url("account/role/reset_password?usr=") ?>"+id;
				}
				if(action=='Role')
				{
					document.location="<?php echo base_url("account/role/role?usr=") ?>"+id;
				} */
			});
		
		</script>
		</div> 
	</div>
