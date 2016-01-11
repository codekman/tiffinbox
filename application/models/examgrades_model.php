<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Examgrades_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllExamGrades(){
	 
		return $query = $this->db->get('examgrades');
		
	}
	
	public function CreateNewExamGrades($data){
		$session = $this->session->userdata('is_logged');
		$data['createdBy']=$session['id'];
		$data['createdDate']=date('Y-m-d H:s:i');
		 
		$this->db->insert('examgrades',$data);
		return $this->db->affected_rows();
		
	}
	
	public function getExamGradeById($id){
		
		return $this->db->get_where('examgrades',array('Id'=>$id));	
		
	}
	
	public function UpdateExamGradeById($data){
			
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id',$id);	
		$this->db->update('examgrades',$data);
		return $this->db->affected_rows();
			
		
	}
}