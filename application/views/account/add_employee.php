<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Employee</h1>
				<small>Employee Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("administrator"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Contractual</a></li>
					<li><a href="#">Employee Master</a></li>
					<li><a href="<?php echo base_url("administrator/employee/index"); ?>">Employee List</a></li>
					<li class="active">Add Employee</li>
				</ol>
			</div>
		</div>
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Employee Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("administrator/employee/add"); ?>" enctype='multipart/form-data'>
							<div class="form-group col-sm-4 employee_id_div">
								<label for="employee_id" class="form-control-label" id="employee_id_lbl">CLIENT ID</label><span class="red_star">*</span>
								<span class="employee_status" style="font-size:11px;"></span>
								<input type="text" class="form-control" id="employee_id" name="employee_id"  placeholder="CLIENT ID" onkeyup="change_status('employee_id_div')"/>
								<input type="hidden" name="employee_status" id="employee_status" value="False"/>
								
							</div>
							<div class="form-group col-sm-4 pacific_id_div">
								<label for="pacific_id" class="form-control-label" id="pacific_id_lbl">PACIFIC ID</label>
								<input type="text" class="form-control" id="pacific_id" name="pacific_id"  placeholder="PACIFIC ID" onkeyup="change_status('pacific_id_div')"/>
								
							</div>
							
							<div class="form-group col-sm-4 employee_name_div">
								<label for="employee_name" class="form-control-label" id="employee_name_lbl">Employee Name</label><span class="red_star">*</span>
								<input type="text" class="form-control" id="employee_name" name="employee_name"  placeholder="Employee Name" onkeyup="change_status('employee_name_div')"/>
							</div>
							
							
							
							<div class="form-group col-sm-4 email_div">
								<label for="email" class="form-control-label" id="email_lbl">Email</label>
								<input type="text" class="form-control" id="email" name="email"  placeholder="Email" onkeyup="change_status('email_div')"/>
							</div>
							
							<div class="form-group col-sm-4 mobile_div">
								<label for="mobile" class="form-control-label" id="mobile_lbl">Mobile</label>
								<input type="text" class="form-control" id="mobile" name="mobile"  placeholder="Mobile" onkeyup="change_status('mobile_div')"/>
							</div>
							<div class="form-group col-sm-4 country_div">
								<label for="client" class="form-control-label" id="country_lbl">Country</label>
								<select class="form-control basic-single" id="country" name="country" onchange="change_status('country_div')">
									<option selected disabled value="">Select Country</option>
									<?php
										if(sizeof($country)>0)
										{
											for($i=0;$i<sizeof($country);$i++)
											{
												?>
													<option value="<?php echo $country[$i]['countryID']; ?>">
														<?php echo $country[$i]['countryName']; ?>
													</option>
												<?php
											}
										}
									?>
								</select>
							</div>
							
							
							<div class="form-group col-sm-4 state_div">
								<label for="state" class="form-control-label" id="state_lbl">State</label>
								<select class="form-control basic-single" id="state" name="state" onchange="change_status('state_div')">
									<option selected disabled value="">Select State</option>
									
								</select>
							</div>
							
							<div class="form-group col-sm-4 city_div">
								<label for="city" class="form-control-label" id="city_lbl">City</label>
								<input type="text" class="form-control" id="city" name="city"  placeholder="City" onkeyup="change_status('city_div')"/>
							</div>
							
							<div class="form-group col-sm-4 allowed_leave_div">
								<label for="allowed_leave" class="form-control-label" id="allowed_leave_lbl">Per month allowed leave</label><span class="red_star">*</span>
								<input type="text" class="form-control" id="allowed_leave" name="allowed_leave"  placeholder="Per month allowed leave" onkeyup="change_status('allowed_leave_div'),intfloat('allowed_leave')"/>
							</div>
							
							<div class="form-group col-sm-4 allowed_leave_div">
								<div class="col-sm-12">
									<label for="allowed_leave" class="form-control-label" id="allowed_leave_lbl">Leave carried forward</label><span class="red_star">*</span>
								</div>
								<div class="col-sm-6">
										<input type="radio" name="leave_forward"  value="Yes"/>
										<span class="text-primary">Yes</span>
									</div>
									<div class="col-sm-6">
										<input type="radio" name="leave_forward" checked value="No"/>
										<span class="text-primary">No</span>
									</div>
							</div>
							
							<div class="form-group col-sm-4 available_leave_div">
								<label for="available_leave" class="form-control-label" id="available_leave_lbl">Available Leave</label><span class="red_star">*</span>
								<input type="text" class="form-control" id="available_leave" name="available_leave"  placeholder="Available Leave" onkeyup="change_status('available_leave_div')"/>
							</div>
							
							
							<div class="form-group col-sm-4 till_date_div">
								<label for="till_date" class="form-control-label" id="till_date_lbl">Leave Till Date</label><span class="red_star">*</span>
								<input type="text" class="form-control datetimepicker2" id="till_date" name="till_date"  placeholder="Leave Till Date" onkeyup="change_status('till_date_div')"/>
							</div>
							
							<div class="form-group col-sm-4 allowed_leave_div">
								<label for="allowed_leave" class="form-control-label" id="allowed_leave_lbl">Employee Salary</label>
								<input type="text" class="form-control" id="employee_salary" name="employee_salary"  placeholder="Employee Salary" onkeyup="intfloat('employee_salary')"/>
							</div>
							
							<div class="form-group col-sm-4 allowed_leave_div">
								<div class="col-sm-12">
									<label for="allowed_leave" class="form-control-label" id="allowed_leave_lbl">Week off</label>
								</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Mon"/>
										<span class="text-primary">Monday</span>
									</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Tue"/>
										<span class="text-primary">Tuesday</span>
									</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Wed"/>
										<span class="text-primary">Wednesday</span>
									</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Thu"/>
										<span class="text-primary">Thursday</span>
									</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Fri"/>
										<span class="text-primary">Friday</span>
									</div>
									 <div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Sat"/>
										<span class="text-primary">Saturday</span>
									</div>
									<div class="col-sm-4">
										<input type="checkbox" name="week_end[]" id="week_end_sun" value="Sun"/>
										<span class="text-primary">Sunday</span>
									</div>
							</div>
							
							<div class="form-group address_div col-sm-4">
								<label for="address" class="form-control-label" id="address_lbl">Address</label>
								<textarea class=" form-control" name="address" id="address" placeholder="Address" onclick="change_status('address_div')"></textarea>
							</div>
							
							<div class="form-group col-sm-4" style="padding-top:40px;">
								<button type="submit" class="btn btn-base pull-left" value="Add Aggrement">Add Employee</button>
								<a href="<?php echo base_url("administrator/employee/index") ?>">
									<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left"><< Cancel</button>
								</a>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
<script>

	$("#employee_id").blur(function()
	{
		var employee_id=$("#employee_id").val();
		if(employee_id)
		{
			$.ajax({url:"<?php echo base_url("administrator/po/check_employee"); ?>",method:"POST",data:{employee_id:employee_id},success:function(a)
			{
				var check=a;
				if(check=='True')
				{
					$(".employee_status").text("Success");
					$("#employee_status").val("True");
					$(".employee_status").css("color","green");
				}
				else if(check=='False')
				{
					$(".employee_status").text("This employee is already exist in system you can't add please go for employee list.");
					$("#employee_status").val("False");
					$(".employee_status").css("color","red");
				}
			}});
		}
		else
		{
			$(".employee_status").text("Employee id can not be empty");
			$("#employee_status").val("False");
			$(".employee_status").css("color","red");
		}
	});
	
	$(document).on("change","#country",function()
	{
		var country=$("#country").val();
		if(country)
		{
			$.ajax({url:"<?php echo base_url("administrator/user/get_country"); ?>",method:"POST",data:{country:country},success:function(a)
			{
				$("#state").html(a);
			}});
		}
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	

	

	
	$("#frm").submit(function(e)
	{
		var flag="True";
		var employee_name=$("#employee_name").val();
		var employee_id=$("#employee_id").val();
		var employee_status=$("#employee_status").val();
		var available_leave=$("#available_leave").val();
		
	
		if(employee_id=='')
		{
			$(".employee_id_div").addClass("has-danger");
			flag="False";
		}
		if(employee_name=='')
		{
			$(".employee_name_div").addClass("has-danger");
			flag="False";
		}
		if(available_leave=='')
		{
			$(".available_leave_div").addClass("has-danger");
			flag="False";
		}
		if(employee_id!="" && employee_status=="False")
		{
			$(".employee_status").text("This employee is already exist in system you can't add please go for employee list.");
			$("#employee_status").val("False");
			$(".employee_status").css("color","red");
			flag="False";
		}
		
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});
</script>
 <script type="text/javascript">
  $(document).ready(function(){
	App.init();
	App.textEditor();
  });
  
   $('.datetimepicker2').datetimepicker({
	format:'d-m-Y',
	defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
	timepicker:false
  });
</script>