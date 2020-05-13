<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>PO</h1>
				<small>PO List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">PO Master</a></li>
					<li class="active">PO List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/po/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add PO</button></a>
				<a href="<?php echo base_url("account/po/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>PO List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/po/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 85px;">PO ID</th>
										<th style="min-width: 125px;">Vendor Code</th>
										<th style="min-width: 145px;">Address</th>
										<th style="min-width: 90px;">Add Date</th>
										<th style="min-width: 130px;">Total Quantity</th>
										<th style="min-width: 160px;">Received Quantity</th>
										<th>Received Status</th>
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="p_poid" placeholder="PO ID" value="<?php if(isset($_SESSION['search']['p_poid'])){ echo $_SESSION['search']['p_poid']; } ?>" class="form-control"/></td>
										<td><input type="text" name="p_vendor_code" placeholder="Vendor Code" value="<?php if(isset($_SESSION['search']['p_vendor_code'])){ echo $_SESSION['search']['p_vendor_code']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="p_vendor_address" placeholder="Vendor Address" value="<?php if(isset($_SESSION['search']['p_vendor_address'])){ echo $_SESSION['search']['p_vendor_address']; } ?>" class="form-control"/></td>
										<td></td>
										<td></td>
										<td></td>
										
										<!--<td><input type="text" name="p_total_qty" placeholder="Total Quantity" value="<?php if(isset($_SESSION['search']['p_total_qty'])){ echo $_SESSION['search']['p_total_qty']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="p_received_qty" placeholder="Received Quantity" value="<?php if(isset($_SESSION['search']['p_received_qty'])){ echo $_SESSION['search']['p_received_qty']; } ?>" class="form-control"/></td>
										-->
										<td>
											<select name="p_po_received_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="Pending" <?php if(isset($_SESSION['search']['p_po_received_status']) && $_SESSION['search']['p_po_received_status']=='Pending'){ echo'selected'; } ?>>Pending</option>
												<option value="Completed" <?php if(isset($_SESSION['search']['p_po_received_status']) && $_SESSION['search']['p_po_received_status']=='Completed'){ echo'selected'; } ?>>Completed</option>
												<option value="Partial Completed" <?php if(isset($_SESSION['search']['p_po_received_status']) && $_SESSION['search']['p_po_received_status']=='Partial Completed'){ echo'selected'; } ?>>Partial Completed</option>
											</select>
										</td>
										
										<td>
											<select name="p_po_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['p_po_status']) && $_SESSION['search']['p_po_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['p_po_status']) && $_SESSION['search']['p_po_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>									
										<td>
											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($po)>0)
										{
											for($i=0;$i<sizeof($po);$i++)
											{
												?>
													<tr>
														<td><?php echo $po[$i]['poid']; ?></td>
														<td><?php echo $po[$i]['vendor_code']; ?></td>
														<td><?php echo $po[$i]['vendor_address']; ?></td>
														<td><?php
															if ( $po[$i]['add_date']!='') {
																echo date("d-M-Y",strtotime($po[$i]['add_date']));
															}?>
														</td>
														<td><?php echo $po[$i]['total_qty']; ?></td>
														<td><?php echo $po[$i]['recived_qty']; ?></td>
														<td>
															<?php 
																if($po[$i]['receive_status']=="Pending")
																{
																	echo'<span class="label label-warning m-r-15">'.$po[$i]['receive_status'].'</span>';
																}
																else if($po[$i]['receive_status']=="Completed")
																{
																	echo'<span class="label label-success m-r-15">'.$po[$i]['receive_status'].'</span>';
																}
																else if($po[$i]['receive_status']=="Partial Completed")
																{
																	echo'<span class="label label-success m-r-15">'.$po[$i]['receive_status'].'</span>';
																}
															?>
														</td>
														<td>
															<?php 
																if($po[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$po[$i]['status'].'</span>';
																}
																else if($po[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$po[$i]['status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $po[$i]['poid']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($po[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($po[$i]['status']=='False')
																		{
																			echo'<option value="Enable">Enable</option>';
																		}
																	?>
																    <option value="manage">Manage</option>
																    <option value="view">View</option>
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
					document.location="<?php echo base_url("account/po/disable?poid=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/po/enable?poid=") ?>"+id;
				}
				if(action=='view')
				{
					document.location="<?php echo base_url("account/po/view?poid=") ?>"+id;
				}
				if(action=='manage')
				{
					document.location="<?php echo base_url("account/po/manage?poid=") ?>"+id;
				}
				
			});
		
		</script>
		</div> 
	</div>
