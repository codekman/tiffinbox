 
<div class="page-content">
 	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS--> 
				<h1>
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Attendance
					<small>
						<i class="icon-double-angle-right"></i>
						 
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
						 <?php
						 	#get all classes:
						 	$classes = $this->db->get_where('classes', array('ClassStatus'=>1))->result();
						 	  
						 ?>
							<div class="row-fluid">
								<form class="form-search" method="POST" action="<?php echo base_url().'attendance/index';?>" />
									 
										<div class="control">
											<div class="row-fluid input-append span3">
												<input class=" date-picker" name="date" placeholder="Chossse a date" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
												<span class="add-on"> 
													<i class="icon-calendar"></i>
												</span>
											</div>
											<div class="row-fluid span3">
											<select class="chzn-select add-section" name="classId" id="form-field-select-3" data-placeholder="Choose a Class...">
												<option value="" />
												<?php 
													foreach($classes as $class):
														$cls[$class->Id] = $class->ClassName.' :: '.$class->ClassNumaricName;
														 echo '<option value="'.$class->Id.'" />'.$class->ClassName.' :: '.$class->ClassNumaricName;
													endforeach;
												?> 
											</select>
											</div>
											<div id="section" class="span4"></div>	
											<button  type="submit" class="btn btn-purple btn-small ">
												Manage Attendence <i class="icon-search icon-on-right bigger-110"></i>
											</button>
										</div> 
										
								 
								</form> 
								 
							</div>
							
						</div><!--/.span-->
					</div><!--/.row-fluid--> 
					
					<?php if(@$student):?>
							<div class="row-fluid">
								<div class="table-header">
									Attendance of class <strong><?php echo $cls[$this->input->post('classId')];?></strong> on <strong><?php echo $this->input->post('date');?></strong> 
								</div> 
								<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
										<tr> 
											<th>Roll Number</th>
											<th>Name</th>
											<th class="hidden-480">Status</th> 
										</tr>
									</thead>

									<tbody>
										 
										<?php 
										echo form_open_multipart(base_url().'attendance/insert','class="form-horizontal"');
										echo form_hidden('class', $this->input->post('classId')); 
										echo form_hidden('date', date('Y-m-d', strtotime($this->input->post('date'))));  
										foreach($student->result() as $items){
											echo form_hidden('roll['.$items->StdRollNo.']');
											echo '<tr><td>'.$items->StdRollNo.'</td><td>'.$items->StdName.'</td>
											<td><input name="attendance['.$items->StdRollNo.']" class="ace-switch ace-switch-6" type="checkbox" />
											<span class="lbl"></span>
											</td></tr>';
										}?>
										<tr><td colspan="3"><button class="btn btn-mini btn-info pull-right" type="submit">Update</button></td></tr>
										<?php echo form_close(); ?>
									</tbody>
								</table>		 
							</div>
 						<?php endif; ?>	
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
<script>

$( document ).ready(function() {
	$(".add-section").change(function(){
		//get secttion by ID in ajax;
		var cls = $(this).val();
		 
		$.post( "<?php echo base_url();?>classroutin/getsectionBycId", { classId: cls })
		  .done(function( data ) {
		 	 
			if(data != 0){
				$("#section").html(data);	
			} 
		});
	  
	});
}); 
</script>

<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
