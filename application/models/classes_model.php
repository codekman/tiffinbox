<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classes_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllClasses(){
	 	$this->db->order_by('ClassNumaricName', 'asc');
		return $query = $this->db->get('classes');
		
	}
	
	public function CreateNewClass($data){
		//gets subjects of this class:
		$subject = $data['subjects'];
		unset($data['subjects']);
		
		$this->db->insert('classes',$data);
		$class_id = $this->db->insert_id();
		
		//insert subject to the subject table:
		foreach(explode(',',$subject) as $sub):
		$insert_data = array(
			'SubjectName' => trim($sub),
			'SubjectClassId'=>$class_id,
			'SubjectStatus'=>1
		);
		$this->db->insert('subjects',$insert_data);
		endforeach;
		return true;
		
	}
	
	public function getClassById($id){
		
		return $this->db->get_where('classes',array('id'=>$id));	
		
	}
	
	public function UpdateClassById($data){
		//var_dump($data);
		//exit;	
		$id = $data['id'];
		unset($data['id']);
		
		//get new subjects:
		$subject = $data['subjects'];
		
		unset($data['subjects']);
		
		$this->db->where('Id',$id);	
		$this->db->update('classes',$data);
		
		$class_id = $id;
		$this->db->where('SubjectClassId',$class_id);
		$this->db->delete('subjects');
		
		//insert again subject to the subject table:
		foreach(explode(',',$subject) as $sub):
			$update_data = array(
				'SubjectName' => trim($sub),
				'SubjectClassId'=>$class_id,
				'SubjectStatus'=>1
			);
			$this->db->insert('subjects',$update_data);
		endforeach;
		return true;
			
		
	}
}