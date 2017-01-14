<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('noticeboard_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		} 
	} 
	
	public function index(){
		$data['page_title'] = 'Dashboard::School management system';
		$data['notices']=$this->noticeboard_model->getAllNotice();
		$this->load->view('include/header',$data);
		$this->load->view('dashboard');
		$this->load->view('include/footer');
	}
}