<?php
class defective_stock_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$this->db->select("po_type.po_type_name,defective.description, defective.stock_date, defective.add_date,sum(defective_product.quantity) as quantity,defective.po_id,defective.defective_stock_id");
		$this->db->from("wi_stock_defective defective");
		$this->db->join('wi_stock_defective_product defective_product','defective_product.defective_stock_id=defective.defective_stock_id');
		$this->db->join('wi_po_type po_type','po_type.po_type_id=defective.purchase_type');
		if(sizeof($filter)>0)
		{
			if(isset($filter['st_def_po_type']) && $filter['st_def_po_type']!="")
			{
				$this->db->like('defective.purchase_type',$filter['st_def_po_type']);
			}
			if(isset($filter['st_def_po_number']) && $filter['st_def_po_number']!="")
			{
				$this->db->like('defective.po_id',$filter['st_def_po_number']);
			}
			if(isset($filter['st_def_description']) && $filter['st_def_description']!="")
			{
				$this->db->like('defective.description',$filter['st_def_description']);
			}
			if(isset($filter['st_def_stock_date']) && $filter['st_def_stock_date']!="")
			{
				$this->db->like('defective.stock_date',date('Y-m-d',strtotime($filter['st_def_stock_date'])));
			}
			if(isset($filter['st_def_add_date']) && $filter['st_def_add_date']!="")
			{
				$this->db->like('defective.add_date',date('Y-m-d',strtotime($filter['st_def_add_date'])));
			}
		}
		$this->db->group_by('defective.defective_stock_id');
		$this->db->order_by('defective.defective_stock_id','DESC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		$data['total'] = $this->count_total();
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total()
	{
		$filter=$this->session->userdata("search");
		$this->db->select("po_type.po_type_name,defective.description, defective.stock_date, defective.add_date,sum(defective_product.quantity) as quantity,defective.po_id,defective.defective_stock_id");
		$this->db->from("wi_stock_defective defective");
		$this->db->join('wi_stock_defective_product defective_product','defective_product.defective_stock_id=defective.defective_stock_id');
		$this->db->join('wi_po_type po_type','po_type.po_type_id=defective.purchase_type');
		if(sizeof($filter)>0)
		{
			if(isset($filter['st_def_po_type']) && $filter['st_def_po_type']!="")
			{
				$this->db->like('defective.purchase_type',$filter['st_def_po_type']);
			}
			if(isset($filter['st_def_po_number']) && $filter['st_def_po_number']!="")
			{
				$this->db->like('defective.po_id',$filter['st_def_po_number']);
			}
			if(isset($filter['st_def_description']) && $filter['st_def_description']!="")
			{
				$this->db->like('defective.description',$filter['st_def_description']);
			}
			if(isset($filter['st_def_stock_date']) && $filter['st_def_stock_date']!="")
			{
				$this->db->like('defective.stock_date',date('Y-m-d',strtotime($filter['st_def_stock_date'])));
			}
			if(isset($filter['st_def_add_date']) && $filter['st_def_add_date']!="")
			{
				$this->db->like('defective.add_date',date('Y-m-d',strtotime($filter['st_def_add_date'])));
			}
		}
		$this->db->group_by('defective.defective_stock_id');
		$this->db->order_by('defective.defective_stock_id','DESC');
		$re=$this->db->get();
		$result=$re->result_array();
		return sizeof($result);
	}
	
	//Fetching po type...
	public function get_po_type()
	{
		$this->db->select('po_type_id, po_type_name');
		$this->db->from('wi_po_type');
		$re=$this->db->get();
		return $re->result_array();
	}
	
	//Fetching vendor list...
	public function get_vendor_info($po_type)
	{
		if($po_type==1)
		{
			$this->db->select('vendor.vendor_id,vendor.vendor_name, vendor.vendor_code, vendor.vendor_gst');
			$this->db->from('wi_po po');
			$this->db->join('wi_vendors vendor','vendor.vendor_id=po.vendor_id');
			$this->db->where('po.status','True');
			$this->db->where('po.receive_status!=','Pending');
			$this->db->group_by('vendor.vendor_id');
			$re=$this->db->get();
			return $re->result_array();
		}
		else
		{
			$this->db->select('vendor_id,vendor_name, vendor_code, vendor_gst');
			$this->db->from('wi_vendors');
			$this->db->where('status','True');
			$re=$this->db->get();
			return $re->result_array();
		}
	}
	
	//Fetching vendor po...
	public function get_vendor_po($vendor)
	{
		$this->db->select('sum(po_product.quantity) as quantity, sum(po_product.received_quantity) as received_quantity, po.poid, po.add_date');
		$this->db->from('wi_po po');
		$this->db->join('wi_vendors vendor','vendor.vendor_id=po.vendor_id');
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		$this->db->where('po.vendor_id',$vendor);
		$this->db->where('po.receive_status!=','Pending');
		$this->db->group_by('po.poid');
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$child=array();
				$child['poid']=$result[$i]['poid'];
				$child['add_date']=date('d-m-Y',strtotime($result[$i]['add_date']));
				$child['quantity']=$result[$i]['quantity'];
				$child['received_quantity']=$result[$i]['received_quantity'];
				$child['pending_qty']=$result[$i]['quantity']-$result[$i]['received_quantity'];
				$ar[$i]=$child;
			}
		}
		return  $ar;
	}
	
	//Fetching vendor po info...
	public function get_vendor_po_info($poid)
	{
		$this->db->select('sum(po_product.quantity) as quantity, sum(po_product.received_quantity) as received_quantity, po.poid, po.add_date,vendor.vendor_id,vendor.vendor_name, vendor.vendor_code, vendor.vendor_gst, po.receive_status');
		$this->db->from('wi_po po');
		$this->db->join('wi_vendors vendor','vendor.vendor_id=po.vendor_id');
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		$this->db->where('po.poid',$poid);
		$this->db->where('po.receive_status!=','Pending');
		$this->db->group_by('po.poid');
		$re=$this->db->get();
		$result=$re->result_array();
		$child=array();
		if(sizeof($result)>0)
		{
			$child['poid']=$result[0]['poid'];
			$child['add_date']=date('d-m-Y',strtotime($result[0]['add_date']));
			$child['quantity']=$result[0]['quantity'];
			$child['received_quantity']=$result[0]['received_quantity'];
			$child['pending_qty']=$result[0]['quantity']-$result[0]['received_quantity'];
			$child['vendor_id']=$result[0]['vendor_id'];
			$child['vendor_name']=$result[0]['vendor_name'];
			$child['vendor_code']=$result[0]['vendor_code'];
			$child['gst_number']=$result[0]['vendor_gst'];	
			$child['receive_status']=$result[0]['receive_status'];	
		}
		else
		{
			$child['poid']='';
			$child['add_date']='';
			$child['quantity']='';
			$child['received_quantity']='';
			$child['pending_qty']='';
			$child['vendor_id']='';
			$child['vendor_name']='';
			$child['vendor_code']='';
			$child['gst_number']='';
			$child['receive_status']='';
		}
		return $child;
	}
	
	//Fetching vendor po info...
	public function get_vendor_po_product($poid)
	{
		$this->db->select('po.poid,sum(po_product.quantity) as quantity ,sum(po_product.received_quantity) as received_quantity,po_product.po_product_id, po_product.received_status ,bom_data.product_name,bom_data.product_id,(select sum(defective_product.quantity) as defective_product from wi_stock_defective defective join wi_stock_defective_product defective_product on defective_product.defective_stock_id=defective.defective_stock_id where defective.po_id='.$poid.' and defective_product.product_id=bom_data.product_id) as quantity_defective');
		$this->db->from('wi_po po');
		$this->db->join('wi_vendors vendor','vendor.vendor_id=po.vendor_id');
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		$this->db->join('wi_product bom_data','bom_data.product_id=po_product.product_id');
		$this->db->where('po.poid',$poid);
		$this->db->where('po_product.received_status!=','Pending');
		$this->db->group_by('bom_data.product_id');
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$child=array();
				$child['poid']=$result[$i]['poid'];
				$child['product_id']=$result[$i]['product_id'];
				$child['po_product_id']=$result[$i]['po_product_id'];
				$child['product_name']=$result[$i]['product_name'];
				$child['quantity']=$result[$i]['quantity'];
				$child['received_quantity']=$result[$i]['received_quantity'];
				$child['pending_qty']=$result[$i]['quantity']-$result[$i]['received_quantity'];
				$child['received_status']=$result[$i]['received_status'];
				$child['quantity_defective']=$result[$i]['quantity_defective'];
				$ar[$i]=$child;
			}
		}
		return $ar;
	}
	
	//Going to add defective stock...
	public function add_defective_stock($defective_stock_ar)
	{
		$this->db->insert('wi_stock_defective',$defective_stock_ar);		
		return $this->db->insert_id();
	}
	//Going to add defective stock product...
	public function add_defectibe_product_stock($stock_ar)
	{
		$this->db->insert('wi_stock_defective_product',$stock_ar);
		return $this->db->insert_id();
	}
	
	
	public function get_vendor_product($vendor_id)
	{
		$this->db->select('product.product_id, product.product_name');
		$this->db->from('wi_product product');
		$this->db->join('wi_product_vendor product_vendor','product_vendor.product_id=product.product_id');
		$this->db->where('product_vendor.vendor_id',$vendor_id);
		$this->db->group_by('product.product_id');
		$re=$this->db->get();
		return $re->result_array();
	}
	
	// Fetching The Defective Stock..
	public function get_def_stock_details($id)
	{
		$this->db->select('stock.defective_stock_id, stock.purchase_type, stock.po_id, stock.description, stock.stock_date, product.defective_product_id,  product.product_id, sum(product.quantity) as quantity, vendor.vendor_code, vendor.vendor_name, vendor.vendor_phone, vendor.vendor_email, vendor.vendor_gst, vendor.vendor_company_address, vendor.vendor_city, vendor.vendor_pincode, state.stateNAme,country.countryName, po.add_date');
		$this->db->from('wi_stock_defective stock');
		$this->db->join('wi_stock_defective_product product', 'stock.defective_stock_id=product.defective_stock_id');
		$this->db->join('wi_po po', 'stock.po_id=po.poid');
		$this->db->join('wi_vendors vendor', 'po.vendor_id=vendor.vendor_id');
		
		$this->db->join("wi_countries country","vendor.vendor_country=country.countryID");
		$this->db->join("wi_states state","vendor.vendor_state=state.stateID");
		
		$this->db->where('stock.defective_stock_id',$id);
		$this->db->group_by('product.defective_stock_id');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$result = $re->result_array();
		$ar = array();
		if(sizeof($result) > 0)
		{
			
			$ar['defective_stock_id'] = $result[0]['defective_stock_id'];
			$ar['purchase_type'] = $result[0]['purchase_type'];
			$ar['po_id'] = $result[0]['po_id'];
			$ar['description'] = $result[0]['description'];
			$ar['stock_date'] = $result[0]['stock_date'];
			$ar['quantity'] = $result[0]['quantity'];
			$ar['stock_date'] = $result[0]['stock_date'];
			$ar['vendor_code'] = $result[0]['vendor_code'];
			$ar['vendor_name'] = $result[0]['vendor_name'];
			$ar['vendor_phone'] = $result[0]['vendor_phone'];
			$ar['vendor_email'] = $result[0]['vendor_email'];
			$ar['vendor_gst'] = $result[0]['vendor_gst'];
			$ar['vendor_address'] = $result[0]['vendor_company_address'];
			$ar['vendor_pincode'] = $result[0]['vendor_pincode'];
			$ar['vendor_city'] = $result[0]['vendor_city'];
			$ar['vendor_city'] = $result[0]['vendor_city'];
			$ar['stateNAme'] = $result[0]['stateNAme'];
			$ar['countryName'] = $result[0]['countryName'];
			$ar['add_date'] = $result[0]['add_date'];
			
			$ar['product'] = $this->get_defected_stock_product($result[0]['defective_stock_id']);			
		}
		else
		{
			$ar['defective_stock_id'] = '';
			$ar['purchase_type'] = '';
			$ar['po_id'] = '';
			$ar['description'] = '';
			$ar['stock_date'] = '';
			$ar['quantity'] = '';			
			$ar['stock_date'] = '';
			$ar['vendor_code'] = '';
			$ar['vendor_name'] = '';
			$ar['vendor_phone'] = '';
			$ar['vendor_email'] = '';
			$ar['vendor_gst'] = '';
			$ar['vendor_address'] = '';
			$ar['vendor_pincode'] = '';
			$ar['vendor_city'] = '';
			$ar['vendor_city'] = '';
			$ar['stateNAme'] = '';
			$ar['countryName'] = '';			
			$ar['product'] = '';
		}		
		return $ar;
	}
	
	// Fetching The Defetced Product..
	public function get_defected_stock_product($id)
	{
		$this->db->select('stock.product_id, stock.quantity, product.product_name, product.product_code, product.hsn_code');
		$this->db->from('wi_stock_defective_product stock');		
		$this->db->join('wi_product product','stock.product_id=product.product_id');		
		$this->db->where('defective_stock_id',$id);
		$re=$this->db->get();
		return $result = $re->result_array();
	}
	
	// fetching the Purchase Type
	public function get_purchase_type($id)
	{
		$this->db->select('purchase_type');
		$this->db->from('wi_stock_defective');		
		$this->db->where('defective_stock_id',$id);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$result = $re->result_array();
		$ar = array();
		if(sizeof($result)>0)
		{
			$ar['purchase_type'] = $result[0]['purchase_type'];
		}else{
			$ar['purchase_type'] = '';
		}
		return $ar;
	}
	
	// Fetching The Defective Stock..
	public function get_def_stock_without_po($id)
	{
		$this->db->select('stock.defective_stock_id, stock.purchase_type, stock.po_id, stock.description, stock.stock_date, product.defective_product_id, product.product_id, sum(product.quantity) as quantity, vendor.vendor_code, vendor.vendor_name, vendor.vendor_phone, vendor.vendor_email, vendor.vendor_gst, vendor.vendor_company_address, vendor.vendor_city, vendor.vendor_pincode, state.stateNAme,country.countryName');
		$this->db->from('wi_stock_defective stock');
		$this->db->join('wi_stock_defective_product product', 'stock.defective_stock_id=product.defective_stock_id');
		$this->db->join('wi_vendors vendor', 'stock.vendor_id=vendor.vendor_id');
		
		$this->db->join("wi_countries country","vendor.vendor_country=country.countryID");
		$this->db->join("wi_states state","vendor.vendor_state=state.stateID");
		
		$this->db->where('stock.defective_stock_id',$id);
		$this->db->group_by('product.defective_stock_id');
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$result = $re->result_array();
		$ar = array();
		if(sizeof($result) > 0)
		{
			
			$ar['defective_stock_id'] = $result[0]['defective_stock_id'];
			$ar['purchase_type'] = $result[0]['purchase_type'];
			$ar['po_id'] = $result[0]['po_id'];
			$ar['description'] = $result[0]['description'];
			$ar['stock_date'] = $result[0]['stock_date'];
			$ar['quantity'] = $result[0]['quantity'];
			$ar['stock_date'] = $result[0]['stock_date'];
			$ar['vendor_code'] = $result[0]['vendor_code'];
			$ar['vendor_name'] = $result[0]['vendor_name'];
			$ar['vendor_phone'] = $result[0]['vendor_phone'];
			$ar['vendor_email'] = $result[0]['vendor_email'];
			$ar['vendor_gst'] = $result[0]['vendor_gst'];
			$ar['vendor_address'] = $result[0]['vendor_company_address'];
			$ar['vendor_pincode'] = $result[0]['vendor_pincode'];
			$ar['vendor_city'] = $result[0]['vendor_city'];
			$ar['vendor_city'] = $result[0]['vendor_city'];
			$ar['stateNAme'] = $result[0]['stateNAme'];
			$ar['countryName'] = $result[0]['countryName'];
			
			$ar['product'] = $this->get_defected_stock_product($result[0]['defective_stock_id']);			
		}
		else
		{
			$ar['defective_stock_id'] = '';
			$ar['purchase_type'] = '';
			$ar['po_id'] = '';
			$ar['description'] = '';
			$ar['stock_date'] = '';
			$ar['quantity'] = '';			
			$ar['stock_date'] = '';
			$ar['vendor_code'] = '';
			$ar['vendor_name'] = '';
			$ar['vendor_phone'] = '';
			$ar['vendor_email'] = '';
			$ar['vendor_gst'] = '';
			$ar['vendor_address'] = '';
			$ar['vendor_pincode'] = '';
			$ar['vendor_city'] = '';
			$ar['vendor_city'] = '';
			$ar['stateNAme'] = '';
			$ar['countryName'] = '';			
			$ar['product'] = '';
		}
		return $ar;
	}

}
?>