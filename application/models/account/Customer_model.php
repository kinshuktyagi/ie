<?php
class customer_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	} 
		
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");
		$this->db->select("cust.cust_id, cust.name, cust.email, cust.phone, cust.city, cust.pincode, cust.address, cust.add_date, cust.modify_date, cust.status, cust.cust_code, state.stateNAme, country.countryName");
		$this->db->from("wi_customer cust");
		$this->db->join("wi_countries country","country.countryID=cust.country");
		$this->db->join("wi_states state","state.stateID=cust.state");
		
			if(sizeof($filter)>0)
			{
				if(isset($filter['cu_code']) && $filter['cu_code']!="")
				{
					$this->db->like('cust.cust_code',$filter['cu_code']);
				}
				if(isset($filter['cu_name']) && $filter['cu_name']!="")
				{
					$this->db->like('cust.name',$filter['cu_name']);
				}
				if(isset($filter['cu_phone']) && $filter['cu_phone']!="")
				{
					$this->db->like('cust.phone',$filter['cu_phone']);
				}
				if(isset($filter['cu_email']) && $filter['cu_email']!="")
				{
					$this->db->like('cust.email',$filter['cu_email']);
				}
				if(isset($filter['cu_city']) && $filter['cu_city']!="")
				{
					$this->db->like('cust.city',$filter['cu_city']);
				}
				
				if(isset($filter['cu_status']) && $filter['cu_status']!="")
				{
					$this->db->where('cust.status',$filter['cu_status']);					
				}
				
			}
		$this->db->order_by('cust.cust_id','DESC');
		$this->db->limit($limit, $offset);		
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$data['total'] = $this->count_total($admin['id']);
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");		
		$this->db->select("cust.cust_id");
		$this->db->from("wi_customer cust");
		$this->db->join("wi_countries country","country.countryID=cust.country");
		$this->db->join("wi_states state","state.stateID=cust.state");
		
			if(sizeof($filter)>0)
			{
				if(isset($filter['cu_name']) && $filter['cu_name']!="")
				{
					$this->db->like('cust.name',$filter['cu_name']);
				}
				if(isset($filter['cu_phone']) && $filter['cu_phone']!="")
				{
					$this->db->like('cust.phone',$filter['cu_phone']);
				}
				if(isset($filter['cu_email']) && $filter['cu_email']!="")
				{
					$this->db->like('cust.email',$filter['cu_email']);
				}
				if(isset($filter['cu_city']) && $filter['cu_city']!="")
				{
					$this->db->like('cust.city',$filter['cu_city']);
				}
				
				if(isset($filter['cu_status']) && $filter['cu_status']!="")
				{
					$this->db->where('cust.status',$filter['cu_status']);					
				}
			}
		$this->db->order_by('cust.cust_id','DESC');
		
		
		$re=$this->db->get();
		
		$result=$re->result_array();
		return sizeof($result);
	}
	
	//Checking username for user...
	public function check_user_phone($mobile)
	{
		$this->db->select("phone");
		$this->db->where("phone",$mobile);
		$re=$this->db->get('wi_customer');
		return $re->result_array();
	}

	//Going to add user to database...
	public function add_customer($ar)
	{		
		$this->db->insert("wi_customer",$ar);
		return $this->db->insert_id();
	}
	//Going to add Customer contact Person to database...
	public function add_customer_contact($arr)
	{
		$this->db->insert("wi_customer_contacts",$arr);
		return $this->db->insert_id();
	}
	
	//Going to update user information...
	public function update($ar,$customer_id)
	{
		$this->db->where("cust_id",$customer_id);
		return $this->db->update("wi_customer",$ar);
		
	}
	
	//Fetching user selected team...
	public function get_selected_team($usr)
	{
		$this->db->select("user_team_id, team_id");
		$this->db->where("user_id",$usr);
		$re=$this->db->get('wi_user_team');
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$ar[$i]=$result[$i]['team_id'];
			}
		}
		return $ar;
	}
	
	//Fetching Customer info...
	public function customer_info($customer_id)
	{		
		$this->db->select("cust_id, industry_type, name, phone, email, country, state, city, pincode,  address, pan, tan, gst, aadhar");
		$this->db->where("cust_id",$customer_id);
		$re=$this->db->get('wi_customer');
		$result=$re->result_array();
		
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['cust_id']=$result[0]['cust_id'];
			$ar['name']=$result[0]['name'];
			$ar['industry_type']=$result[0]['industry_type'];
			$ar['phone']=$result[0]['phone'];
			$ar['email']=$result[0]['email'];
			$ar['country']=$result[0]['country'];
			$ar['state']=$result[0]['state'];
			$ar['city']=$result[0]['city'];
			$ar['pincode']=$result[0]['pincode'];
			$ar['address']=$result[0]['address'];
			$ar['pan']=$result[0]['pan'];
			$ar['tan']=$result[0]['tan'];
			$ar['gst']=$result[0]['gst'];
			$ar['aadhar']=$result[0]['aadhar'];			
		}
		else
		{
			$ar['cust_id']='';
			$ar['industry_type']='';
			$ar['name']='';
			$ar['phone']='';
			$ar['email']='';
			$ar['country']='';
			$ar['state']='';
			$ar['city']='';
			$ar['pincode']='';
			$ar['address']='';
			$ar['pan']='';
			$ar['tan']='';
			$ar['gst']='';
			$ar['aadhar']='';
			
		}
		return $ar;
	}
	
	//Fetching user info...
	public function customer_contact_info($customer_id)
	{		
		$this->db->select("cust_id, id, phone, email, name");
		$this->db->where("cust_id",$customer_id);
		$re=$this->db->get('wi_customer_contacts');
		return $result=$re->result_array();
		
	}
	
	//Fetching permission list...
	public function get_role_list()
	{
		$this->db->select("role_id, role_name, description");
		$this->db->from("wi_role");
		$this->db->where("status","True");
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$child=array();
				$child['role_id']=$result[$i]['role_id'];
				$child['role_name']=$result[$i]['role_name'];
				$child['description']=$result[$i]['description'];
				$child['permission']=$this->get_role_permission($result[$i]['role_id']);
				
				$ar[$i]=$child;
			}
		}
		return $ar;
	}

	///fetching role permission
	public function get_role_permission($role_id)
	{
		$this->db->select("permission.permission_id, permission.permission_name, permission.description");
		$this->db->from("wi_role_permission role_permission");
		$this->db->join("wi_permission permission","permission.permission_id=role_permission.permission_id");
		$this->db->where("role_id",$role_id);
		$re=$this->db->get();
		return $re->result_array();
	}
	
	//Fetching Team List..
	public function get_team_list()
	{
		$this->db->select("id, department_id, team_name");
		$this->db->from("wi_team");
		$this->db->where("status","True");
		$re=$this->db->get();
		return $re->result_array();
	}

	//Fetching Department list...
	public function get_department_list()
	{
		$this->db->select("id, department_name");
		$this->db->from("wi_department");
		$this->db->where("status","True");
		$re=$this->db->get();
		return $re->result_array();
	}

	//Fetching Designation list...
	public function get_designation_list()
	{
		$this->db->select("id, designation_name");
		$this->db->from("wi_designation");
		$this->db->where("status","True");
		$re=$this->db->get();
		return $re->result_array();
	}
	
	//Fetching set list...
	public function get_set_list()
	{
		$this->db->select("set_id, set_name");
		$this->db->from("wi_role_set");
		$this->db->where("status","True");
		$re=$this->db->get();
		return $re->result_array();
	}
	
	//Fetching set role...
	public function get_set_role($set)
	{
		$this->db->select("role_id, permission_id");
		$this->db->from("wi_role_set_action");
		$this->db->where("set_id",$set);
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$ar[$i]=$result[$i]['role_id']."-".$result[$i]['permission_id'];
			}
		}
		return $ar;
	}


