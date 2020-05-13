<style>
.container-non-responsive {
  /* Margin/padding copied from Bootstrap */
  margin-left: auto;
  margin-right: auto;
  padding-left: 15px;
  padding-right: 15px;

  /* Set width to your desired site width */
    width:100%;
}
		
</style>

<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header hidden-print">
			<div class="header-icon">
				<i class="pe-7s-news-paper"></i>
			</div>
			<div class="content-header">
				<div class="header-title">
					<h1>Product Detail</h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
						<li><a href="<?php echo base_url('account/product/index'); ?>">Product List</a></li>
						<li class="active">Product Detail</li>
					</ol>
				</div>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="container-non-responsive">
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-bd">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6">
									<img src="<?php echo base_url()?>public/assets/profile_pic/logo.png" class="img-responsive" alt="" style="width: 160px;">
									<br>
									<address></address>
									<address>
									</address>
								</div>
								<div class="col-xs-6 text-right">
									<address>
										<strong style="font-size: larger;">Product Code: <?php echo $product['product_code'];?></strong><br>
										<span>Product Category: <?php echo $product['category_name']; ?> </span></br>
										<span>Procurement Type: <?php echo $product['storage_type_name']; ?> </span>
										</br>
									</address>
								</div>
							</div>
							<hr>	
								<div class="row">
									<div class="col-sm-6">										
										<br>
										<span></span>
										<address>
											<strong>Product Name: </strong><?php echo $product['product_name'];?><br>
											<strong>HSN Code: </strong><?php echo $product['hsn_code'];?><br>
											<strong>Trash Hold: </strong><?php echo $product['trash_hold'];?><br>
											<strong>Add Date: </strong><?php echo $product['add_date'];?><br>
											<strong>UOM Name: </strong><?php echo $product['uom_name'];?><br>
										</address>                                    
										<address>
											<div class="table-responsive m-b-20">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>Weight</th>
															<th>Thikness</th>
															<th>Material</th>
															<th>Dimension</th>
															<th>Stress Relieved</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><div><strong><?php echo $product['weight']; ?></strong></div>
															</td>
															<td><?php echo $product['thikness']; ?></td>
															<td><?php echo $product['material']; ?></td>
															<td><?php echo $product['dimension']; ?></td>
															<td><?php echo $product['stress_relieved']; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</address>                                    
									</div>                  
								</div>
								<span>
									<h5><b>Description: </b></h5></span>
									<?php  echo $product['description']?>
									<br>									 
								</span><br><br>
							<h3>Vendor Details.</h3>
							<div class="table-responsive m-b-20">
								<table class="table table-bordered">
									<thead>
										<tr class="t_head">
											<th>Vendor Code</th>
											<th>Vendor Name</th>
											<th>SKU Code</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$info = $product['vendor_details'];
										
										if(sizeof($info)>0)
										{
											for($j=0; sizeof($info)>$j; $j++)
											{
												?>
												<tr>
													<td>
														<div>
															<strong><?php echo $info[$j]['vendor_code']; ?></strong>
														</div>
													</td>
													<td><?php echo $info[$j]['vendor_name'];?></td>
													<td><?php echo $info[$j]['sku_code'];?></td>
													<td><?php echo $info[$j]['price'];?></td>
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
							<br>
							<br>
							
						</div>
						<div class="panel-footer text-left hidden-print">
							<a href="<?php if($_SERVER['HTTP_REFERER']){ echo $_SERVER['HTTP_REFERER']; }else { echo base_url('account/po/index'); } ?>"><button type="button" class="btn btn-warning" ><< Back</button></a>
							<button type="button" class="btn btn-info" onclick="window.print()"><span class="fa fa-print"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>