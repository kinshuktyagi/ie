<?php
class stock_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//Fetchingplan detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$this->db->select("po.poid, po.vendor_id, po.vendor_name, po.vendor_code, po.vendor_address, po.add_date, po.modify_date, po.receive_status, po.status,sum(po_product.quantity) as quantity,sum(po_product.received_quantity) as received_quantity");
		$this->db->from("wi_po po");
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		if(sizeof($filter)>0)
		{
			if(isset($filter['po_poid']) && $filter['po_poid']!="")
			{
				$this->db->like('po.poid',$filter['po_poid']);
			}
			if(isset($filter['po_vendorcode']) && $filter['po_vendorcode']!="")
			{
				$this->db->like('po.vendor_code',$filter['po_vendorcode']);
			}
			if(isset($filter['po_address']) && $filter['po_address']!="")
			{
				$this->db->like('po.vendor_address',$filter['po_address']);
			}
			if(isset($filter['po_add_date']) && $filter['po_add_date']!="")
			{
				$this->db->like('po.add_date',date('Y-m-d',strtotime($filter['po_add_date'])));
			}
			if(isset($filter['po_po_status']) && $filter['po_po_status']!="")
			{
				$this->db->like('po.receive_status',$filter['po_po_status']);
			}
			if(isset($filter['po_status']) && $filter['po_status']!="")
			{
				$this->db->like('po.status',$filter['po_status']);
			}
		}
		$this->db->group_by('po.poid');
		$this->db->order_by('po.poid','DESC');
		$this->db->limit($limit, $offset);
		$re=$this->db->get();
		$data['total'] = $this->count_total();
		$data['data'] = $re->result_array();
	    return $data; 
	}
	
	
	public function count_total()
	{
		$filter=$this->session->userdata("search");
			$this->db->select("po.poid, po.status,sum(po_product.quantity) as quantity,sum(po_product.received_quantity) as received_quantity");
		$this->db->from("wi_po po");
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		if(sizeof($filter)>0)
		{
			if(isset($filter['po_poid']) && $filter['po_poid']!="")
			{
				$this->db->like('po.poid',$filter['po_poid']);
			}
			if(isset($filter['po_vendorcode']) && $filter['po_vendorcode']!="")
			{
				$this->db->like('po.vendor_code',$filter['po_vendorcode']);
			}
			if(isset($filter['po_address']) && $filter['po_address']!="")
			{
				$this->db->like('po.vendor_address',$filter['po_address']);
			}
			if(isset($filter['po_add_date']) && $filter['po_add_date']!="")
			{
				$this->db->like('po.add_date',date('Y-m-d',strtotime($filter['po_add_date'])));
			}
			if(isset($filter['po_po_status']) && $filter['po_po_status']!="")
			{
				$this->db->like('po.receive_status',$filter['po_po_status']);
			}
			if(isset($filter['po_status']) && $filter['po_status']!="")
			{
				$this->db->like('po.status',$filter['po_status']);
			}
		}
		$this->db->group_by('po.poid');
		$this->db->order_by('po.poid','DESC');
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
			$this->db->where('po.receive_status!=','Completed');
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
		$this->db->where('po.receive_status!=','Completed');
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
		$this->db->where('po.receive_status!=','Completed');
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
		$this->db->select('po.poid,po_product.quantity ,po_product.received_quantity,po_product.po_product_id, po_product.received_status ,product.product_name,product.product_id, product.product_code');
		$this->db->from('wi_po po');
		$this->db->join('wi_vendors vendor','vendor.vendor_id=po.vendor_id');
		$this->db->join('wi_po_product po_product','po_product.po_id=po.poid');
		$this->db->join('wi_product product','product.product_id=po_product.product_id');
		$this->db->where('po.poid',$poid);
		$this->db->where('po_product.received_status!=','Completed');
		$this->db->group_by('po_product.po_product_id');
		$re=$this->db->get();
		$result=$re->result_array();
		$ar=array();
		if(sizeof($result)>0)
		{
			for($i=0;$i<sizeof($result);$i++)
			{
				$child=array();
				$child['poid']=$result[$i]['poid'];
				$child['product_code']=$result[$i]['product_code'];
				$child['product_id']=$result[$i]['product_id'];
				$child['po_product_id']=$result[$i]['po_product_id'];
				$child['product_name']=$result[$i]['product_name'];
				$child['quantity']=$result[$i]['quantity'];
				$child['received_quantity']=$result[$i]['received_quantity'];
				$child['pending_qty']=$result[$i]['quantity']-$result[$i]['received_quantity'];
				$child['received_status']=$result[$i]['received_status'];
				$ar[$i]=$child;
			}
		}
		return $ar;
	}
	
	//Going to add stock...
	public function add_stock($stock_ar)
	{
		$this->db->insert('wi_stock',$stock_ar);
		/* echo $this->db->last_query();
		exit(); */
		return $this->db->insert_id();
	}
	
	//Going to update main product stock...
	public function update_product_stock($process_qty,$product_id)
	{
		$this->db->select('quantity');
		$this->db->from('wi_product');
		$this->db->where('product_id',$product_id);
		$re=$this->db->get();
		/* echo $this->db->last_query();
		exit(); */
		$result=$re->result_array();
		
		
		if(sizeof($result)>0)
		{
			$total=$process_qty+$result[0]['quantity'];
			$stock_ar=array('quantity'=>$total);
			
			$this->db->where('product_id',$product_id);
			return $this->db->update('wi_product',$stock_ar);
		}
	}
	
	//Going to update po product status...
	public function update_product_status($po_product_ar,$po_product_id)
	{
		$this->db->where('po_product_id',$po_product_id);
		return $this->db->update('wi_po_product',$po_product_ar);
	}
	
	//Fetching total po item count...
	public function get_total_po_item_count($po_id)
	{
		$this->db->select('sum(quantity) as quantity, sum(received_quantity) as received_quantity');
		$this->db->from('wi_po_product');
		$this->db->where('po_id',$po_id);
		$re=$this->db->get();
		return $re->result_array();
	}
	
	//Going to update po status...
	public function update_po_status($po_product_ar,$po_id)
	{
		$this->db->where('poid',$po_id);
		return $this->db->update('wi_po',$po_product_ar);
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
	
	//Going to add stock...
	public function add_rack_shelf($ar)
	{
		$this->db->insert('wi_product_rack_shelf',$ar);
		return $this->db->insert_id();
	}
}
?>