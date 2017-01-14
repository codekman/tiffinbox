<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sections extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('sections_model');
		$this->load->library('session');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
public function index(){
		 
		$data['page_title'] = 'Secssions :: School management system';
		$this->db->order_by("sections.ClassId", "asc"); 
		$data['sections']=$this->sections_model->getAllsections();
		
		$data['teacher'] = $this->db->get_where('employee', array('EmployeeDeptId'=>4))->result();
		$data['class'] = $this->db->get('classes')->result();
		
		$this->load->view('include/header',$data);
		$this->load->view('sections/index');
		$this->load->view('include/footer');
		
	}
	
	public function create(){
		$data['page_title'] = 'Create Secssion :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('sections/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		$this->form_validation->set_rules('SectionName', 'Section Name', 'trim|required|xss_clean');
 
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('sections/create'); 
			 
		else:
			if($this->sections_model->CreateNewSection($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully create new section!');
					redirect('sections/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('Sections/create'); 
			endif;
		endif;
	}
	
	public function update($id=Null){
			
		$data['page_title'] = 'Update Section :: School management system';
		$data['sections']	= $this->sections_model->getSectionById($id);
		$this->load->view('include/header',$data);
		$this->load->view('sections/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('SectionName', 'Section Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('SectionNumericName', 'Section Numeric Value', 'required|xss_clean');
		$this->form_validation->set_rules('ClassId', 'Class Name', 'required|integer|xss_clean');
		$this->form_validation->set_rules('SectionStatus', 'Section Status', 'required|integer|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('sections/update/'.$this->input->post('id')); 
			 
		else:
			if($this->sections_model->UpdateSectionById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully update section!');
					redirect('sections/index');
				else:
				 $this->session->set_flashdata('status_wrong', 'There is nothing to update!');
					redirect('sections/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('sections',array('id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Registration Complete! wait for approval!');
					redirect('sections/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('sections/index'); 
			endif;
			
		
	}
}