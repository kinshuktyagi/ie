<?php
class Inventory_request_model extends CI_Model
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
		
		$user =$this->session->userdata("user");		
		$user_id = $user['id'];
		$report_to_employee = $this->report_to_data($user_id);
		
		$this->db->select('dp.id, dp.description, dp.production_date , dp.added_by, dp.status, dp.add_date, dp.modify_date, user.first_name, dp.request_status, dp.inventory_request_code');

		if(sizeof($filter)>0)
		{			
			if(isset($filter['issu_request_code']) && $filter['issu_request_code']!="")
			{
				$this->db->like('dp.inventory_request_code',$filter['issu_request_code']);
			}
			if(isset($filter['issu_prod_date']) && $filter['issu_prod_date']!="")
			{
				$this->db->like('dp.production_date',$filter['issu_prod_date']);
			}
			if(isset($filter['issu_description']) && $filter['issu_description']!="")
			{
				$this->db->like('dp.description',$filter['issu_description']);
			}
			if(isset($filter['issu_added_by']) && $filter['issu_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['issu_added_by']);
			}
			if(isset($filter['issu_status']) && $filter['issu_status']!="")
			{
				$this->db->like('dp.status',$filter['issu_status']);
			}
			if(($filter['issu_add_date']) && $filter['issu_add_date']!="")
			{
				$this->db->like('dp.add_date',$filter['issu_add_date']);
			}
			if(isset($filter['issu_modify_date']) && $filter['issu_modify_date']!="")
			{
				$this->db->like('dp.modify_date',$filter['issu_modify_date']);
			}
			if(isset($filter['issu_request_status']) && $filter['issu_request_status']!="")
			{
				$this->db->like('dp.request_status',$filter['issu_request_status']);
			}
			
		}
		
		if ($user['user_type'] == 2)
		{
			if (sizeof($report_to_employee) > 0)
			{
				$this->db->where_in('dp.added_by', $report_to_employee);				
			}else{
				$this->db->where_in('user.id',$user_id);
			}
		}
		elseif ($user['user_type'] == 3) 
		{
			$this->db->where_in('user.id',$user_id);
		}
		
		
		
		$this->db->order_by('dp.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_inventory_request dp');
		$this->db->join('wi_users user', 'dp.added_by=user.id');
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
			if(isset($filter['issu_prod_date']) && $filter['issu_prod_date']!="")
			{
				$this->db->like('dp.production_date',$filter['issu_prod_date']);
			}			
			if(isset($filter['issu_description']) && $filter['issu_description']!="")
			{
				$this->db->like('dp.description',$filter['issu_description']);
			}
			if(isset($filter['issu_added_by']) && $filter['issu_added_by']!="")
			{
				$this->db->like('user.first_name',$filter['issu_added_by']);
			}
			if(isset($filter['issu_status']) && $filter['issu_status']!="")
			{
				$this->db->like('dp.status',$filter['issu_status']);
			}
			if(($filter['issu_add_date']) && $filter['issu_add_date']!="")
			{
				$this->db->like('dp.add_date',$filter['issu_add_date']);
			}
			if(isset($filter['issu_modify_date']) && $filter['issu_modify_date']!="")
			{
				$this->db->like('dp.modify_date',$filter['issu_modify_date']);
			}
			if(isset($filter['issu_request_status']) && $filter['issu_request_status']!="")
			{
				$this->db->like('dp.request_status',$filter['issu_request_status']);
			}			
			
		}
		
		$this->db->order_by('dp.id','DESC');
		$this->db->from('wi_inventory_request dp');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}

	//Going to add inventory Request to database...
	public function add_inventory_request($ar)
	{
		$this->db->insert("wi_inventory_request",$ar);		
		return $this->db->insert_id();
	}
	
	//Going to add user to add_inventory_request_product...
	public function add_inventory_request_product($arr)
	{
		$this->db->insert("wi_inventory_request_product",$arr);	
		return $this->db->insert_id();
	}

	//Fetching departement info...
	public function invetory_issue_info($id)
	{
		$this->db->select("inv.id, inv.production_date, inv.description, inv.add_date, inv.request_status, user.first_name, user.last_name, inv.inventory_request_code");
		$this->db->where("inv.id",$id);
		$this->db->join('wi_users user','inv.added_by=user.id');
		$re=$this->db->get('wi_inventory_request inv');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['production_date']=$result[0]['production_date'];
			$ar['description']=$result[0]['description'];			
			$ar['add_date']=$result[0]['add_date'];			
			$ar['request_status']=$result[0]['request_status'];			
			$ar['first_name']=$result[0]['first_name'];			
			$ar['last_name']=$result[0]['last_name'];			
			$ar['inventory_request_code']=$result[0]['inventory_request_code'];			
			$ar['product']= $this->get_inventory_issue_product($result[0]['id']);			
		}
		else
		{
			$ar['id']='';
			$ar['production_date']='';
			$ar['description']='';
			$ar['product']='';
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$dept)
	{
		$this->db->where("id",$dept);
		/* $this->db->update("wi_inventory_request",$ar);
		echo $this->db->last_query();
		exit(); */
		return $this->db->update("wi_inventory_request",$ar);
	}
	
	//Fetch Product Details..
	public function get_product()
	{
		$this->db->select("product_id, product_code, product_name");
		$this->db->where("status", 'True');
		$re=$this->db->get('wi_product');
		return $result=$re->result_array();
	}

	// Fetching Inventory Issue Product..
	public function get_inventory_issue_product($id)
	{
		$this->db->select("pro.id, pro.inventory_request_id, pro.product_id, pro.product_qty, pro.notes, prod.product_code, pro.issued_qty, prod.product_name");
		$this->db->where("pro.inventory_request_id", $id);
		$this->db->join('wi_product prod', 'pro.product_id = prod.product_id');
		$re=$this->db->get('wi_inventory_request_product pro');
		return $result=$re->result_array();
	}
	
	// UPdate Inventory Product..
	public function update_inventory_request_product($ar, $id)
	{
		$this->db->where("id",$id);
		return $this->db->update("wi_inventory_request_product",$ar);
		
	}
	
	// Delete Inventory Product..
	public function delete_inventory_request_product($id)
	{ 
		$this->db->where("id",$id);
		return $this->db->delete("wi_inventory_request_product");
	}
	
	// TO Genrate Request ID..
	public function generate_userid()
	{
		$this->db->select_max("id");
		$re=$this->db->get('wi_inventory_request');
		$result=$re->result_array();		
		return $tot = $result[0]['id']+1;
		//return $user_id = sprintf("EMP%05d", $tot)."";		
	}
	
	//fetching all employee records under an employee...
	public function report_to_data($parent_id = 0, $ar = array())
	{
		$this->db->select('report.user_id, report.report_to');
		$this->db->from('wi_users_departmnet report');
		$this->db->where("report.report_to", $parent_id);
		$this->db->where("report.is_default",'True');
		$re=$this->db->get();
		$data = $re->result_array();
		
		if (sizeof($data) > 1) 
		{
			for ($i=0; $i < sizeof($data); $i++) 
			{
				$ar[]=$data[$i]['user_id'];
				$ar = array_merge($this->report_to_data($data[$i]['user_id']), $ar);				
			}
		}
		return $ar;		
	}
	
	//Going to Add Approve Request into Database..
	public function approve_inventory($ar)
	{
		$this->db->insert("wi_inventory_request_approved",$ar);	
		return $this->db->insert_id();
	}
	
	//Going to Add Approve Request into Database..
	public function add_inventory_approve_item($ar)
	{
		$this->db->insert("wi_inventory_request_product_item",$ar);	
		return $this->db->insert_id();
	}
	
}


?>