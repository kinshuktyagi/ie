<?php
class Storage_type extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/storage_type_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Storage Type List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit(); */
			
			$sy_name=$this->security->xss_clean(trim($this->input->post("sy_name")));
			$sy_description=$this->security->xss_clean(trim($this->input->post("sy_description")));
			$sy_status=$this->security->xss_clean(trim($this->input->post("sy_status")));
			$sy_add_date=$this->security->xss_clean(trim($this->input->post("sy_add_date")));
			$sy_modify_date=$this->security->xss_clean(trim($this->input->post("sy_modify_date")));
			
			$filter['sy_name']=$sy_name;
			$filter['sy_description']=$sy_description;
			$filter['sy_status']=$sy_status;
			if($sy_add_date!='') {
				$filter['sy_add_date']= date("Y-m-d", strtotime($sy_add_date));
			}else{
				$filter['sy_add_date']= '';
			}			
			if($sy_modify_date!='') {
				$filter['sy_modify_date']= date("Y-m-d", strtotime($sy_modify_date));
			}else{
				$filter['sy_modify_date']= '';
			}
			$this->session->set_userdata("search",$filter);
		}
		
		$show_per_page = 50;
		$data_arr  	   = $this->storage_type_model->index($offset, $show_per_page);
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/storage_type/index');
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
		
		$this->load->view("account/storage_type_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Storage Type...
	public function add_storage_type()
	{
		$data['title']='Add Storage Type';
		$this->admin_header($data);
		$this->load->view("account/add_storage_type",$data);
		$this->admin_footer($data);
	}


	//Going to add Storage Type...
	public function add()
	{
		$storage_type_name = $this->security->xss_clean(trim($this->input->post("storage_type_name")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['storage_type_name']= $storage_type_name;
		$ar['description']= $description;
		$ar['add_date']= date("Y-m-d");
		$ar['status']= 'True';
		
		$add=$this->storage_type_model->add_storage_type($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Storage Type has been successfully added');
			redirect("account/storage_type/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/storage_type/index");
		}
	}
	
	//Going to manage Storage Type...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Department';
		$this->admin_header($data);		
		$info = $this->storage_type_model->storage_type_info($id);
		$data['info']=$info;
		$this->load->view("account/manage_storage_type_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Storage Type..
	public function update_storage_type()
	{
		$id = $this->security->xss_clean(trim($this->input->post("storage_id")));		
		$storage_type_name=$this->security->xss_clean(trim($this->input->post("storage_type_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['storage_type_name']=$storage_type_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");
		$update=$this->storage_type_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Storage information has been successfully updated.');
			redirect("account/storage_type/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/storage_type/index");
		}
	}
	
	// Going To Disable Storage Type..
	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->storage_type_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Storage Type has been successfully updated.');
			redirect("account/storage_type/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/storage_type/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/storage_type/index");
	}

	//Going to enable Storage Type...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->storage_type_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Storage Type has been successfully enabled.');
			redirect("account/storage_type/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/storage_type/index");
		}
	}
}
?>