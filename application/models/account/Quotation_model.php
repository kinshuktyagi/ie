<?php
class Quotation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	//Fetching Quotation detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");
		
		/* $user =$this->session->userdata("user");		
		$user_id = $user['id'];
		
		$report_to_employee = $this->report_to_data($user_id); */
		
		$this->db->select('en.id, en.order_type, en.company_name, cust.name, cust.email, cust.phone, en.added_by, user.first_name, user.last_name, en.enquiry_code, en.quotation_status, quotation.quotation_code, en.quotation_followup_status');

		if(sizeof($filter)>0)
		{
			if(isset($filter['itq_enquiry_code']) && $filter['itq_enquiry_code']!="")
			{
				$this->db->like('en.enquiry_code',$filter['itq_enquiry_code']);
			}
			if(isset($filter['itq_compny_name']) && $filter['itq_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['itq_compny_name']);
			}
			if(isset($filter['itq_order_type']) && $filter['itq_order_type']!="")
			{
				$this->db->like('en.order_type',$filter['itq_order_type']);
			}
			if(isset($filter['itq_email']) && $filter['itq_email']!="")
			{
				$this->db->like('en.email',$filter['itq_email']);
			}
			if(isset($filter['itq_phone']) && $filter['itq_phone']!="")
			{
				$this->db->like('en.phone',$filter['itq_phone']);
			}
			/* if(isset($filter['itq_added_by']) && $filter['itq_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['itq_added_by']);
			} */
			if(isset($filter['itq_status']) && $filter['itq_status']!="")
			{
				$this->db->like('en.quotation_status',$filter['itq_status']);
			}
					
			
		}
		
		
		
		$this->db->order_by('en.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_enquery en');
		$this->db->join('wi_enquiry_quotation_main quotation', 'en.enquiry_code= quotation.enquiry_code', 'left');
		$this->db->join('wi_users user','en.added_by = user.id');
		$this->db->join('wi_customer cust','en.company_name = cust.cust_id');
		$this->db->join('wi_enquiry_followup flp','en.id = flp.enquiry_id');
		
		/* if ($user['user_type'] == 2)
		{
			if (sizeof($report_to_employee) > 0)
			{
				$this->db->where_in('enq.assign_to', $report_to_employee);				
			}else{
				$this->db->where_in('user.id',$user_id);
			}
		}
		 elseif ($user['user_type'] == 3) 
		{
			$this->db->where_in('user.id',$user_id);
		}  */
		
		$this->db->where('flp.followup_status','3');
		

		
		
		//$this->db->distict(1);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		
		$data['total'] = $this->count_total($admin['id']);
		
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('en.id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['itq_enquiry_code']) && $filter['itq_enquiry_code']!="")
			{
				$this->db->like('en.enquiry_code',$filter['itq_enquiry_code']);
			}
			if(isset($filter['itq_compny_name']) && $filter['itq_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['itq_compny_name']);
			}
			if(isset($filter['itq_order_type']) && $filter['itq_order_type']!="")
			{
				$this->db->like('en.order_type',$filter['itq_order_type']);
			}
			if(isset($filter['itq_email']) && $filter['itq_email']!="")
			{
				$this->db->like('en.email',$filter['itq_email']);
			}
			if(isset($filter['itq_phone']) && $filter['itq_phone']!="")
			{
				$this->db->like('en.phone',$filter['itq_phone']);
			}
			/* if(isset($filter['itq_added_by']) && $filter['itq_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['itq_added_by']);
			} */
			if(isset($filter['itq_status']) && $filter['itq_status']!="")
			{
				$this->db->like('en.quotation_status',$filter['itq_status']);
			}
			
		}
		
		$this->db->order_by('en.id','DESC');
		$this->db->from('wi_enquery en');
		$this->db->join('wi_users user','en.added_by = user.id');
		$this->db->join('wi_customer cust','en.company_name = cust.cust_id');
		$this->db->join('wi_enquiry_followup flp','en.id = flp.enquiry_id');
		$this->db->where('flp.followup_status','3');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	// fetching the Enquiry Information..
	public function get_enquiry_info($enquiry_id)
	{
		$this->db->select('enq.id,enq.enquiry_code, enq.order_type, enq.assign_to, enq.department_id, enq.added_by, cust.name, cust.email, cust.phone, cust.city, cust.pincode, cust.address, cust.gst, cust.pan, cust.tan, cust.aadhar, cntry.countryName, stat.stateName, flp.followup_status ');
		$this->db->from('wi_enquery enq');
		$this->db->join('wi_customer cust','enq.company_name = cust.cust_id');
		$this->db->join('wi_countries cntry','cust.country = cntry.countryID');
		$this->db->join('wi_states stat','cust.state = stat.stateID');
		$this->db->join('wi_enquiry_followup flp','enq.id = flp.enquiry_id');
		$this->db->where('flp.followup_status', '3');
		$this->db->where('enq.id', $enquiry_id);
		$re=$this->db->get();
		$result =$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['enquiry_code']=$result[0]['enquiry_code'];
			$ar['order_type']=$result[0]['order_type'];
			$ar['assign_to']=$result[0]['assign_to'];
			$ar['department_id']=$result[0]['department_id'];
			$ar['added_by']=$result[0]['added_by'];
			$ar['name']=$result[0]['name'];
			$ar['email']=$result[0]['email'];
			$ar['phone']=$result[0]['phone'];
			$ar['city']=$result[0]['city'];
			$ar['pincode']=$result[0]['pincode'];
			$ar['address']=$result[0]['address'];
			$ar['pan']=$result[0]['pan'];
			$ar['tan']=$result[0]['tan'];
			$ar['gst']=$result[0]['gst'];
			$ar['aadhar']=$result[0]['aadhar'];
			$ar['countryName']=$result[0]['countryName'];
			$ar['stateName']=$result[0]['stateName'];	
		}
		else
		{
			$ar['id']='';
			$ar['enquiry_code']='';
			$ar['order_type']='';
			$ar['assign_to']='';
			$ar['department_id']='';
			$ar['added_by']='';
			$ar['name']='';
			$ar['email']='';
			$ar['phone']='';
			$ar['city']='';
			$ar['pincode']='';
			$ar['address']='';
			$ar['pan']='';
			$ar['tan']='';
			$ar['gst']='';
			$ar['aadhar']='';
			$ar['countryName']='';
			$ar['stateName']='';
		}
		return $ar;
	}
	
	// Fetching Enquiry Items Information..
	public function enquiry_items($enquiry_id)
	{
		$this->db->select('id, drawing_number, part_name, quantity, weight, drawing, cad,description');
		$this->db->from('wi_enquiry_items');
		$this->db->where('enquiry_id', $enquiry_id);
		$re=$this->db->get();
		return $result =$re->result_array();
	}
	
	// Add Quotation ..
	public function add_enquiry_quotation($ar)
	{ 
		$this->db->insert("wi_enquiry_quotation",$ar);
		return $this->db->insert_id();
	}
	
	// Fetching Quotation Information..
	public function get_quotation_info($enquiry_id)
	{
		$this->db->select('id, quotation_id, part_name, fabrication, stress_relieving, machining, powder_coating, labour_and_trans, total, add_date, added_by');
		$this->db->from('wi_enquiry_quotation');
		$re=$this->db->get();
		return $result =$re->result_array();
		/* echo $this->db->last_query();
		exit(); */
		
		/* $ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['enquiry_id']=$result[0]['enquiry_id'];
			$ar['part_name']=$result[0]['part_name'];
			$ar['fabrication']=$result[0]['fabrication'];
			$ar['stress_relieving']=$result[0]['stress_relieving'];
			$ar['machining']=$result[0]['machining'];
			$ar['powder_coating']=$result[0]['powder_coating'];
			$ar['labour_and_trans']=$result[0]['labour_and_trans'];
			$ar['total']=$result[0]['total'];
			$ar['add_date']=$result[0]['add_date'];
			$ar['added_by']=$result[0]['added_by'];
		}
		else
		{
			$ar['id']='';
			$ar['enquiry_id']='';
			$ar['part_name']='';
			$ar['fabrication']='';
			$ar['stress_relieving']='';
			$ar['machining']='';
			$ar['powder_coating']='';
			$ar['labour_and_trans']='';
			$ar['total']='';
			$ar['add_date']='';
			$ar['added_by']='';
		} 
		return $ar;*/
	}
	
	// Get the Enquiy ID..
	public Function get_quotation_id($enquiry_id)
	{
		$this->db->select('quotation_id');
		$this->db->from('wi_enquiry_quotation_main');
		$this->db->where('enquiry_id',$enquiry_id);
		$re=$this->db->get();
				
		return $result =$re->result_array();
	}
	
	// Update Quotation..
	public function update_quotation($quotation_id, $ar)
	{
		$this->db->where("id",$quotation_id);
		return $this->db->update("wi_enquiry_quotation",$ar);
		
		
	}
	
	// Add Quotation ..
	public function add_quotation_log($ar)
	{
		$this->db->insert("wi_enquiry_quotation_log",$ar);	
		/* echo $this->db->last_query();
		exit(); */
		return $this->db->insert_id();
		
	}
	
/* 	// Fetching Quotation Information..
	public function get_quotation_log_info($enquiry_id)
	{
		$this->db->select('id, quotation_id, enquiry_id, part_name, fabrication, stress_relieving, machining, powder_coating, labour_and_trans, total, add_date, added_by');
		$this->db->from('wi_enquiry_quotation_log');
		$this->db->where('wi_enquiry_quotation_log');
		$re=$this->db->get();		
		return $result =$re->result_array();
		
	} */
	
	public function update_enquiry_quotation_status($enquiry_id)
	{
		$this->db->set('quotation_status', 'True');
		$this->db->where("id",$enquiry_id);
		return $this->db->update("wi_enquery");
	}
	
	//Fetch Last Enquiry Id..
	public function fetch_last_quotation_id()
	{
		$this->db->select_max('quotation_id');
		$re = $this->db->get('wi_enquiry_quotation_main');
		$result = $re->result_array();
		return  $result[0]['quotation_id']+1;
		
	}
	
	//Going to add into main Table..
	public function add_enquiry_quotation_main($arr)
	{
		$this->db->insert("wi_enquiry_quotation_main",$arr);	
		
		return $this->db->insert_id();
	}
	
	
	public function get_quotaion_info($quotation_id)
	{
		
		$this->db->select('qut.enquiry_id, qut.quotation_id, qut.enquiry_code, qut.add_date, qut.status, qut.modify_date, qut.quotation_code, qut.tnc, wtnc.tnc_name, profit_percentage');
		$this->db->from('wi_enquiry_quotation_main qut');
		$this->db->from('wi_tnc wtnc','qut.tnc=wtnc.tnc_id');
		$this->db->where('quotation_id', $quotation_id);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$result =$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['enquiry_id']=$result[0]['enquiry_id'];
			$ar['quotation_id']=$result[0]['quotation_id'];
			$ar['enquiry_code']=$result[0]['enquiry_code'];
			$ar['status']=$result[0]['status'];
			$ar['tnc']=$result[0]['tnc'];
			$ar['tnc_name']=$result[0]['tnc_name'];
			$ar['profit_percentage']=$result[0]['profit_percentage'];
			$ar['modify_date']=$result[0]['modify_date'];
			$ar['quotation_code']=$result[0]['quotation_code'];
			$ar['add_date']=$result[0]['add_date'];
			$ar['product']=$this->get_quotation_product($result[0]['quotation_id']);
		}
		else
		{
			$ar['enquiry_id']='';
			$ar['tnc']='';
			$ar['tnc_name']='';
			$ar['profit_percentage']='';
			$ar['quotation_id']='';
			$ar['part_name']='';
			$ar['fabrication']='';
			$ar['stress_relieving']='';
			$ar['machining']='';
			$ar['powder_coating']='';
			$ar['labour_and_trans']='';
			$ar['total']='';
			$ar['add_date']='';
			$ar['added_by']='';
		} 
		return $ar;
	}
	
	
	public function get_quotation_product($quotaion_id)
	{
		$this->db->select('enq.id, enq.quotation_id, enq.drawing_number, enq.part_name, enq.field, enq.price, enq.percentage, enq.total, enq.percentage,enq.add_date, enq.added_by, user.first_name, user.last_name, field.field_name');
		$this->db->from('wi_enquiry_quotation enq');
		$this->db->join('wi_users user','enq.added_by = user.id');
		$this->db->join('wi_field field','enq.field = field.id');
		$this->db->where('quotation_id', $quotaion_id);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		return $result =$re->result_array();
	}
	
	// Delete Quotation 
	public function delete_quotation($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('wi_enquiry_quotation');
	}
	
	// Fetch Fields Details..
	public function get_field_data()
	{
		$this->db->select('id, field_name');
		$this->db->where('status', 'True');
		$this->db->from('wi_field');
		$re=$this->db->get();
		
		return $result =$re->result_array();
	}
	
	// Fetching The log Information..
	public function get_quotation_log_info($quotation_id)
	{
		$this->db->select('que.id, que.quotation_id, que.quotation_sub_id, que.log_count, que.drawing_number, que.part_name, que.add_date, que.field, que.price, que.total, que.percentage, que.add_date, que.added_by, usr.first_name, usr.last_name, field.field_name ');
		$this->db->where('quotation_id', $quotation_id);
		$this->db->join('wi_users usr', 'que.added_by = usr.id');
		$this->db->join('wi_field field','que.field = field.id');
		$this->db->from('wi_enquiry_quotation_log que');
		$re = $this->db->get();
		return $result =$re->result_array();
	}
	
	// Fetching Follwoup Action
	public function get_followup_action()
	{
		$this->db->select('action_id, action_name');
		$this->db->from('wi_enquiry_followup_action');
		$this->db->where('status', 'True');
		$re=$this->db->get();
		return $result=$re->result_array();	
	}
	
	//Going to add user to database...
	public function add_followup($ar)
	{
		$this->db->insert("wi_quotation_followup",$ar);
		return $this->db->insert_id();
	}
	
	// Update Quotation Follwoup Status in Enquiry Table..
	public function update_quotation_followup_status($quotation_followup_status,$enquiry_id)
	{
		$this->db->where("id",$enquiry_id);
		$this->db->set("quotation_followup_status",$quotation_followup_status);
		return $this->db->update("wi_enquery");	
	}
	
	//Fetching The Quoatation Follwoup Data..
	public function quotation_followup_data($quotation_id)
	{		
		$this->db->select('quo.id, quo.enquiry_id, quo.quotation_id, quo.added_by, quo.followup_action, quo.followup_status, quo.next_followup_date, quo.followup_comment, quo.add_date, quo.modify_date, us.first_name, us.last_name, flp.action_name, st.status_name');
		$this->db->from('wi_quotation_followup quo');
		$this->db->order_by('quo.id','DESC');
		$this->db->join("wi_users us","quo.added_by=us.id");
		$this->db->join("wi_enquiry_followup_action flp","quo.followup_action=flp.action_id");
		$this->db->join("wi_enquiry_followup_status st","quo.followup_status=st.status_id");		
		$this->db->where('quo.quotation_id', $quotation_id);
		
		$re=$this->db->get();
		return $result=$re->result_array();	
	}
	
	//Going to update Department information...
	public function update_followup($ar,$followup_id)
	{
		$this->db->where("id",$followup_id);
		return $this->db->update("wi_quotation_followup",$ar);
	}
	
	//fetching all employee records under an employee...
	public function report_to_data($parent_id = 0, $ar = array())
	{
		$this->db->select('report.user_id, report.report_to');
		$this->db->from('wi_users_departmnet report');
		$this->db->where("report.report_to", $parent_id);
		$this->db->where("report.is_default",'True');
		$re=$this->db->get();		
		$data = $re->result_array();
		
		if (sizeof($data) > 1) 
		{
			for ($i=0; $i < sizeof($data); $i++) 
			{ 
				
				$ar[]=$data[$i]['user_id'];
				$ar = array_merge($this->report_to_data($data[$i]['user_id']), $ar);
				
			}
		}
		return $ar;		
		
	}
	
	//Fetching TNC..
	public function get_tnc_details()
	{
		$this->db->select('tnc_name, tnc_id');
		$this->db->from('wi_tnc');
		$this->db->where('status','True');
		$re=$this->db->get();
		return $re->result_array();
	}
	
	// Update the quotation mAin Table..
	public function update_quotation_main($quotation_id, $tnc, $percentage)
	{
		$this->db->set('tnc', $tnc);
		$this->db->set('profit_percentage', $percentage);
		$this->db->where('quotation_id', $quotation_id);
		return $this->db->update('wi_enquiry_quotation_main');
		/* echo $this->db->last_query();
		exit(); */
		
	}
}


?>