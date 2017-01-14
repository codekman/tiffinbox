<script>
function confirmdelete(){
	var conf = confirm("Are you sure to delete this Subject?");
	 
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
				<a href="<?php echo base_url();?>subjects/create">
					<button class="btn btn-primary pull-right">
											<i class="icon-beaker bigger-125"></i>
											Create New Subject
					</button>
				</a>	
				
				
				
				
				<!--ASHIK------>
				 
						<h1>
							<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Classes
							<small>
								<i class="icon-double-angle-right"></i>
								Static &amp; Dynamic Tables
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
							<!--PAGE CONTENT BEGINS-->
							<div class="row-fluid">
								 
								<div class="table-header">
									Results for "Latest Registered Classes"
								</div>

								<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
											</th>
											
											<th><h4 class="smaller blue"><i class="icon-book green"></i> | Subject Name</h4></th>
											<th><h4 class="smaller blue"><i class="icon-user green"></i> | Subject Code</h4></th>
											<th><h4 class="smaller blue"><i class="icon-calendar green"></i> | Class Name</h4></th>
											 
											 

											<th><h4 class="smaller blue"><i class=" icon-cog green"></i> | Options</h4></th>
										</tr>
									</thead>
									<?php 
									// Make class array:
									$classes = array();
									foreach($class as $cls):
										$classes[$cls->Id] = $cls->ClassName.' :: '.$cls->ClassNumaricName ; 
									endforeach;
									 
									 
								$status=array('inactive','active');
								foreach(@$subjects->result() as $row):
									?>		
									<tbody>
										<tr>
											<td class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
											</td>
											
											<td>
												<a href="#" class="btn btn-info no-border">
														<i class="icon-book bigger-100"></i>
													 
													<?php echo @$row->SubjectName; ?>
													
													
														<?php echo (@$row->SubjectIsOptional) ? 
																'<span class="label label-purple label-inverse arrowed-in">
																Can be Optional</span>': '';  
														?>
														
													
												</a>
												 
												<?php if(@$row->SubjectStatus==0):?>
													<span class="label label-warning arrowed">
														<?php echo $status[@$row->SubjectStatus]; ?>
													</span>
												<?php else: ?>
													<span class="label label-success arrowed">
														<?php echo $status[@$row->SubjectStatus]; ?>
													</span>
												
												<?php endif;?>	
										 		
											</td>
										
											
											<td><?php echo @$row->SubjectCode;?></td>
											<td><?php  
											 
											  
											echo @$classes[$row->SubjectClassId]; ?> </td>
											 
									 

											<td class="td-actions">
												<div class="hidden-phone visible-desktop action-buttons">
													 

													<a class="green" href="<?php echo base_url();?>subjects/update/<?php echo $row->Id; ?>">
														<i class="icon-pencil bigger-130"></i>
													</a>

												<a class="red" onclick="confirmdelete()" href="<?php echo base_url(); ?>subjects/delete/<?php echo $row->Id; ?>">
														<i class="icon-trash bigger-130"></i>
													</a>
												</div>

												<div class="hidden-desktop visible-phone">
													<div class="inline position-relative">
														<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
															<i class="icon-caret-down icon-only bigger-120"></i>
														</button>

														<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
															 

															<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																	<span class="green">
																		<i class="icon-edit bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																	<span class="red">
																		<i class="icon-trash bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>

										
									</tbody>
									<?php endforeach; ?>
								</table>
							</div>
 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				 
				
				
				<!--ASHIK------>
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
