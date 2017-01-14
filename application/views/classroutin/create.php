<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>classroutin/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Classes Routins
					</button>
				</a>

						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Add Schedule To The Class Routin
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
							<?php echo form_open(base_url().'classroutin/insert','class="form-horizontal"');?> 
							<div class="control-group">
							<?php

								$Cls[''] ='--------------Select A Subject---------------';
								foreach($classes->result() as $cls):
									$Cls[$cls->Id]=$cls->ClassName. " :: ". $cls->ClassNumaricName ;
								endforeach;
								echo form_label('Class');
								echo form_dropdown('ClassId',$Cls,$this->input->post('ClassId'),'class="input-xlarge add-section"');
								echo form_error('ClassId');
							?>

							</div>
							<div id="section"></div>
							<div class="control-group" id="subject">
							<?php

								$Subs[''] ='--------------Select A Subject---------------';
								foreach($subjects->result() as $item):
									$Subs[$item->Id]=$item->SubjectName ;
								endforeach;
								echo form_label('Subject');
								echo form_dropdown('SubjectId',$Subs,$this->input->post('SubjectId'),'class="input-xlarge"');
								echo form_error('SubjectId');
							?>

							 </div>
							 <div class="control-group">

								 <?php
								 	#there is a another option from DB:
									$days= array(
											'--------------Select A Day---------------',
										    'Sunday',
										    'Monday',
										    'Tuesday',
										    'Wednesday',
										    'Thursday',
										    'Saturday',
										    'Friday',
									);

									echo form_label('Day Of Week');
									echo form_dropdown('DayOftheWeekId',$days,$this->input->post('DayOftheWeekId'),'class="input-xlarge"');
									echo form_error('DayOftheWeekId');
								 ?>
							</div>
							<div class="control-group">
								<div class="row-fluid">
									<label for="timepicker1">Start Time</label>
								</div>

								<div class="control-group">
									<div class="input-append bootstrap-timepicker">
										<input class="timepicker1 input-small" name="StartTime" value ="<?php echo $this->input->post('StartTime'); ?>"type="text" />
										<span class="add-on">
											<i class="icon-time"></i>
										</span>
									</div>
								</div>
								<div class="row-fluid">
									<label for="timepicker1">End Time</label>
								</div>

								<div class="control-group">
									<div class="input-append bootstrap-timepicker">
										<input class="timepicker1 input-small" name="EndTime" value="<?php echo $this->input->post('EndTime'); ?>" type="text" />
										<span class="add-on">
											<i class="icon-time"></i>
										</span>
									</div>
								</div>

							</div>
						</div><!--/.span-->
					</div><!--/.row-fluid-->



							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Add This Schedule
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

<script>

$( document ).ready(function() {
$(".add-section").change(function(){
	//get secttion by ID in ajax;
	var cls = $(this).val();
	$.post( "<?php echo base_url();?>classroutin/getsectionBycId", { classId: cls })
	  .done(function( data ) {
	//	alert( "Data Loaded: " + data );
		if(data != 0){
			$("#section").html(data);
		}else{
			$("#section").html('There is no Section!');
		}
	});
	$.post( "<?php echo base_url();?>classroutin/getSubjectBycId", { classId: cls })
	  .done(function( data ) {
	//	alert( "Data Loaded: " + data );
		if(data != 0){
			$("#subject").html(data);
		}else{
			$("#subject").html('There is no Subject! <a href="<?php echo base_url()?>subjects/create" class="btn btn-mini btn-info">Create Subject</a>');
		}
	});
});
  $('.timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false
	})
});

</script>
