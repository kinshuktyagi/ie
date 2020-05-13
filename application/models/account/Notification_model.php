<?php
class Notification_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//Fetching Notification detail from database...
	public function index($offset=0, $limit)
	{
		$filter=$this->session->userdata("search");
		$admin=$this->session->userdata("admin");

		$this->db->select('notcn.id, notcn.notification_name, notcn.description, notcn.status, notcn.add_date, notcn.modify_date, notcn.end_date, u_type.user_type, notcn.email_send, dep.department_name');

		if(sizeof($filter)>0)
		{			
			if(isset($filter['ntc_department']) && $filter['ntc_department']!="")
			{
				$this->db->like('dep.department_name',$filter['ntc_department']);
			}
			if(isset($filter['ntc_user_type']) && $filter['ntc_user_type']!="")
			{
				$this->db->like('u_type.user_type',$filter['ntc_user_type']);
			}
			if(isset($filter['ntc_name']) && $filter['ntc_name']!="")
			{
				$this->db->like('notcn.notification_name',$filter['ntc_name']);
			}
			if(isset($filter['ntc_end_date']) && $filter['ntc_end_date']!="")
			{
				$this->db->like('notcn.end_date',$filter['ntc_end_date']);
			}
			if(($filter['ntc_description']) && $filter['ntc_description']!="")
			{
				$this->db->like('notcn.description',$filter['ntc_description']);
			}
			if(isset($filter['ntc_status']) && $filter['ntc_status']!="")
			{
				$this->db->like('notcn.status',$filter['ntc_status']);
			}
			if(isset($filter['ntc_email']) && $filter['ntc_email']!="")
			{
				$this->db->like('notcn.email_send',$filter['ntc_email']);
			}				
			
		}
		
		$this->db->order_by('notcn.id','DESC');
		$this->db->limit($limit, $offset);
		$this->db->from('wi_notification notcn');
		$this->db->join('wi_user_type u_type','notcn.user_type=u_type.id');
		$this->db->join('wi_department dep','notcn.department_id=dep.id');
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

		$this->db->select('notcn.id');

		if(sizeof($filter)>0)
		{
			if(isset($filter['ntc_department']) && $filter['ntc_department']!="")
			{
				$this->db->like('dep.department_name',$filter['ntc_department']);
			}
			if(isset($filter['ntc_user_type']) && $filter['ntc_user_type']!="")
			{
				$this->db->like('u_type.user_type',$filter['ntc_user_type']);
			}
			if(isset($filter['ntc_name']) && $filter['ntc_name']!="")
			{
				$this->db->like('notcn.notification_name',$filter['ntc_name']);
			}
			if(isset($filter['ntc_end_date']) && $filter['ntc_end_date']!="")
			{
				$this->db->like('notcn.end_date',$filter['ntc_end_date']);
			}
			if(($filter['ntc_description']) && $filter['ntc_description']!="")
			{
				$this->db->like('notcn.description',$filter['ntc_description']);
			}
			if(isset($filter['ntc_status']) && $filter['ntc_status']!="")
			{
				$this->db->like('notcn.status',$filter['ntc_status']);
			}
			if(isset($filter['ntc_email']) && $filter['ntc_email']!="")
			{
				$this->db->like('notcn.email_send',$filter['ntc_email']);
			}				
			
		}
		
		$this->db->order_by('notcn.id','DESC');
		$this->db->from('wi_notification notcn');
		$this->db->join('wi_user_type u_type','notcn.user_type=u_type.id');
		$this->db->join('wi_department dep','notcn.department_id=dep.id');
		$re=$this->db->get();
		
		$result= $re->result_array();
	    return sizeof($result);

	}


	//Going to add Notification to database...
	public function add_notification($ar)
	{		
		$this->db->insert("wi_notification",$ar);
		return $this->db->insert_id();
	}

	//Fetching Notification info...
	public function notification_info($noticn_id)
	{
		$this->db->select("id, user_type, notification_name, description, end_date, email_send, department_id");
		$this->db->where("id",$noticn_id);
		$this->db->from('wi_notification');
		$re=$this->db->get();
		$result=$re->result_array();

		$ar=array();
		if(sizeof($result)>0)
		{
			$ar['id']=$result[0]['id'];
			$ar['user_type']=$result[0]['user_type'];
			$ar['notification_name']=$result[0]['notification_name'];			
			$ar['description']=$result[0]['description'];			
			$ar['end_date']=$result[0]['end_date'];			
			$ar['email_send']=$result[0]['email_send'];			
			$ar['department_id']=$result[0]['department_id'];			
		}
		else
		{
			$ar['id']='';
			$ar['user_type']='';
			$ar['notification_name']='';			
			$ar['description']='';			
			$ar['end_date']='';			
			$ar['email_send']='';
			$ar['department_id']='';
		}
		return $ar;
	}

	//Going to update Notification information...
	public function update($ar,$noticn_id)
	{
		$this->db->where("id",$noticn_id);
		return $this->db->update("wi_notification",$ar);
	}


}


?>