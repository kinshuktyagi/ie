<?php
class Enquiry_followup extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/enquiry_followup_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Followup List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$flp_first_name=$this->security->xss_clean(trim($this->input->post("flp_first_name")));
			$flp_compny_name=$this->security->xss_clean(trim($this->input->post("flp_compny_name")));
			$flp_order_type=$this->security->xss_clean(trim($this->input->post("flp_order_type")));
			$flp_email=$this->security->xss_clean(trim($this->input->post("flp_email")));
			$flp_phone=$this->security->xss_clean(trim($this->input->post("flp_phone")));
			
			$filter['flp_first_name']=$flp_first_name;
			$filter['flp_compny_name']=$flp_compny_name;
			$filter['flp_order_type']=$flp_order_type;
			$filter['flp_email']=$flp_email;
			$filter['flp_phone']=$flp_phone;			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->enquiry_followup_model->index($offset, $show_per_page);
		$data['enquiry_flp'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/enquiry_followup/index');
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
		
		$this->load->view("account/enquiry_followup_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Followup...
	public function followup()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['enquiry_id']));
		$data['title']='Add Followup';
		$data['enq_data'] =  $this->enquiry_followup_model->get_enquiry($enquiry_id);
		$data['enq_flp'] =  $this->enquiry_followup_model->get_enquiry_followup($enquiry_id);
		$data['followup_action'] =  $this->enquiry_followup_model->get_followup_action();
		$this->admin_header($data);
		$this->load->view("account/add_enquiry_followup",$data);
		$this->admin_footer($data);
	}


	//Going to add Followup...
	public function add()
	{		
		$flp_action = $this->security->xss_clean(trim($this->input->post("flp_action")));
		$next_followup_date= $this->security->xss_clean(trim($this->input->post("next_followup_date")));		
		$comment= $this->security->xss_clean(trim($this->input->post("comment")));		
		$added_by= $this->security->xss_clean(trim($this->input->post("added_by")));		
		$enquiry_id= $this->security->xss_clean(trim($this->input->post("enquiry_id")));		
		$department= $this->security->xss_clean(trim($this->input->post("department")));		
		
		if($flp_action == 3)
		{
			$followup_status = 3;
		}
		elseif($flp_action == 4)
		{
			$followup_status = 4;
			$enquiry_followup_status = 'False';
		}else{
			$followup_status = 2;
			$enquiry_followup_status = 'False';
		}		
		
		$ar=array();
		$ar['id']=0;
		$ar['followup_action'] = $flp_action;
		$ar['next_followup_date'] = date('Y-m-d', strtotime($next_followup_date));
		$ar['followup_comment'] = $comment;
		$ar['added_by'] = $added_by;
		$ar['enquiry_id'] = $enquiry_id;
		$ar['department'] = $department;		
		$ar['add_date'] = date("Y-m-d");
		$ar['followup_status'] = $followup_status;
		
		$add=$this->enquiry_followup_model->add_followup($ar);
		if($add)
		{
			if($enquiry_followup_status == 'False')
			{
				$update = $this->enquiry_followup_model->update_enquiry_followup_status($enquiry_followup_status,$enquiry_id);
			
				if($update)
				{
					$this->session->set_flashdata('success', 'Followup has been successfully added');
					redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
				}else{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
				}				
				
			}
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
		}
	}
	
	//Going to manage Followup...
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
	
	//Going to Update Followup..
	public function update_enquiry_followup()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$flp_action = $this->security->xss_clean(trim($this->input->post("flp_action")));
		$next_followup_date= $this->security->xss_clean(trim($this->input->post("next_followup_date")));		
		$comment= $this->security->xss_clean(trim($this->input->post("comment")));		
		$added_by= $this->security->xss_clean(trim($this->input->post("added_by")));		
		$enquiry_id= $this->security->xss_clean(trim($this->input->post("enquiry_id")));		
		$department= $this->security->xss_clean(trim($this->input->post("department")));		
		$followup_id= $this->security->xss_clean(trim($this->input->post("followup_id")));		
		
		$ar=array();
		$ar['followup_action'] = $flp_action;
		$ar['next_followup_date'] = date('Y-m-d', strtotime($next_followup_date));
		$ar['followup_comment'] = $comment;
		$ar['added_by'] = $added_by;
		$ar['enquiry_id'] = $enquiry_id;
		$ar['department'] = $department;
		$ar['modify_date']=date("Y-m-d");		
		$update=$this->enquiry_followup_model->update_followup($ar,$followup_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Followup information has been successfully updated.');
			redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/enquiry_followup/followup?enquiry_id=$enquiry_id");
		}
	}
	
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/enquiry_followup/index");
	}

	
}
?>