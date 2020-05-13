<?php
class Department_model extends CI_Model
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

		$this->db->select('dp.id, dp.department_name, dp.description, dp.status, dp.add_date, dp.modify_date');

		if(sizeof($filter)>0)
		{
			/* echo ($filter['dep_add_date']);
			echo"<pre>";
			print_r($filter);
			exit(); */
			
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
			if(($filter['dep_add_date']) && $filter['dep_add_date']!="")
			{
				$this->db->like('dp.add_date',$filter['dep_add_date']);
			}
			if(isset($filter['dep_modify_date']) && $filter['dep_modify_date']!="")
			{
				$this->db->like('dp.modify_date',$filter['dep_modify_date']);
			}			
			
		}
		
		$this->db->order_by('dp.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_department dp');
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

		$this->db->select('dp.id');

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
		
		$this->db->order_by('dp.id','DESC');
		$this->db->from('wi_department dp');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_department($ar)
	{
		$this->db->insert("wi_department",$ar);
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function department_info($dept)
	{
		$this->db->select("*");
		$this->db->where("id",$dept);
		$re=$this->db->get('wi_department');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['department_name']=$result[0]['department_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']		='';
			$ar['department_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$dept)
	{
		$this->db->where("id",$dept);
		return $this->db->update("wi_department",$ar);
	}


}


?>