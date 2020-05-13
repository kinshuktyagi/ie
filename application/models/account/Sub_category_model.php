<?php
class Sub_category_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//Fetching Sub Category detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('raw.id, raw.sub_cat_name name, raw.description, raw.status, catt.raw_material_category_name');

		if(sizeof($filter)>0)
		{			
			if(isset($filter['r_cat_name']) && $filter['r_cat_name']!="")
			{
				$this->db->like('catt.raw_material_category_name',$filter['r_cat_name']);
			}
			if(isset($filter['r_sb_cat_name']) && $filter['r_sb_cat_name']!="")
			{
				$this->db->like('raw.sub_cat_name',$filter['r_sb_cat_name']);
			}
			if(isset($filter['r_sub_cat_description']) && $filter['r_sub_cat_description']!="")
			{
				$this->db->like('raw.description',$filter['r_sub_cat_description']);
			}
			if(isset($filter['r_sub_cat_status']) && $filter['r_sub_cat_status']!="")
			{
				$this->db->like('raw.status',$filter['r_sub_cat_status']);
			}				
			
		}
		
		$this->db->order_by('raw.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_sub_category raw');
		$this->db->join('wi_raw_material_category catt','raw.category=catt.id');
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
			if(isset($filter['r_sb_cat_name']) && $filter['r_sb_cat_name']!="")
			{
				$this->db->like('raw.sub_cat_name',$filter['r_sb_cat_name']);
			}
			if(isset($filter['r_sub_cat_description']) && $filter['r_sub_cat_description']!="")
			{
				$this->db->like('raw.description',$filter['r_sub_cat_description']);
			}
			if(isset($filter['r_sub_cat_status']) && $filter['r_sub_cat_status']!="")
			{
				$this->db->like('raw.status',$filter['r_sub_cat_status']);
			}				
			
		}		
		
		$this->db->from('wi_sub_category raw');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);
	}

	//Going to add Sub Category to database...
	public function add_sub_category($ar)
	{
		$this->db->insert("wi_sub_category",$ar);
		return $this->db->insert_id();
	}

	//Fetching Sub Category info...
	public function category_info($id)
	{
		$this->db->select("sub_cat_name, category, id, description");
		$this->db->where("id",$id);
		$re=$this->db->get('wi_sub_category');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['category']=$result[0]['category'];
			$ar['sub_cat_name']=$result[0]['sub_cat_name'];
			$ar['description']=$result[0]['description'];			
		}
		else
		{
			$ar['id']='';
			$ar['category']='';
			$ar['sub_cat_name']='';
			$ar['description']='';
		}
		return $ar;
	}

	//Going to update Sub information...
	public function update($ar,$id)
	{
		$this->db->where("id",$id);
		return $this->db->update("wi_sub_category",$ar);
	}
	
	// Fetching The Product Category.
	public function get_category()
	{
		$this->db->select("id, raw_material_category_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_raw_material_category');
		return $re->result_array();
	}

	// Fetching Product Sub Category Field..
	public function get_pro_sub_cat_field()
	{
		$this->db->select("field_id, field_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_pro_field');
		return $re->result_array();
	}
	
	// inserting add_sub_cat_field into database.
	public function add_sub_cat_field($arr)
	{
		$this->db->insert("wi_pro_sub_category_field",$arr);
		return $this->db->insert_id();
	}
	
	// Fetching Selected Field..
	public function sub_cat_selcted_field($id)
	{
		$this->db->select("field_id");
		$this->db->where("sub_category_id",$id);
		$re=$this->db->get('wi_pro_sub_category_field');
		
		$result = $re->result_array();
		$ar=array();
		if(sizeof($result))
		{			
			for($k=0; sizeof($result)>$k; $k++)
			{
				$ar[]= $result[$k]['field_id'];
			}			
		}
		return $ar;
		
	}
	
	// Delete Sub Category Field..
	public function delete_sub_cat_field($cat_id)
	{
		$this->db->where('sub_category_id', $cat_id);
		return $this->db->delete('wi_pro_sub_category_field');
	}
}


?>