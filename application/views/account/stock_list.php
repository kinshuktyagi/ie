<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-title">
				<h1>Stock List</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Raw Stock Master</a></li>
					<li class="active">Stock List</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				
				<a href="<?php echo base_url("account/stocks/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Stock</button></a>
				<a href="<?php echo base_url("account/stocks/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Defective Stock</button></a>
				<a href="<?php echo base_url("account/stocks/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
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
										<th style="min-width:200px;">PO ID</th>
										<th style="min-width:200px;">Vendor Code</th>
										<th style="min-width:200px;">Address</th>
										<th style="min-width:100px;">Add Date</th>
										<th style="min-width:150px;">Total Quantity</th>
										<th style="min-width:150px;">Received Quantity</th>
										<th style="min-width:150px;">Received Status</th>
										<th style="min-width:150px;">Status</th>
										<th style="min-width:150px;">Action</th>
									</tr>
									<tr>
										
										<td><input type="text" name="poid" placeholder="PO IDS" value="<?php if(isset($_SESSION['search']['po_poid'])){ echo $_SESSION['search']['po_poid']; } ?>" class="form-control"/></td>
										<td><input type="text" name="vendorcode" placeholder="Vendor Code" value="<?php if(isset($_SESSION['search']['po_vendorcode'])){ echo $_SESSION['search']['po_vendorcode']; } ?>" class="form-control"/></td>
										<td><input type="text" name="address" placeholder="Address" value="<?php if(isset($_SESSION['search']['po_address'])){ echo $_SESSION['search']['po_address']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="add_date" class="form-control datetimepicker2" autocomplete="off" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['po_add_date'])){ echo $_SESSION['search']['po_add_date']; } ?>"/></td>
										<td></td>
										<td></td>
										<td>
											<select name="po_status" class="form-control">
												<option selected disabled value="">Select Status</option>
												<option value="Pending" <?php if(isset($_SESSION['search']['po_po_status']) && $_SESSION['search']['po_po_status']=='Pending'){ echo'selected'; } ?>>Pending</option>
												<option value="Completed" <?php if(isset($_SESSION['search']['po_po_status']) && $_SESSION['search']['po_po_status']=='Completed'){ echo'selected'; } ?>>Completed</option>
												<option value="Partial Completed" <?php if(isset($_SESSION['search']['po_po_status']) && $_SESSION['search']['po_po_status']=='Partial Completed'){ echo'selected'; } ?>>Partial Completed</option>
											</select>
										</td>
										<td>
											<select name="status" class="form-control">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['po_status']) && $_SESSION['search']['po_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['po_status']) && $_SESSION['search']['po_status']=='False'){ echo'selected'; } ?>>False</option>
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
													<td><?php echo $data[$i]['poid']; ?></td>
													<td><?php echo $data[$i]['vendor_code']; ?></td>
													<td><?php echo $data[$i]['vendor_address']; ?></td>
													<td><?php echo date("d-M-Y",strtotime($data[$i]['add_date'])); ?></td>
													<td><?php echo $data[$i]['quantity']; ?></td>
													<td><?php echo $data[$i]['received_quantity']; ?></td>
													
													<td>
														<?php 
															if($data[$i]['receive_status']=="Pending")
															{
																echo'<span class="label label-warning m-r-15">'.$data[$i]['receive_status'].'</span>';
															}
															else if($data[$i]['receive_status']=="Completed")
															{
																echo'<span class="label label-success m-r-15">'.$data[$i]['receive_status'].'</span>';
															}
															else if($data[$i]['receive_status']=="Partial Completed")
															{
																echo'<span class="label label-primary m-r-15">'.$data[$i]['receive_status'].'</span>';
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
														<select id="<?php echo $data[$i]['poid']; ?>" class="action">
															<option selected disabled value="">Select Action</option>
															<option value="View">View</option>
														
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
		
		$('.datetimepicker2').datetimepicker({
			format:'d-m-Y',
			defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
			timepicker:false
		});
			$(".action").change(function()
			{
				var id=$(this).prop("id");
				var client_id=$(this).prop("title");
			
				var action=$(this).val();
			
				if(action=='View')
				{
					document.location="<?php echo base_url('account/po/view?poid=') ?>"+id;
				}
				
			}); 
		
		</script>
	</div> 
</div>