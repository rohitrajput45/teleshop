<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url().FRONT_THEME;?>css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url().FRONT_THEME;?>css/style.css" rel='stylesheet' type='text/css' />
<!-- font-awesome icons CSS-->
<link href="<?php echo base_url().FRONT_THEME;?>css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- js-->
<script src="<?php echo base_url().FRONT_THEME;?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url().FRONT_THEME;?>js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
<!-- Metis Menu -->
<script src="<?php echo base_url().FRONT_THEME;?>js/custom.js"></script>
<link href="<?php echo base_url().FRONT_THEME;?>css/custom.css" rel="stylesheet">
<style type="text/css">
body {
   background-image: url("themes/front/images/bg.jpg");
}
#page-wrapper {
    padding: 5em 2em 2.5em;
    background-color: transparent!important;
}
</style>
<!--//Metis Menu -->
</head> 
<body>
<div class="main-content">
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Om Shanti Teleshopping</h2>
				<div class="widget-shadow">
					<?php  if($this->session->flashdata('error') != null OR !empty($error)) : ?>
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Alert!</h4>
					<?php echo !empty($error) ? $error :''; ?>
					<?php echo ($this->session->flashdata('error') != null)?$this->session->flashdata('error'):''; ?>
					</div>
					<?php endif; ?>
					<?php  if($this->session->flashdata('success') != null OR !empty($success)) : ?>
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Alert!</h4>
					<?php echo !empty($success)? $success:''; ?>
					<?php echo ($this->session->flashdata('success') != null) ?$this->session->flashdata('success'):''; ?>
					</div>
					<?php endif; ?>
					<div class="login-body">
						<form action="#" method="post">
							<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
		
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<!--footer-->
<div class="footer">
<p>&copy; 2018 Irisinformatics Design Dashboard. All Rights Reserved | Design by <a href="" target="_blank">Irisinformatics.in</a></p></div>
</div>

	<script src="<?php echo base_url().FRONT_THEME;?>js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url().FRONT_THEME;?>js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>