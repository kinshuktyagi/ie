<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Vendor</h1>
				<small>Vendor List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Vendor Master</a></li>
					<li class="active">Vendor List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/vendor/add_vendor"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Vendor</button></a>
				<a href="<?php echo base_url("account/vendor/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Vendor List</h4>
						</div>
					</div>
					<?php 
					/* echo"<pre>";
					//print_r($vendor);
					$_SESSION;
					exit(); */
					
					?>
					<form method="POST" action="<?php echo base_url("account/vendor/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width:124px;">Vendor Code</th>
										<th style="min-width:130px;">Vendor Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width:75px;">Alternate Phone</th>
										<!--<th style="min-width:75px;">GST</th>
										<th style="min-width:75px;">PAN</th>
										<th style="min-width:75px;">TAN</th>
										<th style="min-width:75px;">CIIB</th>
										<th style="min-width:170px;">Registered Address</th>
										<th style="min-width:170px;">Company Address</th>
										<th style="min-width:170px;">Bussiness Address</th>
										<th style="min-width:120px;">Established</th>
										<th style="min-width:85px;">Country </th>
										<th style="min-width:90px;">State</th>
										<th style="min-width:100px;">City</th>
										<th style="min-width:85px;">Pin Code</th>
										<th style="min-width:130px;">Bank Name</th>
										<th style="min-width:130px;">Account Number</th>
										<th style="min-width:115px;">IFSC Code</th>
										<th style="min-width:130px;">Bank Address</th>
										<th style="min-width:180px;">Contact Person Name</th>
										<th style="min-width:180px;">Contact Person Email</th>
										<th style="min-width:183px;">Contact Person Phone</th>
										<th style="min-width:245px;">Contact Person Alternate Phone</th>-->
										<th style="min-width:100px;">Add Date</th>
										<th style="min-width:118px;">Modify Date</th>
										<th>Status</th>										
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="v_code" placeholder="Vendor Code" value="<?php if(isset($_SESSION['search']['v_code'])){ echo $_SESSION['search']['v_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_name" placeholder="Vendor Name" value="<?php if(isset($_SESSION['search']['v_name'])){ echo $_SESSION['search']['v_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_email" placeholder="Vendor Email" value="<?php if(isset($_SESSION['search']['v_email'])){ echo $_SESSION['search']['v_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['v_phone'])){ echo $_SESSION['search']['v_phone']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_alt_phone" placeholder="Alternate Phone" value="<?php if(isset($_SESSION['search']['v_alt_phone'])){ echo $_SESSION['search']['v_alt_phone']; } ?>" class="form-control"/></td>
										<!--<td><input type="text" name="v_gst" placeholder="GST" value="<?php if(isset($_SESSION['search']['v_gst'])){ echo $_SESSION['search']['v_gst']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_pan" placeholder="PAN" value="<?php if(isset($_SESSION['search']['v_pan'])){ echo $_SESSION['search']['v_pan']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_tan" placeholder="TAN" value="<?php if(isset($_SESSION['search']['v_tan'])){ echo $_SESSION['search']['v_tan']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_ciib" placeholder="CIIB" value="<?php if(isset($_SESSION['search']['v_ciib'])){ echo $_SESSION['search']['v_ciib']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_reg_address" placeholder="Registered Address" value="<?php if(isset($_SESSION['search']['v_reg_address'])){ echo $_SESSION['search']['v_reg_address']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_company_address" placeholder="Company Address" value="<?php if(isset($_SESSION['search']['v_company_address'])){ echo $_SESSION['search']['v_company_address']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_bussiness_address" placeholder="Bussiness Address" value="<?php if(isset($_SESSION['search']['v_bussiness_address'])){ echo $_SESSION['search']['v_bussiness_address']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_established" placeholder="Established" value="<?php if(isset($_SESSION['search']['v_established'])){ echo $_SESSION['search']['v_established']; } ?>" class="form-control"/></td><td><input type="text" name="v_country" placeholder="Coutry" value="<?php if(isset($_SESSION['search']['v_country'])){ echo $_SESSION['search']['v_country']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_state" placeholder="State" value="<?php if(isset($_SESSION['search']['v_state'])){ echo $_SESSION['search']['v_state']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_city" placeholder="City" value="<?php if(isset($_SESSION['search']['v_city'])){ echo $_SESSION['search']['v_city']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_pin_code" placeholder="State" value="<?php if(isset($_SESSION['search']['v_pin_code'])){ echo $_SESSION['search']['v_pin_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_bank_name" placeholder="Bank Name" value="<?php if(isset($_SESSION['search']['v_bank_name'])){ echo $_SESSION['search']['v_bank_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_account_no" placeholder="State" value="<?php if(isset($_SESSION['search']['v_account_no'])){ echo $_SESSION['search']['v_account_no']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_ifsc_code" placeholder="IFSC Code" value="<?php if(isset($_SESSION['search']['v_ifsc_code'])){ echo $_SESSION['search']['v_ifsc_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_bank_address" placeholder="Bank Address" value="<?php if(isset($_SESSION['search']['v_bank_address'])){ echo $_SESSION['search']['v_bank_address']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_cp_name" placeholder="Contact Person Name" value="<?php if(isset($_SESSION['search']['v_cp_name'])){ echo $_SESSION['search']['v_cp_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_cp_email" placeholder="Contact Person Email" value="<?php if(isset($_SESSION['search']['v_cp_email'])){ echo $_SESSION['search']['v_cp_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_cp_phone" placeholder="Contact Person Phone" value="<?php if(isset($_SESSION['search']['v_cp_phone'])){ echo $_SESSION['search']['v_cp_phone']; } ?>" class="form-control"/></td>
										<td><input type="text" name="v_cp_alt_phone" placeholder="Contact Person Alternate phone" value="<?php if(isset($_SESSION['search']['v_cp_alt_phone'])){ echo $_SESSION['search']['v_cp_alt_phone']; } ?>" class="form-control"/></td>-->
										
										<!--<td><input type="text" name="it_add_date" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['it_add_date']) && ($_SESSION['search']['it_add_date']!='') ){ echo date("d-M-Y",strtotime($_SESSION['search']['it_add_date'])); } ?>" class="form-control"/></td>-->
										
										
										<td><input type="text" name="v_add_date" placeholder="Add Date" value="<?php if(isset($_SESSION['search']['v_add_date']) && ($_SESSION['search']['v_add_date']!='')){ echo date("d-M-Y",strtotime($_SESSION['search']['v_add_date'])); } ?>" class="form-control"/></td>
										<td><input type="text" name="v_modify_date" placeholder="Modify Date" value="<?php if(isset($_SESSION['search']['v_modify_date']) && ($_SESSION['search']['v_modify_date']!='')){ echo date("d-M-Y",strtotime($_SESSION['search']['v_modify_date'])); } ?>" class="form-control"/></td>
										<td>
											<select name="v_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['v_status']) && $_SESSION['search']['v_status']=='True'){ echo'selected'; } ?>>True</option>
												<option value="False" <?php if(isset($_SESSION['search']['v_status']) && $_SESSION['search']['v_status']=='False'){ echo'selected'; } ?>>False</option>
											</select>
										</td>									
										<td>
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								
								<tbody>
									<?php
										if(sizeof($vendor)>0)
										{
											for($i=0;$i<sizeof($vendor);$i++)
											{
												?>
													<tr>								
								<td><?php echo $vendor[$i]['vendor_code']; ?></td>
								<td><?php echo $vendor[$i]['vendor_name']; ?></td>
								<td><?php echo $vendor[$i]['vendor_email']; ?></td>
								<td><?php echo $vendor[$i]['vendor_phone']; ?></td>
								<td><?php echo $vendor[$i]['vendor_alternate_phone']; ?></td>
								<!--<td><?php echo $vendor[$i]['vendor_gst']; ?></td>
								<td><?php echo $vendor[$i]['vendor_pan']; ?></td>
								<td><?php echo $vendor[$i]['vendor_tan']; ?></td>
								<td><?php echo $vendor[$i]['vendor_ciib']; ?></td>
								<td><?php echo $vendor[$i]['vendor_registered_address']; ?></td>
								<td><?php echo $vendor[$i]['vendor_company_address']; ?></td>
								<td><?php echo $vendor[$i]['vendor_business_address']; ?></td>
								<td><?php echo $vendor[$i]['date_of_established']; ?></td>
								<td><?php echo $vendor[$i]['countryName']; ?></td>
								<td><?php echo $vendor[$i]['stateName']; ?></td>
								<td><?php echo $vendor[$i]['vendor_city']; ?></td>
								<td><?php echo $vendor[$i]['vendor_pincode']; ?></td>
								<td><?php echo $vendor[$i]['vendor_bank_name']; ?></td>
								<td><?php echo $vendor[$i]['vendor_account_number']; ?></td>
								<td><?php echo $vendor[$i]['vendor_ifsc_code']; ?></td>
								<td><?php echo $vendor[$i]['vendor_bank_address']; ?></td>
								<td><?php echo $vendor[$i]['contact_person_name']; ?></td>
								<td><?php echo $vendor[$i]['contact_person_email']; ?></td>
								<td><?php echo $vendor[$i]['contact_person_mobile']; ?></td>
								<td><?php echo $vendor[$i]['contact_person_alt_mobile']; ?></td>-->
								<td><?php echo date("d-M-Y", strtotime($vendor[$i]['add_date'])); ?></td>
								<td><?php 
								if($vendor[$i]['modify_date']!=''){
									echo date("d-M-Y", strtotime($vendor[$i]['modify_date']));
								}
								 ?></td>
														
														
														<td>
															<?php 
																if($vendor[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">'.$vendor[$i]['status'].'</span>';
																}
																else if($vendor[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">'.$vendor[$i]['status'].'</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $vendor[$i]['vendor_id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($vendor[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($vendor[$i]['status']=='False')
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
					document.location="<?php echo base_url("account/vendor/disable?vendor_id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/vendor/enable?vendor_id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/vendor/manage?vendor_id=") ?>"+id;
				}
				
			});
		
		</script>
		</div> 
	</div>
