<?php
class my_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function admin_header($data)
	{
		$this->load->view("account/master/js.php",$data);
		$this->load->view("account/master/header.php",$data);
	}
	public function admin_footer($data)
	{
		$this->load->view("account/master/footer.php",$data);
	}
	
	
	

}
?>