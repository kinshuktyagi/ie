<?php
error_reporting(0);
class Enquiry extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/enquiry_model");
		$this->load->library('cart');
	}
	
	public function index($offset=0)
	{
		$data['title']='Enquiry List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{		
			$it_enquiry_code=$this->security->xss_clean(trim($this->input->post("it_enquiry_code")));
			$it_order_type=$this->security->xss_clean(trim($this->input->post("it_order_type")));
			$it_compny_name=$this->security->xss_clean(trim($this->input->post("it_compny_name")));
			$it_name=$this->security->xss_clean(trim($this->input->post("it_name")));
			$it_email=$this->security->xss_clean(trim($this->input->post("it_email")));
			$it_phone=$this->security->xss_clean(trim($this->input->post("it_phone")));
			$it_add_date=$this->security->xss_clean(trim($this->input->post("it_add_date")));
			$it_modify_date=$this->security->xss_clean(trim($this->input->post("it_modify_date")));
			$it_added_by=$this->security->xss_clean(trim($this->input->post("it_added_by")));
			$it_status=$this->security->xss_clean(trim($this->input->post("it_status")));
			
			$filter['it_enquiry_code']=$it_enquiry_code;
			$filter['it_order_type']=$it_order_type;
			$filter['it_compny_name']=$it_compny_name;
			$filter['it_name']=$it_name;
			$filter['it_status']=$it_status;
			$filter['it_email']= $it_email;
			$filter['it_phone']=$it_phone;
			if($it_add_date!=='')
			{
				$filter['it_add_date']=date("Y-m-d", strtotime($it_add_date));
			}else{
				$filter['it_add_date']='';
			}
			if($it_modify_date!=='')
			{
				$filter['it_modify_date']=date("Y-m-d", strtotime($it_modify_date));
			}else{
				$filter['it_modify_date']='';
			}
			
			$filter['it_added_by']= $it_added_by ;			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->enquiry_model->index($offset, $show_per_page);
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/enquiry/index');
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
		
		$this->load->view("account/enquiry_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_enquiry()
	{
		$data['title']='Add Enquiry';
		$cust_info=$this->enquiry_model->customer_details();
		$data['cust_info'] = $cust_info;
		$this->admin_header($data);
		$this->load->view("account/add_enquiry",$data);
		$this->admin_footer($data);
	}

	//Going to add enquiry...
	public function add()
	{
		/* $cart = $this->cart->contents();
		echo"<pre>";
		print_r($_POST);
		print_r($cart);
		exit(); */
		
		$cart = $this->cart->contents();
		
		$order_type = $this->security->xss_clean(trim($this->input->post("order_type")));
		$company_name = $this->security->xss_clean(trim($this->input->post("company_name")));
		$order_date = $this->security->xss_clean(trim($this->input->post("order_date")));
		$user=$this->session->userdata("user");
		$last_id=$this->enquiry_model->fetch_last_enquiry_id();
		
		$ar=array();
		$ar['id']=0;
		$ar['enquiry_code'] = sprintf("ENQ%05d", $last_id)."";
		$ar['order_type'] = $order_type;
		$ar['company_name'] = $company_name;
		$ar['order_date'] = date('Y-m-d', strtotime($order_date));
		$ar['added_by'] = $user['id'];		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] = 'True';	
		/* echo"<pre>";
		print_r($ar);
		exit(); */
		
		$add=$this->enquiry_model->add_enquiry($ar);
		if($add)
		{
			$cart = $this->cart->contents();
			
			if(sizeof($cart)>0)
			{
				foreach ($cart as $item)
				{
					$arr=array();
					$arr['id']=0;
					$arr['enquiry_id']=$add;
					$arr['drawing_number']=$item['drawing_number'];
					$arr['part_number']=$item['part_number'];
					$arr['material_name']=$item['name'];
					$arr['quantity']=$item['qty'];
					$arr['weight']=$item['weight'];
					$arr['drawing']=$item['options']['Size'];
					$arr['cad']=$item['options']['Color'];
					$arr['description']=$item['coupon'];
					
					$add_items =$this->enquiry_model->add_enquiry_items($arr);
					if($add_items)
					{						
						
					}else{
						$this->session->set_flashdata('error', 'Somethingqqqq is problem please try again.');
						redirect("account/enquiry/index");
						
					}
				}
				$this->session->set_flashdata('success', 'Enquiry has been successfully added');
				redirect("account/enquiry/index");
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Somethingwewew is problem please try again.');
			redirect("account/enquiry/index");
		}
	}
	
	//Going to manage Enquiry...
	public function manage()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='Manage Enquiry';
		$this->admin_header($data);		
		$info = $this->enquiry_model->enquiry_info($enquiry_id);
		$info_items = $this->enquiry_model->enquiry_items_info($enquiry_id);
		
		/* $this->cart->destroy();
		
			for($i=0; sizeof($info_items) > $i; $i++)
			{
				$insert_data = array(
					'id'      => '1',
					'qty'     => $info_items[$i]['quantity'],
					'price'   => $info_items[$i]['description'],
					'name'    => $info_items[$i]['material_name'],
					'coupon'  => $info_items[$i]['description'],
					'options' => array('Size' => $info_items[$i]['drawing'], 'Color' => $info_items[$i]['cad'])
				);
				$this->cart->insert($insert_data);
			}
			
		//} */
		
		$data['info']=$info;
		$data['enquiry_id']=$enquiry_id;
		$data['info_items']=$info_items;
		$this->load->view("account/manage_enquiry_info",$data);
		$this->admin_footer($data);
	}
	
	// View Enquiry Info..
	public function view_enquiry()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='View Enquiry';
		$this->admin_header($data);		
		$info = $this->enquiry_model->enquiry_info($enquiry_id);		
		$info_cust = $this->enquiry_model->cust_contact_info($info['cust_id']);
		$info_items = $this->enquiry_model->enquiry_items_info($enquiry_id);
		$data['info']=$info;
		$data['enquiry_id']=$enquiry_id;
		$data['info_items']=$info_items;
		$data['info_cust']=$info_cust;
		$this->load->view("account/view_enquiry_info",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Enquiry..
	public function update_enquiry()
	{
		$order_type = $this->security->xss_clean(trim($this->input->post("order_type")));		
		$company_name=$this->security->xss_clean(trim($this->input->post("company_name")));
		$contact_person_name=$this->security->xss_clean(trim($this->input->post("contact_person_name")));		
		$contact_number=$this->security->xss_clean(trim($this->input->post("contact_number")));		
		$email=$this->security->xss_clean(trim($this->input->post("email")));		
		$order_date=$this->security->xss_clean(trim($this->input->post("order_date")));		
		$city=$this->security->xss_clean(trim($this->input->post("city")));		
		$address=$this->security->xss_clean(trim($this->input->post("address")));		
		$enquiry_id=$this->security->xss_clean(trim($this->input->post("enquiry_id")));		
		
		$ar=array();
		$ar['order_type']=$order_type;
		$ar['company_name']=$company_name;
		$ar['contact_person_name']=$contact_person_name;
		$ar['contact_number']=$contact_number;
		$ar['email']=$email;
		$ar['order_date']=$order_date;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['modify_date']=date("Y-m-d");	
		
		$update=$this->enquiry_model->update($ar,$enquiry_id);
		
		if($update)
		{
			$delete=$this->enquiry_model->delete_items($enquiry_id);
			if($delete)
			{			
				$cart = $this->cart->contents();
				if(sizeof($cart)>0)
				{
					foreach ($cart as $item)
					{
						$arr=array();
						$arr['id']=0;
						$arr['enquiry_id']=$enquiry_id;
						$arr['material_name']=$item['name'];
						$arr['quantity']=$item['qty'];
						$arr['drawing']=$item['options']['Size'];
						$arr['cad']=$item['options']['Color'];
						$arr['description']=$item['coupon'];
						
						$add_items =$this->enquiry_model->add_enquiry_items($arr);
						if($add_items)
						{
							
							
						}else{
							$this->session->set_flashdata('error', 'Something1 is problem please try again.');
							redirect("account/enquiry/index");
							
						}
					}
					$this->session->set_flashdata('success', 'Enquiry1 information has been successfully updated.');
					redirect("account/enquiry/index");
				}
			
			}			
			
			$this->session->set_flashdata('success', 'Enquiry2 information has been successfully updated.');
			redirect("account/enquiry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something2 is problem please try again.');
			redirect("account/enquiry/index");
		}
	}
	
	// Going To Disable Enquiry..
	public function disable()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'False');
		$update=$this->enquiry_model->update($ar,$enquiry_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Enquiry has been successfully updated.');
			redirect("account/enquiry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/enquiry/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/enquiry/index");
	}
	
	// Reset Reset Assigned Filter 
	public function reset_assigned_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/enquiry/assigned");
	}
	
	// Reset Reset Assigned Filter 
	public function reset_unassign_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/enquiry/unassign");
	}
	
	//Going to enable Enquiry...
	public function enable()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$ar=array('status'=>'True');
		$update=$this->enquiry_model->update($ar,$enquiry_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Enquiry has been successfully enabled.');
			redirect("account/enquiry/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/enquiry/index");
		}
	}
	
	// Going To Add Materials Details into Cart..
	function add_enquiry_items()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$material_name = $this->security->xss_clean(($this->input->post("material_name")));
		$drawing_number = $this->security->xss_clean(($this->input->post("drawing_number")));
		$part_number = $this->security->xss_clean(($this->input->post("part_number")));
		$material_qty = $this->security->xss_clean(($this->input->post("material_qty")));
		$material_weight = $this->security->xss_clean(($this->input->post("material_weight")));
		$drawing_name = $this->security->xss_clean(($this->input->post("drawing_name")));
		$cad_name = $this->security->xss_clean(($this->input->post("cad_name")));
		$parts_description = $this->security->xss_clean(($this->input->post("parts_description")));
				
		for($b=0; sizeof($drawing_name)>$b; $b++)
		{			
			if($_FILES['drawing_name']['name'][$b]!="")
			{
				$image = $_FILES['drawing_name']['name'][$b];
				$tempname = $_FILES['drawing_name']['tmp_name'][$b];
				move_uploaded_file($tempname, "uploads/$image");
			}
			if($_FILES['cad_name']['name'][$b]!="")
			{
				$image = $_FILES['cad_name']['name'][$b];
				$tempname = $_FILES['cad_name']['tmp_name'][$b];
				move_uploaded_file($tempname, "uploads/$image");
			}
		}		
		
		for($k = 0; $k<count($material_name); $k++ )
		{
			if($material_name[$k] != '')
			{
				$insert_data = array(
					'id'      => '1',
					'drawing_number'     => $drawing_number[$k],
					'part_number' => $part_number[$k],
					'qty'     => $material_qty[$k],
					'price'   => $parts_description[$k],
					'weight'  => $material_weight[$k],
					'name'    => $material_name[$k],
					'coupon'  => $parts_description[$k],
					'options' => array('Size' => $_FILES['drawing_name']['name'][$k], 'Color' => $_FILES['cad_name']['name'][$k])
				);				
				$this->cart->insert($insert_data);			
			}
		}
		redirect("account/enquiry/add_enquiry");		
	}
	
	// For Remove The Items..
	function remove_item() 
	{
		$rowid = $this->security->xss_clean(($this->input->post("row_id")));		
		if ($rowid==="all")
		{
			$this->cart->destroy();
		}else
		{
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
	}
	
	// for update the enquiry Items..
	public function remove_enquiry_item()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		if($row_id!='')
		{
			echo $delete = $this->enquiry_model->delete_quantity($row_id);
		}
	}
	
	// Going To Update The Cart Quantity..
	public function update_item_qty()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		$qty = $this->security->xss_clean(($this->input->post("qty")));
		
		$data = array(
        'rowid' => $row_id,
        'qty'   => $qty
		);
		$this->cart->update($data);
		redirect("account/enquiry/add_enquiry");
		
	}
	
	// Going To Update The Cart weight field..
	public function update_item_weight()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		$weight = $this->security->xss_clean(($this->input->post("weight")));
		
		$data = array(
        'rowid' => $row_id,
        'weight' => $weight
		);
		$this->cart->update($data);
		redirect("account/enquiry/add_enquiry");
		
	}
	
	// going to update the The enquiry..
	public function update_item_quantity()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		$qty = $this->security->xss_clean(($this->input->post("qty")));
		$enquiry_id = $this->security->xss_clean(($this->input->post("enquiry_id")));		
		echo $update = $this->enquiry_model->uodate_quantity($row_id, $qty, $enquiry_id);		
	}
	
	//update Enquiry Items..
	public function update_enquiry_items()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['enq_id']));
		$drawing_number = $this->security->xss_clean(($this->input->post("drawing_number")));
		$part_number = $this->security->xss_clean(($this->input->post("part_number")));
		$material_name = $this->security->xss_clean(($this->input->post("material_name")));
		$material_qty = $this->security->xss_clean(($this->input->post("material_qty")));
		$material_weight = $this->security->xss_clean(($this->input->post("material_weight")));
		$drawing_name = $this->security->xss_clean(($this->input->post("drawing_name")));
		$cad_name = $this->security->xss_clean(($this->input->post("cad_name")));
		$parts_description = $this->security->xss_clean(($this->input->post("parts_description")));
				
		for($k = 0; $k<count($material_name); $k++ )
		{
			if($material_name[$k] != '' && $material_qty[$k] != '')
			{ 
				if($_FILES['drawing_name']['name'][$k]!="")
				{
					$image = $_FILES['drawing_name']['name'][$k];
					$tempname = $_FILES['drawing_name']['tmp_name'][$k];
					move_uploaded_file($tempname, "uploads/$image");
				}
				if($_FILES['cad_name']['name'][$k]!="")
				{
					$image = $_FILES['cad_name']['name'][$k];
					$tempname = $_FILES['cad_name']['tmp_name'][$k];
					move_uploaded_file($tempname, "uploads/$image");
				}
				
				$arr=array();
				$arr['id']=0;
				$arr['drawing_number'] = $drawing_number[$k];
				$arr['part_number'] = $part_number[$k];
				$arr['material_name']=$material_name[$k];
				$arr['quantity']=$material_qty[$k];
				$arr['weight']=$material_weight[$k];
				$arr['drawing']=$_FILES['drawing_name']['name'][$k];
				$arr['cad']= $_FILES['cad_name']['name'][$k];;
				$arr['description']=$parts_description[$k];
				$arr['enquiry_id']=$enquiry_id;
				
				$add_items =$this->enquiry_model->add_enquiry_items($arr);
				if($add_items)
				{
					
				}else{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/enquiry/manage?id=$enquiry_id");
				}
				
			}
		}
		
		$this->session->set_flashdata('success', 'Enquiry has been successfully added');
		redirect("account/enquiry/manage?id=$enquiry_id");
		
	}
	
	//fetch assigned enquiry...
	public function assigned($offset=0)
	{
		$data['title']='Assigned Enquiry List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit(); */
			
			$as_first_name=$this->security->xss_clean(trim($this->input->post("as_first_name")));
			$as_compny_name=$this->security->xss_clean(trim($this->input->post("as_compny_name")));
			$as_order_type=$this->security->xss_clean(trim($this->input->post("as_order_type")));
			$as_email=$this->security->xss_clean(trim($this->input->post("as_email")));
			$as_phone=$this->security->xss_clean(trim($this->input->post("as_phone")));
			
			$filter['as_first_name']=$as_first_name;
			$filter['as_compny_name']=$as_compny_name;
			$filter['as_order_type']=$as_order_type;
			$filter['as_email']=$as_email;
			$filter['as_phone']=$as_phone;		
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->enquiry_model->get_assigned_enquiry($offset, $show_per_page);
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/enquiry/assigned');
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
		
		$this->load->view("account/assign_enquiry_list",$data);
		$this->admin_footer($data);
	}

	//fetch Un-assigned enquiry...
	public function unassign($offset=0)
	{
		$data['title']='UnAssigned Enquiry List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		
		if($this->input->post("search"))
		{
			$uns_compny_name=$this->security->xss_clean(trim($this->input->post("uns_compny_name")));
			$uns_order_type=$this->security->xss_clean(trim($this->input->post("uns_order_type")));
			$uns_email=$this->security->xss_clean(trim($this->input->post("uns_email")));
			$uns_phone=$this->security->xss_clean(trim($this->input->post("uns_phone")));
			$uns_added_by=$this->security->xss_clean(trim($this->input->post("uns_added_by")));
			
			$filter['uns_compny_name']=$uns_compny_name;
			$filter['uns_order_type']=$uns_order_type;
			$filter['uns_email']=$uns_email;
			$filter['uns_phone']=$uns_phone;
			$filter['uns_added_by']= $uns_added_by;
			
			$this->session->set_userdata("search",$filter);
		}
		
		$show_per_page = 50;
		$data_arr=$this->enquiry_model->get_unassigned_enquiry($offset, $show_per_page);
		$department=$this->enquiry_model->get_deprtment();			
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/enquiry/unassign');
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
		$data['department'] =  $department;
		
		$this->load->view("account/unassign_enquiry_list",$data);
		$this->admin_footer($data);
	}
	
	// Assign Enquiry to user..
	public function assign_enquiry_to_emp()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$assign_type = $this->security->xss_clean(trim($this->input->post("assign_type")));
		$departemnt_id = $this->security->xss_clean(trim($this->input->post("dept_set")));
		$employee_id = $this->security->xss_clean(trim($this->input->post("emp_set")));
		$turn_out_time = $this->security->xss_clean(trim($this->input->post("turn_out_time")));
		$enquiry_list = $this->security->xss_clean(trim($this->input->post("enquiry_list")));
		$enquiry = explode(',', $enquiry_list);
		
		$turn_out_time = date('Y-m-d', strtotime($turn_out_time));
		
		if(sizeof($enquiry)>0)
		{
			for($i=0;$i<sizeof($enquiry);$i++)
			{
				if ($enquiry[$i] != 'NaN')
				{
					if($assign_type == 'assign')
					{
						$employee_department = $this->enquiry_model->assign_enquiry_to_emp($enquiry[$i], $employee_id, $departemnt_id, $turn_out_time);
					}else{
						
						$user=$this->session->userdata("user");
						$ar = array();
						$ar['id'] = 0;
						$ar['enquiry_id'] = $enquiry[$i];
						$ar['added_by'] = $user['id'];
						$ar['department'] = $user['department_id'];
						$ar['followup_action'] = '3';
						$ar['followup_status'] = '3';
						$ar['followup_comment'] = 'Direct Close';
						$ar['add_date'] = date('Y-m-d');
						
						$turn_out_time = date('Y-m-d');
						
						$auto_assign = $this->enquiry_model->assign_enquiry_to_emp($enquiry[$i], $user['id'], $user['department_id'], $turn_out_time);
						$auto_followup = $this->enquiry_model->direct_move_to_quotation($ar);
					}
					
				}
			}
		}

		redirect("account/enquiry/unassign");
	}
	
	//unassign Enquiry to employee..
	public function unassign_emp_enquiry()
	{		
		$ar=array();
		$ar['assign_to'] = NULL;
		$ar['department_id'] = NULL;
		$enquiry_list = $this->security->xss_clean(trim($this->input->post("enquiry_list")));
		$enquiry = explode(',', $enquiry_list);

		if(sizeof($enquiry)>0)
		{
			for($i=0;$i<sizeof($enquiry);$i++)
			{
				if ($enquiry[$i] != 'NaN')
				{
					$employee_department = $this->enquiry_model->unassign_emp_enquiry($enquiry[$i],$ar);
				}
			}
		}

		redirect("account/enquiry/assigned");
	}
	
	// to get the each department employee..
	public function get_department_employee()
	{
		//$team_id = $this->security->xss_clean(trim($this->input->post("team_id")));
		$departemnt_id = $this->security->xss_clean(trim($this->input->post("departemnt_id")));
		$employee_department = $this->enquiry_model->department_employee($departemnt_id);
		
		if(sizeof($employee_department)>0)
		{	echo'<option selected disabled value="">Select Employee</option>';
			for($i=0;$i<sizeof($employee_department);$i++)
			{
				?>
					<option value="<?php echo $employee_department[$i]['user_id']; ?>"><?php echo $employee_department[$i]['first_name'].' '.$employee_department[$i]['last_name'].' / ('.$employee_department[$i]['designation_name'].')'; ?></option>
				<?php
			}
		}else{
			echo'<option selected disabled value="">No Record Found</option>';
		}
	}
	
	// To View The Followup Details..
	public function view()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['id']));
		$data['title']='View Followup';
		$this->admin_header($data);		
		$data['enq_flp']= $this->enquiry_model->get_enquiry_followup($enquiry_id);
		$this->load->view("account/enquiry_followoup_info",$data);
		$this->admin_footer($data);
	}
	
	// Enquiry Followup Report..
	public function followup_report()
	{
		$enquiry_id=$this->security->xss_clean(trim($_REQUEST['enquiry_id']));
		$data['title']='View Report';
		$this->admin_header($data);		
		$data['enq_flp']= $this->enquiry_model->followup_report($enquiry_id);
		$this->load->view("account/enquiry_followoup_report",$data);
		$this->admin_footer($data);
	}
	
}
?>