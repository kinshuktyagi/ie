<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Address</h1>
				<small>Address Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Address Master</a></li>
					<li><a href="<?php echo base_url("account/department/index"); ?>">Address List</a></li>
					<li class="active">Add Address</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Address Information</h4>
						</div>
					</div>
					<?php 
					/* echo $type;
					exit(); */
					?>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/user/address_add"); ?>">
						<span class=""><h5>Delivery Address</h5></span><hr>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group shipping_name_div">
										<label for="shipping_name" class="form-control-label" id="shipping_name_lbl">Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="shipping_name" name="shipping_name" placeholder="Shipping Name" onkeyup="change_status('shipping_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group shipping_mobile_div">
										<label for="shipping_mobile" class="form-control-label" id="shipping_mobile_lbl">Mobile</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile" placeholder="Mobile" onkeyup="change_status('shipping_mobile_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group shipping_email_div">
										<label for="shipping_email" class="form-control-label" id="shipping_email_lbl">Email</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="shipping_email" name="shipping_email" placeholder="Email" onkeyup="change_status('shipping_email_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group shipping_country_div">
										<label for="shipping_country" class="form-control-label" id="shipping_country_lbl">Country</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="shipping_country" name="shipping_country" onchange="change_status('shipping_country_div')">
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
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group shipping_state_div">
										<label for="shipping_state" class="form-control-label" id="shipping_state_lbl">State</label>
										<select class="form-control basic-single" id="shipping_state" name="shipping_state" onchange="change_status('shipping_state_div')">
											<option selected disabled value="">Select State</option>
										</select>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group shipping_city_div">
										<label for="shipping_city" class="form-control-label" id="shipping_city_lbl">City</label>
										<input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="City" onkeyup="change_status('shipping_city_div')">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group shipping_pin_code_div">
										<label for="shipping_pin_code" class="form-control-label" id="shipping_pin_code_lbl">Pin Code</label>
										<input type="text" class="form-control" id="shipping_pin_code" name="shipping_pin_code" placeholder="Pin Code" onkeyup="change_status('shipping_pin_code_div')">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group shipping_address_div">
										<label for="shipping_address" class="form-control-label" id="shipping_address_lbl"> Address
										<textarea rows="2" cols="50" type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Address" onkeyup="change_status('shipping_address_div')"/></textarea>
									</div>
								</div>
							</div>							
							<div class="row"> 
								<div class="form-group checkbox checkbox-success checkbox-inline col-sm-4">
									<input type="checkbox" id="inlineCheckbox2" name="email_send" value="2"/>
									<label for="inlineCheckbox2">If same Billing Address select this box.</label>
								</div>								 
							</div>
							
							
							
							<span class=""><h5>Billing Address</h5></span><hr>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group billing_name_div">
										<label for="billing_name" class="form-control-label" id="billing_name_lbl">Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Name" onkeyup="change_status('billing_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group billing_mobile_div">
										<label for="billing_mobile" class="form-control-label" id="billing_mobile_lbl">Mobile</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="billing_mobile" name="billing_mobile" placeholder="Mobile" onkeyup="change_status('billing_mobile_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group billing_email_div">
										<label for="billing_email" class="form-control-label" id="billing_email_lbl">Email</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="billing_email" name="billing_email"  placeholder="Email" onkeyup="change_status('billing_email_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group billing_country_div">
										<label for="billing_country" class="form-control-label" id="billing_country_lbl">Country</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="billing_country" name="billing_country" onchange="change_status('billing_country_div')"/>
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
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label for="billing_state" class="form-control-label" id="state_lbl">State</label>
										<select class="form-control basic-single" id="billing_state" name="billing_state">
											<option selected disabled value="">Select State</option>
										</select>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group">
										<label for="billing_city" class="form-control-label" id="billing_city_lbl">City</label>
										<input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="billing_pin_code" class="form-control-label" id="billing_pin_code_lbl">Pin Code</label>
										<input type="text" class="form-control" id="billing_pin_code" name="billing_pin_code" placeholder="Pin Code">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group billing_address_div">
										<label for="billing_address" class="form-control-label" id="billing_description_lbl"> Address
										<textarea rows="2" cols="50" type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Address" onkeyup="change_status('billing_address_div')"></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" name="user_id" value="<?php echo $usr ?>"/>
							<input type="hidden" name="user_type" value="<?php echo $type ?>"/>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Address</button>
										<a href="<?php echo base_url("account/user/index") ?>">
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
	
	$(document).on("change","#shipping_country",function()
	{
		var country=$("#shipping_country").val();
		if(country)
		{
			$.ajax({url:"<?php echo base_url("account/user/get_country"); ?>",method:"POST",data:{country:country},success:function(a)
			{
				$("#shipping_state")	.html(a);
			}});
		}
	});
	
	$(document).on("change","#billing_country",function()
	{
		var country=$("#billing_country").val();
		if(country)
		{
			$.ajax({url:"<?php echo base_url("account/user/get_country"); ?>",method:"POST",data:{country:country},success:function(a)
			{
				$("#billing_state")	.html(a);
			}});
		}
	});
	
	$("#inlineCheckbox2").change(function()
	{
		var shipping_name = $("#shipping_name").val();
		var shipping_mobile = $("#shipping_mobile").val();
		var shipping_email = $("#shipping_email").val();
		var shipping_country = $("#shipping_country").val();
		var shipping_state = $("#shipping_state").val();
		var shipping_city = $("#shipping_city").val();
		var shipping_pin_code = $("#shipping_pin_code").val();
		var shipping_address = $("#shipping_address").val();
		
		if($(this).is(":checked"))
		{
			$("#billing_name").val(shipping_name);
			$("#billing_mobile").val(shipping_mobile);
			$("#billing_email").val(shipping_email);
			$('#billing_country').val(shipping_country).prop('selected', true);
			//$("#billing_country").val(shipping_country);
			$("#billing_state").val(shipping_state);
			$("#billing_city").val(shipping_city);
			$("#billing_pin_code").val(shipping_pin_code);
			$("textarea[name='billing_address']").val(shipping_address);
		}else{
			$("#billing_name").val('');
			$("#billing_mobile").val('');
			$("#billing_email").val('');
			$('#billing_country').val(shipping_country).prop('selected', true);
			//$("#billing_country").val(shipping_country);
			$("#billing_state").val('');
			$("#billing_city").val('');
			$("#billing_pin_code").val('');
			$("textarea[name='billing_address']").val('');
		}
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	$("#frm").submit(function(e)
	{
		var flag="True";
		var shipping_name = $("#shipping_name").val();
		var shipping_mobile = $("#shipping_mobile").val();
		var shipping_email = $("#shipping_email").val();
		var shipping_country = $("#shipping_country").val();
		var shipping_state = $("#shipping_state").val();
		var shipping_city = $("#shipping_city").val();
		var shipping_pin_code = $("#shipping_pin_code").val();
		var shipping_address = $("#shipping_address").val();
		
		var billing_name = $("#billing_name").val();
		var billing_mobile = $("#billing_mobile").val();
		var billing_email = $("#billing_email").val();
		var billing_country = $("#billing_country").val();
		var billing_state = $("#billing_state").val();
		var billing_city = $("#billing_city").val();
		var billing_pin_code = $("#billing_pin_code").val();
		var billing_address = $("#billing_address").val();
		
		if(shipping_name=="")
		{
			$(".shipping_name_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_mobile=="")
		{
			$(".shipping_mobile_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_email=="")
		{
			$(".shipping_email_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_country=="" || shipping_country == null)
		{
			$(".shipping_country_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_state=="" || shipping_state==null)
		{
			$(".shipping_state_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_city=="")
		{
			$(".shipping_city_div").addClass("has-danger");
			flag="False";
		}
		if(shipping_pin_code=="")
		{
			$(".shipping_pin_code_div").addClass("has-danger");
			flag="False";
		}

		if(billing_name=="")
		{
			$(".billing_name_div").addClass("has-danger");
			flag="False";
		}
		if(billing_mobile=="")
		{
			$(".billing_mobile_div").addClass("has-danger");
			flag="False";
		}
		if(billing_email=="")
		{
			$(".billing_email_div").addClass("has-danger");
			flag="False";
		}
		if(billing_country=="" || shipping_country == null)
		{
			$(".billing_country_div").addClass("has-danger");
			flag="False";
		}
		if(billing_state=="" || shipping_state==null)
		{
			$(".billing_state_div").addClass("has-danger");
			flag="False";
		}
		if(billing_city=="")
		{
			$(".billing_city_div").addClass("has-danger");
			flag="False";
		}
		if(billing_pin_code=="")
		{
			$(".billing_pin_code_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>