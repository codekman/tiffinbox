<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Exams extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('exams_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$data['page_title'] = 'Exams :: School management system';
		$data['exams']=$this->exams_model->getAllExams();
		$this->load->view('include/header',$data);
		$this->load->view('exams/index');
		$this->load->view('include/footer');
		
	}
	public function create(){
		$data['page_title'] = 'Dashboard::School management system';
		$this->load->view('include/header',$data);
		$this->load->view('exams/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		$this->form_validation->set_rules('examName', 'Exam Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('examDate', 'Exam Date', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('exams/create'); 
			 
		else:
			if($this->exams_model->CreateNewExam($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfull Update New Exam!');
					redirect('exams/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('exams/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Exam :: School management system';
		$data['exam']	= $this->exams_model->getExamById($id);
		$this->load->view('include/header',$data);
		$this->load->view('exams/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
		//var_dump($this->input->post());
		//exit;		
		$this->form_validation->set_rules('examName', 'Exam Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('examDate', 'Exam Date', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('exams/update/'.$this->input->post('id')); 
			 
		else:
			if($this->exams_model->UpdateExamById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successtully Update Exam information');
					redirect('exams/index');
				else:
			 
					redirect('exams/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('exams',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully Removed the Exam information!');
					redirect('exams/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
					redirect('exams/index'); 
			endif;
			
		
	}
	
	
}	 