<?php
class Vendor extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/vendor_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Vendor List';
		$data['offset'] = $offset; 
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			/* echo"<pre>";
			print_r($_POST);
			exit(); */
			
			$v_code=$this->security->xss_clean(trim($this->input->post("v_code")));
			$v_name=$this->security->xss_clean(trim($this->input->post("v_name")));
			$v_email=$this->security->xss_clean(trim($this->input->post("v_email")));
			$v_phone=$this->security->xss_clean(trim($this->input->post("v_phone")));
			$v_alt_phone=$this->security->xss_clean(trim($this->input->post("v_alt_phone")));
			$v_gst=$this->security->xss_clean(trim($this->input->post("v_gst")));
			$v_pan=$this->security->xss_clean(trim($this->input->post("v_pan")));
			$v_tan=$this->security->xss_clean(trim($this->input->post("v_tan")));
			$v_ciib=$this->security->xss_clean(trim($this->input->post("v_ciib")));
			$v_reg_address=$this->security->xss_clean(trim($this->input->post("v_reg_address")));
			$v_company_address=$this->security->xss_clean(trim($this->input->post("v_company_address")));
			$v_bussiness_address=$this->security->xss_clean(trim($this->input->post("v_bussiness_address")));
			$v_established=$this->security->xss_clean(trim($this->input->post("v_established")));
			$v_country=$this->security->xss_clean(trim($this->input->post("v_country")));
			$v_state=$this->security->xss_clean(trim($this->input->post("v_state")));
			$v_city=$this->security->xss_clean(trim($this->input->post("v_city")));
			$v_pin_code=$this->security->xss_clean(trim($this->input->post("v_pin_code")));
			$v_bank_name=$this->security->xss_clean(trim($this->input->post("v_bank_name")));
			$v_account_no=$this->security->xss_clean(trim($this->input->post("v_account_no")));
			$v_ifsc_code=$this->security->xss_clean(trim($this->input->post("v_ifsc_code")));
			$v_bank_address=$this->security->xss_clean(trim($this->input->post("v_bank_address")));
			$v_cp_name=$this->security->xss_clean(trim($this->input->post("v_cp_name")));
			$v_cp_email=$this->security->xss_clean(trim($this->input->post("v_cp_email")));
			$v_cp_phone=$this->security->xss_clean(trim($this->input->post("v_cp_phone")));
			$v_cp_alt_phone=$this->security->xss_clean(trim($this->input->post("v_cp_alt_phone")));
			$v_add_date=$this->security->xss_clean(trim($this->input->post("v_add_date")));
			$v_modify_date=$this->security->xss_clean(trim($this->input->post("v_modify_date")));
			$v_status=$this->security->xss_clean(trim($this->input->post("v_status")));
			
			$filter['v_code']=$v_code;
			$filter['v_name']=$v_name;
			$filter['v_email']=$v_email;
			$filter['v_phone']=$v_phone;
			$filter['v_alt_phone']=$v_alt_phone;
			$filter['v_gst']=$v_gst;
			$filter['v_pan']=$v_pan;
			$filter['v_tan']=$v_tan;
			$filter['v_ciib']=$v_ciib;
			$filter['v_reg_address']=$v_reg_address;
			$filter['v_company_address']=$v_company_address;
			$filter['v_bussiness_address']=$v_bussiness_address;
			$filter['v_established']=$v_established;
			$filter['v_country']=$v_country;
			$filter['v_state']=$v_state;
			$filter['v_city']=$v_city;
			$filter['v_pin_code']=$v_pin_code;
			$filter['v_bank_name']=$v_bank_name;
			$filter['v_account_no']=$v_account_no;
			$filter['v_ifsc_code']=$v_ifsc_code;
			$filter['v_bank_address']=$v_bank_address;
			$filter['v_cp_name']=$v_cp_name;
			$filter['v_cp_email']=$v_cp_email;
			$filter['v_cp_phone']=$v_cp_phone;
			$filter['v_cp_alt_phone']=$v_cp_alt_phone;
			$filter['v_add_date']= $v_add_date;
			$filter['v_modify_date']= $v_modify_date;
			$filter['v_status']=$v_status;
			
			if($v_add_date!=='')
			{
				$filter['v_add_date']=date("Y-m-d", strtotime($v_add_date));
			}else{
				$filter['v_add_date']='';
			}
			if($v_modify_date!=='')
			{
				$filter['v_modify_date']=date("Y-m-d", strtotime($v_modify_date));
			}else{
				$filter['v_modify_date']='';
			}
			
			
			$this->session->set_userdata("search",$filter);
		}
		
		$show_per_page = 50;
		$data_arr  	   = $this->vendor_model->index($offset, $show_per_page);
		
		$data['vendor'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/vendor/index');
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
		
		$this->load->view("account/vendor_list",$data);
		$this->admin_footer($data);
	}

	//Going to add vendor...
	public function add_vendor()
	{
		$country=$this->master_model->get_country();
		$data['title']='Add Vendor';
		$data['country']=$country;
		$this->admin_header($data);
		$this->load->view("account/add_vendor",$data);
		$this->admin_footer($data);
	}


	//Going to add Vendor...
	public function add()
	{
		/* echo"<pre>";
		print_r($_POST);
		//print_r($_FILES);
		exit(); */
		
		if($_FILES['gst_file']['name']!="")
		{
			$image = $_FILES['gst_file']['name'];
			$tempname = $_FILES['gst_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/gst/$image");
		}
		if($_FILES['pan_file']['name']!="")
		{
			$image = $_FILES['pan_file']['name'];
			$tempname = $_FILES['pan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/pan/$image");
		}
		if($_FILES['tan_file']['name']!="")
		{
			$image = $_FILES['tan_file']['name'];
			$tempname = $_FILES['tan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/tan/$image");
		}
		if($_FILES['aadhar_file']['name']!="")
		{
			$image = $_FILES['aadhar_file']['name'];
			$tempname = $_FILES['aadhar_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/aadhar/$image");
		}
		
		
		/* if($_FILES['gst_file']['name']!="")
		{
			$file=$_FILES['gst_file']['name'];
			$extension=pathinfo($file,PATHINFO_EXTENSION);			
			$image_name='1'."gst_file.".$extension;			
			
			$config['file_name'] = $image_name;
			$config['upload_path'] = './uploads/gst/';
			//$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '10332330';
			$config['max_width']  = '102334';
			$config['max_height']  = '763338';
		
			$this->load->library('upload',$config);
				
			if (! $this->upload->do_upload('gst_file'))
			{
				exit('cfdfdg');
				
				$this->session->set_flashdata('error', 'Please check your image type image type should be jif,jpg,png');
				redirect("account/vendor/profile");
			}
			
		} */	
		
				
		$vendor_name = $this->security->xss_clean(trim($this->input->post("vendor_name")));
		$vendor_email= $this->security->xss_clean(trim($this->input->post("vendor_email")));		
		$vendor_phone= $this->security->xss_clean(trim($this->input->post("vendor_phone")));		
		$vendor_alt_phone= $this->security->xss_clean(trim($this->input->post("vendor_alt_phone")));		
		$website_name= $this->security->xss_clean(trim($this->input->post("website_name")));		
		$vendor_gst= $this->security->xss_clean(trim($this->input->post("vendor_gst")));		
		$vendor_pan= $this->security->xss_clean(trim($this->input->post("vendor_pan")));		
		$vendor_tan= $this->security->xss_clean(trim($this->input->post("vendor_tan")));		
		$vendor_ciib= $this->security->xss_clean(trim($this->input->post("vendor_ciib")));		
		$registered_address= $this->security->xss_clean(trim($this->input->post("registered_address")));		
		$company_address= $this->security->xss_clean(trim($this->input->post("company_address")));
		$bussiness_address= $this->security->xss_clean(trim($this->input->post("bussiness_address")));
		$stablished_date= $this->security->xss_clean(trim($this->input->post("stablished_date")));
		$country= $this->security->xss_clean(trim($this->input->post("country")));
		$state= $this->security->xss_clean(trim($this->input->post("state")));
		$city= $this->security->xss_clean(trim($this->input->post("city")));
		$pin_code= $this->security->xss_clean(trim($this->input->post("pin_code")));
		$bank_name= $this->security->xss_clean(trim($this->input->post("bank_name")));
		$account_number= $this->security->xss_clean(trim($this->input->post("account_number")));
		$ifsc_code= $this->security->xss_clean(trim($this->input->post("ifsc_code")));
		$bank_address= $this->security->xss_clean(trim($this->input->post("bank_address")));
		$contact_person_name= $this->security->xss_clean(($this->input->post("contact_person_name")));
		$contact_person_email= $this->security->xss_clean(($this->input->post("contact_person_email")));
		$contact_person_phone= $this->security->xss_clean(($this->input->post("contact_person_phone")));
		$contact_person_alt_phone= $this->security->xss_clean(($this->input->post("contact_person_alt_phone")));
		
		$last_id  = $this->vendor_model->generate_vendor_code();
		$vendor_code = sprintf("VEN%05d", $last_id)."";
		
		$ar=array();
		$ar['vendor_id']=0;
		$ar['vendor_code'] = $vendor_code;
		$ar['vendor_name'] = $vendor_name;
		$ar['vendor_email'] = $vendor_email;
		$ar['vendor_phone'] = $vendor_phone;
		$ar['vendor_alternate_phone'] = $vendor_alt_phone;
		$ar['website_name'] = $website_name;
		$ar['vendor_gst'] = $vendor_gst;
		$ar['vendor_pan'] = $vendor_pan;
		$ar['vendor_tan'] = $vendor_tan;
		$ar['vendor_ciib'] = $vendor_ciib;
		$ar['vendor_registered_address'] = $registered_address;
		$ar['vendor_company_address'] = $company_address;
		$ar['vendor_business_address'] = $bussiness_address;
		$ar['date_of_established'] = date('Y-m-d',strtotime($stablished_date));
		$ar['vendor_country'] = $country;
		$ar['vendor_state'] = $state;
		$ar['vendor_city'] = $city;
		$ar['vendor_pincode'] = $pin_code;
		$ar['vendor_bank_name'] = $bank_name;
		$ar['vendor_account_number'] = $account_number;
		$ar['vendor_ifsc_code'] = $ifsc_code;
		$ar['vendor_bank_address'] = $bank_address;
		/* $ar['contact_person_name'] = $contact_person_name;
		$ar['contact_person_email'] = $contact_person_email;
		$ar['contact_person_mobile'] = $contact_person_phone;
		$ar['contact_person_alt_mobile'] = $contact_person_alt_phone; */
		
		$ar['add_date'] 		= date("Y-m-d");
		$ar['status'] 			= 'True';
		
		$add=$this->vendor_model->add_vendor($ar);
		if($add)
		{
			$arr = array();
			for($j=0; sizeof($contact_person_name)>$j; $j++)
			{
				if($contact_person_name[$j] != '')
				{
					$arr['id'] = 0;
					$arr['vendor_id'] = $add;
					$arr['name'] = $contact_person_name[$j];
					$arr['email'] = $contact_person_email[$j];
					$arr['phone'] = $contact_person_phone[$j];
					$arr['alt_phone'] = $contact_person_alt_phone[$j];
										
					$add_contact=$this->vendor_model->add_vendor_contacts($arr);
					if($add_contact){
						
					}else{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/vendor/index");
					}
				}				
				
			}
			$this->session->set_flashdata('success', 'Vendor has been successfully added');
			redirect("account/vendor/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/vendor/index");
		}
	}
	
	//Going to manage Vendor...
	public function manage()
	{
		$vendor_id=$this->security->xss_clean(trim($_REQUEST['vendor_id']));
		$country=$this->master_model->get_country();
		$data['title']='Manage Vendor';
		$this->admin_header($data);
		
		$info = $this->vendor_model->vendor_info($vendor_id);
		$contact = $this->vendor_model->vendor_contact_info($vendor_id);
		
		if($info['vendor_country']){
			$state_list=$this->master_model->get_state($info['vendor_country']);
		}
		
		$data['info']=$info;
		$data['contact']=$contact;
		$data['country']=$country;
		$data['state_list']=$state_list;
		$this->load->view("account/manage_vendor_info",$data);
		$this->admin_footer($data);
	}

	public function update_vendor()
	{
		
		if($_FILES['gst_file']['name']!="")
		{
			$image = $_FILES['gst_file']['name'];
			$tempname = $_FILES['gst_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/gst/$image");
		}
		if($_FILES['pan_file']['name']!="")
		{
			$image = $_FILES['pan_file']['name'];
			$tempname = $_FILES['pan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/pan/$image");
		}
		if($_FILES['tan_file']['name']!="")
		{
			$image = $_FILES['tan_file']['name'];
			$tempname = $_FILES['tan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/tan/$image");
		}
		if($_FILES['aadhar_file']['name']!="")
		{
			$image = $_FILES['aadhar_file']['name'];
			$tempname = $_FILES['aadhar_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/aadhar/$image");
		}
		
		$vendor_id = $this->security->xss_clean(trim($this->input->post("vendor_id")));
		$vendor_name = $this->security->xss_clean(trim($this->input->post("vendor_name")));
		$vendor_email= $this->security->xss_clean(trim($this->input->post("vendor_email")));		
		$vendor_phone= $this->security->xss_clean(trim($this->input->post("vendor_phone")));		
		$vendor_alt_phone= $this->security->xss_clean(trim($this->input->post("vendor_alt_phone")));		
		$vendor_gst= $this->security->xss_clean(trim($this->input->post("vendor_gst")));		
		$vendor_pan= $this->security->xss_clean(trim($this->input->post("vendor_pan")));		
		$vendor_tan= $this->security->xss_clean(trim($this->input->post("vendor_tan")));		
		$vendor_ciib= $this->security->xss_clean(trim($this->input->post("vendor_ciib")));		
		$registered_address= $this->security->xss_clean(trim($this->input->post("registered_address")));		
		$company_address= $this->security->xss_clean(trim($this->input->post("company_address")));
		$bussiness_address= $this->security->xss_clean(trim($this->input->post("bussiness_address")));
		$stablished_date= $this->security->xss_clean(trim($this->input->post("stablished_date")));
		$country= $this->security->xss_clean(trim($this->input->post("country")));
		$state= $this->security->xss_clean(trim($this->input->post("state")));
		$city= $this->security->xss_clean(trim($this->input->post("city")));
		$pin_code= $this->security->xss_clean(trim($this->input->post("pin_code")));
		$bank_name= $this->security->xss_clean(trim($this->input->post("bank_name")));
		$account_number= $this->security->xss_clean(trim($this->input->post("account_number")));
		$ifsc_code= $this->security->xss_clean(trim($this->input->post("ifsc_code")));
		$bank_address= $this->security->xss_clean(trim($this->input->post("bank_address")));
		$contact_person_name= $this->security->xss_clean(($this->input->post("contact_person_name")));
		$contact_person_email= $this->security->xss_clean(($this->input->post("contact_person_email")));
		$contact_person_phone= $this->security->xss_clean(($this->input->post("contact_person_phone")));
		$contact_person_alt_phone= $this->security->xss_clean(($this->input->post("contact_person_alt_phone")));
		
		$ar=array();
		$ar['vendor_name'] = $vendor_name;
		$ar['vendor_email'] = $vendor_email;
		$ar['vendor_phone'] = $vendor_phone;
		$ar['vendor_alternate_phone'] = $vendor_alt_phone;
		$ar['vendor_gst'] = $vendor_gst;
		$ar['vendor_pan'] = $vendor_pan;
		$ar['vendor_tan'] = $vendor_tan;
		$ar['vendor_ciib'] = $vendor_ciib;
		$ar['vendor_registered_address'] = $registered_address;
		$ar['vendor_company_address'] = $company_address;
		$ar['vendor_business_address'] = $bussiness_address;
		$ar['date_of_established'] = date('Y-m-d',strtotime($stablished_date));
		$ar['vendor_country'] = $country;
		$ar['vendor_state'] = $state;
		$ar['vendor_city'] = $city;
		$ar['vendor_pincode'] = $pin_code;
		$ar['vendor_bank_name'] = $bank_name;
		$ar['vendor_account_number'] = $account_number;
		$ar['vendor_ifsc_code'] = $ifsc_code;
		$ar['vendor_bank_address'] = $bank_address;
		/* $ar['contact_person_name'] = $contact_person_name;
		$ar['contact_person_email'] = $contact_person_email;
		$ar['contact_person_mobile'] = $contact_person_phone;
		$ar['contact_person_alt_mobile'] = $contact_person_alt_phone; */
		$ar['modify_date']=date("Y-m-d");
		
		$update=$this->vendor_model->update($ar,$vendor_id);
		if($update)
		{
			$arr = array();
			for($j=0; sizeof($contact_person_name)>$j; $j++)
			{
				if($contact_person_name[$j] != '')
				{
					$arr['id'] = 0;
					$arr['vendor_id'] = $vendor_id;
					$arr['name'] = $contact_person_name[$j];
					$arr['email'] = $contact_person_email[$j];
					$arr['phone'] = $contact_person_phone[$j];
					$arr['alt_phone'] = $contact_person_alt_phone[$j];
					/* echo"<pre>";
					print_r($arr);
					exit(); */
					$add_contact=$this->vendor_model->add_vendor_contacts($arr);
					if($add_contact){
						
					}else{
						$this->session->set_flashdata('error', 'Something is problem please try again.');
						redirect("account/vendor/index");
					}
				}				
				
			}
			
			$this->session->set_flashdata('success', 'Vendor information has been successfully updated.');
			redirect("account/vendor/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/vendor/index");
		}
	}

	public function disable()
	{
		$vendor_id=$this->security->xss_clean(trim($_REQUEST['vendor_id']));

		$ar=array('status'=>'False');
		$update=$this->vendor_model->update($ar,$vendor_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Vendor has been successfully updated.');
			redirect("account/vendor/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/vendor/index");
		}
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/vendor/index");
	}

	//Going to enable Vendor...
	public function enable()
	{
		$vendor_id = $this->security->xss_clean(trim($_REQUEST['vendor_id']));
		$ar=array('status'=>'True');
		$update=$this->vendor_model->update($ar,$vendor_id);
		if($update)
		{
			$this->session->set_flashdata('success', 'Vendor has been successfully enabled.');
			redirect("account/vendor/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/vendor/index");
		}
	}
	
	// update Vendor Contacts..
	public function update_vendor_contact()
	{
		$row_id = $this->security->xss_clean(trim($this->input->post("row_id")));
		$vendor_id = $this->security->xss_clean(trim($this->input->post("vendor_id")));
		$name = $this->security->xss_clean(trim($this->input->post("name")));
		$phone = $this->security->xss_clean(trim($this->input->post("phone")));
		$email = $this->security->xss_clean(trim($this->input->post("email")));
		$alt_phone = $this->security->xss_clean(trim($this->input->post("alt_phone")));
		$ar = array();
		
		$ar['name'] = $name;
		$ar['phone'] = $phone;
		$ar['email'] = $email;
		$ar['alt_phone'] = $alt_phone;
		
		$update=$this->vendor_model->update_vendor_contact($ar,$vendor_id,$row_id);
	}
	
	// for remove the Customer Contact..
	public function remove_vendor_contact()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		if($row_id!='')
		{
			echo $delete = $this->vendor_model->delete_vendor_contact($row_id);
		}
	}
}
?>