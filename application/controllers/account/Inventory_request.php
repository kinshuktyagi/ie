<?php
class Inventory_request extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/inventory_request_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Inventory Request List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{		
			$issu_prod_date=$this->security->xss_clean(trim($this->input->post("issu_prod_date")));
			$issu_description=$this->security->xss_clean(trim($this->input->post("issu_description")));
			$issu_added_by=$this->security->xss_clean(trim($this->input->post("issu_added_by")));
			$issu_status=$this->security->xss_clean(trim($this->input->post("issu_status")));
			$issu_add_date=$this->security->xss_clean(trim($this->input->post("issu_add_date")));
			$issu_modify_date=$this->security->xss_clean(trim($this->input->post("issu_modify_date")));
			$issu_request_status=$this->security->xss_clean(trim($this->input->post("issu_request_status")));
			
			$filter['issu_description']=$issu_description;
			$filter['issu_added_by']=$issu_added_by;
			$filter['issu_status']=$issu_status;
			$filter['issu_request_status']=$issu_request_status;
			
			if($issu_prod_date!=='')
			{
				$filter['issu_prod_date']=date("Y-m-d", strtotime($issu_prod_date));
			}else{
				$filter['issu_prod_date']='';
			}			
			if($issu_add_date!=='')
			{
				$filter['issu_add_date']=date("Y-m-d", strtotime($issu_add_date));
			}else{
				$filter['issu_add_date']='';
			}
			if($issu_modify_date!=='')
			{
				$filter['issu_modify_date']=date("Y-m-d", strtotime($issu_modify_date));
			}else{
				$filter['issu_modify_date']='';
			}			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->inventory_request_model->index($offset, $show_per_page);
						
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/inventory_issue/index');
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
		
