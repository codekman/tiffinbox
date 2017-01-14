<script>
$(document).ready(function(){
	$("#Dept").change(function(){
		 
		var Id = $('#Dept :selected').val();	
	 
		$.post( "<?php echo base_url();?>employee/getDesginationByDeptId", { deptId: Id })
		  .done(function( data ) {
		    $("#designation").html(data);
		  }); 
		 
	});
});
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					 <div class="page-header row-fluid position-relative">
					 	<a href="<?php echo base_url();?>employee/index">
							<button class="btn btn-primary pull-right span3"><i class="icon-cogs bigger-125"></i>Manage All Staff</button>
						</a>
						<h1 class="span8">
							Create a New Staff

							<small>
								<i class="icon-double-angle-right"></i>
								Please Provide the following informations: 
							</small>
						</h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						
						<div class="span12">
							<!--------------Message---------------------------------->
						<!--check any alert message or not -->
						 <?php
						 	if($this->session->flashdata('status_right')):
							
						 ?>
						 <!--Print Success Alert Message: -->
								
								<div class="alert alert-success no-margin">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove red"></i>
									</button>
								
									<i class="icon-ok bigger-120 blue"></i>
									<?php echo $this->session->flashdata('status_right'); ?>
								</div>
						<?php endif; ?>
						<!--check any alert message or not -->
						 <?php
						 	if($this->session->flashdata('status_wrong')):
							
						 ?>
						 <!--Print Wrong Alert Message: -->		
								<div class="alert span12 alert-danger no-margin">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove red"></i>
									</button>
								
									<div class="span1"><i class="icon-warning-sign icon-2x red"></i></div>
									<div class="span6"><?php echo $this->session->flashdata('status_wrong'); ?></div>
								</div>
							<?php endif; ?>	
						<!--------------End of Message---------------------------------->
							<?php echo form_open_multipart(base_url().'employee/insert','class="form-horizontal"'); ?>
							
								<div class="control-group">
									<label class="control-label" for="form-field-6">Employee Photo</label>
										
									<div class="controls span2">
									 <!-----Photo------>
									<input multiple="" name="EmployeePhoto" id = "form-field-6" type="file" class="id-input-file-3" />
 									 
									 <!-----Photo------>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-1">Name<span class="red">*</span></label>
									<div class="controls">
										<?php
					 
										$EmployeeName = array(
											'name'			=>'EmployeeName',
											'id'			=>'form-field-1',
											'placeholder'	=>'Employee Name',
											'value'			=> @$this->input->post('EmployeeName')	
										);
										echo form_input($EmployeeName);
										echo '<br/>'.form_error('EmployeeName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Department</label>
									<div class="controls">
										<?php
					 					
					 					$dept_list[] = '---select department---';
										foreach(@$departments as $dept):
											$dept_list[@$dept->Id] = @$dept->departmentName;
										endforeach;
									 	echo form_dropdown('EmployeeDeptId', $dept_list,'','Id="Dept"');
										echo '<br/>'.form_error('EmployeeDeptId', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Designation</label>
									<div class="controls">
										<?php
					 					
					 					$des_list[] = '---select designations---';
										foreach(@$designations as $des):
											$des_list[@$des->Id] = @$des->designationName;
										endforeach;
									 	echo form_dropdown('EmployeeDesignationId', $des_list,'','id="designation"');
										echo '<br/>'.form_error('EmployeeDesignationId', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
							<div class="row-fluid">	 
									<div class="control-group">
										<label class="control-label" for="form-field-4">Email</label>
											
										<div class="controls">
											 <?php
						
											$EmployeeEmail = array(
												'name'			=>'EmployeeEmail',
												'id'			=>'form-field-4',
												'placeholder'	=>'Employee\'s Email address',
												'value'			=> @$this->input->post('EmployeeEmail')	
											);
											echo form_input($EmployeeEmail);
											echo '<br/>'.form_error('EmployeeEmail', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 
											 
											?>
										</div>
								</div>
							 
							<div class="row-fluid">	
									<div class="control-group">
										<label class="control-label" for="form-field-4">Gender</label>
											
										<div class="controls">
											 <?php
											$option = array(
												''		=>'----Select----',
												'1'		=>'Male',
												'2'		=>'Female',
												'3'		=>'Others'
											);
						
											 
											echo form_dropdown('EmployeeGender',$option, @$this->input->post('EmployeeGender'));
											echo '<br/>'.form_error('EmployeeGender','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 
											 
											?>
										</div>
								</div>
						 
							 
								 <!---DOB---->		
								 <div class="control-group">
									<label class="control-label" for="form-field-mask-1">
										Date Of Birth<br/>
										<small class="text-success">eg: &nbsp;30/12/1999</small>
									</label>
									<div class="controls">
									 	<div class="input-append">
						<input name="EmployeeBrithDate" class="input-small input-mask-date span8" value="
								<?php echo @$this->input->post('EmployeeBrithDate');?>
														" id="form-field-mask-1" type="text"> 
											<span class="btn btn-small">
												<i class="icon-calendar bigger-110"></i>
													Find!
											</span>
										</div>
										<?php echo '<br/>'.form_error('EmployeeBrithDate', '<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');?>		
									</div>
								</div>	
								<!---DOB---->	  
												
								<div class="control-group">
									<label class="control-label" for="form-field-mask-2">
										Contact #<br/>
										<small class="text-success">eg: &nbsp;(01675) 64-51-58</small>
									</label>
									<div class="controls">
									<div class="input-prepend">
										<span class="add-on">
											<i class="icon-phone"></i>
										</span>
					<input name="EmployeeMobile" class="input-medium input-mask-phone span12" type="text" value="
							<?php echo @$this->input->post('EmployeeMobile');?>
														" id="form-field-mask-2" />
														
								
										</div>
										 <?php echo '<br/>'.form_error('EmployeeMobile','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');?>	
										</div>
									</div>
								</div>
								 	 
								 <div class="control-group">
									<label class="control-label" for="form-field-5">
										Blood Group<br/>
										<small class="text-success">eg: &nbsp; O+ve</small>
									</label>
										
									<div class="controls">
										<?php
											$EmployeeBloodGroup = array(
												'name'			=>'EmployeeBloodGroup',
												'placeholder'	=>'X(+ve)',
												'id'			=>'form-field-5',
												'class'			=>'input',
												'value'			=> @$this->input->post('EmployeeBloodGroup')	
											);
											echo form_input($EmployeeBloodGroup);
											echo '<br/>'.form_error('EmployeeBloodGroup','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									</div>
								</div>
							 		 
								 <div class="control-group">
									<label class="control-label" for="form-field-11">Present Address</label>
									<div class="controls">
										<textarea name="EmployeeAddress" rows="5" id="form-field-11" class="autosize-transition span3"></textarea>
									</div>
								<div>
								<br/>	
								 <div class="control-group">
									<label class="control-label" for="EmployeeUserName">User Name</label>
									<div class="controls">
										 <?php
										 		$EmployeeUserName = array(
										 			'name'		=>'EmployeeUserName',
										 			'id'		=>'EmployeeUserName',
										 			'placeholder'	=> 'Enter a user name',
										 			'autocomplete'  =>'off',
										 			'value'			=> @$this->input->post('EmployeeUserName')	
												);
												echo form_input($EmployeeUserName);
												echo '<br/>'.form_error('EmployeeUserName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 ?>
									</div>
								<div>
								 <div class="control-group">
									<label class="control-label" for="TeacherPassword">Password</label>
									<div class="controls">
										  <?php
										 		$EmployeePassword = array(
										 			'name'		=>'EmployeePassword',
										 			'id'		=>'EmployeePassword',
										 			'placeholder'	=> 'Enter a Employee Password',
										 			'autocomplete'  =>'off'		
												);
												echo '<br/>'.form_password($EmployeePassword);
												echo '<br/>'.form_error('EmployeePassword', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 ?>
									</div><br/>
							<div class="control-group">
							 
						 		   <label class="control-label" for="EmployeeStatus">Status</label>
								<div class="controls">	 
									 <?php 
									 $status_type =array(
												''=> '----select status----',
												'0'=>'inactive',
												'1'=>'active'
												);
											
											echo form_dropdown('EmployeeStatus',$status_type, @$this->input->post('EmployeeStatus'));
											echo '<br/>'.form_error('EmployeeStatus', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
									 ?>
								</div> 
							</div> 
				 
				
					 <div class="row-fluid ">
					 
							<button   class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Submit
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
					</div>				
							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
