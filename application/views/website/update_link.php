<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>website/links">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Links
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update Link
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
										<label class="control-label" for="class_name">Link Name<span class="red">*</span></label>
									<?php echo form_open(base_url().'website/editlink','class="form-horizontal"'); 
										foreach($link->result() as $row):
										$linkName = array(
											'name'			=> 'name',
											'id'			=>'linkName',
											'value'			=> ($this->input->post('name')) ? $this->input->post('name') : $row->name,
											'placeholder'	=> 'Enter the name of link'
										);
										
										echo form_input($linkName);
										echo form_error('linkName');
									
									?>
									</div>
									 <div class="control-group">
								 		<label class="control-label" for="form-field-mask-1">
												Link URL<span class="red">*</span><br/>
											</label>
										 <div class="controls">
										 	 <?php
										 	 	$linkURL = array(
													'name'			=> 'url',
													'id'			=>'linkURL',
													'value'			=> ($this->input->post('url')) ? $this->input->post('url') : $row->name,
													'placeholder'	=> 'Enter url'
												);
												
												echo form_input($linkURL);
												echo form_error('linkURL');
										 	 ?>
										</div> 
									</div>	
							 		<div class="control-group">
								 		<label class="control-label" for="form-field-mask-1">
												Link Title<span class="red">*</span><br/>
											</label>
										 <div class="controls">
										 	 <?php
										 	 	$linkTitle = array(
													'name'			=> 'title',
													'id'			=>'linkTitle',
													'value'			=> ($this->input->post('title')) ? $this->input->post('title') : $row->name,
													'placeholder'	=> 'Enter Title'
												);
												
												echo form_input($linkTitle);
												echo form_error('linkTitle');
												echo form_hidden('id', $row->Id);
										endforeach;
										 	 ?>
										</div> 
									</div>	
							 
							
							</div>
							 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update this link
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
