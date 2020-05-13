<?php
class Tax extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/tax_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Tax List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$tx_tax_name=$this->security->xss_clean(trim($this->input->post("tx_tax_name")));
			$tx_tax_type=$this->security->xss_clean(trim($this->input->post("tx_tax_type")));
			$tx_tax_value=$this->security->xss_clean(trim($this->input->post("tx_tax_value")));
			$tx_tax_description=$this->security->xss_clean(trim($this->input->post("tx_tax_description")));
			$tx_tax_status=$this->security->xss_clean(trim($this->input->post("tx_tax_status")));
			
			$filter['tx_tax_name']=$tx_tax_name;
			$filter['tx_tax_type']=$tx_tax_type;
			$filter['tx_tax_value']=$tx_tax_value;
			$filter['tx_tax_description']=$tx_tax_description;
			$filter['tx_tax_status']=$tx_tax_status;
			
			$this->session->set_userdata("search",$filter);
		}
		
		$show_per_page = 50;
		$data_arr  	   = $this->tax_model->index($offset, $show_per_page);
		
		//$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['tax'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/tax/index');
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
		
		$this->load->view("account/tax_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_tax()
	{
		$data['title']='Add Tax';
		$tax_type=$this->tax_model->get_tax_type();
		$data['tax_type'] = $tax_type;
		$this->admin_header($data);
		$this->load->view("account/add_tax",$data);
		$this->admin_footer($data);
	}


	//Going to add Department...
	public function add()
	{
		$tax_name = $this->security->xss_clean(trim($this->input->post("tax_name")));
		$tax_type = $this->security->xss_clean(trim($this->input->post("tax_type")));
		$tax_value = $this->security->xss_clean(trim($this->input->post("tax_value")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['tax_id']=0;
		$ar['tax_name']   = $tax_name;
		$ar['tax_type']	  = $tax_type;
		$ar['tax_value']  = $tax_value;
		$ar['description']= $description;
		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] 	= 'True';
		
		$add=$this->tax_model->add_tax($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Tax has been successfully added');
			redirect("account/tax/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tax/index");
		}
	}
	
	//Going to manage Tax...
	public function manage()
	{
		$tax_id=$this->security->xss_clean(trim($_REQUEST['tax_id']));
		$data['title']='Manage Tax';
		$this->admin_header($data);
		
		$info = $this->tax_model->tax_info($tax_id);
		$tax_type=$this->tax_model->get_tax_type();
		$data['tax_type']=$tax_type;
		$data['info']=$info;
		$this->load->view("account/manage_tax_info",$data);
		$this->admin_footer($data);
	}

	public function update_tax()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$tax_id = $this->security->xss_clean(trim($this->input->post("tax_id")));
		$tax_name=$this->security->xss_clean(trim($this->input->post("tax_name")));
		$tax_type=$this->security->xss_clean(trim($this->input->post("tax_type")));
		$tax_value=$this->security->xss_clean(trim($this->input->post("tax_value")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['tax_name']=$tax_name;
		$ar['tax_type']=$tax_type;
		$ar['tax_value']=$tax_value;
		$ar['description']=$description;
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->tax_model->update($ar,$tax_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Tax information has been successfully updated.');
			redirect("account/tax/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tax/index");
		}
	}

	public function disable()
	{
		$tax_id=$this->security->xss_clean(trim($_REQUEST['tax_id']));

		$ar=array('status'=>'False');
		$update=$this->tax_model->update($ar,$tax_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Tax has been successfully updated.');
			redirect("account/tax/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tax/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/tax/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$tax_id=$this->security->xss_clean(trim($_REQUEST['tax_id']));
		$ar=array('status'=>'True');
		$update=$this->tax_model->update($ar,$tax_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Tax has been successfully enabled.');
			redirect("account/tax/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/tax/index");
		}
	}
}
?>