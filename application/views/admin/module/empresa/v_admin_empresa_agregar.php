

<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 0;
        $data["submenu"]  = 0;
        $this->load->view('admin/v-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $modulo->titulo; ?>
            <small><a href="<?php echo base_url().$modulo->base_url; ?>">Regresar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>admin/empresa">Empresa</a> </li>
            <li><?php echo strtolower($modulo->nombreSeccion); ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formCliente" role="form">
                  <?php 
                  if ( isset($idCliente) ) { ?>
                    <input type="hidden" name="id_cliente" value="<?php echo $idCliente; ?>">
                  <?php } ?>
                 <div class="box-body">
                    <?php
                      if (isset($existeCliente) && !$existeCliente ) { ?>
                        <div class="alert alert-danger alert-dismissible">
                          <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                          Lo sentimos el cliente que desea editar no existe.<br>
                          <strong>No intente modificar la direccion url :D</strong>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                      <label for="txtCodigoSigne">Codigo Signe</label>
                      <?php
                        if (isset($existeCliente) && $existeCliente ) { ?>
                          <input type="text" class="form-control" id="txtCodigoSigne" name="codigo_signe" maxlength="10" value="<?php echo $dataCliente->codigo_signe; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtCodigoSigne" name="codigo_signe" maxlength="10">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtRazonSocial">Razon Social</label>
                      <?php
                        if (isset($existeCliente) && $existeCliente ) { ?>
                          <input type="text" class="form-control" id="txtRazonSocial" name="razon_social" maxlength="150" value="<?php echo $dataCliente->razon_social; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtRazonSocial" name="razon_social" maxlength="150">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtRUC">RUC</label>
                      <?php
                        if (isset($existeCliente) && $existeCliente ) { ?>
                          <input type="text" class="form-control" id="txtRUC" name="ruc" maxlength="11" value="<?php echo $dataCliente->ruc; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtRUC" name="ruc" maxlength="11">
                      <?php } ?>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
                  </div>
                </form>
                <div class="overlay hide" >
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
  </body>
</html>