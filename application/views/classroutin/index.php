<script>
function confirmdelete(){
	var conf = confirm("Are you sure to delete this Class?");

	if(conf==true){
	}else{
		event.preventDefault();
	}

}

</script>

		<div class="page-content">
			<div class="row-fluid">
				<div class="span12 page-header position-relative">
					<!--PAGE CONTENT BEGINS-->

					<a href="<?php echo base_url();?>classroutin/create">
						<button class="btn btn-primary pull-right">
							<i class="icon-beaker bigger-125"></i> Create New Class Routin
						</button>
					</a>

					<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i> Classes Routins
						<small><i class="icon-double-angle-right"></i></small>
					</h1>
				</div><!--/.page-header-->
				<div class="row-fluid">
					<div class="span12">
						<!--PAGE CONTENT BEGINS-->
						<!--------------Message---------------------------------->
						<!--check any alert message or not -->
						<?php if($this->session->flashdata('status_right')): ?>
							<!--Print Success Alert Message: -->
							<div class="alert alert-success no-margin">
								<button type="button" class="close" data-dismiss="alert"><i class="icon-remove red"></i></button>
								<i class="icon-ok bigger-120 blue"></i> <?php echo $this->session->flashdata('status_right'); ?>
							</div>
						<?php endif; ?>

						<!--check any alert message or not -->

						<?php if($this->session->flashdata('status_wrong')): ?>
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

						<div class="row-fluid">
							<div class="table-header">
								Results for "Latest Registered Classes"
							</div>

							<div class="tabbable tabs-left">
								<ul class="nav nav-tabs" id="myTab3">

									<?php
									$class = [];
									foreach ($classes->result() as   $value) {
										$class[$value->Id] = $value->ClassName;
									}
									$dayNames = array(
											'',
										    'Sunday',
										    'Monday',
										    'Tuesday',
										    'Wednesday',
										    'Thursday',
										    'Saturday',
										    'Friday',
									);

									$schedules = array();
									foreach($class as $key=>$row):?>
										<li class="<?php echo ($key == 1) ? 'active' : '' ; ?>">
											<a data-toggle="tab" href="#<?php echo $key+1; ?>">
												<i class="pink icon-dashboard bigger-110"></i>
												<?php echo @$row;?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>

								<div class="tab-content">
								<?php foreach($class as $key=>$row):

								?>
										<div id="<?php echo $key+1; ?>" class="tab-pane in <?php echo ($key == 1) ? 'active' : '' ; ?>">
											<table class="table table-striped table-bordered table-hover">

											 	 <tr>
											 	 	<?php foreach($dayNames as $day){ ?>
											 	 		<td><?php echo $day; ?></td>
											 	 	<?php } ?>
											 	 </tr>

										 	 		<?php

										 	 		#publish rutine daywise
										 	 		foreach($routins->result() as $sub ):
														if($key == $sub->ClassId ){
															echo '<tr><td>&nbsp;</td>';
															if($sub->DayOftheWeekId == '1'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															if($sub->DayOftheWeekId == '2'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															if($sub->DayOftheWeekId == '3'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															if($sub->DayOftheWeekId == '4'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															if($sub->DayOftheWeekId == '5'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
												 	 		if($sub->DayOftheWeekId == '6'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
												 	 		}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															if($sub->DayOftheWeekId == '7'){
												 	 		  echo '<td>'.$sub->SubjectName.'<br/>'.$sub-> StartTime.'-'.$sub->EndTime.'</td>';
															}else{
												 	 			echo '<td>&nbsp;</td>';
												 	 		}
															echo '</tr>';
														}
										 	 		?>
											 	 	<?php endforeach; ?>




											</table>
										</div>
								<?php endforeach; ?>
								</div>
							 </div>
							</div>
						</div>
		 			</div><!--/.span-->
				</div><!--/.row-fluid-->

					<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
