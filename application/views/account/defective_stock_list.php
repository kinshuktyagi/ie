<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-title">
				<h1>Defective Stock List</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Raw Stock</a></li>
					<li class="active">Defective  Stock Master</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/defective_stock/add"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Defective Stock</button></a>
				<a href="<?php echo base_url("account/defective_stock/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Defective Stock List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/defective_stock/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width:200px;">Purchase Type</th>
										<th style="min-width:200px;">PO Number</th>
										<th style="min-width:200px;">Description</th>
										<th style="min-width:100px;">Stock Date</th>
										<th style="min-width:100px;">Add Date</th>
										<th style="min-width:150px;">Total Quantity</th>
										<th style="min-width:150px;">Action</th>
									</tr>
									<tr>
										
										<td>
											<select name="po_type" class="form-control">
												<option selected disabled value="">Select PO TYpe</option>
												<option value="True" <?php if(isset($_SESSION['search']['po_status']) && $_SESSION['search']['po_status']=='True'){ echo'selected'; } ?>>With PO</option>
												<option value="False" <?php if(isset($_SESSION['search']['po_status']) && $_SESSION['search']['po_status']=='False'){ echo'selected'; } ?>>Without PO</option>
											</select>
										</td>
										<td>
										<input type="text" name="po_number" placeholder="PO NUmber" value="<?php if(isset($_SESSION['search']['po_vendorcode'])){ echo $_SESSION['search']['po_vendorcode']; } ?>" class="form-control"/></td>
										<td><input type="text" name="description" placeholder="Description" value="<?php if(isset($_SESSION['search']['po_address'])){ echo $_SESSION['search']['po_address']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="stock_date" class="form-control datetimepicker2" autocomplete="off" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['po_add_date'])){ echo $_SESSION['search']['po_add_date']; } ?>"/></td>
										
										<td><input type="text" name="add_date" class="form-control datetimepicker2" autocomplete="off" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['po_add_date'])){ echo $_SESSION['search']['po_add_date']; } ?>"/></td>
										<td></td>
										
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
													<td><?php echo $data[$i]['po_type_name']; ?></td>
													<td><?php echo $data[$i]['po_id']; ?></td>
													<td><?php echo $data[$i]['description']; ?></td>
													<td><?php echo date("d-M-Y",strtotime($data[$i]['stock_date'])); ?></td>
													<td><?php echo date("d-M-Y",strtotime($data[$i]['add_date'])); ?></td>
													<td><?php echo $data[$i]['quantity']; ?></td>
													
												
													<td>
														<select id="<?php echo $data[$i]['defective_stock_id']; ?>" class="action">
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
			
				var action=$(this).val();
				/* if(action=='Disable')
				{
					document.location="<?php echo base_url('account/defective_stock/disable?po_id=') ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url('account/defective_stock/enable?po_id=') ?>"+id;
				} */
				if(action=='View')
				{
					document.location="<?php echo base_url('account/defective_stock/view?id=') ?>"+id;
				}
				
			}); 
		
		</script>
	</div> 
</div>