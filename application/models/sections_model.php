<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sections_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllsections(){
		return $query = $this->db->get('sections');
	}
	
	public function CreateNewSection($data){
 		echo '<pre>';
		print_r($data);	
 		echo '</pre>';	
		//exit;
 		$this->db->insert('sections',$data);
		return $this->db->affected_rows();
		
	}
	
	public function getSectionById($id){
		
		return $this->db->get_where('sections',array('Id'=>$id));	
		
	}
	
	 public function UpdateSectionById($data){
		 	
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id',$id);	
		$this->db->update('sections',$data);
		return $this->db->affected_rows();
			
		
	} 
}