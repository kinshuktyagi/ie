<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Customer</h1>
				<small>Customer Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Customer Master</a></li>
					<li><a href="<?php echo base_url("account/customer/index"); ?>">Customer List</a></li>
					<li class="active">Manage Customer</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title"> 
							<h4>Customer Information</h4>
						</div>
					</div>
					
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/customer/update_customer"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group industry_type_div">
										<label for="industry_type" class="form-control-label" id="industry_type_lbl">Industry Type</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="industry_type" name="industry_type" onchange="change_status('industry_type_div')"/>
											<option selected disabled value="">Select Industry</option>
											<?php
												if(sizeof($industry))
												{
													for($i=0;$i<sizeof($industry);$i++)
													{
														?>
															<option value="<?php echo $industry[$i]['id']; ?>"<?php echo $industry[$i]['id']==$info['industry_type']?'selected':'';?>><?php echo $industry[$i]['industry_name']; ?></option>
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
									<div class="form-group name_div">
										<label for="name" class="form-control-label" id="first_name_lbl">Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="name" name="name" placeholder="Name" onkeyup="change_status('name_div')" value="<?php echo $info['name'];?>"/>
									</div>
								</div>
								
								<!--<div class="col-sm-4">
									<div class="form-group last_name_div">
										<label for="last_name" class="form-control-label" id="last_name_lbl">Last Name</label>
										<input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name" onkeyup="change_status('last_name_div')"/>
									</div>
								</div>-->
								<div class="col-sm-3">
									<div class="form-group mobile_div">
										<label for="mobile" class="form-control-label" id="mobile_lbl">Mobile</label><span class="red_star">*</span>
										<input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo $info['phone'];?>" readonly />
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group email_div">
										<label for="email" class="form-control-label" id="email_lbl">Email</label>
										<input type="email" class="form-control" name="email" id="email"  placeholder="Email" onkeyup="change_status('email_div')" value="<?php echo $info['email'];?>"/>
									</div>
								</div>
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
								<div class="col-sm-3">
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
								
								<div class="col-sm-3">
									<div class="form-group">
										<label for="city" class="form-control-label" id="city_lbl">City</label>
										<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $info['city'];?>">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="pincode" class="form-control-label" id="pincode_lbl">Pin Code</label>
										<input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code" value="<?php echo $info['pincode'];?>">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="address" class="form-control-label" id="address_lbl">Address</label>
										<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $info['address'];?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label for="gst" class="form-control-label" id="gst_lbl">GST</label>
										<input type="text" class="form-control" id="gst" name="gst" placeholder="GST" value="<?php echo $info['gst'];?>"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="pan" class="form-control-label" id="pincode_lbl">PAN</label>
										<input type="text" class="form-control" id="pan" name="pan" placeholder="PAN" value="<?php echo $info['pan'];?>">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="aadhar" class="form-control-label" id="aadhar_lbl">Aadhar</label>
										<input type="text" class="form-control" id="aadhar" name="aadhar" placeholder="Aadhar" value="<?php echo $info['aadhar'];?>">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="tan" class="form-control-label" id="tan_lbl">TAN</label>
										<input type="text" class="form-control" id="tan" name="tan" placeholder="TAN" value="<?php echo $info['tan'];?>">
									</div>
								</div>								
							</div>
							<h4>Contact Person Details.</h4><hr>
							
							
							
							
						<div class="panel-body" style="padding:1px !important;">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr class="t_head">
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Action</th>						
										</tr>
									</thead>
									<tbody id="data_iteams">
										<?php											
											if(sizeof($contact)>0)
											{
												for($j=0; sizeof($contact)>$j; $j++)
												{
													?>
													<tr>
														<td>
														<input class="form-control name_child" type="text" name="qty" id="qty" value="<?php echo $contact[$j]['name']; ?>">
														</td>
														<td><input class="form-control email_child" type="text" name="qty" id="qty" value="<?php echo $contact[$j]['email']; ?>"></td>
														<td><input class="form-control phone_child" type="number" name="qty" id="qty" value="<?php echo $contact[$j]['phone']; ?>"></td>
														<td>
														<input type="hidden" class="child_cust_id" name="cust_id" value="<?php echo $contact[$j]['cust_id']?>">
															<button type="button" id="<?php echo $contact[$j]['id'] ?>" class="btn btn-danger btn-sm m-rb-5 delete" value="D"><i class="glyphicon  glyphicon-trash"></i>
															</button>
															<button type="button" id="<?php echo $contact[$j]['id'] ?>" class="btn btn-warning btn-sm m-rb-5 update" value="D"><i class="glyphicon  glyphicon-refresh"></i>
															</button>
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
						<br>
							
							
							
							
							<div class="row">
								<div class="col-sm-3">
									<label for="material_name" class="form-control-label" id="material_name_lbl">Name</label>
								</div>						
								<div class="col-sm-3">
									<label for="drawing_name" class="form-control-label" id="drawing_name_lbl">Email</label>
								</div>
								<div class="col-sm-3">
									<label for="cad_name" class="form-control-label" id="cad_name_lbl">Phone</label>
								</div>								
							</div>
							
							<div class="row btnSectionClone">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div', integer('contact_person_phone'))"/>
									</div>
								</div>
								<div class="col-sm-3" id = "add_div">
									<a class="btn btn-success btn-top add" id="add_row">Add</a>
								</div>
							</div>
							
							<!--<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div')"/>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div')"/>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div')"/>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div')"/>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group contact_person_name_div">
										<input type="text" class="form-control" id="contact_person_name" name="contact_person_name[]" placeholder="Name" onkeyup="change_status('contact_person_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group contact_person_email">
										<input type="text" class="form-control" id="contact_person_email" name="contact_person_email[]" placeholder="Email" onkeyup="change_status('contact_person_email_div')"/>
									</div>
								</div>								
								<div class="col-sm-3">
									<div class="form-group contact_person_phone_div">
										<input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone[]" placeholder="Phone" onkeyup="change_status('contact_person_phone_div')"/>
									</div>
								</div>								
							</div>
							-->
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update Customer</button>
										<a href="<?php echo base_url("account/customer/index") ?>">
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
	$(document).on('click', '.add', function(){
		
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$tr.before($clone);
	});
		
		$(document).on('click', '.remove', function(){
			
			$(this).closest('.btnSectionClone').remove();
		});

	
	$('.update').click(function() 
	{
		var row_id=$(this).prop('id');
		var name=$(this).parents('tr').find('input.name_child').val();
		var email=$(this).parents('tr').find('input.email_child').val()
		var phone=$(this).parents('tr').find('input.phone_child').val()
		var cust_id=$(this).parents('tr').find('input.child_cust_id').val();
		if(row_id)
		{
			$.ajax({url:'<?php echo base_url("account/customer/update_customer_contact");?>',method:'POST',data:{row_id:row_id, name:name, email:email, phone:phone, cust_id:cust_id},success:function(a)
			{
				location.reload(true);
			}}); 
		}			
	
	});
	
	$('.delete').click(function() 
	{
		var row_id=$(this).prop('id');
		var res = confirm('Are You Sure ?');
		if(res == true)
		{
			if(row_id)
			{
				$.ajax({url:'<?php echo base_url("account/customer/remove_customer_contact");?>',method:'POST',data:{row_id:row_id},success:function(a)
				{
					location.reload(true);
				}}); 
			}			
		}
	});

	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	$("#frm").submit(function(e)
	{
		var flag="True";
		var name=$("#name").val();
		var mobile_status=$("#mobile_status").val();
		var country=$("#country").val();
		
		 
		if(name=="")
		{
			$(".name_div").addClass("has-danger");
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
			$.ajax({url:"<?php echo base_url("account/customer/get_country"); ?>",method:"POST",data:{country:country},success:function(a)
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
			$.ajax({url:"<?php echo base_url("account/customer/check_mobile");?>",method:"POST",data:{mobile:mobile},success:function(a)
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