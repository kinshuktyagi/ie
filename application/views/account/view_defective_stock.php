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
				<h1>Defected Stock Detail</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url('account/defective_stock/index'); ?>">Defected Stock List</a></li>
					<li class="active">Defected Stock Detail</li>
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
								<img src="assets/dist/img/dark-logo.png" class="img-responsive" alt="">
								<br>
								<address>
									<strong><?php echo $stock['vendor_name'];?></strong><br>
									<?php echo $stock['vendor_phone'];?><br>
									<?php echo $stock['vendor_email'];?><br>
									<?php echo $stock['vendor_address'];?><br>
									<?php echo $stock['countryName'];?><br>
									<?php echo $stock['stateNAme'];?><br>
									<?php echo $stock['vendor_city'].' '.$stock['vendor_pincode'];?><br>
								</address>
					
								</address>
								<!--<address>
									<strong>Full Name</strong><br>
									<a href="cdn-cgi/l/email-protection.html#9cbf"><span class="__cf_email__" data-cfemail="e18788939295cf8d809295a18499808c918d84cf828e8c">[email&#160;protected]</span></a>
								</address>-->
							</div>
							<div class="col-xs-6 text-right">
								<?php 
								if($stock['purchase_type'] == '2')
								{
								?>															
								<address>
									<?php //echo $stock['vendor_address']; ?><br>
									<abbr title="Code">Vendor :</abbr> <?php echo $stock['vendor_code']; ?>
								</address>
								<?php
								}else{
									?>
									<h1 class="m-t-0">PO ID #<?php echo $stock['po_id']; ?></h1>
									<div>Issued <?php echo date('d-M-Y',strtotime($stock['stock_date'])); ?></div>								
									<address>
										<?php echo $stock['vendor_address']; ?><br>
										<abbr title="Code">Vendor :</abbr> <?php echo $stock['vendor_code']; ?>
									</address>
								<?php	
								}?>
								
							</div>
						</div> <hr>
						<div class="table-responsive m-b-20">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Product Code</th>
										<th>Product Name</th>
										<th>Defected Quantity</th>
										<!--<th>Received Quantity</th>
										<th>Pending Quantity</th>
										<th>Status</th>-->
									</tr>
								</thead>
								<?php 
									/* echo"<pre>";
									print_r($stock);
									exit(); */									
								?>
								<tbody>
									<?php
										$po_product = $stock['product'];
											if(sizeof($po_product)>0)
											{
												for($j=0; sizeof($po_product)>$j; $j++)
												{
													?>
                                                <tr>
                                                    <td><div><strong><?php echo $po_product[$j]['product_code']; ?></strong></div>
                                                    </td>
                                                    <td><?php echo $po_product[$j]['product_name']; ?></td>  
                                                    <td><?php echo $po_product[$j]['quantity']; ?></td>  
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
						<!--<div class="row">
							<div class="col-xs-8">
								<p> <?php echo $po_info['additional_notes']; ?></p>
								<img src="assets/dist/img/credit/AM_mc_vs_ms_ae_UK.png" class="img-responsive" alt="">
							</div>
							<div class="col-xs-4">
								
							</div>
						</div>-->
					</div>
					<div class="panel-footer text-left hidden-print">
						<a href="<?php if($_SERVER['HTTP_REFERER']){ echo $_SERVER['HTTP_REFERER']; }else { echo base_url('account/defective_stock/index'); } ?>"><button type="button" class="btn btn-warning" ><< Back</button></a>
						<button type="button" class="btn btn-info" onclick="window.print()"><span class="fa fa-print"></span></button>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>