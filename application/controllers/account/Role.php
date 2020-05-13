<?php
class role extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/role_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Role List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$role_name=$this->security->xss_clean(trim($this->input->post("role_name")));
			$description=$this->security->xss_clean(trim($this->input->post("description")));
			$status=$this->security->xss_clean(trim($this->input->post("status")));
			
			$filter['role_role_name']=$role_name;
			$filter['role_description']=$description;
			$filter['role_status']=$status;
			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page=50;
		$data_arr=$this->role_model->index($offset, $show_per_page);
				
		$data['data'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/role/index');
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
		
		$this->load->view("account/role_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/role/index");
	}
	
	//Going to add role...
	public function add()
	{
		$data['title']='Add Role';
		$this->admin_header($data);	
		$permission=$this->role_model->get_permission_list();
		$data['permission']=$permission;
		$this->load->view("account/add_role",$data);
		$this->admin_footer($data);
	}
	
	//Going to add role...
	public function add_role()
	{
		$role_name=$this->security->xss_clean(trim($this->input->post("role_name")));
		$permision=$this->security->xss_clean($this->input->post("permision"));
		$description=$this->security->xss_clean(trim($this->input->post("description")));
		
		
		$role_ar=array();
		$role_ar['role_id']=0;
		$role_ar['role_name']=$role_name;
		$role_ar['description']=$description;
		$role_ar['add_date']=date("Y-m-d");
		$role_ar['status']='True';
		$add=$this->role_model->add_role($role_ar);
		if(sizeof($permision)>0)
		{
			for($i=0;$i<sizeof($permision);$i++)
			{
				$permission_ar=array();
				$permission_ar['perm_id']=0;
				$permission_ar['role_id']=$add;
				$permission_ar['permission_id']=$permision[$i];
				$this->role_model->add_permission($permission_ar);
			}
		}
		if($add)
		{
			$this->session->set_flashdata('success', 'Role has been successfully added.');
			redirect("account/role/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/role/index");
		}
	}
	
	
	//Going to disable contract...
	public function disable()
	{
		$role_id=$this->security->xss_clean(trim($_REQUEST['role_id']));
		$ar=array('status'=>'False');
		$update=$this->role_model->update($ar,$role_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Role has been successfully disabled.');
			redirect("account/role/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/role/index");
		}
	}
	
	//Going to enable contract...
	public function enable()
	{
		$role_id=$this->security->xss_clean(trim($_REQUEST['role_id']));
		$ar=array('status'=>'True');
		$update=$this->role_model->update($ar,$role_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Role has been successfully enabled.');
			redirect("account/role/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/role/index");
		}
	}
	
	
	//Going to manage role...
	public function manage()
	{
		$data['title']='Manage Role';
		$role_id=$this->security->xss_clean(trim($_REQUEST['role_id']));
		$this->admin_header($data);	
		$permission=$this->role_model->get_permission_list();
		
		$info=$this->role_model->get_role_info($role_id);
		
		$data['info']=$info;
		$data['permission']=$permission;
		$this->load->view("account/manage_role",$data);
		$this->admin_footer($data);
	}
	
	
	//Going to update role...
	public function update_role()
	{
		$role_id=$this->security->xss_clean(trim($this->input->post("role_id")));
		$role_name=$this->security->xss_clean(trim($this->input->post("role_name")));
		$permision=$this->security->xss_clean($this->input->post("permision"));
		$description=$this->security->xss_clean(trim($this->input->post("description")));
		
		
		$role_ar=array();
		$role_ar['role_name']=$role_name;
		$role_ar['description']=$description;
		$role_ar['modify_date']=date("Y-m-d");
		$add=$this->role_model->update($role_ar,$role_id);
		
		$this->role_model->delete_old_permission($role_id);
		if(sizeof($permision)>0)
		{
			for($i=0;$i<sizeof($permision);$i++)
			{
				$permission_ar=array();
				$permission_ar['perm_id']=0;
				$permission_ar['role_id']=$role_id;
				$permission_ar['permission_id']=$permision[$i];
				$this->role_model->add_permission($permission_ar);
			}
		}
		if($add)
		{
			$this->session->set_flashdata('success', 'Role has been successfully updated.');
			redirect("account/role/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/role/index");
		}
	}
}
?>