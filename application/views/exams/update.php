<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>exams/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Exams
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update Exam
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
								<label class="control-label" for="class_name">Exam Name<span class="red">*</span></label>
							<?php echo form_open(base_url().'exams/edit','class="form-horizontal"'); 
								foreach(@$exam->result() as $row):
								$examName = array(
									'name'			=> 'examName',
									'id'			=>'examName',
									'placeholder'	=> 'Enter the name of exam',
									'value'			=> $row->examName
								);
								
								echo form_input($examName);
								echo form_error('examName');
							
							?>
							</div>
							 <div class="control-group">
						 		<label class="control-label" for="form-field-mask-1">
										Date Of Exam<span class="red">*</span><br/>
										<small class="text-success">eg: 09/09/1999</small>
									</label>
								 <div class="controls">
								 	<div class="input-append">
									<input class="input-small input-mask-date" value="<?php echo date('d/m/Y', strtotime($row->examDate));?>" name="examDate" id="form-field-mask-1" type="text">
										<span class="btn btn-small">
											<i class="icon-calendar bigger-110"></i>
											Find!
										</span>
									</div> 
								</div> 
							</div>	
							<?php	 
								$comments = array(
									'name'		=>'comments',
									'id'		=>'comments',
									'cols'			=>'10',
									'rows'			=>'5',
									'value'			=>$row->comments
								);
								echo form_label('Comments'); 
								echo  form_textarea($comments);
								echo form_error('comments'); 
								
								if($row->examStatus) :
									$check='checked'; 
									$unCheck='';
								else:
									$check='';
									$unCheck='checked';
								endif;
									
							 
							?>
							
							 </div>
							<div class="controls">
								<label>
									<input id="form-field-radio1" name="examStatus" <?php echo $check; ?> value="1" type="radio">
									<span class="lbl" for="form-field-radio1"> active</span>
								 
									<input id="form-field-radio2" name="examStatus" <?php echo $unCheck; ?> value="0" type="radio">
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
						 
								
							<?php 
							echo form_hidden('id',$row->Id);
							echo form_close(); 
							endforeach;
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
