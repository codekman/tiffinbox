<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exams_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllExams(){
	 
		return $query = $this->db->get('exams');
		
	}
	
	public function CreateNewExam($data){
		$data['examDate'] = date('Y-m-d',strtotime($data['examDate'])); 
		$session = $this->session->userdata('is_logged');
		$this->db->insert('exams',$data);
		return $this->db->affected_rows();
	}
	
	public function getExamById($id){
		
		return $this->db->get_where('exams',array('Id'=>$id));	
		
	}
	
	public function UpdateExamById($data){
			
		$id = $data['id'];
		$data['examDate'] = date('Y-m-d', strtotime($data['examDate']));
		unset($data['id']);
		$this->db->where('Id',$id);	
		$this->db->update('exams',$data);
		return $this->db->affected_rows();
			
		
	}
}