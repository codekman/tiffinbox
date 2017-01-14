<div class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!--PAGE CONTENT BEGINS-->
				
				<div class="well">
					<h1 class="grey lighter smaller">
						<span class="blue bigger-125">
							<i class="icon icon-gift"></i>
								TiffinBox
						</span>
						 school management system
					</h1>
					<div class="widget-header">
						<h4 class="lighter smaller">
							<i class="icon-config blue"></i>
							System Setting
						</h4>
					</div>

					<div class="widget-body">
						<div class="widget-main">
							<?php 
								echo form_open_multipart('setting/config');
								foreach($infos->result() as $item):
								$instritute_name = array(
										'name'	=>'institute_name',
										'id'	=>'institute_name',	
										'value'	=>($this->input->post('institute_name')) ? $this->input->post('institute_name') :$item->institute_name,
								);
								echo form_label('instretute name');
								echo form_input($instritute_name);
								
								$institute_logo = array(
										'name'	=>'institute_logo',
										'id'	=>'institute_logo' 
								);
								echo form_label('instretute logo');
								echo '<img src="'.base_url().'media/schools/'.$item->institute_logo.'" width="150px"/><br/>';
								echo form_upload($institute_logo);
								$address = array(
										'name'	=>'address',
										'id'	=>'address',	
										'value'	=>($this->input->post('address')) ? $this->input->post('address') : $item->address,
								);
								echo form_label('instretute address');
								echo form_textarea($address);
								$contact_no = array(
										'name'	=>'contact_no',
										'id'	=>'contact_no',	
										'value'	=>($this->input->post('contact_no')) ? $this->input->post('contact_no') : $item->contact_no
								);
								echo form_label('contact no');
								echo form_input($contact_no);

								$email = array(
										'name'	=>'email',
										'id'	=>'email',	
										'placeholder'=>'example@example.com',
										'value'	=> ($this->input->post('email')) ? $this->input->post('email') : $item->email
								);
								echo form_label('email');
								echo form_input($email);
								
								echo '<br/>'.form_submit('','Submit');
								echo form_hidden('id', $item->Id);
								endforeach;
								form_close();
							?>
						</div><!--/widget-main-->
					</div><!--/widget-body-->
									 
				</div><!--/span-->
			</div>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
