<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					 <div class="page-header row-fluid position-relative">
					 	<a href="<?php echo base_url();?>accounting/expense_categories">
							<button class="btn btn-primary pull-right span3"><i class="icon-cogs bigger-125"></i>Manage expense Category</button>
						</a>
						<h1 class="span8">
							Update expense Category
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
							<?php echo form_open_multipart(base_url().'accounting/edit_expensecategory','class="form-horizontal"'); ?>
					  </div>
							<div class="row-fluid">	 
									<div class="control-group">
										<label class="control-label" for="form-field-4">expense Category Name<span class="red">*</span></label>
											
										<div class="controls">
											 <?php 
											 
											foreach($category->result() as $row): 
											 
											$categoryName = array(
												'name'			=>'categoryName',
												'id'			=>'form-field-4',
												'placeholder'	=>'expense Category Name',
												'value'			=> (@$this->input->post('categoryName')) ? 	@$this->input->post('categoryName') : $row->categoryName
											);
											echo form_input($categoryName);
											echo '<br/>'.form_error('categoryName', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										 
											 
											?>
										</div>
								</div>
					 <div class="row-fluid ">
						 <div class="span6">	
							<label class="control-label" >Status</label>
							<div class="controls in-line">
								<label>
									<input id="form-field-radio1" name="status" checked value="1" type="radio">
									<span class="lbl" for="form-field-radio1">Active</span>
								 </label>
								 <label>
									<input id="form-field-radio2" name="status" value="0" type="radio">
									<span class="lbl" for="form-field-radio2">in-Active</span>
									
									 
								</label>
							</div>
						</div>	
					</div>	
								  
				 	<br/>
					 <div class="row-fluid ">
					 
							<button   class="btn btn-info btn-mini" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update Category
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-mini" type="reset">
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
