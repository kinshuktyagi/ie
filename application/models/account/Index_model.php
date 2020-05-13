<?php
class index_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		
	}
	//Fetching user info...
	public function user_info($usr)
	{
		$this->db->select("id, user_name, first_name, last_name, mobile, email, country, state, city, address,join_date,gst,pan,bank_name, bank_account_name, bank_address, bank_account_number, ifsc_code ,pin_code,business_name");
		$this->db->where("id",$usr);
		$re=$this->db->get('wi_users');
		
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['user_name']=$result[0]['user_name'];
			$ar['first_name']=$result[0]['first_name'];
			$ar['last_name']=$result[0]['last_name'];
			$ar['mobile']=$result[0]['mobile'];
			$ar['email']=$result[0]['email'];
			$ar['country']=$result[0]['country'];
			$ar['state']=$result[0]['state'];
			$ar['city']=$result[0]['city'];
			$ar['address']=$result[0]['address'];
			$ar['join_date']=$result[0]['join_date'];
			$ar['gst']=$result[0]['gst'];
			$ar['pan']=$result[0]['pan'];
			$ar['bank_name']=$result[0]['bank_name'];
			$ar['bank_account_name']=$result[0]['bank_account_name'];
			$ar['bank_address']=$result[0]['bank_address'];
			$ar['bank_account_number']=$result[0]['bank_account_number'];
			$ar['ifsc_code']=$result[0]['ifsc_code'];
			$ar['pin_code']=$result[0]['pin_code'];
			$ar['business_name']=$result[0]['business_name'];
		}
		else
		{
			$ar['id']='';
			$ar['user_name']='';
			$ar['first_name']='';
			$ar['last_name']='';
			$ar['mobile']='';
			$ar['email']='';
			$ar['country']='';
			$ar['state']='';
			$ar['city']='';
			$ar['address']='';
			$ar['join_date']='';
			$ar['gst']='';
			$ar['pan']='';
			$ar['bank_name']='';
			$ar['bank_account_name']='';
			$ar['bank_address']='';
			$ar['bank_account_number']='';
			$ar['ifsc_code']='';
			$ar['pin_code']='';
			$ar['business_name']='';
		}
		return $ar;
	}
	
	//Going to update user information...
	public function update($ar,$usr)
	{
		/* echo"<pre>";
		print_r($ar);
		exit('model Section here.'); */
		
		$this->db->where("id",$usr);
		return $this->db->update("wi_users",$ar);
	}
	//Fetching total user list...
	public function get_total_user()
	{
		$this->db->select("count(id) as total");
		$re=$this->db->get('wi_users');
		$result=$re->result_array();
		return $result[0]['total'];
	}
	
	//Fetching total client list...
	public function get_total_client()
	{
		$this->db->select("count(client_id) as total");
		$re=$this->db->get('wi_client');
		$result=$re->result_array();
		return $result[0]['total'];
	}
	//Fetching total contractual employee list...
	public function get_total_contractual_employee()
	{
		$this->db->select("count(employee_id) as total");
		$re=$this->db->get('wi_employee');
		$result=$re->result_array();
		return $result[0]['total'];
	}
	
	//Fetching total permanent employee list...
	public function get_total_permanent_employee()
	{
		$this->db->select("count(employee_id) as total");
		$re=$this->db->get('wi_permenent_employee');
		$result=$re->result_array();
		return $result[0]['total'];
	}
	
	
	//Checking username for user...
	public function check_user_name($user_name)
	{
		$this->db->select("mobile");
		$this->db->where("mobile",$user_name);
		$re=$this->db->get('wi_users');
		return $re->result_array();
	}
	
	//Fetching user department...
	public function get_user_department($id)
	{
		$this->db->select("department.id,department.department_name,designation.designation_name,users_departmnet.id,users_departmnet.status,users_departmnet.is_default, users_departmnet.report_to");
		$this->db->from("wi_department department");
		$this->db->join("wi_users_departmnet users_departmnet","users_departmnet.dept_id=department.id");
		$this->db->join("wi_designation designation","designation.id=users_departmnet.dsg_id");
		$this->db->where("users_departmnet.user_id",$id);
		$re=$this->db->get();
		return $re->result_array();
	} 

	public function update_user_department($user_id, $department_id)
	{
		$this->db->where("user_id",$user_id);
		$this->db->set('is_default', 'False');		
		$res = $this->db->update('wi_users_departmnet');
		
		if ($res) 
		{
			$this->db->where("user_id",$user_id);
			$this->db->where("id",$department_id);
			$this->db->set('is_default', 'True');
			return $this->db->update('wi_users_departmnet');
			/*echo $this->db->last_query();
			exit();*/ 
		}
	}
	
}

?>