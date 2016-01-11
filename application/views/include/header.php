
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo @$page_title; ?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->
		
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/colorpicker.css" />
		<!--fonts-->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colorbox.css" />
		 <!--page specific plugin styles-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-editable.css" />
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>

	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon icon-gift white"></i>
							<span class="red">Tiffin</span><span class="white">Box</span> :: School Management System
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						 

						 

				 

						<li class="light-blue">
							<!--a data-toggle="dropdown" href="#" class="dropdown-toggle"-->
							<div class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									 
									<?php 
									//take user data from session:
									$user_data = $this->session->userdata('is_logged');
									echo $user_data['user_name'];
									echo '<br/><a href="'.base_url().'welcome/logout">Logout</a>'; 
									?>
									
								</span>
							</div>
							<!--i class="icon-caret-down"></i-->
							<!--/a-->

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php base_url();?>welcome/logout">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a href="<?php echo base_url();?>subjects">
						<button class="btn btn-small btn-success">
							<i class="icon-book"></i>
						</button>
						</a>
						<a href="<?php echo base_url();?>classroutin/index">
						<button class="btn btn-small btn-info">
							<i class="icon-calendar"></i>
						</button>
						</a>
						<a href="<?php echo base_url();?>students">
						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>
						</a>
						<a href="<?php echo base_url();?>setting">
						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
						</a>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li <?php echo ($this->uri->segment(1) =="") || ($this->uri->segment(1) =="dashboard")? 'class="active"':'';?> >
						<a href="<?php echo base_url(); ?>">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li>
					 
					<li <?php echo (($this->uri->segment(1) =="students") && (($this->uri->segment(2) =="create" ) || ($this->uri->segment(2) =="update" ) || ($this->uri->segment(2) =="" ) || ($this->uri->segment(2) =="index" ))) ? 'class="active"':'';?>>
						<a href="<?php echo base_url(); ?>students">
						<i class="icon-group"></i>
							<span class="menu-text"> Student  </span>
						</a>
					</li>
					
					<li <?php echo ($this->uri->segment(1) =="attendance") ? 'class="active"':'';?> >
						<a href="<?php echo base_url(); ?>attendance/index">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Student Attendance </span>
						</a>
					</li>
					
					<li <?php echo (($this->uri->segment(1) =="employee") && ($this->uri->segment(2) =="index"))? 'class="active"':'';?>>	
						<a href="<?php echo base_url(); ?>employee/index">
							<i class="icon-group"></i>
						 Staff/Teacher
						</a>
					</li> 
		 
						 
			 		<li <?php echo (($this->uri->segment(1) =="employee") && (($this->uri->segment(2) =="departments") || ($this->uri->segment(2) =="createdepartment") || ($this->uri->segment(2) =="updatedepartment")))? 'class="active"':'';?>>
						<a href="<?php echo base_url();?>employee/departments">
							<i class="icon-sitemap green"></i>
							Departments
						</a>
					</li>	
			 		<li <?php echo (($this->uri->segment(1) =="employee") && (($this->uri->segment(2) =="designations") || ($this->uri->segment(2) =="createdesignation") || ($this->uri->segment(2) =="updatedesignations")))? 'class="active"':'';?>>
						<a href="<?php echo base_url();?>employee/designations">
							<i class="icon-bookmark green"></i>
							Designations
						</a>
					</li>	
								
							 
					 
					 
					<li <?php echo ($this->uri->segment(1) =="subjects")? 'class="active"':'';?>>
						<a href="<?php echo base_url(); ?>subjects">
							<i class="icon-book"></i> Subject 
						</a>
					</li>
					
					 	  
					<li <?php echo ($this->uri->segment(1) =="classes")? 'class="active"':'';?>>
						<a href="<?php echo base_url();?>classes">
							<i class="icon-double-angle-right"></i>
							Classes
						</a>
						 
					</li>
 
					<li <?php echo ($this->uri->segment(1) =="sections")? 'class="active"':'';?>>
						<a href="<?php echo base_url()?>sections">
							<i class="icon-double-angle-right"></i>
							Sections
						</a>
					</li>
					<li <?php echo ($this->uri->segment(1) =="classroutin" && $this->uri->segment(2) =="index" )? 'class="active"':'';?>>
						<a href="<?php echo base_url();?>classroutin/index">
							<i class="icon-double-angle-right"></i>
							Class Routin
						</a>
					</li>
							
						 
					<li <?php echo ($this->uri->segment(1) =="exams" || $this->uri->segment(1) =="examresult" || $this->uri->segment(1) =="examgrades" )? 'class="active open"':'';?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text">Exam </span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li <?php echo ($this->uri->segment(1) =="examgrades" && $this->uri->segment(2) =="index" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>examgrades/index">
									<i class="icon-double-angle-right"></i>
									Grades Setting
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="exams" && $this->uri->segment(2) =="index" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>exams/index">
									<i class="icon-double-angle-right"></i>
									Exams Setting
								</a>
							</li>
						 	<li <?php echo ($this->uri->segment(1) =="examresult" && $this->uri->segment(2) =="create") ? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>examresult/create" class="dropdown-toggle">
									<i class=" icon-certificate"></i>
									<span class="menu-text">Marks &amp; Result</span>
								</a>
								 
							</li>
						</ul>
					</li>
					<li <?php echo ($this->uri->segment(1) =="library")? 'class="active open"':'';?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text">Library</span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li <?php echo ($this->uri->segment(1) =="library" && $this->uri->segment(2) =="books" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>library/books">
									<i class="icon-book"></i>
									Books & Issue
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="library" && $this->uri->segment(2) =="issuedbook" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>library/issuedbook">
									<i class="icon-double-angle-right"></i>
									Issues & Return
								</a>
							</li>
						 	<li <?php echo ($this->uri->segment(1) =="library" && $this->uri->segment(2) =="duereport")? 'class="active"':'';?>>
								<a href="<?php echo site_url('library/duereport'); ?>" class="dropdown-toggle">
									<i class=" icon-certificate"></i>
									<span class="menu-text">Due Report</span>
								</a>
								 
							</li>
						</ul>
					</li>
					<li <?php echo ($this->uri->segment(1) =="accounting")? 'class="active open"':'';?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text">Accounting </span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li <?php echo ($this->uri->segment(1) =="accounting" && $this->uri->segment(2) =="expense_categories" ) ? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>accounting/expense_categories">
									<i class="icon-double-angle-right"></i>
									Expense Categories
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="accounting" && $this->uri->segment(2) =="expenses" ) ? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>accounting/expenses">
									<i class="icon-double-angle-right"></i>
									Expenses
								</a>
							</li>
						 	<li <?php echo ($this->uri->segment(1) =="accounting" && $this->uri->segment(2) =="payments") ? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>accounting/payments" class="dropdown-toggle">
									<i class=" icon-certificate"></i>
									<span class="menu-text">Payments</span>
								</a>
								 
							</li>
						</ul>
					</li>
					<li <?php echo ($this->uri->segment(1) =="website" || $this->uri->segment(1) =="noticeboard")? 'class="active open"':'';?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text">Config Website </span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li <?php echo ($this->uri->segment(1) =="website" && $this->uri->segment(2) =="links" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>website/links">
									<i class="icon-double-angle-right"></i>
									Links
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="website" && $this->uri->segment(2) =="emailconfig" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>website/emailconfig">
									<i class="icon-double-angle-right"></i>
									Contact email
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="website" && $this->uri->segment(2) =="aboutus" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>website/aboutus">
									<i class="icon-double-angle-right"></i>
									About us
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="website" && $this->uri->segment(2) =="principal" )? 'class="active"':'';?>>
								<a href="<?php echo base_url(); ?>website/principal ">
									<i class="icon-double-angle-right"></i>
									Word From Principal
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="noticeboard")? 'class="active"':'';?>>
								<a href="<?php echo base_url();?>noticeboard/index">
									<i class="icon-bullhorn"></i>
									<span class="menu-text"> News/Notice </span>
								</a>
							</li>
							<li <?php echo ($this->uri->segment(1) =="employee" && $this->uri->segment(2) =="makecommittee" )? 'class="active"':'';?>>
								<a href="<?php echo base_url();?>employee/makecommittee">
									<i class="icon-bullhorn"></i>
									<span class="menu-text">Committee Members</span>
								</a>
							</li>
						</ul>
					</li>
					
					
					<li <?php echo ($this->uri->segment(1) =="setting") ? 'class="active"':'';?> >
						<a href="<?php echo base_url(); ?>setting/index">
							<i class="icon-cogs"></i>
							<span class="menu-text"> Setting </span>
						</a>
					</li>
					 
					  
						</ul>
					</li>
					
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="<?php echo base_url(); ?>">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li>
							<a href="<?php echo base_url().$this->uri->segment(1); ?>"><?php echo ucwords($this->uri->segment(1)); ?></a>
						<?php if($this->uri->segment(2)):?>
							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						<?php endif; ?>	
						</li>
					
						<li class="active"><?php echo $this->uri->segment(2);?></li>
						
					</ul><!--.breadcrumb-->

					<div class="nav-search" id="nav-search">
						<form class="form-search" />
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="icon-search nav-search-icon"></i>
							</span>
						</form>
					</div><!--#nav-search-->
				</div>