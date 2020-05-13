<?php
class Vendor_model extends CI_Model
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

		$this->db->select('vr.vendor_code,vr.vendor_id, vr.vendor_name, vr.vendor_email, vr.vendor_phone, vr.vendor_alternate_phone, vr.vendor_gst, vr.vendor_pan, vr.vendor_tan, vr.vendor_ciib, vr.vendor_registered_address, vr.vendor_company_address, vr.vendor_business_address, vr.date_of_established, vr.vendor_country, vr.vendor_state, vr.vendor_city, vr.vendor_pincode, vr.vendor_bank_name, vr.vendor_account_number, vr.vendor_ifsc_code, vr.vendor_bank_address, vr.contact_person_name, vr.contact_person_email, vr.add_date, vr.modify_date, vr.contact_person_mobile, vr.contact_person_alt_mobile, vr.status, country.countryName,  state.stateName');

		if(sizeof($filter)>0)
		{
			/* echo"<pre>";
			print_r($filter);
			exit('filter'); */
			
			if(isset($filter['v_code']) && $filter['v_code']!=""){
				$this->db->like('vr.vendor_code',$filter['v_code']);
			}
			if(isset($filter['v_name']) && $filter['v_name']!=""){
				$this->db->like('vr.vendor_name',$filter['v_name']);
			}
			if(isset($filter['v_email']) && $filter['v_email']!=""){
				$this->db->like('vr.vendor_email',$filter['v_email']);
			}
			if(isset($filter['v_phone']) && $filter['v_phone']!=""){
				$this->db->like('vr.vendor_phone',$filter['v_phone']);
			}
			if(isset($filter['v_alt_phone']) && $filter['v_alt_phone']!=""){
				$this->db->like('vr.vendor_alternate_phone',$filter['v_alt_phone']);
			}
			if(isset($filter['v_gst']) && $filter['v_gst']!=""){
				$this->db->like('vr.vendor_gst',$filter['v_gst']);
			}
			if(isset($filter['v_pan']) && $filter['v_pan']!=""){
				$this->db->like('vr.vendor_pan',$filter['v_pan']);
			}
			if(isset($filter['v_tan']) && $filter['v_tan']!=""){
				$this->db->like('vr.vendor_tan',$filter['v_tan']);
			}
			if(isset($filter['v_ciib']) && $filter['v_ciib']!=""){
				$this->db->like('vr.vendor_ciib',$filter['v_ciib']);
			}
			if(isset($filter['v_reg_address']) && $filter['v_reg_address']!=""){
				$this->db->like('vr.vendor_registered_address',$filter['v_reg_address']);
			}
			if(isset($filter['v_company_address']) && $filter['v_company_address']!=""){
				$this->db->like('vr.vendor_company_address',$filter['v_company_address']);
			}
			if(isset($filter['v_bussiness_address']) && $filter['v_bussiness_address']!=""){
				$this->db->like('vr.vendor_business_address',$filter['v_bussiness_address']);
			}
			if(isset($filter['v_established']) && $filter['v_established']!=""){
				$this->db->like('vr.date_of_established',$filter['v_established']);
			}
			if(isset($filter['v_country']) && $filter['v_country']!=""){
				$this->db->like('country.countryName',$filter['v_country']);
			}
			if(isset($filter['v_state']) && $filter['v_state']!=""){
				$this->db->like('state.stateName',$filter['v_state']);
			}
			if(isset($filter['v_city']) && $filter['v_city']!=""){
				$this->db->like('vr.vendor_city',$filter['v_city']);
			}
			if(isset($filter['v_pin_code']) && $filter['v_pin_code']!=""){
				$this->db->like('vr.vendor_pincode',$filter['v_pin_code']);
			}
			if(isset($filter['v_bank_name']) && $filter['v_bank_name']!=""){
				$this->db->like('vr.vendor_bank_name',$filter['v_bank_name']);
			}
			if(isset($filter['v_account_no']) && $filter['v_account_no']!=""){
				$this->db->like('vr.vendor_account_number',$filter['v_account_no']);
			}
			if(isset($filter['v_ifsc_code']) && $filter['v_ifsc_code']!=""){
				$this->db->like('vr.vendor_ifsc_code',$filter['v_ifsc_code']);
			}
			if(isset($filter['v_bank_address']) && $filter['v_bank_address']!=""){
				$this->db->like('vr.vendor_bank_address',$filter['v_bank_address']);
			}
			if(isset($filter['v_cp_name']) && $filter['v_cp_name']!=""){
				$this->db->like('vr.contact_person_name',$filter['v_cp_name']);
			}
			if(isset($filter['v_cp_email']) && $filter['v_cp_email']!=""){
				$this->db->like('vr.contact_person_email',$filter['v_cp_email']);
			}
			if(isset($filter['v_cp_phone']) && $filter['v_cp_phone']!=""){
				$this->db->like('vr.contact_person_mobile',$filter['v_cp_phone']);
			}
			if(isset($filter['v_cp_alt_phone']) && $filter['v_cp_alt_phone']!=""){
				$this->db->like('vr.contact_person_alt_mobile',$filter['v_cp_alt_phone']);
			}
			if(isset($filter['v_add_date']) && $filter['v_add_date']!=""){
				$this->db->like('vr.add_date',$filter['v_add_date']);
			}
			if(isset($filter['v_modify_date']) && $filter['v_modify_date']!=""){
				$this->db->like('vr.modify_date',$filter['v_modify_date']);
			}
			if(isset($filter['v_status']) && $filter['v_status']!=""){
				$this->db->like('vr.status',$filter['v_status']);
			}				
			
		}
		
		$this->db->order_by('vr.vendor_id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_vendors vr');
		$this->db->join("wi_countries country","country.countryID=vr.vendor_country");
		$this->db->join("wi_states state","state.stateID=vr.vendor_state");
		$re=$this->db->get();		
		$data['total'] = $this->count_total($admin['id']);
		$data['data']  = $re->result_array();
	    return $data; 
	}


	public function count_total($adminid)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('vr.vendor_id');

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
		
		$this->db->order_by('vr.vendor_id','DESC');
		$this->db->from('wi_vendors vr');
		$re=$this->db->get();
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add vendor to database...
	public function add_vendor($ar)
	{		
		$this->db->insert("wi_vendors",$ar);
		return $this->db->insert_id();
	}

	//Fetching Vendor info...
	public function vendor_info($vendor_id)
	{
		$this->db->select("*");
		$this->db->where("vendor_id", $vendor_id);
		$re=$this->db->get('wi_vendors');
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['vendor_id']=$result[0]['vendor_id'];
			$ar['vendor_name']=$result[0]['vendor_name'];
			$ar['vendor_email']=$result[0]['vendor_email'];			
			$ar['vendor_phone']=$result[0]['vendor_phone'];			
			$ar['vendor_alternate_phone']=$result[0]['vendor_alternate_phone'];			
			$ar['website_name']=$result[0]['website_name'];			
			$ar['vendor_gst']=$result[0]['vendor_gst'];			
			$ar['vendor_pan']=$result[0]['vendor_pan'];			
			$ar['vendor_tan']=$result[0]['vendor_tan'];			
			$ar['vendor_ciib']=$result[0]['vendor_ciib'];			
			$ar['vendor_registered_address']=$result[0]['vendor_registered_address'];			
			$ar['vendor_company_address']=$result[0]['vendor_company_address'];			
			$ar['vendor_business_address']=$result[0]['vendor_business_address'];			
			$ar['date_of_established']=$result[0]['date_of_established'];			
			$ar['vendor_country']=$result[0]['vendor_country'];			
			$ar['vendor_state']=$result[0]['vendor_state'];			
			$ar['vendor_city']=$result[0]['vendor_city'];			
			$ar['vendor_pincode']=$result[0]['vendor_pincode'];			
			$ar['vendor_bank_name']=$result[0]['vendor_bank_name'];			
			$ar['vendor_account_number']=$result[0]['vendor_account_number'];			
			$ar['vendor_ifsc_code']=$result[0]['vendor_ifsc_code'];			
			$ar['vendor_bank_address']=$result[0]['vendor_bank_address'];			
			 			
		}
		else
		{
			$ar['vendor_id']='';
			$ar['vendor_name']='';
			$ar['vendor_email']='';			
			$ar['vendor_phone']='';			
			$ar['vendor_alternate_phone']='';			
			$ar['vendor_gst']='';			
			$ar['vendor_pan']='';			
			$ar['vendor_tan']='';			
			$ar['vendor_ciib']='';			
			$ar['vendor_registered_address']='';			
			$ar['vendor_company_address']='';			
			$ar['vendor_business_address']='';			
			$ar['date_of_established']='';			
			$ar['vendor_country']='';			
			$ar['vendor_state']='';			
			$ar['vendor_city']='';			
			$ar['vendor_pincode']='';			
			$ar['vendor_bank_name']='';			
			$ar['vendor_account_number']='';			
			$ar['vendor_ifsc_code']='';			
			$ar['vendor_bank_address']='';			
				
		}
		return $ar;
	}

	//Going to update Department information...
	public function update($ar,$vendor_id)
	{
		$this->db->where("vendor_id",$vendor_id);
		return $this->db->update("wi_vendors",$ar);
	}
	
	//Going to update Vendor Contact information...
	public function update_vendor_contact($ar,$vendor_id, $row_id)
	{		
		$this->db->where("id",$row_id);
		$this->db->where("vendor_id",$vendor_id);
		return $this->db->update("wi_vendor_contact",$ar);
		
	}

	// Going to Add Vendor Contacts Details..
	public function add_vendor_contacts($arr)
	{
		$this->db->insert("wi_vendor_contact",$arr);
		return $this->db->insert_id();
	}
	
	// Fetching the Vendor Contact Information ..
	public function vendor_contact_info($vendor_id)
	{
		$this->db->select("*");
		$this->db->where("vendor_id", $vendor_id);
		$re=$this->db->get('wi_vendor_contact');
		return $result=$re->result_array();
	}
	
	// deleteing the Vendor Contact..
	public function delete_vendor_contact($row_id)
	{
		$this->db->where('id', $row_id);
		$this->db->delete('wi_vendor_contact');
	}
	
		
	// TO Genrate Vendor Code..
	public function generate_vendor_code()
	{
		$this->db->select_max("vendor_id");
		$re=$this->db->get('wi_vendors');
		$result=$re->result_array();
		
		return $tot = $result[0]['vendor_id']+1;
		//return $user_id = sprintf("EMP%03d", $tot)."";
		
	}
}


?>