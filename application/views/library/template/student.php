<h4>All Students of Class <?php echo (@$students->row()->ClassName) ? $students->row()->ClassName : $this->input->post('class_id'); ?></h4><hr/>
<?php
	$meg = '<div class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>
										<strong>Sorry!</strong>
										There is not student in the class.<br>
									</div>';
 							
	echo ($students->num_rows()) ? '' : $meg ; 
	 
	
	foreach($students->result() as $std){
		 
		echo '<label>
				<input name="student" value ="'.$std->StdDetailsId.'" class="std" type="radio">
				<span class="lbl"> '.$std->StdName.'</span> | Roll no. '.$std->StdRollNo.'
			</label>';
	}
 
?>