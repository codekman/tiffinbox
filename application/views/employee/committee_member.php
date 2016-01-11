<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header row-fluid position-relative">	
			<!--PAGE CONTENT BEGINS-->
				<h1 class="span8">
					<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
					Staff
					<small>
						<i class="icon-double-angle-right"></i>
						Static &amp; Dynamic Tables
					</small>
				</h1>
		</div>			
		<div class="row-fluid">
			<h3 class="header smaller lighter blue">All Staff</h3>
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
				echo form_open('');
				foreach($staffs->result() as $row): 
				?>
				<label>
					<label>
						<input name="committee[]" class="ace-checkbox-2 staffId" type="checkbox" value="<?php echo $row->Id;?>"/>
						<span class="lbl"> <?php echo $row->EmployeeName; ?></span>&nbsp;&nbsp;
						<input type="text" name="post[]" id="post<?php echo $row->Id;?>" class ="hide" placeholder="write post"/>
					</label>									
				<?php
				endforeach;
				form_close(); 
				?>	
		</div>
	</div>
</div>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

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
		<script type="text/javascript">
		$( document ).ready(function() {
			$(".staffId").click(function(){
				var id = $(this).val(); 
				alert(id);
				 if($(this).is(':checked')){
	   					$('#post'+id).removeClass('hide');
				   }else{
				   		$('#post'+id).addClass('hide');
				   }
			});	
		});
		</script>