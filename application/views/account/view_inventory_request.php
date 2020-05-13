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
					<h1>Inventory Request Detail</h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
						<li><a href="<?php echo base_url('account/inventory_request/index'); ?>">Inventory Request List</a></li>
						<li class="active">Inventory Request Detail</li>
					</ol>
				</div>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="container-non-responsive">
			<div class="row">
			<?php 
			/* echo"<pre>";
			print_r($info);
			exit(); */
			?>
				<div class="col-xs-12">
					<div class="panel panel-bd">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6">
									<img src="<?php echo base_url()?>public/assets/profile_pic/logo.png" class="img-responsive" alt="" style="width: 100px;">
									
								</div>
								<div class="col-xs-6 text-right">
										<address>
											<strong>Production Date	: </strong><?php echo $info['production_date'];?><br>
											<strong>Request Code: </strong><?php echo $info['inventory_request_code'];?><br>
											<!--<strong>Added By: </strong><?php echo $info['first_name'];?><br>
											<strong>Add Date: </strong><?php echo $info['add_date'];?><br>
											<strong>Status: </strong><?php echo $info['request_status'];?><br>-->
										</address>
								</div>
							</div>
							<hr>	
								<div class="row">
									<div class="col-sm-6">										
										<br>
										                                    
										                                   
									</div>                  
								</div>
								<span>
									<h5><b>Description: </b></h5></span>
									<?php  echo $info['description']?>
									<br>									 
								</span><br><br>
							<h3>Product Details.</h3>
							<div class="table-responsive m-b-20">
								<table class="table table-bordered">
									<thead>
										<tr class="t_head">
											<th>Product Code</th>
											<th>Product Name</th>
											<th>Quantity</th>									
											<th>Notes</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$product = $info['product'];
										
										if(sizeof($product)>0)
										{
											for($j=0; sizeof($product)>$j; $j++)
											{
												?>
												<tr>
													<td>
														<div>
															<strong><?php echo $product[$j]['product_code']; ?></strong>
														</div>
													</td>
													<td><?php echo $product[$j]['product_name'];?></td>
													<td><?php echo $product[$j]['product_qty'];?></td>
													<td><?php echo $product[$j]['notes'];?></td>
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
							<!--<a href="<?php if($_SERVER['HTTP_REFERER']){ echo $_SERVER['HTTP_REFERER']; }else { echo base_url('account/inventory_request/index'); } ?>"><button type="button" class="btn btn-warning" ><< Back</button></a>-->
							<button type="button" class="btn btn-info" onclick="window.print()"><span class="fa fa-print"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>