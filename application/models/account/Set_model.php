<?php
class set_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$this->db->select("set_id, set_name, description, add_date, modify_date, status");
		$this->db->from("wi_role_set");
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
		$this->db->order_by('set_id','ASC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		$data['total'] = $this->count_total();
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total()
	{
		$filter=$this->session->userdata("search");
		$this->db->select("set_id, set_name, description, add_date, modify_date, status");
		$this->db->from("wi_role_set");
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
		$this->db->order_by('set_id','DESC');
		$re=$this->db->get();
		$result=$re->result_array();
		return sizeof($result);
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
	
	
	
	//Going to add set...
	public function add_set($role_ar)
	{
		$this->db->insert("wi_role_set",$role_ar);
		return $this->db->insert_id();
	}
	
	//Going to add set permission...
	public function add_set_permission($permission_ar)
	{
		$this->db->insert("wi_role_set_action",$permission_ar);
		return $this->db->insert_id();
	}
	
	
	//Going to update set information...
	public function update($ar,$set_id)
	{
		$this->db->where("set_id",$set_id);
		return $this->db->update("wi_role_set",$ar);
	}
	
	//Fetching category detail...
	public function get_set_info($set_id)
	{
		$this->db->select("set_id, set_name, description, add_date, modify_date, status");
		$this->db->from("wi_role_set");
		$re=$this->db->where("set_id",$set_id);
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['set_id']=$result[0]['set_id'];
			$ar['set_name']=$result[0]['set_name'];
			$ar['description']=$result[0]['description'];
			$ar['permission']=$this->get_set_permission($result[0]['set_id']);
		}
		else
		{
			$ar['set_id']='';
			$ar['set_name']='';
			$ar['description']='';
			$ar['permission']=array();
		}
		return $ar;
	}
	
	//Fetching set role info...
	public function get_set_permission($set_id)
	{
		$this->db->select("action_id, set_id, role_id, permission_id");
		$this->db->where("set_id",$set_id);
		$re=$this->db->get('wi_role_set_action');
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
	
	
	//Going to delete old permission...
	public function delete_old_Set_permission($set_id)
	{
		$this->db->where("set_id",$set_id);
		return $this->db->delete("wi_role_set_action");
	}
}

?>