<?php
class Tnc extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/tnc_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='TNC List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{			
			$tn_type=$this->security->xss_clean(trim($this->input->post("tn_type")));
			$tn_name=$this->security->xss_clean(trim($this->input->post("tn_name")));
			$tn_description=$this->security->xss_clean(trim($this->input->post("tn_description")));
			$tn_status=$this->security->xss_clean(trim($this->input->post("tn_status")));
			
			$filter['tn_type']=$tn_type;
			$filter['tn_name']=$tn_name;
			$filter['tn_description']=$tn_description;
			$filter['tn_status']=$tn_status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->tnc_model->index($offset, $show_per_page);
		
		//$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/tnc/index');
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
				
		$this->load->view("account/tnc_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_tnc()
	{
		$tnc_type=$this->tnc_model->get_tnc_type();
		$data['tnc_type']=$tnc_type;
		$data['title']='Add TNC';
		$this->admin_header($data);
		$this->load->view("account/add_tnc",$data);
		$this->admin_footer($data);
	}


	//Going to add Department...
	public function add()
	{
		$tnc_type = $this->security->xss_clean(trim($this->input->post("tnc_type")));
		$tnc_name = $this->security->xss_clean(trim($this->input->post("tnc_name")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['tnc_id']=0;
		$ar['tnc_type']  = $tnc_type;
		$ar['tnc_name']  = $tnc_name;
		$ar['description']= $description;
		
		$ar['add_date'] 		= date("Y-m-d");
		$ar['status'] 			= 'True';
		
		$add=$this->tnc_model->add_tnc($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'TNC has been successfully added');
			redirect("account/tnc/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tnc/index");
		}
	}
	
	//Going to manage Department...
	public function manage()
	{
		$tnc_type=$this->tnc_model->get_tnc_type();
		$tnc_id=$this->security->xss_clean(trim($_REQUEST['tnc_id']));
		$data['title']='Manage TNC';
		$this->admin_header($data);
		
		$info = $this->tnc_model->tnc_info($tnc_id);
		$data['info']=$info;
		$data['tnc_type']=$tnc_type;
		$this->load->view("account/manage_tnc_info",$data);
		$this->admin_footer($data);
	}

	public function update_tnc()
	{
		$tnc_id = $this->security->xss_clean(trim($this->input->post("tnc_id")));
		$tnc_type=$this->security->xss_clean(trim($this->input->post("tnc_type")));
		$tnc_name=$this->security->xss_clean(trim($this->input->post("tnc_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['tnc_type']=$tnc_type;
		$ar['tnc_name']=$tnc_name;
		$ar['description']=$description;
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->tnc_model->update($ar, $tnc_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'TNC information has been successfully updated.');
			redirect("account/tnc/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tnc/index");
		}
	}

	public function disable()
	{
		$tnc_id=$this->security->xss_clean(trim($_REQUEST['tnc_id']));

		$ar=array('status'=>'False');
		$update=$this->tnc_model->update($ar,$tnc_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'TNC has been successfully updated.');
			redirect("account/tnc/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tnc/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/tnc/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$tnc_id=$this->security->xss_clean(trim($_REQUEST['tnc_id']));
		$ar=array('status'=>'True');
		$update=$this->tnc_model->update($ar,$tnc_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'TNC has been successfully enabled.');
			redirect("account/tnc/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tnc/index");
		}
	}
}
?>