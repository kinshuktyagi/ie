<?php
class Product extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/product_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Product List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit(); */
			
			$pr_product_code=$this->security->xss_clean(trim($this->input->post("pr_product_code")));
			$pr_product_name=$this->security->xss_clean(trim($this->input->post("pr_product_name")));
			$pr_storage_type=$this->security->xss_clean(trim($this->input->post("pr_storage_type")));
						
			$pr_cat=$this->security->xss_clean(trim($this->input->post("pr_cat")));
			$pr_sub_cat=$this->security->xss_clean(trim($this->input->post("pr_sub_cat")));
			$pr_type=$this->security->xss_clean(trim($this->input->post("pr_type")));
			$pr_description=$this->security->xss_clean(trim($this->input->post("pr_description")));
			$pr_status=$this->security->xss_clean(trim($this->input->post("pr_status")));
			
			$filter['pr_product_code']=$pr_product_code;
			$filter['pr_product_name']=$pr_product_name;
			$filter['pr_storage_type']=$pr_storage_type;
			$filter['pr_cat']=$pr_cat;
			$filter['pr_sub_cat']=$pr_sub_cat;
			$filter['pr_type']=$pr_type;
			$filter['pr_description']=$pr_description;
			$filter['pr_status']=$pr_status;
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->product_model->index($offset, $show_per_page);
		
		//$user_type=$this->master_model->get_user_type();
		//$team=$this->master_model->get_team();	
				
		$data['product'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/product/index');
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
		$this->load->view("account/product_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Product...
	public function add_product()
	{
		$data['materials_info'] = $this->product_model->get_materials(6);
		$data['cutting_tip_info'] = $this->product_model->cutting_tip(13);
		$data['milling_tool_info'] = $this->product_model->milling_tool_type(16);
		$data['boring_tool_info'] = $this->product_model->boring_tool_type(17);
		$data['drilling_tool_info'] = $this->product_model->drilling_tool_type(18);
		$data['reaming_tool_info'] = $this->product_model->reaming_tool_type(19);
		$data['threading_tool_info'] = $this->product_model->threading_tool_type(20);
		$data['special_tool_info'] = $this->product_model->special_tool_type(21);
		$data['adapter_machine_side_info'] = $this->product_model->adapter_machine_side(22);
		$data['adapter_nose_info'] = $this->product_model->adapter_nose_type(23);
		$data['pull_stud_info'] = $this->product_model->pull_stud_type(24);
		$data['insert_shape_info'] = $this->product_model->insert_shape(30);
		
		if(isset($_REQUEST['sub_cat']))
		{			
			$sub_cat_id = $this->security->xss_clean(trim($_REQUEST['sub_cat']));
			$cat_id = $this->product_model->get_cat_id($sub_cat_id);
			$data['cat_id'] = $cat_id;
			$data['sub_cat_data']=$this->product_model->get_sub_category_field($sub_cat_id);
			$data['product_sub_cat'] = $this->product_model->sub_category($cat_id);
			$data['sub_cat_id'] = $sub_cat_id;
		}else{			
			$data['sub_cat_data'] = array();
			$data['product_sub_cat'] = array();
			$data['cat_id'] = '';
			$data['sub_cat_id'] = '';
		}
		
		
		$vendor = $this->product_model->get_vendor();
		$uom = $this->product_model->get_uom();
		$storage_type = $this->product_model->get_storage_type();
		$product_cat = $this->product_model->get_category();
		//$product_sub_cat = $this->product_model->get_sub_category();
		$fields = $this->product_model->get_all_fields();
		
		$data['title']='Add Product';
		$data['product_cat']=$product_cat;
		//$data['product_sub_cat']=$product_sub_cat;
		$data['vendor']=$vendor;
		$data['fields']=$fields;
		$data['uom']=$uom;
		$data['storage_type']=$storage_type;
		$this->admin_header($data);
		$this->load->view("account/add_product",$data);
		$this->admin_footer($data);
	}


	//Going to add Product...
	public function add()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$url = $this->security->xss_clean(trim($this->input->post("url")));
		$trash_hold = $this->security->xss_clean(trim($this->input->post("trash_hold")));
		$storage_type = $this->security->xss_clean(trim($this->input->post("storage_type")));
		$pro_category = $this->security->xss_clean(trim($this->input->post("pro_category")));
		
		
		$last_id = $this->product_model->generate_product_code();		
		if($storage_type == '1')
		{
			$product_code = sprintf("IE-01-%05d", $last_id)."";
		}
		else if($storage_type == '2')
		{
			$product_code = sprintf("IE-02-%05d", $last_id)."";
		}
		
		$hsn_code = $this->security->xss_clean(trim($this->input->post("hsn_code")));
		$pro_category = $this->security->xss_clean(trim($this->input->post("pro_category")));
		$pro_sub_category = $this->security->xss_clean(trim($this->input->post("pro_sub_category")));
		$pro_type = $this->security->xss_clean(trim($this->input->post("pro_type")));
		$trash_hold = $this->security->xss_clean(trim($this->input->post("trash_hold")));
		$storage_type = $this->security->xss_clean(trim($this->input->post("storage_type")));
		$product_name = $this->security->xss_clean(trim($this->input->post("product_name")));
		$uom = $this->security->xss_clean(trim($this->input->post("uom"))); 
		$dimension = $this->security->xss_clean(trim($this->input->post("dimension")));
		$stress_relieved = $this->security->xss_clean(trim($this->input->post("stress_relieved")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));
		
		$weight = $this->security->xss_clean(trim($this->input->post("weight")));
		$length = $this->security->xss_clean(trim($this->input->post("length")));
		$width = $this->security->xss_clean(trim($this->input->post("width")));
		$thickness = $this->security->xss_clean(trim($this->input->post("thickness")));
		$height = $this->security->xss_clean(trim($this->input->post("height")));
		$materials = $this->security->xss_clean(trim($this->input->post("materials")));
		$radius = $this->security->xss_clean(trim($this->input->post("radius")));
		$diameter = $this->security->xss_clean(trim($this->input->post("diameter")));
		$volume = $this->security->xss_clean(trim($this->input->post("volume")));
		$shank_length = $this->security->xss_clean(trim($this->input->post("shank_length")));
		$no_of_teeth = $this->security->xss_clean(trim($this->input->post("no_of_teeth")));
		$cutting_radius = $this->security->xss_clean(trim($this->input->post("cutting_radius")));
		$cutting_tip = $this->security->xss_clean(trim($this->input->post("cutting_tip")));
		$thread_diameter = $this->security->xss_clean(trim($this->input->post("thread_diameter")));
		$thread_pitch = $this->security->xss_clean(trim($this->input->post("thread_pitch")));
		$milling_tool_type = $this->security->xss_clean(trim($this->input->post("milling_tool_type")));
		$boring_tool_type = $this->security->xss_clean(trim($this->input->post("boring_tool_type")));
		$drilling_tool_type = $this->security->xss_clean(trim($this->input->post("drilling_tool_type")));
		$reaming_tool_type = $this->security->xss_clean(trim($this->input->post("reaming_tool_type")));
		$threading_tool_type = $this->security->xss_clean(trim($this->input->post("threading_tool_type")));
		$special_tool_type = $this->security->xss_clean(trim($this->input->post("special_tool_type")));
		$adapter_machine_side = $this->security->xss_clean(trim($this->input->post("adapter_machine_side")));
		$adapter_nose_type = $this->security->xss_clean(trim($this->input->post("adapter_nose_type")));
		$pull_stud_type = $this->security->xss_clean(trim($this->input->post("pull_stud_type")));
		$accessory_name = $this->security->xss_clean(trim($this->input->post("accessory_name")));
		$range = $this->security->xss_clean(trim($this->input->post("range")));
		$least_count = $this->security->xss_clean(trim($this->input->post("least_count")));
		$last_calibration_date = $this->security->xss_clean(trim($this->input->post("last_calibration_date")));
		$next_calibration_date = $this->security->xss_clean(trim($this->input->post("next_calibration_date")));
		$insert_shape = $this->security->xss_clean(trim($this->input->post("insert_shape")));
		$insert_material = $this->security->xss_clean(trim($this->input->post("insert_material")));
		$insert_product_code = $this->security->xss_clean(trim($this->input->post("insert_product_code")));
		$no_of_cutting_edge = $this->security->xss_clean(trim($this->input->post("no_of_cutting_edge")));
		
		$ar=array();
		$ar['product_id']=0;
		$ar['hsn_code']=$hsn_code;
		$ar['product_code']= $product_code;
		$ar['pro_category']= $pro_category;
		$ar['pro_sub_category']= $pro_sub_category;
		$ar['pro_type']= $pro_type;
		$ar['trash_hold']= $trash_hold;
		$ar['storage_type']= $storage_type;
		$ar['product_name'] = $product_name;		
		$ar['uom'] = $uom;
		$ar['dimension'] = $dimension;
		$ar['stress_relieved'] = $stress_relieved;
		$ar['description'] = $description;
		
		$ar['weight'] = $weight;	
		$ar['length'] = $length;	
		$ar['width'] = $width;	
		$ar['thickness'] = $thickness;	
		$ar['height'] = $height;	
		$ar['materials'] = $materials;	
		$ar['radius'] = $radius;	
		$ar['diameter'] = $diameter;	
		$ar['volume'] = $volume;	
		$ar['shank_length'] = $shank_length;	
		$ar['no_of_teeth'] = $no_of_teeth;	
		$ar['cutting_radius'] = $cutting_radius;	
		$ar['cutting_tip'] = $cutting_tip;	
		$ar['thread_diameter'] = $thread_diameter;	
		$ar['thread_pitch'] = $thread_pitch;	
		$ar['milling_tool_type'] = $milling_tool_type;	
		$ar['boring_tool_type'] = $boring_tool_type;
		$ar['drilling_tool_type'] = $drilling_tool_type;
		$ar['reaming_tool_type'] = $reaming_tool_type;
		$ar['threading_tool_type'] = $threading_tool_type;
		$ar['special_tool_type'] = $special_tool_type;
		$ar['adapter_machine_side'] = $adapter_machine_side;
		$ar['adapter_nose_type'] = $adapter_nose_type;
		$ar['pull_stud_type'] = $pull_stud_type;
		$ar['accessory_name'] = $accessory_name;
		$ar['range_val'] = $range;
		$ar['least_count'] = $least_count;
		
		if($last_calibration_date!='')
		{
			$ar['last_calibration_date'] = date("Y-m-d", strtotime($last_calibration_date));
		}
		if($next_calibration_date!='')
		{
			$ar['next_calibration_date'] = date("Y-m-d", strtotime($next_calibration_date));
		}
		
		$ar['insert_shape'] = $insert_shape;	
		$ar['insert_material'] = $insert_material;	
		$ar['insert_product_code'] = $insert_product_code;	
		$ar['no_of_cutting_edge'] = $no_of_cutting_edge;			
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] = 'True';
		
		$add=$this->product_model->add_product($ar);
		if($add)
		{
			$vendor = $this->security->xss_clean(($this->input->post("vendor")));
			$price = $this->security->xss_clean(($this->input->post("price")));
			$sku_code = $this->security->xss_clean(($this->input->post("sku_code")));
			
			for($k = 0; $k< count($vendor); $k++ )
			{
				if($vendor[$k] != '')
				{
					$pr=array();
					$pr['id']=0;
					$pr['product_id']=$add;
					$pr['sku_code']= $sku_code[$k];
					$pr['vendor_id']= $vendor[$k];
					$pr['price']= $price[$k];
					$pr['add_date'] = date("Y-m-d");
					
					$add_vendor=$this->product_model->add_product_vendor($pr);
					
				}
			}
			
			$this->session->set_flashdata('success', 'Product has been successfully added');
			if($url)
			{
				redirect($url);
			}
			else
			{
				redirect("account/product/index");
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			if($url)
			{
				redirect($url);
			}
			else
			{
				redirect("account/product/index");
			}
		}
	}
	
	//Going to manage Product...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));		
		$data['title']='Manage Product';
		$this->admin_header($data);
		
		$data['materials_info'] = $this->product_model->get_materials(6);
		$data['cutting_tip_info'] = $this->product_model->cutting_tip(13);
		$data['milling_tool_info'] = $this->product_model->milling_tool_type(16);
		$data['boring_tool_info'] = $this->product_model->boring_tool_type(17);
		$data['drilling_tool_info'] = $this->product_model->drilling_tool_type(18);
		$data['reaming_tool_info'] = $this->product_model->reaming_tool_type(19);
		$data['threading_tool_info'] = $this->product_model->threading_tool_type(20);
		$data['special_tool_info'] = $this->product_model->special_tool_type(21);
		$data['adapter_machine_side_info'] = $this->product_model->adapter_machine_side(22);
		$data['adapter_nose_info'] = $this->product_model->adapter_nose_type(23);
		$data['pull_stud_info'] = $this->product_model->pull_stud_type(24);
		$data['insert_shape_info'] = $this->product_model->insert_shape(30);
		
		
		$fields = $this->product_model->get_all_fields();
		$data['fields']=$fields;
		
		$vendor = $this->product_model->get_vendor();
		$uom = $this->product_model->get_uom();
		$storage_type = $this->product_model->get_storage_type();
		$info = $this->product_model->product_info($id);
		
		if(isset($_REQUEST['sub_cat']))
		{			
			$sub_cat_id = $this->security->xss_clean(trim($_REQUEST['sub_cat']));
			$cat_id = $this->product_model->get_cat_id($sub_cat_id);
			//$data['cat_id'] = $cat_id;
			$data['sub_cat_data']=$this->product_model->get_sub_category_field($sub_cat_id);
			$data['product_sub_cat'] = $this->product_model->sub_category($cat_id);
			//$data['sub_cat_id'] = $sub_cat_id;
			$info['pro_category'] = $cat_id;
			$info['pro_sub_category'] = $sub_cat_id;
		}else{			
			$data['sub_cat_data']=$this->product_model->get_sub_category_field($info['pro_sub_category']); 
			$data['product_sub_cat'] = $this->product_model->sub_category($info['pro_category']);
			//$data['cat_id'] = '';
			//$data['sub_cat_id'] = '';
		}
		
		 
		$data['sub_cat_data']=$this->product_model->get_sub_category_field($info['pro_sub_category']);				
		$data['product_sub_cat'] = $this->product_model->sub_category($info['pro_category']);		 
		//$data['product_sub_cat']= $product_sub_cat;
		
		$vendor_info = $this->product_model->vendor_product_info($id);
		$product_cat = $this->product_model->get_category();
		$data['vendor']=$vendor;
		$data['uom']=$uom;
		$data['storage_type']=$storage_type;
		$data['info']=$info;
		$data['vendor_info']=$vendor_info;
		$data['product_cat']=$product_cat;
		$this->load->view("account/manage_product_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Product..
	public function update_product()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit() ; */
		
		$update_vendor = $this->security->xss_clean(($this->input->post("update_vendor")));
		$update_price = $this->security->xss_clean(($this->input->post("update_price")));
		$update_sku_code = $this->security->xss_clean(($this->input->post("update_sku_code")));
		$update_action = $this->security->xss_clean(($this->input->post("update_action")));
		$update_product_id = $this->security->xss_clean(($this->input->post("update_product_id")));
		
		for($k = 0; $k< count($update_action); $k++ )
		{
			if($update_action[$k] == 'update')
			{
				$pr=array();
				$product_id_update = $update_product_id[$k];
				$pr['vendor_id']= $update_vendor[$k];
				$pr['sku_code']= $update_sku_code[$k];
				$pr['price']= $update_price[$k];
				$pr['modify_date'] = date("Y-m-d");
				$update_product =$this->product_model->update_product_vendor($product_id_update, $pr);
				if($update_product)
				{
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/product/index");
				}
			}
			else if($update_action[$k] == 'delete')
			{	
				$aar=array();
				$product_id_delete = $update_product_id[$k];
				$delete_product =$this->product_model->delete_product_vendor($product_id_delete);
				if($delete_product)
				{
				}
				else
				{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/product/index");
				}
			}
		}
		
		
		/* $hsn_code = $this->security->xss_clean(trim($this->input->post("hsn_code")));
		$pro_category = $this->security->xss_clean(trim($this->input->post("pro_category")));
		$trash_hold = $this->security->xss_clean(trim($this->input->post("trash_hold")));
		$product_id = $this->security->xss_clean(trim($this->input->post("product_id")));
		$storage_type = $this->security->xss_clean(trim($this->input->post("storage_type")));
		$product_name = $this->security->xss_clean(trim($this->input->post("product_name")));
		$uom = $this->security->xss_clean(trim($this->input->post("uom")));
		$weight = $this->security->xss_clean(trim($this->input->post("weight")));
		$thikness = $this->security->xss_clean(trim($this->input->post("thikness")));
		$material = $this->security->xss_clean(trim($this->input->post("material")));
		$dimension = $this->security->xss_clean(trim($this->input->post("dimension")));
		$stress_relieved = $this->security->xss_clean(trim($this->input->post("stress_relieved")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));
		
		if($storage_type == '1')
		{
			$product_code = sprintf("IE-01-%05d", $product_id)."";
		}
		else if($storage_type == '2')
		{
			$product_code = sprintf("IE-02-%05d", $product_id)."";
		}
				
		$ar=array();
		$ar['storage_type']= $storage_type;
		$ar['product_name'] = $product_name;
		$ar['pro_category'] = $pro_category;
		$ar['trash_hold'] = $trash_hold;
		$ar['hsn_code'] = $hsn_code;
		$ar['product_code'] = $product_code;
		$ar['uom'] = $uom;
		$ar['weight'] = $weight;
		$ar['thikness'] = $thikness;
		$ar['material'] = $material;
		$ar['dimension'] = $dimension;
		$ar['stress_relieved'] = $stress_relieved;
		$ar['description'] = $description; */

		$product_id = $this->security->xss_clean(trim($this->input->post("product_id")));
		$trash_hold = $this->security->xss_clean(trim($this->input->post("trash_hold")));
		$storage_type = $this->security->xss_clean(trim($this->input->post("storage_type")));
		$pro_category = $this->security->xss_clean(trim($this->input->post("pro_category")));
		
		if($storage_type == '1')
		{
			$product_code = sprintf("IE-01-%05d", $product_id)."";
		}
		else if($storage_type == '2')
		{
			$product_code = sprintf("IE-02-%05d", $product_id)."";
		}
		
		$hsn_code = $this->security->xss_clean(trim($this->input->post("hsn_code")));
		$pro_category = $this->security->xss_clean(trim($this->input->post("pro_category")));
		$pro_sub_category = $this->security->xss_clean(trim($this->input->post("pro_sub_category")));
		$pro_type = $this->security->xss_clean(trim($this->input->post("pro_type")));
		$trash_hold = $this->security->xss_clean(trim($this->input->post("trash_hold")));
		$storage_type = $this->security->xss_clean(trim($this->input->post("storage_type")));
		$product_name = $this->security->xss_clean(trim($this->input->post("product_name")));
		$uom = $this->security->xss_clean(trim($this->input->post("uom"))); 
		$dimension = $this->security->xss_clean(trim($this->input->post("dimension")));
		$stress_relieved = $this->security->xss_clean(trim($this->input->post("stress_relieved")));
		$description 	 = $this->security->xss_clean(trim($this->input->post("description")));
		
		$weight = $this->security->xss_clean(trim($this->input->post("weight")));
		$length = $this->security->xss_clean(trim($this->input->post("length")));
		$width = $this->security->xss_clean(trim($this->input->post("width")));
		$thickness = $this->security->xss_clean(trim($this->input->post("thickness")));
		$height = $this->security->xss_clean(trim($this->input->post("height")));
		$materials = $this->security->xss_clean(trim($this->input->post("materials")));
		$radius = $this->security->xss_clean(trim($this->input->post("radius")));
		$diameter = $this->security->xss_clean(trim($this->input->post("diameter")));
		$volume = $this->security->xss_clean(trim($this->input->post("volume")));
		$shank_length = $this->security->xss_clean(trim($this->input->post("shank_length")));
		$no_of_teeth = $this->security->xss_clean(trim($this->input->post("no_of_teeth")));
		$cutting_radius = $this->security->xss_clean(trim($this->input->post("cutting_radius")));
		$cutting_tip = $this->security->xss_clean(trim($this->input->post("cutting_tip")));
		$thread_diameter = $this->security->xss_clean(trim($this->input->post("thread_diameter")));
		$thread_pitch = $this->security->xss_clean(trim($this->input->post("thread_pitch")));
		$milling_tool_type = $this->security->xss_clean(trim($this->input->post("milling_tool_type")));
		$boring_tool_type = $this->security->xss_clean(trim($this->input->post("boring_tool_type")));
		$drilling_tool_type = $this->security->xss_clean(trim($this->input->post("drilling_tool_type")));
		$reaming_tool_type = $this->security->xss_clean(trim($this->input->post("reaming_tool_type")));
		$threading_tool_type = $this->security->xss_clean(trim($this->input->post("threading_tool_type")));
		$special_tool_type = $this->security->xss_clean(trim($this->input->post("special_tool_type")));
		$adapter_machine_side = $this->security->xss_clean(trim($this->input->post("adapter_machine_side")));
		$adapter_nose_type = $this->security->xss_clean(trim($this->input->post("adapter_nose_type")));
		$pull_stud_type = $this->security->xss_clean(trim($this->input->post("pull_stud_type")));
		$accessory_name = $this->security->xss_clean(trim($this->input->post("accessory_name")));
		$range = $this->security->xss_clean(trim($this->input->post("range")));
		$least_count = $this->security->xss_clean(trim($this->input->post("least_count")));
		$last_calibration_date = $this->security->xss_clean(trim($this->input->post("last_calibration_date")));
		$next_calibration_date = $this->security->xss_clean(trim($this->input->post("next_calibration_date")));
		$insert_shape = $this->security->xss_clean(trim($this->input->post("insert_shape")));
		$insert_material = $this->security->xss_clean(trim($this->input->post("insert_material")));
		$insert_product_code = $this->security->xss_clean(trim($this->input->post("insert_product_code")));
		$no_of_cutting_edge = $this->security->xss_clean(trim($this->input->post("no_of_cutting_edge")));
		
		$ar=array();
		$ar['product_id']= $product_id;
		$ar['hsn_code']=$hsn_code;
		$ar['product_code']= $product_code;
		$ar['pro_category']= $pro_category;
		$ar['pro_sub_category']= $pro_sub_category;
		$ar['pro_type']= $pro_type;
		$ar['trash_hold']= $trash_hold;
		$ar['storage_type']= $storage_type;
		$ar['product_name'] = $product_name;		
		$ar['uom'] = $uom;
		$ar['dimension'] = $dimension;
		$ar['stress_relieved'] = $stress_relieved;
		$ar['description'] = $description;
		
		$ar['weight'] = $weight;	
		$ar['length'] = $length;	
		$ar['width'] = $width;	
		$ar['thickness'] = $thickness;	
		$ar['height'] = $height;	
		$ar['materials'] = $materials;	
		$ar['radius'] = $radius;	
		$ar['diameter'] = $diameter;	
		$ar['volume'] = $volume;	
		$ar['shank_length'] = $shank_length;	
		$ar['no_of_teeth'] = $no_of_teeth;	
		$ar['cutting_radius'] = $cutting_radius;	
		$ar['cutting_tip'] = $cutting_tip;	
		$ar['thread_diameter'] = $thread_diameter;	
		$ar['thread_pitch'] = $thread_pitch;	
		$ar['milling_tool_type'] = $milling_tool_type;	
		$ar['boring_tool_type'] = $boring_tool_type;
		$ar['drilling_tool_type'] = $drilling_tool_type;
		$ar['reaming_tool_type'] = $reaming_tool_type;
		$ar['threading_tool_type'] = $threading_tool_type;
		$ar['special_tool_type'] = $special_tool_type;
		$ar['adapter_machine_side'] = $adapter_machine_side;
		$ar['adapter_nose_type'] = $adapter_nose_type;
		$ar['pull_stud_type'] = $pull_stud_type;
		$ar['accessory_name'] = $accessory_name;
		$ar['range_val'] = $range;
		$ar['least_count'] = $least_count;
		
		if($last_calibration_date!='')
		{
			$ar['last_calibration_date'] = date("Y-m-d", strtotime($last_calibration_date));
		}
		if($next_calibration_date!='')
		{
			$ar['next_calibration_date'] = date("Y-m-d", strtotime($next_calibration_date));
		}
		
		$ar['insert_shape'] = $insert_shape;	
		$ar['insert_material'] = $insert_material;	
		$ar['insert_product_code'] = $insert_product_code;	
		$ar['no_of_cutting_edge'] = $no_of_cutting_edge;		
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->product_model->update($ar,$product_id);
		if($update)
		{
			$vendor = $this->security->xss_clean(($this->input->post("vendor")));
			$price = $this->security->xss_clean(($this->input->post("price")));
			$sku_code = $this->security->xss_clean(($this->input->post("sku_code")));
			
			for($k = 0; $k< count($vendor); $k++ )
			{
				if($vendor[$k] != '')
				{
					$pr=array();
					$pr['id']=0;
					$pr['product_id']=$product_id;
					$pr['vendor_id']= $vendor[$k];
					$pr['sku_code']= $sku_code[$k];
					$pr['price']= $price[$k];
					$pr['add_date'] = date("Y-m-d");
					
					$add_vendor=$this->product_model->add_product_vendor($pr);
					if($add_vendor)
					{
						
					}
					else
					{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/product/index");
					}
				}
			}
			$this->session->set_flashdata('success', 'Product information has been successfully updated.');
			redirect("account/product/index");	
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/product/index");
		}
	}
	
	// Going To Disable Product..
	public function disable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->product_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Product has been successfully updated.');
			redirect("account/product/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/product/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/product/index");
	}

	//Going to enable Product...
	public function enable()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->product_model->update($ar,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Product has been successfully enabled.');
			redirect("account/product/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/product/index");
		}
	}
	
	//View Product Page..
	public function view()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['id']));
		
		$product = $this->product_model->get_product($id);		
		$data['title']='View Product';
		$data['product']=$product;
		$this->admin_header($data);
		$this->load->view("account/view_product",$data);
		$this->admin_footer($data);		
	}
	
	public function get_sub_category()
	{
		$category_id = $this->security->xss_clean(trim($this->input->post("category_id")));
		$sub_category = $this->product_model->sub_category($category_id);
		
		if(sizeof($sub_category)>0)
		{	echo'<option selected disabled value="">Select Sub Category</option>';
			for($i=0;$i<sizeof($sub_category);$i++)
			{
				?>
					<option value="<?php echo $sub_category[$i]['id']; ?>"><?php echo $sub_category[$i]['sub_cat_name']; ?></option>
				<?php
			}
		}else{
			echo'<option selected disabled value="">No Record Found</option>';
		}

	}
	
}
?>