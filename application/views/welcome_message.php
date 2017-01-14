
	
							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Please Enter Your Information
												</h4>

												<div class="space-6"></div>
												
												 <!--check any alert message or not -->
												 <?php
												 	if($this->session->flashdata('status_right')):
													
												 ?>
												 <!--Print Success Alert Message: -->
														
														<div class="alert alert-success inline no-margin">
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
														<div class="alert alert-danger inline no-margin">
															<button type="button" class="close" data-dismiss="alert">
																<i class="icon-remove red"></i>
															</button>
														
															<i class="icon-warning-sign bigger-120 blue"></i>
															<?php echo $this->session->flashdata('status_wrong'); ?>
														</div>
													<?php endif; ?>	
											 
												<?php echo form_open('welcome/login'); ?>
													 
												<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<?php
																	 $user_name	= array(
																	  			'name'	=>'user_name',
																	  			'id'	=>'user_name',
																	  			'placeholder'	=>'Enter your User name',
																	  			'class'			=> 'span12'
																	  );
																	  echo form_input($user_name).'<br/>';
																?>
																
																 
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<?php
																	 $user_pass	= array(
													  				'name'	=>'password',
													  				'id'	=>'password',
													  				'placeholder'	=>'Enter your password',
													  				'class'			=> 'span12'
																	  );
																	  
																	  echo form_password($user_pass).'<br/>';
																?>
																
															 
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
															<label class="inline">
																<input type="checkbox" />
																<span class="lbl"> Remember Me</span>
															</label>
															
															
															<button  type="submit" name="btnlog_" value="val_log" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
															
														</div>

														<div class="space-4"></div>
													</fieldset>
												 <?php  echo form_close(); ?>

												 

											 
											</div><!--/widget-main-->

											<div class="toolbar clearfix">
												<!--div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														I forgot my password
													</a>
												</div-->

												<div>
													<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
														I want to register
														<i class="icon-arrow-right"></i>
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Retrieve Password
												</h4>

												<div class="space-6"></div>
												<p>
													Enter your email and to receive instructions
												</p>

												<form />
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="email" class="span12" placeholder="Email" />
																<i class="icon-envelope"></i>
															</span>
														</label>

														<div class="clearfix">
															<button onclick="return false;" class="width-35 pull-right btn btn-small btn-danger">
																<i class="icon-lightbulb"></i>
																Send Me!
															</button>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													Back to login
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->

									<div id="signup-box" class="signup-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="icon-group blue"></i>
													New User Registration
												</h4>

												<div class="space-6"></div>
												<p> Enter your details to begin: </p>

												<?php echo form_open('welcome/createuser');?>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<?php 
																	$email = array(
																		'name'	=> 'email',
																		'placeholder'	=> 'Email',
																		'class'			=> 'span12'
																	);
																	echo form_input($email);
																	echo form_error('email');
																?>
																
															 
																<i class="icon-envelope"></i>
															</span>
														</label>
														<label>
															<span class="block input-icon input-icon-right">
																
																<?php 
																	$mobile = array(
																		'name'	=> 'mobile',
																		'placeholder'	=> 'Mobile',
																		'class'			=> 'span12',
																		'maxlength'		=> '11'
																	);
																	echo form_input($mobile);
																	echo form_error('mobile');
																?>
																
															 
																<i class="icon-comments"></i>
															</span>
														</label>
														<label>
															<?php
															$user_type = $this->db->get_where('user_type', array('status'=>1))->result();
															$option[''] = '---- I want to be a ----';
																foreach($user_type as $row):
																	$option[$row->id] = $row->type_name;
																endforeach;
																echo form_dropdown('type_id',$option, 'default','class="span12"');
																echo form_error('type_id');
															?>
														</label>	
														
														<label>
															<span class="block input-icon input-icon-right">
																
																<?php 
																	$full_name = array(
																		'name'	=> 'full_name',
																		'placeholder'	=> 'Full name',
																		'class'			=> 'span12'
																	);
																	echo form_input($full_name);
																	echo form_error('full_name');
																?>
																
															 
																<i class="icon-user"></i>
															</span>
														</label>
														
														<label>
															<span class="block input-icon input-icon-right">
																
																
																<?php 
																	$user_name = array(
																		'name'	=> 'user_name',
																		'placeholder'	=> 'Username',
																		'class'			=> 'span12'
																	);
																	echo form_input($user_name);
																	echo form_error('user_name');
																?>
																
															 
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<?php
																	$password = array(
																		'name'		=> 'password',
																		'placeholder'	=> 'Password',
																		'class'			=> 'span12'
																	);
																	echo form_password($password);
																	echo form_error('password');
																	
																?>
																
																 
																<i class="icon-lock"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
															 <?php
																	$cpassword = array(
																		'name'		=> 'cpassword',
																		'placeholder'	=> 'Password Repeat',
																		'class'			=> 'span12'
																	);
																	echo form_password($cpassword);
																	echo form_error('cpassword');
																	
																?>
																<i class="icon-retweet"></i>
															</span>
														</label>

														<label>
															<input type="checkbox" name='agree'/>
															<?php echo form_error('agree'); ?>
															<span class="lbl">
																I accept the
																<a href="#">User Agreement</a>
															</span>
														</label>

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
												<?php echo form_close();?>
											</div>

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													<i class="icon-arrow-left"></i>
													Back to login
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/signup-box-->
								</div><!--/position-relative-->
							</div>
						
		