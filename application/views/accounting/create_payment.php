<script type="text/javascript">
$( document ).ready(function() {
	$(".PaymentType").click(function()
	{ 
		if($(this).val()==1){
			 
			$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>accounting/getClasses",
		 
		})
		  .done(function( data ) {
		  	$("#classes").html(data);
		    //console.log( "Data Saved: " + data );
		  });
			//$("#Classdiv").removeClass('hide');
		}else{
			$("#classes").html('');
			//$("#Classdiv").addClass('hide');
			$("#students").html('');
		}
	    
	});
	$( "#classes" ).delegate( "#classNamediv", "change", function(){
		var class_id = this.value;
		//get students of this class:
		$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>accounting/getStudentByClassId",
		  data: { class_id: class_id }
		})
		  .done(function( data ) {
		  	$("#students").html(data);
		    //console.log( "Data Saved: " + data );
		  });
	});
	$( "#students" ).delegate( "#checkAll", "change", function() {
	   if($(this).is(':checked')){
	   		$('.std').prop('checked',true);
	   }else{
	   		$('.std').prop('checked',false);
	   }	
	});
});	
</script>
<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
					<div class="page-header position-relative">
					 <a href="<?php echo base_url();?>accounting/payments">
						<button class="btn btn-primary pull-right">
							<i class="icon-th bigger-125"></i>
							Manage Payments
						</button>
					 </a>
						<h1>
							Add New Payment
							<small>
								<i class="icon-double-angle-right"></i>
								Please Provide the following informations: 
							</small>
						</h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<div class="span12">
							
							<!--------------Message---------------------------------->
						
						 <?php
						 //check any alert message or not
						 	if($this->session->flashdata('status_right')):
							
						 ?>
						 //Print Success Alert Message: 
								<div class="alert alert-success no-margin">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove red"></i>
									</button>
								
									<i class="icon-ok bigger-120 blue"></i>
									<?php echo $this->session->flashdata('status_right'); ?>
								</div>
						<?php endif; ?>
						   
						 <?php
						 	//check any alert message or not
						 	if($this->session->flashdata('status_wrong')):
							 //Print Wrong Alert Message:
						 ?>
						 <div class="alert alert-danger no-margin">
							<button type="button" class="close" data-dismiss="alert">
								<i class="icon-remove red"></i>
							</button>
							<i class="icon-warning-sign bigger-120 blue"></i>
							<?php echo $this->session->flashdata('status_wrong'); ?>
						</div>
							<?php endif; ?>	
						<!--------------End of Message---------------------------------->
							<?php echo form_open_multipart(base_url().'accounting/insertpayment','class="form-horizontal"'); ?>
						<div class="span6">
							<h4>Invoice information </h4><hr/>		
							<div class="control-group">
								<label class="control-label" for="form-field-1">
								Payment Title<span class="red">*</span>
								</label>
								<div class="controls">
									<?php
				
									$title = array(
										'name'			=>'paymentTitle',
										'id'			=>'form-field-1',
										'placeholder'	=>'Payment Title'
									);
									echo form_input($title).'&nbsp;&nbsp;&nbsp;';
									echo form_error('titlel'); 
									?>
								 </div>
							</div>			 
							<div class="control-group">
								<label class="control-label" for="form-field-11">
										Payment Details :
								</label>
								<div class="controls">
									<textarea id="form-field-11" name="paymentDetails" class="autosize-transition"></textarea>
								</div>
							</div>
							<div class="row-fluid">
								 
									<label class="control-label" >
									Payment Type <span class="red">* </span>:
									</label>
									<div class="controls">
										<label class="span6">
											<input id="form-field-radio1" name="paymentType" class="PaymentType" value="1" type="radio">
											<span class="lbl" for="form-field-radio1"> Student Payments</span>
										</label>
										<label class="span6">
											<input id="form-field-radio2" name="paymentType" class="PaymentType" value="2" type="radio">
											<span class="lbl" for="form-field-radio2"> Others</span>
										</label>
									</div>
								 
							</div>
						 
						 
							<div class="control-group" id="classes"> 
									<?php
									 
									if($this->input->post('classId')){
										echo '<label class="control-label" for="form-field-11">
											Class <span class="red">* </span>:
										</label><div class="controls" id="Classdiv">';
										
										$classes = $this->db->get_where('classes', array('ClassStatus'=>1));
										$options[] = '---Select Class---';
										 foreach($classes->result() as $class){
										 	$options[$class->Id] = $class->ClassName;
										 }
										 echo form_dropdown('classId', $options,'','id="classNamediv"',$this->input->post('classId'));
										 echo '</div> ';
									}
										 
									?>
								
							</div>
							<div class="control-group">
								<label class="control-label" for="">
									 Payment Create Date <span class="red">*</span>:
								</label>
							 	<div class="controls">
									<input class="date-picker input-append" name="createdDate" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
									<span class="add-on">
										<i class="icon-calendar"></i>
									</span>
								</div> 
							</div>
							<h4>Payment informations </h4><hr/>
							<div class="control-group">
								<label class="control-label" for=" ">
									Total Amount <span class="red">*</span>:
								</label>
								<div class="controls">
									<?php
				
									$totalAmount = array(
										'name'			=>'totalAmount',
										'id'			=>'form-field-1',
										'placeholder'	=>'Total Amount'
									);
									echo form_input($totalAmount).'&nbsp;&nbsp;&nbsp;';
									echo form_error('totalAmount'); 
									?>
								 </div>
							</div>
						 	<div class="control-group">
								<label class="control-label" for=" ">
									Payment Amount <span class="red">*</span>:
								</label>
								<div class="controls">
									<?php
				
									$paidAmount = array(
										'name'			=>'paidAmount',
										'id'			=>'form-field-1',
										'placeholder'	=>'Payment Amount'
									);
									echo form_input($paidAmount).'&nbsp;&nbsp;&nbsp;';
									echo form_error('paidAmount'); 
									?>
								 </div>
							</div>
							
							<div class="control-group">
									<label class="control-label" for="">
									Payment Method  :
									</label>
									<div class="controls">
										<label class="span4">
											<input id=" " name="medium" checked  value="Cash" type="radio">
											<span class="lbl" for=""> Cash</span>
										</label>
										<label class="span4">
											<input id=" " name="medium" value="Check" type="radio">
											<span class="lbl" for=""> Check</span>
										</label>
										<label class="span4">
											<input id=" " name="medium" value="Card" type="radio">
											<span class="lbl" for=""> Card</span>
										</label>
									</div>
							</div>	
						 	<div class="control-group">
									<label class="control-label" for="">
									Payment Status <span class="red">* </span>:
									</label>
									<div class="controls">
										<label class="span6">
											<input id="form-field-radio1" name="status" checked value="1" type="radio">
											<span class="lbl" for="form-field-radio1"> Paid</span>
										</label>
										<label class="span6">
											<input id="form-field-radio2" name="status" value="0" type="radio">
											<span class="lbl" for="form-field-radio2"> Unpaid</span>
										</label>
									</div>
							</div>
							<button class="btn btn-info" type="submit">
								<i class="icon-ok bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="icon-undo bigger-110"></i>
								Reset
							</button> 
				 		</div>
						<div id="students" class="span6">
						</div>	 	
					 <?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
