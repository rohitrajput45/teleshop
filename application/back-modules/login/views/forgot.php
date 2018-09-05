<!DOCTYPE html>
<html>
<head>
 <?php 
$uri= $this->uri->segment(2);
  $title= !empty($uri) ? $this->uri->segment(2) : $this->uri->segment(1);
  switch($title){
   /* case 'auto_campaigns':
    $title = 'AutoCampaigns';
    break; */
    default:
    $title = $title;
    break;
  }?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Sandnsoil | <?php echo ucfirst($title);?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>dist/css/ripples.min.css">
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>dist/css/MaterialAdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>assets/css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><img src="<?php echo base_url().ADMIN_THEME; ?>assets/img/logo.png" class=""></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Forgot Password</p>
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
    <form method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="email"name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
   
      <div class="row">
        <div class="col-xs-7">
         <!--  <div class="checkbox">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-raised btn-block btn-flat">Send</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
     <!--  <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a> -->
    </div>
    <!-- /.social-auth-links -->

<a href="<?php echo base_url().'login'; ?>">Login</a><br> 
  <!--   <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().ADMIN_THEME; ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/material.min.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/ripples.min.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>assets/js/custom.js"></script>
<script>
    $.material.init();
</script>
</body>
</html>
