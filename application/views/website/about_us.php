<div class="page-content">
	<div class="row-fluid">
		<div class="span12 page-header position-relative">
			<!--PAGE CONTENT BEGINS-->
						<h1>
						<i class="icon-hand-right icon-animated-hand-pointer blue"></i>
							About Us
							 
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
								<!--------------Message---------------------------------->
									<div class="control-group">
										 
									<?php echo form_open(base_url().'website/editaboutus','class="form-horizontal"'); 
										foreach($aboutus->result() as $row):
									?>
							 		<div class="control-group">
								 			 <div class="wysiwyg-editor" id="editor1">
												<?php echo ($this->input->post('about_us')) ? $this->input->post('about_us') : $row->about_us ;?>
											</div>
											<?php
												echo form_hidden('id',$row->Id);
										 		echo form_hidden('about_us', ($this->input->post('about_us')) ? $this->input->post('about_us') : $row->about_us);
										 	 endforeach; ?>
									</div>	
							</div>
						</div><!--/.span-->
					</div><!--/.row-fluid-->
					<button class="btn btn-info" type="submit">
						Update
					</button>

							<?php echo form_close(); ?>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->

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

		<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/markdown/markdown.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/markdown/bootstrap-markdown.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.hotkeys.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

		<!--ace scripts-->

		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function(){
	
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

	//but we want to change a few buttons colors for the third style
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
			'font',
			null,
			'fontSize',
			null,
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			{name:'insertunorderedlist', className:'btn-success'},
			{name:'insertorderedlist', className:'btn-success'},
			{name:'outdent', className:'btn-purple'},
			{name:'indent', className:'btn-purple'},
			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');

	

	$('#editor2').css({'height':'200px'}).ace_wysiwyg({
		toolbar_place: function(toolbar) {
			return $(this).closest('.widget-box').find('.widget-header').prepend(toolbar);
		},
		toolbar:
		[
			'bold',
			{name:'italic' , title:'Change Title!', icon: 'icon-leaf'},
			'strikethrough',
			'underline',
			null,
			'insertunorderedlist',
			'insertorderedlist',
			null,
			'justifyleft',
			'justifycenter',
			'justifyright'
		],
		speech_button:false
	});


	$('[data-toggle="buttons-radio"]').on('click', function(e){
		var target = $(e.target);
		var which = parseInt($.trim(target.text()));
		var toolbar = $('#editor1').prev().get(0);
		if(which == 1 || which == 2 || which == 3) {
			toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
			if(which == 1) $(toolbar).addClass('wysiwyg-style1');
			else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
		}
	});





	//Add Image Resize Functionality to Chrome and Safari
	//webkit browsers don't have image resize functionality when content is editable
	//so let's add something using jQuery UI resizable
	//another option would be opening a dialog for user to enter dimensions.
	if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
		
		var lastResizableImg = null;
		function destroyResizable() {
			if(lastResizableImg == null) return;
			lastResizableImg.resizable( "destroy" );
			lastResizableImg.removeData('resizable');
			lastResizableImg = null;
		}

		var enableImageResize = function() {
			$('.wysiwyg-editor')
			.on('mousedown', function(e) {
				var target = $(e.target);
				if( e.target instanceof HTMLImageElement ) {
					if( !target.data('resizable') ) {
						target.resizable({
							aspectRatio: e.target.width / e.target.height,
						});
						target.data('resizable', true);
						
						if( lastResizableImg != null ) {//disable previous resizable image
							lastResizableImg.resizable( "destroy" );
							lastResizableImg.removeData('resizable');
						}
						lastResizableImg = target;
					}
				}
			})
			.on('click', function(e) {
				if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
					destroyResizable();
				}
			})
			.on('keydown', function() {
				destroyResizable();
			});
	    }
		
		enableImageResize();

		/**
		//or we can load the jQuery UI dynamically only if needed
		if (typeof jQuery.ui !== 'undefined') enableImageResize();
		else {//load jQuery UI if not loaded
			$.getScript($assets+"/js/jquery-ui-1.10.3.custom.min.js", function(data, textStatus, jqxhr) {
				if('ontouchend' in document) {//also load touch-punch for touch devices
					$.getScript($assets+"/js/jquery.ui.touch-punch.min.js", function(data, textStatus, jqxhr) {
						enableImageResize();
					});
				} else	enableImageResize();
			});
		}
		*/
	}


});
</script>
<script>
$( document ).ready(function() {
   
	var editor = ace.edit("editor1");
	var textarea = $('input[name="about_us"]').hide();
	console.log(textarea);
	editor.getSession().setValue(textarea.val());
	editor.getSession().on('change', function(){
	  textarea.val(editor.getSession().getValue());
	});
});	
</script>