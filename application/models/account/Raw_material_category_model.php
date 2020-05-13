<?php
class Raw_material_category_model extends CI_Model
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

		$this->db->select('raw.id, raw.raw_material_category_name name, raw.description, raw.status');

		if(sizeof($filter)>0)
		{
			/* echo"";
			print_r($filter);
			exit('model'); */
			
			if(isset($filter['rm_category_name']) && $filter['rm_category_name']!="")
			{
				$this->db->like('raw.raw_material_category_name',$filter['rm_category_name']);
			}
			if(isset($filter['rm_category_description']) && $filter['rm_category_description']!="")
			{
				$this->db->like('raw.description',$filter['rm_category_description']);
			}
			if(isset($filter['rm_category_status']) && $filter['rm_category_status']!="")
			{
				$this->db->like('raw.status',$filter['rm_category_status']);
			}				
			
		}
		
		$this->db->order_by('raw.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_raw_material_category raw');
		$re=$this->db->get();		
		$data['total'] = $this->count_total($admin['id']);
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('raw.id');

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
		
		$this->db->from('wi_raw_material_category raw');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add user to database...
	public function add_category($ar)
	{
		$this->db->insert("wi_raw_material_category",$ar);
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function category_info($id)
	{
		$this->db->select("raw_material_category_name, id, description");
		$this->db->where("id",$id);
		$re=$this->db->get('wi_raw_material_category');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']		=$result[0]['id'];
			$ar['category_name']=$result[0]['raw_material_category_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']		='';
			$ar['ctegory_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$id)
	{
		$this->db->where("id",$id);
		return $this->db->update("wi_raw_material_category",$ar);
	}


}


?>