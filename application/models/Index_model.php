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
	public function get_user_detail($username,$password)
	{
		$this->db->select("u_type.id as user_type,u_type.user_type as user_type_name ,users.id, users.user_name, users.password, users.first_name, users.last_name, users.mobile, users.email, users.country, users.city, users.address, users.profile_pic,country.countryName ,u_type.priority, user_department.report_to, department.department_name, designation.designation_name, designation.priority as desg_priority, designation.id desg_id");
		
		//$this->db->select("type.id as users_type, type.user_type as user_type_name ,users.id, users.user_name, users.password, users.first_name, users.last_name, users.mobile, users.email, users.city, users.address, users.profile_pic,country.countryName ,type.priority");
		
		$this->db->from("wi_users users");
		$this->db->join("wi_user_type u_type","u_type.id=users.user_type");
		$this->db->join("wi_countries country","country.countryID=users.country");
		$this->db->join("wi_users_departmnet user_department","user_department.user_id=users.id");
		$this->db->join("wi_department department","user_department.dept_id=department.id ");
		$this->db->join("wi_designation designation","user_department.dsg_id=designation.id "); 
		
		$this->db->where("users.user_name",$username);
		$this->db->where("users.password",$password);
		$this->db->where("user_department.is_default",'True');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
	
		return $re->result_array();
	}
	
	//fetching User department
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
	
	//fetching User department ID
	public function get_user_department_id($id)
	{
		$this->db->select(" department.department_name, designation.designation_name, users_departmnet.id, users_departmnet.status, users_departmnet.is_default, users_departmnet.dept_id id, users_departmnet.dsg_id ");
		$this->db->from("wi_department department");
		$this->db->join("wi_users_departmnet users_departmnet","users_departmnet.dept_id=department.id");
		$this->db->join("wi_designation designation","designation.id=users_departmnet.dsg_id");
		$this->db->where("users_departmnet.user_id",$id);
		$this->db->where("users_departmnet.is_default",'True');
		$re=$this->db->get();
		
		
		$result=$re->result_array();
		/* echo"<pre>";
		print_r($result);
		exit(); */
		
		if(sizeof($result)>0)
		{
			return $result[0]['id'];
		}
	} 
	
	
	//Going to add user log information...
	public function add_log($log)
	{
		$this->db->insert("wi_log",$log);
		return $this->db->insert_id();
	}
	
	
}

?>