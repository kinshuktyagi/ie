<?php
class Enquiry_followup_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	

	//Fetching Department detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");
		
		$user =$this->session->userdata("user");		
		$user_id = $user['id'];
		$report_to_employee = $this->report_to_data($user_id);

		$this->db->select('enq.id, enq.order_type, enq.order_date, enq.enquiry_code, cust.name, cust.email, cust.phone, us.first_name, us.last_name');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users us","enq.assign_to=us.id");
		$this->db->join('wi_customer cust', 'enq.company_name=cust.cust_id');
	
		if(sizeof($filter)>0)
		{
			if(isset($filter['flp_first_name']) && $filter['flp_first_name']!="")
			{
				$this->db->like('us.first_name',$filter['flp_first_name']);
			}
			if(isset($filter['flp_compny_name']) && $filter['flp_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['flp_compny_name']);
			}
			if(isset($filter['flp_order_type']) && $filter['flp_order_type']!="")
			{
				$this->db->like('enq.order_type',$filter['flp_order_type']);
			}
			if(isset($filter['flp_email']) && $filter['flp_email']!="")
			{
				$this->db->like('cust.email',$filter['flp_email']);
			}
			if(isset($filter['flp_phone']) && $filter['flp_phone']!="")
			{
				$this->db->like('cust.phone',$filter['flp_phone']);
			}
			
		}
		
		if ($user['user_type'] == 2)
		{
			if (sizeof($report_to_employee) > 0)
			{
				$this->db->where_in('enq.assign_to', $report_to_employee);				
			}else{
				$this->db->where_in('us.id',$user_id);
			}
		}
		elseif ($user['user_type'] == 3) 
		{
			$this->db->where_in('us.id',$user_id);
		}		
		
		$this->db->where('enq.enquiry_followup_status','pending');
		$this->db->order_by('enq.id','DESC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		
		/* echo "<pre>";
		print_r($user);
		exit();
		echo"<br>";
		echo $this->db->last_query();
		exit(); */
		
		$data['total'] = $this->count_total($admin['id']);		
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('enq.order_type, enq.order_date, cust.name, cust.email, cust.phone');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users us","enq.assign_to=us.id");
		$this->db->join('wi_customer cust', 'enq.company_name=cust.cust_id');

		if(sizeof($filter)>0)
		{
			/* if(isset($filter['dep_department_name']) && $filter['dep_department_name']!="")
			{
				$this->db->like('dp.department_name',$filter['dep_department_name']);
			}
			if(isset($filter['dep_department_description']) && $filter['dep_department_description']!="")
			{
				$this->db->like('dp.description',$filter['dep_department_description']);
			}
			if(isset($filter['dep_department_status']) && $filter['dep_department_status']!="")
			{
				$this->db->like('dp.status',$filter['dep_department_status']);
			}	 */			
			
		}
		
		$this->db->order_by('enq.id','DESC');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_followup($ar)
	{
		$this->db->insert("wi_enquiry_followup",$ar);
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function department_info($dept)
	{
		$this->db->select("*");
		$this->db->where("id",$dept);
		$re=$this->db->get('wi_department');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['department_name']=$result[0]['department_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']		='';
			$ar['department_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update_followup($ar,$followup_id)
	{
		$this->db->where("id",$followup_id);
		return $this->db->update("wi_enquiry_followup",$ar);
	}

	// Getting Enquiry Information..
	public function get_enquiry($enquiry_id)
	{
		$this->db->select('enq.id, enq.order_type, enq.assign_to, enq.department_id, enq.order_date, cust.name, cust.email, cust.phone, us.first_name, us.last_name');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users us","enq.assign_to=us.id");
		$this->db->join('wi_customer cust', 'enq.company_name=cust.cust_id');
	
		$this->db->where('enq.id',$enquiry_id);
		$re=$this->db->get();
		$result=$re->result_array();		
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['order_type']=$result[0]['order_type'];
			$ar['assign_to']=$result[0]['assign_to'];			
			$ar['department_id']=$result[0]['department_id'];			
			$ar['order_date']=$result[0]['order_date'];			
			$ar['name']=$result[0]['name'];			
			$ar['email']=$result[0]['email'];			
			$ar['phone']=$result[0]['phone'];			
			$ar['first_name']=$result[0]['first_name'];			
			$ar['last_name']=$result[0]['last_name'];			
		}
		else
		{
			$ar['id']		='';
			$ar['order_type']='';
			$ar['assign_to']='';			
			$ar['department_id']='';			
			$ar['order_date']='';			
			$ar['name']='';			
			$ar['email']='';			
			$ar['phone']='';			
			$ar['first_name']='';			
			$ar['last_name']='';	
		}
		return $ar;
		
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

	// Fetching all Follwoup Data for enquiry..
	public function get_enquiry_followup($enquiry_id)
	{
		$this->db->select('enq.id, enq.enquiry_id, enq.followup_action, enq.followup_status, enq.next_followup_date, enq.followup_comment, enq.add_date, us.first_name, us.last_name, flp.action_name, st.status_name');
		$this->db->from('wi_enquiry_followup enq');
		$this->db->join("wi_users us","enq.added_by=us.id");
		$this->db->join("wi_enquiry_followup_action flp","enq.followup_action=flp.action_id");
		$this->db->join("wi_enquiry_followup_status st","enq.followup_status=st.status_id");
	
		$this->db->where('enq.enquiry_id',$enquiry_id);
		$this->db->order_by('enq.id','DESC');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		return $result=$re->result_array();
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
	
	// Update Enquiry Follwoup Status..
	public function update_enquiry_followup_status($enquiry_followup_status,$enquiry_id)
	{
		$this->db->where("id",$enquiry_id);
		$this->db->set("enquiry_followup_status",'False');
		return $this->db->update("wi_enquery");
		
	}
}


?>