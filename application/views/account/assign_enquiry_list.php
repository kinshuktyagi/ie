<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="padding-top: 35px;">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Assigned Enquiry</h1>
				<small>Assigned Enquiry List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Enquiry Master</a></li>
					<li class="active">Assigned Enquiry List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
			  	<!-- <a href="<?php echo base_url("account/sale/bulk_upload"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Bulk Upload</button></a>
				<a href="<?php echo base_url("account/sale/add_sale"); ?>"><button type="button" class="btn btn-primary w-md m-rb-5">Add Sales</button></a> -->
				<a href="<?php echo base_url("account/enquiry/reset_assigned_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			  <div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Assigned Enquiry List</h4>
						</div>
					</div>
					<form method="POST" id="enquiry_frm" action="<?php echo base_url("account/enquiry/unassign_emp_enquiry"); ?>">
					 	<div class="panel-body">
							<div class="row">								
								<input type="hidden" name="enquiry_list" id="enquiry_list" value="">
								<div class="col-sm-4">				
									<button type="submit" id="assign_sale" class="btn btn-primary w-md m-rb-5">UnAssign Enquiry</button>
									<a href="<?php echo base_url("account/enquiry/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
								</div>
							</div>
						</div>
					</form>
					<form method="POST" action="<?php echo base_url("account/enquiry/assigned"); ?>">
					<div class="panel-body" style="padding:1px !important;">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width:51px;">
											<input type="checkbox" id="selectAll" class="sale_id" /> 
											<label for="selectAll" style="cursor: pointer;">All</label>
										</th>
										<th style="min-width: 40px">Enquiry Code</th>
										<th style="min-width: 175px">Assign To</th>
										<th style="min-width: 145px">Customer Name</th>
										<th>Order Type</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width: 100px">Followup Status</th>
									</tr>
									<tr>
										<td></td>
										<td><input type="text" name="as_first_name" placeholder="Enquiry Code" value="<?php if(isset($_SESSION['search']['as_first_name'])){ echo $_SESSION['search']['as_first_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="as_first_name" placeholder="Assign to First Name" value="<?php if(isset($_SESSION['search']['as_first_name'])){ echo $_SESSION['search']['as_first_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="as_compny_name" placeholder="Cpmpany Name" value="<?php if(isset($_SESSION['search']['as_compny_name'])){ echo $_SESSION['search']['as_compny_name']; } ?>" class="form-control"/></td>
										<td>
											<select name="as_order_type" class="testselect1">
												<option selected disabled value="">Select Order Type</option>
												<option value="1" <?php if(isset($_SESSION['search']['as_order_type']) && $_SESSION['search']['as_order_type']=='1'){ echo'selected'; } ?>>Sales</option>
												<option value="2" <?php if(isset($_SESSION['search']['as_order_type']) && $_SESSION['search']['as_order_type']=='2'){ echo'selected'; } ?>>Job Work </option>
											</select>
										</td>
										<td><input type="text" name="as_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['as_email'])){ echo $_SESSION['search']['as_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="as_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['as_phone'])){ echo $_SESSION['search']['as_phone']; } ?>" class="form-control"/></td>	
										<td>											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
									</tr>
								</thead>
								<tbody>
									<?php
									/* echo"<pre>";
									print_r($user);
									exit(); */
										if(sizeof($user)>0)
										{
											for($i=0;$i<sizeof($user);$i++)
											{ ?>
													<tr>
														<td>
															<input type="checkbox" class="selectone" value="<?php echo $user[$i]['id'];?>"/>
														</td>
														<td><?php echo $user[$i]['enquiry_code'];?></td>
														<td><?php echo $user[$i]['assign_fname'].' '.$user[$i]['assign_lname'];?></td>
														<td><?php echo $user[$i]['name']; ?></td>
														
														<td>
															<?php 
															if($user[$i]['order_type'] =='1')
															{
																echo"Sales";
															}else{
																echo "Job Work";
															}
															?>
														</td>
														<td><?php echo $user[$i]['email'];?></td>
														<td><?php echo $user[$i]['phone'];?></td>														
														<td>
															<!--<a href="<?php echo base_url("account/enquiry/view?enquiry_id=").$user[$i]['id']; ?>">
																<button type="button" class="btn btn-warning pull-left btn-xs" name="add_aggrement">View</button>
															</a>-->
															<select id="<?php echo $user[$i]['id']; ?>" class="action">
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
