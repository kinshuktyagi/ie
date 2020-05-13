<?php
class Customer extends MY_Controller
{ 
	public function __construct()
	{
		parent::__construct();
		$this->load->model("account/customer_model");
	}
	
	public function index($offset=0)
	{
		$data['title']='Customer List';
		$data['offset'] = $offset;
		$this->admin_header($data);		
		$filter=array();
		if($this->input->post("search"))
		{
			$cu_code=$this->security->xss_clean(trim($this->input->post("cu_code")));
			$cu_name=$this->security->xss_clean(trim($this->input->post("cu_name")));
			$cu_phone=$this->security->xss_clean(trim($this->input->post("cu_phone")));
			$cu_email=$this->security->xss_clean(trim($this->input->post("cu_email")));
			$cu_city=$this->security->xss_clean(trim($this->input->post("cu_city")));
			$cu_status=$this->security->xss_clean(trim($this->input->post("cu_status")));
			
			$filter['cu_code']=$cu_code;
			$filter['cu_name']=$cu_name;
			$filter['cu_phone']=$cu_phone;
			$filter['cu_email']=$cu_email;
			$filter['cu_city']=$cu_city;
			$filter['cu_status']=$cu_status;
			
			$this->session->set_userdata("search",$filter);
		}
	
		$show_per_page =50;
		$data_arr =	$this->customer_model->index($offset, $show_per_page);		
		$user_type=$this->master_model->get_user_type();
		
		$data['user'] = $data_arr['data'];
		$config['base_url'] 	 = base_url('account/customer/index');
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
		$data['user_type'] =  $user_type;
		
		$this->load->view("account/customer_list",$data);
		$this->admin_footer($data);
	}
	
	//Going to reset filter...
	public function reset_filter()
	{
		$this->session->unset_userdata("search");
		redirect("account/customer/index");
	}
	 
	//Going to add user...
	public function add_customer()
	{		
		$data['title']='Add Customer';
		$this->admin_header($data);
		$country=$this->master_model->get_country();
		$industry=$this->customer_model->get_industry();
		$data['industry']=$industry;
		$data['country']=$country;
		$this->load->view("account/add_customer",$data);
		$this->admin_footer($data);
	}
	
	//Fetching country list...
	public function get_country()
	{
		$country=$this->security->xss_clean(trim($this->input->post("country")));
		
		$state_list=$this->master_model->get_state($country);
		echo'<option selected disabled value="">Select State</option>';
		if(sizeof($state_list)>0)
		{
			for($i=0;$i<sizeof($state_list);$i++)
			{
				?>
					<option value="<?php echo $state_list[$i]['stateID']; ?>"><?php echo $state_list[$i]['stateName']; ?></option>
				<?php
			}
		} 
	}

	//Fetching country list...
	public function check_mobile()
	{		
		$mobile=$this->security->xss_clean(trim($this->input->post("mobile")));
		
		$user_info=$this->customer_model->check_user_phone($mobile);
		if(sizeof($user_info)>0)
		{
			echo'False';
		}
		else
		{
			echo'True';
		}
	}
	
