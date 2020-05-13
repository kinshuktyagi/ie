<?php
class Uom_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	//Fetching UOM detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('dp.uom_id, dp.uom_name, dp.description, dp.status, dp.add_date, dp.modify_date');

		if(sizeof($filter)>0)
		{
			/* echo"<pre>";
			print_r($filter);
			exit(); */
			
			if(isset($filter['um_name']) && $filter['um_name']!="")
			{
				$this->db->like('dp.uom_name',$filter['um_name']);
			}
			if(isset($filter['um_description']) && $filter['um_description']!="")
			{
				$this->db->like('dp.description',$filter['um_description']);
			}
			if(isset($filter['um_status']) && $filter['um_status']!="")
			{
				$this->db->like('dp.status',$filter['um_status']);
			}
			if(($filter['um_add_date']) && $filter['um_add_date']!="")
			{
				$this->db->like('dp.add_date',$filter['um_add_date']);
			}
			if(isset($filter['um_modify_date']) && $filter['um_modify_date']!="")
			{
				$this->db->like('dp.modify_date',$filter['um_modify_date']);
			}			
			
		}
		
		$this->db->order_by('dp.uom_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_uom dp');
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		
		
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('dp.uom_id');

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
		
		$this->db->order_by('dp.uom_id','DESC');
		$this->db->from('wi_uom dp');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add UOM to database...
	public function add_uom($ar)
	{
		$this->db->insert("wi_uom",$ar);
		return $this->db->insert_id();
	}

	//Fetching UOM info...
	public function uom_info($id)
	{
		$this->db->select("*");
		$this->db->where("uom_id",$id);
		$re=$this->db->get('wi_uom');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['uom_id']=$result[0]['uom_id'];
			$ar['uom_name']=$result[0]['uom_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['uom_id'] ='';
			$ar['uom_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update UOM information...
	public function update($ar,$id)
	{
		$this->db->where("uom_id",$id);
		return $this->db->update("wi_uom",$ar);
	}


}


?>