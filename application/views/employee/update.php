<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					 <div class="page-header row-fluid position-relative"> <a href="<?php echo base_url();?>employee/index"><button class="btn btn-primary pull-right span3"><i class="icon-cogs bigger-125"></i> Manage All Staff</button></a>
						<h1 class="span8">
							Upadate Staff Information
							<small>
								<i class="icon-double-angle-right"></i>
								Please Modify the following informations: 
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
								<div class="alert alert-danger no-margin">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove red"></i>
									</button>
								
									<i class="icon-warning-sign bigger-120 blue"></i>
									<?php echo $this->session->flashdata('status_wrong'); ?>
								</div>
							<?php endif; ?>	
						<!--------------Message---------------------------------->
							<?php echo form_open_multipart(base_url().'employee/edit','class="form-horizontal"'); 
							 foreach(@$employee->result() as $row):
							?>
							
								<div class="control-group">
									<label class="control-label" for="form-field-6">Update Employee Photo</label>
										
									<div class="controls span3">
									 <!-----Photo------>
									<div class="span4 pull-left">
										<img  alt="<?php echo $row->EmployeePhoto; ?>" src="<?php echo base_url(); ?>media/employee/
											<?php 
												$photo = explode('-', @$row->EmployeePhoto);
												echo @$photo[1].'/'.@$row->EmployeePhoto; 
							 				?>" /> 
							 		</div>
							 		<div class="span8 pull-right">		
										<input multiple="" name="EmployeePhoto" id = "form-field-6" type="file" class="id-input-file-3" />
 									</div>
									 <!-----Photo------>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-1">Name<span class="red">*</span></label>
									<div class="controls">
										<?php
					
										$name = array(
											'name'			=>'EmployeeName',
											'id'			=>'form-field-1',
											'placeholder'	=>'Teacher Name',
											'value'			=> ($this->input->post('EmployeeName')) ? 
																$this->input->post('EmployeeName') : $row->EmployeeName
										);
										echo form_input($name);
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
									 	echo form_dropdown('EmployeeDeptId', $dept_list,$row->EmployeeDeptId);
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
									 	echo form_dropdown('EmployeeDesignationId', $des_list,$row->EmployeeDesignationId);
										echo '<br/>'.form_error('EmployeeDesignationId', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
							<div class="row-fluid">	
								 
									<div class="control-group">
										<label class="control-label" for="form-field-4">Email</label>
											
										<div class="controls">
											 <?php
						
											$email = array(
												'name'			=>'EmployeeEmail',
												'id'			=>'form-field-4',
												'placeholder'	=>'Email address',
												'value'			=> (!$this->input->post('EmployeeEmail')) ? 
																	@$row->TeacherEmail : $this->input->post('EmployeeEmail')	
											);
											echo form_input($email).'&nbsp;&nbsp;&nbsp;';
											echo form_error('EmployeeEmail');
										 
											 
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
						
											 
											echo form_dropdown('EmployeeGender',$option,(!$this->input->post('EmployeeGender')) ? 
											$row->EmployeeGender:$this->input->post('EmployeeGender')	);
											echo '<br/>'.form_error('EmployeeGender','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 
											 
											?>
										</div>
								</div>
						 
								 <div class="row-fluid">
										 <!---DOB---->		
										  
												 			
													 <div class="control-group">
													 		<label class="control-label" for="form-field-mask-1">
																	Date Of Birth
																	<small class="text-success">09/09/1999</small>
																</label>
															 <div class="controls">
															 	<div class="input-append">
															 		
												<input name="EmployeeBrithDate" value="
													<?php 
														$brithday = date('d/m/Y',strtotime( @$row->EmployeeBrithDate));
														echo (!$this->input->post('EmployeeBrithDate')) ?
													 	@$brithday : $this->input->post('EmployeeBrithDate'); 
													 ?>"
												 class="input-small input-mask-date span8" id="form-field-mask-1" type="text">
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
												<small class="text-warning">(0167) 564-5158</small>
											</label>
											<div class="controls">
											<div class="input-prepend">
												<span class="add-on">
													<i class="icon-phone"></i>
												</span>
		
												<input name="EmployeeMobile" value="
													<?php
														echo (!$this->input->post('EmployeeMobile')) ? 
														@$row->EmployeeMobile:$this->input->post('EmployeeMobile')	; 
													?>"
												class="input-medium input-mask-phone span12" type="text" id="form-field-mask-2" />
											</div>
											</div>
										</div>
									</div>
								 
								
								 
									 <div class="control-group">
										<label class="control-label" for="form-field-5">Blood Group(Ex: O(+ve)</label>
											
										<div class="controls">
											<?php
												$blood_group = array(
													'name'			=>'EmployeeBloodGroup',
													'placeholder'	=>'X(+ve)',
													'id'			=>'form-field-5',
													'class'			=>'input',
													'value'			=> (!$this->input->post('EmployeeBloodGroup')) ? 
																		@$row->TeacherBloodGroup:
																		$this->input->post('EmployeeBloodGroup')	
												);
												echo form_input($blood_group);
												echo form_error('EmployeeBloodGroup');
											?>
										</div>
									</div>
								</div>			
						 
								
								
								 
								
								 <div class="control-group">
									<label class="control-label" for="form-field-11">Present Address</label>
									<div class="controls">
										<textarea name="EmployeeAddress" rows=5  id="form-field-11" class="autosize-transition span3"><?php 
												echo (!$this->input->post('EmployeeAddress')) ? 
												 @$row->EmployeeAddress:$this->input->post('EmployeeAddress')	;
											 ?>
										</textarea>
									</div>
								</div>
							 
								 <div class="control-group">
									<label class="control-label" for="username">User Name</label>
									<div class="controls">
										 <?php
										 		$username = array(
										 			'name'		=>'EmployeeUserName',
										 			'id'		=>'username',
										 			'placeholder'	=> 'Enter a user name',
										 			'autocomplete'  =>'off',
										 			'value'			=> (!$this->input->post('EmployeeUserName')) ? 
										 								@$row->TeacherUserName:$this->input->post('EmployeeUserName')		
												);
												echo form_input($username);
												echo '<br/>'.form_error('EmployeeUserName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 ?>
									</div>
								</div>
								
								 <div class="control-group">
									<label class="control-label" for="password">Reset Password</label>
									<div class="controls">
										  <?php
										 		$password = array(
										 			'name'		=>'EmployeePassword',
										 			'id'		=>'password',
										 			'placeholder'	=> 'Enter a password',
										 			'autocomplete'  =>'off'		
												);
												echo form_password($password);
												echo form_error('EmployeePassword');
										 ?>
									</div>
								</div>	
								
								 
							<div class="control-group">
							 
						 		   <label class="control-label" for="status">Status</label>
								<div class="controls">	 
									 <?php 
									 $status_type =array(
												''=> '----select status----',
												'0'=>'inactive',
												'1'=>'active'
												);
											
											echo form_dropdown('EmployeeStatus',$status_type, 
											(!@$this->input->post('EmployeeStatus')) ? 
											@$row->EmployeeStatus:$this->input->post('EmployeeStatus'));
											echo form_error('TeacherStatus');
									 ?>
								</div> 
							</div> 
				 
				
					 <div class="row-fluid ">
					 
							<button   class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
					</div>				
							<?php 
								echo form_hidden('id',@$row->Id);
								echo form_close(); 
							endforeach;
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
