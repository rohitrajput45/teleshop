<?php 
 $login = $this->login_session->isLogin($this->session->userdata('id'));
 if($this->session->userdata('userType')==2):
 $isoffice = $this->login_session->isOffice($this->session->userdata('id'));
 endif;
 ?>
<!DOCTYPE html>
<html>
<head>
  <?php 
  $uri= $this->uri->segment(2);
  $title= !empty($uri) ? $this->uri->segment(2) : $this->uri->segment(1);
  switch($title){
    default:
    $title = $title;
    break;  
  }
 $uri1 = $this->uri->segment(1);
       $uri2 = $this->uri->segment(2);
       $uri3 = $this->uri->segment(3);
  ?>
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
  <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>dist/css/skins/all-md-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php if(isset($addCss)):for($i = 0; $i < count($addCss); $i++):  ?>
  <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME.$addCss[$i];?>"><?php endfor;endif; ?>
	<link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME; ?>assets/css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().ADMIN_THEME; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var base_url ="<?php echo base_url(); ?>";
</script>
<style type="text/css">
  .tranbody{
    overflow-y: scroll;
    height: 550px;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url().ADMIN_THEME; ?>assets/img/favicon.png" width="70"hieght="50" class=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url().ADMIN_THEME; ?>assets/img/favicon.png" class=""></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         <!--  <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
              
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo !empty($login['image']) ?$login['image']:''; ?>" class="img-circle" alt="..">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
         <!--  <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                inner menu: contains the actual data
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
          <!-- Tasks: style can be found in dropdown.less -->
         <!--  <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                 
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li> -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo !empty($login['image']) ? $login['image']:''; ?>" class="user-image" alt="..">
              <span class="hidden-xs"><?php echo !empty($login['fullName']) ? ucfirst($login['fullName']):''; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo !empty($login['image']) ?$login['image']:''; ?>" class="img-circle" alt="..">

                <p>
                  <?php echo !empty($login['fullName']) ? ucfirst($login['fullName']):''; ?><br> <small><?php echo !empty($login['userType']) ? $login['userType']:''; ?></small>
                  <small><?php echo !empty($login['email']) ? $login['email']:''; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                 
                  <div class="col-xs-12 text-center">
                   <a href="<?php echo base_url().'profile/password'; ?>" class="btn btn-warming btn-flat">Change Password</a>
                  </div>
                 
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url().'profile'; ?>" class="btn btn-success btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'dashboard/logout'; ?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
          <li>
            <a href="<?php echo base_url().'dashboard/logout'; ?>" data-toggle="tooltip" title="Sign out" ><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo !empty($login['image']) ? $login['image']:''; ?>" class="img-circle" alt="..">
        </div>
        <div class="pull-left info">
          <p><?php echo !empty($login['fullName']) ? ucfirst($login['fullName']):''; ?></p>
          <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
<?php 
          $search= '';
          if(empty($uri2)):
          $search= !empty($this->uri->segment(1)) ? $this->uri->segment(1) : '';
          endif;
  
  switch($search){
    
    
    case 'pits':
    $search = base_url().'pits/pitList';
    break;
    
    case 'managers':
    $search = base_url().'managers/managerList';
    break;
    
    case 'products':
    $search = base_url().'products/productList';
    break;
    
    case 'drivers':
    $search = base_url().'drivers/driverList';
    break;
    
    case 'delivery':
    $search = base_url().'delivery/deliveryAreaList';
    break;
    
    default:
    $search = "";
    break;
    
  }
  
  
      if(!empty($search)):
      
      ?>
      <form  method="post" autocomplete="off" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search..." oninput="ajax_fun('<?php echo $search ; ?>');">
              <span class="input-group-btn">
                <button type="button" name="search" onclick="ajax_fun('<?php echo $search ; ?>');" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
<?php endif; ?>
      <!-- /.search form -->
        <?php 
          $menusPermission  = $this->sidemenu->sidemenubar($this->session->userdata('userType')); 
			$allowMenu        = explode(',', $menusPermission['allow_menu']);  
			$allowSubMenu     = explode(',', $menusPermission['allow_sub_menu']);
        ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
<!--
          <li class="header">MAIN NAVIGATION</li>
-->

          <?php $mainMenu = $this->sidemenu->get_records_by_id("menus",false,array('status'=>1),"*","","");foreach ($mainMenu as $mkey => $mval){ $subMenu = $this->sidemenu->get_records_by_id("subMenus",false,array("module_id"=>$mval['id'],"status"=>1),"*","",""); ?>
          <li class="treeview <?php echo ($this->uri->segment(1)==$mval['code']) ?'active':'';?>">
          <?php if(in_array($mval['id'], $allowMenu)){ ?>
            <a href="<?php echo base_url($mval['url']);?>">
            <?php echo $mval['bootstrapIcon']; ?> <span><?php echo $mval['name']; ?></span>
            <?php if(!empty($subMenu)): ?>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          <?php endif; ?>
            </a>
          <?php } 
            if(!empty($subMenu)){  ?> 
              <ul class="treeview-menu">
              <?php foreach ($subMenu as $smkey => $smval) {
                if(in_array($smval['id'], $allowSubMenu)){ ?>

                <li><a href="<?php echo base_url($smval['url']);?>">
                  <i class="fa fa-circle-o"></i><?php echo $smval['name'];?></a>
                </li>
              <?php }
					
				  } ?>
              </ul>
          <?php  }  ?> 
          </li>
          <?php }?>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>&nbsp;

      
       <!--  <small>it all starts here</small> -->


      </h1>


      <ol class="breadcrumb">
   
        <li class="<?php echo empty($uri2)? 'active':''; ?>"><a href="<?php echo base_url().$this->uri->segment(1); ?>"><i class="fa fa-dashboard"></i><?php echo ucfirst($this->uri->segment(1)); ?></a></li>
        <?php if(!empty($uri2)): ?>
        <li class="<?php echo empty($uri3)? 'active':''; ?>"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>"><?php echo ucfirst($this->uri->segment(2)); ?></a></li>
      <?php endif;  ?>
      </ol>
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
      <?php 
   /*    echo "<pre>";
       print_r($login);
       echo "</pre>";*/
      ?>
    </section>
     
    <!-- Main content -->
   		 <?php echo $template['body']; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="javascript:void(0);">Mindiii</a><!-- , <a href="https://fezvrasta.github.io">Federico Zivolo</a> and <a href="https://ducthanhnguyen.github.io">Thanh Nguyen</a> -->.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!--Delete model -->
<div class="modal fade modal-fade-in-scale-up" id="confirm-delete" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header alert-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="fa fa-fw fa-warning"></i>  Are you sure!!</h4>
              </div>
              <div class="modal-body">
              <?php  if($this->session->userdata('userType')==2): ?>
                <p>Do you really want to remove this record?</p>
              <?php else: ?>
                 <p>Do you really want to delete this record?</p>
              <?php endif; ?>
              </div>
              <div class="modal-footer ">
                <a  href="javascript:void(0);" type="button" class="btn btn-outline btn-ok pull-right " data-dismiss="modal">No</a>
                <a href="javascript:void(0);" type="button" id="deleteUrl" class="btn btn-outline btn-danger btn-ok">Yes</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!--Delete model -->
<!--inactive model -->
<div class="modal fade modal-fade-in-scale-up" id="confirm-inactive" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header alert-danger">
<!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
-->
                  <h4 class="modal-title"><i class="fa fa-fw fa-warning"></i>  Oops!!</h4>
              </div>
              <div class="modal-body">
				  <?php  if($this->session->userdata('userType')==2): if($isoffice=="NA"): ?>
                <p>You're temporarily Inactive from Office,Please consult super admin</p>
                <?php else:  ?>
                 <p>Office is not assign to you, Please consult with super admin.</p>
                <?php  endif; endif;  ?>
              </div>
              <div class="modal-footer ">
<!--
                <a  href="javascript:void(0);" type="button" class="btn btn-outline btn-ok pull-right " data-dismiss="modal">No</a>
-->
                <a href="javascript:void(0);" type="button" id="inUrl" class="btn btn-outline btn-danger btn-ok">Ok</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!--inactive model -->
<!--Trans model -->
<div class="modal fade modal-fade-in-scale-up" id="tran-data" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-light-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="fa fa-fw fa-money"></i> Transaction Details</h4>
              </div>
                 
                <div id="ajaxTrn"></div>
              

            <!-- /.modal-body -->
              <div class="modal-footer ">
                <a  href="javascript:void(0);" type="button" class="btn btn-outline btn-ok pull-right " data-dismiss="modal">Close</a>
               <!--  <a href="javascript:void(0);" type="button" id="deleteUrl" class="btn btn-outline btn-danger btn-ok">Yes</a> -->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!--Trans model -->
<!-- Material Design -->
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/material.min.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- SlimScroll -->
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/app.min.js"></script>
<!-- custum js -->
<?php if(isset($addJs)):for($i = 0; $i < count($addJs); $i++):  ?>
<script src="<?php echo base_url().ADMIN_THEME.$addJs[$i];?>"></script>
<?php endfor;endif; ?>
<!-- InputMask -->
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- custum js -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().ADMIN_THEME; ?>dist/js/demo.js"></script>
<script src="<?php echo base_url().ADMIN_THEME; ?>assets/js/custom.js"></script>

<script type="text/javascript">
    $("[data-mask]").inputmask();
   
</script>
 <?php  if($this->session->userdata('userType')==2): if($isoffice=="NA" OR $isoffice=="SA"): ?>
<script type="text/javascript">
  //$("confirm-inactive").model("show");
   $('#confirm-inactive').modal('show');
    $("#inUrl").attr('href',"<?php echo base_url().'dashboard/logout'; ?>");
    setInterval(function(){  window.location.href = '<?php echo base_url().'dashboard/logout'; ?>'; },9000);
</script>
<?php  endif;endif;  ?>
</body>
</html>
