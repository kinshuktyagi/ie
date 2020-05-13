<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>View Enquiry</h1>
				<small>Enquiry Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li><a href="<?php echo base_url("account/enquiry/index"); ?>">Enquiry List</a></li>
					<li class="active">View Enquiry</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		 <div class="row">
		 <?php 
		 /* echo"<pre>";
		 print_r($info);
		 exit(); */
		 ?>
                        <div class="col-sm-12">
                            <div class="panel panel-bd">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img src="assets/dist/img/dark-logo.png" class="img-responsive" alt="">
                                            <br>
                                            <address>
                                                <strong><?php echo $info['name'];?></strong><br>
                                                <?php echo $info['address'];?><br>
												<?php echo $info['city'].', '.$info['pincode'].', '.$info['stateNAme'].', '.$info['countryName'];?><br>
                                                <abbr title="Phone">P:</abbr> <?php echo $info['phone'];?><br>
                                                <abbr title="email">Email:</abbr> <?php echo $info['email'];?></br>
												<strong>GST: </strong><?php echo $info['gst'];?></br>
												<strong>PAN: </strong><?php echo $info['pan'];?></br>
												<strong>TAN: </strong><?php echo $info['tan'];?></br>
												<strong>AADHAR: </strong><?php echo $info['aadhar'];?></br>
                                            </address>
                                            <address>
                                                <strong>Contact Person</strong><br>
												
												<div class="table-responsive m-b-20">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
													<th>Email</th>
													<th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											if(sizeof($info_cust)>0)
											{
												for($m=0; sizeof($info_cust)>$m; $m++)
												{ ?>
													<tr>
														<td><div><strong><?php echo $info_cust[$m]['name']; ?></strong></div>
														</td>
														<td><?php echo $info_cust[$m]['email']; ?></td>
														<td><?php echo $info_cust[$m]['phone']; ?></td>
													</tr>
												   <?php
												}
											}
											else
											{ ?>
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
												
												
                                            </address>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                         <h5 >Order Type: <?php 
											if($info['order_type']!='2'){
												echo "Sales";
											}else{
												echo "Job Work";
											} ?>
										</h5>
                                            <div>Order Date: <?php echo Date('d-M-Y', strtotime($info['order_date']));?></div>
                                            <!--<div class="text-danger m-b-15">Payment due April 21th, 2017</div>
                                            <address>
                                                <strong>Twitter, Inc.</strong><br>
                                                1355 Market Street, Suite 900<br>
                                                San Francisco, CA 94103<br>
                                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                            </address>-->
                                        </div>
                                    </div> 
									<h4>Enquiry Items</h4>
                                    <div class="table-responsive m-b-20">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Material Name</th>
													<th>Quantity</th>
													<th>Drawing</th>
													<th>CAD</th>
													<th>Parts Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											if(sizeof($info_items)>0)
											{
												for($j=0; sizeof($info_items)>$j; $j++)
												{
													?>
                                                <tr>
                                                    <td><div><strong><?php echo $info_items[$j]['material_name']; ?></strong></div>
                                                    </td>
                                                    <td><?php echo $info_items[$j]['quantity']; ?></td>
                                                    <td><a href="<?php echo base_url().'uploads/'. $info_items[$j]['drawing'];?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
                                                    <td><a href="<?php echo base_url().'uploads/'. $info_items[$j]['cad'];?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
                                                    <td><?php echo $info_items[$j]['description']; ?></td>
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
                                <!--<div class="panel-footer text-left">
                                    <button type="button" class="btn btn-info" onclick="myFunction()"><span class="fa fa-print"></span></button>
                                    <button type="button" class="btn btn-base"><i class="fa fa-dollar"></i> Make A Payment</button>
                                </div>-->
                            </div>
                        </div>
                    </div>
                		
	</div> 
</div>