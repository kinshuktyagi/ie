<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Employee</h1>
				<small>Employee Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Employee Master</a></li>
					<li><a href="<?php echo base_url("account/user/index"); ?>">Employee List</a></li>
					<li class="active">Manage Employee</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<?php 
		/* echo"<pre>";
		print_r($info);
		exit(); */
		?>
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Employee Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/user/update_user"); ?>">
							<!--<div class="row">
								<div class="col-sm-4">
									<div class="form-group user_type_div">
										<label for="user_type" class="form-control-label" id="user_name_lbl">User Type</label><span class="red_star">*</span>
										<select class="form-control" id="user_type" name="user_type" onchange="change_status('user_type_div')">
											<option selected disabled value="">Select User Type</option>
											<?php
												if(sizeof($user_type))
												{
													for($i=0;$i<sizeof($user_type);$i++)
													{
														?>
															<option value="<?php echo $user_type[$i]['id']; ?>" <?php if($info['user_type']==$user_type[$i]['id']){ echo'selected'; } ?>>
																<?php echo $user_type[$i]['user_type']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
										
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group user_type_div">
										<label for="user_type" class="form-control-label" id="user_name_lbl">Department</label><span class="red_star">*</span>
										<select class="form-control" id="department" name="department" onchange="change_status('department_div')">
											<option selected disabled value="">Select Department</option>
											<?php
												if(sizeof($department))
												{
													for($i=0;$i<sizeof($department);$i++)
													{
														?>
															<option value="<?php echo $department[$i]['id']; ?>" <?php echo ($department[$i]['id'] == $info['department']) ? 'selected' : '' ?> ><?php echo $department[$i]['department_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group designation_div">
										<label for="user_type" class="form-control-label" id="user_name_lbl">Designation</label><span class="red_star">*</span>
										<select class="form-control" id="designation" name="designation" onchange="change_status('designation_div')">
											<option selected disabled value="">Select Designation</option>
											<?php
												if(sizeof($designation))
												{
													for($i=0;$i<sizeof($designation);$i++)
													{
														?>
															<option value="<?php echo $designation[$i]['id']; ?>" <?php echo ($designation[$i]['id'] == $info['designation']) ? 'selected' : '' ?> ><?php echo $designation[$i]['designation_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								
								
							</div>
							-->
							<div class="row">	
								<div class="col-sm-4">
									<div class="form-group first_name_div">
										<label for="first_name" class="form-control-label" id="first_name_lbl">First Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="first_name" name="first_name"  placeholder="First Name" onkeyup="change_status('first_name_div')" value="<?php echo $info['first_name']; ?>"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group last_name_div">
										<label for="last_name" class="form-control-label" id="last_name_lbl">Last Name</label>
										<input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name" onkeyup="change_status('last_name_div')" value="<?php echo $info['last_name']; ?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group mobile_div">
										<label for="mobile" class="form-control-label" id="mobile_lbl">Mobile</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" onkeyup="change_status('mobile_div'),integer('mobile')" value="<?php echo $info['mobile']; ?>"/>
										<input type="hidden"  id="mobile_status" value="True"/>
									</div>
								</div>								
								
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group email_div">
										<label for="email" class="form-control-label" id="email_lbl">Email</label>
										<input type="email" class="form-control" name="email" id="email"  placeholder="Email" onkeyup="change_status('email_div')"  value="<?php echo $info['email']; ?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group country_div">
										<label for="country" class="form-control-label" id="country_lbl">Country</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="country" name="country" onchange="change_status('country_div')"/>
											<option selected disabled value="">Select Country</option>
											<?php
												if(sizeof($country))
												{
													for($i=0;$i<sizeof($country);$i++)
													{
														?>
															<option value="<?php echo $country[$i]['countryID']; ?>" <?php if($info['country']==$country[$i]['countryID']){ echo'selected'; } ?>>
																<?php echo $country[$i]['countryName']; ?>
															</option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="state" class="form-control-label" id="state_lbl">State</label>
										<select class="form-control basic-single" id="state" name="state">
											<option selected disabled value="">Select State</option>
											<?php
												if(sizeof($state_list)>0)
												{
													for($i=0;$i<sizeof($state_list);$i++)
													{
														?>
															<option value="<?php echo $state_list[$i]['stateID']; ?>" <?php if($info['state']==$state_list[$i]['stateID']){ echo'selected'; } ?>>
																<?php echo $state_list[$i]['stateName']; ?>
															</option>
														<?php
													}
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row">
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="city" class="form-control-label" id="city_lbl">City</label>
										<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $info['city']; ?>"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="join_date" class="form-control-label" id="join_date_lbl">Join Date</label>
										<input type="text" class="form-control datetimepicker2" id="join_date" name="join_date" placeholder="Join Date"  value="<?php if($info['join_date']){ echo date("d-m-Y",strtotime($info['join_date'])); } ?>" readonly>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="address" class="form-control-label" id="address_lbl">Address</label>
										<input type="text" class="form-control" id="address" name="address" placeholder="Address"  value="<?php echo $info['address']; ?>"/>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-sm-4">
									<div class="form-group">
										<label for="pincode" class="form-control-label" id="pincode_lbl">Pin Code</label>
										<input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code"  value="<?php echo $info['pin_code']; ?>"/>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $info['id']; ?>"/>
								<div class="col-sm-4" style="padding-top:23px;">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update User</button>
										<a href="<?php echo base_url("account/user/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		
		</div>
		</form>
		</div> 
</div>
<script>
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	$("#frm").submit(function(e)
	{
		var flag="True";
		var user_type=$("#user_type").val();
		var first_name=$("#first_name").val();
		var last_name=$("#last_name").val();
		var mobile=$("#mobile").val();
		var mobile_status=$("#mobile_status").val();
		var country=$("#country").val();
		var password=$("#password").val();
		
		/* if(user_type=="" || user_type==null)
		{
			$(".user_type_div").addClass("has-danger");
			flag="False";
		} */

		if(first_name=="")
		{
			$(".first_name_div").addClass("has-danger");
			flag="False";
		}
	

		if(mobile=="" || mobile_status=="False")
		{
			$(".mobile_div").addClass("has-danger");
			flag="False";
		}
		if(password=="")
		{
			$(".password_div").addClass("has-danger");
			flag="False";
		}
		if(country=="" || country==null)
		{
			$(".country_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});

	
	$(document).on("change","#country",function()
	{
		var country=$("#country").val();
		if(country)
		{
			$.ajax({url:"<?php echo base_url("account/user/get_country"); ?>",method:"POST",data:{country:country},success:function(a)
			{
				$("#state")	.html(a);
			}});
		}
	});
	
	
	
	
	
	$(document).on("blur","#mobile",function()
	{
		var mobile=$("#mobile").val();
		if(mobile)
		{
			$.ajax({url:"<?php echo base_url("account/user/check_username"); ?>",method:"POST",data:{mobile:mobile},success:function(a)
			{
				var check=a;
				if(check=="True")
				{
					$(".mobile_div").removeClass("has-danger");
					$(".mobile_div").addClass("has-success");
					$("#mobile_status").val('True');
				}
				else if(check=="False")
				{
					$(".mobile_div").removeClass("has-success");
					$(".mobile_div").addClass("has-danger");
					$("#mobile_status").val('False');
				}
			}});
		}
	});
	
	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});
</script>