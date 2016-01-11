<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>examgrades/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Exam Grade
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update Exam Grades
							<small>
								<i class="icon-double-angle-right"></i>
								Please Provide the following informations: 
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
								<label class="control-label" for="class_name">Grade Name<span class="red">*</span></label>
							<?php echo form_open(base_url().'examgrades/edit','class="form-horizontal"'); 
								foreach($examgrade->result() as $row):
								$gradeName = array(
									'name'			=> 'gradeName',
									'id'			=>'gradeName',
									'placeholder'	=> 'Example: A+',
									'value'			=> $row->gradeName
								);
								
								echo form_input($gradeName);
								echo form_error('gradeName');
							
								$gradePoint = array(
									'name'		=>'gradePoint',
									'id'		=>'gradePoint',
									'placeholder'	=> 'Example: 5.00',
									'value'			=> $row->gradePoint
								);
								echo '<br/><br/>'.form_label('Grade Point Value<span class="red">*</span>');
								echo form_input($gradePoint);
								echo form_error('gradePoint');
								
								$markFrom = array(
									'name'		=>'markFrom',
									'id'		=>'markFrom',
									'placeholder'	=> 'Ex:80',
									'class'			=>'input input-small',
									'value'			=> $row->markFrom
								);
							echo '<br/><br/>'.form_label('Mark From<span class="red">*</span> - Mark Upto<span class="red">*</span>');
								echo form_input($markFrom);
								echo form_error('markFrom');
								
								$markUpto = array(
									'name'		=>'markUpto',
									'id'		=>'markUpto',
									'placeholder'	=> 'Ex:100',
									'class'			=>'input input-small',
									'value'			=> $row->markUpto
								);
								 
								echo ' - '.form_input($markUpto);
								echo form_error('markUpto');
								
								$comments = array(
									'name'		=>'comments',
									'id'		=>'comments',
									'cols'			=>'10',
									'rows'			=>'5',
									'value'			=> $row->comments
								);
								echo '<br/><br/>'.form_label('Comments'); 
								echo  form_textarea($comments);
								echo form_error('comments');
								
								echo form_hidden('id', $row->Id);
								if($row->examGradeStatus) :
									$check='checked'; 
									$unCheck='';
								else:
									$check='';
									$unCheck='checked';
								endif;
									
								endforeach;
								
							?>
							
							 </div>
						<div class="controls">
							<label>
								<input id="form-field-radio1" name="examGradeStatus" <?php echo $check; ?> value="1" type="radio">
								<span class="lbl" for="form-field-radio1"> active</span>
							 
								<input id="form-field-radio2" name="examGradeStatus" <?php echo $unCheck; ?> value="0" type="radio">
								<span class="lbl" for="form-field-radio2"> in-active</span>
								
								 
							</label>
						</div>
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update this exam grade
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
								
							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
