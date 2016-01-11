<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header row-fluid position-relative">
		 		<a href="<?php echo base_url();?>employee/create">
					<button class="btn btn-primary pull-right span3">
						<i class="icon-plus bigger-125"></i>
						Create a New Staff / Teacher 
					</button>
				</a>	
				 
				 
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Staff
					<small>
						<i class="icon-double-angle-right"></i>
						Static &amp; Dynamic Tables
					</small>
				</h1>
		</div><!--/.page-header-->

					<div class="row-fluid">
						
						
						<div class="span12">
						<!----------------Message------------>
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
											<th><span class="smaller blue"><i class="icon-user green"></i> | Photo</span></th>
											<th><span class="smaller blue"><i class="icon-comments-alt green"></i> | Employee Details</span></th>
											<th><span class="smaller blue"><i class="icon-cog green"></i> | Options</span></th>
										</tr>
									</thead>
									<?php 
										$status=array('inactive','active');
										foreach(@$teachers->result() as $row):
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
												<ul class="ace-thumbnails">
														<li> 
															<img alt="<?php 
																			echo $row->EmployeePhoto; ?>" src="<?php 
																			echo base_url(); 
																		?>media/employee/<?php 
																			$photo = explode('-', @$row->EmployeePhoto);
														 					echo $employee_photo = @$photo[1].'/'.@$row->EmployeePhoto; 
														 				?>"/>
															<div class="tags">
																<?php if(@$row->EmployeeStatus==0):?>
																	<span class="label label-warning arrowed">
																		<?php echo $status[@$row->EmployeeStatus]; ?>
																	</span>
																<?php else: ?>
																	<span class="label label-success arrowed">
																		<?php echo $status[@$row->EmployeeStatus]; ?>
																	</span>
																<?php endif;?> 
																	 
															</div>
													 	</li>
													 </ul> 									
			
											</td>
											 <td>
											 	<span class="lead blue">
												 	<?php
												 		echo @$row->EmployeeName;
												 		// get employee post:
												 		@$e_post = $this->db->get_where('designations', array('Id'=>$row->EmployeeDesignationId))->row()->designationName; 
												 	?>
												 </span>
												 <br/>
												 <span class="label"><?php echo @$e_post; ?></span><br/>
												 <?php		
											 		echo @$row->EmployeeEmail.'<br/>'
											 			.@$row->EmployeeMobile.'<br/>'.@$row->EmployeeAddress; 
											 	?>
											 </td>
											<td class="td-actions">
						<a class="blue tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="view teacher information" onclick="employeeDetails(<?php echo $row->Id; ?>)" href="javascript:">
							 <button class="btn btn-mini btn-info">
								 <i class=" icon-eye-open bigger-130"></i>
							 </button>
						 </a>
						 
						 <a class="blue tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="view teacher's Id Crad" onclick="employeeIdCard(<?php echo $row->Id; ?>)" href="javascript:">
							 <button class="btn btn-mini btn-info">
								 <i class=" icon-credit-card bigger-130"></i>
							 </button>
						 </a>
						 
						<a class="green tooltip-success" data-rel="tooltip" data-placement="top" title="" data-original-title="Edit teacher information" href="<?php echo base_url();?>employee/update/<?php echo $row->Id; ?>">
							 <button class="btn btn-mini btn-success">	 
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
										
										<!-- store teacher Id card and information details -->
										<tr class="hide">
										<td>
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
				                                        <?php //echo $this->pagination->create_links();  ?>
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
<script>
function confirmdelete(id){
	 
	bootbox.confirm("Are you sure to delete all information of this Employee?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'employee/delete';?>",
				type: "POST",
				    data: { employee_id  : id },
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


function employeeDetails(id){
	//alert(id);
	var stdDetails = $('#details'+id).html();
	 bootbox.confirm(stdDetails, function(result) {
						 
	});
}	

function employeeIdCard(id){
	var IdCard = $('#employeeIdCard'+id).html();
	//alert(IdCard);
	 bootbox.confirm(IdCard, function(result) {
						 
	});
}	
</script>
<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>