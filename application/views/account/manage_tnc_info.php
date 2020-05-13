<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage TNC</h1>
				<small>TNC Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">TNC Master</a></li>
					<li><a href="<?php echo base_url("account/tnc/index"); ?>">TNC List</a></li>
					<li class="active">Manage TNC</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>TNC Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/tnc/update_tnc"); ?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group tnc_type_div">
										<label for="tnc_type" class="form-control-label" id="tax_type_lbl">TNC Type</label><span class="red_star">*</span>
										<select class="form-control" id="tnc_type" name="tnc_type" onchange="change_status('tnc_type_div')">
											<option selected disabled value="">Select TNC Type</option>
											<?php
												if(sizeof($tnc_type))
												{
													for($i=0;$i<sizeof($tnc_type);$i++)
													{
														?>
															<option value="<?php echo $tnc_type[$i]['id']; ?>"<?php echo $tnc_type[$i]['id'] == $info['tnc_type'] ? 'selected' :'' ?> ><?php echo $tnc_type[$i]['tnc_type_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group tnc_name_div">
										<label for="tnc_name" class="form-control-label" id="tnc_name_lbl">TNC Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="tnc_name" name="tnc_name"  placeholder="TNC Name" onkeyup="change_status('tnc_name_div')"value="<?php echo $info['tnc_name']; ?>" />
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="4" cols="50" type="text" class="form-control" id="summernote2" name="description" placeholder="Description" onkeyup="change_status('description_div')"><?php echo $info['description']; ?></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" name="tnc_id" value="<?php echo $info['tnc_id']?>" >							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update TNC</button>
										<a href="<?php echo base_url("account/tnc/index") ?>">
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
		var tnc_type = $("#tnc_type").val();
		var tnc_name = $("#tnc_name").val();
		
		if(tnc_type=="" || tnc_type== null)
		{
			$(".tnc_type_div").addClass("has-danger");
			flag="False";
		}
		if(tnc_name=="")
		{
			$(".tnc_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>