<?php
class Raw_material_category extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/raw_material_category_model", "r_m_c_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Raw Material Category List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit();
			 */
			$rm_category_name=$this->security->xss_clean(trim($this->input->post("rm_category_name")));
			$rm_category_description=$this->security->xss_clean(trim($this->input->post("rm_category_description")));
			$rm_category_status=$this->security->xss_clean(trim($this->input->post("rm_category_status")));
			
			$filter['rm_category_name']=$rm_category_name;
			$filter['rm_category_description']=$rm_category_description;
			$filter['rm_category_status']=$rm_category_status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->r_m_c_model->index($offset, $show_per_page);
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/raw_material_category/index');
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
		
		$this->load->view("account/raw_material_category_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_raw_material_category()
	{
		$data['title']='Add Raw Material Category';
		$this->admin_header($data);
		$this->load->view("account/add_raw_material_category",$data);
		$this->admin_footer($data);
	}


	//Going to add Department...
	public function add()
	{
		$category_name = $this->security->xss_clean(trim($this->input->post("category_name")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['id']=0;
		$ar['raw_material_category_name']  = $category_name;
		$ar['description'] 		= $description;
		
		$ar['add_date'] 		= date("Y-m-d");
		$ar['status'] 			= 'True';
		
		$add=$this->r_m_c_model->add_category($ar);
		if($add)
		{		
			$this->session->set_flashdata('success', 'Department has been successfully added');
			redirect("account/raw_material_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/raw_material_category/index");
		}
	}
	
	//Going to manage Department...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Raw Material Category';
		$this->admin_header($data);
		
		$info = $this->r_m_c_model->category_info($id);

		$data['info']=$info;
		$this->load->view("account/manage_raw_material_category_info",$data);
		$this->admin_footer($data);
	}

	public function update_category()
	{
		// echo"<pre>";
		// print_r($_POST);
		// exit();
		
		$cat_id = $this->security->xss_clean(trim($this->input->post("cat_id")));
		$category_name=$this->security->xss_clean(trim($this->input->post("category_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['raw_material_category_name']=$category_name;
		$ar['description']=$description;		
		
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->r_m_c_model->update($ar,$cat_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Category information has been successfully updated.');
			redirect("account/raw_material_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/raw_material_category/index");
		}
	}

	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));

		$ar=array('status'=>'False');
		$update=$this->r_m_c_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Category has been successfully updated.');
			redirect("account/raw_material_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/raw_material_category/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/raw_material_category/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->r_m_c_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Category has been successfully enabled.');
			redirect("account/raw_material_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/raw_material_category/index");
		}
	}
}
?>