<script type="text/javascript">
$( document ).ready(function() {
	$(".IssueType").click(function()
	{ 
		 
		if($(this).val()==1){
			 
			$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>accounting/getClasses",
		 
		})
		  .done(function( data ) {
		  	$("#classes").html(data);
		    //console.log( "Data Saved: " + data );
		  });
			$("#departments").html('');
			$("#Staffs").html('');
		}else{
			$.ajax({
		  	method: "POST",
		  	url: "<?php echo base_url();?>library/getDept",
		 
			})
		 	 .done(function( data ) {
		  		$("#departments").html(data);
		    	//console.log( "Data Saved: " + data );
		  });
			$("#classes").html('');
			//$("#Classdiv").addClass('hide');
			$("#students").html('');
		}
	    
	});
	$( "#classes" ).delegate( "#classNamediv", "change", function(){
		var class_id = this.value;
		//get students of this class:
		$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>library/getStudentByClassId",
		  data: { class_id: class_id }
		})
		  .done(function( data ) {
		  	$("#students").html(data);
		  });
	});
	$( "#departments" ).delegate( "#deptNamediv", "change", function(){
		var dept_id = this.value;
		//get staff of this dept.:
		$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>library/getStaffByDeptId",
		  data: { dept_id: dept_id }
		})
		  .done(function( data ) {
		  	$("#Staffs").html(data);
		  });
	});
	
	$( "#students" ).delegate( "#checkAll", "change", function() {
	   if($(this).is(':checked')){
	   		$('.std').prop('checked',true);
	   }else{
	   		$('.std').prop('checked',false);
	   }	
	});
});	
</script>
<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<a href="<?php echo base_url();?>library/issuedbook">
					<button class="btn btn-primary pull-right">
						<i class="icon-cogs bigger-125"></i>
						Manage Issued Book
					</button>
				</a>	
		<h3 class="grey lighter position-relative">
			<i class="icon-book green"></i>
			Update Book Issue
		</h3>
		<hr/>	
		<?php echo form_open_multipart(base_url().'library/editissue','class="form-horizontal"'); ?>
		
			<?php foreach($book->result() as $row): ?>
				<?php
					if($row->userType==1){
						$std='checked';
						$oth='';
					}else{
						$std='';
						$oth='checked';
					}
				?>
				<div class="well">  
						<h4>Book Details :<span class="red pull-right"><?php echo $row->name;?></span></h4>
						<span class="red pull-right"><?php echo $row->description;?></span>
				</div>
				<?php 
				echo form_hidden('bookId', $row->Id);
				echo form_hidden('issue_id', $row->issueId);
				?>
			
			<div class="row-fluid span6">
				<div class="control-group">
						<label class="control-label" >
						Issue Type <span class="red">* </span>:
						</label>
						<div class="controls">
							<label class="span6">
								<input id="form-field-radio1" name="userType" <?php echo $std; ?> class="IssueType" value="1" type="radio">
								<span class="lbl" for="form-field-radio1"> For Student</span>
							</label>
							<label class="span6">
								<input id="form-field-radio2" name="userType" <?php echo $oth; ?> class="IssueType" value="2" type="radio">
								<span class="lbl" for="form-field-radio2"> For Other Staff</span>
							</label>
						</div>
				</div>
				<div class="control-group" id="classes"> 
						<?php
						 
						if($this->input->post('userType')==1 || $row->userType ==1){
							//get student information	
							$this->db->select('studentdetails.Id,studentdetails.StdName, studentinfo.StdDetailsId,studentinfo.StdClassId,studentinfo.StdRollNo');
							$this->db->from('studentdetails');
							$this->db->join('studentinfo','studentinfo.StdDetailsId=studentdetails.Id');
							$this->db->where('studentinfo.StdDetailsId',$row->issueFor);
							$std = $this->db->get();
							$classId = $std->row()->StdClassId;
							$rollNo = $std->row()->StdRollNo;
							
							echo '<label class="control-label" for="form-field-11">
								Class <span class="red">* </span>:
							</label><div class="controls" id="Classdiv">';
							$classes = $this->db->get_where('classes', array('ClassStatus'=>1));
							$options[] = '---Select Class---';
							 foreach($classes->result() as $class){
							 	
							 	$options[$class->Id] = $class->ClassName;
							 }
							 echo form_dropdown('classId', $options,$classId,'id="classNamediv" readonly' );
							 echo '</div> ';
						}
							 
						?>
				</div>
				<div class="control-group" id="departments"> 
						<?php
						 
						if($this->input->post('userType')==2 || $row->userType ==2){
							//get employee information	
							$emp = $this->db->get_where('employee', array('Id'=>$row->issueFor));
							$deptId = $emp->row()->EmployeeDeptId;
							$IdNo = $emp->row()->Id;
							
							echo '<label class="control-label" for="form-field-11">
								Class <span class="red">* </span>:
							</label><div class="controls" id="deptdiv">';
							$departments = $this->db->get('departments');
							$options[] = '---Select Department---';
							 foreach($departments->result() as $dept){
							 	
							 	$options[$dept->Id] = $dept->departmentName;
							 }
							 echo form_dropdown('deptId', $options,$deptId,'id="deptNamediv"');
							 echo '</div> ';
						}
							 
						?>
				</div>
				<div class="control-group">
					<label class="control-label" for="">
						 Issue Date <span class="red">*</span>:
					</label>
				 	<div class="controls">
						<input class="date-picker input-append" name="issuedate" value="<?php echo ($this->input->post('issuedate') ? $this->input->post('issuedate') : date('d-m-Y', strtotime($row->issuedate))) ;?>" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div> 
				</div>
				<div class="control-group">
					<label class="control-label" for="">
						 Return Date <span class="red">*</span>:
					</label>
				 	<div class="controls">
						<input class="date-picker input-append" value="<?php echo ($this->input->post('issueTill') ? $this->input->post('issueTill') : date('d-m-Y', strtotime($row->issueTill))) ;?>" name="issueTill" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div> 
				</div> 
				<div class="control-group">
					<label class="control-label" for=" ">
						Note <span class="red">*</span>:
					</label>
					<div class="controls">
						<?php
	
						$note = array(
							'name'			=>'note',
							'id'			=>'form-field-1',
							'placeholder'	=>'Total Amount',
							'value'			=> ($this->input->post('note') ? $this->input->post('note') : $row->note)
						);
						echo form_textarea($note).'&nbsp;&nbsp;&nbsp;';
						echo form_error('note'); 
						?>
					 </div>
				</div>
				<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
					Submit
				</button>
				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="icon-undo bigger-110"></i>
					Reset
				</button> 
	 		</div>
			<div id="students" class="span5">
				<?php
					if($this->input->post('userType')==1 || $row->userType ==1){
						foreach(@$std->result() as $std){
							echo '<h4>Student</h4><hr/><label>
									<input name="student" checked readonly value ="'.$std->StdDetailsId.'" class="std" type="radio">
									<span class="lbl"> '.$std->StdName.'</span>
								</label>';
						}
					}
				?>
			</div>	 	
			<div id="Staffs" class="span5">
				<?php
					if($this->input->post('userType')==2 || $row->userType ==2){
						foreach(@$emp->result() as $stf){
							echo '<h4>All  Staff</h4><hr/><label>
									<input name="staff" checked readonly  value ="'.$stf->Id.'" class="std" type="radio">
									<span class="lbl"> '.$stf->EmployeeName.'</span>
								</label>';
						}
					}
				?>
			</div>
			<?php endforeach; ?>
		 <?php echo form_close(); ?>
	<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
			