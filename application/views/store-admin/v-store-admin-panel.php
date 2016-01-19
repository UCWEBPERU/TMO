<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 0;
        $data["submenu"]  = 0;
        $this->load->view('store-admin/v-store-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel Administrativo
            <small>Enlaces rapidos</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="/store/<?php echo $this->session->id_empresa; ?>/admin/"><i class="fa fa-dashboard"></i> Inicio</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="store/<?php echo $this->session->id_empresa; ?>/admin/perfil-store">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-building-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Empresa</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="store/<?php echo $this->session->id_empresa; ?>/admin/productos">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-shopping-bag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="store/<?php echo $this->session->id_empresa; ?>/admin/categorias">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number"></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a class="link-shorcut" href="store/<?php echo $this->session->id_empresa; ?>/admin/perfil">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Perfil</span>
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