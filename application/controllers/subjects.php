<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('subjects_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$data['page_title'] = 'Subjects :: School management system';
		
		$this->db->order_by("SubjectClassId", "asc"); 
		$data['subjects']=$this->subjects_model->getAllSubjects();
		$data['class']=$this->db->get('classes')->result();
		
		$this->load->view('include/header',$data);
		$this->load->view('subjects/index');
		$this->load->view('include/footer');
		
	}
	public function create(){
		$data['page_title'] = 'Create Subject :: School management system';
		
		$data['class']=$this->db->get('classes')->result();
		
		$this->load->view('include/header',$data);
		$this->load->view('subjects/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
	 
		
		$this->form_validation->set_rules('SubjectName', 'Subject Name', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('SubjectClassId', 'Class', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('subjects/create'); 
			 
		else:
			if($this->subjects_model->CreateNewSubject($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully Subject Added!');
					redirect('subjects/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('classes/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Subject :: School management system';
		$data['subject']	= $this->subjects_model->getSubjectById($id);
		
		$data['class']=$this->db->get('classes')->result();
		
		$this->load->view('include/header',$data);
		$this->load->view('subjects/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
			 
	 $this->form_validation->set_rules('SubjectName', 'Subject Name', 'trim|required|xss_clean');
	// $this->form_validation->set_rules('SubjectClassId', 'Class', 'trim|required|xss_clean');	
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('subjects/update/'.$this->input->post('id')); 
			 
		else:
			if($this->subjects_model->UpdateSubjectById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully Update!');
					redirect('subjects/index');
				else:
			 
					redirect('subjects/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('subjects',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully deleted this subject!');
					redirect('subjects/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system unable to delete the subject!');
					redirect('subjects/index'); 
			endif;
			
		
	}
}	 