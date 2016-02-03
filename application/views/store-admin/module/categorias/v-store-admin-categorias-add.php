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
            Agregar Categoria
            <small><a href="<?php echo $modulo->url_main_panel; ?>/categorys">Regresar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="<?php echo $modulo->url_main_panel; ?>/categorys"> Categorias</a></li>
            <li> Agregar</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Agregar Categoria</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Categoria Superior</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option selected="selected" value="">--Seleccione--</option>
                                <?php foreach($modulo->data_categorias as $categoria): ?>
                                <option selected="selected" value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                <?php endforeach; ?>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-wnn8-container"><span class="select2-selection__rendered" id="select2-wnn8-container" title="California">California</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nombre Categoria</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </form>
                </div><!-- /.box -->
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      <?php $this->load->view('template/main-panel/footer'); ?>
    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
  </body>
</html>