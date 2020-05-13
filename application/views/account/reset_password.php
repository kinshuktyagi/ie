<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Password</h1>
				<small>Manage Password.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">User Master</a></li>
					<li><a href="<?php echo base_url("account/user/index"); ?>">User List</a></li>
					<li class="active">Manage Password</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Change Password</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/user/update_password"); ?>">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group password_div">
										<label for="password" class="form-control-label" id="password_lbl">Password</label>
										<input type="text" class="form-control" id="password" name="password" value="" placeholder="Password" onkeyup="change_status('password_div')"/>
										<input type="hidden" name="user_id" value="<?php echo $usr; ?>"/>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group con_password_div">
										<label for="con_password" class="form-control-label" id="con_password_lbl">Confirm Password</label>
										<input type="text" class="form-control" id="con_password" name="con_password" value="" placeholder="Confirm Password" onkeyup="change_status('con_password_div')"/>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Change Password</button>
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
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	$("#frm").submit(function(e)
	{
		var flag="True";
		var password=$("#password").val();
		var con_password=$("#con_password").val();;
		
		if(password=='')
		{
			$(".password_div").addClass("has-danger");
			flag="False";
		}
	
		if(con_password=="")
		{
			$(".con_password_div").addClass("has-danger");
			flag="False";
		}
		if(password!=con_password)
		{
			$(".con_password_div").addClass("has-danger");
			$(".password_div").addClass("has-danger");
			flag="False";
		}
		
		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});
</script>