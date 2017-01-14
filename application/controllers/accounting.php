<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounting extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library(array('session','pagination','form_validation'));
		$this->load->model('accounting_model');
	}

	public function expenses(){

		$data['expenses'] = $this->db->get('expenses');
		$data['expense_categories'] =  $this->db->get('expense_category');
		$data['page_title'] = 'Expenses :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/expenses');
		$this->load->view('include/footer');

	}

	public function create_expense(){

		$data['expense_categories'] =  $this->db->get('expense_category');
		$data['page_title'] = 'Create Expense :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/create_expense');
		$this->load->view('include/footer');
	}

	public function insert_expense(){
		$insert_data = $this->input->post();
		// validation check forinserting designation
		$this->form_validation->set_rules('amount', 'Expense Amount', 'required');
		$this->form_validation->set_rules('title', 'Expense Title', 'required');

		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			$this->create_expense();
		else:
			//send insert_data to the model of database insert
			if($this->accounting_model->createExpense($insert_data)):
				$this->session->set_flashdata('status_right', 'Successfully Add a New Expense!');
				redirect('accounting/expenses');
			else:
				$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
				redirect('accounting/expenses');
			endif;
		endif;

	}

	public function update_expense($id){
		$data['expense'] = $this->db->get_where('expenses', array('Id'=>$id));
		$data['expense_categories'] =  $this->db->get('expense_category');
		$data['page_title'] = 'Update Expense :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/update_expense');
		$this->load->view('include/footer');
	}
	public function edit_expense(){
			$update_data = $this->input->post();
			// validation check forinserting designation
			$this->form_validation->set_rules('amount', 'Expense Amount', 'required');
			$this->form_validation->set_rules('title', 'Expense Title', 'required');

		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->update_expense($update_data['id']);
			else:
				//send insert_data to the model of database insert
				if($this->accounting_model->updateExpense($update_data)):
					$this->session->set_flashdata('status_right', 'Successfully Updated a Expense!');
					redirect('accounting/expenses');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to update this info!');
					//$this->designations();
					redirect('accounting/expenses');
				endif;
			endif;

		}

	public function delete_expense(){
		$id = $this->input->post('expense_id');
		if($this->accounting_model->deleteExpense($id)):
			echo 'Successfully Deleted Expense information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Expense information!';
	  endif;

	}
	public function expense_categories(){

			$data['category'] = $this->db->get_where('expense_category', array('status'=>1));
			$data['page_title'] = 'Expense Category :: School Management System';
			$this->load->view('include/header',$data);
			$this->load->view('accounting/expense_categories');
			$this->load->view('include/footer');
	}
	public function createcategory(){

		$data['page_title'] = 'Expense Category :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/create_expense_category');
		$this->load->view('include/footer');

	}

	public function insertcategory(){
			$insert_data = $this->input->post();

			// validation check forinserting designation
			$this->form_validation->set_rules('categoryName', 'Category Name', 'required');

			//check is form data valid of not
		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->createcategory();
			else:
				//send insert_data to the model of database insert
				if($this->accounting_model->createCategory($insert_data)):
					$this->session->set_flashdata('status_right', 'Successfully Add a expense Category!');
					redirect('accounting/categories');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					//$this->designations();
					redirect('accounting/expense_categories');
				endif;
			endif;

		}

	public function update_expensecategory($id){
		$data['category'] = $this->accounting_model->getexpenseCategoryById($id);
		$data['page_title'] = 'Update expense Category :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/update_expense_category');
		$this->load->view('include/footer');
	}
	public function edit_expensecategory(){
			$update_data = $this->input->post();
			 // validation check forinserting designation
			$this->form_validation->set_rules('categoryName', 'Category Name', 'required');

			//check is form data valid of not
		 	if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				$this->update_expensecategory($update_data['id']);
			else:
				//send insert_data to the model of database insert
				if($this->accounting_model->updateexpenseCategory($update_data)):
					$this->session->set_flashdata('status_right', 'Successfully Updated a expense Category!');
					redirect('accounting/expense_categories');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to update this info!');
					//$this->designations();
					redirect('accounting/expense_categories');
				endif;
			endif;

		}

	public function delete_expensecategory(){
		$id = $this->input->post('category_id');
		if($this->accounting_model->deleteexpenseCategory($id)):
			echo 'Successfully Deleted Category information!';
	  else:
	  	echo 'Sorry! Systen is Unable to Deleted Category information!';
	  endif;

	}
	#payment part:

	public function payments(){
		$data['payments'] = $this->accounting_model->getPayments();
 		$data['page_title'] = 'Payments :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/payments');
		$this->load->view('include/footer');
	}
	public function create_payment(){
 		$data['page_title'] = 'Add Payments :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/create_payment');
		$this->load->view('include/footer');

	}
	public function insertpayment(){
		$insert_data = $this->input->post();
			// validation check forinserting designation
			$this->form_validation->set_rules('paymentTitle', 'Payment Title', 'required');
			$this->form_validation->set_rules('paymentType', 'Payment Type', 'required');
			if($insert_data['paymentType']==1){
				$this->form_validation->set_rules('classId', 'Class', 'required');
				if(!$insert_data['student']){
					$this->form_validation->set_rules('student[]', 'Add atleast one student', 'required');
				}
			}
			$this->form_validation->set_rules('totalAmount', 'Total Amount', 'required');
			$this->form_validation->set_rules('createdDate', 'Payment Created Date', 'required');
			$this->form_validation->set_rules('status', 'Payment Status', 'required');
				//check is form data valid of not
			if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				redirect('accounting/create_payment');
			else:
				//send insert_data to the model of database insert
				if($this->accounting_model->createPayment($insert_data)):
					$this->session->set_flashdata('status_right', 'Successfully Add a Payement!');
					redirect('accounting/payments');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					//$this->designations();
					redirect('accounting/create_payment');
				endif;
			endif;

	}
	public function update_payment($id){
		$data['payment'] = $this->db->get_where('payment', array('Id'=>$id));
		$data['payment_history'] =  $this->db->get_where('payment_history', array('paymentId'=>$id));
		$data['page_title'] = 'Update Payment :: School Management System';
		$this->load->view('include/header',$data);
		$this->load->view('accounting/update_payment');
		$this->load->view('include/footer');
	}
	public function editpayment(){
		$update_data = $this->input->post();
			// validation check forinserting designation
			$this->form_validation->set_rules('paymentTitle', 'Payment Title', 'required');
			$this->form_validation->set_rules('paymentType', 'Payment Type', 'required');
			if($update_data['paymentType']==1){
				$this->form_validation->set_rules('classId', 'Class', 'required');
				if(!$update_data['student']){
					$this->form_validation->set_rules('student[]', 'Add atleast one student', 'required');
				}
			}
			$this->form_validation->set_rules('totalAmount', 'Total Amount', 'required');
			$this->form_validation->set_rules('createdDate', 'Payment Created Date', 'required');
			$this->form_validation->set_rules('status', 'Payment Status', 'required');
				//check is form data valid of not
			if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('status_wrong',validation_errors() );
				redirect('accounting/update_payment/'.$update_data['id']);
			else:
				//send update_data to the model of database insert
				if($this->accounting_model->updatePayment($update_data)):
					$this->session->set_flashdata('status_right', 'Successfully Update of this Payement!');
					redirect('accounting/payments');
				else:
					$this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					//$this->designations();
					redirect('accounting/update_payment/'.$update_data['id']);
				endif;
			endif;

		}
	public function takenewpayment(){
		$data = $this->input->post();
		$data['paymentDate'] = date('Y-m-d',strtotime($data['paymentDate']));
		$this->db->insert('payment_history', $data);
		redirect('accounting/payments');
	}
	public function deletePayment(){
		$paymentId = $this->input->post('payment_id');
		$this->db->delete('payment', array('Id' => $paymentId));
		$this->db->delete('payment_history', array('paymentId' => $paymentId));
		redirect('accounting/payments');
	}
	#--ajax response:
	public function getPaymentdetails(){
	  	$paymentId = $this->input->post('payment_id');
		$this->db->select('studentdetails.StdName,studentdetails.StdContactNo,
		payment.Id,payment.paymentTitle,payment.paymentDetails,payment.createdDate,payment.totalAmount,payment.status,
		classes.ClassName,classes.ClassNumaricName,studentinfo.StdRollNo,
		payment_history.paidAmount, payment_history.medium,payment_history.paymentDate');
		$this->db->from('payment');
		$this->db->join('payment_history', 'payment.Id=payment_history.paymentId');
		$this->db->join('studentdetails', 'studentdetails.Id=payment.studentId');
		$this->db->join('studentinfo', 'studentdetails.Id=studentinfo.StdDetailsId');
		$this->db->join('classes', 'classes.Id=payment.classId');
		$this->db->where('payment.Id',$paymentId);
		$data['payment'] = $this->db->get();
		$html = $this->load->view('accounting/template/invoice',$data);;
		echo $html;
	}

	public function getStudentByClassId(){
		$classId = $this->input->post('class_id');
		$this->db->select('studentdetails.Id,studentdetails.StdName, studentinfo.StdDetailsId,studentinfo.StdRollNo, classes.ClassName');
		$this->db->from('studentdetails');
		$this->db->join('studentinfo','studentinfo.StdDetailsId=studentdetails.Id');
		$this->db->join('classes','classes.Id=studentinfo.StdClassId');
		$this->db->where('studentinfo.StdClassId',$classId);
		$data['students'] = $this->db->get();
		$html = $this->load->view('accounting/template/student',$data);;
		echo $html;
	}
	public function getClasses(){
		$classes = $this->db->get_where('classes', array('ClassStatus'=>1));
		$options[] = '---Select Class---';
		 foreach($classes->result() as $class){
		 	$options[$class->Id] = $class->ClassName;
		 }
		 echo '<label class="control-label" for="form-field-11">
			Class <span class="red">* </span>:
		</label><div class="controls" id="Classdiv">';
		 echo form_dropdown('classId', $options,'','id="classNamediv"');
		 echo '</div> ';
	}

	public function getPaymentForm(){
		$paymentId = $this->input->post('payment_id');
		$this->db->select('payment.Id,payment.paymentTitle,payment.paymentDetails,payment.createdDate,payment.totalAmount,payment.status,
		payment_history.paidAmount, payment_history.medium,payment_history.paymentDate');
		$this->db->from('payment');
		$this->db->join('payment_history', 'payment.Id=payment_history.paymentId');
		$this->db->where('payment.Id',$paymentId);
		$data['payment_history'] = $this->db->get();
		$html = $this->load->view('accounting/template/takepayment',$data);;
		echo $html;
	}

}
