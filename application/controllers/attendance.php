<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('attendance_model');
	} 
	
	public function index(){
		if($this->input->post()){
			$data['page_title'] = 'Students Attendance:: School management system';
			$data['student']= $this->attendance_model->getStudent();
			$this->load->view('include/header',$data);
			$this->load->view('attendance/index');
			$this->load->view('include/footer');
		}else{
			$data['page_title'] = 'Students Attendance:: School management system';
			$this->load->view('include/header',$data);
			$this->load->view('attendance/index');
			$this->load->view('include/footer');
		}
				
	}
	public function create(){
		$data['page_title'] = 'Create Student :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('students/create');
		$this->load->view('include/footer');
	}
	
	public function insert(){
		$roll = $this->input->post('roll');
		$attendace = $this->input->post('attendance');
		$date = $this->input->post('date');
		$class = $this->input->post('class');
		foreach($roll as $key=>$value){
			if(@$attendace[$key]){
				$data = array(
					'date'=>$date,
					'classId'=>$class,
					'rollNo'=>$key,
					'status'=>1
				);
				$this->db->insert('attendance',$data);
			}else{
					$data = array(
					'date'=>$date,
					'classId'=>$class,
					'rollNo'=>$key,
					'status'=>0
				);
				$this->db->insert('attendance',$data);
			}
		}
		 redirect('attendance/index');
	}
	 
	
	 
	
}	