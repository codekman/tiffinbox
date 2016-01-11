<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_Model extends CI_Model {

	public function __construct()
	{
		$this->load->library('session');
	}
	public function getStudent(){
		$date = date('Y-m-d', strtotime($this->input->post('date'))); 
		$this->db->select('*');
		$this->db->from('studentinfo as info');
		$this->db->join('studentdetails as detail', 'info.StdDetailsId = detail.Id');
		$this->db->join('classes', 'classes.Id = info.StdClassId','LEFT');
		$this->db->join('sections', 'sections.Id = info.StdSectionId','LEFT');
		if($this->input->post('date')!='') {
			//$this->db->join('attendance', 'info.StdDetailsId = attendance.rollNo and classes.Id= attendance.classId','LEFT');, 'attendance.date'=>$date
		} 
		($this->input->post('classId')!='') ? $this->db->where(array('info.StdClassId'=>$this->input->post('classId'))) : '';
		$this->db->order_by('StdRollNo', 'asc'); 
		//$this->db->get();
		//echo $this->db->last_query();
		//exit;
		return  $this->db->get();
		  
	}
	
	 
}