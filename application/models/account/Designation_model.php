<?php
class designation_model extends CI_Model
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

		$this->db->select('dsg.id, dsg.designation_name, dsg.priority, dsg.description, dsg.status');

		/*$this->db->select("dept.id, dept.department_name, dept.description");
		$this->db->from("wi_users dept");
		$this->db->join("wi_countries country","country.countryID=users.country");
		$this->db->join("wi_states state","state.stateID=users.state");
		$this->db->join("wi_user_type user_type","user_type.id=users.user_type");*/
		/*echo "<pre>";
		print_r($_POST);
		exit();*/
		if(sizeof($filter)>0)
		{
			if(isset($filter['ds_designation_name']) && $filter['ds_designation_name']!="")
			{
				$this->db->like('dsg.designation_name',$filter['ds_designation_name']);
			}
			if(isset($filter['ds_designation_priority']) && $filter['ds_designation_priority']!="")
			{
				$this->db->like('dsg.priority', $filter['ds_designation_priority']);
			}
			if(isset($filter['ds_designation_description']) && $filter['ds_designation_description']!="")
			{
				$this->db->like('dsg.description',$filter['ds_designation_description']);
			}	
			if(isset($filter['dep_designation_status']) && $filter['dep_designation_status']!="")
			{
				$this->db->like('dsg.status',$filter['dep_designation_status']);
			}			
			
		}
		
		$this->db->order_by('dsg.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_designation dsg');
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		//$data['total'] = $this->db->count_all('wi_designation');
		$data['data']  = $re->result_array();
	    return $data; 
	}

	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('dsg.id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['ds_designation_name']) && $filter['ds_designation_name']!="")
			{
				$this->db->like('dsg.designation_name',$filter['ds_designation_name']);
			}
			if(isset($filter['ds_designation_priority']) && $filter['ds_designation_priority']!="")
			{
				$this->db->like('dsg.priority', $filter['ds_designation_priority']);
			}
			if(isset($filter['ds_designation_description']) && $filter['ds_designation_description']!="")
			{
				$this->db->like('dsg.description',$filter['ds_designation_description']);
			}	
			if(isset($filter['dep_designation_status']) && $filter['dep_designation_status']!="")
			{
				$this->db->like('dsg.status',$filter['dep_designation_status']);
			}			
			
		}
		
		$this->db->order_by('dsg.id','DESC');
		$this->db->from('wi_designation dsg');
		$re=$this->db->get();
		$result = $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_designation($ar)
	{
		$this->db->insert("wi_designation",$ar);
		return $this->db->insert_id();
	}

	//Fetching user info...
	public function designation_info($dsg)
	{
		$this->db->select("*");
		$this->db->where("id",$dsg);
		$re=$this->db->get('wi_designation');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['designation_name']=$result[0]['designation_name'];
			$ar['priority']=$result[0]['priority'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']		='';
			$ar['designation_name']='';
			$ar['priority']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update user information...
	public function update($ar,$dsg)
	{
		$this->db->where("id",$dsg);
		return $this->db->update("wi_designation",$ar);
	}

}


?>