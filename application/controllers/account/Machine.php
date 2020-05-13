<?php
class Machine extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/machine_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Machine List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$mach_code=$this->security->xss_clean(trim($this->input->post("mach_code")));
			$mach_name=$this->security->xss_clean(trim($this->input->post("mach_name")));
			$mach_running_cost=$this->security->xss_clean(trim($this->input->post("mach_running_cost")));
			$mach_description=$this->security->xss_clean(trim($this->input->post("mach_description")));
			$mach_status=$this->security->xss_clean(trim($this->input->post("mach_status")));
			
			$filter['mach_code']=$mach_code;
			$filter['mach_name']=$mach_name;
			$filter['mach_running_cost']=$mach_running_cost;
			$filter['mach_description']=$mach_description;
			$filter['mach_status']=$mach_status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr = $this->machine_model->index($offset, $show_per_page);
				
		$data['machine'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/machine/index');
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
		$this->load->view("account/machine_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_machine()
	{
		$data['title']='Add Machine';
		$this->admin_header($data);
		$this->load->view("account/add_machine",$data);
		$this->admin_footer($data);
	}

	//Going to add Machine...
	public function add()
	{
		$machine_name = $this->security->xss_clean(trim($this->input->post("machine_name")));
		$running_cost = $this->security->xss_clean(trim($this->input->post("running_cost")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));
		$machine_code = $this->machine_model->generate_machine_code();
		
		$ar=array();
		$ar['machine_id']=0;
		$ar['machine_code'] = $machine_code;
		$ar['machine_name'] = $machine_name;
		$ar['running_cost'] = $running_cost;		
		$ar['description'] = $description;		
		$ar['add_date']	= date("Y-m-d");
		$ar['status'] = 'True';
		
		$add=$this->machine_model->add_machine($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Machine has been successfully added');
			redirect("account/machine/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/machine/index");
		}
	}
	
	//Going to manage Machine...
	public function manage()
	{
		$machine_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Machine';
		$this->admin_header($data);
		$info = $this->machine_model->machine_info($machine_id);
		$data['info']=$info;
		$this->load->view("account/manage_machine_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Machine..
	public function update_machine()
	{
		$machine_id = $this->security->xss_clean(trim($this->input->post("machine_id")));		
		$machine_name=$this->security->xss_clean(trim($this->input->post("machine_name")));
		$running_cost=$this->security->xss_clean(trim($this->input->post("running_cost")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['machine_name']=$machine_name;
		$ar['running_cost']=$running_cost;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");		
		$update=$this->machine_model->update($ar,$machine_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Machine information has been successfully updated.');
			redirect("account/machine/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/machine/index");
		}
	}
	
	// Going To Disable Machine..
	public function disable()
	{
		$machine_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->machine_model->update($ar,$machine_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Machine has been successfully updated.');
			redirect("account/machine/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/machine/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/machine/index");
	}

	//Going to enable Machine...
	public function enable()
	{
		$machine_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->machine_model->update($ar,$machine_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Machine has been successfully enabled.');
			redirect("account/machine/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/machine/index");
		}
	}
}
?>