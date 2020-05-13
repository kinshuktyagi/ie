<?php
class permission_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$this->db->select("permission_id, permission_name, description, add_date, modify_date, status");
		$this->db->from("wi_permission");
		if(sizeof($filter)>0)
		{
			if(isset($filter['per_permission_name']) && $filter['per_permission_name']!="")
			{
				$this->db->like('permission_name',$filter['per_permission_name']);
			}
			if(isset($filter['per_description']) && $filter['per_description']!="")
			{
				$this->db->like('description',$filter['per_description']);
			}
			if(isset($filter['per_status']) && $filter['per_status']!="")
			{
				$this->db->where('status',$filter['per_status']);
			}
		}
		$this->db->order_by('permission_id','DESC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		$data['total'] = $this->count_total();
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total()
	{
		$filter=$this->session->userdata("search");
		$this->db->select("permission_id, permission_name, description, add_date, modify_date, status");
		$this->db->from("wi_permission");
		if(sizeof($filter)>0)
		{
			if(isset($filter['per_permission_name']) && $filter['per_permission_name']!="")
			{
				$this->db->like('permission_name',$filter['per_permission_name']);
			}
			if(isset($filter['per_description']) && $filter['per_description']!="")
			{
				$this->db->like('description',$filter['per_description']);
			}
			if(isset($filter['per_status']) && $filter['per_status']!="")
			{
				$this->db->where('status',$filter['per_status']);
			}
		}
		$this->db->order_by('permission_id','DESC');
		$re=$this->db->get();
		$result=$re->result_array();
		return sizeof($result);
	}
	
	
	
	
	//Going to add permission...
	public function add_permission($permission_ar)
	{
		$this->db->insert("wi_permission",$permission_ar);
		return $this->db->insert_id();
	}
	
	
	
	//Going to update category information...
	public function update($ar,$permission_id)
	{
		$this->db->where("permission_id",$permission_id);
		return $this->db->update("wi_permission",$ar);
	}
	
	//Fetching permission detail...
	public function get_permission_info($permission_id)
	{
		$this->db->select("permission_id, permission_name, description, add_date, modify_date, status");
		$this->db->where("permission_id",$permission_id);
		$re=$this->db->get('wi_permission');
				
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['permission_id']=$result[0]['permission_id'];
			$ar['permission_name']=$result[0]['permission_name'];
			$ar['description']=$result[0]['description'];
		}
		else
		{
			$ar['permission_id']='';
			$ar['permission_name']='';
			$ar['description']='';
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