<script>
function examSelection(){
 	$('#classes').show();
}
function classSelection(){
	var class_id = $('#classSelection option:selected').val();
	$.post( "<?php echo base_url()?>examresult/getSubject", { class_id:class_id })
  .done(function( data ) {
    $('#Subject').html(data);
  });
}	
function subjectSelection(){

	var class_id = $('#classSelection option:selected').val();

	var exam_id = $('#eaxmSelection option:selected').val();	
	
	$.post( "<?php echo base_url()?>examresult/getStudent", { exam_id: exam_id,class_id:class_id }).done(function( data ) {
  	 
    $('#Student').html(data);
  //  $('.row-fluid .spinner3').ace_spinner({value:'',min:-100,max:100,step:10, icon_up:'icon-plus', icon_down:'icon-minus', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
  });
}	



 
function upadateStdResult(id,Std_id){
 	var marks = $('#marks'+Std_id).val();
 	alert(marks);
	var attend = $('#attendance'+Std_id).val();
	var comment = $('#comment'+Std_id).val();
	var class_id = $('#classSelection option:selected').val();
	var exam_id = $('#eaxmSelection option:selected').val();	
	var subject_id = $('#subjectId option:selected').val();	
	 
	if(id==0){
		alert('insert');
		$.post( "<?php echo base_url()?>examresult/insertStdResult", { exam_id: exam_id, class_id: class_id, subject_id:subject_id, Std_id: Std_id, result_id: id, marks: marks, attend: attend, comment: comment  }).done(function( data ) {
		  	 if(data != 0){
		  	 	
		  	 	$('#UpdateBtn'+Std_id).html('<input type="button" value="update" onclick="upadateStdResult('+data+','+Std_id+')">');
		  	 }
		    //$('#Student').html(data);
		   
		  });
	}else{
			
			alert(marks);
			$.post( "<?php echo base_url()?>examresult/upadateStdResult", { result_id: id, marks: marks, attend: attend, comment: comment  }).done(function( data ) {
		  	 alert(data);
		    //$('#Student').html(data);
		   
		  });
	}	  
}
</script>

<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
				<a href="<?php echo base_url();?>exams/index">
					<button class="btn btn-primary pull-right">
											<i class="icon-cogs bigger-125"></i>
											Manage Exams
					</button>
				</a>	
					 
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							Manage Exam Result
							<small>
								<i class="icon-double-angle-right"></i>
								Please Provide the following informations: 
							</small>
						</h1>
					 </div>
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
						
							$exam[''] = '---Select Exam First---';
							foreach($this->db->get('exams')->result() as $ex):
								$exam[$ex->Id]	= $ex->examName;
							endforeach;
							echo '<div id="exam">'.form_dropdown('exam',$exam,'','id="eaxmSelection" onchange="examSelection()"').'</div>';
						
							$classes[''] = '---Select Class First---';
							foreach($this->db->get_where('classes', array('ClassStatus'=>1))->result() as $cls):
								$classes[$cls->Id]	= $cls->ClassName.' :: '.$cls->ClassNumaricName;
							endforeach;
							echo '<div id="classes" style="display:none">'.form_dropdown('class',$classes,'',' id="classSelection" onchange="classSelection()"').'</div>';
						?>
						<div id="Subject" class="pull"></div>	
						<div id="Student"></div>	
						
							 
					

							 
								
							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
