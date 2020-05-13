<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>View Follwoup</h1>
				<small>Follwoup Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li><a href="<?php echo base_url("account/enquiry/assigned"); ?>">Assigned Enquiry</a></li>
					<li class="active">View Follwoup</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidisable">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry Details</h4>
						</div>
					</div>
					<?php 
					/* echo"<pre>";
					print_r($enq_flp);
					exit(); */
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Enquiry Code</label><br>
									<span><?php echo $enq_flp['enquiry_code']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Order Type</label><br>
									<span><?php echo $enq_flp['order_type']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Added By</label><br>
									<span><?php echo $enq_flp['added_by_f_name'].' '.$enq_flp['added_by_l_name']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Assign To</label><br>
									<span><?php echo $enq_flp['assign_to_f_name'] .' '.$enq_flp['assign_to_l_name']; ?></span>
								</div>
							</div>
							
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Turn Out Time</label><br>
									<span><?php echo date('d-M-Y', strtotime($enq_flp['turn_out_time'])); ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Delivery Date</label><br>
									<span><?php echo date('d-M-Y', strtotime($enq_flp['order_date'])); ?></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Company Name</label><br>
									<span><?php echo $enq_flp['customer_name']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Company Name</label><br>
									<span><?php echo $enq_flp['customer_name']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Followup Assign Date</label><br>
									<span><?php echo date('d-M-Y', strtotime($enq_flp['assign_date'])); ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Enquiry Followup Status</label><br>
									<span><?php echo $enq_flp['enquiry_followup_status']; ?></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group department_name_div">
									<label class="form-control-label" >Time Taken To close</label><br>
									<span>
										<?php 
											if($enq_flp['enquiry_followup_status'] == 'False')
											{
												$data = $enq_flp['followup_details'];
												for($l=0; sizeof($data)>$l; $l++)
												{
													if( $data['followup_action'] == '3'  )
													{
														$flp_closed_date = $data[$l]['add_date'];
													}
												}
											}
											
$date1 = new DateTime($enq_flp['assign_date']);
$date2 = new DateTime($flp_closed_date);
$interval = $date1->diff($date2);
/* echo"<pre>";
print_r($interval);
exit();

echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

// shows the total amount of days (not divided into years, months and days like above)
echo "difference " . $interval->days . " days "; */

											echo $interval->d." days ";
										?>
									</span>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>		
		</div>		
	
		
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd lobidisable">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry Followup</h4>
						</div>
					</div>
					
					<div class="panel-body">
						<div class="row">
							<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 145px">Followup Action</th>
										<th style="min-width: 145px">Comment</th>
										<th>Added By</th>
										<th>Next Followup Date</th>
										<th>Date</th>
										<th style="min-width: 100px">Followup Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									/* echo"<pre>";
									print_r($enq_flp);
									exit(); */
									$followup = $enq_flp['followup_details'];
									
										if(sizeof($followup)>0)
										{
											for($i=0;$i<sizeof($followup);$i++)
											{ ?>
													<tr>
														<td><?php echo $followup[$i]['action_name']; ?></td>
														<td><?php echo $followup[$i]['followup_comment']; ?></td>
														<td><?php echo $followup[$i]['first_name'].' '.$followup[$i]['last_name'];?></td>
														
														<td>
														<?php 
														if($followup[$i]['next_followup_date'] !='1970-01-01')
														{
															echo date('d-M-Y',strtotime($followup[$i]['next_followup_date'])); 
														}
														?></td>
														<td><?php echo  date('d-M-Y',strtotime($followup[$i]['add_date'])); ?></td>
														<td>
														<?php 
															if($i==0)
															{
																if($followup[$i]['followup_status']=="3")
																{
																	echo'<span class="label label-success m-r-15">'.$followup[$i]['status_name'].'</span>';
																}
																else if($followup[$i]['followup_status']=="4")
																{
																	echo'<span class="label label-danger m-r-15">'.$followup[$i]['status_name'].'</span>';
																}else{
																	echo'<span class="label label-warning m-r-15">'.$followup[$i]['status_name'].'</span>';
																} 
															}
														?>
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
						
					</div>
						</div>
					</div>
				</div>
			</div>		
		</div>		
	</div> 
</div>
