<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('school_model');
		$this->load->library('session');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
public function index(){
		 
		$data['page_title'] = 'Schools :: School management system';
		$data['schools']=$this->school_model->getAllschools();
		$this->load->view('include/header',$data);
		$this->load->view('school/index');
		$this->load->view('include/footer');
		
	}
	
	public function create(){
		$data['page_title'] = 'Create School :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('school/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		
		$this->form_validation->set_rules('schoolName', 'School Name', 'trim|required|xss_clean');
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->create();
			 
		else:
			if($this->school_model->CreateNewSchool($this->input->post())):
			
		 
				$this->session->set_flashdata('status_right', 'Successfully create new school!');
					redirect('school/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('school/create'); 
			endif;
		endif;
	}
	
	public function update($id=Null){
			
		$data['page_title'] = 'Update Section :: School management system';
		$data['school']	= $this->school_model->getSchoolById($id);
		$this->load->view('include/header',$data);
		$this->load->view('school/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
				
		$this->form_validation->set_rules('schoolName', 'School Name', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			//redirect('school/update/'.);
			$this->update($this->input->post('id')); 
			 
		else:
			if($this->school_model->UpdateSchoolById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfully update section!');
					redirect('school/index');
				else:
				 $this->session->set_flashdata('status_wrong', 'There is nothing to update!');
					redirect('school/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
		$schoolLogo = $this->db->get_where('schools', array('Id'=>$id))->row()->schoolLogo;		
		$this->db->delete('schools',array('Id'=>$id));
		if($this->db->affected_rows()):
			$dir ='./media/schools/'.$schoolLogo; 
			  @unlink($dir);  
			//remove original file:
			$dir ='./media/schools/'.str_replace("_thumb","",$schoolLogo);
			   @unlink($dir);  
			$this->session->set_flashdata('status_right', 'Successfully deleted school information!');
			redirect('school/index');
		else:
		  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
			redirect('school/index'); 
		endif;
			
		
	}
	/***
	* Branches Part
	*/
	public function branches(){
		$data['page_title'] = 'School Branchs :: School management system';
		$data['branches'] = $this->school_model->getAllBranches();
		$this->load->view('include/header',$data);
		$this->load->view('school/branches');
		$this->load->view('include/footer');
		
	}
	public function createbranch(){
		$data['page_title'] = 'Create Branch :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('school/createbranch');
		$this->load->view('include/footer');
		
	}
	
	public function insertbranch(){
		
		$this->form_validation->set_rules('branchName', 'Branch Name', 'trim|required|xss_clean');
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->createbranch();
			 
		else:
			if($this->school_model->CreateNewBranch($this->input->post())):
			
		 
				$this->session->set_flashdata('status_right', 'Successfully create new branch!');
					redirect('school/branches');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('school/branches'); 
			endif;
		endif;
	}
	
	public function updatebranch($id){
		$data['page_title'] = 'Update Branch :: School management system';
		
		$data['branch'] = $this->school_model->getBranchById($id); 
		$this->load->view('include/header',$data);
		$this->load->view('school/updatebranch');
		$this->load->view('include/footer');
		
	}
	
	public function editbranch(){
	 
		$this->form_validation->set_rules('branchName', 'Branch Name', 'trim|required|xss_clean');
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->updatebranch($this->input->post('id')); 
			 
		else:
			if($this->school_model->updateBranch($this->input->post())):
			
		 
				$this->session->set_flashdata('status_right', 'Successfully update branch!');
					redirect('school/branches');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('school/branches'); 
			endif;
		endif;
	}

	
	public function deletebranch($id){
		if($this->db->delete('branches',array('Id'=>$id))):
		 
			$this->session->set_flashdata('status_right', 'Successfully deleted school information!');
			redirect('school/branches');
		else:
 		  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
			redirect('school/branches'); 
		endif;
			
		
	}	
	
	/***
	* Batch Part
	*/
	public function batch(){
		$data['page_title'] = 'School Branchs :: School management system';
		$data['batch'] = $this->school_model->getAllBatch();
		$this->load->view('include/header',$data);
		$this->load->view('school/batch');
		$this->load->view('include/footer');
		
	}
	public function createbatch(){
		$data['page_title'] = 'Create Branch :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('school/createbatch');
		$this->load->view('include/footer');
		
	}
	
	public function insertbatch(){
		 
		$this->form_validation->set_rules('batchYear', 'Batch year', 'trim|required|xss_clean');
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->createbatch();
			 
		else:
			if($this->school_model->CreateNewBatch($this->input->post())):
			
		 
				$this->session->set_flashdata('status_right', 'Successfully create new batch!');
					redirect('school/batch');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('school/batch'); 
			endif;
		endif;
	}
	
	public function updatebatch($id){
		$data['page_title'] = 'Update Batch :: School management system';
		
		$data['batch'] = $this->school_model->getBatchById($id); 
		$this->load->view('include/header',$data);
		$this->load->view('school/updatebatch');
		$this->load->view('include/footer');
		
	}
	
	public function editbatch(){
	 
		$this->form_validation->set_rules('batchYear', 'Branch year', 'trim|required|xss_clean');
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->updatebatch($this->input->post('id')); 
			 
		else:
			if($this->school_model->updateBatch($this->input->post())):
			
		 
				$this->session->set_flashdata('status_right', 'Successfully update batch!');
					redirect('school/batch');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('school/batch'); 
			endif;
		endif;
	}

	
	public function deletebatch($id){
		if($this->db->delete('branches',array('Id'=>$id))):
		 
			$this->session->set_flashdata('status_right', 'Successfully deleted school information!');
			redirect('school/branches');
		else:
 		  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
			redirect('school/branches'); 
		endif;
			
		
	}	
}