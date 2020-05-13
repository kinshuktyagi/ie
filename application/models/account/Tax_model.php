<?php
class Tax_model extends CI_Model
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

		$this->db->select('tax.tax_id, tax.tax_name,tax.tax_value, tax.description, tax.status, tax_type.tax_type');

		if(sizeof($filter)>0)
		{
			if(isset($filter['tx_tax_name']) && $filter['tx_tax_name']!="")
			{
				$this->db->like('tax.tax_name',$filter['tx_tax_name']);
			}
			if(isset($filter['tx_tax_type']) && $filter['tx_tax_type']!="")
			{
				$this->db->like('tax_type.tax_type',$filter['tx_tax_type']);
			}
			if(isset($filter['tx_tax_value']) && $filter['tx_tax_value']!="")
			{
				$this->db->like('tax.tax_value',$filter['tx_tax_value']);
			}
			if(isset($filter['tx_tax_description']) && $filter['tx_tax_description']!="")
			{
				$this->db->like('tax.description',$filter['tx_tax_description']);
			}
			if(isset($filter['tx_tax_status']) && $filter['tx_tax_status']!="")
			{
				$this->db->like('tax.status',$filter['tx_tax_status']);
			}				
			
		}
		
		$this->db->order_by('tax.tax_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_tax tax');
		$this->db->join('wi_tax_type tax_type','tax.tax_type = tax_type.id');
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('tax.tax_id');

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
		
		$this->db->order_by('tax.tax_id','DESC');
		$this->db->from('wi_tax tax');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add Tax to database...
	public function add_tax($ar)
	{
		$this->db->insert("wi_tax",$ar);
		return $this->db->insert_id();
	}

	//Fetching Tax info...
	public function tax_info($tax_id)
	{
		$this->db->select("tax.tax_id, tax.tax_name, tax.tax_value, tax.description, tax.tax_type");
		$this->db->where("tax_id",$tax_id);
		$this->db->from('wi_tax tax');
		$re=$this->db->get();
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['tax_id'] =$result[0]['tax_id'];
			$ar['tax_name']=$result[0]['tax_name'];
			$ar['tax_type_id']=$result[0]['tax_type'];
			$ar['tax_value']=$result[0]['tax_value'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['tax_id']='';
			$ar['tax_name']='';
			$ar['tax_type']='';
			$ar['tax_value']='';
			$ar['description']='';
		}		
		return $ar;
	}

	//Going to update Tax information...
	public function update($ar,$tax_id)
	{
		$this->db->where("tax_id",$tax_id);
		return $this->db->update("wi_tax",$ar);
	}
	
	// Fetching the Tax Type..
	public function get_tax_type()
	{
		$this->db->select("tax_type, id");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_tax_type');
		return $result=$re->result_array();
	}

}


?>