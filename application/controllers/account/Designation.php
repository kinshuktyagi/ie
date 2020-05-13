<?php
class designation extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/designation_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Designation List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$ds_designation_name=$this->security->xss_clean(trim($this->input->post("ds_designation_name")));
			$ds_designation_priority=$this->security->xss_clean(trim($this->input->post("ds_designation_priority")));
			$ds_designation_description=$this->security->xss_clean(trim($this->input->post("ds_designation_description")));
			$dep_designation_status=$this->security->xss_clean(trim($this->input->post("dep_designation_status")));
			
			$filter['ds_designation_name']=$ds_designation_name;
			$filter['ds_designation_priority']=$ds_designation_priority;
			$filter['ds_designation_description']=$ds_designation_description;			
			$filter['dep_designation_status']=$dep_designation_status;			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page =50;
		$data_arr  		=	$this->designation_model->index($offset, $show_per_page);
		

	
		$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/designation/index');
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
		//$data['team'] =  $team;
		
		$this->load->view("account/designation_list",$data);
		$this->admin_footer($data);

	}

	//Going to add user...
	public function add_designation()
	{
		$data['title']='Add Designation';
		$this->admin_header($data);
		$this->load->view("account/add_designation",$data);
		$this->admin_footer($data);
	}


	//Going to add user...
	public function add()
	{
		$designation_name = $this->security->xss_clean(trim($this->input->post("designation_name")));
		$priority 		 = $this->security->xss_clean(trim($this->input->post("priority")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['designation_name']  = $designation_name;
		$ar['description'] 		= $description;
		$ar['priority'] 		= $priority;
		
		$ar['add_date'] 		= date("Y-m-d");
		$ar['status'] 			= 'True';
		
		$add=$this->designation_model->add_designation($ar);
		if($add)
		{
		
			$this->session->set_flashdata('success', 'Department has been successfully added');
			redirect("account/designation/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/designation/index");
		}
	}

	//Going to manage employee...
	public function manage()
	{
		$dsg=$this->security->xss_clean(trim($_REQUEST['dsg']));
		$data['title']='Manage Designation';
		$this->admin_header($data);		
		$info = $this->designation_model->designation_info($dsg);

		$data['info']=$info;
		$this->load->view("account/manage_designation_info",$data);
		$this->admin_footer($data);
	}

	public function update_designation()
	{
		$dsg_id = $this->security->xss_clean(trim($this->input->post("dsg_id")));		
		$designation_name=$this->security->xss_clean(trim($this->input->post("designation_name")));
		$priority=$this->security->xss_clean(trim($this->input->post("priority")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['designation_name']=$designation_name;
		$ar['priority']=$priority;
		$ar['description']=$description;
		
		
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->designation_model->update($ar,$dsg_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Designation information has been successfully updated.');
			redirect("account/designation/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/designation/index");
		}
	}

	public function disable()
	{
		$dsg_id=$this->security->xss_clean(trim($_REQUEST['dsg']));

		$ar=array('status'=>'False');
		$update=$this->designation_model->update($ar,$dsg_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Designation has been successfully updated.');
			redirect("account/designation/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/designation/index");
		}
	}

	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/designation/index");
	}
	
	//Going to enable Designation...
	public function enable()
	{
		$dept=$this->security->xss_clean(trim($_REQUEST['dsg']));

		$ar=array('status'=>'True');
		$update=$this->designation_model->update($ar,$dept);
		if($update)
		{
			$this->session->set_flashdata('success', 'Designation has been successfully enabled.');
			redirect("account/designation/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/designation/index");
		}
	}
	
	
}
?>