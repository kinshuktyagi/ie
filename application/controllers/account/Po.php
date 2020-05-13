<?php
class Po extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/po_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='PO List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$p_poid=$this->security->xss_clean(trim($this->input->post("p_poid")));
			$p_vendor_code=$this->security->xss_clean(trim($this->input->post("p_vendor_code")));
			$p_vendor_address=$this->security->xss_clean(trim($this->input->post("p_vendor_address")));
			$p_total_qty=$this->security->xss_clean(trim($this->input->post("p_total_qty")));
			$p_received_qty=$this->security->xss_clean(trim($this->input->post("p_received_qty")));
			$p_po_received_status=$this->security->xss_clean(trim($this->input->post("p_po_received_status")));
			$p_po_status=$this->security->xss_clean(trim($this->input->post("p_po_status")));
			
			$filter['p_poid']=$p_poid;
			$filter['p_vendor_code']=$p_vendor_code;
			$filter['p_vendor_address']=$p_vendor_address;
			$filter['p_total_qty']= $p_total_qty;
			$filter['p_received_qty']=$p_received_qty;
			$filter['p_po_received_status']=$p_po_received_status;
			$filter['p_po_status']=$p_po_status;
			
			$this->session->set_userdata("search",$filter);
		}
				
		$show_per_page = 50;
		$data_arr  	   = $this->po_model->index($offset, $show_per_page);

		$data['po'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/po/index');
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
		//$data['user_type'] =  $user_type;
		//$data['team'] =  $team;
		
		$this->load->view("account/po_list",$data);
		$this->admin_footer($data);
	}

	//Going to add departement...
	public function add()
	{
		
		$data['title']='Add PO';
		$this->admin_header($data);
		if(isset($_REQUEST['vendor']))
		{
			if(isset($_REQUEST['pro']))
			{
				$pro_id = $this->security->xss_clean(trim($_REQUEST['pro']));
				$ar = array();
				$br = array();
				$br['product_id'] = $pro_id;
				$ar[0][] = $br;
				$data['product'] = $ar[0];
				
				/* echo"<pre>";
				print_r($data);
				exit(); */
				
				$vendor_id = $this->security->xss_clean(trim($_REQUEST['vendor']));
				$data['products'] = $this->po_model->get_products();
				$data['vendor_id'] = $vendor_id;
				$data['uom'] = $this->po_model->get_uom();
			}
			else
			{
				$vendor_id = $this->security->xss_clean(trim($_REQUEST['vendor']));
				$data['product'] = $this->po_model->get_vendor_product($vendor_id);
				/* echo"<pre>";
				print_r($data);
				exit(); */
				
				$data['products'] = $this->po_model->get_products();
				$data['vendor_id'] = $vendor_id ;
				$data['uom'] = $this->po_model->get_uom();
			}
		}else{
			$data['product'] = array();
			$data['products'] = array();
			$data['vendor_id'] = '';
			$data['uom'] = array();
		}
		
		$data['vendor'] = $this->po_model->get_vendor();
		$data['tnc_data'] = $this->po_model->get_tnc();
		
		$data['quotation'] = $this->po_model->get_quotation();
		$this->load->view("account/add_po",$data);
		$this->admin_footer($data);
	}
	
	
	// going To Add..
	public function add_po()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		
		$vendor_id = $this->security->xss_clean(trim($this->input->post("vendor")));
		$tnc_id = $this->security->xss_clean(trim($this->input->post("tnc")));
		$quotation_id = $this->security->xss_clean(trim($this->input->post("quotation")));		
				
		$vendor_data = $this->po_model->get_vendor_detail($vendor_id);
		$user =$this->session->userdata("user");
		
		$ar=array();
		$ar['poid']=0;
		$ar['tnc_id'] = $tnc_id;
		$ar['quotation_id'] = $quotation_id;
		$ar['vendor_id'] = $vendor_data['vendor_id'];
		$ar['vendor_name'] = $vendor_data['vendor_name'];
		$ar['vendor_code'] = $vendor_data['vendor_code'];
		$ar['vendor_address'] = $vendor_data['vendor_company_address'];
		
		$ar['created_by'] = $user['id'];
		$ar['add_date'] = date("Y-m-d");
		$ar['status'] = 'True';
		
		$add=$this->po_model->add_po($ar);
		if($add)
		{
			$product = $this->security->xss_clean(($this->input->post("product")));		
			$quantity = $this->security->xss_clean(($this->input->post("quantity")));
			
			if( sizeof($product)>0)
			{
				for($i=0; sizeof($product)>$i; $i++ )
				{
					if($product[$i] != '')
					{
						$pr = array();
						$pr['po_product_id'] = 0;
						$pr['po_id'] = $add;
						$pr['product_id'] = $product[$i];
						$pr['quantity'] = $quantity[$i];
						
						$add_product=$this->po_model->add_po_product($pr);
						if(!$add_product)
						{
							$this->session->set_flashdata('error', 'Something12 is problem please try again.');
							redirect("account/po/index");
						}
						
					}					
				}
			}			
			$this->session->set_flashdata('success', 'PO has been successfully added');
			redirect("account/po/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/po/index");
		}
		
		
	}
	

	// Going To Disable Department..
	public function disable()
	{
		$poid=$this->security->xss_clean(trim($_REQUEST['poid']));
		$ar=array('status'=>'False');
		$update=$this->po_model->update($ar,$poid);
		if($update)
		{
			$this->session->set_flashdata('success', 'PO has been successfully updated.');
			redirect("account/po/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/po/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/po/index");
	}

	//Going to enable Department...
	public function enable()
	{
		$poid=$this->security->xss_clean(trim($_REQUEST['poid']));
		$ar=array('status'=>'True');
		$update=$this->po_model->update($ar,$poid);
		if($update)
		{
			$this->session->set_flashdata('success', 'PO has been successfully enabled.');
			redirect("account/po/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/po/index");
		}
	}
	
	// View The PO..
	public function view()
	{
		$data['title']='View PO';
		$this->admin_header($data);
		$poid = $this->security->xss_clean(trim($_REQUEST['poid']));		
		$data['po'] = $this->get_po_details($poid);
		$this->load->view("account/view_po",$data);
		$this->admin_footer($data);
	}
	
	// Fetching The PO DEtails..
	public function get_po_details($poid)
	{
		return $data = $this->po_model->get_po_details($poid);
	}
	
	// Mange PO..
	public function manage()
	{
		$data['title']='Manage PO';
		$this->admin_header($data);
		
		$poid = $this->security->xss_clean(trim($_REQUEST['poid']));
		$data['vendor'] = $this->po_model->get_vendor();
		$data['products'] = $this->po_model->get_products();
		$data['tnc_data'] = $this->po_model->get_tnc();		
		$data['quotation'] = $this->po_model->get_quotation();
		$data['po'] = $this->get_po_details($poid);
		$this->load->view("account/manage_po",$data);
		$this->admin_footer($data);
	}
	
	// Going To update the PO..
	public function update_po()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		
		
		/// update the PO Product..
		$poid = $this->security->xss_clean(trim($this->input->post("poid")));
		$update_product = $this->security->xss_clean(($this->input->post("update_product")));
		$update_quantity = $this->security->xss_clean(($this->input->post("update_quantity")));
		$manage_action = $this->security->xss_clean(($this->input->post("manage_action")));
		$po_product_id = $this->security->xss_clean(($this->input->post("po_product_id")));
		
		if(sizeof($manage_action)>0 )
		{
			for($j=0; sizeof($manage_action)>$j; $j++)
			{
				if($manage_action[$j] == 'update')
				{
					$ar=array();
					$arr['product_id'] = $update_product[$j];
					$arr['quantity'] = $update_quantity[$j];
					$id = $po_product_id[$j];
					$update = $this->po_model->update_po_product($arr,$id);
					if(!$update)
					{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/po/index");
					}
				}
				else if($manage_action[$j] == 'delete')
				{
					$delete = $this->po_model->delete_po_product($po_product_id[$j]);
					if(!$delete)
					{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/po/index");
					}
				}
			}
		}
		
		// Going TO Update the PO..
		$poid = $this->security->xss_clean(trim($this->input->post("poid")));
		//$vendor_id = $this->security->xss_clean(trim($this->input->post("vendor")));
		$tnc_id = $this->security->xss_clean(trim($this->input->post("tnc")));
		$quotation_id = $this->security->xss_clean(trim($this->input->post("quotation")));
		
		$ar=array();
		$ar['poid']=$poid;
		//$ar['vendor_id'] = $vendor_id;
		$ar['tnc_id'] = $tnc_id;
		$ar['quotation_id'] = $quotation_id;		
		$ar['modify_date'] = date("Y-m-d");
		
		$update=$this->po_model->update($ar,$poid);
		if($update)
		{
			$product = $this->security->xss_clean(($this->input->post("add_product")));		
			$quantity = $this->security->xss_clean(($this->input->post("add_quantity")));
			
			if( sizeof($product)>0)
			{
				for($i=0; sizeof($product)>$i; $i++ )
				{
					if($product[$i] != '')
					{
						$pr = array();
						$pr['po_product_id'] = 0;
						$pr['po_id'] = $poid;
						$pr['product_id'] = $product[$i];
						$pr['quantity'] = $quantity[$i];
						
						$add_product=$this->po_model->add_po_product($pr);
						if(!$add_product)
						{
							$this->session->set_flashdata('error', 'Something is problem please try again.');
							redirect("account/po/index");
						}
						
					}					
				}
			}
			$this->session->set_flashdata('success', 'PO has been successfully Updated');
			redirect("account/po/index");
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/po/index");
		}
		
	}
}
?>