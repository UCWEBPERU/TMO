<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue fixed sidebar-mini fix-padding-scrollbar">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = $modulo->menu["menu"];
        $data["submenu"]  = $modulo->menu["submenu"];
        $this->load->view('company-admin/v-company-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel Administrativo
            <small>Enlaces rapidos</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/company-profile">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-building-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Company</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/store">
                <div class="info-box">
                  <span class="info-box-icon bg-blue"><i class="fa fa-building-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Store</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/product">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-shopping-bag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Products</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/promotion">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-ticket"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Promotions</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/category">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Categories</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="<?php echo $modulo->url_main_panel; ?>/user">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
          </div><!-- /.row -->
          
          <!-- =========================================================== -->

        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
  </body>
</html>