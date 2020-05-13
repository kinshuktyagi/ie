<?php
	$user=array();
	if(!isset($_SESSION['user']))
	{
		$this->session->set_flashdata('error', 'Sorry unauthorized access');
		redirect("login");
	}
	else
	{
		$user=$this->session->userdata("user");
	}
	$seg=$this->uri->segment("2");	
	$seg_three=$this->uri->segment("3");
?>
<style>
	.sidebar-menu li > a > .pull-right-container {
		position: absolute;
		right: 0px;
		top: 50%;
		margin-top: -7px;
	}
	.content-header{
		padding-top: 35px;
	}
	.main-header .logo{
		width:190px;
	}
</style>
 <body class="hold-transition fixed sidebar-mini" ng-app="myApp">
	<div class="preloader"></div>
	<div class="wrapper">
		<header class="main-header hidden-print"> 
			<a href="<?php echo base_url("account"); ?>" class="logo">
				<span class="logo-mini">
					<img src="<?php echo base_url("public/assets/dist/img/logo_mini.png"); ?>" alt="img">
				</span>
				<span class="logo-lg">
					<img src="<?php echo base_url("public/assets/dist/img/logo_header.png"); ?>" alt="img" height = "70px";> 
				</span>
			</a>
			
			<nav class="navbar navbar-static-top">				
				<a href="#" class="sidebar-toggle hidden-sm hidden-md hidden-lg" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
					<span class="sr-only">Toggle navigation</span>
					<span class="ti-menu-alt"></span>
				</a>			
				<div class="navbar-custom-menu">				
					<ul class="nav navbar-nav">
						<!--<li class="dropdown dropdown-settings">
							<a href="#" class="dropdown-toggle bubbly-button" data-toggle="dropdown"> <i class="fa fa-bell-o"></i><span class="badge fadeAnim" style="background-color:red">2</span></a>
							<div class="notification-box dropdown-menu animated bounceIn">
								<div class="notification-header">
									<h4>2 new notifications</h4>
									<a href="#">clear all</a>
								</div>
								<div class="notification-body">
									<ul class="notification_inner">
										<li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-commenting"></i>
											 </div>
											 <div class="notification-txt">
												<h4>3 new comments</h4>
												<span>40 seconds ago</span>
											 </div>
										  </a>
										</li>
										<li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-envelope-o"></i>
											 </div>
											 <div class="notification-txt">
												<h4>You have received 1 email</h4>
												<span>5 minutes ago</span>
											 </div>
										  </a>
									   </li>
									   <li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-usd"></i>
											 </div>
											 <div class="notification-txt">
												<h4>You have transferred $50</h4>
												<span>8 minutes ago</span>
											 </div>
										  </a>
									   </li>
									   <li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-thumbs-up"></i>
											 </div>
											 <div class="notification-txt">
												<h4>Someone likes your post</h4>
												<span>13 minutes ago</span>
											 </div>
										  </a>
									   </li>
									   <li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-ban "></i>
											 </div>
											 <div class="notification-txt">
												<h4>Someone banned your post</h4>
												<span>20 minutes ago</span>
											 </div>
										  </a>
									   </li>
									   <li>
										  <a href="#" class="single-notification">
											 <div class="notification-img">
												<i class="fa fa-trash"></i>
											 </div>
											 <div class="notification-txt">
												<h4>Someone deleted your post</h4>
												<span>36 minutes ago</span>
											 </div>
										  </a>
									   </li>
									</ul>
								</div>
								<div class="notification-footer">
									<a href="#">see all notification<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</li>
                        -->   
						<li class="dropdown dropdown-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="ti-user"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url("account/index/profile"); ?>">Login As: <?php echo $user['user_type_name']; ?></a></li>
								<li><a href="<?php echo base_url("account/index/profile"); ?>"><i class="ti-user"></i> View Profile</a></li>
								<li><a href="<?php echo base_url("account/index/manage_profile"); ?>"><i class="ti-settings"></i>Manage Profile</a></li>
								<li><a href="<?php echo base_url("account/index/logout"); ?>"><i class="ti-key"></i> Logout</a></li>
							</ul>							
						</li>
					</ul>	
				</div>
			</nav>
			<?php
				/* $seg=$this->uri->segment("2");
				echo $seg;
				echo $seg_three;
				exit(); */
			?>
			<!-- Tab panes -->
			<aside class="main-sidebar" style="width:190px">
				<!-- sidebar -->
				<div class="sidebar">
					<!-- sidebar menu -->
					<ul class="sidebar-menu">
						<li class="treeview <?php if($seg==''){ echo'active'; } ?>">
							<a href="<?php echo base_url("account"); ?>">
								<i class="ti-home"></i><span>Dashboard</span>
								<span class="pull-right-container">
									
								</span>
							</a>
							
						</li>
					    <li class="treeview <?php if($seg=='role' || $seg=='permission' || $seg=='set' || $seg=='user' || $seg=='offer' || $seg=='department' || $seg=='designation' || $seg=='vendor' || $seg=='tnc' || $seg=='notification' || $seg=='followup' || $seg=='status' || $seg=='skill' || $seg=='sale_source' || $seg=='division' || $seg=='project_type' || $seg == 'customer' || $seg == 'tax' || $seg == 'field' || $seg == 'industry'|| $seg == 'machine'){ echo'active'; } ?>">
							<a href="#">
								<i class="ti-pencil-alt"></i> <span>Master</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='set'){ echo'active'; } ?>"><a href="<?php echo base_url("account/set/index"); ?>">Role Set Master</a></li>
								<li class="<?php if($seg=='department'){ echo'active'; } ?>"><a href="<?php echo base_url("account/department/index"); ?>">Department Master</a></li>
								<li class="<?php if($seg=='designation'){ echo'active'; } ?>"><a href="<?php echo base_url("account/designation/index"); ?>">Designation Master</a></li>
								<li class="<?php if($seg=='tax'){ echo'active'; } ?>"><a href="<?php echo base_url("account/tax/index"); ?>">Tax Master</a></li>
								<li class="<?php if($seg=='user'){ echo'active'; } ?>"><a href="<?php echo base_url("account/user/index"); ?>">Employee Master</a></li>
								
								<li class="<?php if($seg=='vendor'){ echo'active'; } ?>"><a href="<?php echo base_url("account/vendor/index"); ?>">Vendor Master</a></li>
								<li class="<?php if($seg=='tnc'){ echo'active'; } ?>"><a href="<?php echo base_url("account/tnc/index"); ?>">TNC Master</a></li>
								<li class="<?php if($seg=='notification'){ echo'active'; } ?>"><a href="<?php echo base_url("account/notification/index"); ?>">Notification Master</a></li>
								<li class="<?php if($seg=='customer'){ echo'active'; } ?>"><a href="<?php echo base_url("account/customer/index"); ?>">Customer Master</a></li>								
								<!--<li class="<?php if($seg=='uom'){ echo'active'; } ?>"><a href="<?php echo base_url("account/uom/index"); ?>">UOM Master</a></li>-->
								<li class="<?php if($seg=='field'){ echo'active'; } ?>"><a href="<?php echo base_url("account/field/index"); ?>">Field Master</a></li>
								<li class="<?php if($seg=='industry'){ echo'active'; } ?>"><a href="<?php echo base_url("account/industry/index"); ?>">Industry Master</a></li>
								<li class="<?php if($seg=='machine'){ echo'active'; } ?>"><a href="<?php echo base_url("account/machine/index"); ?>">Machine Master</a></li>
							</ul>							
					    </li>
						<li class="treeview <?php if($seg=='raw_material_category' || $seg=='product' || $seg=='sub_category'){ echo'active'; } ?>">
							<a href="#">
								<i class="ti-pencil-alt"></i> <span>Raw Material</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='raw_material_category'){ echo'active'; } ?>"><a href="<?php echo base_url("account/raw_material_category/index"); ?>">Category Master</a></li>
								<li class="<?php if($seg=='sub_category'){ echo'active'; } ?>"><a href="<?php echo base_url("account/sub_category/index"); ?>">Sub Category Master</a></li>
								<li class="<?php if($seg=='product'){ echo'active'; } ?>"><a href="<?php echo base_url("account/product/index"); ?>">Product Master</a></li>
							</ul>							
					    </li>
						<li class="treeview <?php if($seg=='enquiry' || $seg=='enquiry_followup' || $seg_three=='assigned'){ echo'active'; } ?>">
							<a href="#">
								<i class="ti-pencil-alt"></i> <span>Enquiry</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='enquiry'){ echo'active'; } ?>"><a href="<?php echo base_url("account/enquiry/index"); ?>">Enquiry Master</a></li>
								<li class="<?php if($seg_three=='assigned' && $seg=='enquiry'){ echo'active'; } ?>"><a href="<?php echo base_url("account/enquiry/assigned"); ?>">Assigned Enquiry</a></li>
								<li class="<?php if($seg=='enquiry_follwup'){ echo'active'; } ?>"><a href="<?php echo base_url("account/enquiry_followup/index"); ?>">Enquiry Followup</a></li>
							</ul>
					    </li>
						<li class="treeview <?php if($seg=='quotation'){ echo'active'; } ?>">
							<a href="#">
								<i class="ti-pencil-alt"></i> <span>Quotation</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='quotation'){ echo'active'; } ?>"><a href="<?php echo base_url("account/quotation/index"); ?>">Quotation Master</a></li>
							</ul>
					    </li>
						<li class="treeview <?php if($seg=='po'){ echo'active'; } ?>">
							<a href="#">
								<i class="ti-pencil-alt"></i> <span>PO</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='po'){ echo'active'; } ?>"><a href="<?php echo base_url("account/po/index"); ?>">PO Master</a></li>								
							</ul>
					    </li>
						
						<li class="treeview <?php if($seg=='stocks' || $seg=='defective_stock' || $seg=='inventory_issue' || $seg=='inventory_request'){ echo'active'; } ?>">
							<a href="#" >
								<i class="ti-pencil-alt"></i> <span>Inventory Master</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php if($seg=='stocks'){ echo'active'; } ?>"><a href="<?php echo base_url("account/stocks/index"); ?>">Inventory Master</a></li>
								<li class="<?php if($seg=='defective_stock'){ echo'active'; } ?>"><a href="<?php echo base_url("account/defective_stock/index"); ?>">Defective Inventory Master</a></li>
								<li class="<?php if($seg=='inventory_request'){ echo'active'; } ?>"><a href="<?php echo base_url("account/inventory_request/index"); ?>">Inventory Request</a></li>
								<li class="<?php if($seg=='inventory_issue'){ echo'active'; } ?>"><a href="<?php echo base_url("account/inventory_issue/index"); ?>">Inventory Issue</a></li>
							</ul>
					    </li>
					</ul>
				</div>
			</aside>
		</header>