<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Enquiry</h1>
				<small>Enquiry List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li class="active">Enquiry List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<!--<a href="<?php echo base_url("account/enquiry/assigned"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">UnAssign Enquiry</button></a>-->
				<a href="<?php echo base_url("account/enquiry/unassign"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Assign Enquiry</button></a>
				<a href="<?php echo base_url("account/enquiry/add_enquiry"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Enquiry</button></a>
				<a href="<?php echo base_url("account/enquiry/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/enquiry/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 130px">Enquiry Code</th>
										<th style="min-width: 145px">Customer Name</th>
										<th>Order Type</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width: 115px">Added By</th>
										<th style="min-width: 100px">Add Date</th>
										<th style="min-width: 120px">Modify Date</th>
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="it_enquiry_code" placeholder="Enquiry Code" value="<?php if(isset($_SESSION['search']['it_enquiry_code'])){ echo $_SESSION['search']['it_enquiry_code']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="it_compny_name" placeholder="Customer Name" value="<?php if(isset($_SESSION['search']['it_compny_name'])){ echo $_SESSION['search']['it_compny_name']; } ?>" class="form-control"/></td>
										
										<td>
											<select name="it_order_type" class="testselect1">
												<option selected disabled value="">Select Order Type</option>
												<option value="1" <?php if(isset($_SESSION['search']['it_order_type']) && $_SESSION['search']['it_order_type']=='1'){ echo'selected'; } ?>>Sales</option>
												<option value="2" <?php if(isset($_SESSION['search']['it_order_type']) && $_SESSION['search']['it_order_type']=='2'){ echo'selected'; } ?>>Job Work </option>
											</select>
										</td>										
										<td><input type="text" name="it_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['it_email'])){ echo $_SESSION['search']['it_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="it_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['it_phone'])){ echo $_SESSION['search']['it_phone']; } ?>" class="form-control"/></td>
										<td><input type="text" name="it_added_by" placeholder="First Name" value="<?php if(isset($_SESSION['search']['it_added_by'])){ echo $_SESSION['search']['it_added_by']; } ?>" class="form-control"/></td>
										<td><input type="text" name="it_add_date" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['it_add_date']) && ($_SESSION['search']['it_add_date']!='') ){ echo date("d-M-Y",strtotime($_SESSION['search']['it_add_date'])); } ?>" class="form-control"/></td>
										<td><input type="text" name="it_modify_date" placeholder="Modify Date" value="<?php if(isset($_SESSION['search']['it_modify_date']) && ($_SESSION['search']['it_modify_date']!='')){ 
										echo date("d-M-Y",strtotime($_SESSION['search']['it_modify_date'])); } ?>" class="form-control"/></td>
										<td>
											<select name="it_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['it_status']) && $_SESSION['search']['it_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['it_status']) && $_SESSION['search']['it_status']=='False'){ echo'selected'; } ?>>False</option>
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
														<td><?php echo $user[$i]['enquiry_code']; ?></td>
														<td><?php echo $user[$i]['name']; ?></td>
														<td><?php 
														if($user[$i]['order_type'] =='1')
														{
															echo"Sales";
														}else{
															echo "Job Work";
														}
														?></td>
														<td><?php echo $user[$i]['email']; ?></td>
														<td><?php echo $user[$i]['phone']; ?></td>
														<td><?php echo $user[$i]['first_name'].' '.$user[$i]['last_name']; ?></td>
														<td><?php
															if ( $user[$i]['add_date']!='') {
																echo date("d-M-Y",strtotime($user[$i]['add_date']));
															}?>
														</td>
														<td><?php
															if ( $user[$i]['modify_date']!='') {
																echo date("d-M-Y",strtotime($user[$i]['modify_date']));
															}?>
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
																		echo'<option value="Manage">Manage</option>';
																		echo '<option value="view">View</option>';
																	
																		if($user[$i]['enquiry_followup_status']=='False')
																		{
																			echo'<option value="view_fowlloup">View Followup</option>';
																			echo'<option value="report">Report</option>';
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
					document.location="<?php echo base_url("account/enquiry/disable?id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/enquiry/enable?id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/enquiry/manage?id=") ?>"+id;
				}
				if(action=='view')
				{
					document.location="<?php echo base_url("account/enquiry/view_enquiry?id=") ?>"+id;
				}
				if(action=='view_fowlloup')
				{
					document.location="<?php echo base_url("account/enquiry/view?enquiry_id=") ?>"+id;
				}
				if(action=='report')
				{
					document.location="<?php echo base_url("account/enquiry/followup_report?enquiry_id=") ?>"+id;
				}
			});
		
		</script>
		</div> 
	</div>
