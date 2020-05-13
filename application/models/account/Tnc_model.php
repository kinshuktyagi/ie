<?php
class Tnc_model extends CI_Model
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

		$this->db->select('tnc.tnc_id, tnc.tnc_name, tnc.description, tnc.status, type.tnc_type_name');

		if(sizeof($filter)>0)
		{
			if(isset($filter['tn_type']) && $filter['tn_type']!="")
			{
				$this->db->like('type.tnc_type_name',$filter['tn_type']);
			}
			if(isset($filter['tn_name']) && $filter['tn_name']!="")
			{
				$this->db->like('tnc.tnc_name',$filter['tn_name']);
			}
			if(isset($filter['tn_description']) && $filter['tn_description']!="")
			{
				$this->db->like('tnc.description',$filter['tn_description']);
			}
			if(isset($filter['tn_status']) && $filter['tn_status']!="")
			{
				$this->db->like('tnc.status',$filter['tn_status']);
			}				
			
		}
		
		$this->db->order_by('tnc.tnc_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_tnc tnc');
		$this->db->join("wi_tnc_type type","tnc.tnc_type = type.id");
		$re=$this->db->get();
		
		$data['total'] = $this->count_total($admin['id']);
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('tnc.tnc_id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['dep_department_name']) && $filter['dep_department_name']!="")
			{
				$this->db->like('dp.department_name',$filter['dep_department_name']);
			}
			if(isset($filter['dep_department_description']) && $filter['dep_department_description']!="")
			{
				$this->db->like('dp.description',$filter['dep_department_description']);
			}
			if(isset($filter['dep_department_status']) && $filter['dep_department_status']!="")
			{
				$this->db->like('dp.status',$filter['dep_department_status']);
			}				
			
		}
		
		$this->db->order_by('tnc.tnc_id','DESC');
		$this->db->from('wi_tnc tnc');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_tnc($ar)
	{
		$this->db->insert("wi_tnc",$ar);
		return $this->db->insert_id();
	}

	//Fetching TNC info...
	public function tnc_info($tnc_id)
	{
		$this->db->select("tnc_id, tnc_type, tnc_name, description");
		$this->db->where("tnc_id",$tnc_id);
		$re=$this->db->get('wi_tnc');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['tnc_id']	=$result[0]['tnc_id'];
			$ar['tnc_type']=$result[0]['tnc_type'];
			$ar['tnc_name']=$result[0]['tnc_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['tnc_id']		='';
			$ar['tnc_type']='';
			$ar['tnc_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update TNC information...
	public function update($ar,$tnc_id)
	{
		$this->db->where("tnc_id",$tnc_id);
		return $this->db->update("wi_tnc",$ar);
	}

	// Fetching TNC Type..
	public function get_tnc_type()
	{
		$this->db->select("tnc_type_name, id");
		$re=$this->db->get('wi_tnc_type');
		return $result=$re->result_array();
	}
}


?>