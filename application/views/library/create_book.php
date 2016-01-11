<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>library/books">
					<button class="btn btn-primary pull-right">
						<i class="icon-cogs bigger-125"></i>
						Manage Books
					</button>
				</a>	
					 
			<h1>
			<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
				Add New Book
				<small>
					<i class="icon-double-angle-right"></i>
					Please Provide the following informations: 
				</small>
			</h1>
		 </div>
		<div class="row-fluid">
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
			<?php echo form_open(base_url().'library/insertbook','class="form-horizontal"'); ?>
			
				<div class="control-group">
					<label class="control-label" for="class_name">Book Name<span class="red">*<span></label>
				 	<div class="controls">
						<?php
						$name = array(
							'name'			=> 'name',
							'id'			=>'name',
							'placeholder'	=> 'Enter Book Name'
						);
						
						echo form_input($name);
						echo form_error('name');
						?>
					</div>
				</div>
				<div class="control-group">
					   <label class="control-label" for="status">Book Author</label>
					   <div class="controls">
							<?php	
								 
								$author = array(
									'name'			=> 'author',
									'id'			=>'author',
									'placeholder'	=> 'Enter Book Author Name'
								);
								
								echo form_input($author);
								echo form_error('author');
							?>
					</div>
				</div>
				<div class="control-group">
					   <label class="control-label" for="status">Book Description</label>
					   <div class="controls">
							<?php	
								 
								$description = array(
									'name'			=> 'description',
									'id'			=>'description',
									'placeholder'	=> 'Enter Book Description',
									
								);
								
								echo form_textarea($description);
								echo form_error('description');
							?>
					</div>
				</div>		
				<div class="control-group">
					   <label class="control-label" for="status">Book Price</label>
					<div class="controls">
						<?php	 
							$price = array(
								'name'		=>'price',
								'id'		=>'SubjectCode',
								'placeholder'	=> 'Enter Book Price'
							);
							 
							echo form_input($price);
							echo form_error('price');
						?>
					</div>
				</div>
 
				 <div class="control-group">
					   <label class="control-label" for="status">Book Status</label>
					   <div class="controls">
					 		<input name="status" checked value="1" type="radio"> 
					 		<span class="lbl">&nbsp;&nbsp;Available</span>
					 		<input name="status" value="0" type="radio">
					 		 <span class="lbl">&nbsp;&nbsp;Issued</span>
					 	</div>	 
				</div> 
			 	<button class="btn btn-info" type="submit">
					<i class="icon-ok bigger-110"></i>
					Add New Book
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="icon-undo bigger-110"></i>
					Reset
				</button>
			 
					
				<?php echo form_close(); ?>
		</div><!--/.row-fluid-->
 	
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
