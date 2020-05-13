<?php
class Sub_category extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/sub_category_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Sub Category List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$r_cat_name=$this->security->xss_clean(trim($this->input->post("r_cat_name")));
			$r_sb_cat_name=$this->security->xss_clean(trim($this->input->post("r_sb_cat_name")));
			$r_sub_cat_description=$this->security->xss_clean(trim($this->input->post("r_sub_cat_description")));
			$r_sub_cat_status=$this->security->xss_clean(trim($this->input->post("r_sub_cat_status")));
			
			$filter['r_cat_name']=$r_cat_name;
			$filter['r_sb_cat_name']=$r_sb_cat_name;
			$filter['r_sub_cat_description']=$r_sub_cat_description;
			$filter['r_sub_cat_status']=$r_sub_cat_status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->sub_category_model->index($offset, $show_per_page);
				
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/sub_category/index');
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
		
		$this->load->view("account/sub_category_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Sub category...
	public function add_sub_category()
	{
		$data['title']='Add Sub Category';
		$this->admin_header($data);
		$product_cat = $this->sub_category_model->get_category();
		$product_sub_cat_field = $this->sub_category_model->get_pro_sub_cat_field();
		$data['product_sub_cat_field']=$product_sub_cat_field;
		$data['product_cat']=$product_cat;
		$this->load->view("account/add_sub_category",$data);
		$this->admin_footer($data);
	}


	//Going to add Sub Category...
	public function add()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */

		$category = $this->security->xss_clean(trim($this->input->post("category")));
		$sub_cat_name = $this->security->xss_clean(trim($this->input->post("sub_cat_name")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
				
		
		$ar=array();
		$ar['id']=0;
		$ar['category'] = $category;
		$ar['sub_cat_name'] = $sub_cat_name;
		$ar['description'] = $description;		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] 	= 'True';
		
		$add=$this->sub_category_model->add_sub_category($ar);
		if($add)
		{
			$fields = $this->security->xss_clean(($this->input->post("fields")));
			if(sizeof($fields)>0)
			{
				$arr= array();
				for($j=0; sizeof($fields)>$j; $j++ )
				{
					$arr['sub_field_id']=0;
					$arr['sub_category_id'] = $add;
					$arr['field_id'] = $fields[$j];
					
					$add_field=$this->sub_category_model->add_sub_cat_field($arr);
					if(!$add_field)
					{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/sub_category/index");
					}
				}				
			}			
			$this->session->set_flashdata('success', 'Sub Category has been successfully added');
			redirect("account/sub_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/sub_category/index");
		}
	}
	
	//Going to manage Sub Category...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Sub Category';
		$this->admin_header($data);
		$product_sub_cat_field = $this->sub_category_model->get_pro_sub_cat_field();
		$data['product_sub_cat_field']=$product_sub_cat_field;
		$product_cat = $this->sub_category_model->get_category();
		$data['product_cat']=$product_cat;		
		$info = $this->sub_category_model->category_info($id);
		$data['info']=$info;
		$field_info = $this->sub_category_model->sub_cat_selcted_field($id);
		$data['field_info']=$field_info;
		$this->load->view("account/manage_sub_category_info",$data);
		$this->admin_footer($data);
	}

	public function update_sub_category()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$cat_id = $this->security->xss_clean(trim($this->input->post("cat_id")));
		$category=$this->security->xss_clean(trim($this->input->post("category")));
		$sub_cat_name=$this->security->xss_clean(trim($this->input->post("sub_cat_name")));
		$description=$this->security->xss_clean(trim($this->input->post("description")));		
		
		$ar=array();
		$ar['category']=$category;
		$ar['sub_cat_name']=$sub_cat_name;
		$ar['description']=$description;		
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->sub_category_model->update($ar,$cat_id);
		if($update)
		{
			$fields=$this->security->xss_clean(($this->input->post("fields")));
			if(sizeof($fields)>0)
			{
				$delete = $this->sub_category_model->delete_sub_cat_field($cat_id);
				if($delete)
				{
					$arr= array();
					for($j=0; sizeof($fields)>$j; $j++ )
					{
						$arr['sub_field_id']=0;
						$arr['sub_category_id'] = $cat_id;
						$arr['field_id'] = $fields[$j];
						
						$add_field=$this->sub_category_model->add_sub_cat_field($arr);
						if(!$add_field)
						{
							$this->session->set_flashdata('error', 'Something is problem please try again.');
							redirect("account/sub_category/index");
						}
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/sub_category/index");
				}	
			}
			
			$this->session->set_flashdata('success', 'Sub Category information has been successfully updated.');
			redirect("account/sub_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/sub_category/index");
		}
	}

	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));

		$ar=array('status'=>'False');
		$update=$this->sub_category_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Sub Category has been successfully updated.');
			redirect("account/sub_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/sub_category/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/sub_category/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->sub_category_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Sub Category has been successfully enabled.');
			redirect("account/sub_category/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/sub_category/index");
		}
	}
}
?>