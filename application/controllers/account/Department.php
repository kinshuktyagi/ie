<?php
class Department extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/department_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Department List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$department_name=$this->security->xss_clean(trim($this->input->post("dep_department_name")));
			$department_description=$this->security->xss_clean(trim($this->input->post("dep_department_description")));
			$dep_department_status=$this->security->xss_clean(trim($this->input->post("dep_department_status")));
			$dep_add_date=$this->security->xss_clean(trim($this->input->post("dep_add_date")));
			$dep_modify_date=$this->security->xss_clean(trim($this->input->post("dep_modify_date")));
			
			$filter['dep_department_name']=$department_name;
			$filter['dep_department_description']=$department_description;
			$filter['dep_department_status']=$dep_department_status;
			//$filter['dep_add_date']= date("Y-m-d", strtotime($dep_add_date));
			$filter['dep_add_date']= $dep_add_date;
			$filter['dep_modify_date']=$dep_modify_date;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->department_model->index($offset, $show_per_page);
		
		//$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/department/index');
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
		//$data['user_type'] =  $user_type;
		//$data['team'] =  $team;
		
		$this->load->view("account/department_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_department()
	{
		$data['title']='Add Department';
		$this->admin_header($data);
		$this->load->view("account/add_department",$data);
		$this->admin_footer($data);
	}


	//Going to add Department...
	public function add()
	{
		$department_name = $this->security->xss_clean(trim($this->input->post("department_name")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['department_name']  = $department_name;
		$ar['description'] 		= $description;
		
		$ar['add_date'] 		= date("Y-m-d");
		$ar['status'] 			= 'True';
		
		$add=$this->department_model->add_department($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Department has been successfully added');
			redirect("account/department/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/department/index");
		}
	}
	
	//Going to manage Department...
	public function manage()
	{
		$dept=$this->security->xss_clean(trim($_REQUEST['dept']));
		$data['title']='Manage Department';
		$this->admin_header($data);		
		$info = $this->department_model->department_info($dept);
		$data['info']=$info;
		$this->load->view("account/manage_department_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Department..
	public function update_department()
	{
		$dsg_id = $this->security->xss_clean(trim($this->input->post("dept_id")));		
		$department_name=$this->security->xss_clean(trim($this->input->post("department_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['department_name']=$department_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");		
		$update=$this->department_model->update($ar,$dsg_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Department information has been successfully updated.');
			redirect("account/department/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/department/index");
		}
	}
	
	// Going To Disable Department..
	public function disable()
	{
		$dept_id=$this->security->xss_clean(trim($_REQUEST['dept']));
		$ar=array('status'=>'False');
		$update=$this->department_model->update($ar,$dept_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Department has been successfully updated.');
			redirect("account/department/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/department/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/department/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$dept=$this->security->xss_clean(trim($_REQUEST['dept']));
		$ar=array('status'=>'True');
		$update=$this->department_model->update($ar,$dept);
		if($update)
		{
			$this->session->set_flashdata('success', 'Department has been successfully enabled.');
			redirect("account/department/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/department/index");
		}
	}
}
?>