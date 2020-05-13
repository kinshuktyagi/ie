<?php
class user_model extends CI_Model
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
		$this->db->select("users.id,users.emp_code, users.user_name, users.first_name, users.last_name, users.mobile, users.email, users.address, users.profile_pic, users.add_date, users.modify_date, users.status,state.stateNAme,country.countryName,user_typ.user_type, users.user_type as user_type_id");
		$this->db->from("wi_users users");
		$this->db->join("wi_countries country","country.countryID=users.country");
		$this->db->join("wi_states state","state.stateID=users.state");
		$this->db->join("wi_user_type user_typ","user_typ.id=users.user_type");
			if(sizeof($filter)>0)
			{
				/* echo"<pre>";
				print_r($filter);
				exit('filter'); */
				
				if(isset($filter['user_code']) && $filter['user_code']!="")
				{
					$this->db->like('users.emp_code',$filter['user_code']);
				}
				if(isset($filter['user_first_name']) && $filter['user_first_name']!="")
				{
					$this->db->like('users.first_name',$filter['user_first_name']);
				}
				if(isset($filter['user_last_name']) && $filter['user_last_name']!="")
				{
					$this->db->like('users.last_name',$filter['user_last_name']);
				}
				if(isset($filter['user_user_name']) && $filter['user_user_name']!="")
				{
					$this->db->like('users.user_name',$filter['user_user_name']);
				}
				if(isset($filter['user_user_type']) && $filter['user_user_type']!="")
				{
					$this->db->where('users.user_type',$filter['user_user_type']);
				}
				if(isset($filter['user_mobile']) && $filter['user_mobile']!="")
				{
					$this->db->where('users.mobile',$filter['user_mobile']);
				}
				if(isset($filter['user_email']) && $filter['user_email']!="")
				{
					$this->db->where('users.email',$filter['user_email']);
				}
				if(isset($filter['user_status']) && $filter['user_status']!="")
				{
					$this->db->where('users.status',$filter['user_status']);
					
				}
				
			}
		$this->db->where('users.user_type>',1);
		$this->db->order_by('users.id','DESC');
		$this->db->limit($limit, $offset);
		
		$re=$this->db->get();
		/* 
		echo $this->db->last_query();
		exit(); */
		$data['total'] = $this->count_total($admin['id']);
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		
		$this->db->select("users.id");
		$this->db->from("wi_users users");
		$this->db->join("wi_countries country","country.countryID=users.country");
		$this->db->join("wi_states state","state.stateID=users.state");
		$this->db->join("wi_user_type user_type","user_type.id=users.user_type");
			if(sizeof($filter)>0)
			{
				if(isset($filter['user_first_name']) && $filter['user_first_name']!="")
				{
					$this->db->like('users.first_name',$filter['user_first_name']);
				}
				if(isset($filter['user_last_name']) && $filter['user_last_name']!="")
				{
					$this->db->like('users.last_name',$filter['user_last_name']);
				}
				if(isset($filter['user_user_name']) && $filter['user_user_name']!="")
				{
					$this->db->like('users.user_name',$filter['user_user_name']);
				}
				if(isset($filter['user_user_type']) && $filter['user_user_type']!="")
				{
					$this->db->where('users.user_type',$filter['user_user_type']);
				}
				if(isset($filter['user_mobile']) && $filter['user_mobile']!="")
				{
					$this->db->where('users.mobile',$filter['user_mobile']);
				}
				if(isset($filter['user_email']) && $filter['user_email']!="")
				{
					$this->db->where('users.email',$filter['user_email']);
				}
				if(isset($filter['user_status']) && $filter['user_status']!="")
				{
					$this->db->where('users.status',$filter['user_status']);
				}
			}
		$this->db->where('users.user_type>',1);
		$this->db->order_by('users.id','DESC');
		$re=$this->db->get();
		$result=$re->result_array();
		return sizeof($result);
	}
	
	//Checking username for user...
	public function check_user_name($mobile)
	{
		$this->db->select("mobile");
		$this->db->where("mobile",$mobile);
		$re=$this->db->get('wi_users');
		return $re->result_array();
	}

	// TO Genrate User ID..
	public function generate_userid()
	{
		$this->db->select_max("id");
		$re=$this->db->get('wi_users');
		$result=$re->result_array();
		
		$tot = $result[0]['id']+1;
		return $user_id = sprintf("EMP%05d", $tot)."";
		
	}
		
	//Going to add user to database...
	public function add_user($ar)
	{
		$this->db->insert("wi_users",$ar);
		return $this->db->insert_id();
	}
	
	//Going to update user information...
	public function update($ar,$usr)
	{
		$this->db->where("id",$usr);
		return $this->db->update("wi_users",$ar);
		
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
	
	//Fetching user info...
	public function user_info($usr)
	{
		
		$this->db->select("id, user_type, first_name, last_name, mobile, email, country, state, city, pin_code,  address, join_date, department, designation");
		$this->db->where("id",$usr);
		$re=$this->db->get('wi_users');
		$result=$re->result_array();
		
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['user_type']=$result[0]['user_type'];
			$ar['first_name']=$result[0]['first_name'];
			$ar['last_name']=$result[0]['last_name'];
			$ar['mobile']=$result[0]['mobile'];
			$ar['email']=$result[0]['email'];
			$ar['country']=$result[0]['country'];
			$ar['state']=$result[0]['state'];
			$ar['city']=$result[0]['city'];
			$ar['pin_code']=$result[0]['pin_code'];
			$ar['address']=$result[0]['address'];
			$ar['join_date']=$result[0]['join_date'];
			$ar['department']=$result[0]['department'];
			$ar['designation']=$result[0]['designation'];
		}
		else
		{
			$ar['id']='';
			$ar['user_type']='';
			$ar['first_name']='';
			$ar['last_name']='';
			$ar['mobile']='';
			$ar['email']='';
			$ar['country']='';
			$ar['state']='';
			$ar['city']='';
			$ar['address']='';
			$ar['join_date']='';
			$ar['department']='';
			$ar['designation']='';
			
		}
		return $ar;
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

	//Fetching Department list...
	public function get_designation_list()
	{
		$this->db->select("id, designation_name");
		$this->db->from("wi_designation");
		$this->db->where("status","True");
		$re=$this->db->get();
		/*echo "<pre>";
		print_r($re->result_array());
		exit();*/
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

/*	//Fetching set Department...
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
	}*/
	
	//Fetching set role...
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
	

	public function add_department_designation($ar)
	{
		/* echo "<pre>";
		print_r($ar);
		exit('model Section Here'); */

		$this->db->insert("wi_users_departmnet",$ar);
		return $this->db->insert_id();
	}

	public function get_department_designation_list($user_id)
	{
		$this->db->select('dp.id, dp.user_id, department.department_name, designation.designation_name, dp.status, dp.report_to, user.first_name, user.last_name, dp.is_default');
		$this->db->from('wi_users_departmnet dp');

		$this->db->join("wi_department department","department.id=dp.dept_id");
		$this->db->join("wi_designation designation","designation.id=dp.dsg_id");
		$this->db->join("wi_users user","dp.report_to=user.id", 'left');
		//$this->db->join("wi_team team","dp.team_id=team.id", 'left');

		$this->db->where("dp.user_id",$user_id);
		$this->db->order_by('dp.id','DESC');		
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */

		return $result=$re->result_array();
	
	}

	public function dept_desg_update($ar,$user)
	{
		$this->db->where("id",$user);
		return $this->db->update("wi_users_departmnet",$ar);
	}

	public function update_assign_user_department($ar,$usr)
	{
		$this->db->where("id",$usr);
		return $this->db->update("wi_users_departmnet",$ar);
	}

	public function department_employee($departemnt_id)
	{				
		$this->db->select("usr_dept.id, usr_dept.dept_id, usr_dept.dsg_id, usr_dept.user_id, user.first_name, user.last_name, designation.designation_name, team.team_name");
		$this->db->from('wi_users_departmnet usr_dept');
		$this->db->join('wi_users user', 'user.id=usr_dept.user_id');
		$this->db->join('wi_designation designation', 'designation.id=usr_dept.dsg_id');
		$this->db->join('wi_team team', 'usr_dept.team_id = team.id');
		$this->db->where('usr_dept.team_id', $departemnt_id);
		
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
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
	//Going To add Address..
	public function address_add()
	{
		$this->db->insert("wi_address",$ar);
		return $this->db->insert_id();
	}
	
	// Fetching the users List..
	public function get_user_list()
	{
		$this->db->select('id, first_name, last_name');
		$this->db->where('user_type>',1);
		//$this->db->order_by('users.id','DESC');
		$re=$this->db->get('wi_users');
		return $result=$re->result_array();
	}
	
}
?>