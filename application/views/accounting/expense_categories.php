<script>
$( document ).ready(function() {
	//$('#submit_update').click(function(){
$('.submit_update').click(function() {	 
				 	console.log($('.editable-input input').val());
				 	alert($('.editable-input input').val());
	}); 
});
function confirmdelete(id){
	bootbox.confirm("Are you sure to delete all information of this Department?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'accounting/delete_expensecategory';?>",
				type: "POST",
				    data: { category_id  : id },
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

  
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header row-fluid position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>accounting/createcategory">
					<button class="btn btn-primary pull-right span3">
						<i class="icon-plus bigger-125"></i>
						Create expense Category 
					</button>
				</a>	
				 
				 
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					expense Categories
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
											<th><h4 class="smaller blue"><i class="icon-bookmark green"></i> | expense Categories Name & Status</h4></th>
											 
											<th>
													<h4 class="smaller blue"><i class="icon-cog green"></i> | Options</h4>	 
											</th>
										</tr>
									</thead>
									<?php 
										$status=array('inactive','active');
										foreach(@$category->result() as $row):
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
												<span class="editable editable-click username" style="display: inline;"><?php echo $row->categoryName; ?></span>
														 
																<?php if(@$row->status==0):?>
																	<span class="label label-warning arrowed">
																		<?php echo $status[@$row->status]; ?>
																	</span>
																<?php else: ?>
																	<span class="label label-success arrowed">
																		<?php echo $status[@$row->status]; ?>
																	</span>
																<?php endif;?> 
																	 
													 	  									
			
											</td>
										 
											<td class="td-actions"> 
												<a class="green tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="edit department information" href="<?php echo base_url();?>accounting/update_expensecategory/<?php echo $row->Id; ?>">
													<button class="btn btn-mini btn-warning">	
														<i class="icon-pencil bigger-130"></i>
													</button>	
												</a>
												<a class="red tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="Delete teacher information" onclick="confirmdelete(<?php echo $row->Id; ?>)" href="javascript:">
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
