<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_library
{
	public function encrypt($q)
    {
        /*$cryptKey='qJB0rGtIn5UB1xG03efyCp';
		$qEncoded=base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );*/
		$qEncoded=md5($q);
		return $qEncoded;
    }
	
	public function decrypt($q){
		/*$cryptKey='qJB0rGtIn5UB1xG03efyCp';
		$qDecoded=rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");*/
		$qEncoded=md5($q);
		return $qEncoded;
	}
	
	
	 function getData(){
		 $CI =& get_instance();
			$CI->db->select("date, day, time_in, time_out");
        $query  =   $CI->db->get('wi_attendance');
        return $query->result();
    }
	

	
	public function NewPagination($total, $show_per_page, $base_url)
	{
		$config['base_url'] 	 = $base_url;
        $config['num_links'] 	 = 8;
        $config['uri_segment']	 = 4;
		$config['total_rows']	 = $total;
        $config['per_page'] 	 = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm marg0">';
        $config['full_tag_close']= '</ul>';
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] 	 = '|<';
        $config['first_tag_open']= '<li class="ddd">';
        $config['first_tag_close']= '</li>';
        $config['last_link'] 	 = '>|';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close']= '</li>';
        $config['prev_link'] 	 = '<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close']= '</li>';
        $config['next_link'] 	 = '>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close']= '</li>';
        $config['cur_tag_open']	 = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		$config['reuse_query_string'] = true;
		
		return $config;
		
	}
	
	function img_resize($target, $newcopy, $w, $h, $ext)
	{
		list($w_orig, $h_orig) = getimagesize($target);
		$scale_ratio = $w_orig / $h_orig;
		if(($w / $h) > $scale_ratio){
			$w = $h * $scale_ratio;
		}else{
			$h = $w / $scale_ratio;
		}
		$img = "";
		if($ext == "gif" || $ext == "GIF"){
			$img = imagecreatefromgif($target);
		}else if($ext == "png" || $ext == "PNG"){
			$img = imagecreatefrompng($target);
		}else{
			$img = imagecreatefromjpeg($target);
		}
		$tci = imagecreatetruecolor($w, $h);
		imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
		imagejpeg($tci, $newcopy, 80);
	}
	
	
	public function send_sms($mobile_no,$message)
	{
	/* 	$user_name="kaanha";
		$pass="2058367717";
		$sender_name="KAANHA";
	 	



		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,  "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$user_name.'&password='.$pass.'&sendername='.$sender_name.'&mobileno='.$mobile_no.'&message='.$message.'');
		 $buffer = curl_exec($ch);
		curl_close($ch);
		return true; */
		
		echo'Message sent';
	}
	
	
	
	

	
	

}