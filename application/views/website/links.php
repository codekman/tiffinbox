<script>
function confirmdelete(){
	var conf = confirm("Are you sure to delete this link?");
	 
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
				<a href="<?php echo base_url();?>website/createlink">
					<button class="btn btn-primary pull-right">
											<i class="icon-plus bigger-125"></i>
											Create New link
					</button>
				</a>	
				
				
				
				
				<!--ASHIK------>
				 
						<h1>
							<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							All Exams
							<small>
								<i class="icon-double-angle-right"></i>
								Static &amp; Dynamic Tables
							</small>
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
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
											<th>Link Name</th>
											<th>Link URL</th>
											<th>Link Title</th>
											<th></th>
										</tr>
									</thead>
									<?php 
										$status=array('inactive','active');
										foreach(@$links->result() as $row):
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
												 <?php echo @$row->name; ?> 
											</td>
											<td><?php echo @$row->url;?></td>
											
											 
											 <td><?php echo @$row->title;?></td> 
											 
										 
									 

											<td class="td-actions">
												<div class="hidden-phone visible-desktop action-buttons">
													 

													<a class="green" href="<?php echo base_url();?>website/updatelink/<?php echo $row->Id; ?>">
														<i class="icon-pencil bigger-130"></i>
													</a>

													<a class="red" onclick="confirmdelete()" href="<?php echo base_url();?>website/deletelink/<?php echo $row->Id; ?>">
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
