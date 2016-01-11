<script>
$(document).ready(function(){
	
	//alert('Hello');
});
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>school/branches">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Branches
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Create New Branch
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
							
							<?php echo form_open(base_url().'school/insertbranch','class="form-horizontal"'); 
							?>
							 
							<?php	
								$branchName = array(
									'name'			=> 'branchName',
									'id'			=>'branchName',
									'placeholder'	=> 'Enter branch name',
									'value'			=> $this->input->post('branchName')
								);
								echo form_label('Branch Name<span class="red">*</span>');
								echo form_input($branchName);
							echo '<br/>'.form_error('branchName','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							
								$branchCode = array(
									'name'			=> 'branchCode',
									'id'			=>'branchCode',
									'placeholder'	=> 'Enter branch code',
									'value'			=> $this->input->post('branchCode')
								);
								echo '<br/>'.form_label('Branch Code');
								echo form_input($branchCode);
							echo '<br/>'.form_error('branchCode','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
								
							$option[] = "----select school----";	 
							$school = new school_model();
							foreach($school->getAllschools()->result() as $value):
								$option[$value->Id] = $value->schoolName;
							endforeach;	 
							echo '<br/>'.form_label('Name of school');
							echo form_dropdown('schoolId',$option);
							echo '<br/>'.form_error('schoolId','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							?>
							
							 </div>
							 <div class="control-group">
									<label class="control-label" for="form-field-11">Branch Address</label>
									<div class="controls">
										<textarea name="branchAddress" rows="5" id="form-field-11" class="autosize-transition span3"><?php echo $this->input->post('branchAddress'); ?></textarea>
									</div>
								<div>
								<br/>
							 <div class="row-fluid ">
							 <div class="span6">	
										<label class="control-label" >Status</label>
										<div class="controls in-line">
											<label>
												<input id="form-field-radio1" name="branchStatus" checked value="1" type="radio">
												<span class="lbl" for="form-field-radio1">Active</span>
											 </label>
											 <label>
												<input id="form-field-radio2" name="branchStatus" value="0" type="radio">
												<span class="lbl" for="form-field-radio2">in-Active</span>
												
												 
											</label>
										</div>
									</div>	
						</div>	
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Add this branch
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
