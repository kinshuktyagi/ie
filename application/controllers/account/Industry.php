<?php
class Industry extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/industry_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Department List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$ind_name=$this->security->xss_clean(trim($this->input->post("ind_name")));
			$ind_description=$this->security->xss_clean(trim($this->input->post("ind_description")));
			$ind_status=$this->security->xss_clean(trim($this->input->post("ind_status")));
			$ind_add_date=$this->security->xss_clean(trim($this->input->post("ind_add_date")));
			$ind_modify_date=$this->security->xss_clean(trim($this->input->post("ind_modify_date")));
			
			$filter['ind_name']=$ind_name;
			$filter['ind_description']=$ind_description;
			$filter['ind_status']=$ind_status;
			//$filter['dep_add_date']= date("Y-m-d", strtotime($dep_add_date));
			$filter['ind_add_date']= $ind_add_date;
			$filter['ind_modify_date']=$ind_modify_date;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->industry_model->index($offset, $show_per_page);
		
		//$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/industry/index');
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
		
		$this->load->view("account/industry_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Industry...
	public function add_industry()
	{
		$data['title']='Add Industry';
		$this->admin_header($data);
		$this->load->view("account/add_industry",$data);
		$this->admin_footer($data);
	}


	//Going to add Industry...
	public function add()
	{
		$industry_name = $this->security->xss_clean(trim($this->input->post("industry_name")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['industry_name'] = $industry_name;
		$ar['description'] 	= $description;		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] = 'True';
		
		$add=$this->industry_model->add_industry($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Industry has been successfully added');
			redirect("account/industry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/industry/index");
		}
	}
	
	//Going to manage Industry...
	public function manage()
	{
		$dept=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Industry';
		$this->admin_header($data);		
		$info = $this->industry_model->industry_info($dept);
		$data['info']=$info;
		$this->load->view("account/manage_industry_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Industry..
	public function update_industry()
	{
		$id = $this->security->xss_clean(trim($this->input->post("industry_id")));		
		$industry_name=$this->security->xss_clean(trim($this->input->post("industry_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['industry_name']=$industry_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");
		$update=$this->industry_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Industry information has been successfully updated.');
			redirect("account/industry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/industry/index");
		}
	}
	
	// Going To Disable Industry..
	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->industry_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Industry has been successfully updated.');
			redirect("account/industry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/industry/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/industry/index");
	}

	//Going to enable Industry...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->industry_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Industry has been successfully enabled.');
			redirect("account/industry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/industry/index");
		}
	}
}
?>