<script>
$(document).ready(function(){
	
	//alert('Hello');
});
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>school/batch">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Batch
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Create New Batch
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
							
							<?php echo form_open(base_url().'school/insertbatch','class="form-horizontal"'); 
							?>
							 Batch Year <span class="red">*</span><br/>	
										<div class="input-append">
											<input type="text" class="input-large spinner-input" name="batchYear" id="spinner1" maxlength="3" style="width: 50px;">
											<div class="spinner-buttons btn-group btn-group-vertical"></div>
										</div>
										
									  
							<?php 
								echo '<br/>'.form_error('batchYear','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							?>		  	
									  	<br/>
						 
							<?php	
								$batchName = array(
									'name'			=> 'batchName',
									'id'			=>'batchName',
									'placeholder'	=> 'Enter batch name',
									'value'			=> $this->input->post('batchName')
								);
								echo form_label('Batch Name');
								echo form_input($batchName);
							echo '<br/>'.form_error('batchName','&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
							?>
							 			
							
							 </div>
							  
								<br/>
							 <div class="row-fluid ">
							 <div class="span6">	
										<label class="control-label" >Status</label>
										<div class="controls in-line">
											<label>
												<input id="form-field-radio1" name="batchStatus" checked value="1" type="radio">
												<span class="lbl" for="form-field-radio1">Active</span>
											 </label>
											 <label>
												<input id="form-field-radio2" name="batchStatus" value="0" type="radio">
												<span class="lbl" for="form-field-radio2">in-Active</span>
												
												 
											</label>
										</div>
									</div>	
						</div>	
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Add this batch
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
