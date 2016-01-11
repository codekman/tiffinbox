<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					 <div class="page-header row-fluid position-relative">
					 	<a href="<?php echo base_url();?>accounting/expenses">
							<button class="btn btn-primary pull-right span3"><i class="icon-cogs bigger-125"></i>Manage All Expenses</button>
						</a>
						<h1 class="span8">
							Create a New Expense

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
							<?php echo form_open_multipart(base_url().'accounting/insert_expense','class="form-horizontal"'); ?>
							
								 
								<div class="control-group">
									<label class="control-label" for="form-field-1">Amount<span class="red">*</span></label>
									<div class="controls">
										<?php
					 					$title = array(
											'name'			=>'amount',
											'id'			=>'form-field-1',
											'placeholder'	=>'Expense amount',
											'value'			=> @$this->input->post('amount')	
										);
										echo form_input($title);
										echo '<br/>'.form_error('amount', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Title<span class="red">*</span></label>
									<div class="controls">
										<?php
					 					$title = array(
											'name'			=>'title',
											'id'			=>'form-field-1',
											'placeholder'	=>'Expense Title',
											'value'			=> @$this->input->post('title')	
										);
										echo form_input($title);
										echo '<br/>'.form_error('title', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="form-field-11">Expense Datails</label>
								<div class="controls">
									<textarea name="details" rows="5" id="form-field-11" class="autosize-transition span3"></textarea>
								</div>
							</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Expense Category</label>
									<div class="controls">
										<?php
					 					
					 					$cate_list[] = '---select expense category---';
										foreach(@$expense_categories->result() as $items):
											$cate_list[@$items->Id] = @$items->categoryName;
										endforeach;
									 	echo form_dropdown('expenceCategoryId', $cate_list,'','Id="Dept"');
										echo '<br/>'.form_error('expenceCategoryId', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
								 
					 		<div class="control-group">
									<label class="control-label" for="form-field-1">Mediam<span class="red">*</span></label>
									<div class="controls">
										<?php
					 					$mediam = array(
											'name'			=>'mediam',
											'id'			=>'form-field-1',
											'placeholder'	=>'Expense amount',
											'value'			=> (@$this->input->post('mediam')) ? 	@$this->input->post('mediam') : ''
										);
										echo form_input($mediam);
										echo '<br/>'.form_error('mediam', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
										?>
									 
									</div>
								</div>
									 
							<div class="row-fluid">	 
							 	
								 <div class="control-group">
									<label class="control-label" for="form-field-mask-1">
										Date Of Expense<br/>
										 
									</label>
									<div class="row-fluid input-append span3">
										<input class=" date-picker" name="date" placeholder="Chossse a date" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
										<span class="add-on"> 
											<i class="icon-calendar"></i>
										</span>
									</div>	  
							</div>
							    
									 
							<!--div class="control-group">
							 	<label class="control-label" for="EmployeeStatus">Status</label>
								<div class="controls">	 
									 <?php 
									 $status_type =array(
												''=> '----select status----',
												'0'=>'inactive',
												'1'=>'active'
												);
											
											echo form_dropdown('status',$status_type, @$this->input->post('EmployeeStatus'));
											echo '<br/>'.form_error('EmployeeStatus', '&nbsp;&nbsp;<span class="text-warning orange"><i class="icon-warning-sign"></i>&nbsp;', '</span>');
									 ?>
								</div> 
							</div--> 
				 
				
					 <div class="row-fluid ">
					 
							<button   class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Submit
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
					</div>				
							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
