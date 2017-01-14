<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	
	public function getAllTeachers($limit=0, $start=0){ 
			
		if(!$start){$start=0;}	
		$this->db->order_by("Id", "desc"); 
		$this->db->limit($limit,$start ); 
		return $this->db->get('employee');
	}
	
	public function getTotalTeacher(){
			
		return $this->db->get('employee')->num_rows();
	}
	
	public function getTeacherById($id){
			
		return $this->db->get_where('employee', array('Id'=>$id));
	}
	
	public function createEmployee($data){
	 
		$data['EmployeeBrithDate'] = date('Y-m-d',strtotime(str_replace("/",".","$data[EmployeeBrithDate]")));
		$data['EmployeeMobile']  = str_replace('-', '',$data['EmployeeMobile'] );
       	$data['EmployeeMobile']  =filter_var($data['EmployeeMobile'] , FILTER_SANITIZE_NUMBER_INT);
       	 
       	$data['EmployeePassword']  =md5($data['EmployeePassword']);
       
       // Data insert into Database
		if($this->db->insert('employee',$data)):
			 
			if(!empty($_FILES['EmployeePhoto']['name'])):
			$data['employee_id'] = $this->db->insert_id();
				$data['EmployeePhoto']  = @$this->uploadinputfile('EmployeePhoto',$data);
				//var_dump($data['EmployeePhoto']);
				//exit;
				//update db table with teacher photo:
				$this->db->where('Id',$data['employee_id']);
				$this->db->update('employee', array('EmployeePhoto'=>$data['EmployeePhoto']));
				
				//Data create for QRCODE:
				$std_qr = $data['EmployeeName'];
				
				//Request for QRCode Create:
				file_get_contents(base_url()."assets/phpqrcode/index.php?data=$std_qr&level=L&size=4");
				
				//Move QRcode:
				$get_Qr_dir = explode('-', @$data['EmployeePhoto']);
				$Qr_dir = './assets/phpqrcode/temp/';
				@$Qr_dir_new = "./media/employee/@$get_Qr_dir[1]/";
				
				if (file_exists($Qr_dir)) {
					 
				    @rename($Qr_dir.'test.png', $Qr_dir_new.'Qr.png');
				}else {
					$this->session->set_flashdata('status_wrong', 'Unable to rename the QRCode file cause it does not exist');
					return FALSE;
				   
				}
			endif;	
			return true;
		else:
			return false;
		endif;
		
	}
	
	
	public function updateEmployee($data){
		$id = $data['id'];	
		unset($data['id']);
		
		$data['EmployeeBrithDate'] = date('Y-m-d',strtotime(str_replace("/",".","$data[EmployeeBrithDate]")));
		$data['EmployeeMobile']  = str_replace('-', '',$data['EmployeeMobile'] );
       	$data['EmployeeMobile']  =filter_var($data['EmployeeMobile'] , FILTER_SANITIZE_NUMBER_INT);
       
       	if(!empty($data['EmployeePassword'])):
       		$data['EmployeePassword']  =md5($data['EmployeePassword']);
		else:
			unset($data['EmployeePassword'] );
		endif;
		
       	$employee_info = $this->db->get_where('employee', array('Id'=>$id));
       	
		$data['employee_id'] = $id;
		// photo upload
		if(!empty($_FILES['EmployeePhoto']['name'])):
		
			//Profile photo remove from folder:
			$profile_photo = $employee_info->row()->EmployeePhoto;
			$photo = explode('-',$profile_photo);
			
			// remove thumb
			$dir =  "./media/employee/$photo[1]";
			@unlink($dir."/".$profile_photo);
			
			//remove original 
			$dir =  "./media/employee/$photo[1]";
			@unlink($dir."/".str_replace("_thumb","",$profile_photo));
			
			$data['EmployeePhoto'] = $this->uploadinputfile('EmployeePhoto',$data);
			
	 	endif; 
	 	
       	foreach($data as $key=>$val):
       		if($data[$key]==''):
       			unset($data[$key]);
			endif;
		endforeach;
		
		unset($data['employee_id']);
		 
		//Update employee table
		$this->db->where('id',$id);
		$this->db->update('employee',$data);
		return $this->db->affected_rows();
		
	}
	// Upload Teacher Profile Photo:
	public function uploadinputfile($name,$data){
		
			 $new_file_name=NULL; 
			 
					//start file upload and resize process 
					$config['upload_path'] 		= './media/employee/';
					
					if(!is_dir($config['upload_path'].'_'.$data['employee_id'].'_'.$data['EmployeeMobile'])): 
						mkdir($config['upload_path'].'_'.$data['employee_id'].'_'.$data['EmployeeMobile']); 
					endif;
					$config['upload_path'] .= '/'.'_'.$data['employee_id'].'_'.$data['EmployeeMobile'];
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
						
						//new file name:
						$new_file_name = 'photo-'.'_'.$data['employee_id'].'_'.$data['EmployeeMobile'].'-'.$data['EmployeeUserName']
										.mb_strtolower($file_data['file_ext']);
						$photo = 'photo-'.'_'.$data['employee_id'].'_'.$data['EmployeeMobile'].'-'.$data['EmployeeUserName']
										.'_thumb'.mb_strtolower($file_data['file_ext']);
										
						$filenew = rename($config['upload_path']
									.'/'.$file_data['file_name'], $config['upload_path'].'/'.$new_file_name);  
									                    
						$resize_me['image_library'] = 'gd2';
						$resize_me['source_image'] = $config['upload_path'].'/'.$new_file_name;
						$resize_me['create_thumb'] = TRUE;
						$resize_me['maintain_ratio'] = TRUE;
						$resize_me['master_dim'] = 'auto';
						$resize_me['height'] = 100;
						$resize_me['width'] = 100;
						
						//load the library:
						$this->load->library('image_lib', $resize_me); 
						$this->image_lib->resize();
						
						return $photo;
					} 
		}
		
	public function deleteEmployee($id){
		
		$this->db->select('EmployeePhoto');
		$query = $this->db->get_where('employee',array('Id'=>$id));
		$photo = explode('-', @$query->row()->EmployeePhoto);
		$this->db->delete('employee',array('Id'=>$id));
		if($this->db->affected_rows()):
			$dir ='./media/employee/'.@$photo[1]; 
			if(is_dir($dir)):
		  	     foreach(glob($dir . '/*') as $file) { 
			    	if(is_dir($file)) @rmdir($file); else @unlink($file); 
			 	 } @rmdir($dir); 
			else:
				echo "No directory";
				
			endif;
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}	
	
	/**
	* Department Part
	**/
	
	public function createDepartment($data){
			
		// get created information from the system:
		$data['createIp'] = $_SERVER['REMOTE_ADDR'];
		$data['createDatetime'] = date('Y-m-d H:i:s');
		// get ueserId:
		$login_data = $this->session->userdata('is_logged');
		$data['createdBy'] = $login_data['id'];
			
		$this->db->insert('departments', $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function getDepartmentById($id){
			
		return $this->db->get_where('departments', array('Id'=>$id));	
		
	}
	
	public function updateDepartment($data){
		$id = $data['id'];
		unset($data['id']);
		
		$this->db->where('Id',$id);
		return $this->db->update('departments', $data);	
		  
	}
	
	public function deletedepartment($id){
		$this->db->where('Id', $id);
		return $this->db->delete('departments');	
		
	}
	
	/**
	* Designation Part
	**/
	
	public function createDesignation($data){
		return $this->db->insert('designations', $data);
		
	}
	
	public function getDesignationById($id){
		return $this->db->get_where('designations', array('Id'=>$id));	
		
	}
	public function updateDesignation($data){
		$id = $data['id'];
		unset($data['id']);
		
		$this->db->where('Id',$id);
		return $this->db->update('designations', $data);	
		  
	}
	public function deletedesignation($id){
		$this->db->where('Id', $id);
		return $this->db->delete('designations');	
		
	}
	
}