/* 	//Fetching set role...
	public function get_user_set_role($usr)
	{
		$this->db->select("role_id, permission_id,role_set");
		$this->db->from("wi_user_role");
		$this->db->where("user_id",$usr);
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		$set_id=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$ar[$i]=$result[$i]['role_id']."-".$result[$i]['permission_id'];
				$set_id[$i]=$result[$i]['role_set'];
			}
		}
		$data=array('ar'=>$ar,'set_id'=>$set_id);
		return $data;
	}
	
	//Going to add set permission...
	public function add_set_permission($permission_ar)
	{
		$this->db->insert("wi_user_role",$permission_ar);
		return $this->db->insert_id();
	}
	
	//Going to delete old permission...
	public function delete_old_set_permission($user_id)
	{
		$this->db->where("user_id",$user_id);
		return $this->db->delete("wi_user_role");
	}
	
	//Going to add user offer...
	public function add_user_offer($ar)
	{
		$this->db->insert("wi_user_offer",$ar);
		return $this->db->insert_id();
	}
		
	//Fetching user assigned offer...
	public function get_assigned_offer($user_id)
	{
		$this->db->select("user_offer.offer_id, user_offer.percentage, user_offer.add_date, user_offer.modify_date, user_offer.status ,category.name ,user_offer.sub_category_id");
		$this->db->from("wi_user_offer user_offer");
		$this->db->join("oc_category_description category","category.category_id=user_offer.category_id");
		$this->db->where("user_offer.user_id",$user_id);
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$child=array();
				$child['offer_id']=$result[$i]['offer_id'];
				$child['category_name']=$result[$i]['name'];
				$child['sub_category_name']=$this->get_sub_category_name($result[$i]['sub_category_id']);
				$child['percentage']=$result[$i]['percentage'];
				$child['add_date']=$result[$i]['add_date'];
				$child['modify_date']=$result[$i]['modify_date'];
				$child['status']=$result[$i]['status'];
				$ar[$i]=$child;
			}
		}
		return $ar;
	}
	
	//Fetching sub category name...
	public function get_sub_category_name($sub_category_id)
	{
		$this->db->select("name");
		$this->db->from("oc_category_description");
		$this->db->where("category_id",$sub_category_id);
		$re=$this->db->get();
		$result=$re->result_array();
		if(sizeof($result)>0)
		{
			return $result[0]['name'];
		}
	}
	
	//Going to update offer info...
	public function update_offer($ar,$offer_id)
	{
		$this->db->where("offer_id",$offer_id);
		return $this->db->update("wi_user_offer",$ar);
	}
	
	// Adding Department And Designation..
	public function add_department_designation($ar)
	{
		$this->db->insert("wi_users_departmnet",$ar);
		return $this->db->insert_id();
	}

	//Fetching Department And Designation..
	public function get_department_designation_list($user_id)
	{
		$this->db->select('dp.id, dp.user_id, department.department_name, team.team_name, designation.designation_name, dp.status, dp.report_to, user.first_name, user.last_name, dp.is_default');
		$this->db->from('wi_users_departmnet dp');

		$this->db->join("wi_department department","department.id=dp.dept_id");
		$this->db->join("wi_designation designation","designation.id=dp.dsg_id");
		$this->db->join("wi_users user","dp.report_to=user.id", 'left');
		$this->db->join("wi_team team","dp.team_id=team.id", 'left');

		$this->db->where("dp.user_id",$user_id);
		$this->db->order_by('dp.id','DESC');		
		$re=$this->db->get();
		

		return $result=$re->result_array();
	
	}

	//Update Department Nd Designation..
	public function dept_desg_update($ar,$user)
	{
		$this->db->where("id",$user);
		return $this->db->update("wi_users_departmnet",$ar);
	}

	// Update assign User deparment..
	public function update_assign_user_department($ar,$usr)
	{
		$this->db->where("id",$usr);
		return $this->db->update("wi_users_departmnet",$ar);
	}

	// Select Department Wise Employee..
	public function department_employee($departemnt_id)
	{				
		$this->db->select("usr_dept.id, usr_dept.dept_id, usr_dept.dsg_id, usr_dept.user_id, user.first_name, user.last_name, designation.designation_name, team.team_name");
		$this->db->from('wi_users_departmnet usr_dept');
		$this->db->join('wi_users user', 'user.id=usr_dept.user_id');
		$this->db->join('wi_designation designation', 'designation.id=usr_dept.dsg_id');
		$this->db->join('wi_team team', 'usr_dept.team_id = team.id');
		$this->db->where('usr_dept.team_id', $departemnt_id);
		
		$re=$this->db->get();
		
		return $re->result_array();
	}
	
	//To get the user previvously assign any department or desgination..
	public function user_previous_dep_deg($user_id)
	{
		$this->db->select('user_id');
		$this->db->where('user_id', $user_id);
		$re = $this->db->get('wi_users_departmnet');
		return $re->num_rows();
		
	}
	
	// fetch the team List of a department.
	public function get_department_team($departemnt_id)
	{
		$this->db->select("id, team_name");
		$this->db->from("wi_team");
		$this->db->where("department_id", $departemnt_id);
		$re = $this->db->get();
		return $re->result_array();
		
	}
 */	
	//Going To add Address..
	public function address_add()
	{
		$this->db->insert("wi_address",$ar);
		return $this->db->insert_id();
	}
	
	// deleteing the Customer Contact..
	public function delete_customer_contact($row_id)
	{
		$this->db->where('id', $row_id);
		return $this->db->delete('wi_customer_contacts');
	}
	
	// update the Customer Contact..
	public function update_customer_contact($row_id, $name, $email, $phone, $cust_id)
	{
		$this->db->set('name', $name);
		$this->db->set('phone', $phone);
		$this->db->set('email', $email);
		$this->db->where('id', $row_id);
		$this->db->where('cust_id', $cust_id);
		return $this->db->update('wi_customer_contacts');
	}
	
	// Fetching The Last Id..
	public function get_last_customer_id()
	{
		$this->db->select_max('cust_id');
		$re = $this->db->get('wi_customer');
		return $result=$re->result_array();
	}
	
	// Fetching The industry Type..
	public function get_industry()
	{
		$this->db->select('industry_name, id');
		$this->db->from('wi_industry');
		$this->db->where('status', 'True');
		$re = $this->db->get();
		return $result = $re->result_array();
		
	}
}
?>