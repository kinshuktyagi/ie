<?php
class Uom extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/uom_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='UOM List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$um_name=$this->security->xss_clean(trim($this->input->post("um_name")));
			$um_description=$this->security->xss_clean(trim($this->input->post("um_description")));
			$um_add_date=$this->security->xss_clean(trim($this->input->post("um_add_date")));
			$um_modify_date=$this->security->xss_clean(trim($this->input->post("um_modify_date")));
			$um_status=$this->security->xss_clean(trim($this->input->post("um_status")));
			
			$filter['um_name']=$um_name;
			$filter['um_description']=$um_description;
			$filter['um_status']=$um_status;
			if($um_add_date!=''){
				$filter['um_add_date']= date("Y-m-d", strtotime($um_add_date));
			}else{
				$filter['um_add_date']= '';
			}
			if($um_modify_date!=''){
				$filter['um_modify_date']= date("Y-m-d", strtotime($um_modify_date));
			}else{
				$filter['um_modify_date']= '';
			}
		
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->uom_model->index($offset, $show_per_page);
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/uom/index');
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
		
		$this->load->view("account/uom_list",$data);
		$this->admin_footer($data);
	}

	//Going to add UOM...
	public function add_uom()
	{
		$data['title']='Add UOM';
		$this->admin_header($data);
		$this->load->view("account/add_uom",$data);
		$this->admin_footer($data);
	}


	//Going to add UOM...
	public function add()
	{		
		$uom_name = $this->security->xss_clean(trim($this->input->post("uom_name")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['uom_id']=0;
		$ar['uom_name'] = $uom_name;
		$ar['description'] = $description;
		$ar['add_date']= date("Y-m-d");
		$ar['status']= 'True';
		
		$add=$this->uom_model->add_uom($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'UOM has been successfully added');
			redirect("account/uom/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/uom/index");
		}
	}
	
	//Going to manage UOM...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage UOM';
		$this->admin_header($data);		
		$info = $this->uom_model->uom_info($id);
		$data['info']=$info;
		$this->load->view("account/manage_uom_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update UOM..
	public function update_uom()
	{
		$uom_id = $this->security->xss_clean(trim($this->input->post("uom_id")));		
		$uom_name=$this->security->xss_clean(trim($this->input->post("uom_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['uom_name']=$uom_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");		
		$update = $this->uom_model->update($ar,$uom_id);
		if($update){
			$this->session->set_flashdata('success', 'UOM information has been successfully updated.');
			redirect("account/uom/index");
		} else {
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/uom/index");
		}
	}
	
	// Going To Disable UOM..
	public function disable()
	{
		$uom_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->uom_model->update($ar,$uom_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'UOM has been successfully updated.');
			redirect("account/uom/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/uom/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/uom/index");
	}

	//Going to enable UOM...
	public function enable()
	{
		$uom_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->uom_model->update($ar,$uom_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'UOM has been successfully enabled.');
			redirect("account/uom/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/uom/index");
		}
	}
}
?>