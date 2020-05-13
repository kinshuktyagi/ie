<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Set</h1>
				<small>Set List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Master</a></li>
					<li class="active">Set Master</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/set/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Set</button></a>
				<a href="<?php echo base_url("account/set/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Set List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/set/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th>Set Name</th>
										<th>Description</th>
										<th style="min-width:90px;">Add Date</th>
										<th style="min-width:100px;">Modify Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									<tr>
										<td><input type="text" name="role_name" placeholder="Set Name" value="<?php if(isset($_SESSION['search']['role_role_name'])){ echo $_SESSION['search']['role_role_name']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="description" placeholder="Description" value="<?php if(isset($_SESSION['search']['role_description'])){ echo $_SESSION['search']['role_description']; } ?>" class="form-control"/></td>
										<td></td>
										<td></td>
										<td>
											<select name="status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['role_status']) && $_SESSION['search']['role_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['role_status']) && $_SESSION['search']['role_status']=='False'){ echo'selected'; } ?>>False</option>
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
													<td><?php echo $data[$i]['set_name']; ?></td>
													<td><?php echo $data[$i]['description']; ?></td>
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
														<select id="<?php echo $data[$i]['set_id']; ?>" class="action">
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
												<td colspan="6">
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
				var client_id=$(this).prop("title");
			
				var action=$(this).val();
				if(action=='Disable')
				{
					document.location="<?php echo base_url("account/set/disable?set_id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/set/enable?set_id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/set/manage?set_id=") ?>"+id;
				}
				
			});
		
		</script>
	</div> 
</div>