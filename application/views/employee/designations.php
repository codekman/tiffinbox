<script>
$( document ).ready(function() {
	//$('#submit_update').click(function(){
$('.submit_update').click(function() {		
	
				 	console.log($('.editable-input input').val());
				 	alert($('.editable-input input').val());
				 
				}); 
});
function confirmdelete(id){
	 
	bootbox.confirm("Are you sure to delete all information of this Designation?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'employee/deletedesignation';?>",
				type: "POST",
				    data: { designation_id  : id },
					success: function(data) { 
							bootbox.confirm(data, function(e) {
								if(e) {
									document.location.reload();
								}
							});  
		 			}				 
			});
		}else{
			
			return;
		}
	});
	
}


function teacherDetails(id){
	//alert(id);
	var stdDetails = $('#details'+id).html();
	 bootbox.confirm(stdDetails, function(result) {
						 
	});
}	

function teacherIdCard(id){
	var IdCard = $('#teacherIdCard'+id).html();
	//alert(IdCard);
	 bootbox.confirm(IdCard, function(result) {
						 
	});
}	
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header row-fluid position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>employee/createdesignation">
					<button class="btn btn-primary pull-right span3">
						<i class="icon-plus bigger-125"></i>
						Create Designation 
					</button>
				</a>	
				 
				 
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Designations
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
									Results for "Latest Registered Teachers"
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
											<th><h4 class="smaller blue"><i class="icon-bookmark green"></i> |Designation</h4></th>
											<!--th><h4 class="smaller blue"><i class="icon-sitemap green"></i> | Department</h4></th-->
											 
											<th>
													<h4 class="smaller blue"><i class="icon-sitemap green"></i> | Department</h4>	 
											</th>
											<th>
													<h4 class="smaller blue"><i class="icon-cog green"></i> | Options</h4>	 
											</th>
										</tr>
									</thead>
									<?php 
									//make all department array:
									$dept = array();
									foreach($departments as $dept_list):
											$dept[$dept_list->Id] = $dept_list->departmentName;
									endforeach;
										$status=array('inactive','active');
										foreach(@$designations->result() as $row):
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
												<span class="editable editable-click username" style="display: inline;"><?php echo $row->designationName; ?></span>
														 
																<?php if(@$row->designationStatus==0):?>
																	<span class="label label-warning arrowed">
																		<?php echo $status[@$row->designationStatus]; ?>
																	</span>
																<?php else: ?>
																	<span class="label label-success arrowed">
																		<?php echo $status[@$row->designationStatus]; ?>
																	</span>
																<?php endif;?> 
																	 
													 	  									
			
											</td>
										 
											<td>
												<?php
													echo @$dept[$row->employeeDepartmentId];
													
												?>
											</td>	
											   
											<td class="td-actions">
												 
						<a class="green tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="edit designation information" href="<?php echo base_url();?>employee/updatedesignation/<?php echo $row->Id; ?>">
							<button class="btn btn-mini btn-warning">	
								<i class="icon-pencil bigger-130"></i>
							</button>	
						</a> 
						<a class="red tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="Delete designation information" onclick="confirmdelete(<?php echo $row->Id; ?>)" href="javascript:">
							<button class="btn btn-mini btn-danger">	
								<i class="icon-trash bigger-130"></i>
							</button>	
						</a>
												 
											</td>
											 
										</tr>
										
							 
								<?php endforeach; ?>
									
										<tr>
								        	<td colspan="12">
										  		<nav class="pagination pagination-centered">
				                                    <ul>
				                                        <?php echo $this->pagination->create_links();  ?>
				                                    </ul>
				                                </nav>
					 						</td>
								        </tr>	
									</tbody>
									
								</table>
							</div>
 
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				 
				
				
				
				
				
				<!--ASHIK------>
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
