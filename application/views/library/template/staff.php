<h4>All  Staff</h4><hr/>
<?php
	$meg = '<div class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>
										<strong>Sorry!</strong>
										There is not Staff in the department.<br>
									</div>';
 						
	echo ($staffs->num_rows()) ? '' : $meg ; 
	 
	
	foreach($staffs->result() as $stf){
		 
		echo '<label>
				<input name="staff" value ="'.$stf->Id.'" class="std" type="radio">
				<span class="lbl"> '.$stf->EmployeeName.'</span>
			</label>';
	}
 
?>