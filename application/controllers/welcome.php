<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 
	 
	public function __construct(){
		parent:: __construct();
		$this->load->model('welcome_model');
		//if($this->session->userdata('is_logged')){
			//redirect('dashboard');
		//}
	} 
	
	public function index()
	{
		
		$this->load->view('include/welcome_header');
		$this->load->view('welcome_message');
		$this->load->view('include/welcome_footer');
	}
	
	public function userlogin()
	{
		
		$this->load->view('include/welcome_header');
		$this->load->view('user_login');
		$this->load->view('include/welcome_footer');
	}
	
	public function login(){
		$data = $this->input->post();
		if($this->welcome_model->checkLogin($data)):
			redirect('dashboard');
		else:
			$this->session->set_flashdata('status_wrong', 'Provided information is not correct!');
			redirect('welcome/userlogin');
		endif;
		
	}
	
	/**
	 * Inner page render for User Registration
	 */
	 public function userregistration($insert_data=NULL){
	 	
		$data['form_data'] =  $insert_data;
		$data['page_title'] = 'User Registration';
		$this->load->view('include/welcome_header',$data);
	 	$this->load->view('user_registration');
		$this->load->view('include/welcome_footer');
	 }
	 
	/**
	 * Check valid mobile no.
	 */
	
	  public function operator_check($operator){
               $operators = array('011','015','016','017','018','019');
                $operator = substr($this->input->post('mobile'), 0,3);
                
               if (!in_array($operator, $operators))
				{
		                    
				    $this->form_validation->set_message('operator_check', 'The Mobile is not valid');
					//echo $operator."asdf";
					//exit;
					return FALSE;
				}
				else
				{
					return TRUE;
				} 
		}
	/**
	 * Create New user
	 */
	public function createuser(){
		
		$insert_data = $this->input->post();
		
		// validation check for Registration new users 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_emails');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[11]|max_length[11]|callback_operator_check');
		$this->form_validation->set_rules('type_id', 'User type', 'required|integer');
		$this->form_validation->set_rules('user_name', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'required');
		$this->form_validation->set_rules('agree', 'Your agreement', 'required');
	 	
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			//$this->session->set_flashdata('status_wrong',validation_errors() );
			$insert_data['er'] = 'Provided information on not valid!';
			$this->userregistration($insert_data);	
		else:
			//send insert_data to the model of database insert
			if($this->welcome_model->createUser($insert_data)):
				$this->session->set_flashdata('status_right', 'Registration Complete! wait for approval!');
				redirect('welcome/index');
			else:
				$insert_data['er'] =  'Sorry system is unable to preserve this info!';
				$this->userregistration($insert_data);
			endif;
		endif;	
		
		 
	}
	
	public function logout()
	{
		$this->session->unset_userdata('is_logged');
		if(!$this->session->userdata('is_logged')):
			 
			redirect('welcome/index');
	 
			
		endif;
		
	}

}

 