		$this->load->view("account/inventory_request_list",$data);
		$this->admin_footer($data);
	}

	//Going to add Inventory Request...
	public function add_inventory_request()
	{		
		//$this->session->unset_userdata("issue_stock");
		$data['title']='Add Inventory Issue';
		$this->admin_header($data);
		if(isset($_POST['product_name']))
		{
			$product_id = $this->security->xss_clean($this->input->post("product_name"));
			$product_qty = $this->security->xss_clean($this->input->post("product_qty"));
			$notes = $this->security->xss_clean($this->input->post("notes"));
			
			$user=$this->session->userdata("user");
			
			$ar = array();
			$ar['user_id'] = $user['id'];
			$pro_issue = array();
			$br = array();
			
			if(sizeof($product_id) > 0)
			{
				for($i=0; sizeof($product_id)>$i; $i++)
				{
					$pro_issue['product_id'] = $product_id[$i];
					/* $pro_issue['start_date'] = $start_date[$i];
					$pro_issue['end_date'] = $end_date[$i]; */
					$pro_issue['product_qty'] = $product_qty[$i];
					$pro_issue['notes'] = $notes[$i];
					$br[$i] = $pro_issue;
				}
				$ar['issu_product'] = $br;
				$this->session->set_userdata("issue_stock",$ar);
				
			}			
		}		
		if(isset($_POST['up_product_name']))
		{		
			$product_id = $this->security->xss_clean($this->input->post("up_product_name"));
			$product_qty = $this->security->xss_clean($this->input->post("up_product_qty"));
			$notes = $this->security->xss_clean($this->input->post("up_notes"));
			
			$user=$this->session->userdata("user");			
			$ar = array();
			$ar['user_id'] = $user['id'];
			$pro_issue = array();
			$br = array();
			
			if(sizeof($product_id) > 0)
			{
				for($i=0; sizeof($product_id)>$i; $i++)
				{
					if($product_id[$i]!='' && $product_qty[$i] > 0)
					{
						$pro_issue['product_id'] = $product_id[$i];
						$pro_issue['product_qty'] = $product_qty[$i];
						$pro_issue['notes'] = $notes[$i];
						$br[$i] = $pro_issue;
					}
					
				}
				$ar['issu_product'] = $br;
				$this->session->set_userdata("issue_stock",$ar);				
			}
			
		}
		
		$data['product_info']=$this->inventory_request_model->get_product();
		$this->load->view("account/add_inventory_request",$data);
		$this->admin_footer($data);
	}


	//Going to add Inventory Request into Database...
	public function add()
	{		
		$description = $this->security->xss_clean(trim($this->input->post("description")));		
		$production_date = $this->security->xss_clean(trim($this->input->post("production_date")));		
		$user=$this->session->userdata("user");
		
		$last_id = $this->inventory_request_model->generate_userid();
		$inventory_request_code = 'REQ'.$last_id;
		
		$ar=array();
		$ar['id']=0;
		$ar['inventory_request_code']=$inventory_request_code;
		$ar['added_by']=$user['id'];
		$ar['description'] = $description;		
		$ar['production_date'] = date("Y-m-d", strtotime($production_date));		
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] = 'True';
		/* echo"<pre>";
		print_r($ar);
		exit(); */
		$add=$this->inventory_request_model->add_inventory_request($ar);
		if($add)
		{
			$issue_stock=$this->session->userdata("issue_stock");
			$issu_product = $issue_stock['issu_product'];
			if(sizeof($issu_product)>0)
			{
				$arr = array();
				for($j=0; sizeof($issu_product)>$j; $j++)
				{
					$arr['id']=0;
					$arr['inventory_request_id']=$add;
					$arr['product_id']=$issu_product[$j]['product_id'];
					$arr['product_qty']=$issu_product[$j]['product_qty'];
					$arr['notes']=$issu_product[$j]['notes'];
					
					$add_product = $this->inventory_request_model->add_inventory_request_product($arr);
				}
			}
			
			$this->session->set_flashdata('success', 'Inventory Issue has been successfully added');
			$this->session->unset_userdata("issue_stock");
			redirect("account/inventory_request/index");
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/inventory_request/index");
		}
	}
	
	//Going to manage Request...
	public function manage()
	{
		$id=$this->security->xss_clean(trim($_REQUEST['dept']));
		$data['title']='Manage Inventory Issue';
		$this->admin_header($data);
		$data['product_info']=$this->inventory_request_model->get_product();
		$info = $this->inventory_request_model->invetory_issue_info($id);
		$data['info']=$info;
		$this->load->view("account/manage_inventory_request",$data);
		$this->admin_footer($data);
	}
	
	//Going to Update Inventory Request..
	public function update_inventory_request()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$product_action = $this->security->xss_clean($this->input->post("product_action"));
		
		$up_product_name = $this->security->xss_clean($this->input->post("up_product_name"));
		$up_product_qty = $this->security->xss_clean($this->input->post("up_product_qty"));
		$up_notes = $this->security->xss_clean($this->input->post("up_notes"));
		$id = $this->security->xss_clean($this->input->post("inventory_request_product_id"));
		
		if(sizeof($product_action) > 0)
		{			
			$pro_issue =array();  
			for($i=0; sizeof($product_action)>$i; $i++)
			{
				if($product_action[$i] == 'update')
				{
					if($up_product_name[$i]!='' && $up_product_qty[$i] > 0)
					{						
						$pro_issue['product_id'] = $up_product_name[$i];
						$pro_issue['product_qty'] = $up_product_qty[$i];
						$pro_issue['notes'] = $up_notes[$i];
						
						$update=$this->inventory_request_model->update_inventory_request_product($pro_issue, $id[$i]);
					}
				}
				elseif($product_action[$i] == 'delete')
				{
					$delete=$this->inventory_request_model->delete_inventory_request_product($id[$i]);
				}
				
			}
		}
		
		$product_name = $this->security->xss_clean($this->input->post("product_name"));
		$product_qty = $this->security->xss_clean($this->input->post("product_qty"));
		$notes = $this->security->xss_clean($this->input->post("notes"));
		$inventory_request_id = $this->security->xss_clean(trim($this->input->post("inventory_request_id")));
		
		if(sizeof($product_name) > 0)
		{			
			$ar =array();  
			for($i=0; sizeof($product_name)>$i; $i++)
			{				
				if($product_name[$i]!='' && $product_qty[$i] > 0)
				{
					$ar['id'] = 0;
					$ar['product_id'] = $product_name[$i];
					$ar['product_qty'] = $product_qty[$i];
					$ar['notes'] = $notes[$i];
					$ar['inventory_request_id'] = $inventory_request_id;					
					$add=$this->inventory_request_model->add_inventory_request_product($ar);
				}				
			}
		}
		
		$production_date = $this->security->xss_clean(trim($this->input->post("production_date")));
		$description = $this->security->xss_clean(trim($this->input->post("description")));
		
		$arr=array();
		$arr['production_date']=date('Y-m-d', strtotime($production_date));
		$arr['description']=$description;		
		$arr['modify_date']=date("Y-m-d");
		
		$update=$this->inventory_request_model->update($arr,$inventory_request_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Inventory Issue information has been successfully updated.');
			redirect("account/inventory_request/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/inventory_request/index");
		}
	}
	
	// Going To Disable Request..
	public function disable()
	{
		$dept_id=$this->security->xss_clean(trim($_REQUEST['dept']));
		$ar=array('status'=>'False');
		$update=$this->inventory_request_model->update($ar,$dept_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Inventory issue has been successfully updated.');
			redirect("account/inventory_request/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/inventory_request/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/inventory_request/index");
	}

	//Going to enable Request...
	public function enable()
	{
		$dept=$this->security->xss_clean(trim($_REQUEST['dept']));
		$ar=array('status'=>'True');
		$update=$this->inventory_request_model->update($ar,$dept);
		if($update)
		{
			$this->session->set_flashdata('success', 'Inventory issue has been successfully enabled.');
			redirect("account/inventory_request/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/inventory_request/index");
		}
	}
	
	// View Inventpry Request..
	public function view()
	{
		$data['title']='View Inventory Request';
		$this->admin_header($data);
		$id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['info'] = $this->inventory_request_model->invetory_issue_info($id);;
		$this->load->view("account/view_inventory_request",$data);
		$this->admin_footer($data);
	}
	
	// Approve Inventory Request..
	public function approve()
	{
		$data['title']='Approve Inventory Request';
		$this->admin_header($data);
		$id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['info'] = $this->inventory_request_model->invetory_issue_info($id);;
		$this->load->view("account/approve_inventory_request",$data);
		$this->admin_footer($data);
	}
	
	public function approve_inventory_request()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		
		echo $id = $this->security->xss_clean(trim($this->input->post("inventory_request_id")));
		$request_qty = $this->security->xss_clean($this->input->post("request_qty"));
		$issued_qty = $this->security->xss_clean($this->input->post("issued_qty"));
		$approve_qty = $this->security->xss_clean($this->input->post("approve_qty"));
		$inventory_product_id = $this->security->xss_clean($this->input->post("inventory_product_id"));
		$note = $this->security->xss_clean(trim($this->input->post("note")));
		
		$user =$this->session->userdata("user");
		
		$total_request = array_sum($request_qty);
		$approve = array_sum($approve_qty);
		$issued_qty = array_sum($issued_qty);
		$total_issued = $approve + $issued_qty;
		
		if($total_issued < $total_request && $total_issued >0)
		{
			$status = 'Partial-Complete';
		}
		else if($total_issued == $total_request )
		{
			$status = "Completed";
		}else{
			$status = "Pending";
		}
		
		$ar=array();
		$ar['inv_approved_id'] = 0;
		$ar['request_id'] = $id;
		$ar['approved_by'] = $user['id'];
		$ar['approved_date'] = date('Y-m-d');
		$ar['note'] = $note;
		$ar['status'] = $status;
		
		/* echo"<pre>";
		print_r($inventory_product_id);
		//print_r($ar);
		exit(); */
		
		$add_req = $this->inventory_request_model->approve_inventory($ar);
		if($add_req)
		{
			if(sizeof($approve_qty))
			{
				for($j=0; sizeof($approve_qty) > $j; $j++)
				{
					$arr = array();
					$arr['approved_item_id'] = 0;
					$arr['inv_approved_id'] = $add_req;
					$arr['request_item_id'] = $inventory_product_id[$j];
					$arr['quantity'] = $approve_qty[$j];
					
					$arr_issued = array();
					$arr_issued['issued_qty'] = $approve_qty[$j] + $issued_qty[$j];
					
					$add_item = $this->inventory_request_model->add_inventory_approve_item($arr);
					$update_issued_product = $this->inventory_request_model->update_inventory_request_product($arr_issued, $inventory_product_id[$j]);
					
				}
			}
		}		
		
		$arr_up = array();
		$arr_up['request_status'] = $status;
		$update=$this->inventory_request_model->update($arr_up,$id);
		if($update)
		{
			$this->session->set_flashdata('success', 'inventory issue has been successfully updated.');
			redirect("account/inventory_request/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/inventory_request/index");
		}
	}
}
?>