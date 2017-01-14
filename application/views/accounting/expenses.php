<script>
function confirmdelete(id){
	 
	bootbox.confirm("Are you sure to delete all information of this Expense?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'accounting/delete_expense';?>",
				type: "POST",
				    data: { expense_id  : id },
					success: function(data) { 
							 
									document.location.reload();
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
				<a href="<?php echo base_url();?>accounting/create_expense">
					<button class="btn btn-primary pull-right span3">
						<i class="icon-plus bigger-125"></i>
						Create a New Expence
					</button>
				</a>	
				 
				 
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Expenses
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
									Results for "Latest Registered Staff"
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
											<th><h4 class="smaller blue">Title & Details</h4></th>
											<th><h4 class="smaller blue">Expense Category</h4></th>
											<th><h4 class="smaller blue">Mediam</h4></th>
											<th><h4 class="smaller blue">Date</h4></th>
											<th><h4 class="smaller blue">Amount</h4></th>
											<th>
													<h4 class="smaller blue"><i class="icon-cog green"></i> | Options</h4>	 
											</th>
										</tr>
									</thead>
									<?php 
										$status=array('inactive','active');
										foreach(@$expenses->result() as $row):
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
												<h4><?php echo $row->title?></h4>									 								
												<p><?php echo $row->details?></p>
											</td>
											<?php
												#get expence_categories
												$categories[]='';
												foreach($expense_categories->result() as $items){
													$categories[$items->Id] = $items->categoryName;
												}
											?>
											
											 <td><?php echo $categories[$row->expenceCategoryId]; ?></td>
											 <td><?php echo $row->mediam; ?></td>
											 <td><?php echo date('Y-m-d', strtotime($row->date));?></td>
											 <td><?php echo $row->amount; ?></td>
											<td class="td-actions">
											 
												<a class="green tooltip-success" data-rel="tooltip" data-placement="top" title="" data-original-title="Edit expense information" href="<?php echo base_url();?>accounting/update_expense/<?php echo $row->Id; ?>">
													 <button class="btn btn-mini btn-success">	 
														 <i class="icon-pencil bigger-130"></i>
													</button>	 
												</a>
						
												<a class="red tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="Delete expense information" onclick="confirmdelete(<?php echo $row->Id; ?>)" href="javascript:">
													<button class="btn btn-mini btn-danger">	
														<i class="icon-trash bigger-130"></i>
													</button>	
												</a>
																		 
											</td>
											 
										</tr>
										
										<!-- store teacher Id card and information details -->
										<tr class="hide">
										<td >
										<div id="details<?php echo $row->Id; ?>" class="hide"> 
											<div class="span5">
												<h4 class="row-fluid header smaller lighter orange">
														<span class="span7">
															<i class="icon-bell-alt"></i>
															Employee's Details Information 
														</span><!--/span--> 
													</h4>
												
												<div class="span1">
													 
													<img src="<?php echo base_url().'media/employee/'.$employee_photo;?>"/>
													<br/> 
													 
													<?php if(@$row->EmployeeStatus==0):?>
														<span class="label label-warning arrowed-right">
															<?php echo $status[@$row->EmployeeStatus]; ?>
														</span>
													<?php else: ?>
														<span class="label label-success arrowed-right">
															<?php echo $status[@$row->EmployeeStatus]; ?>
														</span>
													<?php endif;?> 
														
															 
												</div>
												<div class="span3">
													<span class="lead blue"><?php echo @$row->EmployeeName; ?></span>
												 	
												 	<br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Email:&nbsp;&nbsp; 
												 	 <strong  class="blue"><?php echo $row->EmployeeEmail; ?></strong >
												 	 &nbsp;&nbsp;&nbsp;&nbsp;
												 	 <br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Contact:&nbsp;&nbsp; 
												 	<strong  class="blue"><?php echo $row->EmployeeMobile; 
												 	 						?>
												 	 </strong > 
												 	 
												 	<br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Date of Birth:&nbsp;&nbsp;
												 	  <strong  class="blue"><?php echo  date('jS M, Y', strtotime($row->EmployeeBrithDate)); 
												 	 					?>
												 	  </strong > 
												 	
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	Blood Group: &nbsp;&nbsp;
												 	<strong  class="blue"><?php echo @$row->EmployeeBloodGroup; ?></strong > 
												 	  <br/>
													<i class="icon-map-marker blue "></i>&nbsp;&nbsp; 
													Present Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo $row->EmployeeAddress;?></strong>
													
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	 User Name: &nbsp;&nbsp;
												 	 <strong  class="blue"><?php echo @$row->EmployeeUserName; ?></strong > 
												 	 
												</div>		
											</div>	
											
										</div><!--end of details --->		
										<div id="employeeIdCard<?php echo $row->Id; ?>" class="hide">
										 		<table >
										 		<tr>
										 			<td></td>
										 			<td></td>
										 		</tr>
										 		<tr>
										 			<td><img src="<?php echo base_url()."media/employee/$photo[1]/Qr.png";?>"></td>
										 			<td>
										 				<span class="lead blue"><?php echo @$row->EmployeeName; ?></span>
												 	
												 	<br/>
												 	  
												 	<i class="icon-caret-right blue"></i>
												 	Post:&nbsp;&nbsp;
												 	<strong  class="blue"><?php echo @$row->StdCurrentId; ?></strong > 
												 	 
												 	 
												 	 <br/>
												 	 <i class="icon-phone blue"></i>&nbsp;&nbsp;Phone:&nbsp;&nbsp;
												 	<strong class="blue"><?php echo @$row->EmployeeMobile; ?></strong>
													
													<br/>
													<i class="icon-map-marker blue "></i>&nbsp;&nbsp; 
													Present Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo $row->EmployeeAddress;?></strong>
												 
										 			</div>	
										 			</td>
										 		</tr>
										 	</table>
										 </td><!--End of Id Card--> 
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
