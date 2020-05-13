<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>View PO</h1>
				<small>PO Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/po/index"); ?>">PO List</a></li>
					<li class="active">View PO</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		 <div class="row">
		
                        <div class="col-sm-12">
                            <div class="panel panel-bd">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img src="assets/dist/img/dark-logo.png" class="img-responsive" alt="">
                                            <br>
                                            <address>
                                                <strong><?php echo $po['first_name'].' '.$po['last_name'];?></strong><br>
												<?php echo $po['vendor_phone'];?><br>
												<?php echo $po['vendor_email'];?><br>
												<?php echo $po['vendor_address'];?><br>
												<?php echo $po['countryName'];?><br>
												<?php echo $po['stateName'];?><br>
												<?php echo $po['vendor_city'].' '.$po['vendor_pincode'];?><br>
												</address>
                                        </div>
                                        <div class="col-sm-6 text-right">
											<h1 class="m-t-0">PO ID #<?php echo $po['poid']; ?></h1>
                                            <div>Issued Date: <?php echo Date('d-M-Y', strtotime($po['add_date']));?></div>
											<abbr title="Code">Vendor Code:</abbr> <?php echo $po['vendor_code'];?><br>
                                        </div>
                                    </div>
									<br>
									<hr>
                                    <div class="table-responsive m-b-20">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
													<th>Quantity</th>
													<th>Received Quantity</th>
													<th>Pending Quantity</th>
													<th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$po_product = $po['product'];
											if(sizeof($po_product)>0)
											{
												for($j=0; sizeof($po_product)>$j; $j++)
												{
													?>
                                                <tr>
                                                    <td><div><strong><?php echo $po_product[$j]['product_code']; ?></strong></div>
                                                    </td>
                                                    <td><?php echo $po_product[$j]['quantity']; ?></td>    
                                                    <td><?php echo $po_product[$j]['received_quantity']; ?></td>    
                                                    <td><?php echo ($po_product[$j]['quantity'] - $po_product[$j]['received_quantity']) ; ?></td>    
                                                    <td><?php echo $po_product[$j]['received_status']; ?></td>    
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
                                    
                                </div>
                                <div class="panel-footer text-left">
                                    <button type="button" class="btn btn-info" onclick="window.print()"><span class="fa fa-print"></span></button>
                                   
									<a href="<?php echo base_url("account/po/index"); ?>"><button type="button" class="btn btn-warning">&lt;&lt; Back</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                		
	</div> 
</div>