	//Going to add Customer...
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
			move_uploaded_file($tempname, "uploads/customer/gst/$image");
		}
		if($_FILES['pan_file']['name']!="")
		{
			$image = $_FILES['pan_file']['name'];
			$tempname = $_FILES['pan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/pan/$image");
		}
		if($_FILES['tan_file']['name']!="")
		{
			$image = $_FILES['tan_file']['name'];
			$tempname = $_FILES['tan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/tan/$image");
		}
		if($_FILES['aadhar_file']['name']!="")
		{
			$image = $_FILES['aadhar_file']['name'];
			$tempname = $_FILES['aadhar_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/aadhar/$image");
		}
		
		$industry_type = $this->security->xss_clean(trim($this->input->post("industry_type")));
		$name = $this->security->xss_clean(trim($this->input->post("name")));
		$mobile = $this->security->xss_clean(trim($this->input->post("mobile")));
		$email = $this->security->xss_clean(trim($this->input->post("email")));
		$country = $this->security->xss_clean(trim($this->input->post("country")));
		$state = $this->security->xss_clean(trim($this->input->post("state")));
		$city = $this->security->xss_clean(trim($this->input->post("city")));
		$pincode = $this->security->xss_clean(trim($this->input->post("pincode")));
		$address = $this->security->xss_clean(trim($this->input->post("address")));
		$gst = $this->security->xss_clean(trim($this->input->post("gst")));
		$pan = $this->security->xss_clean(trim($this->input->post("pan")));
		$tan = $this->security->xss_clean(trim($this->input->post("tan")));
		$aadhar = $this->security->xss_clean(trim($this->input->post("aadhar")));
		
		$contact_person_name = $this->security->xss_clean(($this->input->post("contact_person_name")));		
		$contact_person_email = $this->security->xss_clean(($this->input->post("contact_person_email")));$contact_person_phone = $this->security->xss_clean(($this->input->post("contact_person_phone")));
		
		$last_id  = $this->customer_model->get_last_customer_id();		
		if($last_id[0]['cust_id']=='')
		{
			$last_id[0]['cust_id']=1;
		}
		$cust_code = substr($name,0,3).substr($city,0,3).($last_id[0]['cust_id'] +1);
		
		$ar=array();
		$ar['cust_id']=0;
		$ar['cust_code']=$cust_code;
		$ar['industry_type']=$industry_type;
		$ar['name']=$name;
		$ar['phone']=$mobile;
		$ar['email']=$email;
		$ar['country']=$country;
		$ar['state']=$state;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['pincode']=$pincode;
		$ar['gst']=$gst;
		$ar['pan']=$pan;
		$ar['tan']=$tan;
		$ar['aadhar']=$aadhar;	
		$ar['add_date']=date("Y-m-d");
		$ar['status']='True';
		 
		
		$add=$this->customer_model->add_customer($ar);
		if($add)
		{
			if(sizeof($contact_person_name) > 0)
			{
				for($l=0; sizeof($contact_person_name)>$l; $l++)
				{
					$arr = array();
					$arr['id'] = 0;
					$arr['cust_id'] = $add;
					$arr['name'] = $contact_person_name[$l];
					$arr['phone'] = $contact_person_phone[$l];
					$arr['email'] = $contact_person_email[$l];
					
					if($arr['name'] != '')
					{
						$add_contact =$this->customer_model->add_customer_contact($arr);
						if($add_contact){
							
						}else{
							$this->session->set_flashdata('error', 'Something is problem please try again.');
							redirect("account/cutomer/index");
						}
					}
					
				}
			}			
			
			$this->session->set_flashdata('success', 'Customer has been successfully added');
			redirect("account/customer/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/customer/index");
		}
	}
	
	//Going to disable user...
	public function disable()
	{
		$customer=$this->security->xss_clean(trim($_REQUEST['customer']));
		$ar=array('status'=>'False');
		$update=$this->customer_model->update($ar,$customer);
		if($update)
		{
			$this->session->set_flashdata('success', 'Customer has been successfully updated.');
			redirect("account/customer/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/customer/index");
		}
	}

	//Going to enable user...
	public function enable()
	{
		$customer=$this->security->xss_clean(trim($_REQUEST['customer']));
		$ar=array('status'=>'True');
		$update=$this->customer_model->update($ar,$customer);
		if($update)
		{
			$this->session->set_flashdata('success', 'Customer has been successfully enabled.');
			redirect("account/customer/index");
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/customer/index");
		}
	}
	
	
	//Going to manage employee...
	public function manage()
	{		
		$customer_id=$this->security->xss_clean(trim($_REQUEST['customer']));		
		$data['title']='Manage Customer';
		$this->admin_header($data);
		$country=$this->master_model->get_country();		
		$info=$this->customer_model->customer_info($customer_id);
		$contact_info=$this->customer_model->customer_contact_info($customer_id);
		
		$state_list=array();
		if($info['country']){
			$state_list=$this->master_model->get_state($info['country']);
		}
		
		$industry=$this->customer_model->get_industry();
		$data['industry']=$industry;
		
		$data['country']=$country;
		$data['state_list']=$state_list;
		$data['info']=$info;
		$data['contact']=$contact_info;
		$this->load->view("account/manage_customer_info",$data);
		$this->admin_footer($data);
	}
		
	//Going to update user...
	public function update_customer()
	{
		/* echo"<pre>";
		print_r($_POST);
		exit(); */
		
		$customer_id=$this->security->xss_clean(trim($this->input->post("cust_id")));
		
		$industry_type = $this->security->xss_clean(trim($this->input->post("industry_type")));		
		$name = $this->security->xss_clean(trim($this->input->post("name")));
		$mobile = $this->security->xss_clean(trim($this->input->post("mobile")));
		$email = $this->security->xss_clean(trim($this->input->post("email")));
		$country = $this->security->xss_clean(trim($this->input->post("country")));
		$state = $this->security->xss_clean(trim($this->input->post("state")));
		$city = $this->security->xss_clean(trim($this->input->post("city")));
		$pincode = $this->security->xss_clean(trim($this->input->post("pincode")));
		$address = $this->security->xss_clean(trim($this->input->post("address")));
		$gst = $this->security->xss_clean(trim($this->input->post("gst")));
		$pan = $this->security->xss_clean(trim($this->input->post("pan")));
		$tan = $this->security->xss_clean(trim($this->input->post("tan")));
		$aadhar = $this->security->xss_clean(trim($this->input->post("aadhar")));
		
		$contact_person_name = $this->security->xss_clean(($this->input->post("contact_person_name")));		
		$contact_person_email = $this->security->xss_clean(($this->input->post("contact_person_email")));		
		$contact_person_phone = $this->security->xss_clean(($this->input->post("contact_person_phone")));		
		
		if($_FILES['gst_file']['name']!="")
		{
			$image = $_FILES['gst_file']['name'];
			$tempname = $_FILES['gst_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/gst/$image");
		}
		if($_FILES['pan_file']['name']!="")
		{
			$image = $_FILES['pan_file']['name'];
			$tempname = $_FILES['pan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/pan/$image");
		}
		if($_FILES['tan_file']['name']!="")
		{
			$image = $_FILES['tan_file']['name'];
			$tempname = $_FILES['tan_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/tan/$image");
		}
		if($_FILES['aadhar_file']['name']!="")
		{
			$image = $_FILES['aadhar_file']['name'];
			$tempname = $_FILES['aadhar_file']['tmp_name'];
			move_uploaded_file($tempname, "uploads/customer/aadhar/$image");
		}
		
		$ar=array();
		//$ar['cust_id']=0;
		$ar['industry_type']=$industry_type;
		$ar['name']=$name;
		$ar['phone']=$mobile;
		$ar['email']=$email;
		$ar['country']=$country;
		$ar['state']=$state;
		$ar['city']=$city;
		$ar['address']=$address;
		$ar['pincode']=$pincode;
		$ar['gst']=$gst;
		$ar['pan']=$pan;
		$ar['tan']=$tan;
		$ar['aadhar']=$aadhar;	
		$ar['modify_date']=date("Y-m-d");
		$ar['status']='True';
		
		$add=$this->customer_model->update($ar, $customer_id);
		if($add)
		{
			/* if($contact_person_name[0] =='' && $contact_person_name[1] =='' && $contact_person_name[2]=='' && $contact_person_name[3]=='' && $contact_person_name[4]=='')
			{
				$this->session->set_flashdata('success', 'Customer has been successfully Updated');
				redirect("account/customer/index");
			}
			else
			{ */
				if(sizeof($contact_person_name) > 0)
				{
					for($l=0; sizeof($contact_person_name)>$l; $l++)
					{ 
						//exit('test1');
						$arr = array();
						$arr['id'] = 0;
						$arr['cust_id'] = $customer_id;
						$arr['name'] = $contact_person_name[$l];
						$arr['phone'] = $contact_person_phone[$l];
						$arr['email'] = $contact_person_email[$l];
												
						if($arr['name'] != '')
						{
							$add_contact =$this->customer_model->add_customer_contact($arr);
							if($add_contact){
								
							}else{
								$this->session->set_flashdata('error', 'Something is problem please try again.');
								redirect("account/cutomer/index");
							}
						}
						
					}
				}
			
				$this->session->set_flashdata('success', 'Customer has been successfully Updated');
				redirect("account/customer/index");
			//}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Something is problem please try again.');
			redirect("account/customer/index");
		}
	}


		

	
	




	


	
	// for remove the Customer Contact..
	public function remove_customer_contact()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		if($row_id!='')
		{
			echo $delete = $this->customer_model->delete_customer_contact($row_id);
		}
	}
	
	// for update the Customer Contact..
	public function update_customer_contact()
	{
		$row_id = $this->security->xss_clean(($this->input->post("row_id")));
		$name = $this->security->xss_clean(($this->input->post("name")));
		$email = $this->security->xss_clean(($this->input->post("email")));
		$phone = $this->security->xss_clean(($this->input->post("phone")));
		$cust_id = $this->security->xss_clean(($this->input->post("cust_id")));
		if($row_id!='')
		{
			echo $update = $this->customer_model->update_customer_contact($row_id, $name, $email, $phone, $cust_id);
		}
	}
}
?>