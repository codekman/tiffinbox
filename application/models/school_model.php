<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class School_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	
	
	public function getAllschools(){
		$this->db->order_by("Id", "desc"); 
		return $query = $this->db->get('schools');
		
	}
	
	public function CreateNewSchool($data){
		 
		$insert_data = array(
				'schoolName'		=> $data['schoolName'],
				'schoolAddress'		=> $data['schoolAddress'],
				'createdDatetime'	=> date("Y-m-d H:i:s"),
				'cratedIp'			=> $_SERVER['REMOTE_ADDR'],
				'schoolStatus'		=> $data['schoolStatus']
				
		);
		if($_FILES['schoolLogo']['name']):
		$insert_data['schoolLogo'] = $this->uploadSchoolLogo('schoolLogo');
		endif;
		
 		return $this->db->insert('schools',$insert_data);
		
		
	}
	
	public function uploadSchoolLogo($name){
	 	$new_file_name=NULL; 
		
		//start file upload and resize process 
		$config['upload_path'] 		= './media/schools/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
		
		//load ci upload library:
		$this->load->library('upload', $config);

		//check for upload:
		if(!$this->upload->do_upload($name))
		{	 
			$this->session->set_flashdata('status_wrong', $this->upload->display_errors());
			return false;
		}
		else
		{	
			// Resize the Image 2:
			$file_data = $this->upload->data(); // get the file upload data
		 	if($name=='schoolLogo'):
				//new file name:
				$id = 'schoolLogo_'.date('Y-m-d-H_i_s');
				
				$new_file_name =  $id.mb_strtolower($file_data['file_ext']);
				$photo_name =  $id.'_thumb'.mb_strtolower($file_data['file_ext']);
			 
			endif;
			
			$filenew = rename($config['upload_path']
						.'/'.$file_data['file_name'], $config['upload_path'].'/'.$new_file_name);  
		   
		                         
			$resize_me['image_library'] = 'gd2';
			$resize_me['source_image'] = $config['upload_path'].'/'.$new_file_name;
			$resize_me['create_thumb'] = TRUE;
			$resize_me['maintain_ratio'] = TRUE;
			$resize_me['master_dim'] = 'auto';
			$resize_me['width'] = 100;
			$resize_me['height'] = 100;
	 	
	 		//load the library:
			$this->load->library('image_lib', $resize_me); 
			$this->image_lib->resize(); 
			return $photo_name;
		} 
		
	}
	public function getSchoolById($id){
		
		return $this->db->get_where('schools',array('Id'=>$id));	
		
	}
	
	public function UpdateSchoolById($data){
			
		$id = $data['id'];
		unset($data['id']);
		if(!empty($_FILES['schoolLogo']['name'])): 
		
		// get school logo from database:
		$school_logo = $this->db->get_where('schools', array('Id'=>$id))->row()->schoolLogo;
		if($school_logo):
		// remove thumb
			$dir =  "./media/schools/";
			unlink($dir."/".$school_logo);
		//remove original 
		 	unlink($dir."/".str_replace("_thumb","",$school_logo));
		endif;	
		
		$data['schoolLogo'] = $this->uploadSchoolLogo('schoolLogo');
		endif;
		
		$this->db->where('Id',$id);	
		$this->db->update('schools',$data);
		return $this->db->affected_rows();
			
		
	}
	
	/**
	* Branches part
	*/
	
	public function getAllBranches(){
		$this->db->order_by("schoolId", "desc"); 
		//$this->db->group_by("schoolId"); 	
		return $this->db->get('branches');
	}
	
	public function CreateNewBranch($data){
			
		return $this->db->insert('branches', $data);
	}
	
	public function getBranchById($id){
			
		return $this->db->get_where('branches', array('Id'=>$id));
	}
	
	public function updateBranch($data){
			
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id', $id);
		return $this->db->update('branches', $data);
	}
	
	/**
	* Batch Part
	**/ 
	public function getAllBatch(){
		$this->db->order_by("Id", "desc"); 
		//$this->db->group_by("schoolId"); 	
		return $this->db->get('batch');
	}
	
	public function CreateNewBatch($data){
			
		return $this->db->insert('batch', $data);
	}
	
	public function getBatchById($id){
			
		return $this->db->get_where('batch', array('Id'=>$id));
	}
	
	public function updateBatch($data){
			
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id', $id);
		return $this->db->update('batch', $data);
	} 
}