<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Product</h1>
				<small>Product List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Product Master</a></li>
					<li class="active">Product List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash");?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/product/add_product"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Product</button></a>
				<a href="<?php echo base_url("account/product/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
			<?php 
			/* echo"<pre>";
			print_r($product);
			exit(); */
			?>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Product List</h4>
						</div>
					</div>
					<form method="POST" action="<?php echo base_url("account/product/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 135px;">Product Code</th>
										<th style="min-width: 135px;">Product Name</th>
										<th style="min-width: 135px;">Procurement Type</th>
										<th style="min-width: 130px;">Product Category</th>
										<th style="min-width: 160px;">Product Sub Category</th>
										<th style="min-width: 130px;">Product Type</th>
										<th style="min-width: 130px;">Description</th>
										<th>Status</th>
										<th>Action</th>										
									</tr>
									<tr>
										<td><input type="text" name="pr_product_code" placeholder="Product Code" value="<?php if(isset($_SESSION['search']['pr_product_code'])){ echo $_SESSION['search']['pr_product_code']; } ?>" class="form-control"/></td>
										<td><input type="text" name="pr_product_name" placeholder="Product Name" value="<?php if(isset($_SESSION['search']['pr_product_name'])){ echo $_SESSION['search']['pr_product_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="pr_storage_type" placeholder="Storage Type" value="<?php if(isset($_SESSION['search']['pr_storage_type'])){ echo $_SESSION['search']['pr_storage_type']; } ?>" class="form-control"/></td>
										
										<td><input type="text" name="pr_cat" placeholder="Category" value="<?php if(isset($_SESSION['search']['pr_cat'])){ echo $_SESSION['search']['pr_cat']; } ?>" class="form-control"/></td>
										<td><input type="text" name="pr_sub_cat" placeholder="Sub Category" value="<?php if(isset($_SESSION['search']['pr_sub_cat'])){ echo $_SESSION['search']['pr_sub_cat']; } ?>" class="form-control"/></td>										
										<td>
											<select name="pr_type" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="1" <?php if(isset($_SESSION['search']['pr_type']) && $_SESSION['search']['pr_type']=='1'){ echo'selected'; } ?>>Returnable</option>
												<option value="2" <?php if(isset($_SESSION['search']['pr_type']) && $_SESSION['search']['pr_type']=='False'){ echo'selected'; } ?>>Non Returnable</option>
											</select>
										</td>
																				
										<td><input type="text" name="pr_description" placeholder="Description" value="<?php if(isset($_SESSION['search']['pr_description'])){ echo $_SESSION['search']['pr_description']; } ?>" class="form-control"/></td>
										
										<td>
											<select name="pr_status" class="testselect1">
												<option selected disabled value="">Select Status</option>
												<option value="True" <?php if(isset($_SESSION['search']['pr_status']) && $_SESSION['search']['pr_status']=='True'){ echo'selected'; } ?>>Active</option>
												<option value="False" <?php if(isset($_SESSION['search']['pr_status']) && $_SESSION['search']['pr_status']=='False'){ echo'selected'; } ?>>In-Active</option>
											</select>
										</td>									
										<td>
											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
										
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($product)>0)
										{
											for($i=0;$i<sizeof($product);$i++)
											{
												?>
													<tr>
														<td><?php echo $product[$i]['product_code']; ?></td>
														<td><?php echo $product[$i]['product_name']; ?></td>
														<td><?php echo $product[$i]['storage_type_name']; ?></td>
														<td><?php echo $product[$i]['raw_material_category_name']; ?></td>
														<td><?php echo $product[$i]['sub_cat_name']; ?></td>
														<td>
															<?php 
																if($product[$i]['pro_type']=="1")
																{
																	echo'Returnable';
																}
																else if($product[$i]['pro_type']=="2")
																{
																	echo'Non Returnable';
																}
															?>
														</td>
														<td><?php echo $product[$i]['description']; ?></td>
														<td>
															<?php 
																if($product[$i]['status']=="True")
																{
																	echo'<span class="label label-success m-r-15">Active</span>';
																}
																else if($product[$i]['status']=="False")
																{
																	echo'<span class="label label-warning m-r-15">In-Active</span>';
																}
															?>
														</td>
														<td>
															<select id="<?php echo $product[$i]['product_id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																	<?php
																		if($product[$i]['status']=='True')
																		{
																			echo'<option value="Disable">Disable</option>';
																		}
																		 if($product[$i]['status']=='False')
																		{
																			echo'<option value="Enable">Enable</option>';
																		}
																	?>
																    <option value="Manage">Manage</option>
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
					document.location="<?php echo base_url("account/product/disable?id=") ?>"+id;
				}
				if(action=='Enable')
				{
					document.location="<?php echo base_url("account/product/enable?id=") ?>"+id;
				}
				if(action=='Manage')
				{
					document.location="<?php echo base_url("account/product/manage?id=") ?>"+id;
				}
				if(action=='view')
				{
					document.location="<?php echo base_url("account/product/view?id=") ?>"+id;
				}
				
			});
		
		</script>
		</div> 
	</div>
