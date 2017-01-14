<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library(array('session','pagination','form_validation')); 
		$this->load->model('accounting_model');
	}
	public function books(){
		$data['page_title'] = 'All Book :: School Management System';
		$data['book']=$this->db->get('book');
		$this->load->view('include/header',$data);
		$this->load->view('library/books');
		$this->load->view('include/footer');
	}
	public function newbook(){
		$data['page_title'] = 'Add New Book :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('library/create_book');
		$this->load->view('include/footer');
	}
	public function insertbook(){
		$data = $this->input->post();
		$this->form_validation->set_rules('name', 'Book Name', 'required');
		$this->form_validation->set_rules('price', 'Book Price', 'required');
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE){
	 		$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('library/newbook');
	 	}else{
	 		$this->db->insert('book', $data);
		 	 redirect('library/books');
		} 
	}
	 public function updatebook($id){
	 	$data['book'] = $this->db->get_where('book', array('Id'=>$id));
		$data['page_title'] = 'Update Book :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('library/update_book');
		$this->load->view('include/footer');
	}
	public function editbook(){
		$data = $this->input->post();
		$this->form_validation->set_rules('name', 'Book Name', 'required');
		$this->form_validation->set_rules('price', 'Book Price', 'required');
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE){
	 		$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('library/newbook');
	 	}else{
	 		$id = $data['id'];
			unset($data['id']);
	 		$this->db->where('Id', $id);
	 		$this->db->update('book', $data);
		 	 redirect('library/books');
		} 
	}
	public function deletebook($id){
		$this->db->delete('book', array('Id'=>$id));
		
		redirect('library/books');
	}
	public function newissue($id){
		$data['book']=$this->db->get_where('book',array('Id'=>$id));
		$this->load->view('include/header',$data);
		$this->load->view('library/create_issue', $data);
		$this->load->view('include/footer');
		 
	}
	public function issuebook(){
		$data  = $this->input->post();
		if($data['userType']==1){
			$this->form_validation->set_rules('student', 'Student', 'required');
		}else{
			$this->form_validation->set_rules('staff', 'Staff', 'required');
		}
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE){
	 		$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('library/newissue/'.$data['bookId']);
	 	}else{
	 		
	 		$insert_data = array(
				'bookId'		=>$data['bookId'],
				'issueFor'		=>($data['userType']==1) ? $data['student'] : $data['staff'],
				'userType'		=>$data['userType'],
				'issuedate'		=>date('Y-m-d',strtotime($data['issuedate'])),
				'issueTill'		=>date('Y-m-d',strtotime($data['issueTill'])),
				'note'			=>$data['note'],
				'status'		=>0
			);
	 		$this->db->insert('book_issue', $insert_data);
			$this->db->where('Id', $data['bookId']);
			$this->db->update('book', array('status'=>0));
		 	redirect('library/issuedbook');
		} 
		 
	}
	public function issuedbook(){
		$data['page_title'] = 'All Issued Book :: School Management System';
		$this->db->select('book.Id AS Id,
							book.name,
							book.author,
							book.description,
							book.price,
							book_issue.Id AS issueId,
							book_issue.issueFor,
							book_issue.userType,
							book_issue.issuedate,
							book_issue.issueTill,
							book_issue.note');
		$this->db->from('book');
		$this->db->join('book_issue', 'book.Id = book_issue.bookId');
		//$this->db->join('studentdetails', 'book_issue.issueFor=studentdetails.Id AND book_issue.userType=1');
		//$this->db->join('studentinfo', 'studentinfo.StdDetailsId=studentdetails.Id AND book_issue.userType=1');
		//$this->db->join('employee', 'book_issue.issueFor=employee.Id AND book_issue.userType=2');
		$this->db->where(array('book.status'=>0,'book_issue.status'=>0));
		$data['book']=$this->db->get();
		$this->load->view('include/header',$data);
		$this->load->view('library/issued_book');
		$this->load->view('include/footer');
	}
	
	public function returnbook($id){
		$this->db->where('Id',$id);
		$this->db->update('book_issue', array('status'=>1));
		//get bookId
		$bookId = $this->db->get_where('book_issue', array('Id'=>$id))->row()->bookId;
		$this->db->where('Id',$bookId);
		$this->db->update('book', array('status'=>1));
		redirect('library/issuedbook');
	}
	public function updateissue($id){
		$data['page_title'] = 'All Issued Book :: School Management System';
		$this->db->select('book.Id AS Id,
							book.name,
							book.author,
							book.description,
							book.price,
							book_issue.Id AS issueId,
							book_issue.issueFor,
							book_issue.userType,
							book_issue.issuedate,
							book_issue.issueTill,
							book_issue.note');
		$this->db->from('book');
		$this->db->join('book_issue', 'book.Id = book_issue.bookId');
		//$this->db->join('studentdetails', 'book_issue.issueFor=studentdetails.Id AND book_issue.userType=1');
		//$this->db->join('studentinfo', 'studentinfo.StdDetailsId=studentdetails.Id AND book_issue.userType=1');
		//$this->db->join('employee', 'book_issue.issueFor=employee.Id AND book_issue.userType=2');
		$this->db->where(array('book.status'=>0,'book_issue.status'=>0,'book_issue.Id'=>$id ));
		$data['book']=$this->db->get();
		 
		$this->load->view('include/header',$data);
		$this->load->view('library/update_issue');
		$this->load->view('include/footer');
	}
	public function editissue(){
		$data  = $this->input->post();
		 
		if($data['userType']==1){
			$this->form_validation->set_rules('student', 'Student', 'required');
		}else{
			$this->form_validation->set_rules('staff', 'Staff', 'required');
		}
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE){
	 		$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('library/updateissue/'.$data['issue_id']);
	 	}else{
	 		
	 		$update_data = array(
				'bookId'		=>$data['bookId'],
				'issueFor'		=>($data['userType']==1) ? $data['student'] : $data['staff'],
				'userType'		=>$data['userType'],
				'issuedate'		=>date('Y-m-d',strtotime($data['issuedate'])),
				'issueTill'		=>date('Y-m-d',strtotime($data['issueTill'])),
				'note'			=>$data['note'],
				'status'		=>0
			);
			$this->db->where('Id',$data['issue_id']);
	 		$this->db->update('book_issue', $update_data);
			
			$this->db->where('Id', $data['bookId']);
			$this->db->update('book', array('status'=>0));
		 	redirect('library/issuedbook');
		}
	}
	public function deleteissue($id){
		//get bookId
		$bookId = $this->db->get_where('book_issue', array('Id'=>$id))->row()->bookId;
		$this->db->delete('book_issue', array('Id'=>$id));
		$this->db->where('Id', $bookId);
		$this->db->update('book', array('status'=>1));
		redirect('library/issuedbook');
	}
	public function duereport(){
		$data['page_title'] = 'All Issued Book :: School Management System';
		$this->db->select('book.Id AS Id,
							book.name,
							book.author,
							book.description,
							book.price,
							book_issue.Id AS issueId,
							book_issue.issueFor,
							book_issue.userType,
							book_issue.issuedate,
							book_issue.issueTill,
							book_issue.note');
		$this->db->from('book');
		$this->db->join('book_issue', 'book.Id = book_issue.bookId');
		$this->db->where(array('book.status'=>0,'book_issue.status'=>0,'book_issue.issueTill < '=> date('Y-m-d')));
		$data['book']=$this->db->get();
		$this->load->view('include/header',$data);
		$this->load->view('library/due_book');
		$this->load->view('include/footer');
		 
	}
	
	
	#ajax:
	public function getStudentByClassId(){
		$classId = $this->input->post('class_id');
		$this->db->select('studentdetails.Id,studentdetails.StdName, studentinfo.StdDetailsId,studentinfo.StdRollNo, classes.ClassName');
		$this->db->from('studentdetails');
		$this->db->join('studentinfo','studentinfo.StdDetailsId=studentdetails.Id');
		$this->db->join('classes','classes.Id=studentinfo.StdClassId');
		$this->db->where('studentinfo.StdClassId',$classId);
		$data['students'] = $this->db->get();
		$html = $this->load->view('library/template/student',$data);;
		echo $html;
	}
	public function getDept(){
		$department = $this->db->get('departments');
		$options[] = '---Select Department---';
		 foreach($department->result() as $dept){
		 	$options[$dept->Id] = $dept->departmentName;
		 }
		 echo '<label class="control-label" for="form-field-11">
			Department <span class="red">* </span>:
		</label><div class="controls" id="Classdiv">';
		 echo form_dropdown('deptId', $options,'','id="deptNamediv"');
		 echo '</div> ';
	}
	public function getStaffByDeptId(){
		$deptId = $this->input->post('dept_id');
		$data['staffs'] = $this->db->get_where('employee', array('EmployeeDeptId'=>$deptId));
		$html = $this->load->view('library/template/staff',$data);;
		echo $html;
	}
}