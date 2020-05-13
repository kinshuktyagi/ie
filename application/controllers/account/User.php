<?php
class user extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/user_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Employee List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$user_code=$this->security->xss_clean(trim($this->input->post("user_code")));
			$first_name=$this->security->xss_clean(trim($this->input->post("first_name")));
			$last_name=$this->security->xss_clean(trim($this->input->post("last_name")));
			$user_name=$this->security->xss_clean(trim($this->input->post("user_name")));
			$user_type=$this->security->xss_clean(trim($this->input->post("user_type")));
			$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
			$email=$this->security->xss_clean(trim($this->input->post("email")));
			$status=$this->security->xss_clean(trim($this->input->post("status")));
			
			$filter['user_code']=$user_code;
			$filter['user_first_name']=$first_name;
			$filter['user_last_name']=$last_name;
			$filter['user_user_name']=$user_name;
			$filter['user_user_type']=$user_type;
			$filter['user_mobile']=$mobile;
			$filter['user_email']=$email;
			$filter['user_status']=$status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page =50;
		$data_arr =	$this->user_model->index($offset, $show_per_page);
		
		$user_type=$this->master_model->get_user_type();
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/user/index');
		$config['num_links'] 	 = 8;
		$config['uri_segment']	 = 4;
		$config['total_rows']	 = $data_arr['total'];
		$config['per_page'] 	 = $show_per_page;
		$config['full_tag_open'] = '<div class="pagination pagination-right"><ul class="pagination pagination-rounded">';
		$config['full_tag_close']= '</ul></div>';
		$config['num_tag_open']  = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] 	 = 'First';
		$config['first_tag_open']= '<li class="disabled">';
		$config['first_tag_close']= '</li>';
		$config['last_link'] 	 = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close']= '</li>';
		$config['prev_link'] 	 = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close']= '</li>';
		$config['next_link'] 	 = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close']= '</li>';
		$config['cur_tag_open']	 = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['reuse_query_string'] = true;
				
		$this->pagination->initialize($config);
		$data['paginate'] =  $this->pagination->create_links();
		$data['total'] =  $data_arr['total'];
		$data['user_type'] =  $user_type;
		
		$this->load->view("account/user_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/user/index");
	}
	 
	//Going to add user...
	public function add_user()
	{
		$data['title']='Add Employee';
		$this->admin_header($data);
		$user_type=$this->master_model->get_user_type($_SESSION['user']['priority']);
		$country=$this->master_model->get_country();
		$department=$this->master_model->get_department();
		$designation=$this->master_model->get_designation();
		$data['user_type']=$user_type;
		$data['country']=$country;
		$data['department']=$department;
		$data['designation']=$designation;
		$this->load->view("account/add_user",$data);
		$this->admin_footer($data);
	}
	
	//Fetching country list...
	public function get_country()
	{
		$country=$this->security->xss_clean(trim($this->input->post("country")));
		
		$state_list=$this->master_model->get_state($country);
		echo'<option selected disabled value="">Select State</option>';
		if(sizeof($state_list)>0)
		{
			for($i=0;$i<sizeof($state_list);$i++)
			{
				?>
					<option value="<?php echo $state_list[$i]['stateID']; ?>"><?php echo $state_list[$i]['stateName']; ?></option>
				<?php
			}
		} 
	}

	//Fetching country list...
	public function check_username()
	{
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		
		$user_info=$this->user_model->check_user_name($mobile);
		if(sizeof($user_info)>0)
		{
			echo'False';
		}
		else
		{
			echo'True';
		}
	}
	
	//Going to add user...
	public function add()
	{
		$user_type=$this->security->xss_clean(trim($this->input->post("user_type")));
		$password=$this->security->xss_clean(trim($this->input->post("password")));
		$first_name=$this->security->xss_clean(trim($this->input->post("first_name")));
		$last_name=$this->security->xss_clean(trim($this->input->post("last_name")));
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		$email=$this->security->xss_clean(trim($this->input->post("email")));
		$country=$this->security->xss_clean(trim($this->input->post("country")));
		$state=$this->security->xss_clean(trim($this->input->post("state")));
		$city=$this->security->xss_clean(trim($this->input->post("city")));
		$join_date=$this->security->xss_clean(trim($this->input->post("join_date")));
		$address=$this->security->xss_clean(trim($this->input->post("address")));		
		$pincode=$this->security->xss_clean(trim($this->input->post("pincode")));
		//$department=$this->security->xss_clean(trim($this->input->post("department")));
		//$designation=$this->security->xss_clean(trim($this->input->post("designation")));
		
		$password=$this->my_library->encrypt($password);
		
		$emp_code = $this->user_model->generate_userid();
		
		$ar=array();
		$ar['id']=0;
		$ar['emp_code']=$emp_code;
		$ar['user_type']=$user_type;
		$ar['user_name']=$mobile;
		$ar['password']=$password;
		$ar['first_name']=$first_name;
		$ar['last_name']=$last_name;
		$ar['mobile']=$mobile;
		$ar['email']=$email;
		$ar['country']=$country;
		$ar['state']=$state;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['pin_code']=$pincode;
		//$ar['department']=$department;
		//$ar['designation']=$designation;
		
		$ar['profile_pic']='default.png';
		if($join_date)
		{
			$ar['join_date']=date("Y-m-d",strtotime($join_date));
		}
		$ar['add_date']=date("Y-m-d");
		$ar['status']='True';
		
		$add=$this->user_model->add_user($ar);
		if($add)
		{
		
			$this->session->set_flashdata('success', 'User has been successfully added');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}
	
	//Going to disable user...
	public function disable()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$ar=array('status'=>'False');
		$update=$this->user_model->update($ar,$usr);
		if($update)
		{
			$this->session->set_flashdata('success', 'User has been successfully updated.');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}

	//Going to enable user...
	public function enable()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$ar=array('status'=>'True');
		$update=$this->user_model->update($ar,$usr);
		if($update)
		{
			$this->session->set_flashdata('success', 'User has been successfully enabled.');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}
	
	
	//Going to manage employee...
	public function manage()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));		
		$data['title']='Manage Employee';
		$this->admin_header($data);
		$user_type=$this->master_model->get_user_type($_SESSION['user']['priority']);
		$country=$this->master_model->get_country();
		$department=$this->master_model->get_department();
		$designation=$this->master_model->get_designation();
		
		$info=$this->user_model->user_info($usr);
		
		$state_list=array();
		if($info['country']){
			$state_list=$this->master_model->get_state($info['country']);
		}
		
		$data['user_type']=$user_type;
		$data['country']=$country;
		$data['department']=$department;
		$data['designation']=$designation;
		$data['state_list']=$state_list;
		$data['info']=$info;
		$this->load->view("account/manage_user_info",$data);
		$this->admin_footer($data);
	}
		
	//Going to update user...
	public function update_user()
	{
		$user_id=$this->security->xss_clean(trim($this->input->post("user_id")));		
		//$user_type=$this->security->xss_clean(trim($this->input->post("user_type")));
		$first_name=$this->security->xss_clean(trim($this->input->post("first_name")));
		$last_name=$this->security->xss_clean(trim($this->input->post("last_name")));
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		$email=$this->security->xss_clean(trim($this->input->post("email")));
		$country=$this->security->xss_clean(trim($this->input->post("country")));
		$state=$this->security->xss_clean(trim($this->input->post("state")));
		$city=$this->security->xss_clean(trim($this->input->post("city")));
		$join_date=$this->security->xss_clean(trim($this->input->post("join_date")));
		$address=$this->security->xss_clean(trim($this->input->post("address")));
		$pincode=$this->security->xss_clean(trim($this->input->post("pincode")));
		//$department=$this->security->xss_clean(trim($this->input->post("department")));
		//$designation=$this->security->xss_clean(trim($this->input->post("designation")));
		
		
		$ar=array();
		//$ar['user_type']=$user_type;
		$ar['user_name']=$mobile;
		$ar['first_name']=$first_name;
		$ar['last_name']=$last_name;
		$ar['mobile']=$mobile;
		$ar['email']=$email;
		$ar['country']=$country;
		$ar['state']=$state;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['pin_code']=$pincode;
		//$ar['department']=$department;
		//$ar['designation']=$designation;
		if($join_date)
		{
			$ar['join_date']=date("Y-m-d",strtotime($join_date));
		}
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->user_model->update($ar,$user_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'User information has been successfully updated.');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}
	
	//Going to reset employee password...
	public function reset_password()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$data['title']='Reset Password';
		$data['usr']=$usr;
		$this->admin_header($data);
		$this->load->view("account/reset_password",$data);
		$this->admin_footer($data);
	}
	
	//Going to update password...
	public function update_password()
	{
		$user_id=$this->security->xss_clean(trim($this->input->post("user_id")));
		$password=$this->security->xss_clean(trim($this->input->post("password")));
		$con_password=$this->security->xss_clean(trim($this->input->post("con_password")));
		$password=$this->my_library->encrypt($password);
		
		$ar=array('password'=>$password);
		
		$update=$this->user_model->update($ar,$user_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Password has been successfully updated');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}
		
	//Going to assign role...
	public function role()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		
		$data['title']='Assign Role';
		$data['usr']=$usr;
		$set_role=array();
		$set_id=array();
		if(isset($_REQUEST['set']))
		{
			$set_role=$this->user_model->get_set_role($_REQUEST['set']);
		}
		else
		{
			$set=$this->user_model->get_user_set_role($usr);
			$set_role=$set['ar'];
			$set_id=$set['set_id'];
		}
		
		
		$role=$this->user_model->get_role_list();
		$set=$this->user_model->get_set_list();
		$data['set']=$set;
		$data['role']=$role;
		$data['role_permission']=$set_role;
		$data['set_id']=$set_id;
		$this->admin_header($data);
		$this->load->view("account/assign_role",$data);
		$this->admin_footer($data);
	}

	//Going to assign department...
	public function department()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		
		$data['title']='Assign Department';
		$data['usr']=$usr;	
		
		$user_dept_desg=$this->user_model->get_department_designation_list($usr);		
		
		//$team=$this->user_model->get_team_list();
		$department=$this->user_model->get_department_list();
		$designation=$this->user_model->get_designation_list();
		$user=$this->user_model->get_user_list();
		
		
		
		//$data['team']=$team;
		$data['user_data']=$user;
		$data['department']=$department;
		$data['designation']=$designation;
		$data['user_dept_desg']=$user_dept_desg;
		
		$this->admin_header($data);
		$this->load->view("account/assign_department",$data);
		$this->admin_footer($data);
	}
	
	
	public function add_role()
	{
		$permission=$this->security->xss_clean($this->input->post("permission"));
		$role_set=$this->security->xss_clean(trim($this->input->post("role_set")));
		$user_id=$this->security->xss_clean(trim($this->input->post("user_id")));
		
		$update=$this->user_model->delete_old_set_permission($user_id);
		if(sizeof($permission)>0)
		{
			for($i=0;$i<sizeof($permission);$i++)
			{
				$ex=explode("-",$permission[$i]);
				
				$permission_ar=array();
				$permission_ar['action_id']=0;
				$permission_ar['role_set']=$role_set;
				$permission_ar['user_id']=$user_id;
				$permission_ar['role_id']=$ex[0];
				$permission_ar['permission_id']=$ex[1];
				$this->user_model->add_set_permission($permission_ar);
			}
		}
		
		if($update)
		{
			$this->session->set_flashdata('success', 'Role has been successfully assigned');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
	}


	
	//assign_offer
	public function assign_offer()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$data['title']='Assign Offer';
		$this->admin_header($data);
		$category=$this->master_model->get_category();
		$assigned=$this->user_model->get_assigned_offer($usr);
		
		
		$data['assigned']=$assigned;
		$data['category']=$category;
		$this->load->view("account/assign_offer",$data);
		$this->admin_footer($data);
	}
	
	
	//Going to add user offer....
	public function add_user_offer()
	{
		$user_id=$this->security->xss_clean($this->input->post("user_id"));
		$category=$this->security->xss_clean($this->input->post("category"));
		$sub_category=$this->security->xss_clean($this->input->post("sub_category"));
		$percentage=$this->security->xss_clean($this->input->post("percentage"));
		$count=0;
		if(sizeof($category)>0)
		{
			for($i=0;$i<sizeof($category);$i++)
			{
				$ar=array();
				$ar['offer_id']=0;
				$ar['user_id']=$user_id;
				$ar['category_id']=$category[$i];
				$ar['sub_category_id']=$sub_category[$i];
				$ar['percentage']=$percentage[$i];
				$ar['add_date']=date("Y-m-d");
				$ar['status']='True';
				
				$add=$this->user_model->add_user_offer($ar);
				if($add)
				{
					$count++;
				}
			}
		}
		if($count)
		{
			$this->session->set_flashdata('success', 'Offer has been successfully assigned');
			redirect("account/user/assign_offer?usr=".$user_id);
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/assign_offer?usr=".$user_id);
		}
	}
	
	//Going to disable offer...
	public function disable_offer()
	{
		$offer_id=$this->security->xss_clean(trim($_REQUEST['offer_id']));
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		
		$ar=array('status'=>'False');
		
		$update=$this->user_model->update_offer($ar,$offer_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Offer has been successfully disabled');
			redirect("account/user/assign_offer?usr=".$usr);
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/assign_offer?usr=".$usr);
		}
	}
	
	
	//Going to enable offer...
	public function enable_offer()
	{
		$offer_id=$this->security->xss_clean(trim($_REQUEST['offer_id']));
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		
		$ar=array('status'=>'True');
		
		$update=$this->user_model->update_offer($ar,$offer_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Offer has been successfully enabled');
			redirect("account/user/assign_offer?usr=".$usr);
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/assign_offer?usr=".$usr);
		}
	}
	
	public function add_department_desg()
	{	
		$dept_set=$this->security->xss_clean(trim($_REQUEST['dept_set']));
		//$team_set=$this->security->xss_clean(trim($_REQUEST['team']));
		$desg_set=$this->security->xss_clean(trim($_REQUEST['desg_set']));
		$user_id=$this->security->xss_clean(trim($_REQUEST['user_id']));
		$report_to=$this->security->xss_clean(trim($_REQUEST['report_to']));
		
		$previous_count = $this->user_model->user_previous_dep_deg($user_id);
		//exit('test the previous count here');
		
		$ar=array();
		$ar['id']=0;
		$ar['dept_id']  = $dept_set;
		//$ar['team_id']  = $team_set;
		$ar['dsg_id'] 	= $desg_set;
		$ar['user_id'] 	= $user_id;
		$ar['report_to']= $report_to;
		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] 	= 'True';
		if($previous_count > 0)
		{
			$ar['is_default'] 	= 'False';
		}else{
			$ar['is_default'] 	= 'True';
		}
				
		$add=$this->user_model->add_department_designation($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Department has been successfully added');
			redirect("account/user/department/?usr=$user_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/department/?usr=$user_id");
		}

	}

	public function dp_disable()
	{
		$user_id=$this->security->xss_clean(trim($_REQUEST['usr']));

		$ar=array('status'=>'False');
		$update=$this->user_model->dept_desg_update($ar,$user_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Department has been successfully updated.');
			redirect("account/user/department/?usr=$user_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/department/?usr=$user_id");
		}
	}

	public function dp_enable()
	{
		$user_id=$this->security->xss_clean(trim($_REQUEST['usr']));

		$ar=array('status'=>'True');
		$update=$this->user_model->dept_desg_update($ar,$user_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Department has been successfully updated.');
			redirect("account/user/department/?usr=$user_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/department/?usr=$user_id");
		}
	}

	public function disable_assign_department()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$ar=array('status'=>'False');

		$update=$this->user_model->update_assign_user_department($ar,$usr);
		if($update)
		{
			$this->session->set_flashdata('success', 'User has been successfully enabled.');
			redirect("account/user/department?usr=$usr");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/department?usr=<?=$usr?>");
		}
	}

	public function enable_assign_department()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$ar=array('status'=>'True');

		$update=$this->user_model->update_assign_user_department($ar,$usr);
		if($update)
		{
			$this->session->set_flashdata('success', 'User has been successfully enabled.');
			redirect("account/user/department?usr=$usr");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/department?usr=<?=$usr?>");
		}
	}


	public function get_department_employee()
	{
		$departemnt_id = $this->security->xss_clean(trim($this->input->post("team")));
		$employee_department = $this->user_model->department_employee($departemnt_id);
		
		echo'<option selected disabled value="">Select Employee</option>';
		if(sizeof($employee_department)>0)
		{
			for($i=0;$i<sizeof($employee_department);$i++)
			{
				?>
					<option value="<?php echo $employee_department[$i]['user_id']; ?>"><?php echo $employee_department[$i]['first_name'].' '.$employee_department[$i]['last_name'].' / ('.$employee_department[$i]['designation_name'].')'; ?></option>
				<?php
			}
		} 
	}
	
	// To get the Department team name..
	public function get_department_team()
	{
		$departemnt_id = $this->security->xss_clean(trim($this->input->post("departemnt_id")));
		$department_team = $this->user_model->get_department_team($departemnt_id);
		
		echo'<option selected disabled value="">Select Team</option>';
		if(sizeof($department_team)>0)
		{
			for($i=0;$i<sizeof($department_team);$i++)
			{
				?>
					<option value="<?php echo $department_team[$i]['id']; ?>"><?php echo $department_team[$i]['team_name']; ?></option>
				<?php
			}
		} 
	}
	
	// to get the designation for the team..
	public function get_designation()
	{
		$team_id = $this->security->xss_clean(trim($this->input->post("team")));
		$designation_list = $this->user_model->get_designation($departemnt_id);
		
		echo'<option selected disabled value="">Select Designation</option>';
		if(sizeof($designation_list)>0)
		{
			for($i=0;$i<sizeof($designation_list);$i++)
			{
				?>
					<option value="<?php echo $designation_list[$i]['id']; ?>"><?php echo $designation_list[$i]['team_name']; ?></option>
				<?php
			}
		}
	}

	// Public Function ADD Address..
	public function add_address()
	{
		$usr=$this->security->xss_clean(trim($_REQUEST['usr']));
		$type=$this->security->xss_clean(trim($_REQUEST['type']));
		$country=$this->master_model->get_country();
		
		$data['title']='Add Address';
		$data['country']=$country;
		$data['usr']=$usr;
		$data['type']=$type;
		$this->admin_header($data);
		$this->load->view("account/add_address",$data);
		$this->admin_footer($data);
		
	}
	
	//Going To Store the address..
	public function address_add()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$shipping_name=$this->security->xss_clean(trim($this->input->post("shipping_name")));
		$shipping_mobile=$this->security->xss_clean(trim($this->input->post("shipping_mobile")));
		$shipping_email=$this->security->xss_clean(trim($this->input->post("shipping_email")));
		$shipping_country=$this->security->xss_clean(trim($this->input->post("shipping_country")));
		$shipping_state=$this->security->xss_clean(trim($this->input->post("shipping_state")));
		$shipping_city=$this->security->xss_clean(trim($this->input->post("shipping_city")));
		$shipping_pin_code=$this->security->xss_clean(trim($this->input->post("shipping_pin_code")));
		$shipping_address=$this->security->xss_clean(trim($this->input->post("shipping_address")));		
		
		$billing_name=$this->security->xss_clean(trim($this->input->post("billing_name")));
		$billing_mobile=$this->security->xss_clean(trim($this->input->post("billing_mobile")));
		$billing_email=$this->security->xss_clean(trim($this->input->post("billing_email")));
		$billing_country=$this->security->xss_clean(trim($this->input->post("billing_country")));
		$billing_state=$this->security->xss_clean(trim($this->input->post("billing_state")));
		$billing_city=$this->security->xss_clean(trim($this->input->post("billing_city")));
		$billing_pin_code=$this->security->xss_clean(trim($this->input->post("billing_pin_code")));
		$billing_address=$this->security->xss_clean(trim($this->input->post("billing_address")));
		
		$ar=array();
		$ar['id']=0;
		$ar['shipping_name']=$shipping_name;
		$ar['shipping_mobile']=$shipping_mobile;
		$ar['shipping_email']=$shipping_email;
		$ar['shipping_country']=$shipping_country;
		$ar['shipping_state']=$shipping_state;
		$ar['shipping_city']=$shipping_city;
		$ar['shipping_pin_code']=$shipping_pin_code;
		$ar['shipping_address']=$shipping_address;
		
		$ar['billing_name']=$billing_name;
		$ar['billing_mobile']=$billing_mobile;
		$ar['billing_email']=$billing_email;
		$ar['billing_country']=$billing_country;
		$ar['billing_state']=$billing_state;
		$ar['billing_city']=$billing_city;
		$ar['billing_pin_code']=$billing_pin_code;
		$ar['billing_address']=$billing_address;
		
		$ar['add_date']=date("Y-m-d");
		$ar['status']='True';
		
		$add=$this->user_model->address_add($ar);
		
		if($add)
		{
		
			$this->session->set_flashdata('success', 'Address has been successfully added');
			redirect("account/user/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/user/index");
		}
		
	}
	
	
	
	
}
?>