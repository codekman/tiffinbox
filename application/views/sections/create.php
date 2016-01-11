<script>
$(document).ready(function(){
	
	//alert('Hello');
});
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>sections/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Sections
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Create New Section
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
								<label class="control-label" for="class_name">Section Name</label>
							<?php echo form_open(base_url().'sections/insert','class="form-horizontal"'); 
								
								$SectionName = array(
									'name'			=> 'SectionName',
									'id'			=>'SectionName',
									'placeholder'	=> 'Enter secssion name',
									'value'			=> $this->input->post('SectionName')
								);
								
								echo form_input($SectionName);
								echo form_error('SectionName');
								
								$classes[''] ='-------Select Class---------';
								foreach($this->db->get('classes')->result() as $cls):
								$classes[$cls->Id]=($cls->ClassNumaricName) ? 
													($cls->ClassName.' :: '.$cls->ClassNumaricName):($cls->ClassName); 
								endforeach;
								echo '<br/><br/>'.form_label('Classes');
								echo form_dropdown('ClassId',$classes, $this->input->post('ClassId'));
								echo form_error('ClassId');
								
								$SectionNumericName = array(
									'name'		=>'SectionNumericName',
									'id'		=>'SectionNumericName',
									'placeholder'	=> 'Enter numaric value',
									'value'			=> $this->input->post('SectionNumericName')
								);
								echo '<br/><br/>'.form_label('Section Numeric Value');
								echo form_input($SectionNumericName);
								echo form_error('SectionNumericName');
								
								
								
								$teachers[''] ='-------Class Teacher---------';
								foreach($this->db->get('employee')->result() as $item):
									$teachers[$item->Id]=$item->EmployeeName; 
								endforeach;
								echo '<br/><br/>'.form_label('Section Class Teacher');
								echo form_dropdown('SectionClassTeacherId',$teachers, $this->input->post('SectionClassTeacherId'));
								echo form_error('SectionClassTeacherId');
							?>
							
							 </div>
							 <div class="control-group">
								   <label class="control-label" for="SectionStatus">Section Status</label>
								 
								 <?php 
											
										$status_type =array(
										''=> '----select status----',
										'0'=>'inactive',
										'1'=>'active'
										);
										echo form_dropdown('SectionStatus',$status_type, $this->input->post('SectionStatus'));
										echo form_error('SectionStatus');
								 ?>
							</div> 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Add this section
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
