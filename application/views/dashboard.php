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
									<div class="infobox-container">
									<a href="<?php echo site_url("students");?>" />	
										<div class="infobox infobox-green  ">
											<div class="infobox-icon">
												<i class="icon-group"></i>
											</div>
	
											<div class="infobox-data">
												<span class="infobox-data-number">Students</span>
												<div class="infobox-content">comments + 2 reviews</div>
											</div>
										</div>
									</a>	

									<div class="infobox infobox-blue  ">
										<div class="infobox-icon">
											<i class="icon-cog"></i>
										</div>

										<div class="infobox-data">
											<span class="infobox-data-number">Staff</span>
											<div class="infobox-content">new followers</div>
										</div>

										<div class="badge badge-success">
											+32%
											<i class="icon-arrow-up"></i>
										</div>
									</div>

									<div class="infobox infobox-pink  ">
										<div class="infobox-icon">
											<i class="icon-calendar"></i>
										</div>

										<div class="infobox-data">
											<span class="infobox-data-number">Class routine</span>
											<div class="infobox-content">new orders</div>
										</div>
									</div>

									<div class="infobox infobox-red  ">
										<div class="infobox-icon">
											<i class="icon-book"></i>
										</div>

										<div class="infobox-data">
											<span class="infobox-data-number">Subjects</span>
											<div class="infobox-content">experiments</div>
										</div>
									</div>
									<div class="infobox infobox-black  ">
										<div class="infobox-icon">
											<i class="icon-book"></i>
										</div>

										<div class="infobox-data">
											<span class="infobox-data-number">Exam</span>
											<div class="infobox-content">experiments</div>
										</div>
									</div> 
								</div>
								<hr/ >
								<div class="">
									<div class="widget-box ">
										<div class="widget-header">
											<h4 class="lighter smaller">
												<i class="icon-comment blue"></i>
												Notice Board
											</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main no-padding">
												<div class="dialogs">
												
												<?php foreach($notices->result() as $notice ): ?>
													<div class="itemdiv dialogdiv">
														<div class="user">
															<img alt="Alexa's Avatar" src="assets/avatars/avatar1.png" />
														</div>

														<div class="body">
															<div class="time">
																<i class="icon-time"></i>
																<span class="green"><?php echo date('d-m-Y', strtotime($notice->noticeDate)); ?></span>
															</div>

															<div class="name">
																<a href="#"><?php echo substr($notice->noticeTitle,0,250)."..."; ?></a>
															</div>
															<div class="text"><?php echo substr($notice->noticeDescription,0,250)."..."; ?></div>

															<div class="tools">
																<a href="#" class="btn btn-minier btn-info">
																	<i class="icon-only icon-share-alt"></i>
																</a>
															</div>
														</div>
													</div>
												<?php endforeach; ?>	
 
												</div>

											 
											</div><!--/widget-main-->
										</div><!--/widget-body-->
									</div><!--/widget-box-->
								</div><!--/span-->
									 

								

								 
									<div class="space"></div>

									<div class="row-fluid">
										 
									</div>
								</div>
				
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->
