<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-print"></i></div>
			<div class="header-title">
				<h1>Order Report</h1>
				<small>Order Report Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Reports</a></li>
					<li class="active">Order Report</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row" ng-controller="reportController">
			 <div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Order Report Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/report/download_order_report"); ?>">
							<div class="col-sm-12">
								<div class="form-group start_date_div col-sm-2">
								    <label for="start_date" class="form-control-label" id="start_date_lbl">Start Date</label><span class="red_star">*</span>
								     <input type="text" class="form-control datetimepicker2" id="start_date" ng-model="start_date" readonly name="start_date"  placeholder="Start Date" onkeyup="change_status('start_date_div')"/>
								</div>
								
								<div class="form-group end_date_div col-sm-2">
								    <label for="end_date" class="form-control-label" id="end_date_lbl">End Date</label>
								     <input type="text" class="form-control datetimepicker2" id="end_date" name="end_date" ng-model="end_date" readonly  placeholder="End Date" onkeyup="change_status('end_date_div')"/>
								</div>
								
								<div class="form-group user_type_div col-sm-2">
								    <label for="user_type" class="form-control-label" id="user_type_lbl">User Type</label>
								     <select class="form-control" id="user_type" name="user_type" ng-model="user_type" onkeyup="change_status('user_type_div')" ng-change="get_users()">
										<option selected disabled value="">Select User Type</option>
										<?php
											if(sizeof($user_type)>0)
											{
												for($i=0;$i<sizeof($user_type);$i++)
												{
													?>
														<option value="<?php echo $user_type[$i]['id']; ?>">
															<?php echo $user_type[$i]['user_type']; ?>
														</option>
													<?php
												}
											}
										?>	
									 </select>
								</div>
								
								
								<div class="form-group user_div col-sm-3">
								    <label for="user" class="form-control-label" id="user_lbl">User</label>
								     <select class="form-control basic-single" id="user" name="user" ng-model="user"  onkeyup="change_status('user_div')">
										<option selected disabled value="">Select User</option>
										<option ng-repeat="user in user_list" value="{{user.id}}">{{user.first_name+" "+user.last_name+" "+user.mobile}}</option>
										
									 </select>
								</div>
								<div class="form-group col-sm-1" style="padding-top:25px;">
									<button type="button"  class="btn btn-primary pull-right" ng-click="get_orders_report()" name="add_aggrement">View</button>
								</div>
								<div class="form-group col-sm-1" style="padding-top:25px;">
									<button type="button"  class="btn btn-success pull-left" name="add_aggrement">Download</button>
								</div>
								<div class="form-group col-sm-1" style="padding-top:25px;">
									<a href="<?php echo base_url("account/report/index"); ?>">
										<button type="button"  class="btn btn-warning pull-left" name="add_aggrement">Reset</button>
									</a>
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
	var app=angular.module("myApp",[]);
	app.controller("reportController",function($scope,$http)
	{
		$scope.start_date="<?php echo date("d-m-Y"); ?>";
		$scope.get_users=function()
		{
			var user_type=$scope.user_type;
			if(user_type)
			{
				$http.post("<?php echo base_url("account/report/get_users"); ?>",{'user_type':user_type}).then(function(response)
				{
					$scope.user_list=response.data.users;
				});
			}
		}
		
		$scope.get_orders_report=function()
		{
			var start_date=$scope.start_date;
			var end_date=$scope.end_date;
			var user_type=$scope.user_type;
			var user=$scope.user;
			if(start_date)
			{
				$http.post("<?php echo base_url("account/report/get_order_list"); ?>",{"start_date":start_date,"end_date":end_date,"user_type":user_type,"user":user}).then(function(response)
				{
					alert(response.data);	
				});
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
		var permision=$("#permision").val();
		var role_name=$("#role_name").val();
		var description=$("#description").val();

		if(permision=="" || permision==null)
		{
			$(".permision_div").addClass("has-danger");
			flag="False";
		}
		if(role_name=="" || role_name==null)
		{
			$(".role_name_div").addClass("has-danger");
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