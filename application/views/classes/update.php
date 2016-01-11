<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>classes/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage All Classes
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update Class information
							<small>
								<i class="icon-double-angle-right"></i>
								Please Modify the following informations: 
							</small>
						</h1>
					 </div>
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
						<!--------------Message---------------------------------->
							<div class="control-group">
								<label class="control-label" for="class_name">Class Name</label>
							<?php echo form_open(base_url().'classes/edit','class="form-horizontal"'); 
								foreach($class->result() as $cls):
								$ClassName = array(
									'name'			=> 'ClassName',
									'id'			=>'ClassName',
									'placeholder'	=> 'Enter class name',
									'value'			=> (@$this->input->post('ClassName')) ? 
														@$this->input->post('ClassName'):$cls->ClassName
								);
								
								echo form_input($ClassName);
								echo '<br/>'.form_error('ClassName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							
								$ClassNumaricName = array(
									'name'		=>'ClassNumaricName',
									'id'		=>'ClassNumaricName',
									'placeholder'	=> 'Enter class numaric value',
									'value'			=>(@$this->input->post('ClassNumaricName')) ? 
														@$this->input->post('ClassNumaricName'):$cls->ClassNumaricName 
									//@$this->input->post('ClassNumaricName')
								);
								echo '<br/><br/>'.form_label('Class Numeric Value');
								echo form_input($ClassNumaricName);
								echo '<br/>'.form_error('ClassNumaricName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
								
								
								$teachers[''] ='-------class teacher---------';
								
								//Teracher type employee filter:
								 
								//$this->db->where('EmployeeTypeId=', $name);
								//$this->db->or_where('id >', $id); 
								foreach($this->db->get('employee')->result() as $item):
									$teachers[$item->Id]=$item->EmployeeName; 
								endforeach;
								echo '<br/><br/>'.form_label('Class Teacher');
								echo form_dropdown('ClassTeacherId',$teachers,(@$this->input->post('ClassTeacherId')) ? 
														@$this->input->post('ClassTeacherId'):$cls->ClassTeacherId );
								echo '<br/>'.form_error('ClassTeacherId', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							?>
							
							 </div>
							 
							<div class="control-group">
									<label class="control-label" for="form-field-tags">Subject's of this Class:</label>

									<div class="controls">
										<input type="text" name="tags" id="form-field-tags" value=" 
										<?php //echo 
										if (@$this->input->post('subjects')) :
											echo @$this->input->post('subjects'); 
										
										else:
										
										foreach($this->db->get_where('subjects', array('SubjectClassId'=>$cls->Id))->result() as $subject ):
													echo $subject->SubjectName.',';		
																			 		
										endforeach;
											
										endif;
									 	?>"
									  placeholder="Enter Subjects ..." /><br/>
										<span class="help-inline blue">* Add all subjects by coma separation!</span>
										<?php
										echo '<br/>'.form_error('subjects', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									</div>
								</div>
							 
							 <div class="control-group">
								   <label class="control-label" for="status">Class Status</label>
								 
								 <?php 
											
										$status_type =array(
										''=> '----select status----',
										'0'=>'inactive',
										'1'=>'active'
										
										);
										echo form_dropdown('ClassStatus',$status_type,
										(@$this->input->post('ClassStatus')) ? 										@$this->input->post('ClassStatus') : $cls->ClassStatus  
										 );
										echo '<br/>'.form_error('ClassStatus', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
								 ?>
							</div> 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					 	<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update this class
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
							<input type="hidden" name="subjects" id="tag">	
							<?php
							echo form_hidden('id', @$cls->Id);
							 echo form_close(); 
								endforeach;
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
