<?php
class permission extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/permission_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Permission List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$permission_name=$this->security->xss_clean(trim($this->input->post("permission_name")));
			$description=$this->security->xss_clean(trim($this->input->post("description")));
			$status=$this->security->xss_clean(trim($this->input->post("status")));

			
			$filter['per_permission_name']=$permission_name;
			$filter['per_description']=$description;
			$filter['per_status']=$status;
			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page=50;
		$data_arr=$this->permission_model->index($offset, $show_per_page);
				
		$data['data'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/permission/index');
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
		
		$this->load->view("account/permission_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/permission/index");
	}
	
	//Going to Permission permission...
	public function add()
	{
		$data['title']='Add Permission';
		$this->admin_header($data);	

		$this->load->view("account/add_permission",$data);
		$this->admin_footer($data);
	}
	
	//Going to add Permission...
	public function add_permission()
	{
		$permission_name=$this->security->xss_clean(trim($this->input->post("permission_name")));
		$description=$this->security->xss_clean($this->input->post("description"));
		
		
		$permission_ar=array();
		$permission_ar['permission_id']=0;
		$permission_ar['permission_name']=$permission_name;
		$permission_ar['description']=$description;
		$permission_ar['add_date']=date("Y-m-d");
		$permission_ar['status']='True';
		$add=$this->permission_model->add_permission($permission_ar);

		if($add)
		{
			$this->session->set_flashdata('success', 'Permission has been successfully added.');
			redirect("account/permission/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/permission/index");
		}
	}
	
	
	//Going to disable contract...
	public function disable()
	{
		$permission_id=$this->security->xss_clean(trim($_REQUEST['permission_id']));
		$ar=array('status'=>'False');
		$update=$this->permission_model->update($ar,$permission_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Permission has been successfully disabled.');
			redirect("account/permission/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/permission/index");
		}
	}
	//Going to enable contract...
	public function enable()
	{
		$permission_id=$this->security->xss_clean(trim($_REQUEST['permission_id']));
		$ar=array('status'=>'True');
		$update=$this->permission_model->update($ar,$permission_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Permission has been successfully enabled.');
			redirect("account/permission/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/permission/index");
		}
	}
	
	
	//Going to manage permission...
	public function manage()
	{
		$data['title']='Manage Permission';
		$permission_id=$this->security->xss_clean(trim($_REQUEST['permission_id']));
		$this->admin_header($data);	
		
		$info=$this->permission_model->get_permission_info($permission_id);
		
		$data['info']=$info;
		$this->load->view("account/manage_permission",$data);
		$this->admin_footer($data);
	}
	
	
	//Going to update Permission...
	public function update_permission()
	{
		$permission_id=$this->security->xss_clean(trim($this->input->post("permission_id")));
		$permission_name=$this->security->xss_clean(trim($this->input->post("permission_name")));
		$description=$this->security->xss_clean($this->input->post("description"));
		
		$permission_ar=array();
		$permission_ar['permission_name']=$permission_name;
		$permission_ar['description']=$description;
		$permission_ar['modify_date']=date("Y-m-d");
		$add=$this->permission_model->update($permission_ar,$permission_id);

		if($add)
		{
			$this->session->set_flashdata('success', 'Permission has been successfully updated.');
			redirect("account/permission/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/permission/index");
		}
	}
}
?>