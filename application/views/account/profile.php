<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Profile</h1>
				<small>User Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Profile</a></li>
					<li class="active">View Profile</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<?php $this->load->view("flash");
		$user=$this->session->userdata("user");
		?>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header" style="height:291px;">
						<div class="card-header-menu">
							<i class="fa fa-bars"></i>
						</div>
						<div class="card-header-headshot" style="background-image:url(<?php echo base_url("public/assets/profile_pic/".$user['profile_pic']); ?>);">
						
						</div>						
					</div>
					<div class="card-content">
						<!-- <div class="card-content-member">
							<h4 class="m-t-0"><?php echo $user['first_name']." ".$user['last_name']; ?></h4><h5><b>Department: </b><?php echo $user['department_name']?></h5>
							<p class="m-0"><i class="pe-7s-map-marker"></i><?php echo $user['country']; ?></p>
						</div> -->
					<?php 

					/*echo "<pre>";
					print_r($user);
					exit();*/					

					?>
						
					</div>
					
				</div>
			</div>
		</div> 
		
		<div class="row">
			 <div class="col-sm-6">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Manage Password</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" action="<?php echo base_url("account/index/change_password"); ?>">
							
							<div class="form-group password_div">
								<label for="password" class="form-control-label" id="password_lbl">Password</label><span class="red_star">*</span>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup="change_status('password_div')"/>
							</div>
							<div class="form-group con_password_div">
								<label for="con_password" class="form-control-label" id="first_name_lbl">Confirm Password</label><span class="red_star">*</span>
								<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirm Password" onkeyup="change_status('con_password_div')"/>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-base pull-right">Change Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Inline form -->
			<div class="col-sm-6">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Profile Picture</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="profile_frm" action="<?php echo base_url("account/index/change_profile_picture"); ?>" enctype='multipart/form-data'>
							<div class="form-group profile_pic_div">
								<label for="mobile" class="form-control-label" id="mobile_lbl">Select Image</label><span class="red_star">*</span>
								<input type="file" class="form-control" id="profile_pic" name="image_file" onclick="change_status('profile_pic_div')"/>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-base pull-right">Update Picture</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-bd lobidrag">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Department </h4>
						</div>
					</div>
					<div class="panel-body">
						<!-- <form method="POST" id="profile_frm" action="<?php echo base_url("account/index/change_profile_picture"); ?>" enctype='multipart/form-data'> -->

<div class="panel-body" style="padding:1px !important;">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="t_head">
					<th>Department</th>					 
					<th>Designation</th>					 
					<th>Status</th>										
					<th>Action</th>										
				</tr>				 
			</thead>
			<tbody>
				<?php
					if(sizeof($dep)>0)
					{
						for($i=0;$i<sizeof($dep);$i++)
						{ 	?>
								<tr> 
									<td><?php echo $dep[$i]['department_name']; ?></td> 
									<td><?php echo $dep[$i]['designation_name']; ?></td> 
									<!-- <td>
										<?php //echo $dep[$i]['is_default']; ?>
										
									</td>  -->
									<td>
										<?php 
											if($dep[$i]['is_default']=="True")
											{
												echo'<span class="label label-success m-r-15">'.$dep[$i]['is_default'].'</span>';
											}
											else if($dep[$i]['is_default']=="False")
											{
												echo'<span class="label label-warning m-r-15">'.$dep[$i]['is_default'].'</span>';
											}
										?>
									</td>
					
									<td class="change_dep">	
										<?php
											if($dep[$i]['is_default']=='False')
											{
												?>
													<a href="<?php echo base_url("account/index/make_default_department?id=".$dep[$i]['id']); ?>">Set As Default</a>
												<?php
											}
										?>
									</td>	
								</tr>
							<?php
						}
					}
					else
					{ ?>
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



 
					 
				</form>
					</div>
				</div>
			</div>
		</div>
		<script>
			$("#frm").submit(function(e)
			{
				var flag="True";
				var password=$("#password").val();
				var con_password=$("#con_password").val();
				
				if(password=="")
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
					$(".password_div").addClass("has-danger");
					$(".con_password_div").addClass("has-danger");
					flag="False";
				}
				
				if(flag=="False")
				{
					e.preventDefault();
					return false;
				}
			});
			
			$("#profile_frm").submit(function(e)
			{
				var flag="True";
				var profile_pic=$("#profile_pic").val();
				
				if(profile_pic=="")
				{
					$(".profile_pic_div").addClass("has-danger");
					flag="False";
				}
				
			
				if(flag=="False")
				{
					e.preventDefault();
					return false;
				}
			});

		function change_status(div)
		{
			$("."+div).removeClass("has-danger");
		}
		</script>
		<script>
			/* $(".change_dep").click(function()
			{

				var id = $(this).prop("id");
				var user_id=$("#user_id").val();

				if(id)
				{
					$.ajax({url:"<?php echo base_url("account/index/make_default_department"); ?>",method:"POST",data:{id:id,user_id:user_id},success:function(a)
					{
						window.location.reload();
						//$("#state")	.html(a);
					}});
				}
				 
			});	 */	
		</script>
	</div>
</div>