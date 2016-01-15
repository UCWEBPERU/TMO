<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 4;
        $data["submenu"]  = 0;
        $this->load->view('admin/v-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mi Perfil
            <!--<small>Enlaces rapidos</small>-->
          </h1>
          <ol class="breadcrumb">
            <li ><a href="<?php echo base_url()."admin"; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Datos Personales</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                <div class="box-body">
                    <div class="form-group">
                    <label for="txtNombres">Nombres</label>
                    <input type="email" class="form-control" id="txtNombres" value="<?php echo $modulo->datos_usuario->nombres_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtApellidos">Apellidos</label>
                    <input type="email" class="form-control" id="txtApellidos" value="<?php echo $modulo->datos_usuario->apellidos_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtPais">Pais</label>
                    <input type="email" class="form-control" id="txtPais" value="<?php echo $modulo->datos_usuario->pais_region_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtEstado">Estado</label>
                    <input type="email" class="form-control" id="txtEstado" value="<?php echo $modulo->datos_usuario->estado_region_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtDireccion">Direccion</label>
                    <input type="email" class="form-control" id="txtDireccion" value="<?php echo $modulo->datos_usuario->direccion_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtNumeroCelular">Numero Celular</label>
                    <input type="email" class="form-control" id="txtNumeroCelular" value="<?php echo $modulo->datos_usuario->movil_persona; ?>" />
                    </div>
                    <div class="form-group">
                    <label for="txtNumeroTelefonico">Numero Telefonico</label>
                    <input type="email" class="form-control" id="txtNumeroTelefonico" value="<?php echo $modulo->datos_usuario->telefono_persona; ?>" />
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.box  -->

            </div>
            
            <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Cuenta de Usuario</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtNombreUsuario">Nombre Usuario</label>
                        <input type="email" class="form-control" id="txtNombreUsuario" value="<?php echo $modulo->datos_usuario->email_usuario; ?>" disabled />
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Contraseña</label>
                        <input type="email" class="form-control" id="txtPassword" />
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Confirmar Contraseña</label>
                        <input type="email" class="form-control" id="txtPassword" />
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.box  -->

            </div>

          </div><!-- /.row -->

        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
  </body>
</html>