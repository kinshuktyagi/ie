<?php
class Storage_type_model extends CI_Model
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
		$this->db->select('dp.id, dp.storage_type_name, dp.description, dp.status, dp.add_date, dp.modify_date');

		if(sizeof($filter)>0)
		{	
			/* echo"<pre>";
			print_r($filter);
			exit(); */
			if(isset($filter['sy_name']) && $filter['sy_name']!="")
			{
				$this->db->like('dp.storage_type_name',$filter['sy_name']);
			}
			if(isset($filter['sy_description']) && $filter['sy_description']!="")
			{
				$this->db->like('dp.description',$filter['sy_description']);
			}
			if(isset($filter['sy_status']) && $filter['sy_status']!="")
			{
				$this->db->like('dp.status',$filter['sy_status']);
			}
			if(($filter['sy_add_date']) && $filter['sy_add_date']!="" && $filter['sy_add_date']!='1970-01-01')
			{
				$this->db->like('dp.add_date',$filter['sy_add_date']);
			}
			if(isset($filter['sy_modify_date']) && $filter['sy_modify_date']!="" && $filter['sy_modify_date']!="1970-01-01")
			{
				$this->db->like('dp.modify_date',$filter['sy_modify_date']);
			}			
			
		}
		
		$this->db->order_by('dp.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_storage_type dp');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		
		$data['total'] = $this->count_total($admin['id']);
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('dp.id');
		if(sizeof($filter)>0)
		{
			if(isset($filter['sy_name']) && $filter['sy_name']!="")
			{
				$this->db->like('dp.storage_type_name',$filter['sy_name']);
			}
			if(isset($filter['sy_description']) && $filter['sy_description']!="")
			{
				$this->db->like('dp.description',$filter['sy_description']);
			}
			if(isset($filter['sy_status']) && $filter['sy_status']!="")
			{
				$this->db->like('dp.status',$filter['sy_status']);
			}
			if(($filter['sy_add_date']) && $filter['sy_add_date']!="")
			{
				$this->db->like('dp.add_date',$filter['sy_add_date']);
			}
			if(isset($filter['sy_modify_date']) && $filter['sy_modify_date']!="")
			{
				$this->db->like('dp.modify_date',$filter['sy_modify_date']);
			}
		}
		
		$this->db->order_by('dp.id','DESC');
		$this->db->from('wi_storage_type dp');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}

	//Going to add user to database...
	public function add_storage_type($ar)
	{
		$this->db->insert("wi_storage_type",$ar);
		return $this->db->insert_id();
	}

	//Fetching Storage Type info...
	public function storage_type_info($id)
	{
		$this->db->select("*");
		$this->db->where("id",$id);
		$re=$this->db->get('wi_storage_type');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id'] =$result[0]['id'];
			$ar['storage_type_name']=$result[0]['storage_type_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']='';
			$ar['storage_type_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Storage Type information...
	public function update($ar,$id)
	{
		$this->db->where("id",$id);
		return $this->db->update("wi_storage_type",$ar);
	}


}


?>