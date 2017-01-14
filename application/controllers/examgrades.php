<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examgrades extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('examgrades_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$data['page_title'] = 'Exam Grades :: School management system';
		$data['examgrades']=$this->examgrades_model->getAllExamGrades();
		$this->load->view('include/header',$data);
		$this->load->view('examgrades/index');
		$this->load->view('include/footer');
		
	}
	public function create(){
		$data['page_title'] = 'Dashboard::School management system';
		$this->load->view('include/header',$data);
		$this->load->view('examgrades/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		$this->form_validation->set_rules('gradeName', 'Grade Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gradePoint', 'Grade Point', 'trim|required|xss_clean');
		$this->form_validation->set_rules('markFrom', 'Mark From', 'trim|required|xss_clean');
		$this->form_validation->set_rules('markUpto', 'Mark Upto', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('examgrades/create'); 
			 
		else:
			if($this->examgrades_model->CreateNewExamGrades($this->input->post())):
				$this->session->set_flashdata('status_right', 'Registration Complete! wait for approval!');
					redirect('examgrades/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('examgrades/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Class :: School management system';
		$data['examgrade']	= $this->examgrades_model->getExamGradeById($id);
		$this->load->view('include/header',$data);
		$this->load->view('examgrades/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('gradeName', 'Grade Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gradePoint', 'Grade Point', 'trim|required|xss_clean');
		$this->form_validation->set_rules('markFrom', 'Mark From', 'trim|required|xss_clean');
		$this->form_validation->set_rules('markUpto', 'Mark Upto', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('examgrades/update/'.$this->input->post('id')); 
			 
		else:
			if($this->examgrades_model->UpdateExamGradeById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successtully Update Exam Grade information');
					redirect('examgrades/index');
				else:
			 
					redirect('examgrades/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('examgrades',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully Removed the Exam Grade information!');
					redirect('examgrades/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
					redirect('examgrades/index'); 
			endif;
			
		
	}
}	 