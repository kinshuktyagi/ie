<?php
class defective_stock extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/defective_stock_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Defective Stock List';
		$data['offset'] = $offset;
		$this->admin_header($data);	
		$filter=array();
		if($this->input->post("search"))
		{
			$po_type=$this->security->xss_clean(trim($this->input->post("po_type")));
			$po_number=$this->security->xss_clean(trim($this->input->post("po_number")));
			$description=$this->security->xss_clean(trim($this->input->post("description")));
			$stock_date=$this->security->xss_clean(trim($this->input->post("stock_date")));
			$add_date=$this->security->xss_clean(trim($this->input->post("add_date")));

			$filter['st_def_po_type']=$po_type;
			$filter['st_def_po_number']=$po_number;
			$filter['st_def_description']=$description;
			$filter['st_def_stock_date']=$stock_date;
			$filter['st_def_add_date']=$add_date;
			
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page=50;
		$data_arr=$this->defective_stock_model->index($offset, $show_per_page);
				
		$data['data'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/defective_stock/index');
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
		$this->load->view("account/defective_stock_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/defective_stock/index");
	}
	
	//Going to add stock...
	public function add()
	{
		$data['title']='Add Defective Stock';
		$this->admin_header($data);	
		$vendor=array();
		$vendor_po=array();
		$po_info=array();
		$vendor_po_info=array();
		$vendor_po_product=array();
		$product=array();
		$po_type=$this->defective_stock_model->get_po_type();
		if(isset($_REQUEST['po_type']))
		{
			$vendor=$this->defective_stock_model->get_vendor_info($po_type);
		}
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==1))
		{
			$vendor_po=$this->defective_stock_model->get_vendor_po($_REQUEST['vendor']);
		}
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==2))
		{
			$product=$this->defective_stock_model->get_vendor_product($_REQUEST['vendor']);
		}
		
		if((isset($_REQUEST['vendor'])) && (isset($_REQUEST['po_type']) && $_REQUEST['po_type']==1) && (isset($_REQUEST['po']) && $_REQUEST['po']!=''))
		{
			$vendor_po_info=$this->defective_stock_model->get_vendor_po_info($_REQUEST['po']);
			$vendor_po_product=$this->defective_stock_model->get_vendor_po_product($_REQUEST['po']);
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
		$this->load->view("account/add_defective_stock",$data);
		$this->admin_footer($data);
	}
	
	
	//Fetching vendor information...
	public function get_vendor()
	{
		$po_type=$this->security->xss_clean(trim($this->input->post("po_type")));
		
		$info=$this->defective_stock_model->get_vendor_info($po_type);
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
		$info=$this->defective_stock_model->get_vendor_po($vendor);
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
		exit(); */
		
		$po_type=$this->security->xss_clean(trim($this->input->post("po_type")));
		$vendor=$this->security->xss_clean(trim($this->input->post("vendor")));	
		
		$count=0;
		if($po_type==1)
		{
			$po_id=$this->security->xss_clean(trim($this->input->post("vendor_po")));
			$product_id=$this->security->xss_clean($this->input->post("product_id"));
			$process_qty=$this->security->xss_clean($this->input->post("process_qty"));
			$description=$this->security->xss_clean($this->input->post("description"));
			
			if(sizeof($product_id)>0)
			{
				$defective_stock_ar['defective_stock_id']=0;
				$defective_stock_ar['purchase_type']=$po_type;
				$defective_stock_ar['vendor_id']=$vendor;
				$defective_stock_ar['po_id']=$po_id;
				$defective_stock_ar['description']=$description;
				$defective_stock_ar['add_date']=date('Y-m-d');
				$defective_stock_ar['stock_date']=date('Y-m-d');
				$defective_stock_ar['added_by']=$_SESSION['user']['id'];
				
				$defective_stock_id=$this->defective_stock_model->add_defective_stock($defective_stock_ar);
				for($i=0;$i<sizeof($product_id);$i++)
				{
					if($process_qty[$i]>0)
					{
						$stock_ar=array();
						$stock_ar['defective_product_id']=0;
						$stock_ar['defective_stock_id']=$defective_stock_id;
						$stock_ar['product_id']=$product_id[$i];
						$stock_ar['quantity']=$process_qty[$i];
						$stock_ar['quantity']=$process_qty[$i];
						$add=$this->defective_stock_model->add_defectibe_product_stock($stock_ar);
						
						$this->minus_stock($product_id[$i],$process_qty[$i]);
						$count++;
					}
					
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Something is problem please try again.');
				redirect("account/defective_stock/index");
			}
		}
		else if($po_type==2)
		{
			$date=$this->security->xss_clean(trim($this->input->post("date")));
			$product=$this->security->xss_clean($this->input->post("product"));
			$quantity=$this->security->xss_clean($this->input->post("quantity"));
			if(sizeof($product)>0)
			{
				$defective_stock_ar['defective_stock_id']=0;
				$defective_stock_ar['purchase_type']=$po_type;
				$defective_stock_ar['vendor_id']=$vendor;
				$defective_stock_ar['description']=$description;
				$defective_stock_ar['add_date']=date('Y-m-d');
				$defective_stock_ar['stock_date']=date('Y-m-d',strtotime($date));
				$defective_stock_ar['added_by']=$_SESSION['user']['id'];
				$defective_stock_id=$this->defective_stock_model->add_defective_stock($defective_stock_ar);
				for($i=0;$i<sizeof($product);$i++)
				{
					if($quantity[$i]>0)
					{
						$stock_ar=array();
						$stock_ar['defective_product_id']=0;
						$stock_ar['defective_stock_id']=$defective_stock_id;
						$stock_ar['product_id']=$product[$i];
						$stock_ar['quantity']=$quantity[$i];
						$add=$this->defective_stock_model->add_defectibe_product_stock($stock_ar);
						$this->minus_stock($product[$i],$quantity[$i]);
						$count++;
					}
					
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Something is problem please try again.');
				redirect("account/defective_stock/index");
			}
			
		}
		if($count)
		{
			$this->session->set_flashdata('success', 'Defective stock has been successfully added.');
			redirect("account/defective_stock/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/defective_stock/index");
		}
	}
	
	
	public function minus_stock($product_id,$quantity)
	{
		$this->db->select('quantity');
		$this->db->from('wi_product');
		$this->db->where('product_id',$product_id);
		$re=$this->db->get();
		$result=$re->result_array();
		if(sizeof($result)>0)
		{
			$total=$result[0]['quantity']-$quantity;
			$ar=array('quantity'=>$total);			
			$this->db->where('product_id',$product_id);
			return $this->db->update('wi_product',$ar);
		}
	}
	
	// View The Defective Stock..
	public function view()
	{
		$data['title']='View Defective Stock';
		$this->admin_header($data);
		$id = $this->security->xss_clean(trim($_REQUEST['id']));		
		$purchase = $this->defective_stock_model->get_purchase_type($id);
		
		if($purchase['purchase_type']=='2')
		{
			$data['stock'] = $this->defective_stock_model->get_def_stock_without_po($id);
		}
		else
		{
			$data['stock'] = $this->defective_stock_model->get_def_stock_details($id);
		}
		
		$this->load->view("account/view_defective_stock",$data);
		$this->admin_footer($data);
	}
}

?>