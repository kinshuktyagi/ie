<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>My Profile</h1>
				<small>Manage Personal Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("administrator"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li class="active">Manage Profile</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<?php $this->load->view("flash"); ?>
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Personal Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/index/update_info"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group first_name_div">
										<label for="first_name" class="form-control-label" id="first_name_lbl">First Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $info['first_name']; ?>" placeholder="First Name" onkeyup="change_status('first_name_div')"/>
										<input type="hidden" name="user_id" value="<?php echo $info['id']; ?>"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group last_name_div">
										<label for="last_name" class="form-control-label" id="last_name_lbl">Last Name</label>
										<input type="text" class="form-control" id="last_name"  name="last_name" value="<?php echo $info['last_name']; ?>" placeholder="Last Name" onkeyup="change_status('last_name_div')"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group email_div">
										<label for="email" class="form-control-label" id="email_lbl">Email</label><span class="red_star">*</span>
										<input type="email" class="form-control" name="email" id="email" value="<?php echo $info['email']; ?>"  placeholder="Email" onkeyup="change_status('email_div')"/>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group mobile_div">
										<label for="mobile" class="form-control-label" id="mobile_lbl">Mobile</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="mobile" maxlength="10" name="mobile" value="<?php echo $info['mobile']; ?>" placeholder="Mobile" onkeyup="change_status('mobile_div'),integer('mobile')"/>
										<input type="hidden" id="mobile_status" value="True"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group gst_div">
										<label for="gst" class="form-control-label" id="gst_lbl">GSTIN</label>
										<input type="text" class="form-control" id="gst" name="gst" value="<?php echo $info['gst']; ?>" placeholder="GSTIN" onkeyup="change_status('gst_div')"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group pan_div">
										<label for="pan" class="form-control-label" id="pan_lbl">PAN</label>
										<input type="text" class="form-control" id="pan" name="pan" value="<?php echo $info['pan']; ?>" placeholder="PAN" onkeyup="change_status('pan_div')"/>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group bank_name_div">
										<label for="bank_name" class="form-control-label" id="bank_name_lbl">Bank Name</label>
										<input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $info['bank_name']; ?>" placeholder="Bank Name" onkeyup="change_status('bank_name_div')"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group bank_account_name_div">
										<label for="bank_account_name" class="form-control-label" id="bank_account_name_lbl">Bank Account Name</label>
										<input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="<?php echo $info['bank_account_name']; ?>" placeholder="Bank Account Name" onkeyup="change_status('bank_account_name_div')"/>
									</div>
								</div>
								
								
								<div class="col-sm-4">
									<div class="form-group bank_address_div">
										<label for="bank_address" class="form-control-label" id="bank_address_lbl">Bank Address</label>
										<input type="text" class="form-control" id="bank_address" name="bank_address" value="<?php echo $info['bank_address']; ?>" placeholder="Bank Address" onkeyup="change_status('bank_address_div')"/>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group bank_account_number_div">
										<label for="bank_account_number" class="form-control-label" id="bank_account_number_lbl">Bank Account Number</label>
										<input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="<?php echo $info['bank_account_number']; ?>" placeholder="Bank Account Number" onkeyup="change_status('bank_account_number_div')"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group ifsc_code_div">
										<label for="ifsc_code" class="form-control-label" id="ifsc_code_lbl">RTGS/NEFT/IFSC Code</label>
										<input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="<?php echo $info['ifsc_code']; ?>" placeholder="RTGS/NEFT/IFSC Code" onkeyup="change_status('ifsc_code_div')"/>
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
							</div>
							
							
							<div class="row">
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
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="city" class="form-control-label" id="city_lbl">City</label>
										<input type="text" class="form-control" id="city" name="city" value="<?php echo $info['city']; ?>" placeholder="City">
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="pin_code" class="form-control-label" id="pin_code_lbl">Pin Code</label>
										<input type="text" class="form-control" id="pin_code" name="pin_code" value="<?php echo $info['pin_code']; ?>" placeholder="Pin Code" onkeyup="integer('pin_code')">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="address" class="form-control-label" id="address_lbl">Address</label>
										<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $info['address']; ?>"/>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="business_name" class="form-control-label" id="business_name_lbl">Business Name</label>
										<input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name" value="<?php echo $info['business_name']; ?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group" style="padding-top:24px;">
										<button type="submit" class="btn btn-base pull-left">Update Profile</button>
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
		var user_status=$("#user_status").val();
		var first_name=$("#first_name").val();
		var last_name=$("#last_name").val();
		var email=$("#email").val();
		var mobile=$("#mobile").val();
		var mobile_status=$("#mobile_status").val();
		var country=$("#country").val();
		
		if(user_status=="False")
		{
			$(".user_name_div").addClass("has-danger");
			flag="False";
		}
		if(first_name=="")
		{
			$(".first_name_div").addClass("has-danger");
			flag="False";
		}
	
		if(email=="")
		{
			$(".email_div").addClass("has-danger");
			flag="False";
		}
		if(mobile=="" || mobile_status=="False")
		{
			$(".mobile_div").addClass("has-danger");
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
		var old_mobile="<?php echo $info['mobile']; ?>";
		if(old_mobile==mobile)
		{
			$("#mobile_status").val('True');
			$(".mobile_div").removeClass("has-danger");
			$(".mobile_div").removeClass("has-success");
		}
		else if(old_mobile!=mobile)
		{
			if(mobile)
			{
				
				$.ajax({url:"<?php echo base_url("account/index/check_username"); ?>",method:"POST",data:{mobile:mobile},success:function(a)
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
		}
		
	});
	
	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});
</script>