
<script>
function confirmdelete(id){
	bootbox.confirm("Are you sure to delete all information of this Student?", function(result) {
		if(result) {
			$.ajax({
				url: "<?php echo base_url().'students/delete';?>",
				type: "POST",
				    data: { std_id  : id },
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

function stuDetails(id){
	var stdDetails = $('#details'+id).html();
	 bootbox.confirm(stdDetails, function(result) {
						 
	});
}	
function stuIdCard(id){
	var IdCard = $('#stdIdCard'+id).html();
	//alert(IdCard);
	 bootbox.confirm(IdCard, function(result) {
						 
	});
				 
}
 </script>

<div class="page-content">
 
<script>
$( document ).ready(function() {
$("#bootbox-confirm").on(ace.click_event, function() {
					bootbox.confirm("Are you sure?", function(result) {
						if(result) {
							bootbox.alert("You are sure!");
						}
					});
				});
		});
</script>

	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>students/create">
					<button class="btn btn-primary pull-right">
						<i class="icon-plus bigger-125"></i>
						Create New Student
					</button>
				</a>
				<h1>
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Students
					<small>
						<i class="icon-double-angle-right"></i>
						<a href="<?php echo base_url()?>students/getpdf/<?php echo ($this->input->post('StdClassId')!='') ? $this->input->post('StdClassId'):''; ?>"target="_blank">
						<button class="btn btn-info btn-mini">
							Print OR PDF
							<i class="icon-print  bigger-125 icon-on-right"></i>
						</button>
						</a> 
						<a href="<?php echo base_url()?>students/getxl/<?php echo ($this->input->post('StdClassId')!='') ? $this->input->post('StdClassId'):''; ?>">
						<button class="btn btn-info btn-mini">
							XL
							<i class="icon-list  bigger-125 icon-on-right"></i>
						</button>
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
						 <?php
						 	#get all classes:
						 	$classes = $this->db->get_where('classes', array('ClassStatus'=>1))->result();
						 	 
						 ?>
							<div class="row-fluid">
								<form class="form-search pull-right" method="POST" action="<?php echo base_url().'students';?>" />
									<select class="chzn-select" name="StdClassId" id="form-field-select-3" data-placeholder="Filter by Class Name">
											<option value="" />
											<?php foreach($classes as $class){
												if($this->input->post('StdClassId') == $class->Id){
													echo '<option value="'.$class->Id.'" selected />'.$class->ClassName.' :: '.$class->ClassNumaricName;
												}
												echo '<option value="'.$class->Id.'" />'.$class->ClassName.' :: '.$class->ClassNumaricName;
											}?>
											 
										</select>
									<button  type="submit" class="btn btn-purple btn-small">
										Filter
										<i class="icon-search icon-on-right bigger-110"></i>
									</button>
								</form>
							 
								<div class="table-header">
									Results for "Latest Registered Students"
								</div>
								
								
									<table id="sample-table-2" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="center">
													<label><input type="checkbox" /><span class="lbl"></span></label>
												</th>
												
												<th>
													<h4 class="smaller blue"><i class="icon-user green"></i> | Photo</h4>													
												</th>
												
												<th>
													<h4 class="smaller blue"><i class="icon-bullhorn green"></i> | Student's Detail</h4>	
												</th>
												
												<th>
													<h4 class="smaller blue"><i class="icon-comments-alt green"></i> | Contact</h4> 
												</th>
												
												<th>
													<h4 class="smaller blue"><i class="icon-cog green"></i> | Options</h4>	 
												</th>
											</tr>
										</thead>
												<?php 
												
												 
													$status=array('Banned','Current ','Ex-');
													foreach(@$students->result() as $row):
													
													$photo = explode('_', @$row->StdProfilePhoto);
												 
													$Std_photo = 'media/students/'.@$photo[1]
													.'/'.@$photo[2].'/'.@$row->StdProfilePhoto;
													 
												?>
												
										<tbody>
											<tr>
												<td class="center">
													<label>
														<input type="checkbox" />
														<span class="lbl"></span>
													</label>
												</td>
	
												<td >
													<ul class="ace-thumbnails">
														<li> 
										<img src="<?php echo base_url().$Std_photo;?>"/>
															<div class="tags">
																<?php if(@$row->StdStatus==0):?>
																	<span class="label label-warning arrowed">
																		<?php echo $status[@$row->StdStatus]; ?>
																	</span>
																<?php else: ?>
																	<span class="label label-success arrowed">
																		<?php echo $status[@$row->StdStatus]; ?>
																	</span>
																<?php endif;?> 
																	<span class="label label-info arrowed">
																		<?php echo $row->StdAdmissionYear; ?> Batch
																	</span>
															</div>
													 	</li>
													 </ul> 
												</td>
												
												 <td>
												 	<span class="lead blue"><?php echo @$row->StdName; ?></span>
												 	
												 	<br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Roll #&nbsp;&nbsp; 
												 	 <strong  class="blue"><?php echo $row->StdRollNo; ?></strong >
												 	 
												 	 <br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Section:&nbsp;&nbsp; 
												 	<strong  class="blue"><?php echo ucwords($row->StdSectionId
												 	 						.' :: '.$row->SectionName); 
												 	 						?>
												 	 </strong > 
												 	 
												 	 <br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Class:&nbsp;&nbsp;
												 	  <strong  class="blue"><?php echo ucwords($row->ClassName
												 	 						.' :: '.$row->ClassNumaricName); 
												 	 					?>
												 	  </strong > 
												 	  
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	Student ID # &nbsp;&nbsp;
												 	<strong  class="blue"><?php echo @$row->StdCurrentId; ?></strong > 
												 	 
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	 Student Cash ID # &nbsp;&nbsp;
												 	 <strong  class="blue"><?php echo @$row->StdCashId; ?></strong > 
												 	 	 
												 </td>
												 
												 <td>
												 	<i class="icon-phone blue"></i>&nbsp;&nbsp;Phone:&nbsp;&nbsp;
												 	<strong class="blue"><?php echo @$row->StdContactNo; ?></strong>
													
													<br/>
													<i class="icon-globe blue"></i>&nbsp;&nbsp; Present Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo $row->StdPresentAddress;?></strong>
													
													<br/>OR<br/>
													Parmanent Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo @$row->StdPermanentAddress; ?></strong>
												 </td>
												<td class="td-actions">
													<div class="hidden-phone visible-desktop action-buttons">
													 
														<a class="blue" onclick="stuDetails(<?php echo $row->StdDetailsId; ?>)" href="javascript:">	 
															<i class="green icon-eye-open bigger-130 detail"></i>
														 </a>
														<a class="blue" onclick="stuIdCard(<?php echo $row->StdDetailsId; ?>)" href="javascript:">	 
															<i class="green  icon-credit-card bigger-130 detail"></i>
														 </a>
														 <a class="blue"   href="<?php echo base_url();?>students/update/<?php echo $row->StdDetailsId; ?>">
															<i class="editable icon-pencil bigger-130"></i>
														 </a>
	
														<a class="red" onclick="confirmdelete(<?php echo $row->StdDetailsId; ?>)" 
															href="javascript:">
															<i class="icon-trash bigger-130"></i>
														</a>
													</div>
												</td>
												
											</tr>
										<!-- store student Id and information--> 
										<tr class="hide">
										<td >
											<div id="details<?php echo $row->StdDetailsId; ?>" class="hide"> 
											<div class="span5">
												<h3 class="row-fluid header smaller lighter orange">
														<span class="span7">
															<i class="icon-bell-alt"></i>
															Student's Information Details
														</span><!--/span--> 
													</h3>
												
												<div class="span1">
													 
													<img src="<?php echo base_url().$Std_photo;?>"/>
													<br/> 
													<span class="label label-info arrowed-right">
														<?php echo $row->StdAdmissionYear; ?> Batch
													</span>
								 					<br/>
													<?php if(@$row->StdStatus==0):?>
														<span class="label label-warning arrowed-right">
															<?php echo $status[@$row->StdStatus].' student'; ?>
														</span>
													<?php else: ?>
														<span class="label label-success arrowed-right">
															<?php echo $status[@$row->StdStatus].' student'; ?>
														</span>
													<?php endif;?> 
														
															 
												</div>
												<div class="span3">
													<span class="lead blue"><?php echo @$row->StdName; ?></span>
												 	
												 	<br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Roll #&nbsp;&nbsp; 
												 	 <strong  class="blue"><?php echo $row->StdRollNo; ?></strong >
												 	 &nbsp;&nbsp;&nbsp;&nbsp;
												 	 <i class="icon-caret-right blue"></i>
												 	 Section:&nbsp;&nbsp; 
												 	<strong  class="blue"><?php echo ucwords($row->StdSectionId
												 	 						.' :: '.$row->SectionName); 
												 	 						?>
												 	 </strong > 
												 	 
												 	<br/>
												 	 <i class="icon-caret-right blue"></i>
												 	 Class:&nbsp;&nbsp;
												 	  <strong  class="blue"><?php echo ucwords($row->ClassName
												 	 						.' :: '.$row->ClassNumaricName); 
												 	 					?>
												 	  </strong > 
												 	  
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	Student ID # &nbsp;&nbsp;
												 	<strong  class="blue"><?php echo @$row->StdCurrentId; ?></strong > 
												 	 
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	 Student Cash ID # &nbsp;&nbsp;
												 	 <strong  class="blue"><?php echo @$row->StdCashId; ?></strong > 
												 	 	
												 	 <br/>
												 	 <i class="icon-phone blue"></i>&nbsp;&nbsp;Phone:&nbsp;&nbsp;
												 	<strong class="blue"><?php echo @$row->StdContactNo; ?></strong>
													
													<br/>
													<i class="icon-map-marker blue "></i>&nbsp;&nbsp; 
													Present Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo $row->StdPresentAddress;?></strong>
													
													<br/>OR<br/>
													<i class="icon-map-marker blue"></i>&nbsp;&nbsp; 
													Parmanent Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo @$row->StdPermanentAddress; ?></strong>	
												</div>		
											</div>	
											
										</div><!--end of details --->	 
										<div id="stdIdCard<?php echo $row->StdDetailsId; ?>" class="hide">
										 		<table >
										 		<tr>
										 			<td></td>
										 			<td></td>
										 		</tr>
										 		<tr>
										 			<td><img src="<?php echo base_url()."media/students/$photo[1]/$photo[2]/Qr.png";?>"></td>
										 			<td>
										 				<span class="lead blue"><?php echo @$row->StdName; ?></span>
												 	
												 	<br/>
												 	  
												 	<i class="icon-caret-right blue"></i>
												 	Student ID # &nbsp;&nbsp;
												 	<strong  class="blue"><?php echo @$row->StdCurrentId; ?></strong > 
												 	 
												 	<br/>
												 	<i class="icon-caret-right blue"></i>
												 	 Student Cash ID # &nbsp;&nbsp;
												 	 <strong  class="blue"><?php echo @$row->StdCashId; ?></strong > 
												 	 	
												 	 <br/>
												 	 <i class="icon-phone blue"></i>&nbsp;&nbsp;Phone:&nbsp;&nbsp;
												 	<strong class="blue"><?php echo @$row->StdContactNo; ?></strong>
													
													<br/>
													<i class="icon-map-marker blue "></i>&nbsp;&nbsp; 
													Present Address:&nbsp;&nbsp;<br/>
													<strong class="blue"><?php echo $row->StdPresentAddress;?></strong>
												 
										 			</div>	
										 			</td>
										 		</tr>
										 	</table>
										 </td><!--End of Id Card--> 
										 </tr>
										<?php endforeach; ?>
									</tbody>
 								</table>
							</div>
 
						</div><!--/.span-->
					</div><!--/.row-fluid--> 
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->

<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
