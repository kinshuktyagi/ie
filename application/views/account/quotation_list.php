<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Quotation</h1>
				<small>Quotation List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Quotation Master</a></li>
					<li class="active">Quotation List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/quotation/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Quotation List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/quotation/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 130px";>Enquiry Code</th>
										<th style="min-width: 141px";>Quotation Code</th>
										<th style="min-width: 145px">Customer Name</th>
										<th>Order Type</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width: 115px">Status</th>
										<th style="min-width: 115px">Followup Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="itq_enquiry_code" placeholder="Enquiry Code" value="<?php if(isset($_SESSION['search']['itq_enquiry_code'])){ echo $_SESSION['search']['itq_enquiry_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="itq_quotation_code" placeholder="Quotation Code" value="<?php if(isset($_SESSION['search']['itq_quotation_code'])){ echo $_SESSION['search']['itq_quotation_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="itq_compny_name" placeholder="Company Name" value="<?php if(isset($_SESSION['search']['itq_compny_name'])){ echo $_SESSION['search']['itq_compny_name']; } ?>" class="form-control"/></td>
										<td>
											<select name="itq_order_type" class="testselect1">
												<option selected disabled value="">Select Order Type</option>
												<option value="1" <?php if(isset($_SESSION['search']['itq_order_type']) && $_SESSION['search']['itq_order_type']=='1'){ echo'selected'; } ?>>Sales</option>
												<option value="2" <?php if(isset($_SESSION['search']['itq_order_type']) && $_SESSION['search']['itq_order_type']=='2'){ echo'selected'; } ?>>Job Work </option>
											</select>
										</td>
										
										<td><input type="text" name="itq_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['itq_email'])){ echo $_SESSION['search']['itq_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="itq_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['itq_phone'])){ echo $_SESSION['search']['itq_phone']; } ?>" class="form-control"/></td>
										<td>
										<!--<input type="text" name="itq_added_by" placeholder="First Name" value="<?php if(isset($_SESSION['search']['itq_added_by'])){ echo $_SESSION['search']['itq_added_by']; } ?>" class="form-control"/>-->
											<select name="itq_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['itq_status']) && $_SESSION['search']['itq_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['itq_status']) && $_SESSION['search']['itq_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>
										<td>
											<select name="itq_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['itq_status']) && $_SESSION['search']['itq_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['itq_status']) && $_SESSION['search']['itq_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>	
										<td>											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php
									/* echo"<pre>";
									print_r($enquiry);
									exit(); */
									
										if(sizeof($enquiry)>0)
										{
											for($i=0;$i<sizeof($enquiry);$i++)
											{
												?>
													<tr>
														<td><?php echo $enquiry[$i]['enquiry_code'];?>
														<td><?php echo $enquiry[$i]['quotation_code'];?>
														<td><?php echo $enquiry[$i]['name']; ?></td>
														</td>
														<td><?php 
														if($enquiry[$i]['order_type'] =='1')
														{
															echo"Sales";
														}else{
															echo "Job Work";
														}
														?></td>
														<td><?php echo $enquiry[$i]['email']; ?></td>
														<td><?php echo $enquiry[$i]['phone']; ?></td>
														<!--<td><?php echo $enquiry[$i]['first_name'].' '.$enquiry[$i]['last_name']; ?></td>-->
														<td>
															<?php 
																if($enquiry[$i]['quotation_status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$enquiry[$i]['quotation_status'].'</span>';
																}
																else if($enquiry[$i]['quotation_status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$enquiry[$i]['quotation_status'].'</span>';
																}
															?>
														</td>
														<td>
															<?php 
																if($enquiry[$i]['quotation_followup_status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$enquiry[$i]['quotation_followup_status'].'</span>';
																}
																else if($enquiry[$i]['quotation_followup_status']=="False")
																{
																	echo'<span class="label label-danger m-r-15">'.$enquiry[$i]['quotation_followup_status'].'</span>';
																}
																else
																{
																	echo'<span class="label label-warning m-r-15">'.$enquiry[$i]['quotation_followup_status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $enquiry[$i]['id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																<?php 
																if($enquiry[$i]['quotation_status']=='False')
																{
																	echo'<option value="add">Add Quotation</option>';
																}elseif($enquiry[$i]['quotation_status']=='True')
																{
																	echo'<option value="manage"> Manage </option>';
																	echo '<option value="view">View</option>';
																	echo '<option value="view_log">View Log</option>';
																	echo '<option value="followup">Followup</option>';
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
				if(action=='add')
				{
					document.location="<?php echo base_url("account/quotation/add_quotation?id=") ?>"+id;
				}
				if(action=='manage')
				{
					document.location="<?php echo base_url("account/quotation/manage_quotation?id=") ?>"+id;
				}
				
				if(action=='view')
				{
					document.location="<?php echo base_url("account/quotation/view_quotation?id=") ?>"+id;
				}
				if(action=='view_log')
				{
					document.location="<?php echo base_url("account/quotation/view_quotation_log?id=") ?>"+id;
				}
				if(action=='followup')
				{
					document.location="<?php echo base_url("account/quotation/quotation_followup?id=") ?>"+id;
				}
			});
		
		</script>
		</div> 
	</div>
