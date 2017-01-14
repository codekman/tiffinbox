<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounting_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	public function createExpense($data){
		$data['date'] = date('Y-m-d', strtotime($data['date']));
		return $this->db->insert('expenses', $data);
	}
	public function updateExpense($data){
		$id = $data['id'];
		unset($data['id']);
		$data['date'] = date('Y-m-d', strtotime($data['date']));
		$this->db->where('Id', $id);

		return $this->db->update('expenses', $data);
	}
	public function deleteExpense($id){
		return $this->db->delete('expenses', array('Id'=>$id));
	}
	public function createCategory($data){
		return $this->db->insert('expense_category', $data);
	}

	public function getexpenseCategoryById($id){
		return $this->db->get_where('expense_category', array('Id'=>$id));
	}

	public function updateexpenseCategory($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('Id', $id);
		return $this->db->update('expense_category', $data);
	}
	public function deleteexpenseCategory($id){
		return $this->db->delete('expense_category', array('Id'=>$id));
	}

	#payment part
	public function getPayments(){
		$this->db->select('studentdetails.StdName,
		studentinfo.StdRollNo,
		SUM(`payment_history`.paidAmount) AS paidAmount');
		$this->db->from('payment');
		$this->db->join('payment_history', 'payment.Id=payment_history.paymentId');
		$this->db->join('studentdetails', 'studentdetails.Id=payment.studentId');
		$this->db->join('studentinfo', 'studentdetails.Id=studentinfo.StdDetailsId');
		$this->db->join('classes', 'classes.Id=payment.classId');
		$this->db->group_by('payment.studentId, studentinfo.StdRollNo');
		return $this->db->get();
	}

	public function createPayment($data){
		$payment_data = array(
			'paymentTitle' 	=> $data['paymentTitle'],
			'paymentDetails'=> $data['paymentDetails'],
			'paymentType'	=> $data['paymentType'],
			'classId'		=> $data['classId'],
			'totalAmount'	=> $data['totalAmount'],
			'createdDate'	=> date('Y-m-d', strtotime($data['createdDate'])),
			'status'		=> $data['status']
		);
		foreach ($data['student'] as $key => $value) {
			$payment_data['studentId'] = $value;
			if($this->db->insert('payment', $payment_data)){
				$history_data = array(
					'paymentId'		=> $this->db->insert_id(),
					'paidAmount'	=> $data['paidAmount'],
					'paymentDate'	=> date('Y-m-d', strtotime($data['createdDate'])),
					'medium'		=> $data['medium'],
				);
				$this->db->insert('payment_history',$history_data);
			}
		}
		return TRUEs;
	}
	public function updatePayment($data){
		$payment_data = array(
			'paymentTitle' 	=> $data['paymentTitle'],
			'paymentDetails'=> $data['paymentDetails'],
			'paymentType'	=> $data['paymentType'],
			'classId'		=> $data['classId'],
			'totalAmount'	=> $data['totalAmount'],
			'createdDate'	=> date('Y-m-d', strtotime($data['createdDate'])),
			'status'		=> $data['status']
		);

		foreach ($data['paidAmount'] as $key => $value) {
			$this->db->where('Id', $data['id']);
			if($this->db->update('payment', $payment_data)){
				$history_data = array(
					'paymentId'		=> $data['id'],
					'paidAmount'	=> $value,
					'paymentDate'	=> date('Y-m-d', strtotime($data['paymentDate'][$key])),
					'medium'		=> $data['medium'][$key],
				);
				$this->db->where('Id', $data['id']);
				$this->db->update('payment_history',$history_data);

			}

		}

		return TRUE;
	}
}
