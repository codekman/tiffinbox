<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>classes/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Classes
					</button>
				</a>	
					 
						<h1>
							Update Class
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
								<label class="control-label" for="class_name">Class Name</label>
							<?php echo form_open(base_url().'classes/edit','class="form-horizontal"'); 
								foreach($class->result() as $row):
								$ClassName = array(
									'name'			=> 'ClassName',
									'id'			=>'ClassName',
									'placeholder'	=> 'Enter class name',
									'value'			=> @$row->ClassName
								);
								
								echo form_input($ClassName);
								echo form_error('ClassName');
								
								
								$ClassNumaricName= array(
									'name'		=>'ClassNumaricName',
									'id'		=>'ClassNumaricName',
									'placeholder'	=> 'Enter numaric value',
									'value'			=> @$row->ClassNumaricName
								);
								echo '<br/><br/>'.form_label('Class Numeric Value');
								echo form_input($ClassNumaricName);
								echo form_error('ClassNumaricName');
								
								
								$teachers[''] ='-------class teacher---------';
								foreach($this->db->get_where('teachers',array('TeacherStatus'=>1))->result() as $item):
									$teachers[$item->Id]=$item->TeacherName; 
								endforeach;
								echo '<br/><br/>'.form_label('Class Teacher');
								echo form_dropdown('ClassTeacherId',$teachers,$row->ClassTeacherId);
								echo form_error('class_teacher');
							?>
							
							 </div>
							 <div class="control-group">
								   <label class="control-label" for="status">Class Status</label>
								 
								 <?php 
										$status_type =array(
										''=> '----select status----',
										'0'=>'inactive',
										'1'=>'active'
										);
										echo form_dropdown('ClassStatus',$status_type,@$row->ClassStatus);
										echo form_error('ClassStatus');
										echo form_hidden('id',@$row->Id);
								endforeach;
								 ?>
							</div> 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-edit bigger-110"></i>
								Update this class
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
