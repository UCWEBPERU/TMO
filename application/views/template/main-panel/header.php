<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo $modulo->url_main_panel; ?>" class="logo" style="">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><?php echo $modulo->nombre_empresa_corto; ?></b></span>
    <!--<img src="<?php echo $modulo->icono_empresa; ?>" class="logo-mini" alt="App Icon">-->
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?php echo $modulo->nombre_empresa_largo; ?></b><b></b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?php echo $modulo->icono_empresa; ?>" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo $modulo->nombres_usuario; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="<?php echo $modulo->icono_empresa; ?>" class="img-circle" alt="User Image">
              <p>
                <?php echo $modulo->nombres_usuario; ?> - <?php echo $modulo->tipo_usuario; ?>
                <!--<small>Member since Nov. 2012</small>-->
              </p>
            </li>
            <!-- Menu Body -->
            <!--<li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </li>-->
            <!-- Menu Footer-->
            <li class="user-footer">
              <!--<div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>-->
              <div class="pull-right">
                <a href="<?php echo $modulo->url_signout; ?>" class="btn btn-default btn-flat">Cerrar sesion</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <!--<li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>-->
      </ul>
    </div>
  </nav>
</header>