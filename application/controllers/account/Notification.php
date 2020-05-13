<?php
class Notification extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/notification_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Notification List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$ntc_user_type=$this->security->xss_clean(trim($this->input->post("ntc_user_type")));
			$ntc_department=$this->security->xss_clean(trim($this->input->post("ntc_department")));
			$ntc_name=$this->security->xss_clean(trim($this->input->post("ntc_name")));
			$ntc_end_date=$this->security->xss_clean(trim($this->input->post("ntc_end_date")));
			$ntc_description=$this->security->xss_clean(trim($this->input->post("ntc_description")));
			$ntc_status=$this->security->xss_clean(trim($this->input->post("ntc_status")));
			$ntc_email=$this->security->xss_clean(trim($this->input->post("ntc_email")));
			
			$filter['ntc_user_type']=$ntc_user_type;
			$filter['ntc_department']=$ntc_department;
			$filter['ntc_name']=$ntc_name;
			//$filter['ntc_end_date']= date('Y-m-d', strtotime($ntc_end_date));
			$filter['ntc_description']= $ntc_description;
			$filter['ntc_status']=$ntc_status;
			$filter['ntc_email']=$ntc_email;
			
			if($ntc_end_date!=='')
			{
				$filter['ntc_end_date']=date("Y-m-d", strtotime($ntc_end_date));
			}else{
				$filter['ntc_end_date']='';
			}
						
			$this->session->set_userdata("search",$filter);
		}
		
		$show_per_page = 50;
		$data_arr  	   = $this->notification_model->index($offset, $show_per_page);
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/notification/index');
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
		$this->load->view("account/notification_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Notification...
	public function add_notification()
	{
		$user_type=$this->master_model->get_user_type($_SESSION['user']['priority']);
		$department=$this->master_model->get_department();
		$data['title']='Add Notification';
		$data['department']=$department;
		$data['user_type']=$user_type;
		$this->admin_header($data);
		$this->load->view("account/add_notification",$data);
		$this->admin_footer($data);
	}


	//Going to add notification...
	public function add()
	{
		$user_type = $this->security->xss_clean(trim($this->input->post("user_type")));
		$department_id = $this->security->xss_clean(trim($this->input->post("department")));
		$notification_name = $this->security->xss_clean(trim($this->input->post("notification_name")));
		$end_date = $this->security->xss_clean(trim($this->input->post("end_date")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		$email_send = $this->security->xss_clean(trim($this->input->post("email_send")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['user_type']  = $user_type;
		$ar['department_id']  = $department_id;
		$ar['notification_name'] = $notification_name;
		$ar['end_date'] = date("Y-m-d", strtotime($end_date));
		$ar['email_send'] = $email_send;
		$ar['description']= $description;
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] 	= 'True';
		
		$add=$this->notification_model->add_notification($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Notification has been successfully added');
			redirect("account/notification/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/notification/index");
		}
	}
	
	//Going to manage Notification...
	public function manage()
	{
		$user_type=$this->master_model->get_user_type($_SESSION['user']['priority']);
		$noticn_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Notification';
		$this->admin_header($data);		
		$department=$this->master_model->get_department();
		$info = $this->notification_model->notification_info($noticn_id);
		$data['department']=$department;
		$data['user_type']=$user_type;
		$data['info']=$info;
		$this->load->view("account/manage_notification_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Notification..
	public function update_notification()
	{
		$notification_id = $this->security->xss_clean(trim($this->input->post("notification_id")));
		$department_id = $this->security->xss_clean(trim($this->input->post("department")));
		$user_type=$this->security->xss_clean(trim($this->input->post("user_type")));
		$notification_name=$this->security->xss_clean(trim($this->input->post("notification_name")));
		$end_date=$this->security->xss_clean(trim($this->input->post("end_date")));
		$email_send=$this->security->xss_clean(trim($this->input->post("email_send")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['user_type']=$user_type;
		$ar['department_id']=$department_id;
		$ar['notification_name']=$notification_name;
		$ar['end_date']=date("Y-m-d", strtotime($end_date));
		if($email_send =='True'){
			$ar['email_send']=$email_send;
		}else{
			$ar['email_send']= 'False';
		}
		$ar['description']=$description;
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->notification_model->update($ar,$notification_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Notification information has been successfully updated.');
			redirect("account/notification/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/notification/index");
		}
	}
	
	// Going To Disable Notification..
	public function disable()
	{
		$noticn_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->notification_model->update($ar,$noticn_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Notification has been successfully updated.');
			redirect("account/notification/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/notification/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/notification/index");
	}

	//Going to enable Notification...
	public function enable()
	{
		$noticn_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->notification_model->update($ar,$noticn_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Notification has been successfully enabled.');
			redirect("account/notification/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/notification/index");
		}
	}
}
?>