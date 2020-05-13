<?php
class Product_model extends CI_Model
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
		$this->db->select('prd.product_id, prd.product_code, prd.product_name, prd.storage_type, prd.uom, prd.description, prd.weight, prd.thickness, prd.material, prd.dimension, prd.stress_relieved, prd.status, prd.add_date, prd.modify_date, store.storage_type_name, uom.uom_name, cat.raw_material_category_name,   prd.pro_type, sub_cat.sub_cat_name');

		if(sizeof($filter)>0)
		{
			if(isset($filter['pr_product_code']) && $filter['pr_product_code']!="")
			{
				$this->db->like('prd.product_code',$filter['pr_product_code']);
			}
			if(isset($filter['pr_product_name']) && $filter['pr_product_name']!="")
			{
				$this->db->like('prd.product_name',$filter['pr_product_name']);
			}
			if(isset($filter['pr_storage_type']) && $filter['pr_storage_type']!="")
			{
				$this->db->like('store.storage_type_name',$filter['pr_storage_type']);
			}			
			if(isset($filter['pr_cat']) && $filter['pr_cat']!="")
			{
				$this->db->like('cat.raw_material_category_name',$filter['pr_cat']);
			}
			if(isset($filter['pr_sub_cat']) && $filter['pr_sub_cat']!="")
			{
				$this->db->like('sub_cat.sub_cat_name',$filter['pr_sub_cat']);
			}
			if(isset($filter['pr_type']) && $filter['pr_type']!="")
			{
				$this->db->like('prd.pro_type',$filter['pr_type']);
			}			
			if(isset($filter['pr_description']) && $filter['pr_description']!="")
			{
				$this->db->like('prd.description',$filter['pr_description']);
			}
			if(isset($filter['pr_status']) && $filter['pr_status']!="")
			{
				$this->db->like('prd.status',$filter['pr_status']);
			}
		}
		
		$this->db->order_by('prd.product_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_product prd');
		$this->db->join('wi_storage_type store',' prd.storage_type= store.id');
		$this->db->join('wi_uom uom',' prd.uom= uom.uom_id');
		$this->db->join('wi_raw_material_category cat',' prd.pro_category= cat.id','left');
		$this->db->join('wi_sub_category sub_cat',' prd.pro_sub_category= sub_cat.id','left');
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
		$this->db->select('prd.product_id');

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
		
		$this->db->order_by('prd.product_id','DESC');
		$this->db->from('wi_product prd');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add product to database...
	public function add_product($ar)
	{		
		$this->db->insert("wi_product",$ar);		
		return $this->db->insert_id();
	}
	
	//Going to add product Vendor/Price Details to database...
	public function add_product_vendor($ar)
	{
		$this->db->insert("wi_product_vendor",$ar);
		return $this->db->insert_id();
	}
	
	//Update Product Vendor..
	public function update_product_vendor($product_id,$pr)
	{		
		$this->db->where("id",$product_id);
		return $this->db->update("wi_product_vendor",$pr);
	}

	//Fetching wi_product info...
	public function product_info($id)
	{
		$this->db->select("*");
		$this->db->where("product_id",$id);
		$re=$this->db->get('wi_product');
				
		$result=$re->result_array();
		/* echo"<pre>";
		print_r($result);
		exit(); */
		
		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['product_id']=$result[0]['product_id'];
			$ar['hsn_code']=$result[0]['hsn_code'];
			$ar['product_code']=$result[0]['product_code'];
			$ar['pro_category']=$result[0]['pro_category'];
			$ar['pro_sub_category']=$result[0]['pro_sub_category'];
			$ar['pro_type']=$result[0]['pro_type'];
			$ar['trash_hold']=$result[0]['trash_hold'];
			$ar['product_name']=$result[0]['product_name'];
			$ar['storage_type']=$result[0]['storage_type'];
			$ar['uom']=$result[0]['uom'];
			$ar['weight']=$result[0]['weight'];
			$ar['thickness']=$result[0]['thickness'];
			$ar['material']=$result[0]['material'];
			$ar['dimension']=$result[0]['dimension'];			
			$ar['stress_relieved']=$result[0]['stress_relieved'];			
			$ar['description']=$result[0]['description'];			
			$ar['status']=$result[0]['status'];			
			$ar['add_date']=$result[0]['add_date'];			
			$ar['length']=$result[0]['length'];			
			$ar['width']=$result[0]['width'];			
			$ar['height']=$result[0]['height'];			
			$ar['materials']=$result[0]['materials'];			
			$ar['radius']=$result[0]['radius'];			
			$ar['diameter']=$result[0]['diameter'];			
			$ar['volume']=$result[0]['volume'];			
			$ar['shank_length']=$result[0]['shank_length'];			
			$ar['no_of_teeth']=$result[0]['no_of_teeth'];			
			$ar['cutting_radius']=$result[0]['cutting_radius'];			
			$ar['cutting_tip']=$result[0]['cutting_tip'];			
			$ar['thread_diameter']=$result[0]['thread_diameter'];			
			$ar['thread_pitch']=$result[0]['thread_pitch'];			
			$ar['milling_tool_type']=$result[0]['milling_tool_type'];			
			$ar['boring_tool_type']=$result[0]['boring_tool_type'];			
			$ar['drilling_tool_type']=$result[0]['drilling_tool_type'];			
			$ar['reaming_tool_type']=$result[0]['reaming_tool_type'];			
			$ar['threading_tool_type']=$result[0]['threading_tool_type'];			
			$ar['special_tool_type']=$result[0]['special_tool_type'];
			$ar['adapter_machine_side']=$result[0]['adapter_machine_side'];			
			$ar['adapter_nose_type']=$result[0]['adapter_nose_type'];			
			$ar['pull_stud_type']=$result[0]['pull_stud_type'];		
			$ar['accessory_name']=$result[0]['accessory_name'];
			$ar['range_val']=$result[0]['range_val'];
			$ar['least_count']=$result[0]['least_count'];
			$ar['last_calibration_date']= date("d-m-Y", strtotime($result[0]['last_calibration_date']));			
			$ar['next_calibration_date']= date("d-m-Y", strtotime($result[0]['next_calibration_date']));			
			$ar['insert_shape']=$result[0]['insert_shape'];			
			$ar['insert_material']=$result[0]['insert_material'];			
			$ar['insert_product_code']=$result[0]['insert_product_code'];			
			$ar['no_of_cutting_edge']=$result[0]['no_of_cutting_edge'];			
		}
		else
		{
			$ar['product_id']='';
			$ar['hsn_code']='';
			$ar['product_code']='';
			$ar['pro_category']='';
			$ar['pro_sub_category']='';
			$ar['pro_type']='';
			$ar['trash_hold']='';
			$ar['product_name']='';
			$ar['storage_type']='';
			$ar['uom']='';
			$ar['weight']='';
			$ar['thickness']='';
			$ar['material']='';
			$ar['dimension']='';			
			$ar['stress_relieved']='';			
			$ar['description']='';			
			$ar['status']='';			
			$ar['add_date']='';			
			$ar['length']='';			
			$ar['width']='';			
			$ar['height']='';			
			$ar['materials']='';			
			$ar['radius']='';			
			$ar['diameter']='';			
			$ar['volume']='';			
			$ar['shank_length']='';			
			$ar['no_of_teeth']='';			
			$ar['cutting_radius']='';			
			$ar['cutting_tip']='';			
			$ar['thread_diameter']='';			
			$ar['thread_pitch']='';			
			$ar['milling_tool_type']='';			
			$ar['boring_tool_type']='';			
			$ar['drilling_tool_type']='';			
			$ar['reaming_tool_type']='';			
			$ar['threading_tool_type']='';			
			$ar['special_tool_type']='';			
			$ar['adapter_machine_side']='';			
			$ar['adapter_nose_type']='';			
			$ar['pull_stud_type']='';			
			$ar['accessory_name']='';			
			$ar['range_val']='';			
			$ar['least_count']='';			
			$ar['last_calibration_date']='';			
			$ar['next_calibration_date']='';			
			$ar['insert_shape']='';			
			$ar['insert_material']='';			
			$ar['insert_product_code']='';			
			$ar['no_of_cutting_edge']='';
		}		
		return $ar;
	}
	
	// Fetching the Vendor Product Info..
	public function vendor_product_info($id)
	{
		$this->db->select("prd.id, prd.product_id, prd.vendor_id, prd.price, prd.sku_code, prd.add_date, vendor.vendor_code, vendor.vendor_name");
		$this->db->where("product_id",$id);
		$re=$this->db->from('wi_product_vendor prd');
		$re=$this->db->join('wi_vendors vendor', 'prd.vendor_id=vendor.vendor_id' );
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		return $re->result_array();
	}

	//Going to update wi_product information...
	public function update($ar,$dept)
	{
		$this->db->where("product_id",$dept);
		return $this->db->update("wi_product",$ar);
	}
	
	// For Get The Vandor Name..
	public function get_vendor()
	{
		$this->db->select("vendor_id, vendor_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_vendors');
		return $re->result_array();
	}
	
	// Removing Vendor product...
	public function delete_product_vendor($product_id)
	{
		$this->db->where('id', $product_id);
		return $this->db->delete('wi_product_vendor');
	}
	
	// For Get The UOM Name..
	public function get_uom()
	{
		$this->db->select("uom_id, uom_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_uom');
		return $re->result_array();
	}
	// For Get The Storage Name..
	public function get_storage_type()
	{
		$this->db->select("id, storage_type_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_storage_type');
		return $re->result_array();
	}
	
	// TO Genrate User ID..
	public function generate_product_code()
	{
		$this->db->select_max("product_id");
		$re=$this->db->get('wi_product');
		$result=$re->result_array();		
		return $tot = $result[0]['product_id']+1;		
	}
	
	// Fetching The Product Category.
	public function get_category()
	{
		$this->db->select("id, raw_material_category_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_raw_material_category');
		return $re->result_array();
	}
	
	// Fetching The Product Sub Category.
	public function get_sub_category()
	{
		$this->db->select("id, sub_cat_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_sub_category');
		return $re->result_array();
	}
	
	// get the data for the product View..
	public function get_product($id)
	{
		$this->db->select("prd.product_id, prd.hsn_code, prd.product_code, prd.trash_hold, prd.product_name, prd.storage_type, prd.weight, prd.thickness, prd.material, prd.dimension, prd.stress_relieved, prd.description, prd.status, prd.add_date, uom.uom_name, cat.raw_material_category_name as category_name, storage.storage_type_name");
		//$this->db->where("status",'True');
		$this->db->from("wi_product prd");
		$this->db->join("wi_uom uom","prd.uom=uom.uom_id");
		$this->db->join("wi_raw_material_category cat","prd.pro_category=cat.id");
		$this->db->join("wi_storage_type storage","prd.storage_type=storage.id");
		$this->db->where("prd.product_id",$id);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */	
		$result = $re->result_array();
		
		$arr = array();
		if(sizeof($result) >0)
		{
			$arr['product_id'] =$result[0]['product_id'];
            $arr['hsn_code'] =$result[0]['hsn_code'];
            $arr['product_code'] =$result[0]['product_code'];
            $arr['trash_hold'] =$result[0]['trash_hold'];
            $arr['product_name'] =$result[0]['product_name'];
            $arr['storage_type'] =$result[0]['storage_type'];
            $arr['weight'] =$result[0]['weight'];
            $arr['thikness'] =$result[0]['thickness'];
            $arr['material'] =$result[0]['material'];
            $arr['dimension'] =$result[0]['dimension'];
            $arr['stress_relieved'] =$result[0]['stress_relieved'];
            //$arr['quantity'] =$result[0]['quantity'];
            $arr['description'] =$result[0]['description'];
            $arr['status'] =$result[0]['status'];
            $arr['add_date'] =$result[0]['add_date'];
            $arr['uom_name'] =$result[0]['uom_name'];
            $arr['category_name'] =$result[0]['category_name'];
            $arr['storage_type_name'] =$result[0]['storage_type_name'];
            $arr['vendor_details'] =$this->vendor_product_info($result[0]['product_id']);
			
		}
		else
		{
			$arr['product_id'] ='';
            $arr['hsn_code'] ='';
            $arr['product_code'] ='';
            $arr['trash_hold'] ='';
            $arr['product_name'] ='';
            $arr['storage_type'] ='';
            $arr['weight'] ='';
            $arr['thickness'] ='';
            $arr['material'] ='';
            $arr['dimension'] ='';
            $arr['stress_relieved'] ='';
            //$arr['quantity'] ='';
            $arr['description'] ='';
            $arr['status'] ='';
            $arr['add_date'] ='';
            $arr['uom_name'] ='';
            $arr['category_name'] ='';
            $arr['storage_type_name'] ='';
            $arr['contact_details'] ='';
		}
		return $arr;
		
	}
		
	//Fetch All Fields..
	public function get_all_fields()
	{
		$this->db->select('field.field_id, field.field_name');
		$this->db->from('wi_pro_field field');
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// Get The Sub Fields..
	public function get_sub_field($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For Materials..
	public function get_materials($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For cutting_tip..
	public function cutting_tip($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For milling_tool_type..
	public function milling_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For boring_tool_type..
	public function boring_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For drilling_tool_type..
	public function drilling_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For reaming_tool_type..
	public function reaming_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For threading_tool_type..
	public function threading_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For special_tool_type..
	public function special_tool_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For adapter_machine_side..
	public function adapter_machine_side($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For adapter_nose_type..
	public function adapter_nose_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For pull_stud_type..
	public function pull_stud_type($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// For insert_shape..
	public function insert_shape($id)
	{
		$this->db->select('data_name, data_id');
		$this->db->from('wi_pro_field_data');
		$this->db->where('field_id',$id);
		$re = $this->db->get();
		return $result = $re->result_array();
	}
	
	// get sub Category on behalf of category..
	public function sub_category($category_id)
	{
		$this->db->select("id, sub_cat_name");
		$this->db->where("category", $category_id);
		$re=$this->db->get('wi_sub_category');
		/* echo $this->db->last_query();
		exit(); */
		return $re->result_array();
	}
	
	// get sub category Fields..
	public function get_sub_category_field($sub_cat_id)
	{
		$this->db->select("field_id");
		$this->db->where("sub_category_id", $sub_cat_id);
		$re=$this->db->get('wi_pro_sub_category_field');		
		$result = $re->result_array();
		$arr =array();
		if(sizeof($result)>0)
		{
			
			for($i=0; sizeof($result)>$i; $i++)
			{
				$arr[] = $result[$i]['field_id'];
			}
		}
		return $arr;		
	}
	
	//get Category ID..	
	public function get_cat_id($sub_cat_id)
	{
		$this->db->select("category");
		$this->db->where("id", $sub_cat_id);
		$re=$this->db->get('wi_sub_category');		
		$result = $re->result_array();
		/* echo"<pre>";
		print_r($result);
		$arr =array(); */
		if(sizeof($result)>0)
		{	
			$cat_id = $result[0]['category'];			
		}
		return $cat_id;
	}
	
}


?>