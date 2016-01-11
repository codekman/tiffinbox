<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('students_model');
	} 
	
	public function index(){
			$data['page_title'] = 'Students :: School management system';
			$data['students']= $this->students_model->getAllStudent();
			$this->load->view('include/header',$data);
			$this->load->view('students/index');
			$this->load->view('include/footer');	
	}
	public function create(){
		$data['page_title'] = 'Create Student :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('students/create');
		$this->load->view('include/footer');
	}
	
	public function insert(){
		
		$this->form_validation->set_rules('StdName', 'Student Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdFatherName', 'Father\'s Name ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdMotherName', 'Mother\'s Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdDOB', 'Date of Birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdGender', 'Gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdGardianName', 'Gardian Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdContactNo', 'Contact Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdPresentAddress', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdAdmissionYear', 'Admission Year', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('StdClassId', 'Class', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdRollNo', 'Roll Number', 'trim|required|xss_clean');

		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('students/create'); 
			 
		else:
			if($this->students_model->CreateNewStudent($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully Created a New Student!');
					redirect('students/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('students/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Class :: School management system';
		$data['student']	= $this->students_model->getStudentDetailsById($id);
		$this->load->view('include/header',$data);
		$this->load->view('students/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('StdName', 'Student Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdFatherName', 'Father\'s Name ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdMotherName', 'Mother\'s Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdDOB', 'Date of Birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdGender', 'Gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdGardianName', 'Gardian Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdContactNo', 'Contact Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdPresentAddress', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdAdmissionYear', 'Admission Year', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('StdClassId', 'Class', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StdRollNo', 'Roll Number', 'trim|required|xss_clean');

		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('students/create'); 
			 
		else:
			if($this->students_model->UpdatestudentById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Information Upadate is Successfully Complete!');
				redirect('students/index');
			else:
				$this->session->set_flashdata('status_wrong', 'System is Unable to Update!');	
			 	redirect('students/index'); 
			endif;
		endif;	
		
	}
	
	public function delete(){
		$id = $this->input->post('std_id'); 
	  if( $this->students_model->deleteStudent($id)):
	  	echo 'Successfully Deleted Student information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Student information!';
	  endif;
	  
	}
	
	#Report part:
	public function getpdf($cid=Null){
		$this->db->select('*');
		$this->db->from('studentinfo as info');
		$this->db->join('studentdetails as detail', 'info.StdDetailsId = detail.Id');
		$this->db->join('classes', 'classes.Id = info.StdClassId','LEFT');
		$this->db->join('sections', 'sections.Id = info.StdSectionId','LEFT');
		($cid) ? $this->db->where(array('info.StdClassId'=>$cid)) : ''; 
		$data['students'] = $this->db->get();

		$this->load->view('students/pdf', $data);
		$html = $this->output->get_output();
 		// Load library
		$this->load->library('pdf');
		$this->pdf->set_paper("A4", "landscape");
		// Convert to PDF
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream('salesreport.pdf',array('compress'=>1,'Attachment'=>0));
		//$this->pdf->stream("student.pdf");
	} 
	public function getxl($cid=Null){
		header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="students.csv"');
		$content = "";
		$header = "Student's Name,Roll,Section,Class, Student ID,Student Cash ID,Phone,Present Address,Parmanent Address,Status,Admission Year\n";
		$content .= $header;
		$this->db->select('*');
		$this->db->from('studentinfo as info');
		$this->db->join('studentdetails as detail', 'info.StdDetailsId = detail.Id');
		$this->db->join('classes', 'classes.Id = info.StdClassId','LEFT');
		$this->db->join('sections', 'sections.Id = info.StdSectionId','LEFT');
		($cid) ? $this->db->where(array('info.StdClassId'=>$cid)) : ''; 
		$data = $this->db->get()->result_array();
		$status=array('Banned','Current ','Ex-');
		foreach($data as $row){
			$content .= @$row['StdName'].',';
			$content .= @$row['StdRollNo'].',';
			$content .= @ucwords($row['StdSectionId'].' :: '.$row['SectionName']).',';
			$content .= @ucwords($row['ClassName'].' :: '.$row['ClassNumaricName']).',';
			$content .= @$row['StdCurrentId'].',';
			$content .= @$row['StdCashId'].',';
			$content .= @$row['StdContactNo'].',';
			$content .= @$row['StdPresentAddress'].',';
			$content .= @$row['StdPermanentAddress'].',';
			$content .= @$status[@$row['StdStatus']].',';
			$content .= @$row['StdAdmissionYear']."\n";
			
		} 
		echo $content;
	}
}	