<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Website_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllExams(){
	 
		return $query = $this->db->get('exams');
		
	}
	
	public function CreateNewLink($data){
		return $this->db->insert('link',$data);
		  
	}
	
	public function getExamById($id){
		
		return $this->db->get_where('exams',array('Id'=>$id));	
		
	}
	
	public function updateLink($data){
			
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id',$id);	
		$this->db->update('link',$data);
		return $this->db->affected_rows();
			
		
	}
}