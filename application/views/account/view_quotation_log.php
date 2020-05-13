<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>View Quotation</h1>
				<small>Quotation Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Quotation Master</a></li>
					<li><a href="<?php echo base_url("account/quotation/index"); ?>">Quotation List</a></li>
					<li class="active">View Quotation</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
		
                        <div class="col-sm-12">
                            <div class="panel panel-bd">
                                <div class="panel-body">
									<div class="row">
                                        <div class="col-sm-6">
											<img src="<?php echo base_url()?>public/assets/profile_pic/logo.png" class="img-responsive" alt="" style="width: 160px;">
										</div>
										<div class="col-sm-6 text-right">
											<address>
                                                <strong style="font-size: xx-large;">INDER ENTERPRISES</strong><br>
												<span>
													Unit 1: 138, Patel Marg, Ghaziabad – 201001, U.P.
													Unit 2: D-126 – 2,3,4, B.S. Road Industrial Area, Ghaziabad – 201009, U.P.
													OFF: 0120 – 2705396, Mob: +91 – 98100-35650, +91 – 98718-50159
													GST - 09AEOPS3464A1ZB
												</span>
                                                </br>
                                            </address>
										</div>	
									</div>	
									<hr>	
                                    <div class="row">
                                        <div class="col-sm-6">
                                            
                                            <br>
											<!--<span>To,</span>-->
                                            <address>
                                                <strong><?php echo $info['name'];?></strong><br>
                                                <?php echo $info['address'];?><br>
												<?php echo $info['city'].', '.$info['pincode'].', '.$info['stateName'].', '.$info['countryName'];?><br>
                                                <abbr title="Phone">P:</abbr> <?php echo $info['phone'];?><br>
                                                <abbr title="email">Email:</abbr> <?php echo $info['email'];?></br>
												<!--<strong>GST: </strong><?php echo $info['gst'];?></br>
												<strong>PAN: </strong><?php echo $info['pan'];?></br>
												<strong>TAN: </strong><?php echo $info['tan'];?></br>
												<strong>AADHAR: </strong><?php echo $info['aadhar'];?>--></br>
                                            </address>
                                    
                                    </div>
												
												
                                           
                                    </div>
                                    <!--<span>
										<h5><b>Subject:</b> <strong><u>Quotation for components</u></strong></h5></span><br><br>
										<span>Dear Sir,</span><br>
										<span>Please find below the best possible price for your inquiry:
									</span>-->
									<br><br>
                                    <div class="table-responsive ">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="t_head">
													<th>Drawing Number</th>
													<th>Part Number</th>
													<th>Field</th>
													<th>Price</th>
													<th>Percentage</th>
													<th>Total</th>
													<th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$info_items = $quotation_info['product'];
											/* echo"<pre>";
											print_r($info_items);
											exit(); */
											if(sizeof($info_items)>0)
											{
												for($j=0; sizeof($info_items)>$j; $j++)
												{
													?>
                                                <tr>
                                                    <td>
														<div>
															<strong><?php echo $info_items[$j]['drawing_number']; ?></strong>
														</div>
                                                    </td>
													<td><?php echo $info_items[$j]['part_name'];?></td>
													<td><?php echo $info_items[$j]['field_name'];?></td>
													<td><?php echo $info_items[$j]['price'];?></td>
													<td><?php echo $info_items[$j]['percentage'];?></td>
													<td><?php echo $info_items[$j]['total'];?></td>
													<td><?php echo date("d-M-Y", strtotime($quotation_log[$j]['add_date']));?></td>
                                                </tr>
                                               <?php
												}
											}?>
											
												<tr>
													<td colspan="7"><b>Log Information</b></td>
												</tr>
												<?php
												/* echo"<pre>";
												print_r($quotation_log);
												exit(); */
												$count=0;
												if(sizeof($quotation_log)>0)
												{
													for($j=0; sizeof($quotation_log)>$j; $j++)
													{
														if($quotation_log[$j]['log_count']=='0')
														{
															?>
															<tr>
																<td colspan="7"><b>Log <?php echo ($count = $count+1)?></b></td>
															</tr>
															<?php 
														}	?>
														<tr>
															<td><?php echo $quotation_log[$j]['drawing_number'];?></td>
															<td><?php echo $quotation_log[$j]['part_name'];?></td>
															<td><?php echo $quotation_log[$j]['field_name'];?></td>
															<td><?php echo $quotation_log[$j]['price'];?></td>
															<td><?php echo $quotation_log[$j]['percentage'];?></td>
															<td><?php echo $quotation_log[$j]['total'];?></td>
															<td><?php echo date("d-M-Y", strtotime($quotation_log[$j]['add_date']));?></td>
														</tr>
													<?php
													}
												}
											
										?>	
                                            </tbody>
                                        </table>
                                    </div>
									<br>
									<br>
                              </div>
                                
                            </div>
                        </div>
                    </div>
                		
	</div> 
</div>