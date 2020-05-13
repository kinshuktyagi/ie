<?php
class master_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("master_model");
	}
	
	
	public function get_sub_category()
	{
		$category=$this->security->xss_clean($this->input->post("category"));
		
		$sub_category=$this->master_model->get_sub_category($category);
		echo'<option selected  value="">Select Sub Category</option>';
		if(sizeof($sub_category)>0)
		{
			for($i=0;$i<sizeof($sub_category);$i++)
			{
				?>
					<option value="<?php echo $sub_category[$i]['category_id']; ?>"><?php echo $sub_category[$i]['name']; ?></option>
				<?php
			}
		}
	}
	
	
	public function get_state()
	{
		$country=$this->security->xss_clean($this->input->post("country"));
		
		$state=$this->master_model->get_state($country);
		echo'<option selected disabled value="">Select State</option>';
		if(sizeof($state)>0)
		{
			for($i=0;$i<sizeof($state);$i++)
			{
				?>
					<option value="<?php echo $state[$i]['stateID']; ?>"><?php echo $state[$i]['stateName']; ?></option>
				<?php
			}
		}
	}
}

?>