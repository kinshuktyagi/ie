<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Customer Account Details</h1>
				<small>Account Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/account_lead/index"); ?>">Customer Account Master</a></li>
					<li class="active">Add Customer Account Details</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Account Information</h4>
						</div>
					</div>
					<?php
						/* echo $lead_id;
						exit('test'); */
					?>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/account_lead/add"); ?>">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group bank_name_div">
										<label for="bank_name" class="form-control-label" id="bank_name_lbl">Bank Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" onkeyup="change_status('bank_name_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group bank_account_no_div">
										<label for="bank_account_no" class="form-control-label" id="bank_account_no_lbl">Bank Account No.</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="bank_account_no" name="bank_account_no"  placeholder="Account Number" onkeyup="change_status('bank_account_no_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group ifsc_code_div">
										<label for="ifc_code" class="form-control-label" id="ifsc_code_lbl">IFSC Code</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="ifsc_code" name="ifsc_code"  placeholder="IFSC Code" onkeyup="change_status('ifsc_code_div')"/>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group branch_name_div">
										<label for="branch_name" class="form-control-label" id="branch_name_lbl">Branch Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="branch_name" name="branch_name"  placeholder="Branch Name" onkeyup="change_status('branch_name_div')"/>
									</div>
								</div>
							</div>
							
							<input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_id;?>"/>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Add Account Details</button>
										<a href="<?php echo base_url("account/account_lead/index") ?>">
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
		var bank_name = $("#bank_name").val();
		var bank_account_no = $("#bank_account_no").val();
		var ifsc_code = $("#ifsc_code").val();
		var branch_name = $("#branch_name").val();		
		var description = $("#description").val();
		
		if(bank_name==""){
			$(".bank_name_div").addClass("has-danger");
			flag="False";
		}if(bank_account_no==""){
			$(".bank_account_no_div").addClass("has-danger");
			flag="False";
		}if(ifsc_code==""){
			$(".ifsc_code_div").addClass("has-danger");
			flag="False";
		}if(branch_name==""){
			$(".branch_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

</script>