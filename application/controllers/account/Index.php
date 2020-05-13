<?php
class index extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/index_model");
	}
	
	public function index()
	{
		$data['title']='Dashboard';
		
		$this->admin_header($data);

		$this->load->view("account/index",$data);
		$this->admin_footer($data);
	}
	
	//Going to logout to user...
	public function logout()
	{
		$this->session->unset_userdata("user");
		redirect("login");
	}
	
	//Going to show user profile...
	public function profile()
	{
		$user = $this->session->userdata("user");
		/* echo"<pre>";
		print_r($user);
		exit(); */
		
		$data['title']='View Profile';
		$data['user']=$this->session->userdata("user");
		
		$this->admin_header($data);
		
		$dep=$this->index_model->get_user_department($user['id']);
		/*echo "<pre>";
		print_r($dep);
		exit();*/

		$data['dep']=$dep;
		$this->load->view("account/profile",$data);
		$this->admin_footer($data);
	} 
	
	//Going to manage user profile...
	public function manage_profile()
	{
		$data['title']='Manage Profile';
		$user=$this->session->userdata("user");
		/* echo $user['id'];
		
		exit(); */
		
		$this->admin_header($data);
		$country=$this->master_model->get_country();
		$info=$this->index_model->user_info($user['id']);
		$state_list=array();
		if($info['country'])
		{
			$state_list=$this->master_model->get_state($info['country']);
		}
		$data['country']=$country;
		$data['state_list']=$state_list;
		$data['info']=$info;
		
		$this->load->view("account/manage_profile",$data);
		$this->admin_footer($data);
	}

	//Going to update information...
	public function update_info()
	{
		$user=$this->session->userdata("user");
		$user_id=$this->security->xss_clean(trim($this->input->post("user_id")));
		$user_name=$this->security->xss_clean(trim($this->input->post("user_name")));
		$first_name=$this->security->xss_clean(trim($this->input->post("first_name")));
		$last_name=$this->security->xss_clean(trim($this->input->post("last_name")));
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		$email=$this->security->xss_clean(trim($this->input->post("email")));
		$country=$this->security->xss_clean(trim($this->input->post("country")));
		$state=$this->security->xss_clean(trim($this->input->post("state")));
		$city=$this->security->xss_clean(trim($this->input->post("city")));
		$join_date=$this->security->xss_clean(trim($this->input->post("join_date")));
		$address=$this->security->xss_clean(trim($this->input->post("address")));
		$gst=$this->security->xss_clean(trim($this->input->post("gst")));
		$pan=$this->security->xss_clean(trim($this->input->post("pan")));
		
		$bank_name=$this->security->xss_clean(trim($this->input->post("bank_name")));
		$bank_account_name=$this->security->xss_clean(trim($this->input->post("bank_account_name")));
		$bank_address=$this->security->xss_clean(trim($this->input->post("bank_address")));
		$bank_account_number=$this->security->xss_clean(trim($this->input->post("bank_account_number")));
		$ifsc_code=$this->security->xss_clean(trim($this->input->post("ifsc_code")));
		$pin_code=$this->security->xss_clean(trim($this->input->post("pin_code")));
		$business_name=$this->security->xss_clean(trim($this->input->post("business_name")));
		
				
		$profile_ar=array();
		$profile_ar['id']=$user['id'];
		$profile_ar['user_name']=$user_name;
		$profile_ar['user_type']=$user['user_type'];
		$profile_ar['first_name']=$first_name;
		$profile_ar['last_name']=$last_name;
		$profile_ar['mobile']=$mobile;
		$profile_ar['email']=$email;
		$profile_ar['country']=$user['country'];
		$profile_ar['profile_pic']=$user['profile_pic'];
		$profile_ar['user_type_name']=$user['user_type_name'];		
		
		$this->session->set_userdata("user",$profile_ar);
	
		$ar=array();
		$ar['user_name']=$user_name;
		$ar['first_name']=$first_name;
		$ar['last_name']=$last_name;
		$ar['mobile']=$mobile;
		$ar['email']=$email;
		$ar['country']=$country;
		$ar['state']=$state;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['gst']=$gst;
		$ar['pan']=$pan;
		$ar['bank_name']=$bank_name;
		$ar['bank_account_name']=$bank_account_name;
		$ar['bank_address']=$bank_address;
		$ar['bank_account_number']=$bank_account_number;
		$ar['pin_code']=$pin_code;
		$ar['business_name']=$business_name;
		$ar['ifsc_code']=$ifsc_code;
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->index_model->update($ar,$user_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Profile has been successfully updated.');
			redirect("account/index/manage_profile");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/index/manage_profile");
		}
	}
	
	//Going to change password...
	public function change_password()
	{
		$user=$this->session->userdata("user");
		$user_id=$user['id'];
		$password=$this->security->xss_clean(trim($this->input->post("password")));
		$con_password=$this->security->xss_clean(trim($this->input->post("con_password")));
		$password=$this->my_library->encrypt($con_password);
		
		$ar=array();
		$ar['password']=$password;
		$update_password=$this->index_model->update($ar,$user_id);
		if($update_password)
		{
			$this->session->set_flashdata('success', 'Password has been successfully changed.');
			redirect("account/index/profile");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/index/profile");
		}
	}
	 
	
	public function change_profile_picture()
	{
		$user=$this->session->userdata("user");		
		$user_id=$user['id'];
		
		if($_FILES['image_file']['name']!="")
		{
			$file=$_FILES['image_file']['name'];
			$extension=pathinfo($file,PATHINFO_EXTENSION);			
			$image_name=$user_id."image_file.".$extension;			
			
			$config['file_name'] = $image_name;
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '10332330';
			$config['max_width']  = '102334';
			$config['max_height']  = '763338';	
		
			$this->load->library('upload',$config);
				
			if (! $this->upload->do_upload('image_file'))
			{
				$this->session->set_flashdata('error', 'Please check your image type image type should be jif,jpg,png');
				redirect("account/index/profile");
			}
			else
			{					
				$this->load->library('image_lib');
			
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/'.$image_name;
				$config['new_image'] = './public/assets/profile_pic/'.$image_name;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 200;
				$config['height']   = 150;

				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$path="uploads/".$image_name;
				unlink($path);
			
				$ar=array();
				$ar['profile_pic']=$image_name;
					
				$update_password = $this->index_model->update($ar,$user_id);
				
				if($update_password)
				{
					
					$id = $user['department_list']['0']['id'];
					$admin_ar = array();
					$a = array();
					$b = array();
					
					$admin_ar['id']= $user['id'];
					$admin_ar['user_name']= $user['user_name'];
					$admin_ar['user_type']= $user['user_type'];
					$admin_ar['first_name']= $user['first_name'];
					$admin_ar['last_name']= $user['last_name'];
					$admin_ar['mobile']= $user['mobile'];
					$admin_ar['email']= $user['email'];
					$admin_ar['country']= $user['country'];
					$admin_ar['profile_pic']= $image_name;
					$admin_ar['user_type_name']= $user['user_type_name'];
					$admin_ar['designation_id']= $user['designation_id'];
					$admin_ar['priority']= $user['priority'];
					$admin_ar['designation_priority']= $user['designation_priority'];
					$admin_ar['department_name']= $user['department_name'];
					$admin_ar['report_to']= $user['report_to'];
					$admin_ar['designation_name']= $user['designation_name'];
							
						$ad_id = $user['department_list'][0]['id'];
						$ad_departemnet = $user['department_list'][0]['department_name'];
						$ad_desgination_name = $user['department_list'][0]['designation_name'];
						$ad_status = $user['department_list'][0]['status'];
						$ad_default = $user['department_list'][0]['is_default'];
						$ad_report_to = $user['department_list'][0]['report_to'];
							
						$a['id'] = $ad_id;
						$a['department_name'] = $ad_departemnet;
						$a['designation_name'] = $ad_desgination_name;
						$a['status'] = $ad_status;
						$a['is_default'] = $ad_default;
						$a['report_to'] = $ad_report_to;						
						$b[0] = $a;
					$admin_ar['department_list'] = $b;
					$admin_ar['department_id']= $user['department_id'];
										
					$this->session->set_userdata("user",$admin_ar);
					$this->session->set_flashdata('success', 'Profile picture has been successfully changed.');
					redirect("account/index/profile");
				}
				else
				{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/index/profile");
				} 
			}		
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/index/profile");
		}
	}
	
	//Fetching country list...
	public function check_username()
	{
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		
		$user_info=$this->index_model->check_user_name($mobile);
		if(sizeof($user_info)>0)
		{
			echo'False';
		}
		else
		{
			echo'True';
		}
	}

	public function make_default_department()
	{
		$department_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$user=$this->session->userdata("user");
		$user_id=$user['id'];		
		$this->load->model("account/index_model");
		$result = $this->index_model->update_user_department($user_id,$department_id);
		if($result)
		{
			redirect("account/index/profile");
		}
 
		
	}
	

}
?>