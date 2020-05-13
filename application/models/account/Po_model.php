<?php
class Po_model extends CI_Model
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

		$this->db->select('po.poid, po.vendor_code, po.vendor_address, po.status, po.add_date, po.receive_status, sum(pro.quantity) as total_qty, sum(pro.received_quantity) as recived_qty');

		if(sizeof($filter)>0)
		{	/* echo"<pre>";
			print_r($filter);
			exit(); */
			
			if(isset($filter['p_poid']) && $filter['p_poid']!="")
			{
				$this->db->like('po.poid',$filter['p_poid']);
			}
			if(isset($filter['p_vendor_code']) && $filter['p_vendor_code']!="")
			{
				$this->db->like('po.vendor_code',$filter['p_vendor_code']);
			}
			if(isset($filter['p_vendor_address']) && $filter['p_vendor_address']!="")
			{
				$this->db->like('po.vendor_address',$filter['p_vendor_address']);
			}
			if(($filter['p_total_qty']) && $filter['p_total_qty']!="")
			{
				$this->db->like('po.vendor_code',$filter['p_total_qty']);
			}
			if(isset($filter['p_received_qty']) && $filter['p_received_qty']!="")
			{
				$this->db->like('po.vendor_code',$filter['p_received_qty']);
			}

			if(isset($filter['p_po_received_status']) && $filter['p_po_received_status']!="")
			{
				$this->db->like('po.receive_status',$filter['p_po_received_status']);
			}
			if(isset($filter['p_po_status']) && $filter['p_po_status']!="")
			{
				$this->db->like('po.status',$filter['p_po_status']);
			}
			
		}
		
		$this->db->order_by('po.poid','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_po po');
		$this->db->join('wi_po_product pro','po.poid=pro.po_id');
		$this->db->group_by("pro.po_id"); 
		$re=$this->db->get();
		$data['total'] = $this->count_total($admin['id']);
		
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('po.poid');

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
		
		$this->db->order_by('po.poid','DESC');
		$this->db->from('wi_po po');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}

	
	// For Get The Vandor details..
	public function get_vendor_detail($vendor_id)
	{
		$this->db->select("vendor_id, vendor_name, vendor_code, vendor_company_address");
		$this->db->where("vendor_id", $vendor_id);
		$re=$this->db->get('wi_vendors');
		$result =  $re->result_array();
		
		$ar = array();
		if(sizeof($result)>0)
		{
			$ar['vendor_id'] = $result[0]['vendor_id'];
			$ar['vendor_name'] = $result[0]['vendor_name'];
			$ar['vendor_code'] = $result[0]['vendor_code'];
			$ar['vendor_company_address'] = $result[0]['vendor_company_address'];
			
		}else{
				$ar['vendor_id'] = '';
				$ar['vendor_name'] = '';
				$ar['vendor_code'] = '';
				$ar['vendor_company_address'] = '';
			}
		return $ar;
	}	
	
	// For Get The Vandor Name..
	public function get_vendor()
	{
		$this->db->select("vendor_id, vendor_name,");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_vendors');
		return $re->result_array();
	}
	
	// For Get The TNC Name..
	public function get_tnc()
	{
		$this->db->select("tnc_id, tnc_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_tnc');
		return $re->result_array();
		
	}
	
	// For Get The Quotation Name..
	public function get_quotation()
	{
		$this->db->select("quotation_id, quotation_code, enquiry_id, enquiry_code");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_enquiry_quotation_main');
		return $re->result_array();
	}
	
	// For Get The Product Name..
	public function get_products()
	{
		$this->db->select("product_id, hsn_code, product_code, product_name,");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_product');
		return $re->result_array();
	}
	
	
	// Fething Vendors Product..
	public function get_vendor_product($vendor_id)
	{
		$this->db->select("vendor.product_id, vendor.vendor_id, vendor.price, vendor.sku_code,  product.hsn_code, product.product_code, product.product_name, product.description, vend.vendor_code, vend.vendor_name");
		$this->db->from('wi_product_vendor vendor');
		$this->db->join('wi_product product', 'vendor.product_id = product.product_id');
		$this->db->join('wi_vendors vend', 'vendor.vendor_id = vend.vendor_id');
		$this->db->where("vendor.vendor_id", $vendor_id);
		$re=$this->db->get();		
		return $re->result_array();
	}
	
	
	//Going to add PO to database...
	public function add_po($ar)
	{
		$this->db->insert("wi_po",$ar);
		return $this->db->insert_id();
	}	
	
	//Going to add PO Product to database...
	public function add_po_product($ar)
	{
		$this->db->insert("wi_po_product",$ar);
		return $this->db->insert_id();
	}


	//Going to update PO information...
	public function update($ar,$poid)
	{
		$this->db->where("poid",$poid);
		return $this->db->update("wi_po",$ar);
	}
	
	// Update PO Product..
	public function update_po_product($ar,$id)
	{
		$this->db->where("po_product_id",$id);
		return $this->db->update("wi_po_product",$ar);
	}
	
	// Delete PO Product..
	public function delete_po_product($id)
	{
		$this->db->where("po_product_id",$id);
		return $this->db->delete("wi_po_product");
		
	}
	
	// For Get The PO details..
	public function get_po_details($poid)
	{
		$this->db->select("po.poid, po.vendor_id, po.vendor_name, po.vendor_code, po.vendor_address, po.tnc_id, po.quotation_id, po.created_by, po.add_date, po.receive_status, tnc.tnc_name, tnc.description, usr.first_name, usr.last_name, vendor.vendor_code, vendor.vendor_email, vendor.vendor_phone, vendor.vendor_city, vendor.vendor_pincode, country.countryName, state.stateName");
		$this->db->where("po.poid", $poid);
		$this->db->from('wi_po po');
		$this->db->join('wi_tnc tnc', 'po.tnc_id=tnc.tnc_id');
		$this->db->join('wi_users usr', 'po.created_by=usr.id');
		$this->db->join('wi_vendors vendor', 'po.vendor_id=vendor.vendor_id');
		$this->db->join('wi_states state', 'vendor.vendor_state=state.stateID');
		$this->db->join('wi_countries country', 'vendor.vendor_country=country.countryID');
		$re=$this->db->get();
		
		$result =  $re->result_array();
				
		$ar = array();
		if(sizeof($result)>0)
		{
			$ar['poid'] = $result[0]['poid'];
			$ar['vendor_id'] = $result[0]['vendor_id'];
			$ar['vendor_name'] = $result[0]['vendor_name'];
			$ar['vendor_code'] = $result[0]['vendor_code'];
			$ar['vendor_address'] = $result[0]['vendor_address'];
			$ar['quotation_id'] = $result[0]['quotation_id'];
			$ar['tnc_id'] = $result[0]['tnc_id'];
			$ar['add_date'] = $result[0]['add_date'];
			$ar['receive_status'] = $result[0]['receive_status'];
			$ar['tnc_name'] = $result[0]['tnc_name'];
			$ar['description'] = $result[0]['description'];
			$ar['first_name'] = $result[0]['first_name'];
			$ar['last_name'] = $result[0]['last_name'];
			$ar['vendor_email'] = $result[0]['vendor_email'];
			$ar['vendor_phone'] = $result[0]['vendor_phone'];
			$ar['vendor_city'] = $result[0]['vendor_city'];
			$ar['vendor_pincode'] = $result[0]['vendor_pincode'];
			$ar['countryName'] = $result[0]['countryName'];
			$ar['stateName'] = $result[0]['stateName'];
			$ar['product'] = $this->get_po_product($result[0]['poid']);
			
		}else{
				$ar['vendor_id'] = '';
				$ar['vendor_name'] = '';
				$ar['vendor_code'] = '';
				$ar['vendor_address'] = '';
				$ar['tnc_id'] = '';
				$ar['quotation_id'] = '';
				$ar['add_date'] = '';
				$ar['receive_status'] = '';
				$ar['tnc_name'] = '';
				$ar['description'] = '';
				$ar['first_name'] = '';
				$ar['last_name'] = '';
				$ar['vendor_email'] = '';
				$ar['vendor_phone'] = '';
				$ar['vendor_city'] = '';
				$ar['vendor_pincode'] = '';
				$ar['countryName'] = '';
				$ar['stateName'] = '';
			}
		
		return $ar;
	}
	
	// FEtching the PO Products..
	public function get_po_product($poid)
	{
		$this->db->select("po.po_product_id, po.po_id, po.product_id, po.quantity, po.received_quantity, po.received_status, prdct.product_name, prdct.product_code, prdct.hsn_code");
		$this->db->where("po.po_id", $poid);
		$this->db->from('wi_po_product po');
		$this->db->join('wi_product prdct', 'po.product_id=prdct.product_id');
		$re=$this->db->get();		
		return $result =  $re->result_array();
	}
	
	// For Get The UOM Name..
	public function get_uom()
	{
		$this->db->select("uom_id, uom_name");
		$this->db->where("status",'True');
		$re=$this->db->get('wi_uom');
		return $re->result_array();
	}

}


?>