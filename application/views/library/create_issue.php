<script type="text/javascript">
$( document ).ready(function() {
	$(".IssueType").click(function()
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
			$("#departments").html('');
			$("#Staffs").html('');
		}else{
			$.ajax({
		  	method: "POST",
		  	url: "<?php echo base_url();?>library/getDept",
		 
			})
		 	 .done(function( data ) {
		  		$("#departments").html(data);
		    	//console.log( "Data Saved: " + data );
		  });
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
		  url: "<?php echo base_url();?>library/getStudentByClassId",
		  data: { class_id: class_id }
		})
		  .done(function( data ) {
		  	$("#students").html(data);
		  });
	});
	$( "#departments" ).delegate( "#deptNamediv", "change", function(){
		var dept_id = this.value;
		//get staff of this dept.:
		$.ajax({
		  method: "POST",
		  url: "<?php echo base_url();?>library/getStaffByDeptId",
		  data: { dept_id: dept_id }
		})
		  .done(function( data ) {
		  	$("#Staffs").html(data);
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
		<div class="span12 page-header position-relative">
			<a href="<?php echo base_url();?>library/issuedbook">
					<button class="btn btn-primary pull-right">
						<i class="icon-cogs bigger-125"></i>
						Manage Books
					</button>
				</a>	
		<h3 class="grey lighter position-relative">
			<i class="icon-book green"></i>
			Book Issue
		</h3>
		<hr/>	
		<?php echo form_open_multipart(base_url().'library/issuebook','class="form-horizontal"'); ?>
			<?php foreach($book->result() as $row): ?>
				<div class="well">  
						<h4>Book Details :<span class="red pull-right"><?php echo $row->name;?></span></h4>
						<span class="red pull-right"><?php echo $row->description;?></span>
				</div>
				<?php echo form_hidden('bookId', $row->Id); ?>
			<?php endforeach; ?>
			<div class="row-fluid span6">
				<div class="control-group">
						<label class="control-label" >
						Issue Type <span class="red">* </span>:
						</label>
						<div class="controls">
							<label class="span6">
								<input id="form-field-radio1" name="userType" class="IssueType" value="1" type="radio">
								<span class="lbl" for="form-field-radio1"> For Student</span>
							</label>
							<label class="span6">
								<input id="form-field-radio2" name="userType" class="IssueType" value="2" type="radio">
								<span class="lbl" for="form-field-radio2"> For Other Staff</span>
							</label>
						</div>
				</div>
				<div class="control-group" id="classes"> 
						<?php
						 
						if($this->input->post()){
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
				<div class="control-group" id="departments"> 
						<?php
						 
						if($this->input->post()){
							echo '<label class="control-label" for="form-field-11">
								Class <span class="red">* </span>:
							</label><div class="controls" id="deptdiv">';
							$classes = $this->db->get_where('classes', array('ClassStatus'=>1));
							$options[] = '---Select Class---';
							 foreach($classes->result() as $class){
							 	$options[$class->Id] = $class->ClassName;
							 }
							 echo form_dropdown('deptId', $options,'','id="deptNamediv"');
							 echo '</div> ';
						}
							 
						?>
				</div>
				<div class="control-group">
					<label class="control-label" for="">
						 Issue Date <span class="red">*</span>:
					</label>
				 	<div class="controls">
						<input class="date-picker input-append" name="issuedate" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div> 
				</div>
				<div class="control-group">
					<label class="control-label" for="">
						 Return Date <span class="red">*</span>:
					</label>
				 	<div class="controls">
						<input class="date-picker input-append" name="issueTill" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div> 
				</div> 
				<div class="control-group">
					<label class="control-label" for=" ">
						Note <span class="red">*</span>:
					</label>
					<div class="controls">
						<?php
	
						$note = array(
							'name'			=>'note',
							'id'			=>'form-field-1',
							'placeholder'	=>'Total Amount'
						);
						echo form_textarea($note).'&nbsp;&nbsp;&nbsp;';
						echo form_error('note'); 
						?>
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
			<div id="students" class="span5">
			</div>	 	
			<div id="Staffs" class="span5">
			</div>
		 <?php echo form_close(); ?>
	<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
			