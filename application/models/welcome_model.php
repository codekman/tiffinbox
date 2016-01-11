<?php
class Welcome_Model extends CI_Model {
	
	  function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function createUser($data){
		unset($data['cpassword']);
		unset($data['agree']);
		unset($data['btn']);
		$data['password'] = md5($data['password']);
		$this->db->insert('user',$data);
		 
		if($this->db->affected_rows()):
			return true;
		else:
			return false;
		endif;
		
	}
	
	public function checkLogin($data){
		$user_name = $data['user_name'];
		$password = $data['password'];
	 
		$query = $this->db->get_where('user', array('user_name'=> $user_name, 'password'=>md5($password)));
		
		if($query->num_rows() > 0):
			$is_logged = array();
			foreach($query->result() as $row):
				$is_logged['id']	= $row->id;
				$is_logged['type_id']	= $row->type_id;
				$is_logged['full_name']	= $row->full_name;
				$is_logged['user_name']	= $row->user_name;
				$is_logged['email']	= $row->email;
				$is_logged['mobile']	= $row->mobile;
			endforeach;
			
		//initialize user last login time
		$user_last_login = date('Y-m-d H:i:s');
		//initialize user last login ip
		$user_last_login_ip = $_SERVER['REMOTE_ADDR'];	
	
		$this->db->where('id',$is_logged['id']);	
		$this->db->update('user',array('last_login_ip'=>$user_last_login_ip,'last_login_time'=>$user_last_login));		
	
		$this->session->set_userdata('is_logged',$is_logged);	
			return true;	
		else:
			return false;
		endif;	
		
	}
}	