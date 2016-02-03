<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = $modulo->menu["menu"];
        $data["submenu"]  = $modulo->menu["submenu"];
        $this->load->view('store-admin/v-store-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categorias
            <small><a href="<?php echo $modulo->url_main_panel; ?>/categorys/add">Agregar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"> Categorias</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <?php foreach($modulo->data_categorias as $categoria): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a class="link-shorcut" href="store/<?php echo $this->session->id_empresa; ?>/admin/perfil-store">
                    <div class="info-box boxCategory">
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                        <span class="info-box-icon bg-aqua"><i class="fa fa-building-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?php echo $categoria->nombre_categoria; ?></span>
                            <span class="info-box-text">Sub Categorias: <?php echo $categoria->total_subcategorias; ?></span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <?php endforeach; ?>
          </div><!-- /.row -->
          
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      <?php $this->load->view('template/main-panel/footer'); ?>
    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
  </body>
</html>