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
  <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/dist/css/ripples.min.css">
  <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/dist/css/MaterialAdminLTE.min.css">
  	<link rel="stylesheet" href="<?php echo base_url().FRONT_THEME; ?>../admin/assets/css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo text-center">
    <a href="javascript:void(0);"><img src="<?php echo base_url().FRONT_THEME; ?>images/logo.png" class=""></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Authentication for a new member</p>

    <form autocomplete="off" method="post">
     
      <div class="form-group has-feedback">
        <input type="text"  name="userName" class="form-control" placeholder="User name" value="<?php echo set_value('userName'); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('userName'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="c_password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('c_password'); ?>
      </div>
      <div class="row">
        <div class="col-xs-7">
         <!--  <div class="checkbox">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-raised btn-block">Save</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
   <!--    <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a> -->
    </div>
<!--

    <a href="<?php echo base_url().'admin/login'; ?>" class="text-center">Already verified</a>
-->
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().FRONT_THEME; ?>../admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().FRONT_THEME; ?>../admin/bootstrap/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?php echo base_url().FRONT_THEME; ?>../admin/dist/js/material.min.js"></script>
<script src="<?php echo base_url().FRONT_THEME; ?>../admin/dist/js/ripples.min.js"></script>
<script src="<?php echo base_url().FRONT_THEME; ?>../admin/assets/js/custom.js"></script>
<script>
    $.material.init();
</script>
</body>
</html>
