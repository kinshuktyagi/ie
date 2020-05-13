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
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>View Enquiry Followup</h4>
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
									
										if(sizeof($enq_flp)>0)
										{
											for($i=0;$i<sizeof($enq_flp);$i++)
											{ ?>
													<tr>
														<td><?php echo $enq_flp[$i]['action_name']; ?></td>
														<td><?php echo $enq_flp[$i]['followup_comment']; ?></td>
														<td><?php echo $enq_flp[$i]['first_name'].' '.$enq_flp[$i]['last_name'];?></td>
														
														<td><?php echo date('d-M-Y',strtotime($enq_flp[$i]['next_followup_date'])); ?></td>
														<td><?php echo  date('d-M-Y',strtotime($enq_flp[$i]['add_date'])); ?></td>
														<td>
														<?php 
															if($i==0)
															{
																if($enq_flp[$i]['followup_status']=="3")
																{
																	echo'<span class="label label-success m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
																}
																else if($enq_flp[$i]['followup_status']=="4")
																{
																	echo'<span class="label label-danger m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
																}else{
																	echo'<span class="label label-warning m-r-15">'.$enq_flp[$i]['status_name'].'</span>';
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
