<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('setting_model');
	} 
	
	 
	
	 function index(){
	 	$data['infos']=$this->db->get('setting');
		$this->load->view('include/header',$data);
		$this->load->view('setting');		
		$this->load->view('include/footer');		
	 }
	 
	 function config(){
	 	$data = $this->input->post();
	 	if($this->setting_model->insert($data)){
	 		$this->session->set_flashdata('status_right', 'Successtully Update information');
	 		redirect('setting/index');	
	 	}else{
	 		$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
			redirect('setting/index');
	 	}  
		
	 }
	
}	