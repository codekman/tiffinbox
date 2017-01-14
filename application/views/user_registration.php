<div class="row-fluid">
	<div class="position-relative">
	<div id="signup-box" class="signup-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="icon-group blue"></i>
													New User Registration
												</h4>

												<div class="space-6"></div>
												<p> Enter your details to begin: </p>
 												<!--check any alert message or not -->
												 <?php
												 	if($form_data['er']):
													
												 ?>
												 
												 <!--Print Wrong Alert Message: -->		
														<div class="alert alert-danger inline no-margin">
															<button type="button" class="close" data-dismiss="alert">
																<i class="icon-remove red"></i>
															</button>
														
															<i class="icon-warning-sign bigger-120 blue"></i>
															<?php echo $form_data['er']; ?>
														</div>
													<?php endif; ?>	
												
												<!-- From Begain -->
												<?php echo form_open('welcome/createuser');?>
													<fieldset>
														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
																<?php 
																//var_dump($form_data);
																
																//foreach($form_data as $row):
																	$email = array(
																		'name'			=> 'email',
																		'placeholder'	=> 'Email',
																		'class'			=> 'span12',
																		'value'			=> $form_data['email']
																	);
																	echo form_input($email);
																	echo '<span class="help-inline">'.form_error('email').'</span>';
																?>
																
															 
																<i class="icon-envelope"></i>
															</span>
														</label>
														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
																
																<?php 
																	$mobile = array(
																		'name'	=> 'mobile',
																		'placeholder'	=> 'Mobile',
																		'class'			=> 'span12',
																		'maxlength'		=> '11',
																		'value'			=> $form_data['mobile']
																	);
																	echo form_input($mobile);
																	echo '<span class="help-inline">'.form_error('mobile').'</span>';
																?>
																
															 
																<i class="icon-phone"></i>
															</span>
														</label>
														<label class="control-group warning">
															<?php
															$user_type = $this->db->get_where('user_type', array('status'=>1))->result();
															$option[''] = '---- I want to be a ----';
																foreach($user_type as $row):
																	$option[$row->id] = $row->type_name;
																endforeach;
																echo form_dropdown('type_id',$option, $form_data['type_id'],'class="span12"');
																echo '<span class="help-inline">'.form_error('type_id').'</span>';
															?>
														</label >	
														
														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
																
																<?php 
																	$full_name = array(
																		'name'	=> 'full_name',
																		'placeholder'	=> 'Full name',
																		'class'			=> 'span12',
																		'value'			=> $form_data['full_name']
																	);
																	echo form_input($full_name);
																	echo '<span class="help-inline">'.form_error('full_name').'</span>';
																?>
																
															 
																<i class="icon-user"></i>
															</span>
														</label>
														
														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
																
																
																<?php 
																	$user_name = array(
																		'name'	=> 'user_name',
																		'placeholder'	=> 'Username',
																		'class'			=> 'span12',
																		'value'			=> $form_data['user_name']
																	);
																	echo form_input($user_name);
																	echo '<span class="help-inline">'.form_error('user_name').'</span>';
																?>
																
															 
																<i class="icon-user"></i>
															</span>
														</label>

														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
																<?php
																	$password = array(
																		'name'		=> 'password',
																		'placeholder'	=> 'Password',
																		'class'			=> 'span12',
																		
																	);
																	echo form_password($password);
																	echo '<span class="help-inline">'.form_error('password').'</span>';
																	
																?>
																
																 
																<i class="icon-lock"></i>
															</span>
														</label>

														<label class="control-group warning">
															<span class="block input-icon input-icon-right">
															 <?php
																	$cpassword = array(
																		'name'		=> 'cpassword',
																		'placeholder'	=> 'Password Repeat',
																		'class'			=> 'span12'
																	);
																	echo form_password($cpassword);
																	echo '<span class="help-inline">'.form_error('cpassword').'</span>';
																	
																?>
																<i class="icon-retweet"></i>
															</span>
														</label>

														<label class="control-group warning">
															<input type="checkbox" name='agree'/>
															
															<span class="lbl">
																I accept the
																<a href="#">User Agreement</a>
															</span>
														</label>
														<span class="control-group warning">
															<?php echo '<span class="help-inline">'.form_error('agree').'</span>'; ?>
														</span>
														<div class="space-24"></div>

														<div class="clearfix">
															<button type="reset" class="width-30 pull-left btn btn-small">
																<i class="icon-refresh"></i>
																Reset
															</button>

															<button type="submit" name="btn" value="val" class="width-65 pull-right btn btn-small btn-success">
																Register
																<i class="icon-arrow-right icon-on-right"></i>
															</button>
														</div>
													</fieldset>
												<?php 
												
												echo form_close();
												//endforeach;
												
												?>
											</div>

		</div><!--/position-relative-->
	</div>