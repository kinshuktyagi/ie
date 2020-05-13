<?php
class master_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//Fetching user type...
	public function get_user_type($priority='')
	{
		$this->db->select("id, user_type");
		$this->db->where("status","True");
		$this->db->where("id>",1);
		if($priority)
		{
			$this->db->where("priority<",$_SESSION['user']['priority']);
		}
		$re=$this->db->get('wi_user_type');
		return $re->result_array();
	}
	
	//Fetching country list...
	public function get_country()
	{
		$this->db->select("countryID, countryName");
		$re=$this->db->get('wi_countries');
		return $re->result_array();
	}
	
	//Fetching country list...
	public function get_state($country)
	{
		$this->db->select("stateID, stateName");
		$this->db->where("countryID",$country);
		$re=$this->db->get('wi_states');
		return $re->result_array();
	}
	
	//Going to add user log information...
	public function add_log($log)
	{
		$this->db->insert("wi_log",$log);
		return $this->db->insert_id();
	}	
	
	
	//Fetching country list...
	public function get_country_name($country)
	{
		$this->db->select("countryID, countryName");
		$this->db->where("countryID",$country);
		$re=$this->db->get('wi_countries');
		$result=$re->result_array();
		if(sizeof($result)>0)
		{
			return $result[0]['countryName'];
		}
	}
	
	//Fetching country list...
	public function get_state_name($state)
	{
		$this->db->select("stateID, stateName");
		$this->db->where("stateID",$state);
		$re=$this->db->get('wi_states');
		$result=$re->result_array();
		if(sizeof($result)>0)
		{
			return $result[0]['stateName'];
		}
	}
	
	//Fetching City list...
	public function get_city()
	{
		$this->db->select("cityID, cityName");
		$this->db->where("countryID",'IND');
		$re=$this->db->get('wi_cities');
		return $re->result_array();		
	}
	
	// Fetching Department List...
	public function get_department()
	{
		$this->db->select("id, department_name");
		$re=$this->db->get('wi_department');
		return $re->result_array();		
	}
	
	// Fetching Designation List...
	public function get_designation()
	{
		$this->db->select("id, designation_name, priority");
		$re=$this->db->get('wi_designation');		
		return $re->result_array();		
	}
	
	
	//Going to check contractual employee status employee exist or not in databse...
	public function check_employee_status($employee_id)
	{
		$this->db->select("id, user_name, password, first_name, last_name, mobile, email, country, state, city");
		$this->db->where("id",$employee_id);
		$re=$this->db->get('wi_users');
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['user_name']=$result[0]['user_name'];
			$ar['password']=$result[0]['password'];
			$ar['first_name']=$result[0]['first_name'];
			$ar['last_name']=$result[0]['last_name'];
			$ar['mobile']=$result[0]['mobile'];
			$ar['email']=$result[0]['email'];
			$ar['country']=$result[0]['country'];
			$ar['state']=$result[0]['state'];
			$ar['city']=$result[0]['city'];
			$ar['status']='False';
		}
		else
		{
			$ar['id']='';
			$ar['user_name']='';
			$ar['password']='';
			$ar['first_name']='';
			$ar['last_name']='';
			$ar['mobile']='';
			$ar['email']='';
			$ar['country']='';
			$ar['state']='';
			$ar['city']='';
			$ar['status']='True';
		}
		return $ar;
	}
	

	
	public function get_category()
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."api/getCategories/key/".SERKRET_KEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'status=1');
		 $buffer = curl_exec($ch);
		curl_close($ch);
		$result = (array)json_decode($buffer);
		
		$ar=array();
		$cat_ar=array(63,60,61,59);
		if(isset($result['success']) && $result['success']==1)
		{
			$count=0;
			$info=(array)$result['category_info'];
			foreach($info as $data)
			{
				$category=(array)$data;
				if(!in_array($category['category_id'],$cat_ar))
				{
					$ar[$count]=$category;
					$count++;
				}
			}
		}
		return $ar;
	}
	
	
	public function get_sub_category($category)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."api/getchildCategories/cate_id/".$category."/key/".SERKRET_KEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'status=1');
		 $buffer = curl_exec($ch);
		curl_close($ch);
		$result = (array)json_decode($buffer);
  
		$ar=array();
		if(isset($result['success']) && $result['success']==1)
		{
			$count=0;
			$info=(array)$result['category_info'];
			foreach($info as $data)
			{
				$category=(array)$data;
				$ar[$count]=$category;
				$count++;
			}
		}
		return $ar;
	}
	
	public function product_list()
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,API_URL."api/products/key/".SERKRET_KEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'status=1');
		 $buffer = curl_exec($ch);
		curl_close($ch);
		$result = (array)json_decode($buffer);
		
		$ar=array();
		if(isset($result['success']) && $result['success']==1)
		{
			$count=0;
			$info=(array)$result['products'];
			foreach($info as $data)
			{
				$category=(array)$data;
				$ar[$count]=$category;
				$count++;
			}
		}
		return $ar;
	}
	
	//Fetching sub category name...
	public function get_category_name($category_id)
	{
		$this->db->select("name");
		$this->db->from("oc_category_description");
		$this->db->where("category_id",$category_id);
		$re=$this->db->get();
		
		
		$result=$re->result_array();
		if(sizeof($result)>0)
		{
			return $result[0]['name'];
		}
	}
	
	
}
?>