<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model(array('classes_model'));
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		 
		
		$data['page_title'] = 'Classes :: School management system';
		
		$data['classes']=$this->classes_model->getAllClasses();
		$data['teacher'] = $this->db->get_where('employee', array('EmployeeDeptId'=>4))->result();
		
		$this->load->view('include/header',$data);
		$this->load->view('classes/index');
		$this->load->view('include/footer'); 
		
	}
	public function create(){
		$data['page_title'] = 'Dashboard::School management system';
		$this->load->view('include/header',$data);
		$this->load->view('classes/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		 
		$this->form_validation->set_rules('ClassName', 'Class Name', 'trim|required|xss_clean');
		 
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->create(); 
			 
		else:
			if($this->classes_model->CreateNewClass($this->input->post())):
				$this->session->set_flashdata('status_right', 'Registration Complete! wait for approval!');
					$this->index();
					//redirect('classes/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					$this->create();
					//redirect('classes/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Class :: School management system';
		$data['class']	= $this->classes_model->getClassById($id);
		
		$this->load->view('include/header',$data);
		$this->load->view('classes/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('ClassName', 'Class Name', 'trim|required|xss_clean');

		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('classes/update/'.$this->input->post('id')); 
			 
		else:
			if($this->classes_model->UpdateClassById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successtully Update Class information');
					redirect('classes/index');
				else:
			 
					redirect('classes/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('classes',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully Removed the Class information!');
					redirect('classes/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
					redirect('classes/index'); 
			endif;
		
	}
	
	public function addsubject(){
		$data['page_title'] = 'Add Subjects to the Classes :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('classes/addsubject');
		$this->load->view('include/footer');
		
	}
	
	public function insertsubjects(){
			
		
	}
}	 