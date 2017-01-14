 <style type="text/css">
 li{
 	list-style: none;
 }
 td, th {
 	padding: 5px;
 	border: 1px solid black;
 }
 </style>
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
	 
				<h3>
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Students
				</h3>
		</div><!--/.page-header-->

		<div class="row-fluid">
			<div class="span12">
	 			<div class="row-fluid">
						  		<table id="sample-table-2" class="table table-striped table-bordered table-hover">
										<thead>
											<tr><th>
													<span class="smaller blue"> Student's Name</span>	
												</th>
											 	<th>Roll #</th>
											 	<th>Section</th>
												<th>Class</th>
												<th>Student ID</th>
												<th>Student Cash ID #</th>
												<th>Phone</th>
												<th>Present Address</th>
												<th>Parmanent Address</th>
												<th>Status</th>
												<th>Admission Year</th>
											</tr>
										</thead>
												<?php 
													$status=array('Banned','Current ','Ex-');
													foreach(@$students->result() as $row):
												?>
										<tbody>
											<tr>
												 <td><?php echo @$row->StdName; ?></td>
												  <td><?php echo $row->StdRollNo; ?></td >
												 <td> <?php echo ucwords($row->StdSectionId.' :: '.$row->SectionName); ?></td > 
												 <td> <?php echo ucwords($row->ClassName.' :: '.$row->ClassNumaricName);?></td > 
												 <td> <?php echo @$row->StdCurrentId; ?></td> 
												 <td> <?php echo @$row->StdCashId; ?></td > 
												 <td> <?php echo @$row->StdContactNo; ?></td>
												 <td> <?php echo $row->StdPresentAddress;?></td>
												 <td> <?php echo @$row->StdPermanentAddress; ?></td>
												 <td >
													<?php echo $status[@$row->StdStatus]; ?>
												</td>					 
												<td ><?php echo $row->StdAdmissionYear; ?></td>
											</tr>
										<!-- store student Id and information--> 
										 
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
 
