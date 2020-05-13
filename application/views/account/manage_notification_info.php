<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Add Notification</h1>
				<small>Notification Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/notification/index"); ?>">Notification Master</a></li>
					<!--<li><a href="<?php echo base_url("account/notification/index"); ?>">Notification List</a></li>-->
					<li class="active">Add Notification</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Notification Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/notification/update_notification"); ?>">
							<div class="row">
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
															<option value="<?php echo $user_type[$i]['id']; ?>" <?php echo $user_type[$i]['id']==$info['user_type']?'selected':''?> ><?php echo $user_type[$i]['user_type']; ?></option>
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
															<option value="<?php echo $department[$i]['id']; ?>" <?php echo ($department[$i]['id'] == $info['department_id']) ? 'selected' : '' ?> ><?php echo $department[$i]['department_name']; ?></option>
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
									<div class="form-group notification_name_div">
										<label for="notification_name" class="form-control-label" id="notification_name_lbl">Notification Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="notification_name" name="notification_name"  placeholder="Notification Name" onkeyup="change_status('notification_name_div')" value="<?php echo $info['notification_name']?>" />
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="join_date" class="form-control-label" id="join_date_lbl">End Date</label>
										<input type="text" class="form-control datetimepicker2" id="end_date" name="end_date" placeholder="End Date" readonly value="<?php echo date("d-m-Y",strtotime( $info['end_date']));?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="4" cols="100" type="text" class="form-control" id="description"  name="description" placeholder="Description" onkeyup="change_status('description_div')"> <?php echo $info['description'];?></textarea>
									</div>
								</div>
							</div>
							
							<div class="row"> 
								<div class="form-group checkbox checkbox-success checkbox-inline col-sm-4">
									<input type="checkbox" id="inlineCheckbox2" value="True" name="email_send"  <?php echo ($info['email_send']=='True')?'checked':''?> >
									<label for="inlineCheckbox2"> Send Email Notification</label>
								</div>								 
							</div>
							<input type="hidden" name="notification_id" value="<?php echo $info['id'];?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update Notification</button>
										<a href="<?php echo base_url("account/notification/index") ?>">
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
		var user_type = $("#user_type").val();		
		var notification_name = $("#notification_name").val();		
		var end_date = $("#end_date").val();
		
		if(user_type=="" || user_type== null)
		{
			$(".user_type_div").addClass("has-danger");
			flag="False";
		}
		if(notification_name=="")
		{
			$(".notification_name_div").addClass("has-danger");
			flag="False";
		}
		if(end_date=="")
		{
			$(".end_date_div").addClass("has-danger");
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

</script>