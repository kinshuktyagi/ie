<?php
class role_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$this->db->select("role_id, role_name, description, add_date, modify_date, status");
		$this->db->from("wi_role");
		if(sizeof($filter)>0)
		{
			if(isset($filter['role_role_name']) && $filter['role_role_name']!="")
			{
				$this->db->like('role_name',$filter['role_role_name']);
			}
			if(isset($filter['role_description']) && $filter['role_description']!="")
			{
				$this->db->like('description',$filter['role_description']);
			}
			if(isset($filter['role_status']) && $filter['role_status']!="")
			{
				$this->db->where('status',$filter['role_status']);
			}
		}
		$this->db->order_by('role_id','ASC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		$data['total'] = $this->count_total();
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total()
	{
		$filter=$this->session->userdata("search");
		$this->db->select("role_id, role_name, description, add_date, modify_date, status");
		$this->db->from("wi_role");
		if(sizeof($filter)>0)
		{
			if(isset($filter['role_role_name']) && $filter['role_role_name']!="")
			{
				$this->db->like('role_name',$filter['role_role_name']);
			}
			if(isset($filter['role_description']) && $filter['role_description']!="")
			{
				$this->db->like('description',$filter['role_description']);
			}
			if(isset($filter['role_status']) && $filter['role_status']!="")
			{
				$this->db->where('status',$filter['role_status']);
			}
		}
		$this->db->order_by('role_id','DESC');
		$re=$this->db->get();
		$result=$re->result_array();
		return sizeof($result);
	}
	
	//Fetching permission list...
	public function get_permission_list()
	{
		$this->db->select("permission_id, permission_name");
		$this->db->from("wi_permission");
		$re=$this->db->get();
		return $re->result_array();
	}
	
	
	
	//Going to add role...
	public function add_role($role_ar)
	{
		$this->db->insert("wi_role",$role_ar);
		return $this->db->insert_id();
	}
	
	//Going to add permission to role...
	public function add_permission($permission_ar)
	{
		$this->db->insert("wi_role_permission",$permission_ar);
		return $this->db->insert_id();
	}
	
	
	//Going to update category information...
	public function update($ar,$role_id)
	{
		$this->db->where("role_id",$role_id);
		return $this->db->update("wi_role",$ar);
	}
	
	//Fetching category detail...
	public function get_role_info($role_id)
	{
		$this->db->select("role_id, role_name, description");
		$this->db->where("role_id",$role_id);
		$re=$this->db->get('wi_role');
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['role_id']=$result[0]['role_id'];
			$ar['role_name']=$result[0]['role_name'];
			$ar['description']=$result[0]['description'];
			$ar['permission']=$this->get_permission($result[0]['role_id']);
		}
		else
		{
			$ar['category_id']='';
			$ar['category_name']='';
			$ar['description']='';
			$ar['permission']=array();
		}
		return $ar;
	}
	
	//Fetching role info...
	public function get_permission($role_id)
	{
		$this->db->select("permission_id");
		$this->db->where("role_id",$role_id);
		$re=$this->db->get('wi_role_permission');
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$ar[$i]=$result[$i]['permission_id'];
			}
		}
		return $ar;
	}
	
	
	//Going to delete old permission...
	public function delete_old_permission($role_id)
	{
		$this->db->where("role_id",$role_id);
		return $this->db->delete("wi_role_permission");
	}
}

?>