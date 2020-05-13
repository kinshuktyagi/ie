<?php
class stocks extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/stock_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Stock List';
		$data['offset'] = $offset;
		$this->admin_header($data);	
		$filter=array();
		if($this->input->post("search"))
		{
			$poid=$this->security->xss_clean(trim($this->input->post("poid")));
			$vendorcode=$this->security->xss_clean(trim($this->input->post("vendorcode")));
			$address=$this->security->xss_clean(trim($this->input->post("address")));
			$add_date=$this->security->xss_clean(trim($this->input->post("add_date")));
			$po_status=$this->security->xss_clean(trim($this->input->post("po_status")));
			$status=$this->security->xss_clean(trim($this->input->post("status")));

			$filter['po_poid']=$poid;
			$filter['po_vendorcode']=$vendorcode;
			$filter['po_address']=$address;
			$filter['po_add_date']=$add_date;
			$filter['po_po_status']=$po_status;
			$filter['po_status']=$status;
			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page=50;
		$data_arr=$this->stock_model->index($offset, $show_per_page);
				
		$data['data'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/stocks/index');
		$config['num_links'] 	 = 8;
		$config['uri_segment']	 = 4;
		$config['total_rows']	 = $data_arr['total'];
		$config['per_page'] 	 = $show_per_page;
		$config['full_tag_open'] = '<div class="pagination pagination-right"><ul class="pagination pagination-rounded">';
		$config['full_tag_close']= '</ul></div>';
		$config['num_tag_open']  = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] 	 = 'First';
		$config['first_tag_open']= '<li class="disabled">';
		$config['first_tag_close']= '</li>';
		$config['last_link'] 	 = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close']= '</li>';
		$config['prev_link'] 	 = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close']= '</li>';
		$config['next_link'] 	 = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close']= '</li>';
		$config['cur_tag_open']	 = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['reuse_query_string'] = true;
				
		$this->pagination->initialize($config);
		$data['paginate'] =  $this->pagination->create_links();
		$data['total'] =  $data_arr['total'];
		$this->load->view("account/stock_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/stocks/index");
	}
	
	//Going to add stock...
	public function add()
	{
		$data['title']='Add Stock';
		$this->admin_header($data);	
		$vendor=array();
		$vendor_po=array();
		$po_info=array();
		$vendor_po_info=array();
		$vendor_po_product=array();
		$product=array();
		$po_type=$this->stock_model->get_po_type();
		if(isset($_REQUEST['po_type']))
		{
			$vendor=$this->stock_model->get_vendor_info($po_type);
		}
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==1))
		{
			$vendor_po=$this->stock_model->get_vendor_po($_REQUEST['vendor']);
		}
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==2))
		{
			$product=$this->stock_model->get_vendor_product($_REQUEST['vendor']);
		}
		
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==1) && (isset($_REQUEST['po']) && $_REQUEST['po']!=''))
		{
			$vendor_po_info=$this->stock_model->get_vendor_po_info($_REQUEST['po']);
			$vendor_po_product=$this->stock_model->get_vendor_po_product($_REQUEST['po']);
		}
		
		/*  echo'<pre>';
		print_R($_SESSION['user']['id']);
		echo'</pre>';  */
		$data['po_type']=$po_type;
		$data['vendor']=$vendor;
		$data['vendor_po']=$vendor_po;
		$data['vendor_po_info']=$vendor_po_info;
		$data['vendor_po_product']=$vendor_po_product;
		$data['product']=$product;
		$this->load->view("account/add_stock",$data);
		$this->admin_footer($data);
	}
	
	
	//Fetching vendor information...
	public function get_vendor()
	{
		$po_type=$this->security->xss_clean(trim($this->input->post("po_type")));
		
		$info=$this->stock_model->get_vendor_info($po_type);
		echo'<option selected disabled value="">Select Vendor</option>';
		if(sizeof($info)>0)
		{
			for($i=0;$i<sizeof($info);$i++)
			{
				?>
					<option  value='<?php echo $info[$i]['vendor_id']; ?>'><?php echo $info[$i]['vendor_name'].' / '.$info[$i]['vendor_code']; ?></option>
				<?php
			}
		}
		
	}
	
	//Fetching vendor po...
	public function get_vendor_po()
	{
		$vendor=$this->security->xss_clean(trim($this->input->post("vendor")));
		$info=$this->stock_model->get_vendor_po($vendor);
		echo'<option selected disabled value="">Select PO</option>';
		if(sizeof($info)>0)
		{
			for($i=0;$i<sizeof($info);$i++)
			{
				?>
					<option  value='<?php echo $info[$i]['poid']; ?>'><?php echo $info[$i]['add_date'].' / Quantity '.$info[$i]['quantity'].' / Pending '.$info[$i]['pending_qty']; ?></option>
				<?php
			}
		}
	}
	
	//Going to add stock...
	public function add_stock()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit('stock'); */
		
		$date=$this->security->xss_clean(trim($this->input->post("date")));
		$po_type=$this->security->xss_clean(trim($this->input->post("po_type")));
		$vendor=$this->security->xss_clean(trim($this->input->post("vendor")));
		$po_id=$this->security->xss_clean(trim($this->input->post("vendor_po")));
		
		$count=0;
		if($po_type==1)
		{
			$po_product_id=$this->security->xss_clean($this->input->post("po_product_id"));
			$product_id=$this->security->xss_clean($this->input->post("product_id"));
			$total_qty=$this->security->xss_clean($this->input->post("total_qty"));
			$received_quantity=$this->security->xss_clean($this->input->post("received_quantity"));
			$process_qty=$this->security->xss_clean($this->input->post("process_qty"));
			$r_number=$this->security->xss_clean($this->input->post("r_number"));
			$s_number=$this->security->xss_clean($this->input->post("s_number"));
			
			if(sizeof($po_product_id)>0)
			{
				for($i=0;$i<sizeof($po_product_id);$i++)
				{
					$stock_ar=array();					
					$stock_ar['stock_id']=0;
					$stock_ar['product_id']=$product_id[$i];
					$stock_ar['purchase_type']=$po_type;
					$stock_ar['po_id']=$po_id;
					$stock_ar['r_number']=$r_number[$i];
					$stock_ar['s_number']=$s_number[$i];
					$stock_ar['quantity']=$process_qty[$i];
					$stock_ar['add_date']=date('Y-m-d');
					$stock_ar['added_by']=$_SESSION['user']['id'];
					$stock_ar['status']='True';
					
					$add=$this->stock_model->add_stock($stock_ar);
					if($add)
					{
						//Updating main product quantity in raw main table...
						$this->stock_model->update_product_stock($process_qty[$i],$product_id[$i]);
						
						//Updating po product status...
						$pro_qty=$received_quantity[$i]+$process_qty[$i];
						
						$po_product_ar=array('received_quantity'=>0,'received_status'=>'Pending');
						if($pro_qty==$total_qty[$i])
						{
							$po_product_ar=array('received_quantity'=>$pro_qty,'received_status'=>'Completed');
						}
						else
						{
							$po_product_ar=array('received_quantity'=>$pro_qty,'received_status'=>'Partial Completed');
						}
						$this->stock_model->update_product_status($po_product_ar,$po_product_id[$i]);
					}
					$count++;
				}
				
				$po_tot_qty=$this->stock_model->get_total_po_item_count($po_id);
				if(sizeof($po_tot_qty)>0)
				{
					$po_product_ar=array('receive_status'=>'Pending');
					if($po_tot_qty[0]['quantity']==$po_tot_qty[0]['received_quantity'])
					{
						$po_product_ar=array('receive_status'=>'Completed');
					}
					else
					{
						$po_product_ar=array('receive_status'=>'Partial Completed');
					}
					$this->stock_model->update_po_status($po_product_ar,$po_id);
				}
				
			}
		}
		else if($po_type==2)
		{
			$product=$this->security->xss_clean($this->input->post("product"));
			$quantity=$this->security->xss_clean($this->input->post("quantity"));
			if(sizeof($product)>0)
			{
				for($i=0;$i<sizeof($product);$i++)
				{
					if($product[$i] && $quantity[$i]>0)
					{
						$stock_ar=array();
					
						$stock_ar['stock_id']=0;
						$stock_ar['product_id']=$product[$i];
						$stock_ar['purchase_type']=$po_type;
						$stock_ar['quantity']=$quantity[$i];
						$stock_ar['add_date']=date('Y-m-d');
						$stock_ar['added_by']=$_SESSION['user']['id'];
						$stock_ar['status']='True';
						
						$add=$this->stock_model->add_stock($stock_ar);
						if($add)
						{
							//Updating main product quantity in raw main table...
							$this->stock_model->update_product_stock($quantity[$i],$product[$i]);
						}
						$count++;
					}
				}
			}
			
		}
		if($count)
		{
			$this->session->set_flashdata('success', 'Stock has been successfully added.');
			redirect("account/stocks/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/stocks/index");
		}
	}

	// going to add rack and shelf..
	public function add_rack_shelf()
	{
		$product_id=$this->security->xss_clean(trim($this->input->post("product_id")));
		$rack_number=$this->security->xss_clean(($this->input->post("rack_number")));
		$shelf_number=$this->security->xss_clean(($this->input->post("shelf_number")));
		$product_qty=$this->security->xss_clean(($this->input->post("product_qty")));
			if(sizeof($rack_number)>0)
			{
				for($i=0;$i<sizeof($rack_number);$i++)
				{
					if($shelf_number[$i]!='' && $product_qty[$i]>0)
					{
						$ar=array();					
						$ar['id']=0;
						$ar['product_id']=$product_id;
						$ar['rack_number']=$rack_number[$i];
						$ar['shelf_number']=$shelf_number[$i];
						$ar['product_qty']=$product_qty[$i];
						$ar['add_date']=date("Y-m-d");
			
						$add=$this->stock_model->add_rack_shelf($ar);
						if($add)
						{
							$this->session->set_flashdata('success', 'Stock has been successfully added.');
							redirect("account/stocks/index");
						}
						else
						{
							$this->session->set_flashdata('error', 'Something is problem please try again.');
							redirect("account/stocks/index");
						}
					}
				}
			}
	}
}

?>