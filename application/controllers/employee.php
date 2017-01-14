<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->library(array('session','pagination','form_validation')); 
		$this->load->model('employee_model');
	}
	
	
	public function index(){
			
		$data['page_title'] = 'All Staff :: School management system';
		
		// pagination configaration: 
		$config['base_url'] = base_url() . 'teachers/index';
        $config['per_page'] = 10;
		$this->db->order_by("Id", "desc");
		$data['teachers'] = $this->employee_model->getAllTeachers($config['per_page'],$this->uri->segment(3));
        //get total number of teachers
        $data['total'] = $config['total_rows'] = $this->employee_model->getTotalTeacher();
         
		$config['full_tag_open']='<li>';
		$config['full_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '<li>';
		
        $this->pagination->initialize($config);		
			
		$this->load->view('include/header',$data);
		$this->load->view('employee/index');
		$this->load->view('include/footer');
	}
	public function create(){
		$data['departments'] = $this->db->get_where('departments', array('departmentStatus'=>1))->result();
		$data['designations'] = $this->db->get_where('designations', array('designationStatus'=>1))->result();
		
		$data['page_title'] = 'Create New Staff :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/create');
		$this->load->view('include/footer');
	}
	/**
	 * Check valid mobile no.
	 */
	
	public function operator_check($operator=Null){
		 
		
	  		$operator = $this->input->post('EmployeeMobile');
	  		//echo $operator;
         //   exit;
               $operators = array('011','015','016','017','018','019');
             	$operator = str_replace('-', '',$operator);
              	$operator =filter_var($operator, FILTER_SANITIZE_NUMBER_INT);
              
               $operator = substr($operator, 0,3);
                
               if (!in_array($operator, $operators))
				{
		                    
				    $this->form_validation->set_message('callback_operator_check', "The Mobile is not valid");
					 
					return FALSE;
				}
				else
				{
					return TRUE;
				}
                
                
	}
	
	 public function insert(){
	 	
		$insert_data = $this->input->post();
		 
		// validation check for Registration new users 
		$this->form_validation->set_rules('EmployeeName', 'Name', 'required');
		  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->create();
		else:
			//send insert_data to the model of database insert
			if($this->employee_model->createEmployee($insert_data)):
				$this->session->set_flashdata('status_right', 'Successfully Add a New Staff!');
				redirect('employee/index');
			else:
				$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
				redirect('employee/index');
			endif;
		endif;	
		
		 
	}
	 
	public function update($id){
		$data['departments'] = $this->db->get_where('departments', array('departmentStatus'=>1))->result();
		$data['designations'] = $this->db->get_where('designations', array('designationStatus'=>1))->result();	
		$data['employee'] = $this->employee_model->getTeacherById($id);	
		
		$data['page_title'] = 'Update Staff info :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
		 
		$update_data = $this->input->post();
		 
		// validation check for Registration new users 
		$this->form_validation->set_rules('EmployeeName', 'Name', 'required');
		$this->form_validation->set_rules('EmployeeMobile', 'Mobile', 'required|callback_operator_check');
		$this->form_validation->set_rules('EmployeeGender', 'Gender', 'required|integer');
		  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->update($this->input->post('id'));	
		else:
			//send insert_data to the model of database insert
			if($this->employee_model->updateEmployee($update_data)):
				$this->session->set_flashdata('status_right', 'Successfully Update Staff information!');
				redirect('employee/index');
			else:
			$this->session->set_flashdata('status_wrong', 'Sorry system is unable to modify this info!');
			 	redirect('employee/index');
			endif;
		endif;	
		
		 
	}
	
	public function delete(){
		$id = $this->input->post('employee_id');
		if($this->employee_model->deleteEmployee($id)):
			echo 'Successfully Deleted Student information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Student information!';
	  endif;
		
	}
	
	/**
	* Departments Part
	**/
	public function departments(){
			
		$data['departments'] = $this->db->get('departments');
		$data['page_title'] = 'Departments :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/departments');
		$this->load->view('include/footer');	
		
	}
	public function createdepartment(){ 
		 
		$data['page_title'] = 'Departments :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/create_department');
		$this->load->view('include/footer');	
		
	}
	
	public function insertdepartment(){
				$insert_data = $this->input->post();
			 
			// validation check forinserting designation 
			$this->form_validation->set_rules('departmentName', 'Department Name', 'required');
		  
			//check is form data valid of not
		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->createdepartment();
			else:
				//send insert_data to the model of database insert
				if($this->employee_model->createDepartment($insert_data)):
					$this->session->set_flashdata('status_right', 'Successfully Add a Staff\'s Designation!');
					redirect('employee/departments');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					//$this->designations();
					redirect('employee/departments');
				endif;
			endif;	
			
		}
		
	public function updatedepartment($id){
		$data['department'] = $this->employee_model->getDepartmentById($id);
		$data['page_title'] = 'Departments :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/update_department');
		$this->load->view('include/footer');
	}	
	public function editdepartment(){
			$update_data = $this->input->post();
			 
			 
			// validation check forinserting designation 
			$this->form_validation->set_rules('departmentName', 'Department Name', 'required');
		  
			//check is form data valid of not
		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->updatedepartment($update_data['id']);
			else:
				//send insert_data to the model of database insert
				if($this->employee_model->updateDepartment($update_data)):
					$this->session->set_flashdata('status_right', 'Successfully Updated a Department!');
					redirect('employee/departments');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to update this info!');
					//$this->designations();
					redirect('employee/departments');
				endif;
			endif;	
			
		}
		
	public function deletedepartment(){
		$id = $this->input->post('department_id');
		if($this->employee_model->deletedepartment($id)):
			echo 'Successfully Deleted Department information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Department information!';
	  endif;
		
	}
	
	/**
	* Designation Part
	**/
	
	public function designations(){
		//$this->db->group_by('employeeDepartmentId');
		$this->db->order_by("employeeDepartmentId", "asc");
		$data['designations'] = $this->db->get('designations');
		
		$data['departments'] =  $this->db->get('departments')->result();
		
		$data['page_title'] = 'Designations :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/designations');
		$this->load->view('include/footer');	
		
	}
	
	public function createdesignation(){
		
		$data['departments'] = $this->db->get_where('departments', array('departmentStatus'=>1));
		$data['page_title'] = 'Create Designation :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/create_designation');
		$this->load->view('include/footer');	 
	}
	
	public function insertdesignation(){
		$insert_data = $this->input->post();
		 
		// validation check forinserting designation 
		$this->form_validation->set_rules('designationName', 'Designation Name', 'required');
		//$this->form_validation->set_rules('employeeDepartmentId', 'Department Name', 'required'); 
	  
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->createdesignation();
		else:
			//send insert_data to the model of database insert
			if($this->employee_model->createDesignation($insert_data)):
				$this->session->set_flashdata('status_right', 'Successfully Add a Employee\'s Designation!');
				$this->designations();
			else:
				$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
				$this->designations();
			endif;
		endif;	
		
	}
	
	public function updatedesignation($id){
		$data['departments'] = $this->db->get_where('departments', array('departmentStatus'=>1));
		
		$data['designation'] = $this->employee_model->getDesignationById($id);
		
		$data['page_title'] = 'Designation :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/update_designation');
		$this->load->view('include/footer');
	}	
	public function editdesignation(){
			$update_data = $this->input->post();
			 
			// validation check forinserting designation 
				$this->form_validation->set_rules('designationName', 'Designation Name', 'required');
			//check is form data valid of not
		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->updatedesignation($update_data['id']);
			else:
				//send insert_data to the model of database insert
				if($this->employee_model->updateDesignation($update_data)):
					$this->session->set_flashdata('status_right', 'Successfully Updated a Designation!');
					redirect('employee/designations');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to update this info!');
					//$this->designations();
					redirect('employee/designations');
				endif;
			endif;	
			
		}
	
	public function deletedesignation(){
		$id = $this->input->post('designation_id');
		if($this->employee_model->deletedesignation($id)):
			echo 'Successfully Deleted Designation information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Designation information!';
	  endif;
		
	}
	
	
	public function getDesginationByDeptId( ){
		 
		$id = $this->input->post('deptId');
		$designations = $this->db->get_where('designations', array('employeeDepartmentId'=>$id))->result();
		 
		$des_list[] = '---select designations---';
		foreach(@$designations as $des):
			$des_list[@$des->Id] = @$des->designationName;
		endforeach;
	 	echo form_dropdown('EmployeeDesignationId', $des_list);
		
	}
	public function makecommittee(){
		$data['staffs'] = $this->db->get('employee');
		$data['page_title'] = 'Make Committee :: School management system';
		$this->load->view('include/header',$data);
		$this->load->view('employee/committee_member');
		$this->load->view('include/footer');
	}	
}	
	