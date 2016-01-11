<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Noticeboard extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('noticeboard_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$data['page_title'] = 'Exams :: School management system';
		$data['notices']=$this->noticeboard_model->getAllNotice();
		$this->load->view('include/header',$data);
		$this->load->view('noticeboard/index');
		$this->load->view('include/footer');
		
	}
	public function create(){
		$data['page_title'] = 'Notice Board :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('noticeboard/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
	 
		$this->form_validation->set_rules('noticeDate', 'Notice Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('noticeTitle', 'Notice Title', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('noticeboard/create'); 
			 
		else:
			if($this->noticeboard_model->CreateNewNoticeboard($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfull Add New Notice!');
					redirect('noticeboard/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('noticeboard/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Exam :: School management system';
		$data['notice']	= $this->noticeboard_model->getNoticeById($id);
		$this->load->view('include/header',$data);
		$this->load->view('noticeboard/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
		//var_dump($this->input->post());
		//exit;		
		$this->form_validation->set_rules('noticeDate', 'Notice Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('noticeTitle', 'Notice Title', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('noticeboard/update/'.$this->input->post('id')); 
			 
		else:
			if($this->noticeboard_model->UpdateNoticeById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successtully Update Notice information');
					redirect('noticeboard/index');
				else:
			 
					redirect('noticeboard/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('noticeboard',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully Removed the Notice information!');
					redirect('noticeboard/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
					redirect('exams/index'); 
			endif;
			
		
	}
}	 