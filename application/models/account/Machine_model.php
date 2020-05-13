<?php
class Machine_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	//Fetching Machine detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");
		$this->db->select('machine_id, machine_name, description, status, add_date, running_cost, machine_code');

		if(sizeof($filter)>0)
		{			
			if(isset($filter['mach_code']) && $filter['mach_code']!="")
			{
				$this->db->like('dp.department_name',$filter['mach_code']);
			}
			if(isset($filter['mach_name']) && $filter['mach_name']!="")
			{
				$this->db->like('machine_name',$filter['mach_name']);
			}
			if(isset($filter['mach_running_cost']) && $filter['mach_running_cost']!="")
			{
				$this->db->like('running_cost',$filter['mach_running_cost']);
			}
			if(($filter['mach_description']) && $filter['mach_description']!="")
			{
				$this->db->like('description',$filter['mach_description']);
			}
			if(isset($filter['mach_status']) && $filter['mach_status']!="")
			{
				$this->db->like('status',$filter['mach_status']);
			}			
			
		}
		
		$this->db->order_by('machine_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_machine');
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

		$this->db->select('machine_id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['mach_code']) && $filter['mach_code']!="")
			{
				$this->db->like('dp.department_name',$filter['mach_code']);
			}
			if(isset($filter['mach_name']) && $filter['mach_name']!="")
			{
				$this->db->like('machine_name',$filter['mach_name']);
			}
			if(isset($filter['mach_running_cost']) && $filter['mach_running_cost']!="")
			{
				$this->db->like('running_cost',$filter['mach_running_cost']);
			}
			if(($filter['mach_description']) && $filter['mach_description']!="")
			{
				$this->db->like('description',$filter['mach_description']);
			}
			if(isset($filter['mach_status']) && $filter['mach_status']!="")
			{
				$this->db->like('status',$filter['mach_status']);
			}			
		}
		
		$this->db->order_by('machine_id','DESC');
		$this->db->from('wi_machine');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to Machine...
	public function add_machine($ar)
	{
		$this->db->insert("wi_machine",$ar);
		return $this->db->insert_id();
	}

	//Fetching Machine info...
	public function machine_info($machine_id)
	{
		$this->db->select("*");
		$this->db->where("machine_id",$machine_id);
		$re=$this->db->get('wi_machine');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['machine_id']=$result[0]['machine_id'];
			$ar['machine_name']=$result[0]['machine_name'];
			$ar['running_cost']=$result[0]['running_cost'];
			$ar['description']=$result[0]['description'];		
		}
		else
		{
			$ar['machine_id']='';
			$ar['machine_name']='';
			$ar['running_cost']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Machine information...
	public function update($ar,$machine_id)
	{
		$this->db->where("machine_id",$machine_id);
		return $this->db->update("wi_machine",$ar);
	}
	
	// TO Genrate Machine ID..
	public function generate_machine_code()
	{
		$this->db->select_max("machine_id");
		$re=$this->db->get('wi_machine');
		$result=$re->result_array();
		
		$tot = $result[0]['machine_id']+1;
		return $machine_code = sprintf("MAC%05d", $tot)."";
		
	}

}


?>