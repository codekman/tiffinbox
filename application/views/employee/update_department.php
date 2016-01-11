<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					 <div class="page-header row-fluid position-relative">
					 	<a href="<?php echo base_url();?>employee/departments">
							<button class="btn btn-primary pull-right span3"><i class="icon-cogs bigger-125"></i>Manage Departments</button>
						</a>
						<h1 class="span8">
							Update Department
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
							<?php echo form_open_multipart(base_url().'employee/editdepartment','class="form-horizontal"'); ?>
					  </div>
							<div class="row-fluid">	 
									<div class="control-group">
										<label class="control-label" for="form-field-4">Department Name<span class="red">*</span></label>
											
										<div class="controls">
											 <?php 
											 
											foreach($department->result() as $row): 
											 
											$departmentName = array(
												'name'			=>'departmentName',
												'id'			=>'form-field-4',
												'placeholder'	=>'Employee\'s department Name',
												'value'			=> (@$this->input->post('departmentName')) ? 	@$this->input->post('departmentName') : $row->departmentName
											);
											echo form_input($departmentName);
											echo '<br/>'.form_error('departmentName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 
											 
											?>
										</div>
								</div>
							 
							 
						 <div class="row-fluid ">
							 <div class="span6">	
										<label class="control-label" >Status</label>
										<div class="controls in-line">
											<label>
												<input id="form-field-radio1" name="departmentStatus" checked value="1" type="radio">
												<span class="lbl" for="form-field-radio1">Active</span>
											 </label>
											 <label>
												<input id="form-field-radio2" name="departmentStatus" value="0" type="radio">
												<span class="lbl" for="form-field-radio2">in-Active</span>
												
												 
											</label>
										</div>
									</div>	
						</div>	
								  
				 
					 <div class="row-fluid ">
					 
							<button   class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update Department
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
					</div>				
							<?php 
							echo form_hidden('id', $row->Id);
							endforeach;
							echo form_close(); 
							
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
