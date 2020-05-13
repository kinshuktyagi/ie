<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Tax</h1>
				<small>Tax Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Tax Master</a></li>
					<li><a href="<?php echo base_url("account/tax/index"); ?>">Tax List</a></li>
					<li class="active">Add Tax</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Tax Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/tax/add"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group tax_name_div">
										<label for="tax_name" class="form-control-label" id="tax_name_lbl">Tax Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="tax_name" name="tax_name"  placeholder="Tax Name" onkeyup="change_status('tax_name_div')"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group tax_type_div">
										<label for="tax_type" class="form-control-label" id="tax_type_lbl">Tax Type</label><span class="red_star">*</span>
										<select class="form-control" id="tax_type" name="tax_type" onchange="change_status('tax_type_div')">
											<option selected disabled value="">Select Tax Type</option>
											<?php
												if(sizeof($tax_type))
												{
													for($i=0;$i<sizeof($tax_type);$i++)
													{
														?>
															<option value="<?php echo $tax_type[$i]['id']; ?>"><?php echo $tax_type[$i]['tax_type']; ?></option>
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
									<div class="form-group tax_value_div">
										<label for="tax_value" class="form-control-label" id="tax_value_lbl">Tax Value</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="tax_value" name="tax_value" placeholder="Tax Value" onkeyup="change_status('tax_value_div')"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="4" cols="50" type="text" class="form-control" id="description"  name="description" placeholder="Description" onkeyup="change_status('description_div')"></textarea>
									</div>
								</div>
							</div>							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Tax</button>
										<a href="<?php echo base_url("account/tax/index") ?>">
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
		var tax_name = $("#tax_name").val();
		var tax_type = $("#tax_type").val();
		var tax_value = $("#tax_value").val();
		
		if(tax_name=="")
		{
			$(".tax_name_div").addClass("has-danger");
			flag="False";
		}
		if(tax_type=="" || tax_type==null)
		{
			$(".tax_type_div").addClass("has-danger");
			flag="False";
		}
		if(tax_value=="")
		{
			$(".tax_value_div").addClass("has-danger");
			flag="False";
		}
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>