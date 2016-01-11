<script>
function confirmdelete(id){
	bootbox.confirm("Are you sure to delete all information of this Payment?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'accounting/deletePayment';?>",
				type: "POST",
				    data: { payment_id  : id },
					success: function(data) { 
						document.location.reload();
					}				 
			});
		}else{
			
			return;
		}
	});
}
function paymentDetails(id){
	$.ajax({
		url: "<?php echo base_url().'accounting/getPaymentdetails';?>",
		type: "POST",
	    data: { payment_id  : id },
		success: function(data) { 
			var paymentDetails = data;
			bootbox.confirm(paymentDetails, function(result) {
			}); 
		}				 
	});
	
}  	
function takePayment(id){
	$.ajax({
		url: "<?php echo base_url().'accounting/getPaymentForm';?>",
		type: "POST",
	    data: { payment_id  : id },
		success: function(data) { 
			var paymentForm = data;
			bootbox.confirm(paymentForm, function(result) {
			}); 
		}				 
	});
	
}
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header row-fluid position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>accounting/create_payment">
					<button class="btn btn-primary pull-right span3">
						<i class="icon-plus bigger-125"></i>
						Create a New Payment
					</button>
				</a>	
				 
				 
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Payments
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
										 	<th><h4 class="smaller blue">Title & Details</h4></th>
											<th><h4 class="smaller blue">Bill To</h4></th>
											<th><h4 class="smaller blue">Medium</h4></th>
											<th><h4 class="smaller blue">Date</h4></th>
											<th><h4 class="smaller blue">Total Amount</h4></th>
											<th><h4 class="smaller blue">Paid</h4></th>
											<th><h4 class="smaller blue">Status</h4></th>
											<th>
													<h4 class="smaller blue"><i class="icon-cog green"></i> | Options</h4>	 
											</th>
										</tr>
									</thead>
									<?php
										 
										$status=array('unpaid','paid');
										foreach(@$payments->result() as $row):
											 
									?>		
									<tbody> 
										<tr> <td>
												<h4><?php echo $row->paymentTitle?></h4>									 								
												<p><?php echo $row->paymentDetails?></p>
											</td>
											 <td>
											 	<?php echo $row->StdName; ?><br/>
											 	Class: <?php echo $row->ClassName.' :: '.$row->ClassNumaricName; ?><br/>
											 	Roll: <?php echo $row->StdRollNo; ?>
											 </td>
											 <td><?php echo $row->medium; ?></td>
											 <td><?php echo date('d-m-Y', strtotime($row->createdDate));?></td>
											 <td><?php echo $row->totalAmount; ?></td>
											 <td><?php echo $row->paidAmount; ?></td>
											 <td><?php echo $status[$row->status]; ?></td>
											<td class="td-actions">
												<a class="blue" onclick="takePayment(<?php echo $row->Id; ?>)" href="javascript:" data-rel="tooltip" data-placement="top" data-original-title="take payment" >
													 <button class="btn btn-mini btn-success">	 
														 <i class="icon-credit-card bigger-130"></i>
													</button>	 
												</a>
												<a class="blue" onclick="paymentDetails(<?php echo $row->Id; ?>)" href="javascript:" data-rel="tooltip" data-placement="top" data-original-title="view invoice" >
													 <button class="btn btn-mini btn-success">	 
														 <i class="icon-eye-open bigger-130"></i>
													</button>	 
												</a>
												<a class="green tooltip-success" data-rel="tooltip" data-placement="top" title="" data-original-title="Edit payment information" href="<?php echo base_url();?>accounting/update_payment/<?php echo $row->Id; ?>">
													 <button class="btn btn-mini btn-success">	 
														 <i class="icon-pencil bigger-130"></i>
													</button>	 
												</a>
												<a class="red tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="Delete payment information" onclick="confirmdelete(<?php echo $row->Id; ?>)" href="javascript:">
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
