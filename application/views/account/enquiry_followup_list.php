<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="padding-top: 35px;">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Enquiry Followup</h1>
				<small>Enquiry Followup List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li class="active">Enquiry Followup List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
			  	
				<a href="<?php echo base_url("account/enquiry_followup/reset_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Enquiry Followup List</h4>
						</div>
					</div>
					<?php 
					/* echo"<pre>";
					print_r($enquiry_flp);
					exit(); */
					
					?>
					<form method="POST" action="<?php echo base_url("account/enquiry_followup/index"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width: 145px">Enquiry Code</th>
										<th style="min-width: 145px">Assign To</th>
										<th style="min-width: 145px">Customer Name</th>
										<th>Order Type</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width: 100px">Action</th>
									</tr>
									<tr>
										<td><input type="text" name="flp_first_name" placeholder="Enquiry Code" value="<?php if(isset($_SESSION['search']['flp_first_name'])){ echo $_SESSION['search']['flp_first_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="flp_first_name" placeholder="Assign to First Name" value="<?php if(isset($_SESSION['search']['flp_first_name'])){ echo $_SESSION['search']['flp_first_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="flp_compny_name" placeholder="Company Name" value="<?php if(isset($_SESSION['search']['flp_compny_name'])){ echo $_SESSION['search']['flp_compny_name']; } ?>" class="form-control"/></td>
										<td>
											<select name="flp_order_type" class="testselect1">
												<option selected disabled value="">Select Order Type</option>
												<option value="1" <?php if(isset($_SESSION['search']['flp_order_type']) && $_SESSION['search']['flp_order_type']=='1'){ echo'selected'; } ?>>Sales</option>
												<option value="2" <?php if(isset($_SESSION['search']['flp_order_type']) && $_SESSION['search']['flp_order_type']=='2'){ echo'selected'; } ?>>Job Work </option>
											</select>
										</td>
										<td><input type="text" name="flp_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['flp_email'])){ echo $_SESSION['search']['flp_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="flp_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['flp_phone'])){ echo $_SESSION['search']['flp_phone']; } ?>" class="form-control"/></td>	
										<td>											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($enquiry_flp)>0)
										{
											for($i=0;$i<sizeof($enquiry_flp);$i++)
											{ ?>
													<tr>
														
														<td><?php echo $enquiry_flp[$i]['enquiry_code'];?></td>
														<td><?php echo $enquiry_flp[$i]['first_name'].' '.$enquiry_flp[$i]['last_name'];?></td>
														<td><?php echo $enquiry_flp[$i]['name']; ?></td>
														
														<td>
															<?php 
															if($enquiry_flp[$i]['order_type'] =='1')
															{
																echo"Sales";
															}else{
																echo "Job Work";
															}
															?>
														</td>
														<td><?php echo $enquiry_flp[$i]['email'];?></td>
														<td><?php echo $enquiry_flp[$i]['phone'];?></td>
														
														<td>
														<!--<a href="<?php echo base_url("account/enquiry_followup/followup?enquiry_id=").$enquiry_flp[$i]['id'];?>"><button type="button" class="btn btn-warning w-md m-rb-5 btn-xs">Followup</button></a>-->
														<select id="<?php echo $enquiry_flp[$i]['id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																<option value="followup">Followup View</option>
																<option value="enq_view">Enquiry View</option>
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
				if(action=='followup')
				{
					document.location="<?php echo base_url("account/enquiry/view?id=") ?>"+id;
				}
				if(action=='enq_view')
				{
					document.location="<?php echo base_url("account/enquiry/view_enquiry?id=") ?>"+id;
				}			
			});

			$('#selectAll').click(function (e) {
			    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
			});

			function calculate() 
			{
			    var arr = $.map($('input:checkbox:checked'), function(e, i) 
			    {
			        return +e.value;
			    });
			    //alert(arr.join(','));
			    //$('span').text('the checked values are: ' + arr.join(','));
			    //console.log(arr.join(','));
			    $('#enquiry_list').val(arr.join(','));
			}
			calculate();
			$('div').delegate('input:checkbox', 'click', calculate);
			
						function change_status(div)
			{
				$("."+div).removeClass("has-danger");
			}

			$("#enquiry_frm").submit(function(e)
			{
				var checked = $('input[type="checkbox"]:checked').length > 0;
			    if (!checked)
			    {
			        alert("Please check at least one checkbox");
			        return false;
			    }				
			});
		</script>
		</div> 
	</div>
