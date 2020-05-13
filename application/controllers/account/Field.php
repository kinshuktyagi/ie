<?php
class Field extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/field_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Field List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit(); */
			
			$f_field_name=$this->security->xss_clean(trim($this->input->post("f_field_name")));
			$f_field_description=$this->security->xss_clean(trim($this->input->post("f_field_description")));
			$f_field_status=$this->security->xss_clean(trim($this->input->post("f_field_status")));
			$f_add_date=$this->security->xss_clean(trim($this->input->post("f_add_date")));
			$f_modify_date=$this->security->xss_clean(trim($this->input->post("f_modify_date")));
			
			$filter['f_field_name']=$f_field_name;
			$filter['f_field_description']=$f_field_description;
			$filter['f_field_status']=$f_field_status;
			
			if($f_add_date != '')
			{
				$filter['f_add_date']= date("Y-m-d", strtotime($f_add_date));
			}else{
				$filter['f_add_date']= '';
			}
			if($f_modify_date != '')
			{
				$filter['f_modify_date']= date("Y-m-d", strtotime($f_modify_date));
			}else{
				$filter['f_modify_date']= '';
			}
		
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->field_model->index($offset, $show_per_page);
		
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
		
		$this->load->view("account/field_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_field()
	{
		$data['title']='Add Field';
		$this->admin_header($data);
		$this->load->view("account/add_field",$data);
		$this->admin_footer($data);
	}


	//Going to add Field...
	public function add()
	{
		$field_name = $this->security->xss_clean(trim($this->input->post("field_name")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['field_name']  = $field_name;
		$ar['description'] = $description;
		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] 	= 'True';
		
		$add=$this->field_model->add_field($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Field has been successfully added');
			redirect("account/field/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/field/index");
		}
	}
	
	//Going to manage Field...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Field';
		$this->admin_header($data);		
		$info = $this->field_model->field_info($id);
		$data['info']=$info;
		$this->load->view("account/manage_field_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Field..
	public function update_field()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$id = $this->security->xss_clean(trim($this->input->post("field_id")));		
		$field_name=$this->security->xss_clean(trim($this->input->post("field_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['field_name']=$field_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");		
		$update=$this->field_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Field information has been successfully updated.');
			redirect("account/field/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/field/index");
		}
	}
	
	// Going To Disable Field..
	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->field_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Field has been successfully updated.');
			redirect("account/field/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/field/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/field/index");
	}

	//Going to enable Field...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->field_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Field has been successfully enabled.');
			redirect("account/field/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/field/index");
		}
	}
}
?>