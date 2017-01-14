<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Students_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	public function getAllStudent(){
		//var_dump($this->input->post('StdClassId'));
		//exit;
		$this->db->select('*');
		$this->db->from('studentinfo as info');
		$this->db->join('studentdetails as detail', 'info.StdDetailsId = detail.Id');
		$this->db->join('classes', 'classes.Id = info.StdClassId','LEFT');
		$this->db->join('sections', 'sections.Id = info.StdSectionId','LEFT');
		($this->input->post('StdClassId')!='') ? $this->db->where(array('info.StdClassId'=>$this->input->post('StdClassId'))) : '';
		return $this->db->get();
	}

	public function CreateNewStudent($data){

			$data['StdDOB'] = date('Y-m-d',strtotime(str_replace("/",".","$data[StdDOB]")));
			$data['StdContactNo']  = str_replace('-', '',$data['StdContactNo'] );
	       	$data['StdContactNo']  =filter_var($data['StdContactNo'] , FILTER_SANITIZE_NUMBER_INT);

		$insert_data = array(
			'StdName'					=>$data['StdName'],
			'StdFatherName'				=>$data['StdFatherName'],
			'StdMotherName'				=>$data['StdMotherName'],
			'StdDOB'					=>$data['StdDOB'],
			'StdGender'					=>$data['StdGender'],
			'StdBloodGroup'				=>$data['StdBloodGroup'],
			'StdGardianName'			=>$data['StdGardianName'],
			'StdContactNo'				=>$data['StdContactNo'],
			'StdPresentAddress'			=>$data['StdPresentAddress'],
			'StdPermanentAddress'		=>(@$data['same_permanent']!=1)? $data['StdPermanentAddress'] : 'same as Present Address',
			'StdAdmissionYear'			=>$data['StdAdmissionYear']
		);



	 	//insert data into 'student_details' Data Table:
		$this->db->insert('studentdetails',$insert_data);

		if($this->db->affected_rows()):
		 	$Std_id = $this->db->insert_id();

			// concatenate admission year, class id, section id and Roll no to make Student_id:
			$student_id = 'HHS-'.$data['StdAdmissionYear'].'-'
							.sprintf("%02s", $data['StdClassId']).'-'
							.sprintf("%02s", $data['StdSectionId']).'-'
							.sprintf("%03s", $data['StdRollNo']);

			// concatenate admission year and std_id to make cash_id:
			$data['cash_id'] = $cash_id	=	'CSH-'.$data['StdAdmissionYear'].'-'
							.sprintf("%05s", $Std_id);

			$insert_data2 = array(
				'StdDetailsId'			=> $Std_id,
				'StdCurrentId'			=> $student_id,
				'StdCashId'				=> $cash_id,
				'StdRollNo'				=> $data['StdRollNo'],
				'StdClassId'			=> $data['StdClassId'],
				'StdSectionId'			=> $data['StdSectionId'] ? $data['StdSectionId'] : 0,
				'StdStatus'				=> $data['StdStatus']
			);

			//insert data into 'student_info' Data table:
			$this->db->insert('studentinfo',$insert_data2);

			if($this->db->affected_rows()):
				// photo upload
				$insert_data['StdProfilePhoto'] = $this->uploadinputfile('StdProfilePhoto',$data);

				$insert_data['StdGardianPhoto'] = $this->uploadinputfile('StdGardianPhoto',$data);

				$insert_data['StdGardianSigneture'] = $this->uploadinputfile('StdGardianSigneture',$data);

				//photo update to DB:
				$photo_update = array(
					'StdProfilePhoto' 		=>$insert_data['StdProfilePhoto'],
					'StdGardianPhoto'		=>$insert_data['StdGardianSigneture'],
					'StdGardianSigneture'	=>$insert_data['StdGardianSigneture']
				);

				$this->db->where('Id',$Std_id);
				$this->db->update('studentdetails',$photo_update);

				//Data create for QRCODE:
				$std_qr = $insert_data['StdName'];

				//Request for QRCode Create:
				file_get_contents(base_url()."assets/phpqrcode/index.php?data=$std_qr&level=L&size=4");

				//Move QRcode:
				$get_Qr_dir = explode('_', $insert_data['StdProfilePhoto']);
				$Qr_dir = './assets/phpqrcode/temp/';
				$Qr_dir_new = "./media/students/$get_Qr_dir[1]/$get_Qr_dir[2]/";

				if (file_exists($Qr_dir)) {

				    rename($Qr_dir.'test.png', $Qr_dir_new.'Qr.png');
				}else {
					$this->session->set_flashdata('status_wrong', 'Unable to rename the QRCode file cause it does not exist');
					return FALSE;

				}
				return TRUE;
			else:
				return FALSE;
			endif;
		else:
			return FALSE;
		endif;
	}
	public function UpdatestudentById($data){

			$data['StdDOB'] = date('Y-m-d',strtotime(str_replace("/",".","$data[StdDOB]")));
			$data['StdContactNo']  = str_replace('-', '',$data['StdContactNo'] );
	       	$data['StdContactNo']  =filter_var($data['StdContactNo'] , FILTER_SANITIZE_NUMBER_INT);
		//get update ID:
	 	$update_id = $data['id'];

		$update_data = array(
			'StdName'					=>$data['StdName'],
			'StdFatherName'				=>$data['StdFatherName'],
			'StdMotherName'				=>$data['StdMotherName'],
			'StdDOB'					=>$data['StdDOB'],
			'StdGender'					=>$data['StdGender'],
			'StdBloodGroup'				=>$data['StdBloodGroup'],
			'StdGardianName'			=>$data['StdGardianName'],
			'StdContactNo'				=>$data['StdContactNo'],
			'StdPresentAddress'			=>$data['StdPresentAddress'],
			'StdPermanentAddress'		=>(@$data['same_permanent']!=1)? $data['StdPermanentAddress'] : 'same as Present Address',
			'StdAdmissionYear'			=>$data['StdAdmissionYear']
		);

		//get info from Database of this student:
		$std_info = $this->db->get_where('studentdetails', array('Id'=>$update_id));
		$data['cash_id'] = $this->db->get_where('studentinfo',array('StdDetailsId'=>$update_id))->row()->StdCashId;
		// photo upload
		if(!empty($_FILES['StdProfilePhoto']['name'])):

			//Profile photo remove from folder:
			$profile_photo = $std_info->row()->StdProfilePhoto;
			$photo = explode('_',$profile_photo);

			// remove thumb
			$dir =  "./media/students/$photo[1]/$photo[2]";
			unlink($dir."/".$profile_photo);

			//remove original
			$dir =  "./media/students/$photo[1]/$photo[2]";
			unlink($dir."/".str_replace("_thumb","",$profile_photo));

			$update_data['StdProfilePhoto'] = $this->uploadinputfile('StdProfilePhoto',$data);

	 	endif;

		if(!empty($_FILES['StdGardianPhoto']['name'])):
			//Std Gardian Photo
			$StdGardianPhoto = $std_info->row()->StdGardianPhoto;
			$photo = explode('_',$profile_photo);
			$dir =  "./media/students/$photo[1]/$photo[2]";
			unlink($dir."/".$StdGardianPhoto);

			$update_data['StdGardianPhoto'] = $this->uploadinputfile('StdGardianPhoto',$data);
	 	endif;

		if(!empty($_FILES['StdGardianSigneture']['name'])):
			//Std Gardian Signeture
			$StdGardianSigneture = $std_info->row()->StdGardianSigneture;
			$photo = explode('_',$profile_photo);
			$dir =  "./media/students/$photo[1]/$photo[2]";
			unlink($dir."/".$StdGardianSigneture);

			$update_data['StdGardianSigneture'] = $this->uploadinputfile('StdGardianSigneture',$data);
	 	endif;


		//Data create for QRCODE:
		$std_qr = $data['StdName'];

		//Request for QRCode Create:
		file_get_contents(base_url()."assets/phpqrcode/index.php?data=$std_qr&level=L&size=4");

		//Move QRcode:
		$get_Qr_dir = explode('_', $update_data['StdProfilePhoto']);

		$Qr_dir = './assets/phpqrcode/temp/';
		$Qr_dir_new = "./media/students/$get_Qr_dir[1]/$get_Qr_dir[2]/";

		// remove privious qrcode image:
		unlink($Qr_dir_new.'Qr.png');

		if (file_exists($Qr_dir)) {
		    rename($Qr_dir.'test.png', $Qr_dir_new.'Qr.png');
		}else {
			$this->session->set_flashdata('status_wrong', 'Unable to rename the QRCode file cause it does not exist');
			return FALSE;

		}

	 	//update data into 'student_details' Data Table:
	 	$this->db->where('Id',$update_id);

		if($this->db->update('studentdetails',$update_data)):

		 $student_id = 'HHS-'.$data['StdAdmissionYear'].'-'
							.sprintf("%02s", $data['StdClassId']).'-'
							.sprintf("%02s", $data['StdSectionId']).'-'
							.sprintf("%03s", $data['StdRollNo']);
		$update_data2 = array(

			'StdCurrentId'			=> $student_id,
			'StdRollNo'				=> $data['StdRollNo'],
			'StdClassId'			=> $data['StdClassId'],
			'StdSectionId'			=> $data['StdSectionId'],
			'StdStatus'				=> $data['StdStatus']
		);


			//update data into 'student_info' Data table:
			$this->db->where('StdDetailsId',$update_id);

			if($this->db->update('studentinfo',$update_data2)):
				return TRUE;
			else:
				return FALSE;
			endif;
		else:
			return FALSE;
		endif;
	}
	/**
	/* it's a supporting function of CreateNewStudent() for file upload:
	**/
	public function uploadinputfile($name,$data){
			 $new_file_name=NULL;
			//start file upload and resize process
			$config['upload_path'] 		= './media/students/';
			if(!is_dir($config['upload_path'].$data['StdAdmissionYear'])):
				mkdir($config['upload_path'].$data['StdAdmissionYear']);
			endif;
			$config['upload_path'] .= '/'.$data['StdAdmissionYear'];

			if(!is_dir($config['upload_path'].'/'.$data['cash_id'])):
				mkdir($config['upload_path'].'/'.$data['cash_id']);
			endif;
			$config['upload_path'] .='/'.$data['cash_id'];

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
			 	if($name=='StdProfilePhoto'):
					//new file name:
					$new_file_name = 'photo_'.$data['StdAdmissionYear'].'_'
							.$data['cash_id'].'_codekman'.mb_strtolower($file_data['file_ext']);
					$photo_name = 'photo_'.$data['StdAdmissionYear'].'_'
							.$data['cash_id'].'_codekman_thumb'.mb_strtolower($file_data['file_ext']);
				elseif($name=='StdGardianPhoto'):
					$new_file_name = 'GP_'.$data['StdAdmissionYear'].'_'
							.$data['cash_id'].'_codekman_'.mb_strtolower($file_data['file_ext']);
					$photo_name = $new_file_name;
				else:
					$new_file_name = 'GS_'.$data['StdAdmissionYear'].'_'
							.$data['cash_id'].'_codekman_'.mb_strtolower($file_data['file_ext']);
					$photo_name = $new_file_name;
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

	public function deleteStudent($id){
		$this->db->select('StdProfilePhoto');
		$query = $this->db->get_where('studentdetails',array('Id'=>$id));
		$photo = explode('_', @$query->row()->StdProfilePhoto);

		$this->db->delete('studentdetails',array('id'=>$id));
		$this->db->delete('studentinfo',array('StdDetailsId'=>$id));

		if($this->db->affected_rows()):
			$dir ='./media/students/'.@$photo[1].'/'.@$photo[2];

			if(is_dir($dir)):
		  	     foreach(glob($dir . '/*') as $file) {
			    	if(is_dir($file)) rrmdir($file); else unlink($file);
			 	 }
			endif;
			return TRUE;
		else:
		  	 return FALSE;
		endif;

	}

public function getStudentDetailsById($id){
		$this->db->select('*');
		$this->db->join('studentinfo', 'studentinfo.StdDetailsId=studentdetails.Id');
		return $this->db->get_where('studentdetails', array('studentdetails.Id'=>$id));
	}
}
