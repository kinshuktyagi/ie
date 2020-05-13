<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class index extends My_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("index_model");
		$this->load->model("account/team_model");
	}
	
	public function index()
	{
		redirect('login');
	}
	public function login()
	{
		if($this->session->userdata("user"))
		{
			redirect("account");
		}else{
			$data['title']='Login To Your Account';		
			$this->load->view('login',$data);
		}		
		/* $data['title']='Login To Your Account';		
		$this->load->view('login',$data); */
	}
	
	//Going to login to user...
	public function login_info()
	{
		$username=$this->security->xss_clean(trim($this->input->post("username")));
		$password=$this->security->xss_clean(trim($this->input->post("password")));
		
		$password=$this->my_library->encrypt($password);
		/*echo $username;
		echo $password;*/
		/*exit();*/
		
		$info=$this->index_model->get_user_detail($username,$password);
		/* echo "<pre>";
		print_r($info);
		exit(); */
		
		if(sizeof($info)>0)
		{
			$log=array();
			$log['log_id']=0;
			$log['log_type']='Login';
			$log['user_id']=$info[0]['id'];
			$log['user_type']=$info[0]['user_type'];
			$log['log_des']='Mr. '.$info[0]['first_name']." ".$info[0]['last_name']." Loged in portal at "."".date("d-M-Y h:i:s A");
			$log['date']=date("Y-m-d h:i:s");
			
			if($info[0]['user_name']==$username && $info[0]['password']==$password)
			{
				$department_id = $this->index_model->get_user_department_id($info[0]['id']);			
				if(!$department_id && $info[0]['user_type']>1)
				{
					$this->session->set_flashdata('error', 'There is no department assigned to you please contact to Admin');
					redirect("login");
				}

				$ar=array();
				$ar['id']=$info[0]['id'];
				$ar['user_name']=$info[0]['user_name'];
				$ar['user_type']=$info[0]['user_type'];
				$ar['first_name']=$info[0]['first_name'];
				$ar['last_name']=$info[0]['last_name'];
				$ar['mobile']=$info[0]['mobile'];
				$ar['email']=$info[0]['email'];
				$ar['country']=$info[0]['countryName'];
				$ar['profile_pic']=$info[0]['profile_pic'];
				$ar['user_type_name']=$info[0]['user_type_name'];
				$ar['designation_id']=$info[0]['desg_id'];
				$ar['priority']=$info[0]['priority'];
				$ar['designation_priority']=$info[0]['desg_priority'];
				$ar['department_name']=$info[0]['department_name'];
				$ar['report_to']=$info[0]['report_to'];
				$ar['designation_name']=$info[0]['designation_name'];
				$ar['department_list']=$this->index_model->get_user_department($info[0]['id']);
				$ar['department_id']=$department_id;
				$this->session->set_userdata("user",$ar);				

				if(LOGS=='TRUE')
				{
					$this->index_model->add_log($log);
				}
				redirect("account");
			}
			
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Please check your Username and Password');
			redirect("login");
		}
	}



	
	
	
}
