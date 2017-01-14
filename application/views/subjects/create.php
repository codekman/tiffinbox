<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>subjects/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Subject
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Create New Subject
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
						<!--------------End of Message---------------------------------->
							<div class="control-group">
								<label class="control-label" for="class_name">Subject Name<span class="red">*<span></label>
							<?php echo form_open(base_url().'subjects/insert','class="form-horizontal"'); 
								
								$SubjectName = array(
									'name'			=> 'SubjectName',
									'id'			=>'SubjectName',
									'placeholder'	=> 'Enter subject name'
								);
								
								echo form_input($SubjectName);
								echo form_error('SubjectName');
								
								echo '<input name="SubjectIsOptional" value="1" class="ace-checkbox-2" type="checkbox">
									<span class="lbl green">&nbsp;&nbsp;Can be Optinal</span>';
								
								$classes[''] = '---Select Class---'; 
								foreach($class as $cls):
									$classes[$cls->Id] = $cls->ClassName.' :: '.$cls->ClassNumaricName ;
								endforeach;
								
								echo '<br/><br/>'.form_label('Subject For Class:');	
								echo form_dropdown('SubjectClassId',$classes);
								echo form_error('SubjectClassId');
								
								$SubjectCode = array(
									'name'		=>'SubjectCode',
									'id'		=>'SubjectCode',
									'placeholder'	=> 'Enter Subject code'
								);
								echo '<br/><br/>'.form_label('Subject Numeric Value');
								echo form_input($SubjectCode);
								echo form_error('SubjectCode');
								
								
								 
							?>
							
							 </div>
							 <div class="control-group">
								   <label class="control-label" for="status">Subject Status</label>
								 
								 <input name="SubjectStatus" checked value="1" type="radio"> 
								 		<span class="lbl">&nbsp;&nbsp;Active</span>
								 <input name="SubjectStatus" value="0" type="radio">
								 		 <span class="lbl">&nbsp;&nbsp;Inactive</span>
							</div> 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Add this subject
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
