<?php
class Enquiry_model extends CI_Model
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

		$this->db->select('en.id, en.enquiry_code, en.order_type, en.company_name, cust.name, cust.email, cust.phone, cust.city, cust.pincode, cust.address, cust.pan, cust.tan, cust.gst, cust.aadhar, en.added_by, en.add_date, en.modify_date, en.status, en.enquiry_followup_status, user.first_name, user.last_name, state.stateNAme,country.countryName');

		if(sizeof($filter)>0)
		{  
			if(isset($filter['it_enquiry_code']) && $filter['it_enquiry_code']!="")
			{
				$this->db->like('en.enquiry_code',$filter['it_enquiry_code']);
			}
			if(isset($filter['it_order_type']) && $filter['it_order_type']!="")
			{
				$this->db->like('en.order_type',$filter['it_order_type']);
			}
			if(isset($filter['it_compny_name']) && $filter['it_compny_name']!="")
			{
				$this->db->like('en.company_name',$filter['it_compny_name']);
			}
			if(isset($filter['it_name']) && $filter['it_name']!="")
			{
				$this->db->like('en.contact_person_name',$filter['it_name']);
			}			
			if(isset($filter['it_status']) && $filter['it_status']!="")
			{
				$this->db->like('en.status',$filter['it_name']);
			}
			if(isset($filter['it_email']) && $filter['it_email']!="")
			{
				$this->db->like('en.email',$filter['it_email']);
			}
			if(isset($filter['it_phone']) && $filter['it_phone']!="")
			{
				$this->db->like('en.contact_number',$filter['it_phone']);
			}
			if(isset($filter['it_added_by']) && $filter['it_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['it_added_by']);
			}
			if(($filter['it_add_date']) && $filter['it_add_date']!="")
			{
				$this->db->like('en.add_date',$filter['it_add_date']);
			}
			if(isset($filter['it_modify_date']) && $filter['it_modify_date']!="")
			{
				$this->db->like('en.modify_date',$filter['it_modify_date']);
			}			
			
		}
		
		$this->db->order_by('en.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_enquery en');
		$this->db->join('wi_users user','en.added_by = user.id');
		$this->db->join('wi_customer cust','en.company_name = cust.cust_id');
		$this->db->join("wi_countries country","country.countryID=cust.country");
		$this->db->join("wi_states state","state.stateID=cust.state");
		$re=$this->db->get();
		
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
			if(isset($filter['it_order_type']) && $filter['it_order_type']!="")
			{
				$this->db->like('en.order_type',$filter['it_order_type']);
			}
			if(isset($filter['it_compny_name']) && $filter['it_compny_name']!="")
			{
				$this->db->like('en.company_name',$filter['it_compny_name']);
			}
			if(isset($filter['it_name']) && $filter['it_name']!="")
			{
				$this->db->like('en.contact_person_name',$filter['it_name']);
			}			
			if(isset($filter['it_status']) && $filter['it_status']!="")
			{
				$this->db->like('en.status',$filter['it_name']);
			}
			if(isset($filter['it_email']) && $filter['it_email']!="")
			{
				$this->db->like('en.email',$filter['it_email']);
			}
			if(isset($filter['it_phone']) && $filter['it_phone']!="")
			{
				$this->db->like('en.contact_number',$filter['it_phone']);
			}
			if(isset($filter['it_added_by']) && $filter['it_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['it_added_by']);
			}
			if(($filter['it_add_date']) && $filter['it_add_date']!="")
			{
				$this->db->like('en.add_date',$filter['it_add_date']);
			}
			if(isset($filter['it_modify_date']) && $filter['it_modify_date']!="")
			{
				$this->db->like('en.modify_date',$filter['it_modify_date']);
			}				
			
		}
		
		$this->db->order_by('en.id','DESC');
		$this->db->from('wi_enquery en');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_enquiry($ar)
	{
		$this->db->insert("wi_enquery",$ar);
		return $this->db->insert_id();
	}
	
	//Going to add user to database...
	public function add_enquiry_items($ar)
	{
		$this->db->insert("wi_enquiry_items",$ar);
		return $this->db->insert_id();
	}

	//Fetching Enquiry info...
	public function enquiry_info($enquiry_id)
	{
		$this->db->select('en.id, en.order_type, cust.name, cust.cust_id, cust.email, cust.phone, cust.city, cust.pincode, cust.address, cust.pan, cust.tan, cust.gst, cust.aadhar, en.added_by, en.order_date, state.stateNAme, country.countryName');
		$this->db->where("en.id",$enquiry_id);		
		
		$this->db->from('wi_enquery en');
		$this->db->join('wi_customer cust','en.company_name = cust.cust_id');
		$this->db->join("wi_countries country","country.countryID=cust.country");
		$this->db->join("wi_states state","state.stateID=cust.state");
		$re=$this->db->get();
		
		$result=$re->result_array();
		
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['cust_id']=$result[0]['cust_id'];
			$ar['order_type']=$result[0]['order_type'];
			$ar['name']=$result[0]['name'];				
			$ar['phone']=$result[0]['phone'];			
			$ar['email']=$result[0]['email'];
			$ar['countryName']=$result[0]['countryName'];
			$ar['stateNAme']=$result[0]['stateNAme'];
			$ar['city']=$result[0]['city'];
			$ar['pincode']=$result[0]['pincode'];
			$ar['address']=$result[0]['address'];
			$ar['pan']=$result[0]['pan'];
			$ar['tan']=$result[0]['tan'];
			$ar['gst']=$result[0]['gst'];
			$ar['aadhar']=$result[0]['aadhar'];			
			$ar['order_date']=$result[0]['order_date'];	
		}
		else
		{
			$ar['id']='';
			$ar['order_type']='';
			$ar['name']='';				
			$ar['phone']='';			
			$ar['email']='';
			$ar['countryName']='';
			$ar['stateNAme']='';
			$ar['city']='';
			$ar['pincode']='';
			$ar['address']='';
			$ar['pan']='';
			$ar['tan']='';
			$ar['gst']='';
			$ar['aadhar']='';			
			$ar['order_date']='';	
		}
		return $ar;
	}
	
	
	// Fetching The company Contact Person Info...
	public function cust_contact_info($cut_id)
	{
		$this->db->select('*');
		$this->db->where("cust_id",$cut_id);		
		$this->db->from('wi_customer_contacts');
		$re=$this->db->get();
		return $result=$re->result_array();
				
		/* $ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['name']=$result[0]['name'];
			$ar['phone']=$result[0]['phone'];				
			$ar['email']=$result[0]['email'];
		}
		else
		{
			$ar['id']='';
			$ar['name']='';
			$ar['phone']='';				
			$ar['email']='';
		}
		return $ar; */
	}
	
	
	//Fetching The Enquiry Items INfo..
	public function enquiry_items_info($enquiry_id)
	{
		$this->db->select("*");
		$this->db->where("enquiry_id",$enquiry_id);
		$re=$this->db->get('wi_enquiry_items');
		return $result=$re->result_array();
		
	}

	//Going to update Enquiry information...
	public function update($ar,$enquiry_id)
	{
		$this->db->where("id",$enquiry_id);
		return $this->db->update("wi_enquery",$ar);
	}
	
	//delete items ..
	public function delete_items($enquiry_id)
	{
		$this->db->where("enquiry_id",$enquiry_id);
		return $this->db->delete("wi_enquiry_items");
	}

	//get un_assigned Enquiry..
	public function get_unassigned_enquiry($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");
		
		$this->db->select('enq.id, enq.order_type, enq.company_name, enq.enquiry_code, enq.order_date, enq.add_date, enq.status, user.first_name, user.last_name, cust.name, cust.email, cust.phone, cust.city, cust.pincode,');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users user","enq.added_by=user.id");
		$this->db->join("wi_customer cust","enq.company_name = cust.cust_id");

		if(sizeof($filter)>0)
		{			
			if(isset($filter['uns_compny_name']) && $filter['uns_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['uns_compny_name']);
			}
			if(isset($filter['uns_order_type']) && $filter['uns_order_type']!="")
			{
				$this->db->like('enq.order_type',$filter['uns_order_type']);
			}
			if(isset($filter['uns_email']) && $filter['uns_email']!="")
			{
				$this->db->like('cust.email',$filter['uns_email']);
			}
			if(isset($filter['uns_phone']) && $filter['uns_phone']!="")
			{
				$this->db->like('cust.phone',$filter['uns_phone']);
			}
			if(isset($filter['uns_added_by']) && $filter['uns_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['uns_added_by']);
			}
			
		}
		
		$this->db->order_by('enq.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->where ('enq.assign_to ', NULL);
		$this->db->where ('enq.status ', 'True');
		$this->db->where ('enq.enquiry_followup_status ', 'Pending');
		$re=$this->db->get();
		/*  echo $this->db->last_query();
		exit(); */
		
		$data['total'] = $this->unassign_count_total($admin['id']);		
		$data['data']  = $re->result_array();
	    return $data; 
	    
	}
	
	public function unassign_count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('enq.id');

		if(sizeof($filter)>0)
		{
			/* if(isset($filter['uns_compny_name']) && $filter['uns_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['uns_compny_name']);
			}
			if(isset($filter['uns_order_type']) && $filter['uns_order_type']!="")
			{
				$this->db->like('enq.order_type',$filter['uns_order_type']);
			}
			if(isset($filter['uns_email']) && $filter['uns_email']!="")
			{
				$this->db->like('cust.email',$filter['uns_email']);
			}
			if(isset($filter['uns_phone']) && $filter['uns_phone']!="")
			{
				$this->db->like('cust.phone',$filter['uns_phone']);
			}
			if(isset($filter['uns_added_by']) && $filter['uns_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['uns_added_by']);
			} */			
			
		}		
		$this->db->order_by('enq.id','DESC');
		$this->db->from('wi_enquery enq');
		$this->db->where('enq.assign_to ', NULL);
		$this->db->where('enq.status ', 'True');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}
	
	// update the Enquiry Quantity..
	public function uodate_quantity($row_id, $qty, $enquiry_id)
	{
		$this->db->set('quantity', $qty);
		$this->db->where('id', $row_id);
		$this->db->where('enquiry_id', $enquiry_id);
		return $this->db->update('wi_enquiry_items');
	}
	
	// deleteing the Enquiry Quantity..
	public function delete_quantity($row_id)
	{
		$this->db->where('id', $row_id);
		return $this->db->delete('wi_enquiry_items');
	}
	
	//get all department ..
	public function get_deprtment()
	{
		$this->db->select('departement.id, departement.department_name');
		$this->db->where('status','True');
		$res=$this->db->get('wi_department departement' );
		return $res->result_array();
	}	
	
	// fetching The Department Employee..
	public function department_employee($departemnt_id)
	{
		$this->db->select("usr_dept.id, usr_dept.dept_id, usr_dept.dsg_id, usr_dept.user_id, user.first_name, user.last_name, designation.designation_name");
		$this->db->from('wi_users_departmnet usr_dept');
		$this->db->join('wi_users user', 'user.id=usr_dept.user_id');
		$this->db->join('wi_designation designation', 'designation.id=usr_dept.dsg_id');
		$this->db->where('usr_dept.dept_id', $departemnt_id);
		//$this->db->where('usr_dept.team_id', $team_id);
		$re=$this->db->get();
		 
		return $re->result_array();
	}

	// Fetching Customer Details..
	public function customer_details()
	{
		$this->db->select("cust_id, name");
		//$this->db->where('status','True');
		$re=$this->db->get('wi_customer');
		return $result=$re->result_array();		
	}
	
	// for assign Enquiry to employee..
	public function assign_enquiry_to_emp($enquiry_id, $employee_id, $departemnt_id, $turn_out_time)
	{	/* echo $enquiry_id;
		exit(); */
		$assign_date = date("Y-m-d");
		
		//$assign_date  = $date('Y-m-d');
		$this->db->where("id",$enquiry_id);
		$this->db->set('assign_to', $employee_id);
		$this->db->set('department_id', $departemnt_id);
		$this->db->set('turn_out_time', $turn_out_time);
		$this->db->set('assign_date', $assign_date);
		return $this->db->update("wi_enquery");
	}
	
	//get assigned Enquiry..
	public function get_assigned_enquiry($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('enq.id, enq.order_type, enq.company_name, enq.order_date, enq.enquiry_code, enq.add_date, enq.status, user.first_name, user.last_name, cust.name, cust.email, cust.phone, cust.city, cust.pincode, enq.assign_to, us.first_name assign_fname, us.last_name assign_lname,');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users user","enq.added_by=user.id");
		$this->db->join("wi_users us","enq.assign_to=us.id");
		$this->db->join("wi_customer cust","enq.company_name = cust.cust_id");

		if(sizeof($filter)>0)
		{
			/* echo"<pre>";
			print_r($filter);
			exit('filter data'); */
			
			
			if(isset($filter['as_compny_name']) && $filter['as_compny_name']!="")
			{
				$this->db->like('cust.name',$filter['as_compny_name']);
			}
			if(isset($filter['as_order_type']) && $filter['as_order_type']!="")
			{
				$this->db->like('enq.order_type',$filter['as_order_type']);
			}
			if(isset($filter['as_email']) && $filter['as_email']!="")
			{
				$this->db->like('cust.email',$filter['as_email']);
			}
			if(isset($filter['as_phone']) && $filter['as_phone']!="")
			{
				$this->db->like('cust.phone',$filter['as_phone']);
			}			
			if(isset($filter['as_first_name']) && $filter['as_first_name']!="")
			{
				$this->db->like('us.first_name',$filter['as_first_name']);
			}
			
		}

		$this->db->order_by('enq.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->where ('enq.assign_to !=', NULL);
		$this->db->where ('enq.status ', 'True');
		//$this->db->where ('enq.enquiry_followup_status ', 'True');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$data['total'] = $this->total_count_assigned($admin['id']);
		$data['data']  = $re->result_array();
	    return $data;
	}

	public function total_count_assigned($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('enq.id');

		/* if(sizeof($filter)>0)
		{
			if(isset($filter['it_order_type']) && $filter['it_order_type']!="")
			{
				$this->db->like('en.order_type',$filter['it_order_type']);
			}
			if(isset($filter['it_compny_name']) && $filter['it_compny_name']!="")
			{
				$this->db->like('en.company_name',$filter['it_compny_name']);
			}
			if(isset($filter['it_name']) && $filter['it_name']!="")
			{
				$this->db->like('en.contact_person_name',$filter['it_name']);
			}			
			if(isset($filter['it_status']) && $filter['it_status']!="")
			{
				$this->db->like('en.status',$filter['it_name']);
			}
			if(isset($filter['it_email']) && $filter['it_email']!="")
			{
				$this->db->like('en.email',$filter['it_email']);
			}
			if(isset($filter['it_phone']) && $filter['it_phone']!="")
			{
				$this->db->like('en.contact_number',$filter['it_phone']);
			}
			if(isset($filter['it_added_by']) && $filter['it_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['it_added_by']);
			}
			if(($filter['it_add_date']) && $filter['it_add_date']!="")
			{
				$this->db->like('en.add_date',$filter['it_add_date']);
			}
			if(isset($filter['it_modify_date']) && $filter['it_modify_date']!="")
			{
				$this->db->like('en.modify_date',$filter['it_modify_date']);
			}				
			
		}		
		 */
		$this->db->order_by('enq.id','DESC');
		$this->db->from('wi_enquery enq');
		$this->db->where('enq.assign_to !=', NULL);
		$this->db->where('enq.status ', 'True');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}
	
	// UnAssign User..
	public function unassign_emp_enquiry($enquiry_id, $ar)
	{
		$this->db->where("id",$enquiry_id);
		return $this->db->update("wi_enquery",$ar);
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
	
	//Fetch Last Enquiry Id..
	public function fetch_last_enquiry_id()
	{
		$this->db->select_max('id');
		$re = $this->db->get('wi_enquery');		
		$result = $re->result_array();
		return $tot = $result[0]['id']+1;
		
	}
	
	//Direct moved For Quotation..
	public function direct_move_to_quotation($ar)
	{ 
		$this->db->insert("wi_enquiry_followup",$ar);
		return $this->db->insert_id();
	}
	
	// View report..
	public function followup_report ($enquiry_id)
	{
		$this->db->select('enq.id, enq.enquiry_code, enq.order_type, enq.assign_to, enq.department_id, enq.turn_out_time, enq.assign_date, enq.company_name, enq.order_date, enq.added_by, enq.add_date, enq.quotation_status, enq.enquiry_followup_status, us.first_name added_by_f_name, us.last_name added_by_l_name, uss.first_name assign_to_f_name, uss.last_name assign_to_l_name, cust.name');
		$this->db->from('wi_enquery enq');
		$this->db->join("wi_users us","enq.added_by=us.id");
		$this->db->join("wi_users uss","enq.assign_to=uss.id");
		$this->db->join('wi_customer cust','enq.company_name = cust.cust_id');
		$this->db->where('enq.id',$enquiry_id);
		$re=$this->db->get();
		$result=$re->result_array();
		
		$arr = array();
		if(sizeof($result>0))
		{
			$arr['id'] = $result[0]['id'];
			$arr['enquiry_code'] = $result[0]['enquiry_code'];
			$arr['order_type'] = $result[0]['order_type'];
			$arr['assign_to'] = $result[0]['assign_to'];
			$arr['department_id'] = $result[0]['department_id'];
			$arr['turn_out_time'] = $result[0]['turn_out_time'];
			$arr['assign_date'] = $result[0]['assign_date'];
			$arr['company_name'] = $result[0]['company_name'];
			$arr['order_date'] = $result[0]['order_date'];
			$arr['added_by'] = $result[0]['added_by'];
			$arr['add_date'] = $result[0]['add_date'];
			$arr['quotation_status'] = $result[0]['quotation_status'];
			$arr['enquiry_followup_status'] = $result[0]['enquiry_followup_status'];
			$arr['added_by_f_name'] = $result[0]['added_by_f_name'];
			$arr['added_by_l_name'] = $result[0]['added_by_l_name'];
			$arr['assign_to_f_name'] = $result[0]['assign_to_f_name'];
			$arr['assign_to_l_name'] = $result[0]['assign_to_l_name'];
			$arr['customer_name'] = $result[0]['name'];
			$arr['followup_details'] = $this->get_enquiry_followup($result[0]['id']);
			
		}
		
		return $arr;
	}
}


?>