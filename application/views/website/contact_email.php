<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Contact Us Email Configuation
							 
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
										 
									<?php echo form_open(base_url().'website/editcontactemail','class="form-horizontal"'); 
										foreach($emailcontact->result() as $row):
									?>
							 		<div class="control-group">
								 		<label class="control-label" for="form-field-mask-1">
												Contact Email<span class="red">*</span><br/>
											</label>
										 <div class="controls">
										 	 <?php
										 	 	$email = array(
													'name'			=> 'contact_us_email',
													'id'			=>'contact_us_email',
													'value'			=> ($this->input->post('contact_us_email')) ? $this->input->post('contact_us_email') : $row->contact_us_email,
													'placeholder'	=> 'Enter Title'
												);
												
												echo form_input($email);
												echo form_error('email');
											 	echo form_hidden('id', $row->Id);
										endforeach;
										 	 ?>
										</div> 
									</div>	
							 
							
							</div>
							 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
					<button class="btn btn-info" type="submit">
						Change this email
					</button>

							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
