<script>
$(document).ready(function(){
	
	//alert('Hello');
});
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>school/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Schools
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update School
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
							<!--------------End of Message---------------------------------->
							
							<?php echo form_open_multipart(base_url().'school/edit','class="form-horizontal"');
								foreach($school->result() as $row): 
							?>
							<div class="row-fluid">
								<div class="control-group">
									
						
										
									<div class="controls span2">
										School Monogram
									 <!-----Photo------>
									<input multiple="" name="schoolLogo" id = "form-field-6" type="file" class="id-input-file-3" />
									 
									 <!-----Photo------>
									</div>
								</div>
							</div>
							<?php	
								$schoolName = array(
									'name'			=> 'schoolName',
									'id'			=>'schoolName',
									'placeholder'	=> 'Enter school name',
									'value'			=> ($this->input->post('schoolName')) ? $this->input->post('schoolName') : $row->schoolName
								);
								echo form_label('School Name<span class="red">*</span>');
								echo form_input($schoolName);
							echo '<br/>'.form_error('schoolName','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
								
								 
								 
							?>
							
							 </div>
							 <div class="control-group">
									<label class="control-label" for="form-field-11">School Address</label>
									<div class="controls">
										<textarea name="schoolAddress" rows="5" id="form-field-11" class="autosize-transition span3"><?php echo ($this->input->post('schoolName')) ? $this->input->post('schoolName') : $row->schoolAddress; ?></textarea>
									</div>
								<div>
								<br/>
							 <div class="row-fluid ">
							 <div class="span6">	
										<label class="control-label" >Status</label>
										<div class="controls in-line">
										<?php
											if($this->input->post('schoolStatus')==1) :
											 $this->input->post('schoolName'); 
											else: 
												$row->schoolAddress;
											endif;
										?>
											<label>
												<input id="form-field-radio1" name="schoolStatus" checked value="1" type="radio">
												<span class="lbl" for="form-field-radio1">Active</span>
											 </label>
											 <label>
												<input id="form-field-radio2" name="schoolStatus" value="0" type="radio">
												<span class="lbl" for="form-field-radio2">in-Active</span>
												
												 
											</label>
										</div>
									</div>	
						</div>	
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update this school
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
								
							<?php 
							echo form_hidden('id', $row->Id);
							echo form_close(); 
							endforeach;
							
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
