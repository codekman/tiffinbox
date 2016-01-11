<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					<div class="page-header position-relative">
					 <a href="<?php echo base_url();?>students/index">
						<button class="btn btn-primary pull-right">
							<i class="icon-th bigger-125"></i>
							Manage Students
						</button>
					 </a>
						<h1>
							Upadate Student
							<small>
								<i class="icon-double-angle-right"></i>
								Please Provide the following informations: 
							</small>
						</h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<div class="span12">
							
							<!--------------Message---------------------------------->
						
						 <?php
						 //check any alert message or not
						 	if($this->session->flashdata('status_right')):
							
						 ?>
						 //Print Success Alert Message: 
								<div class="alert alert-success no-margin">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove red"></i>
									</button>
								
									<i class="icon-ok bigger-120 blue"></i>
									<?php echo $this->session->flashdata('status_right'); ?>
								</div>
						<?php endif; ?>
						   
						 <?php
						 //check any alert message or not
						 	if($this->session->flashdata('status_wrong')):
							
						 ?>
						 //Print Wrong Alert Message:
							<div class="alert alert-danger no-margin">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove red"></i>
								</button>
							
								<i class="icon-warning-sign bigger-120 blue"></i>
								<?php echo $this->session->flashdata('status_wrong'); ?>
							</div>
							<?php endif; ?>	
						<!--------------End of Message---------------------------------->
							<?php echo form_open_multipart(base_url().'students/edit','class="form-horizontal"'); 
							
								//Fetch Database information of this particular student
								 
								foreach($student->result() as $std):
							?>
							
								<div class="control-group">
									<label class="control-label" for="form-field-6">
									Student Photo
									<span class="red">*</span>
									</label> 
									<div class="controls span3">
						 			<?php
						 				$photo = explode('_', @$std->StdProfilePhoto);
										$Std_photo = 'media/students/'.@$photo[1].'/'.@$photo[2].'/'.@$std->StdProfilePhoto;
									?>	
									<img src="<?php echo base_url().$Std_photo;?>"/>
									 <!-----Photo------>
										<input multiple="" name="StdProfilePhoto" type="file" class="id-input-file-3" />
									 <!-----Photo------>
								</div>
							<div class="control-group span6">
										 <label class="control-label" for="form-field-6">
										 Class
										 <span class="red">*</span>
										 </label>
										 <div class="controls">
										 	<?php
										 		$cls[''] ='---Select Class---';
										 		foreach($this->db->get('classes')->result() as $cl):
										 			$cls[$cl->Id] = $cl->ClassName.' :: '.$cl->ClassNumaricName;
												endforeach;
												echo form_dropdown('StdClassId', $cls, $std->StdClassId);
												echo form_error('StdClassId');
										 	?>
										 </div>	
										 <br/>
										 <label class="control-label" for="form-field-6">
										 Section  
										 </label>
										 <div class="controls">
										 	<?php
										 		$section[''] ='---Select Section---';
										 		foreach($this->db->get('sections')->result() as $sec):
										 			$section[$sec->Id] = $sec->SectionName.' :: '.$sec->SectionNumericName;
												endforeach;
												echo  form_dropdown('StdSectionId', $section, $std->StdSectionId);
												echo form_error('StdSectionId');
										 	?>
										 </div>	
										 <br/>
										 <label class="control-label" for="form-field-6">
										 Roll Number<span class="red">*</span>
										 </label>
										 <div class="controls">
										 	<?php
										 		$StdRollNo = array(
										 			'name'			=>'StdRollNo',
										 			'id'			=>'StdRollNo',
										 			'placeholder'	=>'Enter Roll Number',
										 			'value'			=> $std->StdRollNo 
												);  
												echo  form_input($StdRollNo);
												echo form_error('StdRollNo');
										 	?>
										 </div>	
								</div>	
					</div>
					
					<div class="row-fluid">
						<div class="span4">	
							<label class="control-label" >
							Gender<span class="red">*</span>
							</label>
							<div class="controls">
								<?php
									//get database info is male or female and put into code:
									
									if($std->StdGender == 2):
										$female = "checked='checked'";
										$male = "";
									else:
										$female = "";
										$male = "checked='checked'";
									endif;
								?>
								
								<label>
									<input id="form-field-radio1"<?php echo $male; ?> name="StdGender" checked value="1" type="radio">
									<span class="lbl" for="form-field-radio1"> Male</span>
								 
									<input id="form-field-radio2" <?php echo $female; ?> name="StdGender" value="2" type="radio">
									<span class="lbl" for="form-field-radio2"> Female</span>
								</label>
							</div>
						</div>	
					</div>
					<div class="row-fluid">
					<!---DOB---->
								<div class="span8">				
									 <div class="control-group">
									 		<label class="control-label" for="form-field-mask-1">
													Date Of Birth<span class="red">*</span><br/>
													<small class="text-success">eg: 30/12/1999</small>
												</label>
											 <div class="controls">
											 	<div class="input-append">
											 		
												<input class="input-small input-mask-date" value="<?php echo date('d/m/Y',strtotime($std->StdDOB)); ?>" name="StdDOB" id="form-field-mask-1" type="text">
													<span class="btn btn-small">
														<i class="icon-calendar bigger-110"></i>
														Find!
													</span>
												</div>
												
											</div>
											
										</div>	
									</div>		 
								<!---DOB---->
					</div>				
					<div class="row-fluid">					
						<div class="control-group">
							<label class="control-label" for="form-field-mask-2">
								Contact #<span class="red">*</span><br/>
								<small class="text-warning">eg: (01675) 64-51-58</small>
							</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">
										<i class="icon-phone"></i>
									</span>

									<input class="input-medium input-mask-phone" value="<?php echo $std->StdContactNo; ?>" name="StdContactNo" type="text" id="form-field-mask-2" />
								</div>
								
							</div>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="form-field-1">
						Student Name<span class="red">*</span>
						</label>
						<div class="controls">
							<?php
		
							$StdName = array(
								'name'			=>'StdName',
								'id'			=>'form-field-1',
								'placeholder'	=>'Student Name',
								'value'			=> $std->StdName
							);
							echo form_input($StdName).'&nbsp;&nbsp;&nbsp;';
							echo form_error('StdName'); 
							?>
						 </div>
					</div>
					<div class="row-fluid">	
						<div class="control-group">
							<label class="control-label" for="form-field-50">Blood Group</label>
							<div class="controls">
								<?php
									$StdBloodGroup = array(
										'name'			=>'StdBloodGroup',
										'placeholder'	=>'(Example:O+ve)',
										'id'			=>'form-field-50',
										'class'			=>'input',
										'value'			=> $std->StdBloodGroup
										
									);
									echo form_input($StdBloodGroup);
									echo form_error('StdBloodGroup');
								?>
							</div>
						</div>			 
					<div>
					<div class="row-fluid">	
						<div class="span7">
							<div class="control-group">
								<label class="control-label" for="form-field-4">
								Parent's Name<span class="red">*</span>
								</label>
									
								<div class="controls">
									 <?php
				
									$StdFatherName = array(
										'name'			=>'StdFatherName',
										'id'			=>'form-field-4',
										'placeholder'	=>'Father\'s Name',
										'value'			=> $std->StdFatherName
									);
									echo form_input($StdFatherName).'&nbsp;&nbsp;&nbsp;';
									echo form_error('StdFatherName');
								 
									$StdMotherName = array(
										'name'			=>'StdMotherName',
										'id'			=>'form-field-5',
										'placeholder'	=>'Mother\'s Name',
										'value'			=> $std->StdMotherName
									);
									echo form_input($StdMotherName);
									echo form_error('StdMotherName');
									?>
								</div>
							</div>
						</div>			
				</div>
							 <div class="control-group">
									<label class="control-label" for="form-field-11">
									Present Address<span class="red">*</span>
									</label>
									<div class="controls">
								<textarea id="form-field-11" name="StdPresentAddress" class="autosize-transition span6"><?php echo $std->StdPresentAddress; ?></textarea>
									</div>
								<div>
								<br/>	
								<div class="control-group">
									<label class="control-label" for="form-input-readonly">Parmanent Address </label>
									<div class="controls">
						<!--input  type="text" id="form-input-readonly" value="This text field is readonly!" /-->
						<?php
							//check present and permanent address is same or not:
							if($std->StdPermanentAddress == 1):
								$address = "";
								$same = "checked='checked'";
						?>	
						<script>
						$(document).ready(function(){
							$(".codekman").attr('disabled','disabled');
						 	$(".codekman").val("This text field is disabled!");
						});
							

						</script>	
						<?php		
							else:
								$address = $std->StdPermanentAddress;
								$same = ""; 
							endif;
							
						?>				
										
						<textarea id="form-input-readonly" name="StdPermanentAddress" class="autosize-transition codekman span6"> <?php echo $address; ?></textarea>
										&nbsp; &nbsp;
						<input type="checkbox" name="same_permanent" value="1" <?php echo $same; ?> class="ace-checkbox-2" id="id-disable-check" />
										<label class="lbl" for="id-disable-check"> Same as Present Address!</label>
									</div>
								</div>	
								<div class="row-fluid">	
									<div class="control-group">
										<label class="control-label" for="form-field-54">
										Gardian Name<span class="red">*</span>
										</label>
										<div class="controls">
											<?php
												$StdGardianName = array(
													'name'			=>'StdGardianName',
													'placeholder'	=>'Name Gardian Name',
													'id'			=>'form-field-54',
													'class'			=>'input',
													'value'			=> $std->StdGardianName
													
												);
												echo form_input($StdGardianName);
												echo form_error('StdGardianName');
											?>
										</div>
									</div>			 
								<div>
								<div class="row-fluid">			
									<div class="span6">		
										<div class="control-group">
												<label class="control-label" for="form-field-6">
												Gardian Photo<span class="red">*</span>
												</label>
													
												<div class="controls">
												<?php
									 				$photo = explode('_', @$std->StdGardianPhoto);
													$StdGP_photo = 'media/students/'.@$photo[1].'/'
													.@$photo[2].'/'.@$std->StdGardianPhoto;
												?>	
												<img src="<?php echo base_url().$StdGP_photo;?>"/>	
												 <!-----Photo------>
												  	<input multiple="" name="StdGardianPhoto" type="file" class="id-input-file-3" /> 
												<!-----Photo------>
												</div>
										</div>
									</div>	
								</div>		
								<div class="row-fluid">		
									<div class="span6">	
										<div class="control-group">
											<label class="control-label" for="form-field-6">Gardian signiture</label>
												
											<div class="controls">
											 <!-----Photo------>
											 <?php
									 				$photo = explode('_', @$std->StdGardianSigneture);
													$StdGS_photo = 'media/students/'.@$photo[1].'/'
													.@$photo[2].'/'.@$std->StdGardianSigneture;
												?>	
												<img src="<?php echo base_url().$StdGS_photo;?>"/>
											 	 <input multiple="" name="StdGardianSigneture" type="file" class="id-input-file-3" />
											  <!-----Photo------>
											 </div>
										</div>
									</div>
								</div>	
								
								<div class="row-fluid">
									<div class="span6">	
										<label class="control-label" >Status</label>
										<div class="controls">
											<?php
											// Determine student status depending Database value
												if($std->StdStatus == 0):
													$ban = "checked='checked'";
													$ex = "";
													$current = "";
												elseif($std->StdStatus ==1 ):
													$ban = "";
													$ex = "";
													$current = "checked='checked'";
												else:
													$ban = "";
													$ex = "checked='checked'";
													$current = "";
												endif;
											?>
											
											<label>
												<input id="form-field-radio1" <?php echo $current; ?> name="StdStatus" value="1" type="radio">
												<span class="lbl" for="form-field-radio1"> Current</span>
											 
												<input id="form-field-radio2" <?php echo $ex; ?> name="StdStatus" value="2" type="radio">
												<span class="lbl" for="form-field-radio2"> Ex-student</span>
												
												<input id="form-field-radio3" <?php echo $ban; ?> name="StdStatus" value="0" type="radio">
												<span class="lbl" for="form-field-radio3"> Ban</span>
											</label>
										</div>
									</div>	
								</div>			 
								
								<div class="row-fluid">
									<div class="span6">	
										<label class="control-label" >
										Admission Year<span class="red">*</span>
										</label>
										<div class="controls">	
										<?php 
											 $pro_year = date('Y')-43;
											 $pre_year = date('Y')+10;
											 $year = array();
											 for($i=$pro_year; $i<$pre_year; $i++):
											 	$year[$i] = $i;
											 endfor;
											echo form_dropdown('StdAdmissionYear', $year, $std->StdAdmissionYear);
											echo form_error('StdAdmissionYear');
											echo form_hidden('id', $std->StdDetailsId);
										?>
										</div>
									</div>
								</div>				
							
							</div>
							
						</div>	
					</div>	
			</div><!--/.span-->
		</div><!--/.row-fluid-->
				
					
					 
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Submit
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button>
						 
								
							<?php 
								endforeach;
								echo form_close(); 
							?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->


