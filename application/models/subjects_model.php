<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subjects_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllSubjects(){
		return $this->db->get('subjects');
	}
	
	public function CreateNewSubject($data){
		$this->db->insert('subjects',$data);
		return $this->db->affected_rows();
		
	}
	
	public function getSubjectById($id){
		
		return $this->db->get_where('subjects',array('Id'=>$id));	
		
	}
	
	public function UpdateSubjectById($data){
		var_dump($data);
		//exit;	
		$id = $data['id'];
		unset($data['id']);
		/*foreach($data as $key=>$val):
       		if($data[$key]==''):
       			unset($data[$key]);
			endif;
		endforeach;*/
		
		if(isset($data['SubjectIsOptional'])):
			$data['SubjectIsOptional']=1;
		else:
			$data['SubjectIsOptional']=0;
		endif;
		$this->db->where('Id',$id);	
		$this->db->update('subjects',$data);
		return $this->db->affected_rows();
			
		
	}
}