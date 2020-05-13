<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url("public/assets/dist/img/favicon_new.png"); ?>" type="image/x-icon">
        <link href="<?php echo base_url("public/assets/dist/css/base.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("public/assets/dist/css/style.css"); ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body class="hold-transition fixed sidebar-mini">
        <div class="login-wrapper">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon" style="width: 100%">
								<center>
									<img height="100px" src="<?php echo base_url("public/assets/dist/img/logo_new.png"); ?>"/>
							   </center>
                            </div>
                           
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo base_url("index/login_info");  ?>" method="POST" id="loginForm" >
                            <div class="form-group">
                                <label class="control-label" id="username_lbl">Username</label><span style="color:red;">*</span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" onkeyup="change_status('username_lbl')"/>
                                </div>
                                <span class="help-block small">Your unique username to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" id="password_lbl">Password</label><span style="color:red;">*</span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input  type="password" class="form-control" name="password" id="password" placeholder="Password" onkeyup="change_status('password_lbl')"/>
                                </div>
                                <span class="help-block small">Your unique password to app</span>
                            </div>
                            <div>
								
                                <div class="checkbox checkbox-success">
                                   
									<button type="submit" class="btn btn-base w-md m-rb-5 pull-right" value="Login">Login</button>
                                </div>
							<?php
								if($this->session->flashdata("error"))
								{
									?>		 
											<div class="col-sm-12" id="message_lbl">	
												<div class="alert alert-sm alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													 <i class="fa fa-exclamation-circle"></i><?php echo $this->session->flashdata("error"); ?>
												</div>
											</div>	
									 <?php
								}
								?>
							 
													
													
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <script src="<?php echo base_url("public/assets/plugins/jQuery/jquery-1.12.4.min.js"); ?>"></script>
        <script src="<?php echo base_url("public/assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
		<script>
			$(window).load(function() 
			{
				$("#message_lbl").show().delay(4000).fadeOut();
			});
		</script>
		<script>	
			
			$("#user_type").change(function(){
				var user_type=$("#user_type").val();
				if(user_type==1)
				{
					$("#team_container").hide();
				}
				else
				{
					$("#team_container").show();
				}
			});
		
			function change_status(lbl)
			{
				$("#"+lbl).css("color","#374767");
			}
			$("#loginForm").submit(function(e)
			{
				 var username=$("#username").val();
				 var password=$("#password").val();
				 var flag="True";
				 if(username.length<=0)
				 {
					 $("#username_lbl").css("color","red");
					 flag="False";
				 }
				 
				 if(password.length<=0)
				 {
					 $("#password_lbl").css("color","red");
					 flag="False";
				 }
				 if(flag=="False")
				 {
					 e.preventDefault();
					 return false;
				 }
			});
		</script>
    </body>
</html>