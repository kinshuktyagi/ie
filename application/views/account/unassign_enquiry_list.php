<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="padding-top: 35px;">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>UnAssigned Enquiry</h1>
				<small>UnAssigned Enquiry List.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/enquiry/index"); ?>">Enquiry List</a></li>
					<li class="active">UnAssigned Enquiry List</li>
				</ol>
			</div>
		</div>
			<?php $this->load->view("flash"); ?>
		<div class="row">
			  <div class="col-sm-12 text-right">
				<a href="<?php echo base_url("account/enquiry/reset_unassign_filter"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5">Reset Filter</button></a>
			  </div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel lobidisable panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>UnAssigned Enquiry List</h4>
						</div>
					</div>

					<form method="POST" id="sale_frm" action="<?php echo base_url("account/enquiry/assign_enquiry_to_emp"); ?>">
					 	<div class="panel-body">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group assign_type_div">
									<label for="dept_set" class="form-control-label" id="dept_lbl">Selcet Assign Type</label><span class="red_star">*</span>
									<select  class="form-control" id="assign_type" name="assign_type" onchange="change_status('assign_type_div')">
										<option selected disabled value="">Select Type</option>
										<option value="direct">Direct to Quotation</option>
										<option value="assign">Assign Employee</option>
									</select>
									</div>
								</div>	
							</div>	
							<div class="row">
								<div id="assign_div" style="display:none">
									<div class="col-sm-3">
										<div class="form-group department_div">
											<label for="dept_set" class="form-control-label" id="dept_lbl">Department</label><span class="red_star">*</span>
											<select  class="form-control" id="dept_set" name="dept_set" onchange="change_status('department_div')">
												<option selected disabled value="">Select Department</option>
												<?php
													if(sizeof($department))
													{
														for($i=0;$i<sizeof($department);$i++)
														{ ?>
																<option value="<?php echo $department[$i]['id']; ?>">
																	<?php echo $department[$i]['department_name']; ?>
																</option>
															<?php
														}
													}
												?>
											</select>
										</div><br>
									</div>								
									<div class="col-sm-3">
										<div class="form-group employee_div">
											<label for="emp_set" class="form-control-label" id="desg_lbl">Employee</label><span class="red_star">*</span>
											<select  class="form-control" id="emp_set" name="emp_set" onchange="change_status('employee_div')">
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group turn_out_time_div">
											<label for="turn_out_time" class="form-control-label" id="turn_out_time_lbl">Turn Arround Time</label><span class="red_star">*</span>
											<input class="form-control datetimepicker2" type="text" name="turn_out_time" id="turn_out_time" placeholder="Date" onchange="change_status('turn_out_time_div')" readonly>
										</div>
									</div>
								</div>
								<input type="hidden" name="enquiry_list" id="enquiry_list" value="">
								<div class="col-sm-3" style="margin-top: 22px;">				
									<button type="submit" id="assign_sale" class="btn btn-primary w-md m-rb-5">Assign Enquery</button>
									<a href="<?php echo base_url("account/enquiry/index"); ?>"><button type="button" class="btn btn-warning w-md m-rb-5"><< Cancel</button></a>
								</div>
							</div>
						</div>
					</form>


					<form method="POST" action="<?php echo base_url("account/enquiry/unassign"); ?>">
					<div class="panel-body" style="padding:1px !important;"><br>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr class="t_head">
										<th style="min-width:51px;">
											<input type="checkbox" id="selectAll" class="sale_id" /> 
											<label for="selectAll" >All</label>
										</th>
										<th>Enquiry Code</th>
										<th style="min-width: 175px">Customer Name</th>
										<th>Order Type</th>
										<th>Email</th>
										<th>Phone</th>
										<th style="min-width: 115px">Added By</th>
										<th style="min-width: 100px">Add Date</th>
										<th>Action</th>
									</tr>
									<tr>
										<td></td>
										<td><input type="text" name="uns_compny_name" placeholder="Enquiry Code" value="<?php if(isset($_SESSION['search']['uns_compny_name'])){ echo $_SESSION['search']['uns_compny_name']; } ?>" class="form-control"/></td>
										<td><input type="text" name="uns_compny_name" placeholder="Cpmpany Name" value="<?php if(isset($_SESSION['search']['uns_compny_name'])){ echo $_SESSION['search']['uns_compny_name']; } ?>" class="form-control"/></td>
										<td>
											<select name="uns_order_type" class="testselect1">
												<option selected disabled value="">Select Order Type</option>
												<option value="1" <?php if(isset($_SESSION['search']['uns_order_type']) && $_SESSION['search']['uns_order_type']=='1'){ echo'selected'; } ?>>Sales</option>
												<option value="2" <?php if(isset($_SESSION['search']['uns_order_type']) && $_SESSION['search']['uns_order_type']=='2'){ echo'selected'; } ?>>Job Work </option>
											</select>
										</td>
										
										<td><input type="text" name="uns_email" placeholder="Email" value="<?php if(isset($_SESSION['search']['uns_email'])){ echo $_SESSION['search']['uns_email']; } ?>" class="form-control"/></td>
										<td><input type="text" name="uns_phone" placeholder="Phone" value="<?php if(isset($_SESSION['search']['uns_phone'])){ echo $_SESSION['search']['uns_phone']; } ?>" class="form-control"/></td>
										<td><input type="text" name="uns_added_by" placeholder="First Name" value="<?php if(isset($_SESSION['search']['uns_added_by'])){ echo $_SESSION['search']['uns_added_by']; } ?>" class="form-control"/></td>
										<td></td>											
										<td>											
											<button type="submit" class="btn btn-purple w-md m-rb-5" value="Search" name="search">Search</button>
										</td>
									</tr>
								</thead>
								<tbody>
									<?php
										if(sizeof($user)>0)
										{
											for($i=0;$i<sizeof($user);$i++)
											{ ?>
													<tr>
														<td><input type="checkbox" class="selectone" value="<?php echo $user[$i]['id'];?>"/></td>
														<td><?php echo $user[$i]['enquiry_code']; ?></td>
														<td><?php echo $user[$i]['name']; ?></td>
														<td><?php 
														if($user[$i]['order_type'] =='1')
														{
															echo"Sales";
														}else{
															echo "Job Work";
														}
														?></td>
														<td><?php echo $user[$i]['email']; ?></td>
														<td><?php echo $user[$i]['phone']; ?></td>
														<td><?php echo $user[$i]['first_name'].' '.$user[$i]['last_name']; ?></td>
														<td><?php
															if ( $user[$i]['add_date']!='') {
																echo date("d-M-Y",strtotime($user[$i]['add_date']));
															}?>
														</td>	
														<td>
															<select id="<?php echo $user[$i]['id']; ?>" class="action">
																<option selected disabled value="">Select Action</option>
																<!--<option value="followup">Followup View</option>-->
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
		
			$(document).ready(function(){
				$('#assign_type').on('change', function() {
					if ( this.value == 'assign')
					{
						$("#assign_div").show();
					}
					else
					{
						$("#dept_set").find('option:selected').removeAttr("selected");
						$("#emp_set").find('option:selected').removeAttr("selected");
						$("#assign_div").hide();
					}
				});
			});		
		
			$('.popoverData').popover();
			$(".action").change(function()
			{
				var id = $(this).prop("id");
				var action=$(this).val();
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

			/* // get the Team on change of departemnt..
			$(document).on("change","#dept_set",function()
			{
				var departemnt_id=$("#dept_set").val();
				if(departemnt_id)
				{
					$.ajax({url:"<?php echo base_url("account/sale/get_team_department"); ?>",method:"POST",data:{departemnt_id:departemnt_id},success:function(a)
					{
						$("#team_set")	.html(a);
					}});
				}
			}); */
			
			
			// get the employee details on change of departemnt..
			$(document).on("change","#dept_set",function()
			{
				//var team_id=$("#team_set").val();
				var departemnt_id=$("#dept_set").val();
				if(departemnt_id)
				{
					$.ajax({url:"<?php echo base_url("account/enquiry/get_department_employee"); ?>",method:"POST",data:{
						departemnt_id:departemnt_id
					},
					success:function(a)
					{
						$("#emp_set")	.html(a);
					}});
				}
			});



			function change_status(div)
			{
				$("."+div).removeClass("has-danger");
			}

			$("#sale_frm").submit(function(e)
			{
				var flag="True";		
				var assign_type=$("#assign_type").val();
				var dept_set=$("#dept_set").val();
				var emp_set=$("#emp_set").val();
				var turn_out_time=$("#turn_out_time").val();

				var checked = $('input[type="checkbox"]:checked').length > 0;
			    if (!checked)
			    {
			        alert("Please check at least one checkbox");
			        return false;
			    }
				
				if(assign_type=="" || assign_type==null)
				{
					$(".assign_type_div").addClass("has-danger");
					flag="False";
				}
				
				if(assign_type=="assign")
				{
					if(dept_set=="" || dept_set==null)
					{
						$(".department_div").addClass("has-danger");
						flag="False";
					}
					if(emp_set=="" || emp_set==null)
					{
						$(".employee_div").addClass("has-danger");
						flag="False";
					}
					if(turn_out_time=="")
					{
						$(".turn_out_time_div").addClass("has-danger");
						flag="False";
					}
				}
				
				if(flag=="False")
				{
					e.preventDefault();
					return false;
				}
				
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
	
			$('.datetimepicker2').datetimepicker({
				format:'d-m-Y',
				defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
				timepicker:false
			});
			$(function () {
				$('.datetimepicker2').datetimepicker({  minDate:new Date()});
			});
		</script>
		
		</div> 
	</div>
