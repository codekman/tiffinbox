<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>noticeboard/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Notice Board
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Update Notice
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
								<label class="control-label" for="noticeTitle">Notice Title<span class="red">*</span></label>
							<?php echo form_open(base_url().'noticeboard/edit','class="form-horizontal"'); 
								foreach(@$notice->result() as $row):
								
								$noticeTitle = array(
									'name'			=> 'noticeTitle',
									'id'			=>'noticeTitle',
									'placeholder'	=> 'Enter the name of exam',
									'value'			=>@$row->noticeTitle
								);
								
								echo form_input($noticeTitle);
								echo form_error('noticeTitle');
							
							?>
							</div>
							 <div class="control-group">
						 		<label class="control-label" for="form-field-mask-1">
										Notice Date <span class="red">*</span> & Time<br/>
										<small class="text-success">eg: DD/MM/YYYYY</small>
									</label>
								 <div class="controls">
								 	<div class="input-append">
									<input class="input-small input-mask-date" value="<?php 
									 $time = explode(' ',@$row->noticeDate); 
									echo date('d/m/Y', strtotime(@$time[0]));?>" name="noticeDate" id="form-field-mask-1" type="text">
										<span class="btn btn-small">
											<i class="icon-calendar bigger-110"></i>
											Find!
										</span>
									</div> 
								 
						<!--Time--->	 
						<div class="input-append bootstrap-timepicker">
							<div class="bootstrap-timepicker-widget dropdown-menu">
								<table><tbody>
									<tr>
										<td><a href="#" data-action="incrementHour">
											<i class="icon-chevron-up"></i></a>
										</td>
										<td class="separator">&nbsp;</td><td>
											<a href="#" data-action="incrementMinute"><i class="icon-chevron-up"></i></a>
										</td><td class="separator">&nbsp;</td><td>
											<a href="#" data-action="incrementSecond"><i class="icon-chevron-up"></i></a>
										</td>
									</tr>
									<tr>
										<td><input type="text" name="hour" id="hour" class="bootstrap-timepicker-hour" maxlength="2"></td> 
										<td class="separator">:</td>
										<td><input type="text" name="minute" id="minute" class="bootstrap-timepicker-minute" maxlength="2"></td>
										
										<td class="separator">:</td>
										<td><input type="text" name="second" id="second" class="bootstrap-timepicker-second" maxlength="2"></td>
									</tr>
									<tr>
										<td><a href="#" data-action="decrementHour"><i class="icon-chevron-down"></i></a></td>
										<td class="separator"></td>
										<td><a href="#" data-action="decrementMinute"><i class="icon-chevron-down"></i></a></td>
										<td class="separator">&nbsp;</td>
										<td><a href="#" data-action="decrementSecond"><i class="icon-chevron-down"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
							<input id="timepicker1" value="<?php echo $time[1]; ?>" name="timepicker1" type="text" class="input-small">
							<span class="add-on">
								<i class="icon-time"></i>
							</span>
						</div>
					</div>
					<!--End Of Time--->
							<?php	 
								$noticeDescription = array(
									'name'		=>'noticeDescription',
									'id'		=>'noticeDescription',
									'cols'			=>'10',
									'rows'			=>'5',
									'value'			=>@$row->noticeDescription
								);
								echo form_label('Notice Description'); 
								echo  form_textarea($noticeDescription);
								echo form_error('noticeDescription'); 
								
								
								if($row->noticeStatus) :
									$check='checked'; 
									$unCheck='';
								else:
									$check='';
									$unCheck='checked';
								endif;
									
								
							?>
							
							 </div>
							<div class="controls">
								<label>
									<input id="form-field-radio1" name="noticeStatus" <?php echo $check; ?> value="1" type="radio">
									<span class="lbl" for="form-field-radio1"> active</span>
								 
									<input id="form-field-radio2" name="noticeStatus" <?php echo $unCheck; ?> value="0" type="radio">
									<span class="lbl" for="form-field-radio2"> in-active</span>
								</label>
							</div>
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Update this Notice
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
								
							<?php 
							echo form_hidden('id', @$row->Id);
							echo form_close();
							endforeach ;
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
