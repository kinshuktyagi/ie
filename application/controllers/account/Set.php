<?php
class set extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/set_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Set List';
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
		$data_arr=$this->set_model->index($offset, $show_per_page);
				
		$data['data'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/set/index');
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
		
		$this->load->view("account/set_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/set/index");
	}
	
	//Going to add Set...
	public function add()
	{
		$data['title']='Add Set';
		$this->admin_header($data);	
		$role=$this->set_model->get_role_list();
		$data['role']=$role;
		$this->load->view("account/add_set",$data);
		$this->admin_footer($data);
	}
	
	//Going to add Set...
	public function add_set()
	{
		$set_name=$this->security->xss_clean(trim($this->input->post("set_name")));		
		$description=$this->security->xss_clean($this->input->post("description"));
		$permission=$this->security->xss_clean($this->input->post("permission"));
		
		
		$role_ar=array();
		$role_ar['set_id']=0;
		$role_ar['set_name']=$set_name;
		$role_ar['description']=$description;
		$role_ar['add_date']=date("Y-m-d");
		$role_ar['status']='True';
		$add=$this->set_model->add_set($role_ar);
		if(sizeof($permission)>0)
		{
			for($i=0;$i<sizeof($permission);$i++)
			{
				$ex=explode("-",$permission[$i]);
				
				$permission_ar=array();
				$permission_ar['action_id']=0;
				$permission_ar['set_id']=$add;
				$permission_ar['role_id']=$ex[0];
				$permission_ar['permission_id']=$ex[1];
				$this->set_model->add_set_permission($permission_ar);
			}
		}
		if($add)
		{
			$this->session->set_flashdata('success', 'Set has been successfully added.');
			redirect("account/set/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/set/index");
		}
	}
	
	
	//Going to disable Set...
	public function disable()
	{
		$set_id=$this->security->xss_clean(trim($_REQUEST['set_id']));
		$ar=array('status'=>'False');
		$update=$this->set_model->update($ar,$set_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Set has been successfully disabled.');
			redirect("account/set/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/set/index");
		}
	}
	//Going to enable Set...
	public function enable()
	{
		$set_id=$this->security->xss_clean(trim($_REQUEST['set_id']));
		$ar=array('status'=>'True');
		$update=$this->set_model->update($ar,$set_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Set has been successfully enabled.');
			redirect("account/set/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/set/index");
		}
	}
	
	
	//Going to manage Set...
	public function manage()
	{
		$data['title']='Manage Set';
		$set_id=$this->security->xss_clean(trim($_REQUEST['set_id']));
		
		$info=$this->set_model->get_set_info($set_id);
		
		$this->admin_header($data);	
		$role=$this->set_model->get_role_list();
		$data['role']=$role;
		$data['info']=$info;
		$this->load->view("account/manage_set",$data);
		$this->admin_footer($data);
	}
	
	
	//Going to update Set...
	public function update_set()
	{
		$set_id=$this->security->xss_clean(trim($this->input->post("set_id")));
		$set_name=$this->security->xss_clean(trim($this->input->post("set_name")));
		
		$description=$this->security->xss_clean($this->input->post("description"));
		$permission=$this->security->xss_clean($this->input->post("permission"));
		
		
		$role_ar=array();
		$role_ar['set_name']=$set_name;
		$role_ar['description']=$description;
		$role_ar['modify_date']=date("Y-m-d");
		
		$add=$this->set_model->update($role_ar,$set_id);
		$this->set_model->delete_old_Set_permission($set_id);
		if(sizeof($permission)>0)
		{
			for($i=0;$i<sizeof($permission);$i++)
			{
				$ex=explode("-",$permission[$i]);
				
				$permission_ar=array();
				$permission_ar['action_id']=0;
				$permission_ar['set_id']=$set_id;
				$permission_ar['role_id']=$ex[0];
				$permission_ar['permission_id']=$ex[1];
				$this->set_model->add_set_permission($permission_ar);
			}
		}
		if($add)
		{
			$this->session->set_flashdata('success', 'Set has been successfully updated.');
			redirect("account/set/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/set/index");
		}
	}
}
?>