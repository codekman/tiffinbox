<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Examresult extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('examresult_model');
		if(!$this->session->userdata('is_logged')){
			redirect('welcome');
		}
	}
	
	public function index(){
		$data['page_title'] = 'Exams :: School management system';
		$data['exams']=$this->examresult_model->getAllExams();
		$this->load->view('include/header',$data);
		$this->load->view('result/index');
		$this->load->view('include/footer');
		
	}
	public function create(){
		$data['page_title'] = 'Marks entry :: School management system';
		$data['exams']=$this->examresult_model->getAllExams();
		$this->load->view('include/header',$data);
		$this->load->view('result/create');
		$this->load->view('include/footer');
		
	}
	
	public function insert(){
		$this->form_validation->set_rules('examName', 'Exam Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('examDate', 'Exam Date', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('exams/create'); 
			 
		else:
			if($this->examresult_model->CreateNewExam($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successfull Update New Exam!');
					redirect('exams/index');
				else:
				  $this->session->set_flashdata('status_wrong', 'Sorry system is unable to preserve this info!');
					redirect('exams/create'); 
			endif;
		endif;
	}
	
	public function update($id){
			
		$data['page_title'] = 'Update Exam :: School management system';
		$data['exam']	= $this->examresult_model->getExamById($id);
		$this->load->view('include/header',$data);
		$this->load->view('exams/update');
		$this->load->view('include/footer');
	}
	
	public function edit(){
		//var_dump($this->input->post());
		//exit;		
		$this->form_validation->set_rules('examName', 'Exam Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('examDate', 'Exam Date', 'trim|required|xss_clean');
		
		//check is form data valid of not
	 	if ($this->form_validation->run() == FALSE):
	 		 
			$this->session->set_flashdata('status_wrong',validation_errors() );
			redirect('exams/update/'.$this->input->post('id')); 
			 
		else:
			if($this->examresult_model->UpdateExamById($this->input->post())):
				$this->session->set_flashdata('status_right', 'Successtully Update Exam information');
					redirect('exams/index');
				else:
			 
					redirect('exams/index'); 
			endif;
		endif;	
		
	}
	
	public function delete($id){
				
		$this->db->delete('exams',array('Id'=>$id));
		if($this->db->affected_rows()):
					$this->session->set_flashdata('status_right', 'Successfully Removed the Exam information!');
					redirect('exams/index');
				else:
				  	$this->session->set_flashdata('status_wrong', 'Sorry system is unable to Remove this info!');
					redirect('exams/index'); 
			endif;
			
		
	}
	
	public function getSubject(){
			
		 $cls_id = $this->input->post('class_id');
		$subject[''] = '---Select Subject First---';
		foreach($this->db->get_where('subjects', array('SubjectStatus'=>1,'SubjectClassId'=>$cls_id))->result() as $sub):
			$subject[$sub->Id]	= $sub->SubjectName.' :: '.$sub->SubjectCode;
		endforeach;
		echo form_dropdown('class',$subject,'','id="subjectId" onchange="subjectSelection()"');
	}
	public function getStudent(){
		 //var_dump($this->input->post());
		$cls_id = $this->input->post('class_id');
		$exam_id = $this->input->post('exam_id');
		 
		$this->db->select('*');
		$this->db->join('studentdetails', 'studentdetails.Id=studentinfo.StdDetailsId');
		$this->db->where('StdClassId',$cls_id);
		$query = $this->db->get('studentinfo');
	 
	 
		$html = '<table class="table table-striped table-bordered table-hover">
						<tr>
							<td>Student ID</td>
							<td>Student Name</td>
							<td>mark obtained(out of 100)</td>
							<td>attendance</td>
							<td>Comment</td>
							<td>Oparations</td>
						</tr>';
		foreach($query->result() as $std):
			$this->db->select('Id,marksObtained,attendance,comment');
			$sql = $this->db->get_where('examresult', array('studentId'=>$std->StdDetailsId,'examId'=>$exam_id,'classId'=>$cls_id));
			//echo $this->db->last_query();
					$html .='<tr>
								<td>'.$std->StdCurrentId.'</td>
								<td>'.$std->StdName.'</td>
								<td>
									<input type="text" id="marks'.@$std->StdDetailsId.'" value="'.@$sql->row()->marksObtained.'" class="spinner3 input-mini spinner-input" style="width: 30px;" maxlength="3">
								</td>
								<td>
									<input type="text" id="attendance'.@$std->StdDetailsId.'" value="'.@$sql->row()->attendance.'" class="spinner3 input-mini spinner-input" style="width: 30px;" maxlength="3">
								</td>
								<td>
								<textarea class="span12" id="comment'.@$std->StdDetailsId.'" placeholder="Comments">'.@$sql->row()->comment.'</textarea>
								
								</td>
								<td  id="UpdateBtn'.$std->StdDetailsId.'"><input type="button" value="update" onclick="upadateStdResult(\''.@$sql->row()->Id.'\','.$std->StdDetailsId.')"/></td>
							</tr>';
		endforeach;
		$html .= '</table>';
		$html .= '</div>  
				<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
						Update All Student Result
				</button>';
			 
		echo $html;
		 
	}
	public function insertStdResult(){
		 
		
		$insert_data = array(
						'examId' => $this->input->post('exam_id'),
						'classId' => $this->input->post('class_id'),
						'subjectId' => $this->input->post('subject_id'),
						'studentId' => $this->input->post('Std_id'),
						'marksObtained' => $this->input->post('marks'),
						'attendance' => $this->input->post('attend'),
						'comment' => $this->input->post('comment')
					);	
		$this->db->insert('examresult', $insert_data);
		if($this->db->affected_rows()):
			echo $this->db->insert_id();
		else:
			echo 0;
		endif;
	}
	public function upadateStdResult(){
		
		$result_id = $this->input->post('result_id');
		$marks = $this->input->post('marks');
		$attend = $this->input->post('attend');
		$comment = $this->input->post('comment');
 	
		$this->db->where('Id',$result_id);
		$this->db->update('examresult',array('marksObtained'=>$marks,'attendance'=>$attend,'comment'=>$comment));
		
		if($this->db->affected_rows()):
			echo 1;
		else:
			echo 0;
		endif;
		
	}
	 
}	 