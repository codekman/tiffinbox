<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classroutin extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('classroutin_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$this->load->model('classes_model');
		$data['page_title'] = 'Class Routins::School management system'; 
		$data['routins']=$this->classroutin_model->getAllClassRoutin();
		$data['classes'] = $this->classes_model->getAllClasses();
		$this->load->view('include/header');
		$this->load->view('classroutin/index',$data);
		$this->load->view('include/footer');
		
	}
	public function create(){
		// Load models	
		$this->load->model('subjects_model');
		$this->load->model('classes_model');
		$this->load->model('sections_model');
		
		$data['page_title'] = 'Create Routin :: School management system';
		$data['subjects'] = $this->subjects_model->getAllSubjects();
		$data['classes'] = $this->classes_model->getAllClasses();
		$data['week'] = $this->db->get('dayoftheweek');
		
		$this->load->view('include/header',$data);
		$this->load->view('classroutin/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
	 
		$this->form_validation->set_rules('ClassId', 'Class Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('StartTime', 'Class start time', 'required|xss_clean');
		 											 
		$this->form_validation->set_rules('EndTime', 'Class end time', 'required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('Classroutin/create'); 
			 
		else:
			if($this->classroutin_model->CreateNewClassRoutin($this->input->post())):
				$this->session->set_flashdata('status_right', 'New Schedule added to the class routin!');
					redirect('Classroutin/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('Classroutin/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Class :: School management system';
		$data['class']	= $this->classroutin_model->getClassById($id);
		$this->load->view('include/header',$data);
		$this->load->view('classes/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('ClassName', 'Class Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ClassNumaricName', 'Class Numeric Value', 											'required|xss_clean');
		$this->form_validation->set_rules('ClassStatus', 'Class Status', 'required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('classes/update/'.$this->input->post('id')); 
			 
		else:
			if($this->classroutin_model->UpdateClassById($this->input->post())):
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
	//return sections by classID by post reqest
	public function getsectionBycId(){
		$clsID = $this->input->post('classId');
		$this->db->where('ClassId', $clsID);
		$query = $this->db->get('sections');
		if($query->num_rows() > 0){
			$section[] = "---Section Section---";
			foreach($query->result() as $row):
				$section[$row->Id] = $row->SectionName;
			endforeach; 
		echo  form_dropdown('SectionId',$section,'','class="input-xlarge"');
		}else{
			echo 0;
		}
	}
public function getSubjectBycId(){
		$clsID = $this->input->post('classId');
		$this->db->where('SubjectClassId', $clsID);
		$query = $this->db->get('subjects');
		if($query->num_rows() > 0){
			$subject[] = "---Section subject---";
			foreach($query->result() as $row):
				$subject[$row->Id] = $row->SubjectName;
			endforeach;
			echo form_label('Subject');
			echo  form_dropdown('SubjectId',$subject,'','class="input-xlarge"');
		}else{
			echo 0;
		}
	}
}	 