<?php
class Quotation extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/quotation_model");
		$this->load->library('cart');
	}
	
	public function index($offset=0)
	{
		$data['title']='Quotation List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		
		if($this->input->post("search"))
		{
			$itq_enquiry_code=$this->security->xss_clean(trim($this->input->post("itq_enquiry_code")));
			$itq_order_type=$this->security->xss_clean(trim($this->input->post("itq_order_type")));
			$itq_compny_name=$this->security->xss_clean(trim($this->input->post("itq_compny_name")));
			$itq_email=$this->security->xss_clean(trim($this->input->post("itq_email")));
			$itq_phone=$this->security->xss_clean(trim($this->input->post("itq_phone")));
			//$itq_added_by=$this->security->xss_clean(trim($this->input->post("itq_added_by")));
			$itq_status=$this->security->xss_clean(trim($this->input->post("itq_status")));
			
			$filter['itq_enquiry_code']=$itq_enquiry_code;
			$filter['itq_order_type']=$itq_order_type;
			$filter['itq_compny_name']=$itq_compny_name;
			$filter['itq_email']= $itq_email;
			$filter['itq_phone']=$itq_phone;
			/* if($it_add_date!=='')
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
			} */
			
			//$filter['itq_added_by']= $itq_added_by ;			
			$filter['itq_status']= $itq_status ;			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->quotation_model->index($offset, $show_per_page);
		
		$data['enquiry'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/quotation/index');
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
		
		$this->load->view("account/quotation_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add_quotation()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['title']='Add Quotation';
		$item_info=$this->quotation_model->enquiry_items($enquiry_id);
		$data['item_info'] = $item_info;
		$enquiry_info=$this->quotation_model->get_enquiry_info($enquiry_id);
		$data['enquiry_info'] = $enquiry_info;
		
		$field_info=$this->quotation_model->get_field_data();
		$data['field'] = $field_info;
		$tnc_info=$this->quotation_model->get_tnc_details();
		$data['tnc_info'] = $tnc_info;
		
		/* $quotation_log_info=$this->quotation_model->get_quotation_log_info($enquiry_id);
		$data['info_log'] = $quotation_log_info; */
		
		
		$this->admin_header($data);
		$this->load->view("account/add_quotation",$data);
		$this->admin_footer($data);
	}
	
	//Going to add departement...
	public function manage_quotation()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data=$this->quotation_model->get_quotation_id($enquiry_id);
		$quotation_id = $data[0]['quotation_id'];
						
		$data['title']='Manage Quotation';
		$item_info=$this->quotation_model->enquiry_items($enquiry_id);
		$data['item_info'] = $item_info;
		$enquiry_info=$this->quotation_model->get_enquiry_info($enquiry_id);
		$data['enquiry_info'] = $enquiry_info;
		$field_info=$this->quotation_model->get_field_data();
		$data['field'] = $field_info;
		
		$quotation_log = $this->quotation_model->get_quotation_log_info($quotation_id);
		$data['quotation_log'] = $quotation_log;
		
		$quotation_info=$this->quotation_model->get_quotaion_info($quotation_id);
		$data['info_data'] = $quotation_info;
		
		$tnc_info=$this->quotation_model->get_tnc_details();
		$data['tnc_info'] = $tnc_info;
		
		$this->admin_header($data);
		$this->load->view("account/manage_quotation_info",$data);
		$this->admin_footer($data);
	}

	//Going to add enquiry...
	public function add()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$enquiry_id = $this->security->xss_clean(trim($this->input->post("enquiry_id")));
		$enquiry_code = $this->security->xss_clean(trim($this->input->post("enquiry_code")));
		
		$drawing_number = $this->security->xss_clean(($this->input->post("drawing_number")));
		$part_name = $this->security->xss_clean(($this->input->post("part_name")));
		$field = $this->security->xss_clean(($this->input->post("field")));
		$price = $this->security->xss_clean(($this->input->post("price")));
		$percentage = $this->security->xss_clean(trim($this->input->post("percentage")));
		$tnc = $this->security->xss_clean(trim($this->input->post("tnc")));
		
		$user = $this->session->userdata("user");
		$last_id = $this->quotation_model->fetch_last_quotation_id();
		
		$arr = array();
		
		$arr['quotation_code'] =  sprintf("QUO%05d", $last_id)."";
		$arr['quotation_code'] =  sprintf("IEP%05d", $last_id)."";
		$arr['enquiry_id'] = $enquiry_id;
		$arr['enquiry_code'] = $enquiry_code;
		$arr['tnc'] = $tnc;
		$arr['profit_percentage'] = $percentage;
		$arr['add_date'] = date("Y-m-d");
		$arr['status'] = 'True';
		
		$quotation_id = $this->quotation_model->add_enquiry_quotation_main($arr);
		
		
		if(!$quotation_id)
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/quotation/index");
		}
		
		$ar = array();
		for($j=0; sizeof($drawing_number)>$j; $j++)
		{
			$ar['id']=0;
			$ar['added_by'] = $user['id'];;
			$ar['quotation_id'] = $quotation_id;
			$ar['drawing_number'] = $drawing_number[$j];
			$ar['part_name'] = $part_name[$j];
			$ar['field'] = $field[$j];
			$ar['price'] = $price[$j];
			$ar['percentage'] = $percentage;
			
			//$total_sum = ($fabrication[$j] + $stress_relieving[$j] + $machining[$j] + $powder_coating[$j] + $labour_and_trans[$j]);
			
			//$ar['total'] =  $total_sum +($total_sum * $percentage[$j] / 100);			
			$ar['total'] =  $price[$j] +($price[$j] * $percentage / 100);			
			$ar['add_date'] = date("Y-m-d");
			$ar['status'] = 'True';
			
			$add=$this->quotation_model->add_enquiry_quotation($ar);
			if($add)
			{				
				/* $this->session->set_flashdata('success', 'Quotation has been successfully added');
				redirect("account/quotation/add_quotation?id=$enquiry_id"); */
			}else{
				$this->session->set_flashdata('error', 'Something is problem please try again.');
				redirect("account/quotation/index");
			}			
		}
		$update_status = $this->quotation_model->update_enquiry_quotation_status($enquiry_id);
		if($update_status)
		{
			$this->session->set_flashdata('success', 'Quotation has been successfully added');
			redirect("account/quotation/index");
		}else{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/quotation/index");
		}		
		
	}
	
	
	//Update Quotation.
	public function update_quotation()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		
		
		
		$user = $this->session->userdata("user");
		$quotation_id = $this->security->xss_clean(trim($this->input->post("quotation_id")));		
		$data = $this->log_quotation($quotation_id);
		$quotation_log = $data['product'];
		
		if(sizeof($quotation_log) > 0)
		{
			for($m=0; sizeof($quotation_log)>$m; $m++)
			{
				$ar = array();
				$ar['id'] = 0;
				$ar['log_count'] = $m;
				$ar['quotation_sub_id'] = $quotation_log[$m]['id'];
				$ar['quotation_id'] = $quotation_log[$m]['quotation_id'];
				$ar['drawing_number'] = $quotation_log[$m]['drawing_number'];
				$ar['part_name'] = $quotation_log[$m]['part_name'];
				$ar['field'] = $quotation_log[$m]['field'];
				$ar['price'] = $quotation_log[$m]['price'];				
				$ar['percentage'] = $quotation_log[$m]['percentage'];
				$ar['total'] = $quotation_log[$m]['total'];
				$ar['add_date'] = $quotation_log[$m]['add_date'];
				$ar['added_by'] = $quotation_log[$m]['added_by'];
				
				$add = $this->quotation_model->add_quotation_log($ar);
				
			}
		}
		
		// To add New Quotation data..
		$quotation_id = $this->security->xss_clean(($this->input->post("quotation_id")));
		$drawing_number = $this->security->xss_clean(($this->input->post("drawing_number")));
		$part_name = $this->security->xss_clean(($this->input->post("part_name")));
		$field = $this->security->xss_clean(($this->input->post("field")));
		$price = $this->security->xss_clean(($this->input->post("price")));		
		//$percentage = $this->security->xss_clean(($this->input->post("percentage")));
		$percentage = $this->security->xss_clean(($this->input->post("update_percentage")));
		$tnc = $this->security->xss_clean(($this->input->post("tnc")));
		
		$arr =array();
		if(sizeof($drawing_number)>0)
		{
			
			for($k=0; sizeof($drawing_number)>$k; $k++)
			{			
				
				if($drawing_number[$k] != '')
				{ 
					$arr['id']=0;
					$arr['added_by'] = $user['id'];
					$arr['quotation_id'] = $quotation_id;
					//$ar['enquiry_id'] = $enquiry_id;				
					$arr['drawing_number'] = $drawing_number[$k];				
					$arr['part_name'] = $part_name[$k];				
					$arr['field'] = $field[$k];
					$arr['price'] = $price[$k];
					$arr['percentage'] = $percentage;
					$arr['add_date'] = date("Y-m-d");
					//$sum_all =  $fabrication[$k] + $stress_relieving[$k] + $machining[$k] + $powder_coating[$k] + $labour_and_trans[$k];
				
					$arr['total'] = $price[$k] + ($price[$k] * $percentage)/100;
					$add = $this->quotation_model->add_enquiry_quotation($arr);
					if($add)
					{
						
					}else{
						$this->session->set_flashdata('error', 'Somethingdfdff is problem please try again.');
						redirect("account/quotation/index");
					}
				} 
				
			}
			
		}
	
		
		// For Update The Data..
		$update_drawing_number = $this->security->xss_clean(($this->input->post("update_drawing_number")));
		$update_part_number = $this->security->xss_clean(($this->input->post("update_part_number")));
		$update_field = $this->security->xss_clean(($this->input->post("update_field")));
		$update_price = $this->security->xss_clean(($this->input->post("update_price")));
		
		$update_percentage = $this->security->xss_clean(($this->input->post("update_percentage")));
		//$update_total = $this->security->xss_clean(($this->input->post("update_total")));
		$update_action = $this->security->xss_clean(($this->input->post("update_action")));
		$quotation_update_id = $this->security->xss_clean(($this->input->post("quotation_update_id")));
		$pr = array();
		
		
		if(sizeof($update_drawing_number)>0)
		{
			for($j=0; sizeof($update_drawing_number)>$j; $j++)
			{
				$action_id = $update_action[$j];
				if( $action_id == 'update')
				{	
					
					$pr['drawing_number'] = $update_drawing_number[$j];
					$pr['part_name'] = $update_part_number[$j];
					$pr['field'] = $update_field[$j];
					$pr['price'] = $update_price[$j];
					$pr['percentage'] = $update_percentage;
					$pr['total'] = $update_price[$j] + ($update_price[$j] * $update_percentage)/100;
					$id  = $quotation_update_id[$j];					
					$update=$this->quotation_model->update_quotation($id, $pr);
				}
				if($update_action[$j] == 'delete')
				{
					$id  = $quotation_update_id[$j];
					$update=$this->quotation_model->delete_quotation($id);
				}
			}
			
			$update_main_quotation = $this->quotation_model->update_quotation_main($quotation_id, $tnc, $percentage);
			if($update_main_quotation)
			{
				$this->session->set_flashdata('success', 'Quotation has been successfully Updated');
				redirect("account/quotation/index");
			}
			else
			{
				$this->session->set_flashdata('error', 'Somethingdfdff is problem please try again.');
				redirect("account/quotation/index");
			}
			
		}
		
	}
	
	
	public function log_quotation($quotation_id)
	{
		return $result=$this->quotation_model->get_quotaion_info($quotation_id);
	}
	
	
	//View Quotation ..
	public function view_quotation()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['title']='View Quotation';
		
		$enquiry_info=$this->quotation_model->get_enquiry_info($enquiry_id);
		$data['info'] = $enquiry_info;
		
		$quotation_info=$this->quotation_model->get_quotation_id($enquiry_id);
		$quotation_id = $quotation_info[0]['quotation_id'];
		
		$quotation = $this->log_quotation($quotation_id);
		$data['quotation_info'] = $quotation;
		
		$this->admin_header($data);
		$this->load->view("account/view_quotation",$data);
		$this->admin_footer($data);
	}
	
	// View Quotation Log..
	public function view_quotation_log()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['title']='View Quotation';
		
		$enquiry_info=$this->quotation_model->get_enquiry_info($enquiry_id);
		$data['info'] = $enquiry_info;
		
		$quotation_info=$this->quotation_model->get_quotation_id($enquiry_id);
		$quotation_id = $quotation_info[0]['quotation_id'];
		
		$quotation_log = $this->quotation_model->get_quotation_log_info($quotation_id);
		$data['quotation_log'] = $quotation_log;
		
		$quotation = $this->log_quotation($quotation_id);
		$data['quotation_info'] = $quotation;
		
		$this->admin_header($data);
		$this->load->view("account/view_quotation_log",$data);
		$this->admin_footer($data);
	}
	
	// Quotation Followup..
	public function quotation_followup()
	{
		$enquiry_id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$data['title']='Quotation Followup';
		
		$enquiry_info=$this->quotation_model->get_enquiry_info($enquiry_id);
		$data['info'] = $enquiry_info;
		
		$quotation_info=$this->quotation_model->get_quotation_id($enquiry_id);
		$quotation_id = $quotation_info[0]['quotation_id'];
		
		$data['followup_action'] =  $this->quotation_model->get_followup_action();
		$data['flp'] =  $this->quotation_model->quotation_followup_data($quotation_id);
		$quotation = $this->log_quotation($quotation_id);
		$data['quotation_info'] = $quotation;
		
		$this->admin_header($data);
		$this->load->view("account/quotation_followup",$data);
		$this->admin_footer($data);
	}
	
		//Going to add Followup...
	public function add_followup()
	
	{
		// echo"<pre>";
		// print_r($_POST);		
		// exit();
		
		$flp_action = $this->security->xss_clean(trim($this->input->post("flp_action")));
		$next_followup_date= $this->security->xss_clean(trim($this->input->post("next_followup_date")));		
		$comment= $this->security->xss_clean(trim($this->input->post("comment")));		
		$enquiry_id= $this->security->xss_clean(trim($this->input->post("enquiry_id")));		
		$enquiry_code= $this->security->xss_clean(trim($this->input->post("enquiry_code")));		
		$quotation_id= $this->security->xss_clean(trim($this->input->post("quotation_id")));		
		$quotation_code= $this->security->xss_clean(trim($this->input->post("quotation_code")));		
		$user = $this->session->userdata("user");
				
		if($flp_action == 3)
		{
			$followup_status = 3;
			$quotation_followup_status = 'True';
			$next_followup_date = '';
		}
		elseif($flp_action == 4)
		{
			$followup_status = 4;
			$quotation_followup_status = 'False';
			$next_followup_date = '';
		}else{
			$followup_status = 2;
			$quotation_followup_status = 'Pending';
		}		
		
		$ar=array();
		$ar['id']=0;
		$ar['followup_action'] = $flp_action;
		if($next_followup_date!='Pending')
		{
			$ar['next_followup_date'] = date('Y-m-d', strtotime($next_followup_date));
		}
		else
		{
			$ar['next_followup_date'] = '';
		}
		
		$ar['followup_comment'] = $comment;
		$ar['added_by'] = $user['id'];
		$ar['enquiry_id'] = $enquiry_id;
		$ar['enquiry_code'] = $enquiry_code;
		$ar['quotation_id'] = $quotation_id;
		$ar['quotation_code'] = $quotation_code;
		$ar['department'] = $user['department_id'];		
		$ar['add_date'] = date("Y-m-d");
		$ar['followup_status'] = $followup_status;
		
		$add=$this->quotation_model->add_followup($ar);
		if($add)
		{
			if($quotation_followup_status != '')
			{
				$update = $this->quotation_model->update_quotation_followup_status($quotation_followup_status,$enquiry_id);
			
				if($update)
				{
					$this->session->set_flashdata('success', 'Followup has been successfully added');
					redirect("account/quotation/quotation_followup?id=$enquiry_id");
				}else{
					$this->session->set_flashdata('error', 'Something is problem please try again.');
					redirect("account/quotation/quotation_followup?id=$enquiry_id");
				}	
				
			}
			$this->session->set_flashdata('success', 'Followup has been successfully added');
			redirect("account/quotation/quotation_followup?id=$enquiry_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/quotation/quotation_followup?id=$enquiry_id");
		}
	}
	
	//Update Followup Information..
	public function update_quotation_followup()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$flp_action = $this->security->xss_clean(trim($this->input->post("flp_action")));
		$next_followup_date= $this->security->xss_clean(trim($this->input->post("next_followup_date")));		
		$comment= $this->security->xss_clean(trim($this->input->post("comment")));		
		$added_by= $this->security->xss_clean(trim($this->input->post("added_by")));		
		$enquiry_id= $this->security->xss_clean(trim($this->input->post("enquiry_id")));		
		$quotation_id = $this->security->xss_clean(trim($this->input->post("quotation_id")));		
		$followup_id= $this->security->xss_clean(trim($this->input->post("followup_id")));		
		
		$ar=array();
			
		$user = $this->session->userdata("user");
				
		if($flp_action == 3)
		{
			$followup_status = 3;			
			$quotation_followup_status = 'True';
			$next_followup_date = '';
		}
		elseif($flp_action == 4)
		{
			$followup_status = 4;
			$quotation_followup_status = 'False';
			$next_followup_date = '';
		}else{
			$followup_status = 2;
		}
		
		if($next_followup_date!='')
		{
			$ar['next_followup_date'] = date('Y-m-d', strtotime($next_followup_date));
		}
		$ar['followup_action'] = $flp_action;
		$ar['followup_comment'] = $comment;
		$ar['enquiry_id'] = $enquiry_id;
		$ar['quotation_id'] = $quotation_id;
		$ar['followup_status'] = $followup_status;
		$ar['added_by'] = $user['id'];
		$ar['department'] = $user['department_id'];	
		$ar['modify_date']=date("Y-m-d");		
		
		$update=$this->quotation_model->update_followup($ar,$followup_id);
		
		if($update)
		{
			$update = $this->quotation_model->update_quotation_followup_status($quotation_followup_status,$quotation_id);
			
			$this->session->set_flashdata('success', 'Followup information has been successfully updated.');
			redirect("account/quotation/quotation_followup?id=$enquiry_id");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/quotation/quotation_followup?id=$enquiry_id");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/quotation/index");
	}
	
	
	
	
	
	
}
?>