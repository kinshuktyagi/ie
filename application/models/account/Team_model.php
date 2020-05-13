<?php
class team_model extends CI_Model
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

		$this->db->select('team.id, team.department_id, team.team_name, team.status, team.add_date, team.modify_date, department.department_name ');

		if(sizeof($filter)>0)
		{
			if(isset($filter['tm_department_name']) && $filter['tm_department_name']!="")
			{
				$this->db->like('team.department_id',$filter['tm_department_name']);
			}
			if(isset($filter['tm_team_name']) && $filter['tm_team_name']!="")
			{
				$this->db->like('team.team_name',$filter['tm_team_name']);
			}
			if(isset($filter['tm_team_status']) && $filter['tm_team_status']!="")
			{
				$this->db->like('team.status',$filter['tm_team_status']);
			}				
			
		}
		
		$this->db->order_by('team.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_team team');
		$this->db->join('wi_department department','team.department_id = department.id');
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		//$data['total'] = $this->db->count_all('wi_team');
		$data['data']  = $re->result_array();
	    return $data; 
	}

	public function count_total ()
	{
		$filter=$this->session->userdata("search");

		$this->db->select('team.id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['tm_department_name']) && $filter['tm_department_name']!="")
			{
				$this->db->like('team.department_id',$filter['tm_department_name']);
			}
			if(isset($filter['tm_team_name']) && $filter['tm_team_name']!="")
			{
				$this->db->like('team.team_name',$filter['tm_team_name']);
			}
			if(isset($filter['tm_team_status']) && $filter['tm_team_status']!="")
			{
				$this->db->like('team.status',$filter['tm_team_status']);
			}				
			
		}
		
		$this->db->order_by('team.id','DESC');
		$this->db->from('wi_team team');
		$this->db->join('wi_department department','team.department_id = department.id');
		$re=$this->db->get();
		$result  = $re->result_array();
	    return sizeof($result); 

	}

	//Going to add user to database...
	public function add_team($ar)
	{
		$this->db->insert("wi_team",$ar);
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function team_info($team)
	{
		$this->db->select("*");
		$this->db->where("id",$team);
		$re=$this->db->get('wi_team');
		$result=$re->result_array();
		/*echo "<pre>";
		print_r($result);
		exit();*/
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['department_id']=$result[0]['department_id'];
			$ar['team_name']=$result[0]['team_name'];			
		}
		else
		{
			$ar['id']		='';
			$ar['department_id']='';
			$ar['team_name']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$team_id)
	{
		/*echo "<pre>";
		print_r($ar);
		exit();*/
		$this->db->where("id",$team_id);
		return $this->db->update("wi_team",$ar);
	}

	public function get_department()
	{
		$this->db->select('id, department_name');
		$re = $this->db->get("wi_department");
		return $re->result_array();
	}


}


?>