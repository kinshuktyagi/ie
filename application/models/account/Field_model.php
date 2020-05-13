<?php
class Field_model extends CI_Model
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

		$this->db->select('id, field_name, description, status, add_date, modify_date');

		if(sizeof($filter)>0)
		{
			/* echo"<pre>";
			print_r($filter);
			exit('fileter'); */
			
			if(isset($filter['f_field_name']) && $filter['f_field_name']!="")
			{
				$this->db->like('field_name',$filter['f_field_name']);
			}
			if(isset($filter['f_field_description']) && $filter['f_field_description']!="")
			{
				$this->db->like('description',$filter['f_field_description']);
			}
			if(isset($filter['f_field_status']) && $filter['f_field_status']!="")
			{
				$this->db->like('status',$filter['f_field_status']);
			}
			if(($filter['f_add_date']) && $filter['f_add_date']!="")
			{
				$this->db->like('add_date',$filter['f_add_date']);
			}
			if(isset($filter['f_modify_date']) && $filter['f_modify_date']!="")
			{
				$this->db->like('modify_date',$filter['f_modify_date']);
			}		
			
		}
		
		$this->db->order_by('id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_field');
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		/* echo $this->db->last_query();
		exit(); */
		
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['f_field_name']) && $filter['f_field_name']!="")
			{
				$this->db->like('field_name',$filter['f_field_name']);
			}
			if(isset($filter['f_field_description']) && $filter['f_field_description']!="")
			{
				$this->db->like('description',$filter['f_field_description']);
			}
			if(isset($filter['f_field_status']) && $filter['f_field_status']!="")
			{
				$this->db->like('status',$filter['f_field_status']);
			}
			if(($filter['f_add_date']) && $filter['f_add_date']!="")
			{
				$this->db->like('add_date',$filter['f_add_date']);
			}
			if(isset($filter['f_modify_date']) && $filter['f_modify_date']!="")
			{
				$this->db->like('modify_date',$filter['f_modify_date']);
			}					
			
		}
		
		$this->db->order_by('id','DESC');
		$this->db->from('wi_field dp');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_field($ar)
	{
		$this->db->insert("wi_field",$ar);
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function field_info($dept)
	{
		$this->db->select("id, field_name, description");
		$this->db->where("id",$dept);
		$re=$this->db->get('wi_field');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['field_name']=$result[0]['field_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']		='';
			$ar['field_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$id)
	{
		$this->db->where("id",$id);
		return $this->db->update("wi_field",$ar);		
	}


}


?>