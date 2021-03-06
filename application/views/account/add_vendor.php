<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Vendor</h1>
				<small>Vendor Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Vendor Master</a></li>
					<li><a href="<?php echo base_url("account/vendor/index"); ?>">Vendor List</a></li>
					<li class="active">Add Vendor</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Vendor Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/vendor/add"); ?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group vendor_name_div">
										<label for="vendor_name" class="form-control-label" id="vendor_name_lbl">Vendor Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Vendor Name" onkeyup="change_status('vendor_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_email_div">
										<label for="department_name" class="form-control-label" id="vendor_email_lbl">Email</label>
										<input type="text" class="form-control" id="vendor_email" name="vendor_email"  placeholder="Email" onkeyup="change_status('vendor_email_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_phone_div">
										<label for="vendor_phone" class="form-control-label" id="vendor_phone_lbl">Phone</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="vendor_phone" name="vendor_phone" placeholder="Phone" onkeyup="change_status('vendor_phone_div'), integer('vendor_phone')" />
										<input type="hidden" id="mobile_status" value="False"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_alt_phone_div">
										<label for="vendor_alt_phone" class="form-control-label" id="vendor_alt_phone_lbl">Alternate Phone</label>
										<input type="text" class="form-control" id="vendor_alt_phone" name="vendor_alt_phone"  placeholder="Alternate Phone" onkeyup="change_status('vendor_alt_phone_div'), integer('vendor_alt_phone')"/>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group vendor_gst_div">
										<label for="vendor_gst" class="form-control-label" id="vendor_gst_lbl">GST</label>
										<input type="text" class="form-control" id="vendor_gst" name="vendor_gst"  placeholder="GST" onkeyup="change_status('vendor_gst_div')"/>
										<input type="file" class="form-control" id="gst_file" name="gst_file"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_pan_div">
										<label for="vendor_pan" class="form-control-label" id="vendor_pan_lbl">PAN</label>
										<input type="text" class="form-control" id="vendor_pan" name="vendor_pan"  placeholder="PAN" onkeyup="change_status('vendor_pan_div')"/>
										<input type="file" class="form-control" id="pan_file" name="pan_file"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_tan_div">
										<label for="vendor_tan" class="form-control-label" id="vendor_tan_lbl">TAN</label>
										<input type="text" class="form-control" id="vendor_tan" name="vendor_tan"  placeholder="TAN" onkeyup="change_status('vendor_tan_div')"/>
										<input type="file" class="form-control" id="tan_file" name="tan_file"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_ciib_div">
										<label for="vendor_ciib" class="form-control-label" id="vendor_ciib_lbl">Aadhar</label>
										<input type="text" class="form-control" id="vendor_ciib" name="vendor_ciib" placeholder="Aadhar" onkeyup="change_status('vendor_ciib_div')"/>
										<input type="file" class="form-control" id="aadhar_file" name="aadhar_file"/>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group registered_address_div">
										<label for="registered_address" class="form-control-label" id="registered_address_lbl">Company Registered Address</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="registered_address" name="registered_address" placeholder="Registered Address" onkeyup="change_status('registered_address_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group company_address_div">
										<label for="company_address" class="form-control-label" id="company_address_lbl">Company Address</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" onkeyup="change_status('company_address_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group bussiness_address_div">
										<label for="bussiness_address" class="form-control-label" id="vendor_tan_lbl">Company Bussiness Address</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="bussiness_address" name="bussiness_address"  placeholder="Bussiness Address" onkeyup="change_status('bussiness_address_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group vendor_ciib_div">
										<label for="vendor_ciib" class="form-control-label" id="vendor_ciib_lbl">Date Of Stablished</label>
										<input type="text" class="form-control datetimepicker2" id="stablished_date" name="stablished_date" placeholder="Date Of Stablished" readonly />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3">
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
															<option value="<?php echo $country[$i]['countryID']; ?>"><?php echo $country[$i]['countryName']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group state_div">
										<label for="state" class="form-control-label" id="state_lbl">State</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="state" name="state" onchange="change_status('state_div')" />
											<option selected disabled value="">Select State</option>
											
										</select>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group city_div">
										<label for="city" class="form-control-label" id="city_lbl">City</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="city" name="city" placeholder="City" onkeyup="change_status('city_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group pin_code_div">
										<label for="city" class="form-control-label" id="pin_code_lbl">Pin Code</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="pin_code" name="pin_code" placeholder="Pin Code" onkeyup="change_status('pin_code_div'), integer('pin_code')" min="1" max="6"/>
									</div>
								</div>
							</div>							
							
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group bank_name_div">
										<label for="bank_name" class="form-control-label" id="bank_name_lbl">Bank Name</label>
										<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" onkeyup="change_status('bank_name_div')"/>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group account_number_div">
										<label for="account_number" class="form-control-label" id="account_number_lbl">Account Number</label>
										<input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" onkeyup="change_status('account_number_div')"/>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group ifsc_code_div">
										<label for="ifsc_code" class="form-control-label" id="ifsc_code_lbl">IFSC Code</label>
										<input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" onkeyup="change_status('ifsc_code_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group bank_address_div">
										<label for="bank_address" class="form-control-label" id="bank_addresslbl">Bank Address</label>
										<input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="Bank Address" onkeyup="change_status('bank_address_div')"/>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group website_name_div">
										<label for="website_name" class="form-control-label" id="bank_name_lbl">Website</label>
										<input type="text" class="form-control" id="website_name" name="website_name" placeholder="Website" onkeyup="change_status('website_name_div')"/>
									</div>
								</div>
							</div>
							
							<h4>Contact Person Details</h4>
						
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<label for="bank_address" class="form-control-label" id="contact_person_name_lbl">Contact Person Name</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email_div">
										<label for="bank_address" class="form-control-label" id="contact_person_email_lbl">Contact Person Email</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<label for="contact_person_phone" class="form-control-label" id="contact_person_phone_lbl">Contact Person Phone</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_alt_phone_div">
										<label for="contact_person_alt_phone" class="form-control-label" id="contact_person_alt_phone_lbl">Contact Person Alternate Number</label>
									</div>
								</div>
							</div>
							
						
							<?php 
							for($r=0; 5>$r; $r++)
							{
								?>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group contact_person_name_div">
											<input type="text" class="form-control" id="contact_person_name<?php echo $r; ?>" name="contact_person_name[]" placeholder="Contact Person Name" onkeyup="change_status('contact_person_name_div')"/>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group contact_person_email_div">
											<input type="email" class="form-control" id="contact_person_email<?php echo $r; ?>" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group contact_person_name_div">
											<input type="text" class="form-control" id="contact_person_phone<?php echo $r; ?>" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div'), integer('contact_person_phone<?php echo $r; ?>')"/>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group contact_person_alt_phone_div">
											<input type="text" class="form-control" id="contact_person_alt_phone<?php echo $r; ?>" name="contact_person_alt_phone[]" placeholder="Alternate Phone" onkeyup="change_status('contact_person_alt_phone_div'), integer('contact_person_alt_phone<?php echo $r; ?>')"/>
										</div>
									</div>
								</div>
								<?php
							}?>
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Vendor</button>
										<a href="<?php echo base_url("account/department/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>		
		</div>		
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
		var vendor_name = $("#vendor_name").val();
		var vendor_phone = $("#vendor_phone").val();
		var mobile_status=$("#mobile_status").val();
		var registered_address = $("#registered_address").val();
		var company_address = $("#company_address").val();
		var bussiness_address = $("#bussiness_address").val();
		var country = $("#country").val();
		var state = $("#state").val();
		var city = $("#city").val();
		var pin_code = $("#pin_code").val();
				
		if(vendor_name==""){			
			$(".vendor_name_div").addClass("has-danger");
			flag="False";
		}
		if(vendor_phone==""){			
			$(".vendor_phone_div").addClass("has-danger");
			flag="False";
		}
		if(registered_address==""){			
			$(".registered_address_div").addClass("has-danger");
			flag="False";
		}
		if(company_address==""){			
			$(".company_address_div").addClass("has-danger");
			flag="False";
		}
		if(bussiness_address==""){			
			$(".bussiness_address_div").addClass("has-danger");
			flag="False";
		}
		if(country=="" || country == null){			
			$(".country_div").addClass("has-danger");
			flag="False";
		}
		if(state=="" || state ==null){			
			$(".state_div").addClass("has-danger");
			flag="False";
		}
		if(city==""){			
			$(".city_div").addClass("has-danger");
			flag="False";
		}
		if(pin_code==""){			
			$(".pin_code_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});
	
	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
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

</script>