<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classroutin_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllClassRoutin(){ 
		$this->db->select('subjects.SubjectName,classroutin.*');
		$this->db->from('classroutin');
		$this->db->join('subjects', 'subjects.Id=classroutin.SubjectId AND subjects.SubjectClassId=classroutin.ClassId');
		$this->db->order_by('ClassId','asc');
	    return$query = $this->db->get(); 
		 //$this->db->last_query();
		//exit;
		  
	}
	
	public function CreateNewClassRoutin($data){
		$insert_data = array(
			"ClassId" => $data['ClassId'],
			"SubjectId" => $data['SubjectId'],
			"SectionId" => $data['SectionId'],
			"DayOftheWeekId" => $data['DayOftheWeekId'],
			"StartTime" => $data['StartTime'],
			"EndTime" => $data['EndTime']
		);
		$this->db->insert('classroutin',$insert_data);
		 
		return $this->db->affected_rows();
		
	}
	
	public function getClassById($id){
		
		return $this->db->get_where('classes',array('id'=>$id));	
		
	}
	
	public function UpdateClassById($data){
			
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id',$id);	
		$this->db->update('classes',$data);
		return $this->db->affected_rows();
			
		
	}
}